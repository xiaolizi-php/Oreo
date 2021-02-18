<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
?>
                <div class="content-page">
                    <div class="content">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">控制台</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item active">站点管理</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">站点管理</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">站点信息修改</h4>
                                        <div class="alert alert-warning" role="alert">
                                        <i class="dripicons-warning mr-2"></i> <strong>警告</strong> 一下操作会直接影响您的网站的有关功能，如果您忘记您网站的后台账号安全信息可以再此栏目一键修改，请不要频繁修改!
                                        </div>
                                        <form>
                                            <div id="basicwizard">
                                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                                    <li class="nav-item">
                                                        <a href="#myinfo" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 show active"> 
                                                            <i> 修改账号</i>
                                                            <span class="d-none d-sm-inline"></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#myedit" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i> 修改密码</i>
                                                            <span class="d-none d-sm-inline"></span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a href="#newpass" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i> 修改安全码</i>
                                                            <span class="d-none d-sm-inline"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content b-0 mb-0">
                                                    <div class="tab-pane show active" id="myinfo">
                                                        <div class="row">
                                                        <div class="col-12">
                                                        <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">选择域名协议</label>
                                                                    <div class="col-md-9">
                                                                    <select class="form-control ca8"  id="xieyi_admin" name="xieyi_admin">
                                                                     <option value="1">http://</option>
                                                                     <option value="2">https://</option>
                                                                     </select>  
                                                                    </div>
                                                                </div>  
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">选择域名站点</label>
                                                                    <div class="col-md-9">
                                                                    <select class="form-control"  id="domain_admin" name="domain_admin">
                                                                   <?php
													                $sccs=$DB->query("SELECT * FROM `oreo_authorize`  WHERE sjid='$pid' ");
                                                                    while ($row = $sccs->fetch()) {
						                                            echo "<option value={$row['domain']}>{$row['domain']}</option>"; }?>
                                                                   </select>
                                                                    </div>
                                                                </div>    
                                                             <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name">输入新账号</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="newadmin" class="form-control" placeholder="输入新账号">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">再次输入新账号</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="lastadmin" class="form-control" placeholder="再次输入新账号">
                                                                    </div>
                                                                </div>   
                                                               <button type="button" id="edit_admin" class="btn btn-primary">修改</button>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
                                                    <div class="tab-pane" id="myedit">
                                                        <div class="row">
                                                        <div class="col-12">
                                                        <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">选择域名协议</label>
                                                                    <div class="col-md-9">
                                                                    <select class="form-control ca8"  id="xieyi_pass" name="xieyi_pass">
                                                                     <option value="1">http://</option>
                                                                     <option value="2">https://</option>
                                                                     </select>  
                                                                    </div>
                                                                </div>  
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">选择域名站点</label>
                                                                    <div class="col-md-9">
                                                                    <select class="form-control"  id="domain_pass" name="domain_pass">
                                                                   <?php
													                $sccs=$DB->query("SELECT * FROM `oreo_authorize`  WHERE sjid='$pid' ");
                                                                    while ($row = $sccs->fetch()) {
						                                            echo "<option value={$row['domain']}>{$row['domain']}</option>"; }?>
                                                                   </select>
                                                                    </div>
                                                                </div>    
                                                             <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name">输入新密码</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="newpassword" class="form-control" placeholder="输入新密码">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">再次输入新密码</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="lastpassword" class="form-control" placeholder="再次输入新密码">
                                                                    </div>
                                                                </div>   
                                                               <button type="button" id="edit_pass" class="btn btn-primary">修改</button>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
													<div class="tab-pane" id="newpass">
                                                        <div class="row">
                                                            <div class="col-12">
                                                            <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">选择域名协议</label>
                                                                    <div class="col-md-9">
                                                                    <select class="form-control ca8"  id="xieyi_safe_code" name="xieyi_safe_code">
                                                                     <option value="1">http://</option>
                                                                     <option value="2">https://</option>
                                                                     </select>  
                                                                    </div>
                                                                </div>  
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">选择域名站点</label>
                                                                    <div class="col-md-9">
                                                                    <select class="form-control"  id="domain_safe_code" name="domain_safe_code">
                                                                   <?php
													                $sccs=$DB->query("SELECT * FROM `oreo_authorize`  WHERE sjid='$pid' ");
                                                                    while ($row = $sccs->fetch()) {
						                                            echo "<option value={$row['domain']}>{$row['domain']}</option>"; }?>
                                                                   </select>
                                                                    </div>
                                                                </div>    
                                                             <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name">输入新安全码</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="new_safe_code" class="form-control" placeholder="输入新安全码">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">再次输入新安全码</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="last_safe_code" class="form-control" placeholder="再次输入新安全码">
                                                                    </div>
                                                                </div>   
                                                               <button type="button" id="edit_safe_code" class="btn btn-primary">修改</button>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
                                                </div> <!-- tab-content -->
                                            </div> <!-- end #basicwizard-->
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
						
                        </div>
                        <!-- end row -->
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
        $("#edit_admin").click(function () {
                        var domain = $("#domain_admin").val();
                        var xieyi = $("#xieyi_admin").val();
						var newadmin = $("input[name='newadmin']").val();						
                        var lastadmin = $("input[name='lastadmin']").val();			
						if (newadmin == '' || lastadmin == '') {
							layer.alert('请确保各项不能为空！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Oreo_My_Web_admin",
							data: {domain:domain,xieyi:xieyi,newadmin:newadmin,lastadmin:lastadmin},
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
                    $("#edit_pass").click(function () {
                        var domain = $("#domain_pass").val();
                        var xieyi = $("#xieyi_pass").val();
						var newpassword = $("input[name='newpassword']").val();						
                        var lastpassword = $("input[name='lastpassword']").val();			
						if (newpassword == '' || lastpassword == '') {
							layer.alert('请确保各项不能为空！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Oreo_My_Web_Pass",
							data: {domain:domain,xieyi:xieyi,newpassword:newpassword,lastpassword:lastpassword},
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
                    $("#edit_safe_code").click(function () {
                        var domain = $("#domain_safe_code").val();
                        var xieyi = $("#xieyi_safe_code").val();
						var new_safe_code = $("input[name='new_safe_code']").val();						
                        var last_safe_code = $("input[name='last_safe_code']").val();			
						if (new_safe_code == '' || last_safe_code == '') {
							layer.alert('请确保各项不能为空！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Oreo_My_Web_safe_code",
							data: {domain:domain,xieyi:xieyi,new_safe_code:new_safe_code,last_safe_code:last_safe_code},
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