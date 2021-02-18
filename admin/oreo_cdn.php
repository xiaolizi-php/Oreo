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
                                                <li class="breadcrumb-item active">静态资源链接</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">更改或添加静态资源链接</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">更改或添加静态资源链接说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以设置您被授权系统的静态资源链接，请确保您的链接可用！</p>
                                                <div class="form-group">
                                                   
                                                    <div class="form-group">
                                                    <label>目前链接为：</label>
                                                    <div>
                                                      <input type="text" class="form-control"   value="<?php echo  $conf['oreo_cdn']; ?>" class="form-control" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>更改链接</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="oreo_cdn"  placeholder="请输入完整的链接"  class="form-control"/>
                                                       <small> * 请确保您的链接可用.</small>
													</div>
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <div>
                                                         <button type="button" id="cdnurl"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
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
		 $("#cdnurl").click(function () {
						var oreo_cdn=$("input[name='oreo_cdn']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Cdnurl",
							data: {oreo_cdn:oreo_cdn},
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