<?php
include("../oreo/oreo.core.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$token=authcode("{$pid}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
include './oreo_static.php';
$lxjecx=$DB->query("select count(*) as total from oreo_authorize")->fetch();
$sites = $lxjecx[0];
$daoban=$DB->query("select count(*) as total from oreo_daoban")->fetch();
$daobans = $daoban[0];
$sqcx=$DB->query("select count(*) as total from oreo_authsys")->fetch();
$sqcxs = $sqcx[0];
$sqs=$DB->query("select count(*) as total from oreo_user")->fetch();
$sqss = $sqs[0];
?>
<!-- Loader -->
                    <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item active">数据分析</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">数据分析</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->       
                            <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-webcam"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6 align-self-center text-center">
                                                    <div class="m-l-10">
                                                        <h5 class="mt-0 round-inner"><?php echo $sites?>个</h5>
                                                        <h5 class="mb-0 text-muted">正版授权</h5>                                                                 
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                               <!-- Column -->
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-rocket"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6 align-self-center text-center">
                                                    <div class="m-l-10">
                                                        <h5 class="mt-0 round-inner"><?php echo $daobans?>个</h5>
                                                        <h5 class="mb-0 text-muted">盗版用户</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-center align-self-center">
                                                    <div class="m-l-10 ">
                                                        <h5 class="mt-0 round-inner"><?php echo $sqss?>个</h5>
                                                        <h5 class="mb-0 text-muted">平台用户</h5>
                                                    </div>
                                                </div>                                          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round ">
                                                        <i class="mdi mdi-basket"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6 align-self-center text-center">
                                                    <div class="m-l-10 ">
                                                        <h5 class="mb-0 text-muted"><?php echo $sqcxs?>个</h5>
														<h5 class="mt-0 round-inner">授权程序</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                            </div>                                                                                                                                           
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-8">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">来自 Oreo的公告</h4>
                                            <p class="text-muted m-b-30 font-14">
                                                再怎么忙也要看平台公告.
                                            </p>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>公告内容</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td><?php echo $conf['oreo_gg1'];?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td><?php echo $conf['oreo_gg2'];?></td>
                                                </tr>
                                               <tr>
                                                    <th scope="row">3</th>
                                                    <td><?php echo $conf['oreo_gg3'];?></td>
                                                </tr>
												<tr>
                                                    <th scope="row">4</th>
                                                    <td><?php echo $conf['oreo_gg4'];?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-12 col-lg-12 col-xl-4">
                                  <div class="card bg-white m-b-30">
                                        <div class="card-body new-user">
                                            <h5 class="header-title mb-4 mt-0">我的信息</h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0" style="width:60px;">排序</th>
                                                            <th class="border-top-0">名称</th>
                                                            <th class="border-top-0">结果</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <img class="rounded-circle" src="/assets/images/qq.jpeg" alt="user" width="40"> </td>
                                                            <td>
                                                                <a href="javascript:void(0);">我的QQ号</a>
                                                            </td>
                                                            <td><?php echo $conf['web_qq']; ?></td>                  
                                                           
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <img class="rounded-circle" src="/assets/images/mc.jpeg" alt="user" width="40"> </td>
                                                            <td>
                                                                <a href="javascript:void(0);">我的名称</a>
                                                            </td>
                                                            <td>尊敬的【<?php echo '总平台管理员';?>】</td>

                                                        </tr>
                                                        <tr >
                                                            <td>
                                                                <img class="rounded-circle" src="/assets/images/vip.jpeg" alt="user" width="40"> </td>
                                                            <td>
                                                                <a href="javascript:void(0);">您的等级</a>
                                                            </td>                                                
                                                            <td>【<?php if($pids==1){
																        echo '至尊授权商';
																		}else if($pids==2){
																			echo '平台副管理员';
																			}else
																			echo '总平台管理员';
																			 ?>】</td>

                                                        </tr>
                                                         <tr>
                                                            <td>
                                                                <img class="rounded-circle" src="/assets/images/bb.png" alt="bb" width="40"> </td>
                                                            <td>
                                                                <a href="javascript:void(0);">当前版本</a>
                                                            </td>
                                                            <td><?php echo 'V1.0.5'; ?></td>                  
                                                           
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                              </div> 
                </div> <!-- content -->
          <?php include'oreo_foot.php';?>
    </body>
</html>