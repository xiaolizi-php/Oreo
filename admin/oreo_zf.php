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
                                                <li class="breadcrumb-item active">支付设置</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">支付设置</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">支付设置说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以设置授权系统支付相关参数，请认真填写每一项！</p>
                                                <div class="form-group">
                                                    
												<div class="form-group">
                                                    <label>是否开启在线充值</label>
                                                    <div>
                                                    <select  class="form-control" name="oreo_zxcz" id="oreo_zxcz">
                                                    <option value="0" <?=$conf['oreo_zxcz']==0?"selected":""?> >关闭</option>
                                                    <option value="1" <?=$conf['oreo_zxcz']==1?"selected":""?> >开启</option>          
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>支付订单名称</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="oreo_ordername"   value="<?php echo $conf['oreo_ordername']; ?>" class="form-control"/>
                                                    </div>
                                                </div>
												 <div class="form-group" >
                                                    <label>在线支付说明</label>
                                                    <div>
                                                       <textarea  name="oreo_zfsm"  rows="4" class="form-control"><?php echo $conf['oreo_zfsm'];?></textarea> 
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <div>
                                                         <button type="button" id="zxzfpz"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
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
		 $("#zxzfpz").click(function () {
			            var oreo_zxcz = $("#oreo_zxcz").val();	
						var oreo_ordername=$("input[name='oreo_ordername']").val();
						var oreo_zfsm=$("textarea[name='oreo_zfsm']").val(); 
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Zxzfpz",
							data: {oreo_zxcz:oreo_zxcz,oreo_ordername:oreo_ordername,oreo_zfsm:oreo_zfsm},
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