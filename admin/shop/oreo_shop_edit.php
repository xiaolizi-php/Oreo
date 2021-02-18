<?php
include "../../oreo/oreo.core.php";
include './oreo_shop_static.php';
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
                                                <li class="breadcrumb-item"><a href="#">担保平台</a></li>
                                                <li class="breadcrumb-item active">商品管理</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">商品管理</h4>
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
                                                <form class="form-inline" method="post" action="oreo_shop_user.php">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">搜索</label>
                                                        <input type="search"  name="my" class="form-control"  placeholder="搜索...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <select class="custom-select" name="column" >
                                                            <option selected>请选择...</option>
                                                            <option value="user">账号</option>
                                                            <option value="name">名称</option>
                                                            <option value="qq">用户QQ</option>
															<option value="phone">联系电话</option>
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
                                                <th>卖家账号</th>
								                <th>商品名称</th>
                                                <th>商品说明</th>
                                                <th>商品价格</th>
												<th>库存状态</th>
												<th>添加时间</th>
												<th>商品状态</th>
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
	$numrows=$DB->query("SELECT count(*) from oreo_shop_guarantee WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_shop_guarantee WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{
										   if($row['type']==1){$type="<a style='color: green;'>正在出售</a>";}else{$type="<a style='color: red;'>停止出售</a>";}
                                            echo '<tr >
											 <td >'.$row['seller'].'</td>
											 <td >'.$row['name'].'</td>
											 <td >'.$row['text'].'</td>
											 <td style="display: none;">'.$row['photo'].'</td>
											 <td >'.$row['money'].'</td>
											 <td >'.$row['stock'].'</td>
											 <td >'.$row['addtime'].'</td>
											 <td >'.$type.'</td>
											 <td style="display: none;">'.$row['type'].'</td>
											 <td ><a data-toggle="modal" data-target="#bianji" data-id="bianji" class="btn btn-xs btn-info">编辑</a>&nbsp;&nbsp;<a data-toggle="modal" data-target="#shanchu" data-id="shanchu" class="btn btn-xs btn-danger" >删除</a></td>
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
echo '<li class="page-item"><a class="page-link" href="oreo_shop_edit.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_edit.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_edit.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_shop_edit.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_shop_edit.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_shop_edit.php?page='.$last.$link.'">尾页</a></li>';
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
                                               <h5 class="modal-title" id="exampleModalLabel">编辑商品信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                   <div class="form-group">
                                                    <label>卖家账号:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="user" readonly="readonly"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>商品名称</label>
                                                    <div>
													<input type="text" class="form-control ca1" name="name"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>商品图标:</label>
                                                    <div>
                                                     <img src="" id="scan" alt="Raised Image" class="rounded img-raised ca3" style="width: 50%;">
                                                    </div>
                                                </div>
												<div class="form-group">
												  <label>商品说明</label>
                                                    <div>
                                                       <textarea  name="oreo_gg2" rows="5" class="form-control ca2"></textarea>
                                                       </div>
                                                    </div>
												
												<div class="form-group">
                                                    <label>商品价格</label>
                                                    <div>
													<input type="text" class="form-control ca4" name="phone"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>商品库存</label>
                                                    <div>
													<input type="text" class="form-control ca5" name="phone"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>库存状态</label>
                                                    <div>
                                                    <select class="form-control ca8" name="type" id="type">
                                                    <option value="1" >正常</option>
                                                    <option value="0" >封禁</option>  
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
                                                   <div class="form-group">
                                                    <label>账户:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca0" name="user_del" readonly="readonly" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>实名状态:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca6"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>账户余额:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca8"  readonly="readonly"  />
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
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->
             <?php include'oreo_shop_foot.php';?>
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
	  modal.find('.modal-body #scan').attr("src", content);
	  var content = btnThis.closest('tr').find('td').eq(4).text();
      modal.find('.ca4').val(content);
	  var content = btnThis.closest('tr').find('td').eq(5).text();
      modal.find('.ca5').val(content);
	  var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content); 
});
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(0).text();
      modal.find('.ca0').val(content); 
      var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content);
	  var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content); 
	 
});
                        $("#xiugai").click(function () {
						var user=$("input[name='user']").val();
						var name=$("input[name='name']").val();
						var qq=$("input[name='qq']").val();
						var phone=$("input[name='phone']").val();
						var email=$("input[name='email']").val();
						var money=$("input[name='money']").val();
						var type = $("#type").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=Shop_Edit_User",
							data: {user:user,name:name,qq:qq,phone:phone,email:email,money:money,type:type},
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
						var user=$("input[name='user_del']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=Shop_Del_User",
							data: {user:user},
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