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
                                                <li class="breadcrumb-item active">卡密管理</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">添加卡密</h4>
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
												<a data-toggle="modal" data-target="#tianjia" data-id="tianjia"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i>添加卡密</a>
												</div>
                                            </div><!-- end col-->
                      <div class="table-responsive">
                      <table class="table table-bordered text-nowrap">
					  <thead style="text-align: center;">
                      <tr>
                                <th>ID</th>
                                <th>名称</th>
                                <th>卡密</th>
								<th>面额</th>
								<th>状态</th>
								<th>使用者(账号)</th>
								<th>操作</th>
								<th style="display: none">0</th>
								<th style="display: none">0</th>
								<th style="display: none">0</th>
								</tr>
          </thead>
          <tbody style="text-align: center;">
<?php
$sql=" 1";
	$numrows=$DB->query("SELECT count(*) from oreo_kami WHERE{$sql}")->fetchColumn();
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
$list=$DB->query("SELECT * FROM oreo_kami WHERE{$sql} order by id desc limit $offset,$pagesize");				
while($row = $list->fetch())
{	
											if($row['type']==1){
											$typ='<a style="color: blue;">已使用</a>';
											}else{$typ='<a style="color: red;">未使用</a>';}
											if($row['name']==1){
											$names='余额卡密';
											}else{$names=$row['name'];}
											echo "<tr >";
											echo "<td >".$row['id']."</td>";
											echo "<td >".$names."</td>";
											echo "<td >".$row['kami']."</td>";
											echo "<td >".$row['money']."</td>";
											echo "<td style='display: none;'>".$row['sysnum']."</td>";
											echo "<td style='display: none;'>".$row['sysname']."</td>";
											echo "<td >".$typ."</td>";
											echo "<td >".$row['username']."</td>";
											echo "<td style='display: none;'>".$row['type']."</td>";
											echo "<td ><a data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-xs btn-danger' >删除</a></td>";
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
echo '<li class="page-item"><a class="page-link" href="oreo_kami.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_kami.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_kami.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_kami.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_kami.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_kami.php?page='.$last.$link.'">尾页</a></li>';
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
                                                    <label>名称:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca1"  readonly="readonly"  />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>卡密:</label>
                                                    <div>
                                                      <input type="text" class="form-control ca2"  readonly="readonly"  name="kamisc"/>
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
                                               <h5 class="modal-title" id="exampleModalLabel">添加卡密信息</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                                 </button>
                                                  </div>
                                                   <div class="modal-body">
                                                  <div class="form-group">
                                                    <label>卡密形式</label>
                                                    <div>
                                                    <select class="form-control" name="names" id="names" onchange="km_sc('km',this.value)">
                                                    <option value="1" selected="selected">余额卡密</option>
                                                    <option value="2" >授权卡密</option>  
                                                    </select>
                                                    </div>
													<small>* 授权卡密只适用于普通用户！</small>
                                                </div>
												<div class="form-group" id="km_ye">
                                                    <label>面额</label>
                                                    <div>
													<input type="text" class="form-control" name="money" placeholder="请输入整数"/>
                                                    </div>
                                                </div>
												<div class="form-group" id="km_cx" style="display:none">
                                                    <label>授权系统</label>
                                                    <div>
                                                    <select class="form-control " name="sysnum" id="sysnum">
													<?php
													$sccs=$DB->query("SELECT * FROM `oreo_authsys` ");
                                                    while ($row = $sccs->fetch()) {
						                            echo "<option value={$row['syskeys']}>{$row['name']}</option>
													";
	                                                 }
					                                  ?>
                                                    </select>
                                                    </div>
													<div class="form-group">
                                                    <label>兑换对象</label>
                                                    <div>
                                                    <select class="form-control" name="hddx" id="hddx" >
                                                    <option value="1" selected="selected">所有用户</option>
                                                    <option value="2" >未授权用户</option>  
                                                    </select>
                                                    </div>
                                                </div>
                                                </div>
												<div class="form-group">
                                                    <label>是否批量</label>
                                                    <div>
                                                    <select class="form-control" name="pl" id="pl" onchange="km_sz('sz',this.value)">
                                                    <option value="1" selected="selected">生成1个</option>
                                                    <option value="2" >生成多个</option>  
                                                    </select>
                                                    </div>
                                                </div>
												<div class="form-group" id="sz_yg">
                                                    <label>卡密</label><input class="btn btn-success waves-effect waves-light" style="padding: inherit;" type= "button" name= "Submit1" value= "生成" onclick= "keys()">
                                                    <div>
													<input type="text" class="form-control ca6" id="kami" name="kami" />
													 <script language="javascript"> 
						                            function keys() 
						                             { 
						                            var str= "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789" 
						                            var result= " " 
						                            for(var i=0;i <32;i++) 
						                             { 
						                            var temp=Math.floor(Math.random()*36) 
						                            result+=str.charAt(temp) 
						                             } 
						                            hash = result.MD5();
						                            document.getElementById("kami").value=hash;
						                              } 
					                                 </script>
                                                    </div> 
                                                </div>
												<div class="form-group" id="sz_dg" style="display:none">
                                                    <label>生成数量</label>
                                                    <div>
													<input type="text" class="form-control" name="cssl" placeholder="请输入整数"/>
                                                    </div>
                                                </div>
												 <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="tjkm"  value="提交" class="btn btn-primary waves-effect waves-light" >
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
	function km_sc(type,val){
    var sq  = $("#"+type+"_cx");
	var yy  = $("#"+type+"_ye");
    if(val == 1){
       $(yy).show();
	   $(sq).hide(); 
    }
    if(val == 2){
       $(sq).show();
	   $(yy).hide(); 
    }        
}
	function km_sz(type,val){
    var ygs  = $("#"+type+"_yg");
	var dgs  = $("#"+type+"_dg");
    if(val == 1){
       $(ygs).show();
       $(dgs).hide(); 
    }
    if(val == 2){
       $(dgs).show();
	   $(ygs).hide(); 
    }        
}	

 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content); 
      var content = btnThis.closest('tr').find('td').eq(2).text();
      modal.find('.ca2').val(content);
	
});                      
					$("#shanchul").click(function () {
						var kamisc=$("input[name='kamisc']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Xckami",
							data: {kamisc:kamisc},
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
					$("#tjkm").click(function () {
						var names = $("#names").val();
						var money=$("input[name='money']").val();
						var sysnum = $("#sysnum").val();
						var hddx = $("#hddx").val();
						var pl = $("#pl").val();
						var kami = $("#kami").val();
						var cssl=$("input[name='cssl']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Tjkami",
							data: {names:names,money:money,sysnum:sysnum,hddx:hddx,pl:pl,kami:kami,cssl:cssl},
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