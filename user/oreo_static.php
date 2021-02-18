<?php 
if(isset($_GET['logout'])){
    $_SESSION = array(); 
    session_start();  
    setcookie("user_token", "", time() - 1);
    session_destroy(); 
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('您已成功注销本次登录！');window.location.href='../';</script>");
} 
//禁止多地登录和验证登录token
if($_SESSION['login_token']!=$userrow['login_token']){
    $_SESSION = array(); 
    session_start();  
    setcookie("user_token", "", time() - 1);
    session_destroy(); 
    @header('Content-Type: text/html; charset=UTF-8'); 
exit("<script language='javascript'>alert('您的账号已在别处登录');window.location.href='../';</script>");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $conf['web_title']; ?> - 用户后台面板</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/user/images/favicon.ico">
        <!-- third party css -->
        <link href="../assets/user/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="../assets/user/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/user/css/app.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//at.alicdn.com/t/font_1139659_hb2yg3ozax.css">
    </head>
    <style>
    </style>
    <body>
        <!-- Topbar Start -->
        <div class="navbar-custom topnav-navbar" id="navbar-custom">
            <div class="container-fluid">
               <a class="button-menu-mobile disable-btn">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>                    </div>
                </a>
                <!-- LOGO -->
                <a href="index.php" class="topnav-logo" >
                    <span class="topnav-logo-lg">
                        <img src="../assets/user/images/logo-light.png" alt="" height="16">                    </span>
                    <span class="topnav-logo-sm">
                        <img src="../assets/user/images/logo_sm.png" alt="" height="16">                    </span>                </a>

                <ul class="list-unstyled topbar-right-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="account-user-avatar"> 
                                <img src="<?php echo ($userrow['qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'/assets/images/team-1.jpg'?>" alt="user-image" class="rounded-circle">                            </span>
                            <span>
                                <span class="account-user-name" style="color: white;"><?php echo $userrow['names'];?></span>
                                <span class="account-position" style="color: white;"><?php echo $userrow['grade_name'];?></span>                            </span>                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">欢迎光临 !</h6>
                            </div>
    
                            <!-- item-->
                            <a href="./oreo_my.php" class="dropdown-item notify-item">
                                <i class=" dripicons-user mr-1"></i>
                                <span>用户详情</span>                            </a>
    
                            <!-- item-->
                            <a href="./oreo_domain.php" class="dropdown-item notify-item">
                                <i class=" dripicons-rocket mr-1"></i>
                                <span>域名管理</span>                            </a>
    
                            <!-- item-->
                            <a href="./oreo_subordinate.php" class="dropdown-item notify-item">
                                <i class=" dripicons-user-group mr-1"></i>
                                <span>下级管理</span>                            </a>
    
                            <!-- item-->
                            <a href="./oreo_qc.php" class="dropdown-item notify-item">
                                <i class="iconfont icon-qq mr-1"></i>
                                <span>QQ互联</span>                            </a>
                            <a href="./oreo_wx.php" class="dropdown-item notify-item">
                                <i class="iconfont icon-weixin"></i>
                                <span>微信登录</span>                            </a>    
    
                            <!-- item-->
                            <a href="./oreo_static.php?logout" class="dropdown-item notify-item">
                                <i class="dripicons-cross mr-1"></i>
                                <span>安全退出</span>                            </a>                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end Topbar -->


        <div class="container-fluid">

            <!-- Begin page -->
            <div class="wrapper">

                <!-- ============================================================== -->
                <!-- Start Page Content here -->
                <!-- ============================================================== -->

                <!-- Start Content-->

                <!-- ========== Left Sidebar Start ========== -->
                <div class="left-side-menu">
                    <div class="leftbar-user">
                        <a href="#">
                            <img src="<?php echo ($userrow['qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'/assets/images/team-1.jpg'?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
                            <span class="leftbar-user-name"><?php echo $userrow['names'];?></span>                        </a>                    </div>
                    <!--- Sidemenu -->
                    <ul class="metismenu side-nav">
                        <li class="side-nav-title side-nav-item">基本</li>
                        <li class="side-nav-item">
                            <a href="./" class="side-nav-link">
                                <i class="dripicons-meter"></i>
                                <span> 控制台 </span> </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="iconfont icon-yonghuzhongxin"></i>
                                <span> 用户中心 </span>
                                <span class="menu-arrow"></span>                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li><a href="oreo_my.php">用户详情</a></li>
                                <li><a href="oreo_order.php">消费记录</a></li>
                                <li><a href="oreo_safe.php">登录记录</a></li>
                            </ul>
                        </li>
                        <li class="side-nav-item">
                            <a href="./oreo_deposit.php" class="side-nav-link">
                                <i class="iconfont icon-icon-test"></i>
                                <span> 在线充值 </span> </a>
                        </li>
						<li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="iconfont icon-shouquanzhengpin"></i>
                                <span> 授权管理 </span>
                                <span class="menu-arrow"></span>                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li><a href="oreo_domain.php">域名管理</a></li>
                                <li><a href="oreo_subordinate.php">下级管理</a></li>
                            </ul>
                        </li>
                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="mdi mdi-chart-bell-curve"></i>
                                <span> 站点管理 </span>
                                <span class="menu-arrow"></span>                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li><a href="./oreo_my_web.php">站点管理</a></li>
                                <li><a href="./oreo_yy.php">站点运营报告</a></li>
                                <li><a href="./oreo_pay_safe.php">接口安全管理</a></li>
                                <li><a href="./oreo_qc.php">QQ互联</a></li>
                                <li><a href="./oreo_wx.php">微信免签登录</a></li>
                                <li><a href="./oreo_sms.php">Oreo云短信</a></li>
                            </ul>
                        </li>
						<li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="iconfont icon-guanggaogongguan"></i>
                                <span> 广告合作 </span>
                                <span class="menu-arrow"></span>                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li><a href="oreo_shop_ad.php">购买广告位</a></li>
                                <li><a href="oreo_myad.php">我的广告位</a></li>
                            </ul>
                        </li>
						<!--<li class="side-nav-item">-->
      <!--                      <a href="./shop" class="side-nav-link">-->
      <!--                          <i class="iconfont icon-duiwaidanbao"></i>-->
      <!--                          <span> 担保交易(内测) </span> </a>-->
      <!--                  </li>-->
						<li class="side-nav-item">
                            <a href="./oreo_work.php" class="side-nav-link">
                                <i class="iconfont icon-order-mine"></i>
                                <span> 工单系统 </span> </a>
                        </li>
                        <li class="side-nav-title side-nav-item mt-1">自豪的采用Oreo授权系统V6.0</li> 
                    </ul>
                    <!-- End Sidebar -->
                    <div class="clearfix"></div>
                    <!-- Sidebar -left -->
                </div>
              <div style="display:none"> 
              <script type="text/javascript" src="https://v1.cnzz.com/z_stat.php?id=1277927179&web_id=1277927179"></script>
              </div>					