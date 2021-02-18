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
                                                <li class="breadcrumb-item active">商业广告</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">添加商业广告</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                         <div class="col-lg-4">
                                                <div class="text-lg-left">
												<a data-toggle="modal" data-target="#tianjia" data-id="tianjia"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>添加新的广告</a>
												</div>
                                            </div><!-- end col-->
                      <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;"> 
                      <tr>
                                <th style="display: none">ID</th>
								<th>账号</th>
								<th>内容</th>
								<th>广告类型</th>
								<th>投放广告程序</th>
								<th>到期时间</th>
                                <th>状态</th>
								<th>操作</th>
								<th style="display: none">0</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
<?php
$sql=" 1";
$numrows=$DB->query("SELECT count(*) from oreo_ad WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_ad WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{
											if($row['type']==0){$typ='<a style="color: red;">暂停服务</a>';}
											if($row['type']==1){$typ='<a style="color: red;">等待补充信息</a>';}
											if($row['type']==2){$typ='<a style="color: red;">准备审核</a>';}
											if($row['type']==3){$typ='<a style="color: blue;">正在展示</a>';}
											if($row['ad_type']==1){
											$ad_type='<a>站内广告</a>';
											}else{$ad_type='<a>Oreo系列广告</a>';}
											echo "<tr>";
											echo "<td style='display: none;'>".$row['id']."</td>";
											echo "<td >".$row['uid']."</td>";
											echo "<td style='max-width: 100px;overflow: hidden; text-overflow:ellipsis;white-space: nowrap'>" . htmlspecialchars($row['text']) ."</td>";
											echo "<td >".$ad_type."</td>";
											echo "<td >".$row['authname']."</td>";
											echo "<td >".$row['dtime']."</td>";
											echo "<td >".$typ."</td>";
											echo "<td style='display: none;'>".$row['type']."</td>";
											echo "<td ><a data-toggle='modal' data-target='#bianji' data-id='bianji' class='btn btn-xs btn-info'>编辑</a>&nbsp;<a data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-xs btn-danger' >删除</a></td>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_ad.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_ad.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_ad.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_ad.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_ad.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_ad.php?page='.$last.$link.'">尾页</a></li>';
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
                                               <h5 class="modal-title" id="exampleModalLabel">编辑广告信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>用户账号:</label>
                                                    <div>
													 <input type="text" class="form-control ca0" name="id" readonly="readonly" style="display: none"/>
													 <input type="text" class="form-control ca1" name="uid" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>广告类型:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca3"  placeholder="用户登录账号" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>广告投放程序:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca4" placeholder="用户登录账号" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>到期时间</label>
                                                    <div>
													<input class="form-control ca5" type="date" id="example-date-input" name="time" >
                                                    </div>
                                                </div>	
												<div class="form-group" >
                                                    <label>内容</label>
                                                    <div>
                                                       <textarea    rows="4"  name="text" class="form-control ca2"></textarea> 
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control ca7" name="type" id="type">
                                                    <option value="0" >暂停服务</option>
                                                    <option value="1" >等待补充信息</option>  
													<option value="2" >准备审核</option>  
													<option value="3" >正在展示</option>  
                                                    </select>
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
                                                   <div class="form-group" >
                                                    <label>ID:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="ids" readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="shanchul"  value="提交" class="btn btn-danger waves-effect" >
                                                            确认删除
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
                                               <h5 class="modal-title" id="exampleModalLabel">添加广告信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
												<div class="form-group" >
                                                    <label>内容</label>
                                                    <div>
                                                       <textarea  rows="4"  name="textt" class="form-control"></textarea> 
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>广告类型</label>
                                                    <div>
                                                    <select class="form-control ca3" name="ad_typet" id="ad_typet" onchange="ad_tp('at',this.value)">
                                                    <option value="1" >站内广告</option>
                                                    <option value="2" >Oreo系列广告</option>  
                                                    </select>
                                                    </div>
                                                </div>
												<div  id="at_add"  style="<?php echo $conf['ad_typet'] == 2 ? "" : "display: none;";?>">
												<div class="form-group">
                                                    <label>选择投放广告的程序</label>
                                                    <div>
                                                    <select class="form-control ca8" name="authidt" id="authidt">
													<?php
													$sccs=$DB->query("SELECT * FROM `oreo_authsys`");
                                                    while ($row = $sccs->fetch()) {
						                            echo "<option value={$row['syskeys']}>{$row['name']}</option>
													";
	                                                 }
					                                  ?>
                                                    </select>
                                                    </div>
                                                </div>
												</div>
												<div class="form-group">
                                                    <label>隶属账号:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="uidt" placeholder="用户登录账号" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>到期时间</label>
                                                    <div>
													<input class="form-control" type="date" id="example-date-input" name="dtimet" >
                                                    </div>
                                                </div>	
												<div class="form-group">
                                                    <label>状态</label>
                                                    <div>
                                                    <select class="form-control ca3" name="typet" id="typet">
                                                    <option value="0" >暂停服务</option>
                                                    <option value="1" >等待补充信息</option>  
													<option value="2" >准备审核</option>  
													<option value="3" >正在展示</option> 
                                                    </select>
                                                    </div>
                                                </div>
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="tianjias"  value="提交" class="btn btn-primary waves-effect waves-light" >
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
		<script>
	function ad_tp(type,val){
    var fl  = $("#"+type+"_add");
    if(val == 1){
       $(fl). hide()
    }
    if(val == 2){
       $(fl).show()
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
	  var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);
	 
});
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
	
});

                        $("#xiugai").click(function () {
						var id=$("input[name='id']").val();
						var uid=$("input[name='uid']").val();
						var time=$("input[name='time']").val();
						var text=$("textarea[name='text']").val();
						var type = $("#type").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Adxg",
							data: {id:id,uid:uid,time:time,text:text,type:type},
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
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Adshanchu",
							data: {ids:ids},
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
					$("#tianjias").click(function () {
						var text=$("textarea[name='textt']").val();
						var ad_typet = $("#ad_typet").val();
						var authidt = $("#authidt").val();
						var uidt=$("input[name='uidt']").val();
						var dtimet=$("input[name='dtimet']").val();
						var type = $("#typet").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Adtianjia",
							data: {text:text,ad_typet:ad_typet,authidt:authidt,uidt:uidt,dtimet:dtimet,type:type},
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