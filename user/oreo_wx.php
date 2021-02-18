<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
$ktztc=$DB->query("SELECT user FROM `oreo_authsys` WHERE concat(',',user,',') LIKE '%,$pid,%'")->fetch();
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
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
                                            <li class="breadcrumb-item active">微信免签管理</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">微信免签管理</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      <div class="text-lg-left">
                                           <button data-toggle="modal" data-target="#tianjia" data-id="tianjia" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i> 添加免签</button>
                                         </div>
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 text-nowrap">
                                                <thead class="thead-light" style="text-align: center;">
                                                    <tr>
                                        <th>站点标题</th>
                                        <th>回调地址</th>
                                        <th>添加时间</th>
                                        <th>Token</th>
										<th>状态 </th>
                                        <th>成功调用 </th>
									 	<th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
												<?php
$numrows=$DB->query("SELECT count(*) from oreo_wxback WHERE userid='$pid' ")->fetchColumn();
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
								$rs=$DB->query("SELECT * FROM oreo_wxback WHERE userid='$pid' order by id desc limit $offset,$pagesize"); 
                                     while($row = $rs->fetch())
                                      {
										    if($row['state']==1){
											$states="<a style='color: green;'>正常</a>";}
											else{
											$states="<a style='color: red;'>禁止</a>";}
											echo "<tr>";
											echo "<td >".$row['title']."</td>";
											echo "<td >".$row['callback']."</td>";
											echo "<td >".$row['addtime']."</td>";
											echo "<td >".$row['token']."</td>";
											echo "<td >".$states."</td>";
                                            echo "<td >".$row['in_all']."次</td>";
											echo "<td ><button data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-danger' >删除</button></td>";
											echo "</tr>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_wx.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_wx.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_wx.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_wx.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_wx.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_wx.php?page='.$last.$link.'">尾页</a></li>';
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
						<div id="shanchu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-delete-forever mr-1"> 删除微信免签</i>
                                                        </div>
														<div class="form-group">
                                                    <label>网站标题:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"   readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>URL链接:</label>
                                                    <div>
                                                    <input type="text" class="form-control ca1"  readonly="readonly"/>  
													  <input type="text" class="form-control ca3" name="tokens" readonly="readonly" style="display: none;"/>
                                                 </div>
                                                </div>	
                                                <div class="form-group text-center">
                                                 <button class="btn btn-danger" type="button" id="shuanchul">删除</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="tianjia" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="iconfont icon-weixin mr-1"> 添加微信免签</i>
                                                        </div>
														<div class="form-group">
                                                    <label>网站标题:</label>
                                                    <div>
													 <input type="text" class="form-control" name="title" />
                                                 </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                        <label for="example-select">网站协议:</label>
                                                        <select class="form-control ca8"  id="xieyi" name="xieyi">
                                                           <option value="1">http://</option>
                                                           <option value="2">https://</option>
                                                        </select>
                                                        <small>* 网站协议很重要，如果您的网站开启SSL协议请选择https协议.</small>
                                                    </div>
												<div class="form-group mb-3">
                                                        <label for="example-select">选择您的域名:</label>
                                                        <select class="form-control"  id="callback" name="callback">
                                                            <?php
													$sccs=$DB->query("SELECT * FROM `oreo_authorize`  WHERE sjid='$pid' ");
                                                    while ($row = $sccs->fetch()) {
						                            echo "<option value={$row['domain']}>{$row['domain']}</option>
													";
	                                                 }
					                                  ?>
                                                        </select>
                                                    </div>
													<div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="TianjiaWx">添加</button>
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
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content); 
});  
					$("#shuanchul").click(function () {
						var token = $("input[name='tokens']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=delete_WxTianjia",
							data: {token:token},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('删除成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});	
					$("#TianjiaWx").click(function () {
						var title = $("input[name='title']").val();
                        var xieyi = $("#xieyi").val();
						var callback = $("#callback").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=New_TianjiaWx",
							data: {title:title,xieyi:xieyi,callback:callback},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('添加成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});	
</script>  
</body>
</html>