<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
$authsys=$DB->query("SELECT * FROM `oreo_authsys` ")->fetch();
if(!$authsys){ exit("<script language='javascript'>alert('您还未添加授权程序，为了不影响程序功能，请先添加您的程序');window.location.href='./oreo_system.php';</script>");}
if(isset($_POST['submit'])) {
	$zdcx=daddslashes(strip_tags($_POST['zdcx']));
	$zdcx2=daddslashes(strip_tags($_POST['zdcx2']));
	$zdcx3=daddslashes(strip_tags($_POST['zdcx3']));
	$money1=daddslashes(strip_tags($_POST['money1']));
	$sqtj1=daddslashes(strip_tags($_POST['sqtj1']));
	$sqxg1=daddslashes(strip_tags($_POST['sqxg1']));
	$sqsc1=daddslashes(strip_tags($_POST['sqsc1']));
	$money2=daddslashes(strip_tags($_POST['money2']));
	$sqtj2=daddslashes(strip_tags($_POST['sqtj2']));
	$sqxg2=daddslashes(strip_tags($_POST['sqxg2']));
	$sqsc2=daddslashes(strip_tags($_POST['sqsc2']));
	$tjsq2=daddslashes(strip_tags($_POST['tjsq2']));
	$tjsqxg2=daddslashes(strip_tags($_POST['tjsqxg2']));
	$tjsqsc2=daddslashes(strip_tags($_POST['tjsqsc2']));
	$ztcx1=$DB->query("SELECT * FROM `oreo_powera` WHERE glcx1='$zdcx' ")->fetch();
	if(!$ztcx1){
	$sds1=$DB->exec("INSERT INTO `oreo_powera` (`glcx1`, `money1`, `sqtj1`, `sqxg1`, `sqsc1`) VALUES ('$zdcx', '$money1', '$sqtj1', '$sqxg1', '$sqsc1')");	
	}else{
    $sqs1=$DB->exec("UPDATE `oreo_powera` SET `glcx1` = '$zdcx',  `money1` = '$money1',  `sqtj1` = '$sqtj1',  `sqxg1` = '$sqxg1',  `sqsc1` = '$sqsc1'  WHERE `glcx1` = '$zdcx'");
	}
	$ztcx2=$DB->query("SELECT * FROM `oreo_powerb` WHERE glcx2='$zdcx2' ")->fetch();
	if(!$ztcx2){
	$sds2=$DB->exec("INSERT INTO `oreo_powerb` (`glcx2`, `money2`, `sqtj2`, `sqxg2`, `sqsc2`, `tjsq2`, `tjsqxg2`, `tjsqsc2`) VALUES ('$zdcx2', '$money2', '$sqtj2', '$sqxg2', '$sqsc2', '$tjsq2', '$tjsqxg2', '$tjsqsc2')");	
	}else{
    $sqs2=$DB->exec("UPDATE `oreo_powerb` SET `glcx2` = '$zdcx2',  `money2` = '$money2',  `sqtj2` = '$sqtj2',  `sqxg2` = '$sqxg2',  `sqsc2` = '$sqsc2',  `tjsq2` = '$tjsq2',  `tjsqxg2` = '$tjsqxg2',  `tjsqsc2` = '$tjsqsc2'  WHERE `glcx2` = '$zdcx2'");
	}
    echo "<script language='javascript'>alert('修改成功');window.location.href='./oreo_power.php';</script>";
    exit();
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
                                                <li class="breadcrumb-item active">授权商权限管理</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">授权商权限管理</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                 <div class="col-md-12 col-lg-12 col-xl-6">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                
                                                <h4 class="mt-0 header-title">设置用户等级权限</h4>
                                                <p class="text-muted m-b-30 font-14">在这里您可以设置授权程序的用户权限.</p>
                
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-pills nav-justified" role="tablist">
												 <?php
					                                  $sccs=$DB->query("SELECT * FROM `oreo_authsys` WHERE type='1' ");
                                                      while ($row = $sccs->fetch()) {
			   	                                      echo " <li class='nav-item waves-effect waves-light'><a class='nav-link' data-toggle='tab' href='#{$row['sjzf']}' role='tab'>{$row['name']}</a></li>
					                                   "; }
			                                         ?>     
                                                </ul>
                                                <div class="tab-content">
												<?php
					$sccs=$DB->query("SELECT * FROM `oreo_authsys` WHERE type='1' ");
                    while ($row = $sccs->fetch()) {	
					$zzsqs1=$DB->query("select * from oreo_powera where glcx1='{$row['syskeys']}' limit 1")->fetch();
					$zzsqs2=$DB->query("select * from oreo_powerb where glcx2='{$row['syskeys']}' limit 1")->fetch();
					$zzsqs3=$DB->query("select * from oreo_powerc where glcx3='{$row['syskeys']}' limit 1")->fetch();
					if($zzsqs1['sqtj1']==1){
					$sqc1="<input type='checkbox'  name='sqtj1' value='1' checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}199' data-parsley-multiple='groups' data-parsley-mincheck='2'>";	
			   	    }else{
					$sqc1="<input type='checkbox'  name='sqtj1' value='0'   onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}199' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
 				    }if($zzsqs1['sqxg1']==1){
					$sqc2="<input type='checkbox' name='sqxg1' value='1' checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}2' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}else{
					$sqc2="<input type='checkbox' name='sqxg1' value='0'  onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}2' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}if($zzsqs1['sqsc1']==1){
					$sqc3="<input type='checkbox' name='sqsc1' value='1'  checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}3' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}else{
					$sqc3="<input type='checkbox' name='sqsc1' value='0'  onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}3' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}
					if($zzsqs2['sqtj2']==1){
					$sqc6="<input type='checkbox'  name='sqtj2' value='1' checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}6' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}else{
					$sqc6="<input type='checkbox'  name='sqtj2' value='0'   onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}6' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}if($zzsqs2['sqxg2']==1){
					$sqc7="<input type='checkbox' name='sqxg2' value='1' checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}7' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}else{
					$sqc7="<input type='checkbox' name='sqxg2' value='0'  onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}7' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}if($zzsqs2['sqsc2']==1){
					$sqc8="<input type='checkbox' name='sqsc2' value='1' checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}8' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}else{
					$sqc8="<input type='checkbox' name='sqsc2' value='0'  onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}8' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}if($zzsqs2['tjsq2']==1){
					$sqc11="<input type='checkbox' name='tjsq2' value='1' checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}13' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}else{
					$sqc11="<input type='checkbox' name='tjsq2' value='0'  onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}13' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}if($zzsqs2['tjsqxg2']==1){
					$sqc12="<input type='checkbox' name='tjsqxg2' value='1' checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}14' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}else{
					$sqc12="<input type='checkbox' name='tjsqxg2' value='0'  onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}14' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}if($zzsqs2['tjsqsc2']==1){
					$sqc13="<input type='checkbox' name='tjsqsc2' value='1' checked='' onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}15' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}else{
					$sqc13="<input type='checkbox' name='tjsqsc2' value='0'  onclick='this.value=(this.value==0)?1:0' class='custom-control-input' id='{$row['otable']}15' data-parsley-multiple='groups' data-parsley-mincheck='2'>";
					}				
					echo "
												 <div class='tab-pane p-3' id='{$row['sjzf']}' role='tabpanel'>
                                                    <div id='{$row['sjzf']}' role='tablist' aria-multiselectable='true'>
                                                    <div class='card'>
                                                        <div class='card-header' role='tab' id='headingOne'>
                                                            <h5 class='mb-0 mt-0 font-16'>
                                                                <a data-toggle='collapse' data-parent='#accordion'
                                                                   href='#{$row['otable']}oto1' aria-expanded='true'
                                                                   aria-controls='collapseOne' class='text-dark'>
																   {$conf['oreo_scname1']}
                                                                </a>
                                                            </h5>
                                                        </div>
														<form action='./oreo_power.php'method='post'role='form'>
                                                        <div id='{$row['otable']}oto11' class='collapse show' role='tabpanel'
                                                             aria-labelledby='headingOne'>
                                                            <div class='card-body'>
                                                     <div class='form-group'>
                                                    <label>价格</label>
                                                    <div>
                                                      <input type='text' class='form-control' name='money1'  value='{$zzsqs1['money1']}' class='form-control'/>
                                                    </div>
                                                </div>
												<div class='form-group row'>
                                                        <label class='col-md-3 my-2 control-label' >授权权限：</label>
                                                        <div class='col-md-9'>
                                                            <div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
																{$sqc1}
																   <label class='custom-control-label' for='{$row['otable']}199'>添加授权</label>
                                                                </div>
                                                            </div>
                                                                <div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
																{$sqc2}
																<label class='custom-control-label' for='{$row['otable']}2'>修改授权</label>
                                                                </div>
                                                            </div>
															<div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
															{$sqc3}
																<label class='custom-control-label' for='{$row['otable']}3'>删除授权</label>
																<input name='zdcx' value='{$row['syskeys']}' type='text' style='display: none'/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='card'>
                                                        <div class='card-header' role='tab' id='headingTwo'>
                                                            <h5 class='mb-0 mt-0 font-16'>
                                                                <a class='collapsed text-dark' data-toggle='collapse'
                                                                   data-parent='#accordion' href='#{$row['otable']}oto12'
                                                                   aria-expanded='false' aria-controls='collapseTwo'>
                                                                    {$conf['oreo_scname2']}
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id='{$row['otable']}oto12' class='collapse' role='tabpanel'
                                                             aria-labelledby='headingTwo'>
                                                            <div class='card-body'>
                                                             
                                                    <div class='form-group'>
                                                    <label>价格</label>
                                                    <div>
                                                      <input type='text' class='form-control' name='money2'  value='{$zzsqs2['money2']}' class='form-control'/>
                                                    </div>
                                                </div> 
												             <div class='form-group row'>
															 <label class='col-md-3 my-2 control-label' >授权权限：</label>
                                                            <div class='col-md-9'>
                                                            <div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
                                                               {$sqc6} 
																   <label class='custom-control-label' for='{$row['otable']}6'>添加授权</label>
                                                                </div>
                                                            </div>  
															
                                                            <div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
                                                               {$sqc7} 
																   <label class='custom-control-label' for='{$row['otable']}7'>修改授权</label>
                                                                </div>
                                                            </div>    
															   
															 <div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
                                                               {$sqc8} 
																   <label class='custom-control-label' for='{$row['otable']}8'>删除授权</label>
                                                                </div>
                                                            </div>   
															   </div> 
															  </div> 
															  
                                                          <div class='form-group row'>
                                                        <label class='col-md-3 my-2 control-label' >添加授权商权限：</label>
                                                         <div class='col-md-9'>
                                                            <div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
                                                               {$sqc11} 
																   <label class='custom-control-label' for='{$row['otable']}13'>添加授权商</label>
                                                                </div>
                                                            </div>  
                                                             <div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
                                                               {$sqc12} 
																   <label class='custom-control-label' for='{$row['otable']}14'>编辑授权商</label>
                                                                </div>
                                                            </div>
                                                           <div class='form-check-inline my-2'>
                                                                <div class='custom-control custom-checkbox'>
                                                               {$sqc13} 
																   <label class='custom-control-label' for='{$row['otable']}15'>删除授权商</label>
																   <input name='zdcx2' value='{$row['syskeys']}' type='text' style='display: none'/>
                                                                </div>
                                                            </div>
															 </div> 
															  </div>
                                                            </div>
                                                        </div>
                                                    </div>
													<div class='form-group m-b-0'>
                                                    <div>
                                                         <button type='submit' name='submit' id='but{$row['otable']}'  value='保存修改' class='btn btn-primary waves-effect waves-light button' style='margin-top: 1em;margin-left: 1em;text-align: center;' >
                                                            提交
                                                        </button>
                                                    </div>
													</form>
                                                </div>  
                                                </div>
					                         </div> "; } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
             <?php include'oreo_foot.php';?>
    </body>
</html>