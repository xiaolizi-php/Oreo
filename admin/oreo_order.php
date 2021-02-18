<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
?>
                    <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">资金管理</a></li>
                                                <li class="breadcrumb-item active">订单明细</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">订单明细</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                             <div class="row mb-2">
                                            <div class="col-lg-8">
                                                <form class="form-inline" method="post" action="oreo_order.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search"  name="my" class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="pid">用户账号</option>
                                                            <option value="out_trade_no">用户订单号</option>
                                                        </select>
                                                    </div>                       
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <button type="submit" name="submit" class="btn btn-secondary  mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>搜索</button>
												</div>
                                            </div><!-- end col-->
                                        </div>                  
                          <div class="table-responsive">
                         <table class="table table-bordered text-nowrap">
                         <thead style="text-align: center;">
                                                <tr>
												    <th>充值用户</th>
		                                            <th>订单号</th>
		                                            <th>用户订单号</th>
		                                            <th>金额</th>		  
		                                            <th>方式</th>
		                                            <th>创建时间</th>
		                                           <th>结束时间</th>		  
		                                           <th>状态</th>
                                                </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
 <?php 
if(isset($_POST['submit'])) {

	if($_POST['column']=='name'){
		$sql="`{$_POST['column']}` like '%{$_POST['my']}%'";
	}else{
		$sql="`{$_POST['column']}`='{$_POST['my']}'";
	}
}else{
	$sql=" 1";
	$numrows=$DB->query("SELECT count(*) from oreo_order WHERE{$sql}")->fetchColumn();
	$link='&my=search&column='.$_POST['column'].'&value='.$_POST['my'];
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
$list=$DB->query("SELECT * FROM oreo_order WHERE{$sql} order by trade_no desc limit $offset,$pagesize");				
while($res = $list->fetch())
{
    echo '
	<tr>
    <td>' . $res['pid'] . '</td>
	<td>' . $res['trade_no'] . '</a></td>
	<td>' . $res['out_trade_no'] . '</td>
	<td>' . $res['money'] . '</td>	
	<td>' . $res['type'] . '</td>
	<td>' . $res['addtime'] . '</td>
	<td>' . $res['endtime'] . '</td>	
	<td>' . ($res['status'] == 1 ? '<a class="btn btn-xs btn-success">已完成</a>' : '<a class="btn btn-xs btn-danger">未完成</a>') . '</td></tr>';
}
?>
                                                </tbody>
                                            </table>
                                        </div>
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
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div><!-- container -->
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->
<?php include'oreo_foot.php';?>                      
    </body>
</html>