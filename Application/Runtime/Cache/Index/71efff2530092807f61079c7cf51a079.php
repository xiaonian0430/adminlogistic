<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!-- Mirrored from www.zi-han.net/theme/hplus/index_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:46 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>仪表盘</title>
    <link rel="shortcut icon" href="favicon.ico"> 
	<link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/style_HUI/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <!-- Morris -->
    <link href="/Public/style_HUI/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="/Public/style_HUI/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="/Public/style_HUI/css/animate.min.css" rel="stylesheet">
    <link href="/Public/style_HUI/css/style.min862f.css?v=4.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-3">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-warning fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> 超时报警数 </span>
                            <h2 class="font-bold"><?php echo $time_out_count;?></h2>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-sm-3">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> 在途运单 </span>
                            <h2 class="font-bold"><?php echo $onway_count;?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-plus-square-o fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> 今日新增运单 </span>
                            <h2 class="font-bold"><?php echo $nowday_count;?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-check-square-o fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> 今日完成运单 </span>
                            <h2 class="font-bold"><?php echo $finish_count;?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>运单趋势</h5>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-white active">天</button>
                                <button type="button" class="btn btn-xs btn-white">月</button>
                                <button type="button" class="btn btn-xs btn-white">年</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <ul class="stat-list">
                                    <li>
                                        <h2 class="no-margins"><?php echo $all_count;?></h2>
                                        <small>订单总数</small>
                                        <div class="stat-percent"></div>
                                        <div class="progress progress-mini">
                                            <div style="width: 48%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins "><?php echo $week_count;?></h2>
                                        <small>最近一周订单</small>
                                        <?php if($week_percent < '0'): ?><div class="stat-percent"><?php echo 0-$week_percent;?><i class="fa fa-level-down text-navy"></i></div><?php endif; ?>
										 <?php if($week_percent >= '0'): ?><div class="stat-percent"><?php echo $week_percent;?><i class="fa fa-level-up text-navy"></i></div><?php endif; ?>
                                        <div class="progress progress-mini">
                                            <div style="width: 60%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins "><?php echo $month_count;?></h2>
                                        <small>最近一个月订单</small>
                                         <?php if($month_percent < '0'): ?><div class="stat-percent"><?php echo 0-$month_percent;?><i class="fa fa-level-down text-navy"></i></div><?php endif; ?>
										 <?php if($month_percent >= '0'): ?><div class="stat-percent"><?php echo $month_percent;?><i class="fa fa-level-up text-navy"></i></div><?php endif; ?>
                                        <div class="progress progress-mini">
                                            <div style="width: 22%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>运单业务分布（最近一月）</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
							<a class="close-link">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
					<div class="ibox-content">

						<div class="row">
							<div class="col-sm-6">
								<table class="table table-hover margin bottom">
									<thead>
										<tr>
											<th style="width: 8%" class="text-center">排名</th>
											<th>地区</th>
											<th style="width: 12%" class="text-right">运单数</th>
										</tr>
									</thead>
									<tbody>
										<?php if(is_array($area_waybill_x)): $k = 0; $__LIST__ = $area_waybill_x;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
											<td class="text-center">
												<?php echo $k;?>
											</td>
											<td>
												<?php echo $vo['name'];?></small>
											</td>                                                 
											<td class="text-right">
												<span class="label label-primary <?php if($k <= '3'): ?>label-warning<?php endif; ?>"><?php echo $vo['value'];?></span>
											</td>
										</tr><?php endforeach; endif; else: echo "" ;endif; ?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-6">
								<div id="world-map" style="height: 380px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="/Public/style_HUI/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Public/style_HUI/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Public/style_HUI/js/plugins/flot/jquery.flot.js"></script>
    <script src="/Public/style_HUI/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/Public/style_HUI/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/Public/style_HUI/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/Public/style_HUI/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/Public/style_HUI/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="/Public/style_HUI/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/Public/style_HUI/js/demo/peity-demo.min.js"></script>
    <script src="/Public/style_HUI/js/content.min.js?v=1.0.0"></script>
    <script src="/Public/style_HUI/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/Public/style_HUI/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/Public/style_HUI/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/Public/style_HUI/js/plugins/easypiechart/jquery.easypiechart.js"></script>
	<script src="/Public/style_HUI/js/plugins/echarts/echarts.min.js"></script>
    <script src="/Public/style_HUI/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="/Public/style_HUI/js/demo/sparkline-demo.min.js"></script>
    <script>
		
		$(document).ready(function() {
			$(".chart").easyPieChart({
				barColor: "#f8ac59",
				scaleLength: 5,
				lineWidth: 4,
				size: 80
			});
			$(".chart2").easyPieChart({
				barColor: "#1c84c6",
				scaleLength: 5,
				lineWidth: 4,
				size: 80
			});
			//var data2 = [[gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8], [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4], [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6], [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8], [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6], [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13], [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8], [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]];
			//var data3 = [[gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700], [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589], [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700], [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786], [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888], [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567], [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900], [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]];
			var data2=[];
			var data3=[];
			var dataset = [
				{
					label: "接单数",
					data: data3,
					color: "red",
					lines: {
						lineWidth: 1,
						show: true,
						fill: false,
						fillColor: {
							colors: [
								{
									opacity: 0.2
								},
								{
									opacity: 0.2
								}
							]
						}
					}
				},
				{
					label: "完成数",
					data: data2,
					yaxis: 2,
					color: "#464f88",
					lines: {
						lineWidth: 1,
						show: true,
						fill: false,
						fillColor: {
							colors: [{
								opacity: 0.2
							},
							{
								opacity: 0.2
							}]
						}
					},
					splines: {
						show: false,
						tension: 0.6,
						lineWidth: 1,
						fill: 0.1
					},
				}
			];
			var options = {
				xaxis: {
					mode: "time",
					tickSize: [3, "day"],
					tickLength: 0,
					axisLabel: "Date",
					axisLabelUseCanvas: true,
					axisLabelFontSizePixels: 12,
					axisLabelFontFamily: "Arial",
					axisLabelPadding: 10,
					color: "#838383"
				},
				yaxes: [
					{
						position: "left",
						max: 1070,
						color: "#838383",
						axisLabelUseCanvas: true,
						axisLabelFontSizePixels: 12,
						axisLabelFontFamily: "Arial",
						axisLabelPadding: 3
					},
					{
						position: "right",
						clolor: "#838383",
						axisLabelUseCanvas: true,
						axisLabelFontSizePixels: 12,
						axisLabelFontFamily: " Arial",
						axisLabelPadding: 67
					}
				],
				legend: {
					noColumns: 1,
					labelBoxBorderColor: "#000000",
					position: "nw"
				},
				grid: {
					hoverable: false,
					borderWidth: 0,
					color: "#838383"
				}
			};
			function gd(year, month, day) {
				return new Date(year, month - 1, day).getTime()
			}
			var previousPoint = null,previousLabel = null;
			$.plot($("#flot-dashboard-chart"), dataset, options);
			var mapData = {
				"US": 298,
				"SA": 200,
				"DE": 220,
				"FR": 540,
				"CN": 120,
				"AU": 760,
				"BR": 550,
				"IN": 200,
				"GB": 120,
			};
			
			$.get('/Public/style_HUI/data/guizhou.json', function (geoJson){   
				echarts.registerMap('guizhou', geoJson);
				var myChart = echarts.init(document.getElementById('world-map'));
				myChart.hideLoading();
				var datax=<?php echo $area_waybill_x_json;?>;
				myChart.setOption({
					visualMap: {
						min: 0,
						max: 2500,
						left: 'right',
						top: 'bottom',
						text: ['高','低'],
						calculable: true
					},
					tooltip: {
						trigger: 'item'
					},
					series: [{
						type: 'map',
						name: '运单量',
						map: 'guizhou',
						roam: false,
						label: {
							normal: {
								show: true
							},
							emphasis: {
								show: true
							}
						},
						data:datax,
					}]
				});
			});
		});
    </script>
	<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
<!-- Mirrored from www.zi-han.net/theme/hplus/index_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:49 GMT -->
</html>