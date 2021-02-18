<?php
include "../../oreo/oreo.core.php";
include './oreo_shop_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
$authsys=$DB->query("SELECT * FROM `oreo_authsys` ")->fetch();
if(!$authsys){ exit("<script language='javascript'>alert('您还未添加授权程序，为了不影响程序功能，请先添加您的程序');window.location.href='./oreo_auth.php';</script>");}
?>
                   <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">担保平台</a></li>
                                                <li class="breadcrumb-item active">实名认证</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">平台实名认证管理</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                             <div class="row mb-2">
                                            <div class="col-lg-8">
                                                <form class="form-inline" method="post" action="oreo_shop_real.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search"  name="my" class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="user">账号</option>
                                                            <option value="sfnumber">身份证号</option>
                                                            <option value="email">邮箱</option>
                                                        </select>
                                                    </div>                       
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <button type="submit" name="submit" class="btn btn-secondary  mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>搜索</button>
												</div>
                                            </div><!-- end col-->
                                        </div>
										<div class="table-responsive">
                                            <table class="table table-bordered text-nowrap" style="text-align:center;">
                                                <thead>
                                                <tr>
                                                <th>账号</th>
												<th>真实姓名</th>
                                                <th>身份证号</th>
												<th>支付宝账号</th>
                                                <th>申请时间</th>
												<th>实名状态</th>
								                <th style="display: none;">状态</th>
		                                        <th style="display: none;">状态</th>
								                <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
if(isset($_POST['submit'])) {
if($_POST['my']==''){
	$_POST['my']=1;
}
	if($_POST['column']=='name'){
		$sql="`{$_POST['column']}` like '%{$_POST['my']}%'";
	}else{
		$sql="`{$_POST['column']}`='{$_POST['my']}'";
	}
}else{
	$sql=" 1";
	$numrows=$DB->query("SELECT count(*) from oreo_shop_real WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_shop_real WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{
	                                       if($row['activation']==1){$real_type="<a style='color: red;'>未实名</a>";}
										   if($row['activation']==2){$real_type="<a style='color: green;'>已实名</a>";$real_edit="<a data-toggle='modal' data-target='#cksfzOk' data-id='cksfzOk' class='btn btn-xs btn-info'>点击查看</a>";}
										   if($row['activation']==3){$real_type="<a style='color: blue;'>待审核</a>";$real_edit="<a data-toggle='modal' data-target='#cksfz' data-id='cksfz' class='btn btn-xs btn-info'>点击查看</a>";}
                                            echo '<tr >
											 <td >'.$row['user'].'</td>
											 <td >'.$row['alipay_id'].'</td>
											 <td >'.$row['real_name'].'</td>
											 <td >'.$row['sfnumber'].'</td>
											 <td >'.$row['real_time'].'</td>
											 <td >'.$real_type.'</td>
											 <td style="display: none;">'.$row['sex'].'</td>
											 <td style="display: none;">'.$row['address'].'</td>
											 <td style="display: none;">'.$row['birthday'].'</td>
											 <td >'.$real_edit.'</td>
											 </tr>';
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
echo '<li class="page-item"><a class="page-link" href="oreo_shop_real.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_real.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_real.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_real.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_shop_real.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_real.php?page='.$last.$link.'">尾页</a></li>';
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
							<div class="modal fade bs-example-modal-center"   id="cksfz" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">查看详细</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>账号:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="user" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>支付宝账号:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca1"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>真实姓名:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca2"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>身份证号码:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca3"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>性别:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca6"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>详细地址:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca7"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>出生日期:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca8"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="pass"  value="通过" class="btn btn-primary waves-effect waves-light" >
                                                            通过
                                                        </button>
														 <button type="button" id="ends"  value="驳回" class="btn btn-danger waves-effect" >
                                                            驳回
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                           </div><!-- /.modal-content -->
                                       </div><!-- /.modal-dialog -->
                                   </div><!-- /.modal -->	
                                   <div class="modal fade bs-example-modal-center"   id="cksfzOk" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">查看详细</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>账号:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="user" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>支付宝账号:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca1"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>真实姓名:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca2"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>身份证号码:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca3"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>性别:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca6"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>详细地址:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca7"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>出生日期:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca8"  readonly="readonly"  />
                                                    </div>
                                                </div>
                                              </div>
                                           </div><!-- /.modal-content -->
                                       </div><!-- /.modal-dialog -->
                                   </div><!-- /.modal -->									   
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->
             <?php include'oreo_shop_foot.php';?>
<script>
$('#cksfz').on('show.bs.modal', function (event) {
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
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
	  var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);
	  var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content);
	 
});
$('#cksfzOk').on('show.bs.modal', function (event) {
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
	  var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
	  var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content);
	  var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content);
	 
});
					$("#pass").click(function () {
						var user=$("input[name='user']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=Shop_RealOk",
							data: {user:user},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('已给予通过', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					}); 	
					$("#ends").click(function () {
						var user=$("input[name='user']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=Shop_RealNo",
							data: {user:user},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('已驳回', function(index) {
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