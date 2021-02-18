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
                                                <li class="breadcrumb-item"><a href="#">Oreo产品管理</a></li>
                                                <li class="breadcrumb-item active">失信管理和添加</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">失信管理和添加</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">失信管理和添加说明</h4>
                                            <p class="text-muted m-b-30 font-14">您可以在此页面修改或删除失信人员数据: <code style="font-size:20px">删除用户直接影响用户账号功能</code>. </p>
                                         <div class="col-lg-4">
                                                <div class="text-lg-left">
												<a data-toggle="modal" data-target="#tianjia" data-id="tianjia"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>添加失信人员</a>
												</div>
                                            </div><!-- end col-->
                      <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;"> 
                      <tr>
                                <th style="display: none">id</th>
                                <th>名称</th>
                                <th>QQ</th>
                                <th>邮箱</th>
                                <th>网址</th>
                                <th>举报类型</th>
								<th>失信理由</th>
								<th>入库时间</th>
								<th>状态</th>
								<th>举报者QQ</th>
								 <th style="display: none">id</th>
                                <th>操作</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
<?php                                                            
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_hmd WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_hmd WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{
                                        if($row['type']==1){
										$hmdzt='<a class="btn btn-xs btn-danger" >黑名单</a>';
										}else{
										$hmdzt='<a class="btn btn-xs btn-info" >已解除</a>';	
										}
											echo "<tr >";
											echo "<td style='display: none;'>".$row['id']."</td>";
											echo "<td >".$row['name']."</td>";
											echo "<td >".$row['qq']."</td>";
											echo "<td >".$row['email']."</td>";
											echo "<td >".$row['url']."</td>";
											echo "<td >".$row['jblx']."</td>";
											echo "<td >".$row['hmdly']."</td>";
											echo "<td ><span class='label label-success'>".date("Y-m-d",$row['time'])."</span></td>";
											echo "<td >".$hmdzt."</td>";
											echo "<td style='display: none;'>".$row['type']."</td>";
											echo "<td >".$row['jbzqq']."</td>";
											echo "<td >
												<a data-toggle='modal' data-target='#bianji' data-id='bianji' class='btn btn-xs btn-info'>编辑</a>   <a data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-xs btn-danger' >删除</a>
											</td>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_hmd.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_hmd.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_hmd.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_hmd.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_hmd.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_hmd.php?page='.$last.$link.'">尾页</a></li>';
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
                                               <h5 class="modal-title" id="exampleModalLabel">编辑失信信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
													 <input type="text" class="form-control ca0" name="id" style="display: none"/>
                                                      <input type="text" class="form-control ca1" name="name" />
                                                    </div>
                                                </div>
												
												<div class="form-group">
                                                    <label>QQ</label>
                                                    <div>
													<input type="text" class="form-control ca2" name="qq"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>邮箱</label>
                                                    <div>
													<input type="text" class="form-control ca3" name="email"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>网址</label>
                                                    <div>
													<input type="text" class="form-control ca4" name="url"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>举报类型</label>
                                                    <div>
													<input type="text" class="form-control ca5" name="jblx"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>失信理由</label>
                                                    <div>
                                                       <textarea  name="hmdly"  rows="3" class="form-control ca6"></textarea> 
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>入库时间</label>
                                                    <div>
													<input class="form-control ca7" type="date" id="example-date-input" name="time">
                                                    </div>
                                                </div>	
												<div class="form-group">
                                                    <label>举报者QQ</label>
                                                    <div>
													<input type="text" class="form-control ca10" name="jbzqq"/>	
                                                    </div>
                                                </div>	
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control ca9" name="type" id="type">
                                                    <option value="0" >已解除</option>
                                                    <option value="1" >黑名单</option>  
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
                                                    <label>名称:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="ids" style="display: none"  />
													  <input type="text" class="form-control ca1"   readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca8"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="shanchul"  value="提交" class="btn btn-danger waves-effect" >
                                                            确认删除名单
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
                                               <h5 class="modal-title" id="exampleModalLabel">添加失信信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="namet" />
                                                    </div>
                                                </div>
												
												<div class="form-group">
                                                    <label>QQ</label>
                                                    <div>
													<input type="text" class="form-control" name="qqt"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>邮箱</label>
                                                    <div>
													<input type="text" class="form-control" name="emailt"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>网址</label>
                                                    <div>
													<input type="text" class="form-control" name="urlt"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>举报类型</label>
                                                    <div>
													<input type="text" class="form-control" name="jblxt"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>失信理由</label>
                                                    <div>
                                                       <textarea  name="hmdlyt"  rows="3" class="form-control"></textarea> 
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>入库时间</label>
                                                    <div>
													<input class="form-control" type="date" id="example-date-input" name="timet">
                                                    </div>
                                                </div>	
												<div class="form-group">
                                                    <label>举报者QQ</label>
                                                    <div>
													<input type="text" class="form-control" name="jbzqqt"/>	
                                                    </div>
                                                </div>	
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control" name="typet" id="typet">
                                                    <option value="0" >已解除</option>
                                                    <option value="1" >黑名单</option>  
                                                    </select>
                                                    </div>
                                                </div>
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="xtianjia"  value="提交" class="btn btn-primary waves-effect waves-light" >
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
	  var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content);
	  var content = btnThis.closest('tr').find('td').eq(10).text();
      modal.find('.ca10').val(content);
	 
});
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content);
	  var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content);
	 
});
                         $("#xiugai").click(function () {
						var id=$("input[name='id']").val();
						var name=$("input[name='name']").val();
						var qq=$("input[name='qq']").val();
						var email=$("input[name='email']").val();
						var url=$("input[name='url']").val();
						var jblx=$("input[name='jblx']").val();  
						var hmdly=$("textarea[name='hmdly']").val(); 
						var time=$("input[name='time']").val();
						var jbzqq=$("input[name='jbzqq']").val();
						var type = $("#type").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Hmdxiugai",
							data: {id:id,name:name,qq:qq,email:email,url:url,jblx:jblx,hmdly:hmdly,time:time,jbzqq:jbzqq,type:type},
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
							url: "ajax.php?act=edit_Xsshanchu",
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
					$("#xtianjia").click(function () {
						var namet=$("input[name='namet']").val();
						var qqt=$("input[name='qqt']").val();
						var emailt=$("input[name='emailt']").val();
						var urlt=$("input[name='urlt']").val();
						var jblxt=$("input[name='jblxt']").val();  
						var hmdlyt=$("textarea[name='hmdlyt']").val(); 
						var timet=$("input[name='timet']").val();
						var jbzqqt=$("input[name='jbzqqt']").val();
						var typet = $("#typet").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Hmdtianjia",
							data: {namet:namet,qqt:qqt,emailt:emailt,urlt:urlt,jblxt:jblxt,hmdlyt:hmdlyt,timet:timet,jbzqqt:jbzqqt,typet:typet},
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