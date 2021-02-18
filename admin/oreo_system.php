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
                                                <li class="breadcrumb-item active">添加授权程序</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">添加授权程序</h4>
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
													<a data-toggle="modal" data-target="#tianjia" data-id="tianjia"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>添加程序</a>
												</div>
                                            </div><!-- end col-->
                        <div class="table-responsive">
                         <table class="table table-bordered text-nowrap">
                         <thead style="text-align: center;">
                      <tr>
                                <th>ID</th>
                                <th>名称</th>
                                <th>状态</th>
								<th>程序验证码</th>
								<th>单程序授权</th>
								<th>操作</th>
								<th style="display: none">0</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
<?php
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_authsys WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_authsys WHERE{$sql} order by id desc limit $offset,$pagesize");
                                      while($row = $list->fetch())
                                      {
											if($row['type']==1){
											$typ='<a style="color: blue;">开启</a>';
											}else{$typ='<a style="color: red;">关闭</a>';}
											echo "<tr >";
											echo "<td >".$row['id']."</td>";
											echo "<td >".$row['name']."</td>";
											echo "<td >".$typ."</td>";
											echo "<td style='display: none;'>".$row['type']."</td>";
											echo "<td >".$row['syskeys']."</td>";
											echo "<td >".$row['money']."</td>";
											echo "<td ><a data-toggle='modal' data-target='#bianji' data-id='bianji' class='btn btn-xs btn-info'>编辑</a>&nbsp;<a data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-xs btn-danger' >删除</a></td>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_system.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_system.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_system.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_system.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_system.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_system.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">尾页</a></li>';
}
echo'</ul>';
#分页
?>
                                                </nav>
                                    </div>
                                </div> <!-- end col -->
                           </div> <!-- end row -->
                        </div><!-- container -->
						<div class="modal fade bs-example-modal-center"   id="bianji" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">编辑系统信息</h5>
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
                                                    <label>程序验证码:</label>
                                                    <div>
													 <input type="text" class="form-control ca4" name="syskeys"  readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>单程序授权:</label>
                                                    <div>
													 <input type="text" class="form-control ca5" name="money"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control ca3" name="type" id="type">
                                                    <option value="0" >关闭</option>
                                                    <option value="1" >开启</option>  
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
                                                   <div class="form-group" style="display: none">
                                                    <label>ID:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="ids" readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca1"  readonly="readonly"  />
													   <input type="text" class="form-control ca4"  readonly="readonly" name="syskeysdelt"  style="display: none"/>
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
                                               <h5 class="modal-title" id="exampleModalLabel">添加系统信息</h5>
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
                                                    <label>程序验证码</label><input class="btn btn-success waves-effect waves-light" style="padding: inherit;" type= "button" name= "Submit1" value= "生成" onclick= "keys()">
                                                    <div>
													<input type="text" class="form-control ca6" id="syskeyt1" name="syskeyst" />
													 <script language="javascript"> 
						                            function keys() 
						                             { 
						                            var str= "0123456789abcdefghijklmnopqrstuvwxyz" 
						                            var result= " " 
						                            for(var i=0;i <32;i++) 
						                             { 
						                            var temp=Math.floor(Math.random()*36) 
						                            result+=str.charAt(temp) 
						                             } 
						                            hash = result.MD5();
						                            document.getElementById("syskeyt1").value=hash;
						                              } 
					                                 </script>
                                                    </div>
                                                </div>	
												<div class="form-group">
                                                    <label>单程序授权:</label>
                                                    <div>
													 <input type="text" class="form-control ca5" name="moneyt"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control " name="typet" id="typet">
                                                    <option value="0" >关闭</option>
                                                    <option value="1" >开启</option>  
                                                    </select>
                                                    </div>
                                                </div>
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="qrtianjia"  value="提交" class="btn btn-primary waves-effect waves-light" >
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
                <script src="../assets/admin/js/md5.js"></script>
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
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content);
	  var content = btnThis.closest('tr').find('td').eq(4).text();
      modal.find('.ca4').val(content);
	
});
 $('#qxpz').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content);
	
});
                        $("#xiugai").click(function () {
						var id=$("input[name='id']").val();
						var name=$("input[name='name']").val();
						var money=$("input[name='money']").val();
						var type = $("#type").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Xcxxg",
							data: {id:id,name:name,money:money,type:type},
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
						var syskeys=$("input[name='syskeysdelt']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_XcxShanchu",
							data: {ids:ids,syskeys:syskeys},
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
					$("#qrtianjia").click(function () {
						var namet=$("input[name='namet']").val();
						var syskeyst=$("input[name='syskeyst']").val();
						var moneyt=$("input[name='moneyt']").val();
						var typet = $("#typet").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Xcxtj",
							data: {namet:namet,syskeyst:syskeyst,moneyt:moneyt,typet:typet},
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