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
                                                <form class="form-inline" method="GET" action="oreo_shop_mall.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search"  name="shop"  class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="status-select" class="mr-2">搜索对象</label>
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="name">商品名称</option>
                                                            <option value="seller_qq">卖家QQ号</option>
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
                                        <th>商品名称</th>
                                        <th>商品价格</th>
                                        <th>卖家账号</th>
                                        <th>卖家QQ</th>
										<th>已卖出</th>
										<th>好评率</th>
										<th>商品状态</th>
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
	$numrows=$DB->query("SELECT count(*) from oreo_shop_guarantee WHERE{$sql}")->fetchColumn();
	$link='&shop='.$_GET['shop'].'&column='.$_GET['column'].'&value='.$_GET['value'];
}else{
	$numrows=$DB->query("SELECT count(*) from oreo_shop_guarantee WHERE 1")->fetchColumn();
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

$rs=$DB->query("SELECT * FROM oreo_shop_guarantee WHERE{$sql} order by id desc limit $offset,$pagesize");											
                                     while($row = $rs->fetch())
                                      {
										  //好评率计算
									      $goods=round($row['evaluate_good']/($row['evaluate_good']+$row['evaluate_bad'])*100,3);
									      if($row['evaluate_good']==0&&$row['evaluate_bad']==0){$goods='暂无';}
										  //计算总卖出
										  $shops=round($row['evaluate_good']+$row['evaluate_bad'],2);
										    if($row['type']==1){
											$states='<span class="badge badge-success">正常接单</span>';}
											else{
											$states='<span class="badge badge-danger">拒绝接单</span>';}
											echo '<tr>
											<td>
                                                            <img src="'.$row['photo'].'" alt="contact-img" title="contact-img" class="rounded mr-3" height="48" />
                                                            <p class="m-0 d-inline-block align-middle font-16">
                                                                <a href="apps-ecommerce-products-details.html" class="text-body">'.$row['name'].'</a>
                                                                <br/>
                                                            </p>
                                                        </td>
										    <td >¥'.$row['money'].'</td>
											<td >'.$row['seller'].'</td>
											<td ><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$row['seller_qq'].'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'.$row['seller_qq'].':51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
											<td >'.$shops.'个</td>
											<td >'.$goods.'%</td>
											<td >'.$states.'</td>
											<td ><a href="./oreo_shop_guarantees.php?shop_id='.$row['id'].'"  class="btn btn-success" >详细/购买</a></td>
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
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_mall.php?page='.$last.$link.'">尾页</a></li>';
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