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
                                                <li class="breadcrumb-item active">公告管理</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">公告管理</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">公告管理说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以添加系统公告！</p>
												 <div class="form-group">
												  <label>公告①内容</label>
                                                    <div>
                                                       <textarea  placeholder="填写内容，可使用HTML代码" name="oreo_gg1" rows="5" class="form-control"><?php echo $conf['oreo_gg1'];?></textarea>
                                                       </div>
                                                    </div></br>
												 <div class="form-group">
												  <label>公告②内容</label>
                                                    <div>
                                                       <textarea  placeholder="填写内容，可使用HTML代码" name="oreo_gg2" rows="5" class="form-control"><?php echo $conf['oreo_gg2'];?></textarea>
                                                       </div>
                                                    </div></br>
												 <div class="form-group">
												  <label>公告③内容</label>
                                                    <div>
                                                       <textarea  placeholder="填写内容，可使用HTML代码" name="oreo_gg3" rows="5" class="form-control"><?php echo $conf['oreo_gg3'];?></textarea>
                                                       </div>
                                                    </div></br>
												 <div class="form-group">
												  <label>公告④内容</label>
                                                    <div>
                                                       <textarea  placeholder="填写内容，可使用HTML代码" name="oreo_gg4" rows="5" class="form-control"><?php echo $conf['oreo_gg4'];?></textarea>
                                                       </div>
                                                    </div>
                                                <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="gonggao"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
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
                <?php include'oreo_foot.php';?>
<script>
		 $("#gonggao").click(function () {
			            var oreo_gg1=$("textarea[name='oreo_gg1']").val();
						var oreo_gg2=$("textarea[name='oreo_gg2']").val();
						var oreo_gg3=$("textarea[name='oreo_gg3']").val();
						var oreo_gg4=$("textarea[name='oreo_gg4']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Gonggao",
							data: {oreo_gg1:oreo_gg1,oreo_gg2:oreo_gg2,oreo_gg3:oreo_gg3,oreo_gg4:oreo_gg4},
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