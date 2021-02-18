<?PHP
$file='./oreo/oreo.config.php';
if(file_exists($file)){

}else{
echo '你还没安装！<a href="../install">点此安装</a>';
}
include './oreo/oreo.core.php';
date_default_timezone_set('PRC');
header("content-type:text/html;charset=utf-8");
//php防注入和XSS攻击通用过滤. 
$_GET     && SafeFilter($_GET);
$_POST    && SafeFilter($_POST);
$_COOKIE  && SafeFilter($_COOKIE);
function SafeFilter (&$arr){
    $ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');
    if (is_array($arr)){
        foreach ($arr as $key => $value){
            if(!is_array($value)){
                if (!get_magic_quotes_gpc()){             //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
                    $value=addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
                }
                $value=preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
                $arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
            }else{
                SafeFilter($arr[$key]);
            }
        }
    }
}
if(isset($_POST['user']) && isset($_POST['pass'])){
    $user=daddslashes($_POST['user']);
	$pass = md5($_POST['pass'].$password_hash);
    $userrow=$DB->query("SELECT * FROM oreo_user WHERE id='$user' limit 1")->fetch();
    if($user==$userrow['id'] && $pass==$userrow['password']) {
        $session=md5($user.$pass.$password_hash);
        $expiretime=time()+604800;
        $token=authcode("{$user}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
        setcookie("user_token", $token, time() + 604800);
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('登录用户中心成功！');window.location.href='./user/';</script>");
    }else {
        @header('Content-Type: text/html; charset=UTF-8');
		 exit("<script language='javascript'>alert('用户名或密码不正确！');window.location.href='./';</script>");
    }
}elseif(isset($_GET['logout'])){
      $_SESSION = array(); 
    session_start();  
    setcookie("user_token", "", time() - 1);
    session_destroy(); 
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('您已成功注销本次登录！');window.location.href='../';</script>");
}elseif($islogin2==1){
    exit("<script language='javascript'>alert('您已登录！');window.location.href='./user/';</script>");
} 
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="theme-color" content="#2d79fb">
    <meta name="author" content="Webpixels">
    <title><?php echo $conf['web_title'];?></title>
    <link rel="stylesheet" href="assets/theme/Bluestar/css/all.min.css">
    <link rel="stylesheet" href="assets/theme/Bluestar/css/theme.min.css">
</head>

<body class="bg-primary">
    <header class="header-transparent" id="header-main">
        <nav class="navbar navbar-main navbar-expand-lg navbar-sticky navbar-transparent navbar-dark bg-dark" id="navbar-main">
            <div class="container">
                <a class="navbar-brand mr-lg-5"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-main-collapse">
                    <ul class="navbar-nav align-items-lg-center">
                        <li class="nav-item ">
                            <a class="nav-link" href="">主页</a>
                        </li>
                        <!--<li class="nav-item dropdown dropdown-animate" data-toggle="hover">-->
                        <!--    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">关于</a>-->
                        <!--    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow py-0">-->
                        <!--        <div class="list-group">-->
                        <!--            <a href="#" class="list-group-item list-group-item-action">-->
                        <!--                <div class="media d-flex align-items-center">-->
                        <!--                    <div class="media-body ml-3">-->
                        <!--                        <h6 class="mb-1">帮助文档</h6>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </a>-->
                        <!--            <a href="#" class="list-group-item list-group-item-action">-->
                        <!--                <div class="media d-flex align-items-center">-->
                        <!--                    <div class="media-body ml-3">-->
                        <!--                        <h6 class="mb-1">版权协议</h6>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </a>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">用户中心</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow py-0">
                                <div class="list-group">
                                    <a href="user/login.php" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">登录</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="user/oreo_reg.php" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">注册</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="slice  bg-primary" data-separator="rounded-continuous" data-separator-bg="secondary">
            <div class="bg-absolute-cover bg-size--contain d-flex align-items-center">
                <figure class="w-100">
                    <svg preserveaspectratio="none" x="0px" y="0px" viewbox="0 0 1506.3 578.7" xmlns="http://www.w3.org/2000/svg">
                        <path class="shape-fill-purple" d="M 147.269 295.566 C 147.914 293.9 149.399 292.705 151.164 292.431 L 167.694 289.863 C 169.459 289.588 171.236 290.277 172.356 291.668 L 182.845 304.699 C 183.965 306.091 184.258 307.974 183.613 309.64 L 177.572 325.239 C 176.927 326.905 175.442 328.1 173.677 328.375 L 157.147 330.943 C 155.382 331.217 153.605 330.529 152.485 329.137 L 141.996 316.106 C 140.876 314.714 140.583 312.831 141.228 311.165 L 147.269 295.566 Z"></path>
                        <path class="shape-fill-green" d="M 92.927 474.881 C 93.309 473.896 94.187 473.19 95.23 473.028 L 105.002 471.51 C 106.045 471.347 107.096 471.754 107.758 472.577 L 113.959 480.28 C 114.621 481.103 114.794 482.216 114.413 483.201 L 110.841 492.423 C 110.46 493.408 109.582 494.114 108.539 494.277 L 98.767 495.795 C 97.723 495.957 96.673 495.55 96.011 494.727 L 89.81 487.024 C 89.148 486.201 88.975 485.088 89.356 484.103 L 92.927 474.881 Z"></path>
                        <path class="shape-fill-teal" d="M 34.176 36.897 C 34.821 35.231 36.306 34.036 38.071 33.762 L 54.601 31.194 C 56.366 30.919 58.143 31.608 59.263 32.999 L 69.752 46.03 C 70.872 47.422 71.165 49.305 70.52 50.971 L 64.479 66.57 C 63.834 68.236 62.349 69.431 60.584 69.706 L 44.054 72.274 C 42.289 72.548 40.512 71.86 39.392 70.468 L 28.903 57.437 C 27.783 56.045 27.49 54.162 28.135 52.496 L 34.176 36.897 Z"></path>
                        <path class="shape-fill-yellow" d="M 330.588 185.515 C 331.035 184.361 332.064 183.533 333.286 183.344 L 344.736 181.565 C 345.958 181.374 347.189 181.852 347.965 182.815 L 355.23 191.841 C 356.006 192.805 356.209 194.11 355.762 195.264 L 351.578 206.068 C 351.131 207.222 350.102 208.05 348.88 208.24 L 337.43 210.019 C 336.208 210.209 334.977 209.732 334.201 208.768 L 326.936 199.742 C 326.16 198.778 325.957 197.474 326.404 196.32 L 330.588 185.515 Z"></path>
                        <path class="shape-fill-gray-dark" d="M 1417.759 409.863 C 1418.404 408.197 1419.889 407.002 1421.654 406.728 L 1438.184 404.16 C 1439.949 403.885 1441.726 404.574 1442.846 405.965 L 1453.335 418.996 C 1454.455 420.388 1454.748 422.271 1454.103 423.937 L 1448.062 439.536 C 1447.417 441.202 1445.932 442.397 1444.167 442.672 L 1427.637 445.24 C 1425.872 445.514 1424.095 444.826 1422.975 443.434 L 1412.486 430.403 C 1411.366 429.011 1411.073 427.128 1411.718 425.462 L 1417.759 409.863 Z"></path>
                        <path class="shape-fill-orange" d="M 1313.903 202.809 C 1314.266 201.873 1315.1 201.201 1316.092 201.047 L 1325.381 199.604 C 1326.373 199.449 1327.372 199.837 1328.001 200.618 L 1333.895 207.941 C 1334.525 208.723 1334.689 209.782 1334.327 210.718 L 1330.932 219.484 C 1330.57 220.42 1329.735 221.092 1328.743 221.246 L 1319.454 222.689 C 1318.462 222.843 1317.464 222.457 1316.834 221.674 L 1310.94 214.351 C 1310.31 213.569 1310.146 212.511 1310.508 211.575 L 1313.903 202.809 Z"></path>
                        <path class="shape-fill-red" d="M 1084.395 506.137 C 1084.908 504.812 1086.09 503.861 1087.494 503.643 L 1100.645 501.6 C 1102.049 501.381 1103.463 501.929 1104.354 503.036 L 1112.699 513.403 C 1113.59 514.51 1113.823 516.009 1113.31 517.334 L 1108.504 529.744 C 1107.99 531.07 1106.809 532.02 1105.405 532.239 L 1092.254 534.282 C 1090.85 534.5 1089.436 533.953 1088.545 532.845 L 1080.2 522.478 C 1079.309 521.371 1079.076 519.873 1079.589 518.547 L 1084.395 506.137 Z"></path>
                    </svg>
                </figure>
            </div>
            <div class="container position-relative zindex-100">
                <div class="row row-grid justify-content-around align-items-center">
                    <div class="col-lg-6">
                        <div class="pt-lg text-center">
                            <h2 class="h1 text-white mb-3"><span class="text-white typed" id="type-example" data-type-this="安全,稳定,简约,新UI"></span></h2>
                            <h2 class="h1 text-white mb-3"><?php echo $conf['web_title'];?></h2>
                            <h4 class="h4 text-white mb-3">我活着只为</h4>
                            <p class="lead text-white lh-180">知道更多，做得更多，吃得更多</p>
                            <div class="mt-5">
                                <a href="user/oreo_reg.php" class="btn btn-warning btn-circle btn-translate--hover mr-4">立即注册</a>
                                <a href="user/login.php" class="btn btn-outline-white btn-circle btn-translate--hover">立即使用</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-secondary" id="ind">
            <div class="container">
                <div class="mb-md text-center">
                    <h3 class="h3 mt-4">我们的系统优势</h3>
                    <div class="fluid-paragraph text-center mt-4">
                        <p class="lead lh-180">安全 稳定 简约 新UI</p>
                    </div>
                </div>
                <div class="row row-grid">
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-teal">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">12*7 客服支持</h5>
                                <p class="mt-2">我们提供最亲近的服务</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-pink">
                                    <i class="fas fa-globe-americas"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">多端授权</h5>
                                <p class="mt-2">一站多控，有我就够了！</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-yellow">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">安全可靠</h5>
                                <p class="mt-2">高效优化方式，告别隐私泄露</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container">
                <div class="row row-grid align-items-center">
                    <div class="col-md-6 ml-lg-auto">
                        <img src="assets/images/zs.png" style="width: 100%">
                    </div>
                    <div class="col-md-6 col-lg-5  ml-lg-auto ">
                        <div class="pr-md-4">
                            <h3 class="heading h3">全客户端支持</h3>
                            <p class="lead text-gray my-4">告别繁琐操作</p>
                            <p class="lead text-gray my-4">注册购买一步搞定</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container">
                <div class="row row-grid align-items-center">
                    <div class="col-md-6  order-lg-2 ml-lg-auto ">
                        <img src="assets/images/zs2.png" style="width: 100%">
                    </div>
                    <div class="col-md-6 col-lg-5  order-lg-1 ">
                        <div class="pr-md-4">
                            <h3 class="heading h3">强大的云服务支持</h3>
                            <p class="lead text-gray my-4">精选优质服务供应商</p>
                            <p class="lead text-gray my-4">无须担心高峰拥堵</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container pt-lg">
                <div class="mb-md text-center">
                    <h3><span class="font-weight-bolder">泛滥授权</span></h3>
                    <div class="fluid-paragraph text-center mt-4">
                        <p class="lead lh-180">只需授权主域名，即可享受二、三级域名使用，这点能满足您的需求</p>
                    </div>
                </div>
                <div class="row row-grid justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card  shadow--hover">
                            <div class="px-5 py-5">
                                <div class="icon text-info">
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="px-5 pb-5">
                                <h5 class="">单授权</h5>
                                <p class=" mt-2">限制域名使用</p>
                                <p class=" mt-2">只能搭建一个</p>
                                <p class=" mt-2">不支持更换</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card bg-primary shadow-primary  shadow--hover">
                            <div class="px-5 py-5">
                                <div class="icon text-white">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="px-5 pb-5">
                                <h5 class="text-white">泛滥授权</h5>
                                <p class="text-white mt-2">二、三级都可使用</p>
                                <p class="text-white mt-2">可以搭建多个</p>
                                <p class="text-white mt-2">一年可更换</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 text-center">
                        <h3 class="font-weight-400">立刻注册<span class="font-weight-700"> 领取优惠大礼包</span></h3>
                        <div class="mt-5">
                            <a href="user/oreo_reg.php" class="btn btn-primary btn-circle btn-translate--hover px-4">免费注册</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer footer-dark bg-gradient-primary" style="background-color: #2d79fb;">
        <div class="copyright text-sm font-weight-bold text-center">
            <a href="#">关于我们</a> | <a href="#">版权声明</a> | <a href="#">联系我们</a>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-md-between py-4 mt-4 delimiter-top">
                <div class="col-md-6" style="max-width: 100%; flex: 100%;">
                    <div class="copyright text-sm font-weight-bold text-center">
                        CopyRight &copy;2017-2019 <a href="" class="font-weight-bold"><?php echo $conf['web_title'];?></a>. All rights reserved.<a href="#">staff</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://www.jq22.com/jquery/jquery-2.1.1.js">
    </script>
    <script src="assets/theme/Bluestar/js/typed.min.js">
    </script>
    <script src="assets/theme/Bluestar/js/bootstrap.bundle.min.js">
    </script>
    <script src="assets/theme/Bluestar/js/jquery.fancybox.min.js">
    </script>
    <script src="assets/theme/Bluestar/js/theme.min.js">
    </script>
    <script src="assets/theme/Bluestar/js/swiper.min.js">
    </script>
</body>

</html>
<script>
		$(function(){

			if ( $.cookie('layoutCookie') != '' ) {
				$('body').addClass($.cookie('layoutCookie'));
			}

			$('a[data-layout="boxed"]').click(function(event){
				event.preventDefault();
				$.cookie('layoutCookie', 'boxed', { expires: 7, path: '/'});
				$('body').addClass($.cookie('layoutCookie')); // the value is boxed.
			});

			$('a[data-layout="wide"]').click(function(event){
				event.preventDefault();
				$('body').removeClass($.cookie('layoutCookie')); // the value is boxed.
				$.removeCookie('layoutCookie', { path: '/' }); // remove the value of our cookie 'layoutCookie'
			});
		});
	</script>
<!-- 模态框（Modal） -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
   <div class="modal-dialog"> 
    <div class="modal-content logintc"> 
     <ul id="myTab" class="nav nav-tabs"> 
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button> 
      <li class="active"> <a href="#gblogin" data-toggle="tab"><span class="glyphicon"></span>会员登录</a> </li> 
     </ul> 
     <div id="myTabContent" class="tab-content"> 
      <div class="tab-pane fade in active" id="gblogin"> 
       <div class="modal-body"> 
        <div class="row"> 
         <form role="form" action="/user/login.php" method="POST"> 
          <input type="hidden" name="login" value="1" /> 
          <div class="col-md-12"> 
           <div class="form-group"> 
            <input id="username" name="user" type="text" class="form-control" maxlength="20" placeholder="请输入登录账号" required /> 
           </div> 
          </div> 
          <div class="col-md-12"> 
           <div class="form-group"> 
            <input id="password" name="pass" type="password" class="form-control" placeholder="请输入登录密码" maxlength="30" required /> 
           </div> 
          </div> 
		  <div class="col-md-12"> 
           <div class="form-group"> 
			<label class="baoliu">
			<input type="checkbox" name="loginbl">登入保留一星期 
			</label>
           </div> 
          </div> 
          <div class="col-md-12"> 
           <div class="form-group"> 
            <input type="button" class="btn btn-default" onClick="window.open('/user/oreo_reg.php','_blank')" value="注册账户" /> 
            <input type="submit" class="btn btn-primary" value="立即登录" /> 
           </div> 
          </div> 
         </form> 
        </div> 
       </div> 
      </div> 
     </div> 
     <div class="modal-footer"> 
      <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button> 
     </div> 
    </div> 
   </div> 
  </div>
  
   <div class="modal fade" id="sqcx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
   <div class="modal-dialog"> 
    <div class="modal-content logintc"> 
     <ul id="myTab" class="nav nav-tabs"> 
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button> 
      <li class="active"> <a href="#sqdomain" data-toggle="tab"><span class="glyphicon"></span>授权域名查询</a> </li> 
	   <li class="activecx"> <a href="#sqscxi" data-toggle="tab"><span class="glyphicon"></span>授权商查询</a> </li> 
     </ul> 
     <div id="myTabContent" class="tab-content"> 
      <div class="tab-pane fade in active" id="sqdomain"> 
       <div class="modal-body"> 
        <div class="row"> 

          <input type="hidden" name="login" value="1" /> 
          <div class="col-md-12"> 
           <div class="form-group"> 
            <input id="domain" name="domain" type="text" class="form-control" maxlength="20" placeholder="请输入域名" required /> 
           </div> 
          </div> 
          <div class="col-md-12"> 
           <div class="form-group">
              <button type="button" id="cxsqs"  value="查询" class="btn btn-primary" >查询</button>		   
           </div> 
          </div> 

        </div> 
       </div> 
      </div>
	  <div class="tab-pane fade in activecx" id="sqscxi"> 
       <div class="modal-body"> 
        <div class="row"> 
          <input type="hidden" name="login" value="1" /> 
          <div class="col-md-12"> 
           <div class="form-group"> 
            <input id="qq" name="qq" type="text" class="form-control" maxlength="20" placeholder="请输入授权商QQ号码" required /> 
           </div> 
          </div> 
          <div class="col-md-12"> 
           <div class="form-group"> 
            <input type="button" id="cxqq" class="btn btn-primary" value="查询" /> 
           </div> 
          </div> 
        </div> 
       </div> 
      </div> 
     </div> 
     <div class="modal-footer"> 
      <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button> 
     </div> 
    </div> 
   </div> 
  </div>
  
  <div class="modal fade" id="domainok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
   <div class="modal-dialog"> 
    <div class="modal-content logintc"> 
     <div id="myTabContent" class="tab-content"> 
      <div class="tab-pane fade in active" id="gblogin"> 
       <div class="modal-body"> 
        <div class="row"> 
 <div class="table-responsive ">
          <div style=" width:100%; height:100%; position:relative; z-index:99999; 
background:url(assets/index/image/bg.png); 
margin-top: -10px; margin-right: auto;margin-bottom: 0px;margin-left: -150px; 
line-height: 1.5;text-align: left;margin: 0 auto;background-size: 100% 100%;">
<div style="padding-top:380px;padding-left: 113px;padding-right: 110px;padding-bottom: 15px; line-height: 2;" >
<span style="font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">域名:</span>
<span style="font-size: 20px;color: #925F25; font-family:Microsoft YaHei; text-decoration: underline;"><a style="color: black;"  id="domainss" ></a></span>  
<span style="font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">采用Oreo支付系统的建设</span>
<span style="font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">,同时享受本站有关服务。</span> 
<br> 
<span style="font-size: 25px;color: #925F25; font-family:Microsoft YaHei;">特此授权</span>
</div>
<div style="padding-top:2px;padding-left: 113px;padding-right: 110px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">授权期限：永久</div> 
<div style="padding-top:0px;padding-left: 113px;padding-right: 110px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">站长 Q Q：<a style="color: black;"  id="zqq" ></a></div>
 <div style="padding-top:0px;padding-left: 113px;padding-right: 110px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;padding-bottom: 103px;">签发日期：<a style="color: black;"  id="CreateTimeq" ></a></div>
 </div>
</div> 
        </div> 
       </div> 
      </div> 
     </div> 
     <div class="modal-footer"> 
      <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button> 
     </div> 
    </div> 
   </div> 
  </div>
   <div class="modal fade" id="sqssok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
   <div class="modal-dialog"> 
    <div class="modal-content logintc"> 
     <div id="myTabContent" class="tab-content"> 
      <div class="tab-pane fade in active" id="gblogin"> 
       <div class="modal-body"> 
        <div class="row"> 
 <div class="table-responsive ">
          <div style=" width:100%; height:100%; position:relative; z-index:99999; 
background:url(assets/index/image/bg2.png); 
margin-top: -10px; margin-right: auto;margin-bottom: 0px;margin-left: -150px; 
line-height: 1.5;text-align: left;margin: 0 auto;background-size: 100% 100%;">
<div style="padding-top:380px;padding-left: 113px;padding-right: 110px;padding-bottom: 15px; line-height: 2;" >
<span style="font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">兹授权:</span>
<span style="font-size: 20px;color: #925F25; font-family:Microsoft YaHei; text-decoration: underline;"><a style="color: black;"  id="names" ></a></span>  
<span style="font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">为我公司Oreo支付系统产品</span>
<span style="font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">,全权代理产品销售和售后服务。</span> 
<br> 
<span style="font-size: 25px;color: #925F25; font-family:Microsoft YaHei;">特此授权</span>
</div>
<div style="padding-top:2px;padding-left: 113px;padding-right: 110px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">平台等级：<a style="color: black;"  id="ptdj" ></div> 
<div style="padding-top:0px;padding-left: 113px;padding-right: 110px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;">联系 Q Q：<a style="color: black;"  id="zqqs" ></a></div>
 <div style="padding-top:0px;padding-left: 113px;padding-right: 110px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;padding-bottom: 103px;">签发日期：<a style="color: black;"  id="datea" ></a></div>
 </div>
</div> 
        </div> 
       </div> 
      </div> 
     </div> 
     <div class="modal-footer"> 
      <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button> 
     </div> 
    </div> 
   </div> 
  </div>
<script src="//cdn.oreo.2free.cn/assets/layer/layer.js"></script>
<script>
					$("#cxsqs").click(function () { 
						var domain=$("input[name='domain']").val(); 
				
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "user/ajax.php?act=Cx_sqdomain",
							data: {domain:domain},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									$('#domainok').modal('show');
									$('#domainss').html(data.domain)
									$('#zqq').html(data.qq)
									$('#CreateTimeq').html(data.CreateTime)
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#cxqq").click(function () { 
						var qq=$("input[name='qq']").val(); 
				
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "user/ajax.php?act=Cx_sqzts",
							data: {qq:qq},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									$('#sqssok').modal('show');
									$('#names').html(data.names)
									$('#zqqs').html(data.qq)
									$('#datea').html(data.CreateTime)
									$('#ptdj').html(data.ptdjs)
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
</script>
 </body>
</html>