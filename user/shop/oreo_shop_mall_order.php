<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
$shop=isset($_GET['shop'])?$_GET['shop']:null;
?>
                <div class="content-page">
                    <div class="content">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item active">服务市场</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">交易市场</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
						 <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">
                        <p class="mb-0">担保说明：<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Oreo普通用户实名认证后可发布商品，实名认证<a href="oreo_shop_real.php">点这里</a>.<br/>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Oreo综合服务站承接担保服务, 服务内容为卖家发布产品, 买家自愿购买, 卖家发货, 买家确认收到货并且做出评价, 买家一旦确认收货即视为交易成功, 冻结余额打入卖家账户.<br/>
                         </div>   
                        </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<div class="row mb-2">
                                            <div class="col-lg-8">
                                                <form class="form-inline" method="GET" action="oreo_shop_mall_order.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search"  name="shop"  class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="status-select" class="mr-2">搜索对象</label>
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="name">商品名称</option>
                                                            <option value="out_trade_no">商品单号</option>
                                                        </select>
                                                    </div>                       
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <button type="submit" name="submit" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i> 搜索</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                       </form> 
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 text-nowrap">
                                                <thead class="thead-light" style="text-align: center;">
                                                    <tr>
										<th>商品单号</th>			
                                        <th>商品名称</th>
                                        <th>商品价格</th>
										<th>创建/付款时间</th>
                                        <th>卖家账号</th>
                                        <th>卖家QQ</th>
										<th>付款状态</th>
										<th>订单状态</th>
                                        <th>详细/操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
												<?php
if($shop) {
	if($_GET['column']=='name'){
		$sql=" `{$_GET['column']}` like '%{$_GET['shop']}%'";
	}else{
		$sql=" `{$_GET['column']}`='{$_GET['shop']}'";
	}
	$numrows=$DB->query("SELECT count(*) from oreo_shop_details WHERE{$sql}")->fetchColumn();
	$link='&shop='.$_GET['shop'].'&column='.$_GET['column'].'&value='.$_GET['value'];
}else{
	$numrows=$DB->query("SELECT count(*) from oreo_shop_details WHERE 1")->fetchColumn();
	$sql=" 1";
}
$pagesize=10;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM oreo_shop_details WHERE `user`='{$pid}' AND name<>'oreo实名认证'  AND {$sql} order by id desc limit $offset,$pagesize");											
                                     while($row = $rs->fetch())
                                      {
										    $Shop_user=$DB->query("select * from oreo_shop_user where user='{$row['seller']}' limit 1")->fetch();
										    if($row['status']==1){
											$states='<span class="badge badge-success">已付款</span>';
											$shop_info='<a href="./oreo_order_details.php?shop_code='.$row['out_trade_no'].'"  class="btn btn-success" >详细/操作</a>';}
											else{
											$states='<span class="badge badge-danger">未付款</span>';
											$shop_info='<form id="oreosubmit" name="oreosubmit" action="./oreo_shop_invoice.php" method="POST" >
											 <input type="hidden" name="module" value="'.$module.'"/>
                                             <input type="hidden" name="timestamp" value="'.time().'"/>
                                             <input type="hidden" name="token" value="'.md5($module.'#$@%!^*'.time()).'"/>
											 <input type="hidden" name="adtime" value="'.$row['addtime'].'"/>
											 <input type="hidden" name="status" value="0"/><input type="hidden" name="uids" value="'.$pid.'"/><input type="hidden" name="money" value="'.$row['money'].'"/>
											 <input type="hidden" name="ordername" value="'.$row['name'].'"/><input type="hidden" name="ordername" value="'.$row['name'].'"/>
											 <input type="hidden" name="order_text" value="'.$row['order_text'].'"/><input type="hidden" name="out_trade_no" value="'.$row['out_trade_no'].'"/>
											 <button type="submit"  class="btn btn-danger" >立即付款</button></form>';}
											if($row['status']==0&&$row['shop_type']==0){$shop_type='<span class="btn btn-outline-danger">买家未付款</span>';}
											if($row['status']==1&&$row['shop_type']==0){$shop_type='<span class="btn btn-outline-primary">卖家尚未确认订单</span>';}
											if($row['shop_type']==1){$shop_type='<span class="btn btn-outline-info">卖家已接单</span>';}
											if($row['shop_type']==2){$shop_type='<span class="btn btn-outline-success">卖家已发货</span>';}
											if($row['shop_type']==3){$shop_type='<span class="btn btn-outline-success">交易完成</span>';}
											if($row['shop_type']==4){$shop_type='<span class="btn btn-outline-secondary">退款成功</span>';}
											if($row['shop_type']==5){$shop_type='<span class="btn btn-outline-dark">人工审核退款</span>';}
											echo '<tr>
											 <td >#'.$row['out_trade_no'].'</td>
											 <td >'.$row['name'].'</td>
										    <td >¥'.$row['money'].'</td>
											<td >'.$row['addtime'].'<br>'.$row['endtime'].'</td>
											<td >'.$row['seller'].'</td>
											<td ><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$Shop_user['qq'].'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'.$Shop_user['qq'].':51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
											<td >'.$states.'</td>
											<td >'.$shop_type.'</td>
											<td >'.$shop_info.'</td>
											</tr>';
											}
									?>
                                                </tbody>
                                            </table>
											<nav style="float: inline-end;">
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall_order.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall_order.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall_order.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall_order.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall_order.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall_order.php?page='.$last.$link.'">尾页</a></li>';
} else {

echo '<li class="page-item"><a class="page-link">尾页</a></li>';
}
echo'</ul>';
#分页
?>
                                                </nav>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->		
                    <!-- Footer Start -->
                    <footer class="footer">
                        <div class="row">
                            <div class="col-md-6">
                                 <?php echo $conf['web_copyright']; ?>. 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-md-block">
                                    <a href="javascript: void(0);"><?php echo $conf['web_beian']; ?></a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->
                </div> <!-- content-page -->
            </div> <!-- end wrapper-->
<script src="../../assets/user/js/app.min.js"></script>
<script src="../../assets/user/js/layer.js"></script>
</body>
</html>