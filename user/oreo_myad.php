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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">广告合作</a></li>
                                            <li class="breadcrumb-item active">我的广告位</li>
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
                                       
									   
									   
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 text-nowrap">
                                                <thead class="thead-light" style="text-align: center;">
                                                    <tr>
                                                        <th>id</th>
                                        <th>内容</th>
                                        <th>广告类型</th>
                                        <th>到期时间</th>
                                        <th>状态</th>
										
                                                    </tr>
                                                </thead >
                                                <tbody style="text-align: center;">
												<?php											
$numrows=$DB->query("SELECT count(*) from oreo_ad WHERE uid='$pid'  ")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_ad WHERE uid='$pid'  order by id desc limit $offset,$pagesize")->fetchAll();
												
                                   foreach($list as $res){
									   if($res['type']==1){
										   $adtype='<button class="btn btn-danger" data-toggle="modal" data-target="#shopzad" data-id="shopzad">点击补充广告内容</button>';
									   }if($res['type']==2){
										   $adtype='<font color=red>正在审核</font>';
									   }if($res['type']==3){
										   $adtype='<font color=green>正在展示</font>';
									   }if($res['type']==3&&$res['dtime']<$time=date('Y-m-d')){
										   $adtype='<font color=red>广告到期</font>';
									   }
	                                 echo '<tr>
									<td>'.$res['id'].'</td> 
                                    <td>'.$res['text'].'</td>
									<td>'.($res['ad_type']==1?'<font color=blue>站内广告</font>':'<font color=red>程序内广告</font>').'</td>
                                    <td>'.$res['dtime'].'</td>
                                    <td>'. $adtype.'</td>
                                    ';
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
						<div id="shopzad" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-database-settings"> 补充广告信息</i>
                                                        </div>
														<div class="form-group">
                                                    <label id="typename">我的广告词:</label>
                                                    <div>
													 <textarea rows="4"  name="adtext" class="form-control" style="border: solid 1px;"></textarea> 
                                                    </div>
													 <small>* 可适当的添加html代码，如 style，href 等</small>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="TijiaAd">修改</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
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
		<script src="../assets/user/js/layer.js"></script>	
		<script>
					 $("#TijiaAd").click(function () {
						var uid="<?=$pid?>";
                        var adtext=$("textarea[name='adtext']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=edit_AdText",
							data: {uid:uid,adtext:adtext},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('成功补充广告信息，请耐心等待管理员的审核，这个过程并不会太长', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else if (data.code == -1) {
									layer.alert(data.msg, function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								}else {
									layer.alert(data.msg);
								}
							}
						});
					});
</script>
    </body>
</html>