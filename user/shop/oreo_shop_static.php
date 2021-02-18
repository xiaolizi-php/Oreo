<?php 
if(isset($_GET['logout'])){
    $_SESSION = array(); 
    session_start();  
    setcookie("user_token", "", time() - 1);
    session_destroy(); 
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('您已成功注销本次登录！');window.location.href='../';</script>");
} 
$Shop_user=$DB->query("select * from oreo_shop_user where user='$pid' limit 1")->fetch();
if(!$Shop_user){
	if($_SERVER["REQUEST_URI"]!='/user/shop/oreo_first_setup.php'){
exit("<script language='javascript'>window.location.href='./oreo_first_setup.php';</script>");
	}
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
        <link rel="shortcut icon" href="../../assets/user/images/favicon.ico">
        <!-- third party css -->
        <link href="../../assets/user/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/user/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/user/css/app.shop.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//at.alicdn.com/t/font_1139659_2870jsfk1cl.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        <!-- Topbar Start -->
        <div class="navbar-custom topnav-navbar">
            <div class="container-fluid">
               <a class="button-menu-mobile disable-btn">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>                    </div>
                </a>
                <!-- LOGO -->
                <a href="index.php" class="topnav-logo">
                    <span class="topnav-logo-lg">
                        <img src="../../assets/user/images/logo-light.png" alt="" height="16">                    </span>
                    <span class="topnav-logo-sm">
                        <img src="../../assets/user/images/logo_sm.png" alt="" height="16">                    </span>                </a>

                <ul class="list-unstyled topbar-right-menu float-right mb-0">
				<li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" id="topbar-notifydrop" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="dripicons-bell noti-icon"></i>
                            <span class="noti-icon-badge"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg" aria-labelledby="topbar-notifydrop">
    
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-right">
                                       
                                    </span>站内通知(近期上线)
                                </h5>
                            </div>
    
                            <div class="slimscroll" style="max-height: 230px;">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p class="notify-details">Caleb Flakelar commented on Admin
                                        <small class="text-muted">1 min ago</small>
                                    </p>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info">
                                        <i class="mdi mdi-account-plus"></i>
                                    </div>
                                    <p class="notify-details">New user registered.
                                        <small class="text-muted">5 hours ago</small>
                                    </p>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                        <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                    <p class="notify-details">Cristina Pride</p>
                                    <p class="text-muted mb-0 user-msg">
                                        <small>Hi, How are you? What about our next meeting</small>
                                    </p>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p class="notify-details">Caleb Flakelar commented on Admin
                                        <small class="text-muted">4 days ago</small>
                                    </p>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                        <img src="assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                    <p class="notify-details">Karen Robinson</p>
                                    <p class="text-muted mb-0 user-msg">
                                        <small>Wow ! this admin looks good and awesome design</small>
                                    </p>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info">
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                    <p class="notify-details">Carlos Crouch liked
                                        <b>Admin</b>
                                        <small class="text-muted">13 days ago</small>
                                    </p>
                                </a>
                            </div>
    
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View All
                            </a>
    
                        </div>
                    </li>
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
                            <a href="./oreo_shop_my.php" class="dropdown-item notify-item">
                                <i class=" dripicons-user mr-1"></i>
                                <span>我的详情</span>                            </a>
    
                            <!-- item-->
                            <a href="./oreo_shop_mall.php" class="dropdown-item notify-item">
                                <i class=" dripicons-rocket mr-1"></i>
                                <span>交易市场</span>                            </a>
                            <!-- item-->
                            <a href="./oreo_shop_static.php?logout" class="dropdown-item notify-item">
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
                                <span> 首页 </span> </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="iconfont icon-yonghuzhongxin"></i>
                                <span> 商家中心 </span>
                                <span class="menu-arrow"></span>                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li><a href="oreo_shop_my.php">我的详情</a></li>
								<li><a href="oreo_shop_real.php">实名认证</a></li>
                                <li><a href="javascript:void(0);">消费记录(近期上线)</a></li>
                                <li><a href="javascript:void(0);">登录记录(近期上线)</a></li>
                            </ul>
                        </li>
                        <li class="side-nav-item">
                            <a href="javascript:void(0);" class="side-nav-link">
                                <i class="iconfont icon-weiquanbangfu"></i>
                                <span> 维权中心(近期上线) </span> </a>
                        </li>
						<li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                               <i class="iconfont icon-duiwaidanbao"></i>
                                <span> 服务市场 </span>
                                <span class="menu-arrow"></span>                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                  <li><a href="oreo_shop_mall.php">交易市场</a></li>
                                  <li><a href="oreo_shop_mall_order.php">交易订单</a></li>
                            </ul>
                        </li>
						<li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="iconfont icon-guanggaogongguan"></i>
                                <span> 卖家中心 </span>
                                <span class="menu-arrow"></span>                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li><a href="oreo_shop_commodity.php">发布/管理</a></li>
								<li><a href="oreo_shop_buyer.php">订单管理</a></li>
                            </ul>
                        </li>
                        <li class="side-nav-title side-nav-item mt-1">自豪的采用Oreo综合服务系统</li> 
                    </ul>
                    <!-- End Sidebar -->
                    <div class="clearfix"></div>
                    <!-- Sidebar -left -->
                </div>
              <div style="display:none"> 
              <script type="text/javascript" src="https://v1.cnzz.com/z_stat.php?id=1277927179&web_id=1277927179"></script>
              </div>					