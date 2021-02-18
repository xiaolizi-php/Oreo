<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item active">工单查看/提交</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">工单查看/提交</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<?php	if($conf['owrk_zt']==0){ }else{?>
                                      <div class="text-lg-left">
                                           <button data-toggle="modal" data-target="#tijiao" data-id="tijiao" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i> 提交工单</button>
                                         </div>
										 <?php }?>
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 text-nowrap">
                                                <thead class="thead-light" style="text-align: center;">
                                                    <tr>
                                        <th>工单编号</th>
                                        <th>工单类型</th>
                                        <th>工单标题</th>
                                        <th style="display: none;">工单内容</th>
                                        <th>提交时间</th>
										<th style="display: none;">官方回复</th>
										<th>完结时间</th>
										<th>状态/详情</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
												<?php
$numrows=$DB->query("SELECT count(*) from oreo_work WHERE uid='$pid' ")->fetchColumn();
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
								$rs=$DB->query("SELECT * FROM oreo_work WHERE uid='$pid' order by id desc limit $offset,$pagesize"); 
                                     while($row = $rs->fetch())
                                      {
									   echo '<tr>
                                       <td>'.$row['num'].'</td>
                                       <td>'.$row['types'].'</td>
                                       <td>'.$row['biaoti'].'</td>
									   <td style="display: none;">'.$row['text'].'</td>
									   <td>'.$row['edata'].'</td>
									   <td style="display: none;">'.$row['huifu'].'</td>
									   <td>'.$row['wdata'].'</td>
									   <td>' . ($row['active'] == 1 ? '<button class="btn btn-secondary"  data-toggle="modal" data-target="#chakan" data-id="chakan" >已完结/查看详情</button>' : '<button class="btn btn-warning" data-toggle="modal" data-target="#chakan" data-id="edit" >未完结/查看详情</button>') . '</td></tr>';
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
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$last.$link.'">尾页</a></li>';
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
						<div id="chakan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-briefcase-search mr-1"> 查看详细内容</i>
                                                        </div>
														<div class="form-group">
                                                    <label>工单编号:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  readonly="readonly" />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>工单类型:</label>
                                                    <div>
													 <input type="text" class="form-control ca2"  readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>工单标题:</label>
                                                    <div>
													 <input type="text" class="form-control ca3"  readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>工单内容:</label>
                                                    <div>
													<textarea  type="text"  rows="4" class="form-control ca4" readonly="readonly"></textarea>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>官方回复:</label>
                                                    <div>
													<textarea  type="text"  rows="4" class="form-control ca5" readonly="readonly"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="tijiao" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">提交工单</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                        <label for="example-select">问题类型</label>
                                                        <select class="form-control" id="types" name="types">
                                                            <?php echo $conf['owrk_ask'];?>
                                                        </select>
                                                    </div>
													<div class="form-group">
                                                        <label>工单标题:</label>
														<input type="text" name="uid"  style="display: none;" value="<?php echo $userrow['id']?>"> 
                                                        <input type="biaoti" name="biaoti" class="form-control" >
                                                    </div>
													<div class="form-group">
                                                        <label>工单内容:</label>
                                                        <textarea  type="text"  name="text" rows="4" class="form-control" ></textarea>
                                                    </div>
													<div class="form-group">
                                                        <label>联系QQ:</label>
                                                        <input type="text" class="form-control" name="qq"  value="<?php echo $userrow['qq'];?>">
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
													    <button type="button" class="btn btn-primary" id="swork">提交</button>
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
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
		$('#chakan').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca1').val(content);
	  var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca2').val(content);
	  var content = btnThis.closest('tr').find('td').eq(2).text();
      modal.find('.ca3').val(content);
	  var content = btnThis.closest('tr').find('td').eq(3).text();
      modal.find('.ca4').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content);	 
});
$("#swork").click(function () {
			            var types = $("#types").val();
						var uid = $("input[name='uid']").val();						
                        var biaoti = $("input[name='biaoti']").val();			
						var text=$("textarea[name='text']").val(); 
						var qq = $("input[name='qq']").val();
						if (biaoti == '' || text == '' || qq == '') {
							layer.alert('请确保各项不能为空！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=s_Work",
							data: {types:types,uid:uid,biaoti:biaoti,text:text,qq:qq},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('提交成功！', function(index) {
                                    layer.close(index);
                                    location.href="oreo_work.php"; 
                                    })
								} else if (data.code == 2) {
									$("#situation").val("settle");
									$('#myModal').modal('show');
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});   		     	              
</script> 
</body>
</html>