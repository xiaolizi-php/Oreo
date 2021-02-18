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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item active">运营报告</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">运营报告</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-lg-8">
                                                <form class="form-inline" ">
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="status-select" class="mr-2">网站协议</label>
                                                        <select class="form-control ca8"  id="xieyi" name="xieyi">
                                                           <option value="1">http://</option>
                                                           <option value="2">https://</option>
                                                        </select>
                                                    </div>     
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="status-select" class="mr-2">选择站点</label>
                                                        <select class="form-control"  id="domain" name="domain">
                                                            <?php
													$sccs=$DB->query("SELECT * FROM `oreo_authorize`  WHERE sjid='$pid' ");
                                                    while ($row = $sccs->fetch()) {
						                            echo "<option value={$row['domain']}>{$row['domain']}</option>
													";
	                                                 }
					                                  ?>
                                                        </select>
                                                    </div>    
                                                                       
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <button type="button" id="huoqu"  class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i> 分析</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                       </form> 
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row" id="myDiv" style="visibility: hidden">

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <h4 class="header-title">今日订单</h4>

                                        <div class="mb-5 mt-4 chartjs-chart" style="height: 201px; max-width: 180px;">
                                            <canvas id="average-sales"></canvas>
                                        </div>

                                        <div class="chart-widget-list">
                                            <p>
                                                <i class="mdi mdi-square text-primary"></i> 当日订单
                                                <span class="float-right"><a id="now_total"></a></span>                                            </p>
                                            <p>
                                                <i class="mdi mdi-square text-danger"></i> 付款订单
                                                <span class="float-right"><a id="now_effective"></a></span>                                            </p>
                                            <p>
                                                <i class="mdi mdi-square text-success"></i> 付款总额
                                                <span class="float-right">￥<a id="now_allmoney"></a></span>                                            </p>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                          
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">订单详细</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>名称</th>
                                                        <th>结果</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 font-weight-normal">目前最高消费</h5>
                                                        </td>
                                                        <td>￥<a id="now_maxmoney"></a></td>
                                                       
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 font-weight-normal">出现最多的订单名称</h5>
                                                            
                                                        </td>
                                                        <td><a id="now_maxname"></a></td>
                                                        
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 font-weight-normal">完成订单最多的用户</h5>
                                                        </td>
                                                        <td><a id="now_maxpid"></a></td>
                                                       
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 font-weight-normal">今日最多支付方式</h5>
                                                            
                                                        </td>
                                                        <td><a id="now_maxtype"></a></td>
                                                        
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                   
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">用户相关</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>名称</th>
                                                        <th>结果</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 font-weight-normal">总用户数</h5>
                                                        </td>
                                                        <td><a id="user_count"></a></td>
                                                       
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 font-weight-normal">近三天注册用户数</h5>
                                                            
                                                        </td>
                                                        <td><a id="user_count_reg"></a></td>
                                                        
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 font-weight-normal">用户总余额</h5>
                                                        </td>
                                                        <td><a id="user_allmoney"></a></td>
                                                       
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    
                                                   
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                        </div>
                        <!-- end row -->
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
        <script src="../assets/user/js/Chart.bundle.min.js"></script>
        <script>
            
        $("#huoqu").click(function () { 
                        var domain = $("#domain").val();
                        var xieyi = $("#xieyi").val();
                        var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "./ajax2.php?act=Tongbu_Domain_Yy",
							data: {domain:domain,xieyi:xieyi},
							dataType: 'json',
							success: function (data) {
                                layer.close(ii);
								if (data.code == 1) {
                                var myDiv = document.getElementById('myDiv');
                                var val = myDiv.style.visibility;
                                if(val == 'hidden'){
                                 myDiv.style.visibility = 'visible'; //显示
                                 }
									$('#now_total').html(data.now_total) //当日订单
									$('#now_effective').html(data.now_effective) //付款订单
                                    $('#now_allmoney').html(data.now_allmoney)//付款总额
                                    $('#now_maxmoney').html(data.now_maxmoney)//金额最高的订单
                                    $('#now_maxname').html(data.now_maxname)//出现最多的订单名称
                                    $('#now_maxpid').html(data.now_maxpid)//完成订单最多的用户
                                    $('#now_maxtype').html(data.now_maxtype)//完成今日最多支付方式
                                    $('#user_count').html(data.user_count)//用户总数
                                    $('#user_count_reg').html(data.user_count_reg)//近三天注册用户数
                                    $('#user_allmoney').html(data.user_allmoney)//用户总余额        
!function(r){"use strict";
var t=function(){this.$body=r("body"),
this.charts=[]};
t.prototype.respChart=function(t,a,e,o)
{var n=Chart.controllers.line.prototype.draw;Chart.controllers.line.prototype.draw=function()
    {n.apply(this,arguments);
        var r=this.chart.chart.ctx,t=r.stroke;r.stroke=function(){r.save(),
            r.shadowColor="rgba(0,0,0,0.01)",
            r.shadowBlur=20,
            r.shadowOffsetX=0,
            r.shadowOffsetY=5,
            t.apply(this,arguments),
            r.restore()}};
            var s=Chart.controllers.doughnut.prototype.draw;Chart.controllers.doughnut=Chart.controllers.doughnut.extend({draw:function(){s.apply(this,arguments);var r=this.chart.chart.ctx,t=r.fill;r.fill=function(){r.save(),r.shadowColor="rgba(0,0,0,0.03)",r.shadowBlur=4,r.shadowOffsetX=0,r.shadowOffsetY=3,t.apply(this,arguments),r.restore()}}});var l=Chart.controllers.bar.prototype.draw;Chart.controllers.bar=Chart.controllers.bar.extend({draw:function(){l.apply(this,arguments);var r=this.chart.chart.ctx,t=r.fill;r.fill=function(){r.save(),r.shadowColor="rgba(0,0,0,0.01)",r.shadowBlur=20,r.shadowOffsetX=4,r.shadowOffsetY=5,t.apply(this,arguments),r.restore()}}}),Chart.defaults.global.defaultFontColor="#8391a2",Chart.defaults.scale.gridLines.color="#8391a2";var i=t.get(0).getContext("2d"),d=r(t).parent();return function(){var n;switch(t.attr("width",r(d).width()),a){case"Line":n=new Chart(i,{type:"line",data:e,options:o});break;case"Doughnut":n=new Chart(i,{type:"doughnut",data:e,options:o});break;case"Pie":n=new Chart(i,{type:"pie",data:e,options:o});break;case"Bar":n=new Chart(i,{type:"bar",data:e,options:o});break;case"Radar":n=new Chart(i,{type:"radar",data:e,options:o});break;case"PolarArea":n=new Chart(i,{data:e,type:"polarArea",options:o})}return n}()},t.prototype.initCharts=function(){var t=[];if(r("#revenue-chart").length>0){t.push(this.respChart(r("#revenue-chart"),"Line",{labels:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],datasets:[{label:"Current Week",backgroundColor:"transparent",borderColor:"#727cf5",data:[32,42,42,62,52,75,62]},{label:"Previous Week",fill:!0,backgroundColor:"transparent",borderColor:"#0acf97",data:[42,58,66,93,82,105,92]}]},{maintainAspectRatio:!1,legend:{display:!1},tooltips:{backgroundColor:"#727cf5",titleFontColor:"#fff",bodyFontColor:"#fff",bodyFontSize:14,displayColors:!1},hover:{intersect:!0},plugins:{filler:{propagate:!1}},scales:{xAxes:[{reverse:!0,gridLines:{color:"rgba(0,0,0,0.05)"}}],yAxes:[{ticks:{stepSize:20},display:!0,borderDash:[5,5],gridLines:{color:"rgba(0,0,0,0.01)",fontColor:"#fff"}}]}}))}if(r("#high-performing-product").length>0){var a=document.getElementById("high-performing-product").getContext("2d").createLinearGradient(0,500,0,150);a.addColorStop(0,"#fa5c7c"),a.addColorStop(1,"#727cf5");var e={labels:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],datasets:[{label:"Sales Analytics",backgroundColor:a,borderColor:a,hoverBackgroundColor:a,hoverBorderColor:a,data:[65,59,80,81,56,89,40,32,65,59,80,81]},{label:"Dollar Rate",backgroundColor:"#e3eaef",borderColor:"#e3eaef",hoverBackgroundColor:"#e3eaef",hoverBorderColor:"#e3eaef",data:[89,40,32,65,59,80,81,56,89,40,65,59]}]};t.push(this.respChart(r("#high-performing-product"),"Bar",e,{maintainAspectRatio:!1,legend:{display:!1},tooltips:{backgroundColor:"#727cf5",titleFontColor:"#fff",bodyFontColor:"#fff",bodyFontSize:14,displayColors:!1},scales:{yAxes:[{gridLines:{display:!1,color:"rgba(0,0,0,0.05)"},stacked:!1,ticks:{stepSize:20}}],xAxes:[{barPercentage:.7,categoryPercentage:.5,stacked:!1,gridLines:{color:"rgba(0,0,0,0.01)"}}]}}))}if(r("#average-sales").length>0){t.push(this.respChart(r("#average-sales"),"Doughnut",
            {labels:["当日订单","付款订单","付款总额"],
            datasets:[
                {
                data:[
                    data.now_total,//当日订单
                    data.now_effective,//付款订单
                    data.now_allmoney],//付款总额
                backgroundColor:["#727cf5","#fa5c7c","#0acf97"],
                borderColor:"transparent",borderWidth:"3"}]},
                {maintainAspectRatio:!1,cutoutPercentage:60,legend:{display:!1}}))}return t},
                t.prototype.initMaps=function(){r("#world-map-markers").length>0&&r("#world-map-markers").vectorMap({map:"world_mill_en",normalizeFunction:"polynomial",hoverOpacity:.7,hoverColor:!1,regionStyle:{initial:{fill:"#e3eaef"}},markerStyle:{initial:{r:9,fill:"#727cf5","fill-opacity":.9,stroke:"#fff","stroke-width":7,"stroke-opacity":.4},hover:{stroke:"#fff","fill-opacity":1,"stroke-width":1.5}},backgroundColor:"transparent",markers:[{latLng:[40.71,-74],name:"New York"},{latLng:[37.77,-122.41],name:"San Francisco"},{latLng:[-33.86,151.2],name:"Sydney"},{latLng:[1.3,103.8],name:"Singapore"}],zoomOnScroll:!1})},t.prototype.init=function(){var t=this;Chart.defaults.global.defaultFontFamily='-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',r("#dash-daterange").daterangepicker({singleDatePicker:!0}),t.charts=this.initCharts(),this.initMaps(),r(window).on("resize",function(a){r.each(t.charts,function(r,t){try{t.destroy()}catch(r){}}),t.charts=t.initCharts()})},r.Dashboard=new t,r.Dashboard.Constructor=t}(window.jQuery),function(r){"use strict";r.Dashboard.init()}(window.jQuery);
            } else {
                var myDiv = document.getElementById('myDiv');
                                var val = myDiv.style.visibility;
                                if(val == 'visible'){
                                 myDiv.style.visibility = 'hidden'; //隐藏
                                 }
                layer.alert(data.msg);
			}
		}
    });
  });  
            </script>
    </body>
</html>