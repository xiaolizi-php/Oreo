<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
$gradecode3=$DB->query("SELECT * FROM `oreo_powerc`")->fetch();
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
                                                <li class="breadcrumb-item active">平台最高用户权限设置</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">平台最高用户权限设置</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">平台最高用户权限设置</h4>
                                            <p class="text-muted m-b-30 font-14">这里是平台最高用户权限设置，用户一旦购买最高权限，则他的权限会遵循以下设置，请认真填写每一项！</p>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                    <label>价格</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="money3"  value="<?php echo $gradecode3['money3'];?>" class="form-control"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权所有程序</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="glcx3"  value="<?php echo $gradecode3['glcx3'];?>" class="form-control" placeholder="如：4146165bee50eb53,"/>
                                                    </div>
													<small>* 如果在下面按钮中 没有选择-授权所有程序-的时候在此处填写给予授权的程序的程序码， 程序码必须英文字符 , 分隔！</small>
                                                </div>
												<div class="form-group">
                                                    <label>授权所有程序</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="glcx4"  value="<?php echo $gradecode3['glcx4'];?>" class="form-control" placeholder="如：4146165bee50eb53,"/>
                                                    </div>
													<small>* 如果在下面按钮中 没有选择-添加所有程序授权商-的时候在此处填写给予授权的程序的程序码， 程序码必须英文字符 , 分隔！</small>
                                                </div>
													<div class="form-group">
												<div class="form-group row">
                                                        <label class="col-md-3 my-2 control-label" >授权权限：</label>
                                                        <div class="col-md-9">
                                                            <div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['sqtj3']==1){ ?>
                                                                <input type="checkbox"  name="sqtj3" value="1" checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck6" data-parsley-multiple="groups" data-parsley-mincheck="2">
																<?php }else{ ?>
																<input type="checkbox"  name="sqtj3" value="0"   onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck6" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                <?php } ?>
																   <label class="custom-control-label" for="customCheck6">添加授权</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['sqxg3']==1){ ?>
																    <input type="checkbox" name="sqxg3" value="1" checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck7" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                    <?php }else{ ?>
																	<input type="checkbox" name="sqxg3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck7" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	 <?php } ?>
																	 <label class="custom-control-label" for="customCheck7">修改授权</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['sqsc3']==1){ ?>
																    <input type="checkbox" name="sqsc3" value="1"  checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck8" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                     <?php }else{ ?>
																	 <input type="checkbox" name="sqsc3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck8" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	  <?php } ?>
																	 <label class="custom-control-label" for="customCheck8">删除授权</label>
                                                                </div>
                                                            </div>
															<div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['sqall3']==1){ ?>
																    <input type="checkbox" name="sqall3" value="1"  checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck10" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                     <?php }else{ ?>
																	 <input type="checkbox" name="sqall3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck10" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	  <?php } ?>
																	 <label class="custom-control-label" for="customCheck10">授权所有程序</label>
                                                                </div>
                                                            </div>
															<div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['cxall3']==1){ ?>
																    <input type="checkbox" name="cxall3" value="1"  checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck12" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                     <?php }else{ ?>
																	 <input type="checkbox" name="cxall3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck12" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	 <?php } ?>
																	 <label class="custom-control-label" for="customCheck12">显示所有授权</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div><!--end row-->    
											 	
												 <div class="form-group row">
                                                        <label class="col-md-3 my-2 control-label" >添加授权商权限：</label>
                                                        <div class="col-md-9">
                                                            <div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['tjsq3']==1){ ?>
																    <input type="checkbox" name="tjsq3" value="1" checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck13" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                    <?php }else{ ?>
																	<input type="checkbox" name="tjsq3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck13" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	 <?php } ?>
																	 <label class="custom-control-label" for="customCheck13">添加授权商</label>
                                                                </div>
                                                            </div>
															 <div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['tjsqxg3']==1){ ?>
																    <input type="checkbox" name="tjsqxg3" value="1" checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck14" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                    <?php }else{ ?>
																	<input type="checkbox" name="tjsqxg3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck14" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	 <?php } ?>
																	 <label class="custom-control-label" for="customCheck14">编辑授权商</label>
                                                                </div>
                                                            </div>
															 <div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['tjsqsc3']==1){ ?>
																    <input type="checkbox" name="tjsqsc3" value="1" checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck15" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                    <?php }else{ ?>
																	<input type="checkbox" name="tjsqsc3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck15" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	 <?php } ?>
																	 <label class="custom-control-label" for="customCheck15">删除授权商</label>
                                                                </div>
                                                            </div>
															<div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['tjsqall3']==1){ ?>
																    <input type="checkbox" name="tjsqall3" value="1" checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck16" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                    <?php }else{ ?>
																	<input type="checkbox" name="tjsqall3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck16" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	  <?php } ?>
																	 <label class="custom-control-label" for="customCheck16">查看所有授权商信息</label>
                                                                </div>
                                                            </div>
															<div class="form-check-inline my-2">
                                                                <div class="custom-control custom-checkbox">
																<?php if($gradecode3['tjsyall3']==1){ ?>
																    <input type="checkbox" name="tjsyall3" value="1" checked="" onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck66" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                    <?php }else{ ?>
																	<input type="checkbox" name="tjsyall3" value="0"  onclick="this.value=(this.value==0)?1:0" class="custom-control-input" id="customCheck66" data-parsley-multiple="groups" data-parsley-mincheck="2">
																	  <?php } ?>
																	 <label class="custom-control-label" for="customCheck66">添加所有程序授权商</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
													 <div class="form-group m-b-0">
                                                    <div>
                                                         <button type="button" id="sqqx3"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                            重置
                                                        </button>
                                                    </div>
                                                </div>
      												
                                                </div>
                                               
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                    </div> <!-- content -->
                 <?php include'oreo_foot.php';?>
		<script>
	function sq_qx(type,val){
    var gb  = $("#"+type+"_qxg1");
	var gg  = $("#"+type+"_qxg2");
    if(val == 1){
       $(gb).show()
       $(gg).hide();  
    }
    if(val == 2){
       $(gb).hide()
       $(gg).show();
    }        
}		
					$("#sqqx3").click(function () {	
                        var money3=$("input[name='money3']").val();	
                        var glcx3=$("input[name='glcx3']").val();
                        var glcx4=$("input[name='glcx4']").val();						
						var sqtj3=$("input[name='sqtj3']").val();
						var sqxg3=$("input[name='sqxg3']").val();
						var sqsc3=$("input[name='sqsc3']").val();
						var sqall3=$("input[name='sqall3']").val();
						var cxall3=$("input[name='cxall3']").val();
						var tjsq3=$("input[name='tjsq3']").val();
						var tjsqxg3=$("input[name='tjsqxg3']").val();
						var tjsqsc3=$("input[name='tjsqsc3']").val();
						var tjsqall3=$("input[name='tjsqall3']").val();
						var tjsyall3=$("input[name='tjsyall3']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Zgaoqx",
							data: {money3:money3,glcx3:glcx3,glcx4:glcx4,sqtj3:sqtj3,sqxg3:sqxg3,sqsc3:sqsc3,sqall3:sqall3,cxall3:cxall3,tjsq3:tjsq3,tjsqxg3:tjsqxg3,tjsqsc3:tjsqsc3,tjsqall3:tjsqall3,tjsyall3:tjsyall3},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('修改成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								}  else {
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