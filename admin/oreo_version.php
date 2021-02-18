<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
if(isset($_POST['submit'])) {
$authid=daddslashes(strip_tags($_POST['authidt']));
$name=daddslashes(strip_tags($_POST['namet']));
$content = base64_encode($_POST['contentt']);
$beta=daddslashes(strip_tags($_POST['betat']));
$filesize=$_FILES['file3']['size'];
$file3=$_FILES['file3']['name'];
if($filesize>9999999999){
echo "<script language='javascript'>alert('超出最大限制');window.location.href='./oreo_version.php';</script>";
exit();	
}else{
$path = '../oreoupdatafilesxcas/'. $_FILES['file3']['name'];
if (move_uploaded_file($_FILES['file3']['tmp_name'],$path)) { 
    $cxyh=$DB->query("SELECT * FROM `oreo_authsys` WHERE id='$authid' limit 1")->fetch();
	$sds=$DB->exec("INSERT INTO `oreo_version` (`authid`, `name`, `content`, `file`, `authname`, `beta`) VALUES ('{$cxyh['syskeys']}', '$name', '{$content}', '{$file3}', '{$cxyh['name']}', '{$beta}')");
	
	if($sds=true){ 
	echo "上传成功!!";
	echo "<script language='javascript'>alert('文件上传成功，并成功添加数据库');window.location.href='./oreo_version.php';</script>";
	}else{echo "<script language='javascript'>alert('文件上传失败！');window.location.href='./oreo_version.php';</script>";
          exit();}
}}

	    
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
                                                <li class="breadcrumb-item"><a href="#">安全配置</a></li>
                                                <li class="breadcrumb-item active">版本管理</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">版本管理</h4>
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
												<a data-toggle="modal" data-target="#tianjia" data-id="tianjia"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>添加更新</a>
												</div>
                                            </div><!-- end col-->
                                        <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;">
                                   <tr>
                                <th>版本号</th>
                                <th>更新内容</th>
                                <th>文件名</th>
								<th>更新的系统</th>
								<th>是否内测版</th>
                                <th>操作</th>
								<th style="display: none">id</th> 
								</tr>
          </thead>
          <tbody style="text-align: center;">

 									<?php 
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_version WHERE{$sql}")->fetchColumn();
$link='&my=search&column='.$_POST['column'].'&value='.$_POST['my'];										
$pagesize=5;
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
$list=$DB->query("SELECT * FROM oreo_version WHERE{$sql} order by id desc limit $offset,$pagesize");
                                      while($row = $list->fetch())
                                      {    if($row['beta']==1){
											$beta="<a style='color: red;'>内测版</a>";}
											else{$beta="<a style='color: green;'>公开版</a>";}
											echo "<tr class='gradeX'>";
											echo "<td >".$row['name']."</td>";
											echo "<td row='6'>".base64_decode($row['content'])."</td>";
											echo "<td >".$row['file']."</td>";
											echo "<td style='display: none;'>".$row['id']."</td>";
											echo "<td >".$row['authname']."</td>";
											echo "<td style='display: none;'>".$row['beta']."</td>";
											echo "<td >".$beta."</td>";
											echo "<td >
											<a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#bianji' data-id='bianji'><i class='fa fa-edit'></i></a>   <a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#shanchu' data-id='shanchu' ><i class='fa fa-ban'></i></a>
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
echo '<li class="page-item"><a class="page-link" href="oreo_version.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_version.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_version.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_version.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_version.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_version.php?page='.$last.$link.'">尾页</a></li>';
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
                                               <h5 class="modal-title" id="exampleModalLabel">编辑版本信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>版本号:</label>
                                                    <div>
													<input type="text" class="form-control ca3" name="id" style="display: none"/>
                                                    <input type="text" class="form-control ca0"  placeholder="如：1.1"  name="name" value="<?php echo $name?>"  class="form-control" />
                                                    </div>
                                                </div>
												
												<div class="form-group">
                                                    <label>更新内容</label>
                                                    <div>
													<textarea  placeholder="填写内容，可使用HTML代码" name="content" rows="5" class="form-control ca1"><?php echo $content?></textarea>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>文件名</label>
                                                    <div>
													 <input type="text" class="form-control ca2"  placeholder="如：2.1.zip" name="file"  value="<?php echo $file?>" readonly="readonly" />
                                                    </div>
													<small>*如需重新上传请删除后重新添加版本</small>
                                                </div>
												<div class="form-group">
                                                    <label>更新的系统</label>
                                                    <div>
													 <input type="text" class="form-control ca4"  placeholder="如：2.1.zip" name="file"  readonly="readonly"   />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>是否内测版</label>
                                                    <div>
                                                    <select class="form-control ca5" name="beta" id="beta">
                                                    <option value="0" >否</option>
                                                    <option value="1" >是</option>  
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
                                                    <label>版本号:</label>
                                                    <div>
													 <input type="text" class="form-control ca3" name="ids" style="display: none"/>
                                                      <input type="text" class="form-control ca0"  readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="shanchul"  value="提交" class="btn btn-danger waves-effect" >
                                                            确认删除版
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
                                               <h5 class="modal-title" id="exampleModalLabel">添加更新信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
												  <form action="./oreo_version.php" name="form1" method="post" enctype="multipart/form-data">
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>选择更新的系统</label>
                                                    <div>
                                                    <select class="form-control ca9" name="authidt" id="authidt">
													<?php
													$rs=$DB->query("SELECT * FROM oreo_authsys "); 
													while($row = $rs->fetch()){
						                            
						                            echo "<option value={$row['id']}>{$row['name']}</option>";
						                               
	                                                 }
					                                  ?>
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>版本号:</label>
                                                    <div>
                                                      <input type="text" class="form-control"  placeholder="如：1.1"  name="namet"   class="form-control" />
                                                    </div>
                                                </div>
												 <div class="form-group">
												  <label>更新内容</label>
                                                    <div>
                                                       <textarea  placeholder="填写内容，可使用HTML代码" name="contentt" rows="5" class="form-control"><?php echo $content?></textarea>
                                                       </div>
                                                    </div>
                                                <div class="form-group">
                                                    <label  for="file">文件/zip包</label>
                                                    <div>
                                                        <input type="file" class="form-control" placeholder="如：2.1.zip" name="file3"  id="file3"  />
                                                    </div>
													<small>*强烈建议上传文件名不要中文！</small>
                                                </div>
												<div class="form-group">
                                                    <label>是否内测版</label>
                                                    <div>
                                                    <select class="form-control" name="betat" id="betat">
                                                    <option value="0" >否</option>
                                                    <option value="1" >是</option>  
                                                    </select>
                                                    </div>
                                                </div>
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="submit" name="submit"  value="提交" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                    </div>
                                                </div>
												</form>
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

	 
});
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	 
});

                        $("#xiugai").click(function () {
						var id=$("input[name='id']").val();
						var name=$("input[name='name']").val();
					    var content=$("textarea[name='content']").val(); 
						var file=$("input[name='file']").val();
						var beta = $("#beta").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Gxxiugai",
							data: {id:id,name:name,content:content,file:file,beta:beta},
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
							url: "ajax.php?act=edit_Gxshanchu",
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
					
					$("#version").click(function () {
			            var authid = $("#authidt").val(); 
			            var name=$("input[name='namet']").val();
					    var content=$("textarea[name='contentt']").val(); 
						var file=$("input[name='filet']").val();
						var betat = $("#betat").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Version",
							data: {authid:authid,name:name,content:content,file:file,betat:betat},
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
				
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>
    </body>
</html>