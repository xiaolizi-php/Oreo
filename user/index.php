<?php
include("../oreo/oreo.core.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
include './oreo_static.php';
$sqs=$DB->query("select count(*) as total from oreo_authorize where sjid='$pid'")->fetch();
$mysq=$sqs[0];
$wxj=$DB->query("select count(*) as total from oreo_user where sjid='$pid'")->fetch();
$myxj=$wxj[0];
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
//检测是否绑定邮箱
if($userrow['phone']==''||!$userrow['phone']){
    exit("<script language='javascript'>alert('您的账号未绑定手机号码，请先绑定手机号码再操作');window.location.href='./oreo_my.php';</script>");
    }    
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
                                            <li class="breadcrumb-item active">总览</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">总览</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="row">
                           
                           <div class="col-xl-6 col-lg-6">
                               <div class="card widget-flat bg-primary text-white">
                                   <div class="card-body">
                                       <div class="float-right">
                                           <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-white"></i>
                                       </div>
                                       <h6 class="text-uppercase mt-0" title="Customers">我的余额</h6>
                                       <h3 class="mt-3 mb-3">¥<?php echo $userrow['money']?></h3>
                                   </div>
                               </div>
                           </div> <!-- end col-->

                           <div class="col-xl-6 col-lg-6">
                               <div class="card cta-box bg-danger text-white">
                                   <div class="card-body">
                                       <div class="float-right">
                                           <i class="mdi mdi-database-check widget-icon bg-white text-success"></i>
                                       </div>
                                       <h6 class="text-uppercase mt-0" title="Customers">授权总数</h6>
                                       <h3 class="mt-3 mb-3"><?php echo $mysq;?>个</h3>
                                   </div>
                               </div>
                           </div> <!-- end col-->
                       </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                               <div class="card widget-flat bg-success text-white">
                                   <div class="card-body">
                                       <div class="float-right">
                                           <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                                       </div>
                                       <h6 class="text-uppercase mt-0" title="Customers">我的下级</h6>
                                       <h3 class="mt-3 mb-3"><?php echo $myxj;?>个</h3>
                                   </div>
                               </div>
                           </div> <!-- end col-->
                                </div> <!-- end row -->
                            </div> <!-- end col -->
                            <div class="col-lg-7">
                               <div class="card">
                                   <div class="card-body">
                                       
                                       <h4 class="header-title mb-2">平台公告</h4>

                                       <div class="slimscroll" style="max-height: 225px;">
                                           <div class="timeline-alt pb-0">
                                               <?php 
    $rs = $DB->query("SELECT * FROM oreo_notice order by id desc limit 99999");
    while ($res = $rs->fetch()) {
        echo '
		<div class="timeline-item">
        <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
        <div class="timeline-item-info">
        <a href="#" class="text-info font-weight-bold mb-1 d-block">'.$res['name'].'</a>
        <small>'.$res['text'].'</small>
         <p class="mb-0 pb-2">
         <small class="text-muted">'.$res['dtime'].'</small>  </p>
        </div>
         </div>';
	}
    ?>
                                           </div>
                                           <!-- end timeline -->
                                       </div> <!-- end slimscroll -->
                                   </div>
                                   <!-- end card-body -->
                               </div>
                               <!-- end card-->
                           </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                           <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title mb-3">在线授权</h4>

                                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                            <li class="nav-item">
                                                <a href="#oreoad" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 show active">
                                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1">Oreo1商业广告</i>
                                                    <span class="d-none d-lg-block">Oreo商业广告</span>
                                                </a>
                                            </li>
                                            <?php
					                             $sccs=$DB->query("SELECT * FROM `oreo_authsys` WHERE type='1' ");
                                                  while ($row = $sccs->fetch()) {
			   	                                  echo " 
					                                    <li class='nav-item'>
					                                    <a href='#{$row['sjzf']}' data-toggle='tab' aria-expanded='false' class='nav-link rounded-0'>
					                                    <i class='mdi mdi-settings-outline d-lg-none d-block mr-1'>{$row['name']}</i>
                                                    <span class='d-none d-lg-block'>{$row['name']}</span>
                                                </a>
                                            </li>";}?>       
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="oreoad">
                                        <div class="table-responsive-sm">
                                            <table class="table table-centered mb-0">
                                                <tbody>
                                                  <?php
							     $rsss=$DB->query("SELECT * FROM oreo_ad where type='3' and dtime>=now() ");
                                 while($res = $rsss->fetch()){
	                                   echo '<tr>
                                       <td>'.$res['text'].'</td>
									   </tr>';
                                      }
                                    ?>          
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
												</div>
                                           <?php
					/*至尊授权商状态查询*/	
					$sccs=$DB->query("SELECT * FROM `oreo_authsys` WHERE type='1' ");
                    while ($row = $sccs->fetch()) {
					$ztcx1=$DB->query("select * from oreo_user where id='{$pid}' and concat(',',type,',') LIKE '%,{$row['grade_code1']},%' and concat(',',sysnum,',') LIKE '%,{$row['syskeys']},%' limit 1")->fetch();
					$ztcx2=$DB->query("select * from oreo_user where id='{$pid}' and concat(',',type,',') LIKE '%,{$row['grade_code2']},%' and concat(',',sysnum,',') LIKE '%,{$row['syskeys']},%' limit 1")->fetch();
					$ztcx3=$DB->query("select * from oreo_user where id='{$pid}' and type='6' and sysnum='6' and grade_code3='6' limit 1")->fetch();
					if(!$ztcx1){
					$zzzt='<a style="color: red;">未开启</a>';
					$kaiqzt1='<a style="color: red;">不可添加</a>';
					$ymsqqx='<a style="color: blue;">可添加</a>';
					}else{
					$zzzt='<a style="color: blue;">已开启</a>';
					}if(!$ztcx1&&!$ztcx2&&!$ztcx3){
					$yhgmzt='<button data-toggle="modal" data-target="#gmqx1" data-id="gmqx1" class="btn btn-primary w-md"><i class="mdi mdi-currency-cny"></i>购买</button>';	
					$tjsqsqx='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					}else{	 
					$yhgmzt='<button class="btn btn-light w-md"><i class="mdi mdi-alert"></i>无需操作</button>';
					}
					if(!$ztcx2){
					$zzzt2='<a style="color: red;">未开启</a>';
					$kaiqzt1='<a style="color: red;">不可添加</a>';
					}else{
					$zzzt2='<a style="color: blue;">已开启</a>';
					}if(!$ztcx1&&!$ztcx2&&!$ztcx3){
					$yhgmzt2='<button data-toggle="modal" data-target="#gmqx2" data-id="gmqx2" class="btn btn-primary w-md"><i class="mdi mdi-currency-cny"></i>购买</button>';	
					}else if(!$ztcx2&&!$ztcx3){
				    $yhgmzt2='<button data-toggle="modal" data-target="#bcj2" data-id="bcj2" class="btn btn-warning w-md"><i class="mdi mdi-autorenew"></i>差价升级</button>';
					$tjsqsqx='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					$ymsqqx='<a style="color: red;">无权限</a>';
					}else{	 
					$yhgmzt2='<button class="btn btn-light w-md"><i class="mdi mdi-alert"></i>无需操作</button>';	
					}
					if(!$ztcx3){
					$zzzt3='<a style="color: red;">未开启</a>';
					}else{
					$zzzt3='<a style="color: blue;">已开启</a>';
					}if(!$ztcx2&&!$ztcx1&&!$ztcx3){
					$yhgmzt3='<button data-toggle="modal" data-target="#gmqx3" data-id="gmqx3" class="btn btn-primary w-md"><i class="mdi mdi-currency-cny"></i> 购买</button>';	
					}else if(!$ztcx3){
				    $yhgmzt3='<button data-toggle="modal" data-target="#bcj3" data-id="bcj3" class="btn btn-warning w-md"><i class="mdi mdi-autorenew"></i>差价升级</button>';
					}else{	 
					$yhgmzt3='<button class="btn btn-dark"><i class=" mdi mdi-account-heart-outline"></i> 最高权限</button>';	
					}$yjgm=$DB->query("select * from oreo_user where id='$pid' limit 1")->fetch();
					$powerzt1=$DB->query("select * from oreo_user where id='{$pid}' and concat(',',type,',') LIKE '%,{$row['grade_code1']},%' and concat(',',sysnum,',') LIKE '%,{$row['syskeys']},%' limit 1")->fetch();
					$powerzt2=$DB->query("select * from oreo_user where id='{$pid}' and concat(',',type,',') LIKE '%,{$row['grade_code2']},%' and concat(',',sysnum,',') LIKE '%,{$row['syskeys']},%' limit 1")->fetch();
					$powerzt3=$DB->query("select * from oreo_user where id='{$pid}' and  type='6' and sysnum='6' and grade_code3='6' limit 1")->fetch();
					
					$kamisq=$DB->query("select * from oreo_user where id='{$pid}' and sysnum='{$row['syskeys']}' and kami='1' limit 1")->fetch();
					if(!$ztcx2&&!$ztcx1&&!$ztcx3){
					$yjgmdomain='<button data-toggle="modal" data-target="#dcsq" data-id="dcsq" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-cart-plus"></i>单次授权</button>';	
					}if($powerzt1){
					$poweras=$DB->query("SELECT * FROM `oreo_powera` WHERE glcx1='{$row['syskeys']}'  limit 1")->fetch();
					if($poweras['sqtj1']==1){
					$yjgmdomain='<button data-toggle="modal" data-target="#mfsq" data-id="mfsq" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-check-decagram"></i>免费授权</button>';
					$ymsqqx='<a style="color: blue;">可添加</a>';
					}if($poweras['sqtj1']==0){
					$yjgmdomain='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					}}
					if($powerzt2){
					$powerbs=$DB->query("SELECT * FROM `oreo_powerb` WHERE glcx2='{$row['syskeys']}'  limit 1")->fetch();
					if($powerbs['sqtj2']==1){
					$yjgmdomain='<button data-toggle="modal" data-target="#mfsq" data-id="mfsq"class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>免费授权</button>';	
					}if($powerbs['sqtj2']==0){
					$yjgmdomain='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					$ymsqqx='<a style="color: red;">无权限</a>';
					}if($powerbs['tjsq2']==1){
					$tjsqsqx='<button data-toggle="modal" data-target="#tianjiasq" data-id="tianjiasq" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-account-group"></i>免费添加</button>';
					$kaiqzt1='<a style="color: blue;">可添加</a>';
					}if($powerbs['tjsq2']==0){
					$tjsqsqx='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					$kaiqzt1='<a style="color: red;">不可添加</a>';
					}
					}
					if($powerzt3){
					$powercs=$DB->query("SELECT * FROM `oreo_powerc` limit 1")->fetch();
					if($powercs['sqall3']==1){
					if($powercs['sqtj3']==1){
					$yjgmdomain='<button data-toggle="modal" data-target="#mfsq" data-id="mfsq"class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>免费授权</button>';	
					$ymsqqx='<a style="color: blue;">可添加</a>';
					}if($powercs['sqtj3']==0){
					$yjgmdomain='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					$ymsqqx='<a style="color: red;">无权限</a>';
					}
					}
					}
					if($powerzt3){
					$powercs=$DB->query("SELECT * FROM `oreo_powerc` limit 1")->fetch();
					$cxdxsd=similar_text($row['syskeys'],$powercs['glcx3']);
					if($powercs['sqall3']==0){
					if($cxdxsd==16){
					$yjgmdomain='<button data-toggle="modal" data-target="#mfsq" data-id="mfsq"class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>免费授权</button>';	
					$ymsqqx='<a style="color: blue;">可添加</a>';
					}if($cxdxsd!=16){
					$yjgmdomain='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					$ymsqqx='<a style="color: red;">无权限</a>';
					}
					}
					}
					if($powerzt3){
					$powercs=$DB->query("SELECT * FROM `oreo_powerc` limit 1")->fetch();
					if($powercs['tjsyall3']==1){
					if($powercs['tjsq3']==1){
					$tjsqsqx='<button data-toggle="modal" data-target="#tianjiasq" data-id="tianjiasq" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-account-group"></i>免费添加</button>';
					$kaiqzt1='<a style="color: blue;">可添加</a>';
					}if($powercs['tjsq3']==0){
					$tjsqsqx='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					$kaiqzt1='<a style="color: red;">无权限</a>';
					}
					}
					}
					if($powerzt3){
					$powercs=$DB->query("SELECT * FROM `oreo_powerc` limit 1")->fetch();
					$cxdxsd=similar_text($row['syskeys'],$powercs['glcx4']);
					if($powercs['tjsyall3']==0){
					if($cxdxsd==16){
					$tjsqsqx='<button data-toggle="modal" data-target="#tianjiasq" data-id="tianjiasq" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-account-group"></i>免费添加</button>';
					$kaiqzt1='<a style="color: blue;">可添加</a>';
					}if($cxdxsd!=16){
					$tjsqsqx='<button class="btn btn-secondary w-md"><i class="mdi mdi-alert"></i>无权操作</button>';
					$kaiqzt1='<a style="color: red;">无权限</a>';
					}
					}
					}
					if($kamisq){
					$yjgmdomain='<button data-toggle="modal" data-target="#kamimfsq" data-id="kamimfsq"class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i> 免费授权</button>';	
					}
					$powera=$DB->query("SELECT * FROM `oreo_powera` WHERE glcx1='{$row['syskeys']}'  limit 1")->fetch();
					$money1=$powera['money1'];
					if($powera['sqtj1']==1){
					$zzsq1='<a style="color: red;">|&nbsp;</a><a style="color: mediumblue;">授权添加</a>';
					}if($powera['sqtj1']==0){
					$zzsq1='';
					}if($powera['sqxg1']==1){
					$zzsq2='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">授权修改</a>';
					}if($powera['sqxg1']==0){
					$zzsq2='';
					}if($powera['sqsc1']==1){
					$zzsq3='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">删除授权</a>';
					}if($powera['sqsc1']==0){
					$zzsq3='';
					}if($powera['sqall1']==1){
					$zzsq4='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">多程序授权</a>';
					}if($powera['sqall1']==0){
					$zzsq4='';
					}if($powera['cxall1']==1){
					$zzsq5='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">显示所有授权</a>';
					}if($powera['cxall1']==0){
					$zzsq5='';
					}
					$powerb=$DB->query("SELECT * FROM `oreo_powerb` WHERE glcx2='{$row['syskeys']}'  limit 1")->fetch();
					$money2=$powerb['money2'];
					if($powerb['sqtj2']==1){
					$zzsq12='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">授权添加</a>';
					}if($powerb['sqtj2']==0){
					$zzsq12='';
					}if($powerb['sqxg2']==1){
					$zzsq22='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">授权修改</a>';
					}if($powerb['sqxg2']==0){
					$zzsq22='';
					}if($powerb['sqsc2']==1){
					$zzsq32='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">删除授权</a>';
					}if($powerb['sqsc2']==0){
					$zzsq32='';
					}if($powerb['sqall2']==1){
					$zzsq42='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">多程序授权</a>';
					}if($powerb['sqall2']==0){
					$zzsq42='';
					}if($powerb['cxall2']==1){
					$zzsq52='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">显示所有授权</a>';
					}if($powerb['cxall2']==0){
					$zzsq52='';
					}
					if($powerb['tjsq2']==1){
					$zzsq62='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">添加授权商</a>';
					}if($powerb['tjsq2']==0){
					$zzsq62='';
					}if($powerb['tjsqxg2']==1){
					$zzsq72='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">编辑授权商</a>';
					}if($powerb['tjsqxg2']==0){
					$zzsq72='';
					}if($powerb['tjsqsc2']==1){
					$zzsq82='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">删除授权商</a>';
					}if($powerb['tjsqsc2']==0){
					$zzsq82='';
					}if($powerb['tjsqall2']==1){
					$zzsq92='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">查看所有授权商信息</a>';
					}if($powerb['tjsqall2']==0){
					$zzsq92='';
					}
					$powerc=$DB->query("SELECT * FROM `oreo_powerc`  limit 1")->fetch();
					$money3=$powerc['money3'];
					if($powerc['sqtj3']==1){
					$zzsq13='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">授权添加</a>';
					}if($powerc['sqtj3']==0){
					$zzsq13='';
					}if($powerc['sqxg3']==1){
					$zzsq23='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">授权修改</a>';
					}if($powerc['sqxg3']==0){
					$zzsq23='';
					}if($powerc['sqsc3']==1){
					$zzsq33='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">删除授权</a>';
					}if($powerc['sqsc3']==0){
					$zzsq33='';
					}if($powerc['sqall3']==1){
					$zzsq43='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">多程序授权</a>';
					}if($powerc['sqall3']==0){
					$zzsq43='';
					}if($powerc['cxall3']==1){
					$zzsq53='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">显示所有授权</a>';
					}if($powerc['cxall3']==0){
					$zzsq53='';
					}
					if($powerc['tjsq3']==1){
					$zzsq63='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">添加授权商</a>';
					}if($powerc['tjsq3']==0){
					$zzsq63='';
					}if($powerc['tjsqxg3']==1){
					$zzsq73='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">编辑授权商</a>';
					}if($powerc['tjsqxg3']==0){
					$zzsq73='';
					}if($powerc['tjsqsc3']==1){
					$zzsq83='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">删除授权商</a>';
					}if($powerc['tjsqsc3']==0){
					$zzsq83='';
					}if($powerc['tjsqall3']==1){
					$zzsq93='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">添加所有程序授权商</a>';
					}if($powerc['tjsqall3']==0){
					$zzsq93='';
					}if($powerc['tjsyall3']==1){
					$zzsq100='<a style="color: red;">&nbsp;|&nbsp;</a><a style="color: mediumblue;">添加所有程序授权商</a>';
					}if($powerc['tjsyall3']==0){
					$zzsq100='';
					}
					$cj2=$money2-$money1;
					$cj3=$money3-$money2;
					$scsjm1=$row['grade_code1'];
					$scsjm2=$row['grade_code2'];
					$hqsqname=$row['name'];
			   	    echo " 
                            <div class='tab-pane' id='{$row['sjzf']}'>
							<div class='table-responsive'>
                                            <table class='table table-centered mb-0 text-nowrap'>
                                                <thead>
                                                    <tr>
                                        <th>名称</th>
                                        <th>状态</th>                                                                                
                                        <th>权限</th>
                                        <th>价格</th>
                                        <th>操作</th>
										<th style='display: none'>差价</th>
										<th style='display: none'>上程序升级码</th>
										<th style='display: none'>授权名</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                              <tr>
                                        </td>
                                        <td><span class='list-name'> {$conf['oreo_scname1']}</span>  
                                        </td>
                                        <td>{$zzzt}</td>
                                        <td>{$zzsq1}{$zzsq2}{$zzsq3}{$zzsq4}{$zzsq5}</td>
                                        <td><a style='color: blue;'>{$money1}元</a></td>
                                        <td>{$yhgmzt}</td>
										<td style='display: none'>{$row['syskeys']}</td>
										<td style='display: none'>{$row['grade_code1']}</td>
										<td style='display: none'></td>
										<td style='display: none'></td>
										<td style='display: none'></td>
                                    </tr>
                                    <tr>
                                        </td>
                                        <td><span class='list-name'> {$conf['oreo_scname2']}</span>
                                        </td>
                                        <td>{$zzzt2}</td>
                                        <td>{$zzsq12}{$zzsq22}{$zzsq32}{$zzsq42}{$zzsq52}{$zzsq62}{$zzsq72}{$zzsq82}{$zzsq92}</td>
                                        <td><a style='color: blue;'>{$money2}元</a></td>
                                        <td>{$yhgmzt2}</td>
										<td style='display: none'>{$row['syskeys']}</td>
										<td style='display: none'>{$row['grade_code2']}</td>
										<td style='display: none'>{$cj2}</td>
										<td style='display: none'>{$scsjm1}</td>
										<td style='display: none'></td>
                                    </tr>
                                    <tr>
                                        </td>
                                        <td><span class='list-name'> {$conf['oreo_scname3']}</span>  
                                        </td>
                                        <td>{$zzzt3}</td>
                                        <td>{$zzsq13}{$zzsq23}{$zzsq33}{$zzsq43}{$zzsq53}{$zzsq63}{$zzsq73}{$zzsq83}{$zzsq93}{$zzsq100}</td>
                                        <td><a style='color: blue;'>{$money3}元</a></td>
										<td>{$yhgmzt3}</td>
										<td style='display: none'>{$row['syskeys']}</td>
										<td style='display: none'>{$row['grade_code3']}</td>
										<td style='display: none'>{$cj3}</td>
										<td style='display: none'>{$scsjm2}</td>
										<td style='display: none'></td>
                                    </tr>
                                    <tr>
                                        <td><span class='list-name'>添加授权商</span></td>
                                        <td>{$kaiqzt1}</td>
                                        <td>当前权限足够时可任意添加授权商账号</td>
                                        <td><a style='color: blue;'>/</a></td>
                                        <td>{$tjsqsqx}</td>
										<td style='display: none'>{$row['syskeys']}</td>
										<td style='display: none'>{$row['grade_code1']}</td>
										<td style='display: none'></td>
										<td style='display: none'></td>
										<td style='display: none'>{$hqsqname}</td>
                                    </tr>
									<tr>
                                        <td><span class='list-name'>单次域名授权</span></td>
                                        <td>{$ymsqqx}</td>
                                        <td>若无升级用户等级则许程序的授权价格单次进行域名授权</td>
                                        <td><a style='color: blue;'>{$row['money']}元</a></td>
                                        <td>{$yjgmdomain}</td>
										<td style='display: none'>{$row['syskeys']}</td>
										<td style='display: none'></td>
										<td style='display: none'></td>
										<td style='display: none'></td>
										<td style='display: none'>{$hqsqname}</td>
                                    </tr> 
                                    </tbody>
                                 </table>
                              </div> 
							</div>
							";}
			        ?> 
                                            
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">兑换与过户</h4>
                                        <form>
                                            <div id="basicwizard">
                                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                                    <li class="nav-item">
                                                        <a href="#duihuan" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 show active"> 
                                                            <i > 兑换</i>
                                                            <span class="d-none d-sm-inline"></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#guohus" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i > 过户</i>
                                                            <span class="d-none d-sm-inline"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content b-0 mb-0">
                                                    <div class="tab-pane show active" id="duihuan">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="userName">请输入卡密</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" name="kamis">
                                                                    </div>
                                                                </div>
																<button type="button" id="kamit" class="btn btn-primary">提交</button>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>

                                                    <div class="tab-pane" id="guohus">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name">过户域名</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text"  name="yumi" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">过户码</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="gh_code" class="form-control">
                                                                    </div>
                                                                </div>
                                                               <button type="button" id="guohu" class="btn btn-primary">提交</button>
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
                       <div id="gmqx1" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 订购<?php echo $conf['oreo_scname1'];?></i>
                                                        </div>
                                                      <div class="form-group">
                                                    <label>当前购买:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  readonly="readonly"  />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>当前价格:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  readonly="readonly"  />
                                                 </div>
                                                </div>
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca5"  readonly="readonly" name="gmqx1cxm" />
                                                 </div>
                                                </div>
												<div class="form-group" style="display: none">
                                                    <label>等级码:</label>
                                                    <div>
													 <input type="text" class="form-control ca6"  readonly="readonly" name="gmqx1djm" />
                                                 </div>
                                                </div>
									           <div class="form-group">
                                                    <label>您的余额:</label>
                                                    <div>
													 <input type="text" class="form-control"  readonly="readonly" value="<?php echo $userrow['money']; ?>"/>
                                                    </div>
                                                </div> 
                                                            <div class="form-group text-center">
                                                                <button class="btn btn-primary" type="button" id="gmqxb1">订购</button>
                                                            </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="gmqx2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 订购<?php echo $conf['oreo_scname2'];?></i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>当前购买:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  readonly="readonly"  />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>当前价格:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  readonly="readonly"  />
                                                 </div>
                                                </div>
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca5"  readonly="readonly" name="gmqx2cxm" />
                                                 </div>
                                                </div>
												<div class="form-group" style="display: none">
                                                    <label>等级码:</label>
                                                    <div>
													 <input type="text" class="form-control ca6"  readonly="readonly" name="gmqx2djm" />
                                                 </div>
                                                </div>
									           <div class="form-group">
                                                    <label>您的余额:</label>
                                                    <div>
													 <input type="text" class="form-control"  readonly="readonly" value="<?php echo $userrow['money']; ?>"/>
                                                    </div>
                                                </div> 
									                     <div class="form-group text-center">
                                                         <button class="btn btn-primary" type="button" id="gmqxb2">订购</button>
                                                       </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="gmqx3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 订购<?php echo $conf['oreo_scname3'];?></i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>当前购买:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  readonly="readonly"  />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>当前价格:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  readonly="readonly"  />
                                                 </div>
                                                </div>
									           <div class="form-group">
                                                    <label>您的余额:</label>
                                                    <div>
													 <input type="text" class="form-control"  readonly="readonly" value="<?php echo $userrow['money']; ?>"/>
                                                    </div>
                                                </div> 
									                     <div class="form-group text-center">
                                                         <button class="btn btn-primary" type="button" id="gmqxb3">订购</button>
                                                       </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="bcj2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 升级<?php echo $conf['oreo_scname2'];?></i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>当前购买:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  readonly="readonly"  />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>当前价格:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  readonly="readonly"  />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>需补差价:</label>
                                                    <div>
													 <input type="text" class="form-control ca7"  readonly="readonly" />
                                                    </div>
                                                </div> 
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca5"  readonly="readonly" name="bcj2cxm" />
                                                 </div>
                                                </div>
												<div class="form-group" style="display: none">
                                                    <label>等级码:</label>
                                                    <div>
													 <input type="text" class="form-control ca6"  readonly="readonly" name="bcj2djm" />
                                                 </div>
                                                </div>
												<div class="form-group" style="display: none">
                                                    <label>上程序等级码:</label>
                                                    <div>
													 <input type="text" class="form-control ca8"  readonly="readonly" name="bcj2scxdjm" />
                                                 </div>
                                                </div>
									           <div class="form-group">
                                                    <label>您的余额:</label>
                                                    <div>
													 <input type="text" class="form-control"  readonly="readonly" value="<?php echo $userrow['money']; ?>"/>
                                                    </div>
                                                </div> 
									                     <div class="form-group text-center">
                                                         <button class="btn btn-primary" type="button" id="bcjsj2">升级</button>
                                                       </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="bcj3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 升级<?php echo $conf['oreo_scname3'];?></i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>当前购买:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  readonly="readonly"  />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>当前价格:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  readonly="readonly"  />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>需补差价:</label>
                                                    <div>
													 <input type="text" class="form-control ca7"  readonly="readonly" />
                                                    </div>
                                                </div> 
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca5"  readonly="readonly" name="bcj3cxm" />
                                                 </div>
                                                </div>
												<div class="form-group" style="display: none">
                                                    <label>等级码:</label>
                                                    <div>
													 <input type="text" class="form-control ca6"  readonly="readonly" name="bcj3djm" />
                                                 </div>
                                                </div>
												<div class="form-group" style="display: none">
                                                    <label>上程序等级码:</label>
                                                    <div>
													 <input type="text" class="form-control ca8"  readonly="readonly" name="bcj3scxdjm" />
                                                 </div>
                                                </div>
									           <div class="form-group">
                                                    <label>您的余额:</label>
                                                    <div>
													 <input type="text" class="form-control"  readonly="readonly" value="<?php echo $userrow['money']; ?>"/>
                                                    </div>
                                                </div> 
									                     <div class="form-group text-center">
                                                         <button class="btn btn-primary" type="button" id="bcjsj3">升级</button>
                                                       </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="dcsq" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 单次授权</i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>授权系统:</label>
                                                    <div>
													 <input type="text" class="form-control ca9"  value="" readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权价格:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  value="" readonly="readonly"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>验证方式:</label>
                                                    <div>
													 <input type="text" class="form-control"  value="<?=$conf['oreo_scyz']==0?"域名验证":"域名IP双重验证"?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												<?php if($conf['oreo_ipyz']==1){?>
												<div class="form-group">
                                                    <label>授权IP:</label>
                                                    <div>
													 <input type="text" class="form-control" name="sfip"  />
                                                    </div>
                                                </div> 
												<?php } ?>
												<div class="form-group">
                                                    <label>授权方式:</label>
                                                    <div>
													 <input type="text" class="form-control"  value="<?=$conf['oreo_sqfs']==0?"单域名验证":"泛域名验证"?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权到期时间:</label>
                                                    <div>
													 <input type="text" class="form-control"  value="<?=$conf['oreo_dqsj']==0?"永久有效":  date("Y-m-d",$conf['oreo_dtime']);?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>网站名称:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="sfname" />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>授权域名:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="sfdomain" placeholder="如: pay.qq.com" />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>版本号:</label>
                                                    <div>
													 <input type="text" class="form-control" name="sfversion" placeholder="如: 2.2" />
                                                    </div>
													<small>* 输入您下载的程序当前版本号.</small>
                                                </div> 
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca5" name="sfcxm"  />
                                                    </div>
                                                </div> 
									                     <div class="form-group text-center">
                                                         <button class="btn btn-primary" type="button" id="sfsqget">授权</button>
                                                       </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="mfsq" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 免費授权</i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>授权系统:</label>
                                                    <div>
													 <input type="text" class="form-control ca9"  value="" readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权价格:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  value="" readonly="readonly"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>验证方式:</label>
                                                    <div>
													 <input type="text" class="form-control"  value="<?=$conf['oreo_scyz']==0?"域名验证":"域名IP双重验证"?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												<?php if($conf['oreo_ipyz']==1){?>
												<div class="form-group">
                                                    <label>授权IP:</label>
                                                    <div>
													 <input type="text" class="form-control" name="mfip"  />
                                                    </div>
                                                </div> 
												<?php } ?>
												<div class="form-group">
                                                    <label>授权方式:</label>
                                                    <div>
													 <input type="text" class="form-control"  value="<?=$conf['oreo_sqfs']==0?"单域名验证":"泛域名验证"?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权到期时间:</label>
                                                    <div>
													  <input type="text" class="form-control"  value="<?=$conf['oreo_dqsj']==0?"永久有效":  date("Y-m-d",$conf['oreo_dtime']);?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>网站名称:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="mfname" />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>授权域名:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="mfdomain" placeholder="如: pay.qq.com" />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>版本号:</label>
                                                    <div>
													 <input type="text" class="form-control" name="mfversion" placeholder="如: 2.2" />
                                                    </div>
													<small>* 输入您下载的程序当前版本号.</small>
                                                </div> 
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca5" name="mfcxm"  />
                                                    </div>
                                                </div> 
									                     <div class="form-group text-center">
                                                         <button class="btn btn-primary" type="button" id="mfsqget">授权</button>
                                                       </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="kamimfsq" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 卡密授权</i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>授权系统:</label>
                                                    <div>
													 <input type="text" class="form-control ca9"  value="" readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权价格:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  value="" readonly="readonly"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>验证方式:</label>
                                                    <div>
													 <input type="text" class="form-control"  value="<?=$conf['oreo_scyz']==0?"域名验证":"域名IP双重验证"?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												<?php if($conf['oreo_ipyz']==1){?>
												<div class="form-group">
                                                    <label>授权IP:</label>
                                                    <div>
													 <input type="text" class="form-control" name="kmip"  />
                                                    </div>
                                                </div> 
												<?php } ?>
												<div class="form-group">
                                                    <label>授权方式:</label>
                                                    <div>
													 <input type="text" class="form-control"  value="<?=$conf['oreo_sqfs']==0?"单域名验证":"泛域名验证"?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权到期时间:</label>
                                                    <div>
                                                    
													 <input type="text" class="form-control"  value="<?=$conf['oreo_dqsj']==0?"永久有效":  date("Y-m-d",$conf['oreo_dtime']);?>" readonly="readonly"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>网站名称:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="kmname" />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>授权域名:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="kmdomain" placeholder="如: pay.qq.com" />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>版本号:</label>
                                                    <div>
													 <input type="text" class="form-control" name="kmversion" placeholder="如: 2.2" />
                                                    </div>
													<small>* 输入您下载的程序当前版本号.</small>
                                                </div> 
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca5" name="kmcxm"  />
                                                    </div>
                                                </div> 
									                     <div class="form-group text-center">
                                                         <button class="btn btn-primary" type="button" id="kmmfsqtj">授权</button>
                                                       </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="tianjiasq" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-cart-minus "> 添加授权商</i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="mingc"  placeholder="如: 奥利奥"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>登录账号:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="denglu" placeholder="不能为中文，不能特殊字符"/>
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>邮箱:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="email" />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>联系QQ:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="lianxiqq"  />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>登录密码:</label>
                                                    <div>
													 <input type="text" class="form-control" name="dlpassword" placeholder="密码不能少于8字符"/>
                                                    </div>	
                                                </div>
                                                <div class="form-group" style="display: none">
                                                    <label>给予授权的程序:</label>
                                                    <div>
													 <input type="text" class="form-control ca5" name="syskeysnum"  />
                                                    </div>
                                                </div>												
												 <div class="form-group" style="display: none">
                                                    <label>权限码:</label>
                                                    <div>
													 <input type="text" class="form-control ca6" name="gradecodes"  />
                                                    </div>
                                                </div>
									                     <div class="form-group text-center">
                                                         <button class="btn btn-primary" type="button" id="tianjiasqs">添加</button>
                                                       </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                    </div> <!-- content -->
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
        </div>
<script src="../assets/user/js/app.min.js"></script>
<script src="../assets/user/js/layer.js"></script>	
<script> 
 $('#gmqx1').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content); 
});
 $('#gmqx2').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content); 
});
 $('#gmqx3').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content); 
});
 $('#bcj2').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
      var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);	
      var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content);	  
});
 $('#bcj3').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
      var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);	
      var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content);	  
});
 $('#dcsq').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
      var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);	
      var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content);	  
});
 $('#mfsq').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
      var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);	
      var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content); 
});
 $('#kamimfsq').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
      var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);	
      var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content);	  
});
 $('#tianjiasq').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content);
      var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content); 	  
  
});
                        $("#gmqxb1").click(function () {
						var gmqx1cxm = $("input[name='gmqx1cxm']").val();
						var gmqx1djm = $("input[name='gmqx1djm']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_gmqx1",
							data: {gmqx1cxm:gmqx1cxm,gmqx1djm:gmqx1djm},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('购买成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#gmqxb2").click(function () {
						var gmqx2cxm = $("input[name='gmqx2cxm']").val();
						var gmqx2djm = $("input[name='gmqx2djm']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_gmqx2",
							data: {gmqx2cxm:gmqx2cxm,gmqx2djm:gmqx2djm},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('购买成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#gmqxb3").click(function () {
						var uid="<?=$pid?>";
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_gmqx3",
							data: {uid:uid},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('购买成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#bcjsj2").click(function () {
						var bcj2cxm = $("input[name='bcj2cxm']").val();
						var bcj2djm = $("input[name='bcj2djm']").val();
						var bcj2scxdjm = $("input[name='bcj2scxdjm']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_bcjsj2",
							data: {bcj2cxm:bcj2cxm,bcj2djm:bcj2djm,bcj2scxdjm:bcj2scxdjm},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('升级成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#bcjsj3").click(function () {
						var bcj3cxm = $("input[name='bcj3cxm']").val();
						var bcj3djm = $("input[name='bcj3djm']").val();
						var bcj3scxdjm = $("input[name='bcj3scxdjm']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_bcjsj3",
							data: {bcj3cxm:bcj3cxm,bcj3djm:bcj3djm,bcj3scxdjm:bcj3scxdjm},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('升级成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#sfsqget").click(function () {
						var sfname = $("input[name='sfname']").val();
						var sfdomain = $("input[name='sfdomain']").val();
						var sfversion = $("input[name='sfversion']").val();
						var sfip = $("input[name='sfip']").val();
						var sfcxm = $("input[name='sfcxm']").val();
						if(sfname=='' || sfversion=='' || sfdomain==''){layer.alert('请确保各项不能为空！');return false;}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_sfsq",
							data: {sfname:sfname,sfdomain:sfdomain,sfversion:sfversion,sfip:sfip,sfcxm:sfcxm},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('授权成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});	
                     $("#mfsqget").click(function () {
						var mfname = $("input[name='mfname']").val();
						var mfdomain = $("input[name='mfdomain']").val();
						var mfversion = $("input[name='mfversion']").val();
						var mfip = $("input[name='mfip']").val();
						var mfcxm = $("input[name='mfcxm']").val();
						if(mfname=='' || mfversion=='' || mfdomain==''){layer.alert('请确保各项不能为空！');return false;}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_mfsq",
							data: {mfname:mfname,mfdomain:mfdomain,mfversion:mfversion,mfip:mfip,mfcxm:mfcxm},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('授权成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});		
                       $("#kmmfsqtj").click(function () {
						var kmname = $("input[name='kmname']").val();
						var kmdomain = $("input[name='kmdomain']").val();
						var kmversion = $("input[name='kmversion']").val();
						var kmip = $("input[name='kmip']").val();
						var kmcxm = $("input[name='kmcxm']").val();
						if(kmname=='' || kmversion=='' || kmdomain==''){layer.alert('请确保各项不能为空！');return false;}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_Kmmfsq",
							data: {kmname:kmname,kmdomain:kmdomain,kmversion:kmversion,kmip:kmip,kmcxm:kmcxm},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('授权成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});							
                       $("#tianjiasqs").click(function () {
						var mingc = $("input[name='mingc']").val();
						var denglu = $("input[name='denglu']").val();
						var email = $("input[name='email']").val();
						var lianxiqq = $("input[name='lianxiqq']").val();
						var dlpassword = $("input[name='dlpassword']").val();
						var syskeysnum = $("input[name='syskeysnum']").val();
						var gradecodes = $("input[name='gradecodes']").val();
						if(mingc=='' || denglu=='' || email=='' || lianxiqq=='' || dlpassword==''){layer.alert('请确保各项不能为空！');return false;}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Tj_sqszh",
							data: {mingc:mingc,denglu:denglu,email:email,lianxiqq:lianxiqq,dlpassword:dlpassword,syskeysnum:syskeysnum,gradecodes:gradecodes},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('添加成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});	
$("#guohu").click(function () {
						var yumi = $("input[name='yumi']").val();						
                        var gh_code = $("input[name='gh_code']").val();			
						if (yumi == '' || gh_code == '') {
							layer.alert('请确保各项不能为空！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=m_YumiGh",
							data: {yumi:yumi,gh_code:gh_code},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('过户成功<br>请到我的授权页面查看.', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});	
					$("#kamit").click(function () {
						var kamis = $("input[name='kamis']").val();								
						if (kamis == '') {
							layer.alert('请确保各项不能为空！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=t_Kami",
							data: {kamis:kamis},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('过户成功<br>请到我的授权页面查看.', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg, function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								}
							}
						});
					});						
</script>
    </body>
</html>