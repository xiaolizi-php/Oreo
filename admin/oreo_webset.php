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
                                                <li class="breadcrumb-item active">系统设置</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">系统设置</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">系统设置说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以设置授权系统的一些基本参数，请认真填写每一项！</p>
                                                <div class="form-group">
                                                   
                                                    <div class="form-group">
                                                    <label>站点名称</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="web_title"  placeholder="如：Oreo授权系统" value="<?php echo $conf['web_title'];?>" class="form-control"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>站点网址</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="local_domain"  placeholder="请不要加http://" value="<?php echo $conf['local_domain'];?>" class="form-control"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>设置管理员QQ</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="web_qq"   value="<?php echo $conf['web_qq']; ?>" class="form-control"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>备案信息</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="web_beian"   value="<?php echo $conf['web_beian']; ?>" class="form-control"/>
                                                    </div>
                                                </div>
												 <div class="form-group" >
                                                    <label>版权设置</label>
                                                    <div>
                                                       <textarea  name="web_copyright"  rows="4" class="form-control"><?php echo $conf['web_copyright'];?></textarea> 
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权商等级名称①</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="oreo_scname1"   value="<?php echo $conf['oreo_scname1']; ?>" class="form-control"/>
                                                    </div>
													<small>* 权限1到3依次增加，具体权限分配请到 权限及程序设置-配置授权商权限 目录里设置！</small>
                                                </div>
												<div class="form-group">
                                                    <label>授权商等级名称②</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="oreo_scname2"   value="<?php echo $conf['oreo_scname2']; ?>" class="form-control"/>
                                                    </div>
													<small>* 权限1到3依次增加，具体权限分配请到 权限及程序设置-配置授权商权限 目录里设置！</small>
                                                </div>
												<div class="form-group">
                                                    <label>平台最高用户权限③</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="oreo_scname3"   value="<?php echo $conf['oreo_scname3']; ?>" class="form-control"/>
                                                    </div>
													<small>* 权限1到3依次增加，具体权限分配请到 权限及程序设置-配置授权商权限 目录里设置！</small>
                                                </div>
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <div>
                                                         <button type="button" id="wzxx"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                            重置
                                                        </button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                    </div> <!-- content -->
                  <?php include'oreo_foot.php';?>
<script>
		 $("#wzxx").click(function () { 
						var web_title=$("input[name='web_title']").val(); 
						var local_domain=$("input[name='local_domain']").val(); 
						var web_qq=$("input[name='web_qq']").val();
						var web_beian=$("input[name='web_beian']").val();
						var web_copyright=$("textarea[name='web_copyright']").val(); 
						var oreo_scname1=$("input[name='oreo_scname1']").val();
						var oreo_scname2=$("input[name='oreo_scname2']").val();
						var oreo_scname3=$("input[name='oreo_scname3']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Wzxx",
							data: {web_title:web_title,local_domain:local_domain,web_qq:web_qq,web_beian:web_beian,web_copyright:web_copyright,oreo_scname1:oreo_scname1,oreo_scname2:oreo_scname2,oreo_scname3:oreo_scname3},
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