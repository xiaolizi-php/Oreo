<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
?>
                <div class="content-page">
                    <div class="content">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">控制台</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item active">消费记录</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">消费记录</h4>
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
                                                <form class="form-inline" method="post" action="oreo_order.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search"  name="my" class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="status-select" class="mr-2">搜索对象</label>
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="trade_no">订单号</option>
                                                            <option value="money">金额</option>
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
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>订单号</th>
                                        <th>充值名称</th>
                                        <th>充值金额</th>
                                        <th>支付方式</th>
                                        <th>创建时间/完成时间</th>
                                        <th>状态</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
if(isset($_POST['submit'])) {

	if($_POST['column']=='name'){
		$sql=" and `{$_POST['column']}` like '%{$_POST['my']}%'";
	}else{
		$sql=" and `{$_POST['column']}`='{$_POST['my']}'";
	}
	$numrows=$DB->query("SELECT count(*) from oreo_order WHERE pid='$pid' {$sql}")->fetchColumn();
	$link='&my=search&column='.$_POST['column'].'&value='.$_POST['my'];
}												
$numrows=$DB->query("SELECT count(*) from oreo_order WHERE pid='$pid' {$sql} ")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_order WHERE pid='$pid' {$sql} order by trade_no desc limit $offset,$pagesize");
												
                                   while($res = $list->fetch())
                                    {
	                                 echo '<tr>
                                    <td>'.$res['trade_no'].'</td>
                                    <td>'.$res['name'].'</td>
                                    <td>￥ <b>'.$res['money'].'</b></td>
                                    <td> <b>'.$res['type'].'</b></td>
                                    <td>'.$res['addtime'].'<br/>'.$res['endtime'].'</td>
                                    <td>
									<form id="oreosubmit" name="oreosubmit" action="../../user/oreo_invoice.php" method="POST" >
                                    <input style="display: none" type="hidden" name="adtime" value="'.$res['addtime'].'"/>
                                    <input style="display: none" type="hidden" name="endtime" value="'.$res['endtime'].'"/>
                                    <input style="display: none" type="hidden" name="status" value="1"/>
			                        <input style="display: none" type="hidden" name="uids" value="'.$res['pid'].'"/>
			                        <input style="display: none" type="hidden" name="out_trade_no" value="'.$res['trade_no'].'"/>
			                        <input style="display: none" type="hidden" name="money" value="'.$res['money'].'"/>
									<input style="display: none" type="hidden" name="ddcx" value="1"/>
									<input style="display: none" type="hidden" name="zhuangtai" value="'.$res['type'].'"/>
									<input style="display: none" type="hidden" name="shopname" value="'.$res['name'].'"/>
									'.($res['status']==1?'<button  type="submit" name="submit" class="btn btn-success mb-2 mr-2"> 详情</button></form>':'<font color=red>未完成</font>').'</td>';}?>
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
echo '<li class="page-item"><a class="page-link" href="oreo_order.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_order.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_order.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_order.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_order.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_order.php?page='.$last.$link.'">尾页</a></li>';
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
                    </div> <!-- content -->
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
        <script src="../assets/user/js/app.min.js"></script>
    </body>
</html>