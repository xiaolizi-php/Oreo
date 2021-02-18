<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?=$conf['web_title']?>-控制台</title>
        <link rel="shortcut icon" href="../assets/admin/images/favicon.ico">
        <link href="../assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/admin/css/icons.css" rel="stylesheet" type="text/css">
        <link href="../assets/admin/css/style.css" rel="stylesheet" type="text/css">
       <!-- DataTables -->
        <link href="../assets/admin/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/admin/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//at.alicdn.com/t/font_1139659_q1afvx2kxih.css">
        <body class="fixed-left">
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>
        <div id="wrapper">
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>
                <div class="topbar-left">
                    <div class="text-center">
                         <a href="index.php" class="logo"><i class="mdi mdi-assistant"></i>Oreo授权系统</a>
                    </div>
                </div>
                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">一般</li>
                            <li>
                                <a href="index.php" class="waves-effect">
                                    <i class="mdi mdi-airplay"></i>
                                    <span> 控制台 </span>
                                </a>
                            </li>
							 <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-code-not-equal-variant"></i><span> 模块管理 </span><span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                <li class="has_sub">
                                    <li><a href="oreo_authorize.php">授权管理</a></li>
                                    <li><a href="oreo_user.php">用户管理</a></li>
									<li><a href="oreo_work.php">工单系统</a></li>
                                    <li><a href="oreo_ad.php">商业广告</a></li> 
									 <li><a href="oreo_notice.php">平台公告</a></li> 
									<li><a href="oreo_kami.php">卡密管理</a></li>	
                                    <li><a href="oreo_qcback.php">QQ免签管理</a></li>
                                    <li><a href="oreo_wxback.php">微信免签管理</a></li>
                                    <li><a href="oreo_sms.php">Oreo云短信</a></li>
                                    <!--<li><a href="oreo_pay_safe.php">支付接口异动检测</a></li>-->
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="iconfont icon-duiwaidanbao"></i><span> 担保平台 </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">  
									<li><a href="./shop/oreo_shop_user.php">平台用户</a></li>
									<li><a href="./shop/oreo_shop_real.php">实名认证</a></li>
									<li><a href="./shop/oreo_shop_edit.php">商品管理</a></li>
									<li><a href="oreo_hmd.php">支付配置</a></li>
									<li><a href="oreo_hmd.php">评论管理</a></li>
									<li><a href="oreo_hmd.php">维权管理</a></li>
									<li><a href="oreo_htm.php">平台公告</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">核心</li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-xml"></i><span> 系统参数 </span><span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                <li class="has_sub">
                                    <li><a href="oreo_webset.php">站点信息配置</a></li>
                                    <li><a href="oreo_msg.php">授权提示设置</a></li>
                                    <li><a href="oreo_adprofile.php">管理员账号配置</a></li> 
									<li><a href="oreo_mail.php">邮件短信配置</a></li>	
                                    <li><a href="oreo_shop_ad.php">商业广告配置</a></li>									
                                </ul>
                            </li>
							 <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cash-usd"></i><span> 在线支付 </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
								    <li><a href="oreo_zf.php">支付设置</a></li>
                                    <li><a href="oreo_zftd.php">支付通道配置</a></li>
                                    <li><a href="oreo_order.php">支付订单</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-fingerprint"></i><span> 安全配置 </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="oreo_safe.php?oreo=scdm">授权代码</a></li>
                                    <li><a href="oreo_safe.php?oreo=dqsj">到期时间代码</a></li>
                                    <li><a href="oreo_safe.php?oreo=gxdm">在线更新代码</a></li>
									<li><a href="oreo_safe.php?oreo=banben">版本验证代码</a></li>
									<li><a href="oreo_safe.php?oreo=cdnlink">静态资源代码</a></li>
									 <li><a href="oreo_safe.php?oreo=daoban">盗版追踪</a></li>
									 									 
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-file-xml "></i><span> 更新管理 </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="oreo_version.php">添加/管理版本</a></li>
									<li><a href="oreo_update_log.php">客户更新记录</a></li>
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-shield"></i><span> 权限及程序设置 </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">  
                                    <li><a href="oreo_power.php">配置用户权限</a></li>
									<li><a href="oreo_root.php">设置最高权限</a></li>
									<li><a href="oreo_system.php">设置授权程序</a></li>
									<li><a href="oreo_empower.php">配置在线授权</a></li>
									<li><a href="oreo_cdn.php">静态资源配置</a></li>
                                </ul>
                            </li>
                          <li class="menu-title">Oreo产品管理</li>	
						 <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-key-change"></i><span> Oreo授权系统 </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">  
                                    <li><a href="oreo_gonggao.php">来自Oreo的公告</a></li>
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-face"></i><span> Oreo支付系统 </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">  
                                    <li><a href="oreo_htm.php">静态资源管理</a></li>
									<li><a href="oreo_hmd.php">失信名单管理</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> 
                </div> 
				 <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <!-- Top Bar Start -->
                    <div class="topbar">
                        <nav class="navbar-custom">
                            <ul class="list-inline float-right mb-0"> 
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="<?php echo ($conf['web_qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$conf['web_qq'].'&src_uin='.$conf['web_qq'].'&fid='.$conf['web_qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'assets/images/users/php.jpg'?>" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>欢迎登录</h5>
                                        </div>
                                        <a class="dropdown-item" href="oreo_user.php"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> 用户管理</a>
                                        <a class="dropdown-item" href="oreo_order.php"><i class="mdi mdi-wallet m-r-5 text-muted"></i> 订单明细</a>
                                        <a class="dropdown-item" href="oreo_webset.php"><i class="mdi mdi-settings m-r-5 text-muted"></i> 站点信息配置</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./login.php?logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> 安全退出</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-inline menu-left mb-0">
                                <li class="float-left">
                                    <button class="button-menu-mobile open-left waves-light waves-effect">
                                        <i class="mdi mdi-menu"></i>
                                    </button>
                                </li>
                                <li class="hide-phone app-search">
                                    <form role="search" class="">
                                        <input type="text" placeholder="Search..." class="form-control">
                                        <a href=""><i class="fa fa-search"></i></a>
                                    </form>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </nav>
                    </div>
                    <!-- Top Bar End -->  