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
                                                <li class="breadcrumb-item active">在线授权设置</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">在线授权设置</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">在线授权设置说明</h4>
                                            <p class="text-muted m-b-30 font-14">以下设置只针对用户前台功能，您的每次修改对平台所有授权域名有影响，若要给单独一个用户设置请到-授权管理/添加 里面单独设置！</p>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                    <label>是否开启授权验证IP</label>
                                                    <div>
                                                    <select  class="form-control" name="oreo_ipyz" id="oreo_ipyz">
                                                    <option value="0"  <?=$conf['oreo_ipyz']==0?"selected":""?> >关闭</option>
                                                    <option value="1"  <?=$conf['oreo_ipyz']==1?"selected":""?> >开启</option>          
                                                    </select>
                                                    </div>
													<small>* 如果设置为开启 请把下面选项设置为 域名IP双重验证</small>
                                                </div>
												<div class="form-group">
                                                    <label>是否开启双重验证模式</label>
                                                    <div>
                                                    <select  class="form-control" name="oreo_scyz" id="oreo_scyz">
                                                    <option value="0"  <?=$conf['oreo_scyz']==0?"selected":""?>>域名验证</option>
                                                    <option value="1"  <?=$conf['oreo_scyz']==1?"selected":""?>>域名IP双重验证</option>          
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>域名授权方式为</label>
                                                    <div>
                                                    <select  class="form-control" name="oreo_sqfs" id="oreo_sqfs">
                                                    <option value="0"  <?=$conf['oreo_sqfs']==0?"selected":""?>>单域名验证</option>
                                                    <option value="1"  <?=$conf['oreo_sqfs']==1?"selected":""?>>泛域名验证</option>          
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group" >
                                                    <label>是否设置授权到期时间</label>
                                                    <div>
                                                    <select  class="form-control" name="oreo_dqsj" id="oreo_dqsj"  onchange="sq_sz('sh',this.value)">
                                                    <option value="0" <?=$conf['oreo_dqsj']==0?"selected":""?>>否</option>
                                                    <option value="1" <?=$conf['oreo_dqsj']==1?"selected":""?>>是</option>          
                                                    </select>
                                                    </div>
													<small>* 如果设置否即代表永久授权</small>
                                                </div>
												<div class="form-group" id="sh_sqz"  style="<?php echo $conf['oreo_dqsj'] == 1 ? "" : "display: none;";?>">
													<div class="form-group">
                                                    <label>到期时间</label>
                                                    <div>
													<input class="form-control" type="date" id="example-date-input" name="oreo_dtime" value="<?php echo date("Y-m-d",$conf['oreo_dtime']); ?>">
                                                    </div>
                                                </div>	
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
	function sq_sz(type,val){
    var gb  = $("#"+type+"_sqz");
    if(val == 0){
       $(gb).hide() 
    }
    if(val == 1){
       $(gb).show()
    }
}
		 $("#wzxx").click(function () {
						var oreo_ipyz = $("#oreo_ipyz").val();
						var oreo_scyz = $("#oreo_scyz").val();
						var oreo_sqfs = $("#oreo_sqfs").val();
						var oreo_dqsj = $("#oreo_dqsj").val();
						var oreo_dtime=$("input[name='oreo_dtime']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Zxsqsz",
							data: {oreo_ipyz:oreo_ipyz,oreo_scyz:oreo_scyz,oreo_sqfs:oreo_sqfs,oreo_dqsj:oreo_dqsj,oreo_dtime:oreo_dtime},
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