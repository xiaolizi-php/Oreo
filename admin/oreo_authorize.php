<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
$authsys=$DB->query("SELECT * FROM `oreo_authsys` ")->fetch();
if(!$authsys){ exit("<script language='javascript'>alert('您还未添加授权程序，为了不影响程序功能，请先添加您的程序');window.location.href='./oreo_system.php';</script>");}
?>
                   <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">一般</a></li>
                                                <li class="breadcrumb-item active">授权管理和添加</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">授权管理和添加</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                       <div class="card m-b-30">
                                        <div class="card-body">
                                             <div class="row mb-2">
                                            <div class="col-lg-8">
                                                <form class="form-inline" method="post" action="oreo_authorize.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search"  name="my" class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="domain">域名</option>
                                                            <option value="qq">用户QQ</option>
                                                            <option value="sjname">上级名称</option>
                                                        </select>
                                                    </div>                       
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <button type="submit" name="submit" class="btn btn-secondary  mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>搜索</button>
													<a data-toggle="modal" data-target="#tianjia" data-id="tianjia"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>添加授权</a>
												</div>
                                            </div><!-- end col-->
                                        </div>
										<div class="table-responsive">
                                            <table class="table table-bordered text-nowrap">
                                                <thead>
                                                <tr>
                                                <th>名称</th>
                                <th>域名</th>
                                <th>IP</th>
                                <th>QQ</th>
                                <th>上级</th>
								<th >当前版本</th>
								<th style="display: none">升级KEY</th>
								<th>验证方式</th>
								<th>授权方式</th>
                                <th>到期时间</th>
								<th>授权程序</th>
                                <th>操作</th>
								<th style="display: none">0</th>
				                <th style="display: none">1</th>
                                <th style="display: none">id</th> 
								<th style="display: none">id</th> 
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
if(isset($_POST['submit'])) {

	if($_POST['column']=='name'){
		$sql="`{$_POST['column']}` like '%{$_POST['my']}%'";
	}else{
		$sql="`{$_POST['column']}`='{$_POST['my']}'";
	}
}else{
	$sql=" 1";
	$numrows=$DB->query("SELECT count(*) from oreo_authorize WHERE{$sql}")->fetchColumn();
	$link='&my=search&column='.$_POST['column'].'&value='.$_POST['my'];
	}	
										

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
$list=$DB->query("SELECT * FROM oreo_authorize WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{
if($row['ip_qh']==0){
											$ipqh='域名验证';
											}else{$ipqh='IP双重验证';}
											if($row['yumi']==0){
											$ipqhs='单域名验证';
											}else{$ipqhs='泛域名验证';}
                                            echo"<tr >
											 <td >".$row['web_name']."</td>
											 <td >".$row['domain']."</td>
											 <td >".$row['ip']."</td>
											 <td >".$row['qq']."</td>
											 <td >".$row['sjname']."</td>
											 <td >".$row['version']."</td>
											 <td style='display: none;'>".$row['syskey']."</td>
											 <td >".$ipqh."</td>
											 <td >".$ipqhs."</td>
											 <td ><span class='label label-success'>".date("Y-m-d",$row['time'])."</span></td>
											 <td style='display: none;'>".$row['ip_qh']."</td>
											 <td style='display: none;'>".$row['yumi']."</td>
											 <td style='display: none;'>".$row['id']."</td>
											 <td >".$row['authname']."</td>
											 <td style='display: none;'>".$row['authid']."</td>
											 <td ><a data-toggle='modal' data-target='#bianji' data-id='bianji' class='btn btn-xs btn-info'>编辑</a>&nbsp;&nbsp;<a data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-xs btn-danger' >删除</a></td>
											 </tr>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_authorize.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_authorize.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_authorize.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_authorize.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_authorize.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_authorize.php?page='.$last.$link.'">尾页</a></li>';
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
						<div class="modal fade bs-example-modal-center"   id="bianji" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">编辑授权信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
													 <input type="text" class="form-control ca12" name="id" style="display: none"/>
                                                      <input type="text" class="form-control ca0" name="web_name" />
                                                    </div>
                                                </div>
												<div class="form-group" >
                                                    <label>授权程序</label>
                                                    <div>
													<input type="text" class="form-control ca13"  readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权域名</label>
                                                    <div>
													<input type="text" class="form-control ca14"  name="authids" readonly="readonly" style="display: none" />
													<input type="text" class="form-control ca1" name="domain"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权IP</label>
                                                    <div>
													<input type="text" class="form-control ca2" name="ip"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>联系QQ</label>
                                                    <div>
													<input type="text" class="form-control ca3" name="qq"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权商</label>
                                                    <div>
													<input type="text" class="form-control ca4" name="sjname" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group" >
                                                    <label>版本号</label>
                                                    <div>
													<input type="text" class="form-control ca5" name="version"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>升级秘钥</label><input class="btn btn-success waves-effect waves-light" style="padding: inherit;" type= "button" name= "Submit1" value= "生成" onclick= "keys()">
                                                    <div>
													<input type="text" class="form-control ca6" id="syskeyt1" name="syskey" value="<?php echo $syskey?>"/>
													 <script language="javascript"> 
						                            function keys() 
						                             { 
						                            var str= "0123456789abcdefghijklmnopqrstuvwxyz" 
						                            var result= " " 
						                            for(var i=0;i <32;i++) 
						                             { 
						                            var temp=Math.floor(Math.random()*36) 
						                            result+=str.charAt(temp) 
						                             } 
						                            hash = result.MD5();
						                            document.getElementById("syskeyt1").value=hash;
						                              } 
					                                 </script>
                                                    </div>
                                                </div>	
												<div class="form-group">
                                                    <label>验证方式</label>
                                                    <div>
                                                    <select class="form-control ca10" name="ip_qh" id="ip_qh">
                                                    <option value="0" >域名验证</option>
                                                    <option value="1" >IP双重验证</option>  
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>域名授权方式</label>
                                                    <div>
                                                    <select class="form-control ca11" name="yumi" id="yumi">
                                                    <option value="0" >单域名验证</option>
                                                    <option value="1" >泛域名验证</option>  
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>到期时间</label>
                                                    <div>
													<input class="form-control ca9" type="date" id="example-date-input" name="time" >
                                                    </div>
                                                </div>	
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="xiugai"  value="提交" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                           </div><!-- /.modal-content -->
                                       </div><!-- /.modal-dialog -->
                                   </div><!-- /.modal -->	
								   <div class="modal fade bs-example-modal-center"   id="shanchu" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">请确认您的操作</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group" style="display: none">
                                                    <label>ID:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca12" name="ids" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权程序:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca13" name="ids" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权域名:</label>
                                                    <div>
													  <input type="text" class="form-control" value="<?=$sqsname;?>" name="scsname" readonly="readonly" style="display: none"  />
                                                      <input type="text" class="form-control ca1"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="shanchul"  value="提交" class="btn btn-danger waves-effect" >
                                                            确认删除授权
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                           </div><!-- /.modal-content -->
                                       </div><!-- /.modal-dialog -->
                                   </div><!-- /.modal -->	
								   <div class="modal fade bs-example-modal-center"   id="tianjia" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">添加授权信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>网站名称:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="web_namet" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权域名</label>
                                                    <div>
													<input type="text" class="form-control" name="domaint"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权IP</label>
                                                    <div>
													<input type="text" class="form-control" name="ipt"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>联系QQ</label>
                                                    <div>
													<input type="text" class="form-control" name="qqt"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>上级</label>
                                                    <div>
													<input type="text" class="form-control" name="sjidt" placeholder="填写是上级账号,若无请留空"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>版本号</label>
                                                    <div>
													<input type="text" class="form-control " name="versiont"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>升级秘钥</label><input class="btn btn-success waves-effect waves-light" style="padding: inherit;" type= "button" name= "Submit1" value= "生成" onclick= "keyst()">
                                                    <div>
													<input type="text" class="form-control" id="syskeyt2" name="syskeyt" value="<?php echo $syskeyt?>"/>
													 <script language="javascript"> 
						                            function keyst() 
						                             { 
						                            var str= "0123456789abcdefghijklmnopqrstuvwxyz" 
						                            var result= " " 
						                            for(var i=0;i <32;i++) 
						                             { 
						                            var temp=Math.floor(Math.random()*36) 
						                            result+=str.charAt(temp) 
						                             } 
						                            hash = result.MD5();
						                            document.getElementById("syskeyt2").value=hash;
						                              } 
					                                 </script>
                                                    </div>
                                                </div>	
												<div class="form-group">
                                                    <label>验证方式</label>
                                                    <div>
                                                    <select class="form-control " name="ip_qh" id="ip_qht">
                                                    <option value="0" >域名验证</option>
                                                    <option value="1" >IP双重验证</option>  
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>域名授权方式</label>
                                                    <div>
                                                    <select class="form-control " name="yumi" id="yumit">
                                                    <option value="0" >单域名验证</option>
                                                    <option value="1" >泛域名验证</option>  
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权系统</label>
                                                    <div>
                                                    <select class="form-control ca8" name="authidt" id="authidt">
													<?php
													$sccs=$DB->query("SELECT * FROM `oreo_authsys` ");
                                                    while ($row = $sccs->fetch()) {
						                            echo "<option value={$row['syskeys']}>{$row['name']}</option>
													";
	                                                 }
					                                  ?>
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>到期时间</label>
                                                    <div>
													<input class="form-control" type="date" id="example-date-input" name="timet" >
                                                    </div>
                                                </div>	
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="qrtianjia"  value="提交" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                           </div><!-- /.modal-content -->
                                       </div><!-- /.modal-dialog -->
                                   </div><!-- /.modal -->
                                   
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->
               <?php include'oreo_foot.php';?>
<script src="../assets/admin/js/md5.js"></script> 
<script>
	function zdy(type,val){
    var fl  = $("#"+type+"_v");
	var flt  = $("#"+type+"_v");
    if(val == 0){
       $(fl). hide()
	   $(flt). hide()
    }
    if(val == 1){
       $(fl).show()
	   $(flt).show()
    }        
}	
	 $('#bianji').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content);
	  var content = btnThis.closest('tr').find('td').eq(2).text();
      modal.find('.ca2').val(content);
	  var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(4).text();
      modal.find('.ca4').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content);
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
	  var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);
	  var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content);
	  var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content);
	  var content = btnThis.closest('tr').find('td').eq(10).text();
      modal.find('.ca10').val(content);
	  var content = btnThis.closest('tr').find('td').eq(11).text();
      modal.find('.ca11').val(content);
	  var content = btnThis.closest('tr').find('td').eq(12).text();
      modal.find('.ca12').val(content);
	  var content = btnThis.closest('tr').find('td').eq(13).text();
      modal.find('.ca13').val(content);
	  var content = btnThis.closest('tr').find('td').eq(14).text();
      modal.find('.ca14').val(content);
	 
});
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content); 
      var content = btnThis.closest('tr').find('td').eq(12).text();
      modal.find('.ca12').val(content);
	  var content = btnThis.closest('tr').find('td').eq(4).text();
      modal.find('.ca4').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(13).text();
      modal.find('.ca13').val(content); 
});
                        $("#xiugai").click(function () {
						var id=$("input[name='id']").val();
						var web_name=$("input[name='web_name']").val();
						var authids=$("input[name='authids']").val();
						var domain=$("input[name='domain']").val();
						var ip=$("input[name='ip']").val();
						var qq=$("input[name='qq']").val();
						var sjname=$("input[name='sjname']").val();
						var version=$("input[name='version']").val();
						var syskey=$("input[name='syskey']").val();
						var ip_qh = $("#ip_qh").val();
					    var yumi = $("#yumi").val();
						var time=$("input[name='time']").val();
						if(web_name=='' ||  domain=='' || qq==''){layer.alert('请确保各项不能为空！');return false;}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Xiugai",
							data: {id:id,web_name:web_name,authids:authids,domain:domain,ip:ip,qq:qq,sjname:sjname,version:version,syskey:syskey,ip_qh:ip_qh,yumi:yumi,time:time},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('修改成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#shanchul").click(function () {
						var ids=$("input[name='ids']").val();
						var scsname=$("input[name='scsname']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Shanchu",
							data: {ids:ids,scsname:scsname},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('删除成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					}); 
					$("#qrtianjia").click(function () {
						var web_namet=$("input[name='web_namet']").val();
						var domaint=$("input[name='domaint']").val();
						var ipt=$("input[name='ipt']").val();
						var qqt=$("input[name='qqt']").val();
						var sjidt=$("input[name='sjidt']").val();
						var versiont=$("input[name='versiont']").val();
						var syskeyt=$("input[name='syskeyt']").val();
						var ip_qht = $("#ip_qht").val();
					    var yumit = $("#yumit").val();
						var authidt = $("#authidt").val();
						var timet=$("input[name='timet']").val();
						if(web_namet=='' || timet=='' || domaint=='' || qqt==''){layer.alert('请确保各项不能为空！');return false;}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Tianjia",
							data: {web_namet:web_namet,domaint:domaint,ipt:ipt,qqt:qqt,sjidt:sjidt,versiont:versiont,syskeyt:syskeyt,ip_qht:ip_qht,yumit:yumit,authidt:authidt,timet:timet},
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
					
				
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>
    </body>
</html>