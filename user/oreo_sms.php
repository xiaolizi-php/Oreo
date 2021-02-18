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
                                            <li class="breadcrumb-item active">Oreo云短信</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Oreo云短信</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      <div class="text-lg-left">
                                           <button data-toggle="modal" data-target="#tianjia" data-id="tianjia" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i> 添加对接</button>
                                         </div>
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 text-nowrap">
                                                <thead class="thead-light" style="text-align: center;">
                                                    <tr>
                                        <th>ID</th>
                                        <th>对接域名</th>
                                        <th>Token</th>
                                        <th>剩余</th>
                                        <th>状态</th>
									 	<th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
												<?php
$numrows=$DB->query("SELECT count(*) from oreo_tensms WHERE pid='$pid' ")->fetchColumn();
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
								$rs=$DB->query("SELECT * FROM oreo_tensms WHERE pid='$pid' order by id desc limit $offset,$pagesize"); 
                                     while($row = $rs->fetch())
                                      {
										    if($row['type']==1&&$row['surplus']>0){
											$states="<a style='color: green;'>正常</a>";
											$caozuo="<button data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-danger' >删除</button>";}
											if($row['type']==1&&$row['surplus']<=0){
											$states="<a style='color: red;'>短信包用尽</a>";
											$caozuo="<button data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-danger' >删除</button>";
											$chongzhi="&nbsp;&nbsp;<button data-toggle='modal' data-target='#goumai' data-id='goumai' class='btn btn-success' >充值</button>";}
											if($row['type']==2){
											$states="<a style='color: red;'>无权限</a>";
											$caozuo="<button data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-danger' >删除</button>";}
											echo "<tr>";
											echo "<td >".$row['id']."</td>";
											echo "<td >".$row['domain']."</td>";
											echo "<td >".$row['token']."</td>";
											echo "<td >".$row['surplus']."条</td>";
                                            echo "<td >".$states."</td>";
											echo "<td >".$caozuo,$chongzhi."</td>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_sms.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_sms.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_sms.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_sms.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_sms.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_sms.php?page='.$last.$link.'">尾页</a></li>';
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
                                                         <i class="mdi mdi-delete-forever mr-1"> 删除云短信对接</i>
                                                        </div>
														<div class="form-group" style="display: none;">
                                                    <label>ID:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  name="ids"  readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  name="domains"  readonly="readonly" />
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
                                                         <i class="iconfont icon-qq mr-1"> 添加云短信</i>
                                                        </div>
												       <div class="form-group mb-3">
                                                        <label for="example-select">选择对接域名:</label>
                                                        <select class="form-control"  id="domain" name="domain">
                                                            <?php
													$sccs=$DB->query("SELECT * FROM `oreo_authorize`  WHERE sjid='$pid' ");
                                                    while ($row = $sccs->fetch()) {
						                            echo "<option value={$row['domain']}>{$row['domain']}</option>
													";
	                                                 }
					                                  ?>
                                                        </select>
														<small>* 只有授权的域名才显示在列表内</small>
                                                    </div>
													<div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="TianjiaTenSms">添加</button>
                                                     </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                 </div> <!-- content -->
								 <div id="goumai" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-delete-forever mr-1"> 购买短信包</i>
                                                        </div>
														<div class="form-group" style="display: none;">
                                                    <label>ID:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  name="idc"  readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  name="domainc"  readonly="readonly" />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>购买:</label>
                                                    <div>
													 <input type="text" class="form-control" value="100条/6元" name="mall" readonly="readonly" />
                                                 </div>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="gmall">购买</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
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
});
 $('#goumai').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content); 
});   
					$("#shuanchul").click(function () {
						var domains = $("input[name='domains']").val();
						var ids = $("input[name='ids']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=delete_TenSmsDel",
							data: {domains:domains,ids:ids},
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
					$("#TianjiaTenSms").click(function () {
						var domain = $("#domain").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=New_TianjiaTenSms",
							data: {domain:domain},
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
					$("#gmall").click(function () {
						var idc = $("input[name='idc']").val();
						var domainc = $("input[name='domainc']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Mall_OreoSms",
							data: {idc:idc,domainc:domainc},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('购买成功', function(index) {
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