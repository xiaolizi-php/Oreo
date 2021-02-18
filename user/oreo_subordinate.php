<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
$ktztc=$DB->query("SELECT user FROM `oreo_authsys` WHERE concat(',',user,',') LIKE '%,$pid,%'")->fetch();
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">授权管理</a></li>
                                            <li class="breadcrumb-item active">下级管理</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">下级管理</h4>
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
                                        <th>名称</th>
                                        <th>账号</th>
                                        <th>邮箱</th>
                                        <th>联系QQ</th>
										<th>上级</th>
										<th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
												<?php
$numrows=$DB->query("SELECT count(*) from oreo_user WHERE sjid='$pid' ")->fetchColumn();
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
								 if($power3['tjsqall3']==1){
									$rs=$DB->query("SELECT * FROM oreo_user order by id desc limit $offset,$pagesize"); 
								 }else
								 $rs=$DB->query("SELECT * FROM oreo_user WHERE sjid='$pid' order by id desc limit $offset,$pagesize"); 
								 
                                      while($row = $rs->fetch())
                                      { 
								  if($power3['tjsqxg3']==1){
									  $bianji2="<button data-toggle='modal' data-target='#bianjis' data-id='bianjis' class='btn btn-success'>编辑</button>&nbsp;&nbsp;";
								  }if($power3['tjsqxg3']==0){
								      $bianji2='';
								  }if($power3['tjsqsc3']==1){
								      $shanchu2="<button data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-danger' >删除</button>";
								  }if($power3['tjsqsc3']==0){
								      $shanchu2='';
								  }  
                                            echo "<tr>";
											echo "<td >".$row['names']."</td>";
											echo "<td >".$row['id']."</td>";
											echo "<td >".$row['email']."</td>";
											echo "<td >".$row['qq']."</td>";
											echo "<td >".$row['sjname']."</td>";
											echo "<td >".$bianji2.$shanchu2."</td>";
											echo "</tr>";
											}
																			  
								 }else
								
                                     $rs=$DB->query("SELECT * FROM oreo_user WHERE sjid='$pid' order by id desc limit $offset,$pagesize"); 
                                      while($row = $rs->fetch())
                                      { 
										  $sccs=$DB->query("SELECT * FROM `oreo_authsys` WHERE type='1' ")->fetch();
                                          $powerzt2=$DB->query("select * from oreo_user where sjid='{$pid}' and concat(',',type,',') LIKE '%,{$sccs['grade_code2']},%' or concat(',',sysnum,',') LIKE '%,{$sccs['syskeys']},%' limit 1")->fetch();
								$sysnum=substr($row['sysnum'], 0, -1);
								if($powerzt2){
					               $power2=$DB->query("SELECT * FROM `oreo_powerb` WHERE glcx2='$sysnum'  ")->fetch();
								if($power2['tjsqxg2']==1){	
								 $bianji2="<button data-toggle='modal' data-target='#bianjis' data-id='bianjis' class='btn btn-success'>编辑</button>&nbsp;&nbsp;";
								}if($power2['tjsqxg2']==0){
								 $bianji2='';
								}
								if($power2['tjsqsc2']==1){
								$shanchu2="<button data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-danger' >删除</button>";
								}if($power2['tjsqsc2']==0){
								 $shanchu2='';
								}}elseif(!$powerzt2){
									$bianji2='';
									 $shanchu2='';
								}

											echo "<tr>";
											echo "<td >".$row['names']."</td>";
											echo "<td >".$row['id']."</td>";
											echo "<td >".$row['email']."</td>";
											echo "<td >".$row['qq']."</td>";
											echo "<td >".$row['sjname']."</td>";
											echo "<td >".$bianji2.$shanchu2."</td>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_subordinate.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_subordinate.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_subordinate.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_subordinate.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_subordinate.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_subordinate.php?page='.$last.$link.'">尾页</a></li>';
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
						<div id="bianjis" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-database-edit mr-1"> 编辑下级</i>
                                                        </div>
														<div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  name="mingc" placeholder="如: 奥利奥"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>登录账号:</label>
                                                    <div>
													 <input type="text" class="form-control ca1" name="denglu" readonly="readonly"/>
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>邮箱:</label>
                                                    <div>
													 <input type="text" class="form-control ca2"   name="email" />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>联系QQ:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  name="lianxiqq"  />
                                                 </div>
                                                </div>
												<div class="form-group">
                                                    <label>登录密码:</label>
                                                    <div>
													 <input type="text" class="form-control" name="dlpassword" placeholder="无需改密请留空！" />
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
                                                         <i class="mdi mdi-delete-forever mr-1"> 删除下级</i>
                                                        </div>
														<div class="form-group">
                                                    <label>名称:</label>
                                                    <div>
													 <input type="text" class="form-control ca0"  name="singc" readonly="readonly"/>
                                                 </div>
                                                </div>
												   <div class="form-group">
                                                    <label>登录账号:</label>
                                                    <div>
													 <input type="text" class="form-control ca1" name="senglu" readonly="readonly"/>
                                                    </div>
                                                </div> 	
                                                <div class="form-group text-center">
                                                 <button class="btn btn-danger" type="button" id="eshanchu">删除</button>
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
 $('#bianjis').on('show.bs.modal', function (event) {
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
});
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content);
});
  $("#exiugai").click(function () {
						var mingc = $("input[name='mingc']").val();
						var denglu = $("input[name='denglu']").val();
						var email = $("input[name='email']").val();
						var lianxiqq = $("input[name='lianxiqq']").val();
						var dlpassword = $("input[name='dlpassword']").val();
						if(mingc=='' || denglu=='' || email=='' || lianxiqq==''){layer.alert('请确保各项不能为空！');return false;}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Edit_sqszhgl",
							data: {mingc:mingc,denglu:denglu,email:email,lianxiqq:lianxiqq,dlpassword:dlpassword},
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
					$("#eshanchu").click(function () {
						var mingc = $("input[name='singc']").val();
						var denglu = $("input[name='senglu']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=delete_sqszh",
							data: {mingc:mingc,denglu:denglu},
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