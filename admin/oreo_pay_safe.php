<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
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
                                                <li class="breadcrumb-item active">支付接口异动检测</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">支付接口异动检测</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                      <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;">     
                      <tr>     
								<th>用户</th>
                                <th>站点域名</th>
                                        <th>动态检测</th>
                                        <th>短信通知</th>
                                        <th>短信余量</th>
                                        <th>最近同步时间</th>
                                        <th>TOKEN</th>
									 	<th>操作</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
<?php
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_pay_safe WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_pay_safe WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{
    //查询短信余量
    $sms=$DB->query("SELECT * FROM oreo_tensms WHERE pid='{$row['user']}' AND domain='{$row['domain']}' limit 1 ")->fetch();  
          if($row['detection']==1){
          $detection_in="开启";}
          else{
          $detection_in="关闭";}
          if($row['sms_type']==1){
          $sms_type_in="开启";}
          else{
          $sms_type_in="邮件提醒";}
          if($sms){
              $my_sms=$sms['surplus'];
          }else{
              $my_sms="无信息";
          }if($row['addtime']==''){
              $addtime_in="还未同步";}
          else{
              $addtime_in=$row['addtime'];
          }
          if($row['xieyi']=="http://"){
             $xieyi="1";
          }
          if($row['xieyi']=="https://"){
             $xieyi="2";
          }   
          echo "<tr>";
          echo "<td >".$row['user']."</td>";
          echo "<td >".$row['xieyi'].$row['domain']."</td>";
          echo "<td style='display: none;'>".$row['domain']."</td>";
          echo "<td >".$detection_in."</td>";
          echo "<td >".$sms_type_in."</td>";
          echo "<td >".$my_sms."</td>";
          echo "<td >".$addtime_in."</td>";
          echo "<td style='display: none;'>".$row['detection']."</td>";
          echo "<td style='display: none;'>".$row['sms_type']."</td>";
          echo "<td style='display: none;'>".$xieyi."</td>";
          echo "<td >".$row['token']."</td>";
          echo "<td ><button data-toggle='modal' data-target='#tongbu' data-id='tongbu' class='btn btn-primary' >同步</button>&nbsp;&nbsp;<button data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-danger' >删除</button></td>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_pay_safe.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_pay_safe.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_pay_safe.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_pay_safe.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_pay_safe.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_pay_safe.php?page='.$last.$link.'">尾页</a></li>';
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
                        <div id="tongbu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="iconfont icon-anquan mr-1">  同步接口信息</i>
                                                        </div>
														<div class="form-group">
                                                    <label>域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca2"  name="domaint" readonly="readonly"/>
                                                     <input type="text" class="form-control ca10"  name="tokent" style="display: none;" readonly="readonly"/>
                                                     <input type="text" class="form-control ca0"  name="usert" style="display: none;" readonly="readonly"/>
                                                 </div>
                                                 <small>* Oreo承诺，不获取敏感信息并且您的接口信息将特殊加密处理再以加密形式同步.</small>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="SafeTongBu">同步</button>
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
                                                         <i class="mdi mdi-delete-forever mr-1"> 删除接口检测</i>
                                                        </div>
														<div class="form-group">
                                                    <label>域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca2"  name="domains" readonly="readonly"/>
                                                     <input type="text" class="form-control ca10"  name="tokens"  style="display: none;" readonly="readonly"/>
                                                     <input type="text" class="form-control ca0"  name="users" style="display: none;" readonly="readonly"/>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-danger" type="button" id="shuanchul">删除</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                 					   
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->
             <?php include'oreo_foot.php';?>
<script>
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(2).text();
      modal.find('.ca2').val(content); 
      var content = btnThis.closest('tr').find('td').eq(10).text();
      modal.find('.ca10').val(content); 
});     
$('#tongbu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(2).text();
      modal.find('.ca2').val(content); 
      var content = btnThis.closest('tr').find('td').eq(10).text();
      modal.find('.ca10').val(content); 
});  

                        $("#SafeTongBu").click(function () {	
                        var user=$("input[name='usert']").val();    
                        var domain=$("input[name='domaint']").val();
                        var token=$("input[name='tokent']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=Tongbu_safe_Jk",
							data: {user:user,domain:domain,token:token},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('同步成功', function(index) {
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
						var domain = $("input[name='domains']").val();
                        var token=$("input[name='tokens']").val();
                        var user=$("input[name='users']").val();    
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=delete_JkSafe",
							data: {domain:domain,token:token,user:user},
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