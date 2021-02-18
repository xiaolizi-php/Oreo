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
                                                <li class="breadcrumb-item"><a href="#">更新设置</a></li>
                                                <li class="breadcrumb-item active">客户更新记录</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">客户更新记录</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">客户更新记录说明</h4>
                                            <p class="text-muted m-b-30 font-14">您可以在此页面查看您授权的系统的更新情况. </p>
                        <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;">
                      <tr>
                                <th>ID</th>
                                <th>域名</th>
                                <th>时间</th>
                                <th>版本</th>
                                <th>状态</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
 									<?php 
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_log WHERE{$sql}")->fetchColumn();
$link='&my=search&column='.$_POST['column'].'&value='.$_POST['my'];										
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
$list=$DB->query("SELECT * FROM oreo_log WHERE{$sql} order by id desc limit $offset,$pagesize");
                                      while($row = $list->fetch())
                                      {
											echo "<tr class='gradeX'>";
											echo "<td >".$row['id']."</td>";
											echo "<td >".$row['domain']."</td>";
											echo "<td >".date("Y-m-d H:i:s",$row['time'])."</td>";
											echo "<td >".$row['version']."</td>";
											echo "<td >".base64_decode($row['status'])."</td>";
											echo "</tr>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_update_log.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_update_log.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_update_log.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_update_log.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_update_log.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_update_log.php?page='.$last.$link.'">尾页</a></li>';
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