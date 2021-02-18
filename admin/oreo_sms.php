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
                                                <li class="breadcrumb-item"><a href="#">一般</a></li>
                                                <li class="breadcrumb-item active">Oreo云短信管理</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Oreo云短信管理</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                      <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;">     
                      <tr>     
                                <th>ID</th>
								<th>用户</th>
                                <th>域名</th>
								<th>Token</th>
                                <th>剩余</th>
                                <th>状态</th>
								<th>操作</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
<?php
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_tensms WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_tensms WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{                                           if($row['type']==1&&$row['surplus']>0){
											$states="<a style='color: green;'>正常</a>";} 
											if($row['type']==1&&$row['surplus']<=0){
											$states="<a style='color: red;'>短信包用尽</a>";} 
											if($row['type']==0){
											$states="<a style='color: red;'>无权限</a>";}                 
											echo "<tr >";
											echo "<td>".$row['id']."</td>";
											echo "<td>".$row['pid']."</td>";
											echo "<td >".$row['domain']."</td>";
											echo "<td >".$row['token']."</td>";
											echo "<td >".$row['surplus']."</td>"; 
											echo "<td >".$states."</td>";
											echo "<td style='display: none;'>".$row['type']."</td>";
											
											echo "<td ><a data-toggle='modal' data-target='#bianji' data-id='bianji' class='btn btn-xs btn-info'>编辑</a>&nbsp;&nbsp;<a data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-xs btn-danger' >删除</a></td>";
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
                                    </div>
                                </div> <!-- end col -->
                           </div> <!-- end row -->
                        </div><!-- container -->
						<div class="modal fade bs-example-modal-center"   id="bianji" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">编辑用户云短信</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>用户账号:</label>
                                                    <div>
													  <input type="text" class="form-control ca0" name="id" readonly="readonly" style="display: none;"/>
                                                      <input type="text" class="form-control ca1" name="userid" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>域名</label>
                                                    <div>
													<input type="text" class="form-control ca2"  readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>Token</label>
                                                    <div>
													<input type="text" class="form-control ca3" name="token"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>剩余</label>
                                                    <div>
													<input type="text" class="form-control ca4" name="surplus"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>是否重置Token</label>
                                                    <div>
                                                    <select class="form-control" name="cztoken" id="cztoken">
                                                    <option value="0" >否</option> 
                                                    <option value="1" >是</option>													
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control ca6" name="type" id="type">
                                                    <option value="0" >无权限</option> 
                                                    <option value="1" >正常</option>													
                                                    </select>
                                                    </div>
                                                </div>
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="xiugai"  value="提交" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                           </div><!-- /.modal-content -->
                                       </div><!-- /.modal-dialog -->
                                   </div><!-- /.modal -->	
								   <div class="modal fade bs-example-modal-center"   id="shanchu" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">请确认您的操作</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>域名:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="ids" readonly="readonly" style="display: none;"/>
													  <input type="text" class="form-control ca2" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>短信包剩余:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca4"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="shanchul"  value="提交" class="btn btn-danger waves-effect" >
                                                            确认删除
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                           </div><!-- /.modal-content -->
                                       </div><!-- /.modal-dialog -->
                                   </div><!-- /.modal -->	
                                 					   
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->
             <?php include'oreo_foot.php';?>
<script>
	 $('#bianji').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content);
	  var content = btnThis.closest('tr').find('td').eq(2).text();
      modal.find('.ca2').val(content);
	  var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(4).text();
      modal.find('.ca4').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content); 

	 
});
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(2).text();
      modal.find('.ca2').val(content); 
      var content = btnThis.closest('tr').find('td').eq(4).text();
      modal.find('.ca4').val(content);
	 
});
                        $("#xiugai").click(function () {
						var id=$("input[name='id']").val();
						var token=$("input[name='token']").val();
						var surplus=$("input[name='surplus']").val();
						var cztoken = $("#cztoken").val();
						var type = $("#type").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_OreoSmsXg",
							data: {id:id,token:token,surplus:surplus,cztoken:cztoken,type:type},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('修改成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#shanchul").click(function () {
						var ids=$("input[name='ids']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=Del_OreoSms",
							data: {ids:ids},
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
</script>
    </body>
</html>