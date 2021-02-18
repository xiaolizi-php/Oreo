<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
$shop=isset($_GET['shop'])?$_GET['shop']:null;
if($Shop_user['activation']!=2){
exit('<script language="javascript">swal("无权操作","实名认证用户才能发布产品", "error", {button: "明白",}).then(function () {window.location.href="./oreo_shop_my.php"});</script>');
}
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
											 <li class="breadcrumb-item"><a href="javascript: void(0);">卖家中心</a></li>
                                            <li class="breadcrumb-item active">订单管理</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">订单管理</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<div class="row mb-2">
                                            <div class="col-lg-8">
                                                <form class="form-inline" method="GET" action="oreo_shop_buyer.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search" id="search" name="shop"  class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="status-select" class="mr-2">搜索对象</label>
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="name">商品名称</option>
                                                            <option value="user">买家账号</option>
															<option value="out_trade_no">商品单号</option>
                                                        </select>
                                                    </div>                       
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <button type="submit"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i> 搜索</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                       </form> 
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 text-nowrap">
                                                <thead class="thead-light" style="text-align: center;">
                                                    <tr>
										<th>商品单号</th>			
                                        <th>买家账号</th>
										<th>买家QQ</th>
                                        <th>商品名称</th>
                                        <th>商品金额</th>
										<th>订单状态</th>
                                        <th>详细内容</th>
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

$rs=$DB->query("SELECT * FROM oreo_shop_details WHERE{$sql} and seller='$pid' order by id desc limit $offset,$pagesize");											
                                     while($row = $rs->fetch())
                                      {   //查询买家信息
										  $Shop_user_qq=$DB->query("select * from oreo_shop_user where user='{$row['user']}' limit 1")->fetch();
										  //查询商品id
										  $Shop_info=$DB->query("select * from oreo_shop_guarantee where unique_code='{$row['unique_code']}' limit 1")->fetch();
										  //订单状态查询
										  if($row['status']==0&&$row['shop_type']==0){$shop_type='<span class="btn btn-outline-danger">买家未付款</span>';}
											if($row['status']==1&&$row['shop_type']==0){$shop_type='<span class="btn btn-outline-primary">已付款,请确认订单</span>';}
											if($row['shop_type']==1){$shop_type='<span class="btn btn-outline-info">您已接单，请极速备货</span>';}
											if($row['shop_type']==2){$shop_type='<span class="btn btn-outline-success">您已发货</span>';}
											if($row['shop_type']==3){$shop_type='<span class="btn btn-outline-success">买家已确认收货</span>';}
											if($row['shop_type']==4){$shop_type='<span class="btn btn-outline-secondary">退款成功</span>';}
											if($row['shop_type']==5){$shop_type='<span class="btn btn-outline-dark">人工审核退款</span>';}
										  //form数据
										  $shop_info_post='<form id="oreosubmit" name="oreosubmit" action="./oreo_shop_detailed_information.php" method="POST" >
											 <input type="hidden" name="module" value="'.$module.'"/>
                                             <input type="hidden" name="timestamp" value="'.time().'"/>
                                             <input type="hidden" name="token" value="'.md5($module.'#$@%!^*'.time()).'"/>
											 <input type="hidden" name="out_trade_no" value="'.$row['out_trade_no'].'"/>
											 <input type="hidden" name="shops_types" value="'.$row['shop_type'].'"/>
											 <input type="hidden" name="status" value="'.$row['status'].'"/>
											 <input type="hidden" name="order_text" value="'.$row['order_text'].'"/>
											 <input type="hidden" name="endtime" value="'.$row['endtime'].'"/>
											 <input type="hidden" name="money" value="'.$row['money'].'"/>
											 <input type="hidden" name="uids" value="'.$pid.'"/>
											 <input type="hidden" name="ordername" value="'.$row['name'].'"/><input type="hidden" name="ordername" value="'.$row['name'].'"/>
											 <button type="submit"  class="btn btn-success" >详细/设置</button></form>';
										    if($row['type']==1){
											$states='<span class="badge badge-success">正常接单</span>';}
											else{
											$states='<span class="badge badge-danger">拒绝接单</span>';}
											echo '<tr>
											<td >#'.$row['out_trade_no'].'</td>
											<td class="table-user">
                                            <img src="//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$Shop_user_qq['qq'].'&src_uin='.$Shop_user_qq['qq'].'&fid='.$Shop_user_qq['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC" alt="table-user" class="mr-2 rounded-circle">
                                            <a class="text-body font-weight-semibold">'.$row['user'].'</a>
                                            </td>
											<td ><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$Shop_user_qq['qq'].'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'.$Shop_user_qq['qq'].':51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
										    <td><a href="./oreo_shop_guarantees.php?shop_id='.$Shop_info['id'].'">'.$row['name'].'</a></td>
											<td >¥'.$row['money'].'</td>
											<td >'.$shop_type.'</td>
											<td >'.$shop_info_post.'</td>
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
echo '<li class="page-item"><a class="page-link" href="oreo_shop_buyer.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_buyer.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_buyer.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_buyer.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_shop_buyer.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_buyer.php?page='.$last.$link.'">尾页</a></li>';
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
<script>
$(document).ready(function(){ 
    $("#search").keydown(function(event) {
    if(event.shiftKey)
    {
        event.preventDefault();
    }
    if (event.keyCode == 32)    {
        event.preventDefault();
    }
});
});
</script>
</body>
</html>