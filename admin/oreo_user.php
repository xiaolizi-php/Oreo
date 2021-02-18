<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
$authsys=$DB->query("SELECT * FROM `oreo_authsys` ")->fetch();
if(!$authsys){ exit("<script language='javascript'>alert('您还未添加授权程序，为了不影响程序功能，请先添加您的程序');window.location.href='./oreo_system.php';</script>");}
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
                                                <li class="breadcrumb-item active">添加/管理用户</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">添加/管理用户</h4>
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
                                                <form class="form-inline" method="post" action="oreo_user.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search"  name="my" class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="id">账号</option>
                                                            <option value="names">名称</option>
                                                            <option value="qq">用户QQ</option>
															<option value="sjid">上级账号</option>
                                                            <option value="beta">内测权限</option>
                                                        </select>
                                                    </div>                       
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <button type="submit" name="submit" class="btn btn-secondary  mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>搜索</button>
													<a data-toggle="modal" data-target="#tianjia" data-id="tianjia"class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>添加用户</a>
												</div>
                                            </div><!-- end col-->
                                        </div>
</form>
										<div class="table-responsive">
                                            <table class="table table-bordered text-nowrap">
                                                <thead>
                                                <tr>
                                                <th>账号</th>
								<th>名称</th>
                                <th>QQ号码</th>
                                <th>邮箱</th>
                                <th>等级</th>
								<th>上级</th>
								<th>状态</th>
								<th style="display: none;">状态</th>
								<th style="display: none;">状态</th>
								<th>余额</th>
								<th>内测权限</th>
								<th style="display: none;">状态</th>
								<th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
if(isset($_POST['submit'])) {
if($_POST['my']==''){
	$_POST['my']=1;
}
	if($_POST['column']=='name'){
		$sql="`{$_POST['column']}` like '%{$_POST['my']}%'";
	}else{
		$sql="`{$_POST['column']}`='{$_POST['my']}'";
	}
}else{
	$sql=" 1";
	$numrows=$DB->query("SELECT count(*) from oreo_user WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_user WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{
	                                       if($row['action']==1){
											$sqsaction="<a style='color: green;'>正常</a>";}
											else{
											$sqsaction="<a style='color: red;'>封禁</a>";}
											if($row['beta']==1){
											$beta="<a style='color: green;'>内测用户</a>";}
											else{
											$beta="<a style='color: red;'>无权</a>";}
                                            echo '<tr >
											 <td >'.$row['id'].'</td>
											 <td >'.$row['names'].'</td>
											 <td >'.$row['qq'].'</td>
											 <td >'.$row['email'].'</td>
											 <td >'.$row['grade_name'].'</td>
											 <td >'.$row['sjname'].'</td>
											 <td >'.$sqsaction.'</td>
											 <td style="display: none;">'.$row['action'].'</td>
											 <td style="display: none;">'.$row['password'].'</td>
											 <td >'.$row['money'].'</td>
											 <td style="display: none;">'.$row['beta'].'</td>
                                             <td >'.$beta.'</td>
                                             <td >
                                             <form target="_blank"  id="'.$res['id'].'" name="'.$res['id'].'" action="../user/login.php" method="POST" >
                                             <input type="hidden" name="user" value="'.$row['id'].'"/>
                                             <input type="hidden" name="admin_pass" value="'.$row['password'].'"/>
                                             <button type="submit" class="btn btn-xs btn-info">登录</button>&nbsp;
                                             <a data-toggle="modal" data-target="#bianji" data-id="bianji" class="btn btn-xs btn-info">编辑</a>&nbsp;&nbsp;<a data-toggle="modal" data-target="#shanchu" data-id="shanchu" class="btn btn-xs btn-danger" >删除</a>&nbsp;&nbsp;<a data-toggle="modal" data-target="#ycquanx" data-id="ycquanx" class="btn btn-warning waves-effect waves-light" >移除权限</a></form></td>
											 </tr>';
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
echo '<li class="page-item"><a class="page-link" href="oreo_user.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_user.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_user.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_user.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_user.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_user.php?page='.$last.$link.'">尾页</a></li>';
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
                                               <h5 class="modal-title" id="exampleModalLabel">编辑用户信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>用户名:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="id" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>名称</label>
                                                    <div>
													<input type="text" class="form-control ca1" name="names"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>QQ号码</label>
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
                                                    <label>余额</label>
                                                    <div>
													<input type="text" class="form-control ca9" name="money"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>登录密码</label>
                                                    <div>
													<input type="password" class="form-control ca8" name="password"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control ca7" name="action" id="action">
                                                    <option value="1" >正常</option>
                                                    <option value="0" >封禁</option>  
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>内测权限</label>
                                                    <div>
                                                    <select class="form-control ca10" name="beta" id="beta">
                                                    <option value="0" >无权</option> 
                                                    <option value="1" >内测用户</option>													
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
                                                    <label>账户:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="ids" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca1"  readonly="readonly"  />
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
                                                    <label>名称:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="namez" />
                                                    </div>
                                                </div>
												 <div class="form-group">
                                                    <label>登录账号:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="idz" placeholder="不能为中文或特殊字符" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>QQ号码</label>
                                                    <div>
													<input type="text" class="form-control" name="qqz"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>邮箱</label>
                                                    <div>
													<input type="text" class="form-control" name="emailz"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>余额</label>
                                                    <div>
													<input type="text" class="form-control" name="moneyz"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>登录密码</label>
                                                    <div>
													<input type="password" class="form-control" name="passwordz"/>
                                                    </div>
                                                </div>
												<div class="form-group" >
                                                    <label>上级</label>
                                                    <div>
													<input type="text" class="form-control" name="sjidz" placeholder="用户账号，若无请留空" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control" name="actionz" id="actionz">
                                                    <option value="1" >正常</option>
                                                    <option value="0" >封禁</option>  
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>内测权限</label>
                                                    <div>
                                                    <select class="form-control ca7" name="betaz" id="betaz">
                                                    <option value="0" >无权</option> 
                                                    <option value="1" >内测用户</option>													
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
                                     <div class="modal fade bs-example-modal-center"   id="ycquanx" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                                                    <label>账户:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="idq" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca1"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="ycqx"  value="提交" class="btn btn-danger waves-effect" >
                                                            确认移除所有授权
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
	 
});
 $('#ycquanx').on('show.bs.modal', function (event) {
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
						var names=$("input[name='names']").val();
						var qq=$("input[name='qq']").val();
						var email=$("input[name='email']").val();
						var money=$("input[name='money']").val();
						var password=$("input[name='password']").val(); 
						var action = $("#action").val();
						var beta = $("#beta").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Sqsxiugai",
							data: {id:id,names:names,qq:qq,email:email,money:money,password:password,action:action,beta:beta},
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
							url: "ajax.php?act=edit_Sqsshanchu",
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
					$("#ycqx").click(function () {
						var idq=$("input[name='idq']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Ycqx",
							data: {idq:idq},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('移除所有权限成功', function(index) {
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
						
						var namez=$("input[name='namez']").val();
						var idz=$("input[name='idz']").val();
						var qqz=$("input[name='qqz']").val();
						var emailz=$("input[name='emailz']").val();
						var moneyz=$("input[name='moneyz']").val();
						var passwordz=$("input[name='passwordz']").val();
						var sjidz=$("input[name='sjidz']").val();
						var actionz = $("#actionz").val();
						var betaz = $("#betaz").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Sqstianjia",
							data: {namez:namez,idz:idz,qqz:qqz,emailz:emailz,moneyz:moneyz,passwordz:passwordz,sjidz:sjidz,actionz:actionz,betaz:betaz},
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