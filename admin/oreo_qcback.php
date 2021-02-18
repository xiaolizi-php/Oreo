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
                                                <li class="breadcrumb-item active">QQ免签管理</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">QQ免签管理</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                        <div class="col-lg-4">
                                                <div class="text-lg-left">
												<a data-toggle="modal" data-target="#tianjia" data-id="tianjia"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>添加QQ免签</a>
												</div>
                                            </div><!-- end col-->
                      <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;">     
                      <tr>     
                                <th style="display: none;">ID</th>
                                <th>用户账号</th>
								<th>Token</th>
                                <th>站点标题</th>
								<th>回调地址</th>
								<th>添加时间</th>
								<th>状态</th>
                                <th>调用</th>
                         <th style="display: none;">ID</th>
								<th>操作</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
<?php
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_qcback WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_qcback WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{                                                             
											if($row['state']==1){
											$states="<a style='color: green;'>正常</a>";}
											else{
											$states="<a style='color: red;'>禁止</a>";}
											
											echo "<tr >";
											echo "<td style='display: none;'>".$row['id']."</td>";
											echo "<td >".$row['userid']."</td>";
											echo "<td >".$row['token']."</td>";
											echo "<td >".$row['title']."</td>"; 
											echo "<td>".$row['callback']."</td>";
											echo "<td >".$row['addtime']."</td>";
											echo "<td style='display: none;'>".$row['state']."</td>";
											echo "<td >".$states."</td>";
                                           echo "<td >".$row['in_all']."</td>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_qcback.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_qcback.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_qcback.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_qcback.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_qcback.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_qcback.php?page='.$last.$link.'">尾页</a></li>';
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
                                               <h5 class="modal-title" id="exampleModalLabel">编辑用户免签信息</h5>
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
                                                    <label>Token</label>
                                                    <div>
													<input type="text" class="form-control ca2"  readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>站点标题</label>
                                                    <div>
													<input type="text" class="form-control ca3" name="title"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>回调地址</label>
                                                    <div>
													<input type="text" class="form-control ca4" name="callback"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>添加时间</label>
                                                    <div>
													<input type="text" class="form-control ca5" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control ca6" name="state" id="state">
                                                    <option value="0" >禁止</option> 
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
                                                    <label>站点标题:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="ids" readonly="readonly" style="display: none;"/>
													  <input type="text" class="form-control ca3" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>站点链接:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca4"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="shanchul"  value="提交" class="btn btn-danger waves-effect" >
                                                            确认删除授权
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                           </div><!-- /.modal-content -->
                                       </div><!-- /.modal-dialog -->
                                   </div><!-- /.modal -->	
								   <div class="modal fade bs-example-modal-center"   id="tianjia" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">添加用户信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>用户账号:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="useridt" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>站点标题</label>
                                                    <div>
													<input type="text" class="form-control" name="titlet"/>
                                                    </div>
                                                </div>
												<div class="form-group" >
                                                    <label>回调地址</label>
                                                    <div>
													<input type="text" class="form-control" name="callbackt" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control" name="statet" id="statet">
                                                    <option value="1" >正常</option>
                                                    <option value="0" >禁止</option>  
                                                    </select>
                                                    </div>
                                                </div>
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="tianjias"  value="提交" class="btn btn-primary waves-effect waves-light" >
                                                            提交
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
	function zdy(type,val){
    var fl  = $("#"+type+"_v");
	var flt  = $("#"+type+"_v");
    if(val == 0){
       $(fl). hide()
	   $(flt). hide()
    }
    if(val == 1){
       $(fl).show()
	   $(flt).show()
    }        
}	
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
	  var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content); 

	 
});
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(4).text();
      modal.find('.ca4').val(content); 
	 
});
                        $("#xiugai").click(function () {
						var id=$("input[name='id']").val();
						var title=$("input[name='title']").val();
						var callback=$("input[name='callback']").val();  
						var state = $("#state").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_QCxiugai",
							data: {id:id,title:title,callback:callback,state:state},
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
							url: "ajax.php?act=edit_QCshanchu",
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
					$("#tianjias").click(function () {
						var userid=$("input[name='useridt']").val();
						var qq=$("input[name='qqt']").val();
						var url=$("input[name='urlt']").val();
						var callback=$("input[name='callbackt']").val();
						var state = $("#statet").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_QCtianjia",
							data: {userid:userid,title:title,url:url,callback:callback,state:state},
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