<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">授权管理</a></li>
                                            <li class="breadcrumb-item active">域名管理</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">域名管理</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 text-nowrap">
                                                <thead class="thead-light" style="text-align: center;">
                                                    <tr>
                                        <th>授权程序</th>
                                        <th>名称</th>
                                        <th>域名</th>
                                        <th>绑定IP</th>
                                        <th>到期时间</th>
                                        <th>版本号</th>
										<th>升级码</th>
                                        <th>联系QQ</th>
										<th>上级名称</th>
										<th>过户码</th>
										<th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
												<?php
$numrows=$DB->query("SELECT count(*) from oreo_authorize WHERE sjid='$pid' ")->fetchColumn();
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
								 $powerzt3=$DB->query("select * from oreo_user where id='{$pid}' and type='6' and sysnum='6' and grade_code3='6' limit 1")->fetch();
								 $power3=$DB->query("SELECT * FROM `oreo_powerc` limit 1")->fetch();
								 if($powerzt3){
									if($power3['cxall3']==1){ 
									   $rs=$DB->query("SELECT * FROM oreo_authorize order by id desc limit $offset,$pagesize"); 
									}else
                                       $rs=$DB->query("SELECT * FROM oreo_authorize WHERE sjid='$pid' order by id desc limit $offset,$pagesize"); 
                                     while($row = $rs->fetch())
                                      {
								if($power3['sqxg3']==1){	
								 $bianji='<button data-toggle="modal" data-target="#bianji" data-id="bianji" class="btn btn-success">编辑</button>&nbsp;&nbsp;';
								}if($power3['sqxg3']==0){
								 $bianji='';
								}
								if($power3['sqsc3']==1){
								$shanchu='<button data-toggle="modal" data-target="#shanchu" data-id="shanchu" class="btn btn-danger" >删除</button>';
								}if($power3['sqsc3']==0){
								 $shanchu='';
								}
                                             echo "<tr>";
											echo "<td >".$row['authname']."</td>";
											echo "<td >".$row['web_name']."</td>";
											echo "<td >".$row['domain']."</td>";
											echo "<td >".$row['ip']."</td>";
											echo "<td >".date("Y-m-d",$row['time'])."</td>";
											echo "<td >".$row['version']."</td>";
											echo "<td >".$row['syskey']."</td>";
											echo "<td >".$row['qq']."</td>";
											echo "<td >".$row['sjname']."</td>";
											echo "<td >".$row['gh_code']."</td>";
											echo "<td >".$bianji.$shanchu.$bianji2.$shanchu2."</td>";
											echo "</tr>";
											}
                                }else		
                                  $rs=$DB->query("SELECT * FROM oreo_authorize WHERE sjid='$pid' order by id desc limit $offset,$pagesize"); 
                                      while($row = $rs->fetch())
                                      {
										  $sccs=$DB->query("SELECT * FROM `oreo_authsys` WHERE type='1' ")->fetch();
										  $powerzt1=$DB->query("select * from oreo_user where id='{$pid}' and concat(',',type,',') LIKE '%,{$rows['grade_code1']},%' and concat(',',sysnum,',') LIKE '%,{$rows['syskeys']},%' limit 1")->fetch();
					                      $powerzt2=$DB->query("select * from oreo_user where id='{$pid}' and concat(',',type,',') LIKE '%,{$rows['grade_code2']},%' and concat(',',sysnum,',') LIKE '%,{$rows['syskeys']},%' limit 1")->fetch();
								if($userrow['type']!=''){	  
								if(!$powerzt2&&$powerzt1){
					               $power1=$DB->query("SELECT * FROM `oreo_powera` WHERE glcx1='{$row['authid']}'  ")->fetch();
								if($power1['sqxg1']==1){	
								 $bianji='<button data-toggle="modal" data-target="#bianji" data-id="bianji" class="btn btn-success">编辑</button>&nbsp;&nbsp;';
								}if($power1['sqxg1']==0){
								 $bianji='';
								}
								if($power1['sqsc1']==1){
								$shanchu='<button data-toggle="modal" data-target="#shanchu" data-id="shanchu" class="btn btn-danger" >删除</button>';
								}if($power1['sqsc1']==0){
								 $shanchu='';
								}}
								
								
								if($powerzt2){
					               $power2=$DB->query("SELECT * FROM `oreo_powerb` WHERE glcx2='{$row['authid']}'  ")->fetch();
								if($power2['sqxg2']==1){	
								 $bianji2='<button data-toggle="modal" data-target="#bianji" data-id="bianji" class="btn btn-success">编辑</button>&nbsp;&nbsp;';
								}if($power2['sqxg2']==0){
								 $bianji2='';
								}
								if($power2['sqsc2']==1){
								$shanchu2='<button data-toggle="modal" data-target="#shanchu" data-id="shanchu" class="btn btn-danger" >删除</button>';
								}if($power2['sqsc2']==0){
								 $shanchu2='';
								}}
								}else
									$bianji='<button data-toggle="modal" data-target="#bianji" data-id="bianji" class="btn btn-success">编辑</button>&nbsp;&nbsp;';
								     
											echo "<tr>";
											echo "<td >".$row['authname']."</td>";
											echo "<td >".$row['web_name']."</td>";
											echo "<td >".$row['domain']."</td>";
											echo "<td >".$row['ip']."</td>";
											echo "<td >".date("Y-m-d",$row['time'])."</td>";
											echo "<td >".$row['version']."</td>";
											echo "<td >".$row['syskey']."</td>";
											echo "<td >".$row['qq']."</td>";
											echo "<td >".$row['sjname']."</td>";
											echo "<td >".$row['gh_code']."</td>";
											echo "<td >".$bianji.$shanchu.$bianji2.$shanchu2."</td>";
											echo "</tr>";
											}
									?>
                                                </tbody>
                                            </table>
											<nav style="float: inline-end;">
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li class="page-item"><a class="page-link" href="oreo_domain.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_domain.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_domain.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_domain.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_domain.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_domain.php?page='.$last.$link.'">尾页</a></li>';
} else {

echo '<li class="page-item"><a class="page-link">尾页</a></li>';
}
echo'</ul>';
#分页
?>
                                                </nav>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
						<div id="bianji" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-database-edit mr-1"> 修改授权信息</i>
                                                        </div>
														<div class="form-group">
                                                    <label>授权程序:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"   readonly="readonly"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>网站名称:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  name="ename" />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>授权域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca2"  name="edomain" placeholder="如: pay.qq.com" />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>绑定IP:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  name="eip"  />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>版本号:</label>
                                                    <div>
													 <input type="text" class="form-control ca5" name="eversion" placeholder="如: 2.2" />
                                                    </div>
													<small>* 输入您下载的程序当前版本号.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>联系QQ:</label>
                                                    <div>
													 <input type="text" class="form-control ca7" name="eqq" placeholder="如: 2.2" />
                                                    </div>
                                                </div>												
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca6" name="ekeys"  />
                                                    </div>
                                                </div> 
												<div class="form-group" style="display: none">
                                                    <label>过户码:</label>
                                                    <div>
													 <input type="text" class="form-control ca9" name="eghm"  />
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="exiugai">修改</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
						<div id="shanchu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-delete-forever mr-1"> 删除授权域名</i>
                                                        </div>
														<div class="form-group">
                                                    <label>授权程序:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"   readonly="readonly"/>
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>授权域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca2"  name="sdomain"  readonly="readonly" />
                                                 </div>
                                                </div>									
												<div class="form-group" style="display: none">
                                                    <label>程序码:</label>
                                                    <div>
													 <input type="text" class="form-control ca6" name="skeys"  />
                                                    </div>
                                                </div> 
												<div class="form-group" style="display: none">
                                                    <label>过户码:</label>
                                                    <div>
													 <input type="text" class="form-control ca9" name="sghm"  />
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-danger" type="button" id="shuanchul">删除</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
						
                    </div> <!-- content -->
                    <!-- Footer Start -->
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
<script src="../assets/user/js/app.min.js"></script>
<script src="../assets/user/js/layer.js"></script>
<script> 
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
      var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content);	
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);	
      var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);
      var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content);	  
}); 
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(2).text();
      modal.find('.ca2').val(content); 
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);	
      var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);
      var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content);	  
}); 
                        $("#exiugai").click(function () {
						var ename = $("input[name='ename']").val();
						var edomain = $("input[name='edomain']").val();
						var eversion = $("input[name='eversion']").val();
						var eip = $("input[name='eip']").val();
						var eqq = $("input[name='eqq']").val();
						var ekeys = $("input[name='ekeys']").val();
						var eghm = $("input[name='eghm']").val();
						if(ename=='' || eversion=='' || edomain==''){layer.alert('请确保各项不能为空！');return false;}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Goumai_XgauSq",
							data: {ename:ename,edomain:edomain,eversion:eversion,eip:eip,eqq:eqq,ekeys:ekeys,eghm:eghm},
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
					$("#shuanchul").click(function () {
						var sdomain = $("input[name='sdomain']").val();
						var skeys = $("input[name='skeys']").val();
						var sghm = $("input[name='sghm']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=edit_ShanchuSq",
							data: {sdomain:sdomain,skeys:skeys,sghm:sghm},
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
</script>
</body>
</html>