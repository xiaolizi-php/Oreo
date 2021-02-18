<?php
include("../../oreo/oreo.core.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
include './oreo_shop_static.php';
$sqs=$DB->query("select count(*) as total from oreo_authorize where sjid='$pid'")->fetch();
$mysq=$sqs[0];
$wxj=$DB->query("select count(*) as total from oreo_user where sjid='$pid'")->fetch();
$myxj=$wxj[0];
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
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
                                       <h6 class="text-uppercase mt-0" title="Customers">冻结余额</h6>
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
                                       <h6 class="text-uppercase mt-0" title="Customers">我的商品</h6>
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
    $rs = $DB->query("SELECT * FROM oreo_shop_notice order by id desc limit 99999");
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
<script src="../../assets/user/js/app.min.js"></script>
<script src="../../assets/user/js/layer.js"></script>	
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