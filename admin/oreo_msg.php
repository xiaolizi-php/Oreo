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
                                                <li class="breadcrumb-item active">更新授权提示</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">更新授权提示</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">更新授权提示说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以设置授权后的客户端提示消息！</p>
                                                <div class="form-group">
												 <div class="form-group" >
                                                    <label>未授权提示：</label>
                                                    <div>
                                                       <textarea  name="message_1"  rows="4" class="form-control"><?php echo $conf['message_1'];?></textarea> 
                                                    </div>
                                                </div>
												 <div class="form-group" >
                                                    <label>IP不正确错误提示：</label>
                                                    <div>
                                                       <textarea  name="message_3"  rows="4" class="form-control"><?php echo $conf['message_3'];?></textarea> 
                                                    </div>
                                                </div>
												 <div class="form-group" >
                                                    <label>到期提示：</label>
                                                    <div>
                                                       <textarea  name="message_2"  rows="4" class="form-control"><?php echo $conf['message_2'];?></textarea> 
                                                    </div>
                                                </div>
												<div class="form-group" >
                                                    <label>不是授权的系统提示：</label>
                                                    <div>
                                                       <textarea  name="message_4"  rows="4" class="form-control"><?php echo $conf['message_4'];?></textarea> 
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <div>
                                                         <button type="button" id="oreomsg"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
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
		 $("#oreomsg").click(function () {
						var message_1=$("textarea[name='message_1']").val(); 
						var message_3=$("textarea[name='message_3']").val(); 
						var message_2=$("textarea[name='message_2']").val(); 
						var message_4=$("textarea[name='message_4']").val(); 
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Oreomsg",
							data: {message_1:message_1,message_3:message_3,message_2:message_2,message_4:message_4},
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
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}  
</script>
    </body>
</html>