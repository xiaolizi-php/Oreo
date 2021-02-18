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
                                                <li class="breadcrumb-item"><a href="#">系统参数</a></li>
                                                <li class="breadcrumb-item active">管理员账号配置</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">管理员账号配置</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">管理员账号配置说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以设置您的登录账号和密码！</p>
                                                <div class="form-group">
												 <div class="form-group" >
                                                    <label>管理员账号</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="admin_user" value="<?php echo $conf['admin_user']; ?>" class="form-control" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>新密码</label>
                                                    <div>
                                                      <input type="password" class="form-control" name="admin_pwd" class="form-control"/>
                                                    </div>
                                                </div>
												 <div class="form-group">
                                                    <label>确认密码</label>
                                                    <div>
                                                      <input type="password" class="form-control" name="rpassword" class="form-control"/>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <div>
                                                         <button type="button" id="adpass"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                    </div> <!-- content -->
                 <?php include'oreo_foot.php';?>
		<script>
		 $("#adpass").click(function () {
						var admin_user=$("input[name='admin_user']").val();
						var admin_pwd=$("input[name='admin_pwd']").val();
						var rpassword=$("input[name='rpassword']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Adpass",
							data: {admin_user:admin_user,admin_pwd:admin_pwd,rpassword:rpassword},
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
</script>
</body>
</html>