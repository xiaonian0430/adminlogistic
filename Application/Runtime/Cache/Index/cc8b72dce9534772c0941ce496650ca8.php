<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物流运单</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/style_HUI/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/jqgrid/ui.jqgridffe4.css?0820" rel="stylesheet">
    <link href="/Public/style_HUI/css/animate.min.css" rel="stylesheet">
    <link href="/Public/style_HUI/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/jqgrid/main.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/Public/style_HUI/css/shouhuo/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/Public/style_HUI/css/shouhuo/cs-select.css" />
    <link rel="stylesheet" type="text/css" href="/Public/style_HUI/css/shouhuo/cs-skin-underline.css" />
	<link rel="stylesheet" type="text/css" href="/Public/style_HUI/css/jquery.tagsinput.css" />
	<link rel="stylesheet" type="text/css" href="/Public/css/sh_formstyle.css" />
	<link href="/Public/style_HUI/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	<script src="/Public/style_HUI/js/jquery.min.js?v=2.1.4"></script>
	<script type="text/javascript" src="/Public/style_HUI/js/jquery.tagsinput.js"></script>
	<script src="/Public/jsrender/jsrender.min.js"></script>
	<script src="/Public/jsrender/jsviews.js"></script>
	
    <style type="text/css">
       .modal-content1
        {
			top: -11px !important;
			left: calc(50% - 365px) !important;
			height:95% !important;
			width: 730px !important;
        }
		.modal-content2
        {
			height:550px !important;
        }
		.modal-content3
		{
			top:0px !important;
			left:0px !important;
			height: auto !important;
			width: 90% !important;
			max-width:700px !important;
			margin:auto !important;
		}
	
        .modal-dialog,
		.modal-dialog{
			width: 100%;
        }
        .modal-footer
        {
			text-align: center;
			padding: 0.5%;
        }
        .inmodal .modal-body
        {
			background-color: #ffffff;
        }
        .modal-body
        {
			padding: 0 40px;
			overflow: auto;
			height:calc(100% - 93px);
        }
		.modal-body2
        {
			padding: 0 40px;
			overflow: auto;
			height:calc(100% - 88px);
        }
        .inmodal .modal-title
        {
			padding: 5px 0;
			font-size: 19px;
        }
        .inmodal .modal-header
        {
			padding:  0;
			border: none;
        }
        .vertical-timeline-icon
        {
			left: 10px;
			width: 20px;
			height: 20px
        }
        .vertical-timeline-content
        {
			padding: 0 1em;
        }
        .vertical-timeline-content p
        {
			margin: 2px 0;
        }
        .container-fluid
        {
        width: 100%;
        margin: 2% 0;
        }
        .span8  > .table > tbody > tr > td:nth-child(2n-1)
        {
        border:1px solid rgb(172,203,234);border-right-color:white;
        text-align: left;
        width: 16% !important;
        }
        .span8   >.table > tbody > tr > td:nth-child(2n)
        {
        border:1px solid rgb(172,203,234);border-left-color:white;
        text-align: right;
        }
        .span8  > .table > tbody > tr > td:nth-child(14)
        {
        width: 75% !important;
        }
        .modal-dialog , .modal
        {
        height: 100%;
        }
        #myModal2
        {
        overflow: hidden;
        }
        .modal-dialog
        {
        margin: 15px 0 0 0 !important;
        }
        .span8
        {
        border:1px solid rgb(172,203,234);
        }
        .table
        {
        margin-bottom: 0 !important;
        }
        .row-fluid
        {
        color: rgb(123, 125, 130);
        }
        .vertical-timeline-icon 
        {
        background-color: #23c6c8;
        }
        .input-group
        {
        width: 160px;
        display: inline-flex;
        top: 2px;
        }
        .form-control
        {
        text-align: center;
        }
        .select
        {
        padding: 8px;
        margin-top: 1px;
        position: relative;
        }
        option
        {
        padding: 8px;
        height: 400px;
        }
        .wrapper, .jqGrid_wrapper, .ui-jqgrid, .ui-jqgrid-view
        {
            height: 99% !important;
        }
        .cs-select ul
        {
            background-color: rgb(33,198,200);
            color: white;
            text-align: center;
        }
        div.cs-skin-underline
        {
            width: 170px;
            background-color: rgb(33,198,200);
            color: white;font-size: 14px;
        }
        .cs-placeholder
        {
            text-align: center;
            font-size: 14px;
        }
        .cs-options > ul > li > span
        {
            font-size: 14px;
        }
        .modalDiv
        {
            margin-top: 10px;
        }
		.modalDiv section{
			margin-top: 10px;
			margin-left: 0px;
		}
        div.cs-select
        {
            z-index: 98;
        }
        div.cs-select1
        {
            z-index: 99
        }
		 div.cs-select2
        {
            z-index: 97
        }
		 div.cs-select3
        {
            z-index: 96
        }
        .fhbutton
        {
            position: absolute;
            z-index: 99;
            top: 25px;
            left: 18px;
            width: auto;
			width:120px;
            height: 30px;
            font-size: 13px;
            background: #23C6C8;
			padding-left:5px;
			padding-right:5px;
        }
		
		.fhbutton1{
			left: 150px;
		}
		
		.fhbutton2{
			left: 280px;
		}
		
		.fhbutton3{
			left:410px;
			background-color:rgb(181,0,181);
		}
		
		.right-bottom-float
        {
          display: none !important;
        }
		.modal-footer button .btn-click-gray{
			background-color:gray;
		}
		.modal-header .close{
			background-color:red;
			color:black;
			border-radius:50%;
			height:35px;
			width:35px;
			outline:none;
			margin-right:5px;
			margin-top:-2px;
		}
    </style>
	<script type="text/javascript">
		function onAddTag(tag){
			alert("添加运单号: " + tag);
		}
		function onRemoveTag(tag){
			alert("移除运单号: " + tag);
		}

		function onChangeTag(input,tag){
			alert("修改运单号: " + tag);
		}

		$(function(){
			$('#waybill_add_rec').tagsInput({
				width: 'auto',
				onChange: function(elem, elem_tags){
					
				},
				onAddTag:function(elem_tag){
					var reponseurl='<?php echo U("index/index/check_waybill_no_rec");?>';
					var postdata={waybill_no:elem_tag};
					$.post(reponseurl,postdata,function(data){
						show_no(elem_tag,data,'');
					},"json");
				}
			});
			$('#waybill_add_send').tagsInput({
				width: 'auto',
				onChange: function(elem, elem_tags){
					
				},
				onAddTag:function(elem_tag){
					var area=$("#area").prev().find("li.cs-selected").attr('data-value');
					var subarea=$("#subarea").prev().find("li.cs-selected").attr('data-value');
					if(area==null || area==''){
						area=0;
					}
					if(subarea==null  ||subarea==''){
						subarea=0;
					}
					var reponseurl='<?php echo U("index/index/check_waybill_no_send");?>';
					var postdata={tag:1,waybill_no:elem_tag,area:area,subarea:subarea};
					$.post(reponseurl,postdata,function(data){
						show_no(elem_tag,data,'#js-batch-send-ok');
					},"json");
					
				}
			});
			
			$('#waybill_add_send_x2').tagsInput({
				width: 'auto',
				onChange: function(elem, elem_tags){
					
				},
				onAddTag:function(elem_tag){
					var reponseurl='<?php echo U("index/index/check_waybill_no_send");?>';
					var postdata={tag:0,waybill_no:elem_tag};
					$.post(reponseurl,postdata,function(data){
						show_no(elem_tag,data,'');
					},"json");
				}
			});
		});
		
		function show_no(elem_tag,data,type){
			var code=data.code;
			var msg=data.msg;
			var packages=data.data.packages;
			var price=data.data.price;
			var insurance=data.data.insurance;
			
			$("#"+elem_tag).removeClass("loading");
			$("#"+elem_tag).attr('code',code);
			
			if(code==1){
				$("#"+elem_tag).addClass('ok');
				$("#"+elem_tag).children("span").text(elem_tag+" (件数："+packages+" 价格：￥"+price+" 报价金额：￥"+insurance+" 提示：正常！) ");
				if(type!='')
				{
					var num=$(type).attr('num');
					num++;
					$(type).attr('num',num);
				}
			}else if(code==0){
				$("#"+elem_tag).addClass('warm');
				$("#"+elem_tag).children("span").text(elem_tag+" (提示："+msg+") ");
			}else if(code==2){
				$("#"+elem_tag).addClass('alert');
				$("#"+elem_tag).children("span").text(elem_tag+" (件数："+packages+" ￥价格："+price+" 报价金额：￥"+insurance+" 提示："+msg+") ");
			}
		}
	</script>
</head>
<body class="gray-bg">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content1 modal-content modal-content2 modal-content3">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">发货（货车司机）</h4>
		</div>
		<div class="modal-body">
		<div class="modalDiv">
		<span>请选择司机：</span>
		<section style="display:inline-block">
			<select class="cs-select cs-skin-underline cs-select1" name="driver" id="driver">
				<option value="" disabled selected>请选择司机</option>
				<?php if(is_array($drivers)): $i = 0; $__LIST__ = $drivers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</section>
    
    </div>
	<div class="modalDiv">
      <span>请选择网点：</span>
      <section style="display:inline-block;" >
			<select style="z-index:-1 !important;" class="cs-select cs-skin-underline" name="area" id="area" value="0">
				<option value="" disabled selected>请选择所在地区</option>
				<?php if(is_array($area)): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
      </section>
      <section style="display:inline-block;">
			<select class="cs-select cs-skin-underline cs-select2" name="subarea" id="subarea" value="0">
				<option value="" disabled selected>请选择所在县市区</option>
			</select>
      </section>
      <section style="display:inline-block;">
			<select class="cs-select cs-skin-underline cs-select3" name="wangdian" id="wangdian">
				<option value="" disabled selected>请选择网点</option>
			</select>
      </section>
	
    </div>
	<div style="margin-top:20px;">
		<p>
			<label>添加运单号（手动输入和扫描的方式均可），可添加多个。若手动输入请用【回车键】分隔）</label>
			<input id="waybill_add_send" type="text" class="tags" value="" />
		</p>
	</div>
    
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="js-batch-send-ok" num="0" style="height: 34px;line-height: 23px;font-size: 16px;">确定</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalx2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content1 modal-content modal-content2 modal-content3">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">发货（小件员）</h4>
		</div>
		<div class="modal-body">
		<div class="modalDiv">
		<span>请选择小件员：</span>
		<section style="display:inline-block">
			<select class="cs-select cs-skin-underline cs-select1" name="zcxjy" id="zcxjy">
				<option value="" disabled selected>请选择小件员</option>
				<?php if(is_array($zcxjys)): $i = 0; $__LIST__ = $zcxjys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</section>
    
    </div>
	<div style="margin-top:20px;">
		<p>
			<label>添加运单号（手动输入和扫描的方式均可），可添加多个。若手动输入请用【回车键】分隔）</label>
			<input id="waybill_add_send_x2" type="text" class="tags" value="" />
		</p>
	</div>
    
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="js-batch-send-ok-x2" num="0" style="height: 34px;line-height: 23px;font-size: 16px;">确定</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content1 modal-content modal-content2 modal-content3">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">收货</h4>
		</div>
		<div class="modal-body">
		<div style="margin-top:20px;">
			<p>
				<label>添加运单号（手动输入和扫描的方式均可），可添加多个。若手动输入请用【回车键】分隔）</label>
				<input id="waybill_add_rec" type="text" class="tags" value="" />
			</p>
		</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			<button type="button" class="btn btn-primary" id="js-batch-receive-ok" style="height: 34px;line-height: 23px;font-size: 16px;">确定</button>
		</div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalx3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content3 modal-content modal-content2">
			<div class="modal-header" style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h2 class="modal-title" id="myModalLabel" style="font-weight:bold;">录入收货人信息</h2>
			</div>
			<div class="modal-body" style="height:600px;overflow:auto;">
				<div id="form-main">
					<div id="form-div">
						<form class="form" id="sh_form1">
							<p class="name">搜索运单号（运单号手动输入和扫描录入均可）</p>
							<p class="name">
								<input name="waybill_no" type="text" class="validate[required,custom[onlyLetter],length[0,20]] feedback-input feedback-input-search" placeholder="查询运单编号" id="sh_waybill_no" />
							</p>
							<p class="name">
								<span class="feedback-label">供货商名称：<span><input name="tel" type="text" disabled="disabled" class="validate[required,custom[onlyLetter],length[0,20]] feedback-input feedback-input-no" id="sh_supplier"/>
							</p>
							<p class="name">
								<span class="feedback-label">供货商主管：<span><input name="tel" type="text" disabled="disabled" class="validate[required,custom[onlyLetter],length[0,20]] feedback-input feedback-input-no" id="sh_supplier_leader"/>
							</p>
							<p class="name">
								<span class="feedback-label">供货商电话：<span><input name="tel" type="text" disabled="disabled" class="validate[required,custom[onlyLetter],length[0,20]] feedback-input feedback-input-no" id="sh_supplier_tel"/>
							</p>
							<p class="name">
								<span class="feedback-label">供货商地址：<span><input name="tel" type="text" disabled="disabled" class="validate[required,custom[onlyLetter],length[0,20]] feedback-input feedback-input-no" id="sh_supplier_address"/>
							</p>
							<p class="name" id="sh_search_msg" style="height:20px;padding-left:30px;color:red;"></p>
							<p class="name">补充下面信息：</p>
							<p class="name">
								<input name="tel" type="text" class="validate[required,custom[onlyLetter],length[0,20]] feedback-input" placeholder="收货人电话" id="sh_tel" />
							</p>
							<p class="name">
								<input name="name" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="收货人姓名" id="sh_name" />
							</p>
							<p class="name">
								<span>选择区域</span>
								<select id="sh_area" name="area" class="feedback-select"></select>
								<span>选择城市</span>
								<select id="sh_subarea" name="subarea" class="feedback-select"></select>
							</p>
							<p class="name">
								<input name="address" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="收货人地址" id="sh_address" />
							</p>
							<p class="text">
								<textarea name="remark" class="validate[required,length[6,300]] feedback-input" id="sh_remark" placeholder="备注信息"></textarea>
							</p>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" id="js-receive-sh-ok" tag="0" style="height: 34px;line-height: 23px;font-size: 16px;">确定</button>
			</div>
		</div>
  </div>
</div>
<button type="button" class="btn btn-primary btn-lg fhbutton js-batch-receive" data-toggle="modal" data-target="#myModalx">
  <span style="color:#ec157a;">网点收货</span>
</button>
<button type="button" class="btn btn-primary btn-lg fhbutton fhbutton1 js-batch-send" data-toggle="modal" data-target="#myModal">
  <span style="color:#ec157a;">发货给货车司机</span>
</button>
<button type="button" class="btn btn-primary btn-lg fhbutton fhbutton2 js-batch-send-x2" data-toggle="modal" data-target="#myModalx2">
  <span style="color:#ec157a;">发货小件员</span>
</button>
<button type="button" class="btn btn-primary btn-lg fhbutton fhbutton3 js-batch-receive-one" data-toggle="modal" data-target="#myModalx3">
	<span>录入收货人信息</span>
</button>
    <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content1  modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
				</button>
				<h3 class="modal-title" style="color:black">物流订单详细信息</h3>
            </div>
            <div class="modal-body">
                <div class="" id="ibox-content">
					<div class="container-fluid">
						<div class="row-fluid">
							<div class="span8">
								<table id="render_table" class="table">
									<tbody>
										<tr>
											<td>
												寄&ensp;件&ensp;人:
											</td>
											<td >
												水岸新都
											</td>
											<td>
												联系电话:
											</td>
											<td>
												17008056660
											</td>
										</tr>
										<tr>
											<td>
												收&ensp;件&ensp;人:
											</td>
											<td>
												水岸新都
											</td>
											<td>
												联系电话:
											</td>
											<td>
												17008056660
											</td>
										</tr>
										<tr>
											<td>
												物流单号：
											</td>
											<td>
												123456678900
											</td>
											<td>
												物流公司:
											</td>
											<td>
												顺丰快递
											</td>
										</tr>
										<tr>
											<td>
												发货地址：
											</td>
											<td colspan="1" style="border:1px solid rgb(172,203,234);">
												贵州省贵阳市中华南路中都大厦20层
											</td>
											 <td>
												收货地址：
											</td>
											<td colspan="1" style="border:1px solid rgb(172,203,234);">
												贵州省贵阳市中华南路中都大厦20层
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="span4"></div>
						</div>
					</div>
					<div style="border-top:1px solid rgb(172,203,234);"></div>
                    <div id="vertical-timeline" class="vertical-c<!-- o -->ntainer light-timeline">
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg"></div>
								<div class="vertical-timeline-content">
                                <p>
                                    <span>
                                        10:40:44
                                    </span>
                                    <span>
                                        商家正通知快递公司揽件
                                    </span>
                                    </br>
                                    <span>
                                        10:40:44
                                    </span>
                                    <span>
                                        【景德镇市】申通快递 江西景德镇公司收件员 已揽件
                                    </span>
                                </p>
                                <span class="vertical-date">
                                    <small>
                                        周一
                                    </small>
                                    <small>
                                        2月3日
                                    </small>
                                </span>
								</div>
                        </div>
								<div class="vertical-timeline-block">
									<div class="vertical-timeline-icon blue-bg">
									</div>
									<div class="vertical-timeline-content">
										<span>
											10:40:44
										</span>
										<span>
											商家正通知快递公司揽件
										</span>
										</br>
										<span>
											10:40:44
										</span>
										<span>
											【景德镇市】申通快递 江西景德镇公司收件员 已揽件
										</span>
										</p>
										<span class="vertical-date">
											<small>
												周二
											</small>
											<small>
												2月4日
											</small>
										</span>
										</span>
									</div>
								</div>
							<div class="vertical-timeline-block">
								<div class="vertical-timeline-icon lazur-bg">
								</div>
								<div class="vertical-timeline-content">
									<p>
										<span>
											10:40:44
										</span>
										<span>
											商家正通知快递公司揽件
										</span>
										</br>
										<span>
											10:40:44
										</span>
										<span>
											【景德镇市】申通快递 江西景德镇公司收件员 已揽件
										</span>
									</p>
									<span class="vertical-date">
										<small>
											周二
										</small>
										<small>
											2月4日
										</small>
									</span>
								</div>
							</div>
							<div class="vertical-timeline-block">
								<div class="vertical-timeline-icon yellow-bg">
								</div>
								<div class="vertical-timeline-content">
									<p>
										<span>
											10:40:44
										</span>
										<span>
											商家正通知快递公司揽件
										</span>
										</br>
										<span>
											10:40:44
										</span>
										<span>
											【景德镇市】申通快递 江西景德镇公司收件员 已揽件
										</span>
									</p>
									<span class="vertical-date">
										<small>
											周二
										</small>
										<small>
											2月4日
										</small>
									</span>
								</div>
							</div>
							<div class="vertical-timeline-block">
								<div class="vertical-timeline-icon lazur-bg">
								</div>
								<div class="vertical-timeline-content">
									<p>
										<span>
											10:40:44
										</span>
										<span>
											商家正通知快递公司揽件
										</span>
										</br>
										<span>
											10:40:44
										</span>
										<span>
											【景德镇市】申通快递 江西景德镇公司收件员 已揽件
										</span>
									</p>
									<span class="vertical-date">
										<small>
											周二
										</small>
										<small>
											2月4日
										</small>
									</span>
								</div>
								</span>
							</div>
					</div>             
					</div>
				<p class="baoguo">该包裹所在位置</p>
				<div class="col-sm-9" style="position:relative;width:80%;left:10%;">
					<div id="staffmap" style="min-height: 400px;"></div>
				</div>
            </div>
			  <div class="modal-footer"> 
				  <button type="button" class="btn btn-white" data-dismiss="modal" style="background-color:#1ab394;color:#ffffff">关闭</button>
			  </div>
		</div>
	  </div>
	  </div>
    <div class="wrapper wrapper-content ">
        <div class="jqGrid_wrapper">     
            <table id="table_list_2"></table>
            <div id="pager_list_2"></div>
        </div>
	</div>
	<script src="/Public/style_HUI/js/jquery.toolbar.js" type="text/javascript"> </script>
    <script src="/Public/style_HUI/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Public/style_HUI/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/Public/style_HUI/js/plugins/jqgrid/i18n/grid.locale-cnffe4.js?0820"></script>
    <script src="/Public/style_HUI/js/plugins/jqgrid/jquery.jqGrid.minffe4.js?0820"></script>
    <script src="/Public/style_HUI/js/content.min.js?v=1.0.0"></script>
	<script src="/Public/style_HUI/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="/Public/style_HUI/css/shouhuo/classie.js"></script>
    <script type="text/javascript" src="/Public/style_HUI/css/shouhuo/selectFx.js"></script>
	
	
    <script>
		(function() {
			[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {    
				new SelectFx(el);
			} );
		})();
	</script>
	
    <script src="http://api.map.baidu.com/api?v=2.0&ak=El90p9rRC2qx2lcCifK0zeeY"></script>
    
	<script id="theTmpl" type="text/x-jsrender">
	<tbody>
		<tr>
			<td>
				寄&ensp;件&ensp;人:
			</td>
			<td >
				{{>supplier_name}}
			</td>
			<td>
				联系电话:
			</td>
			<td>
				{{>supplier_tel}}
			</td>
		</tr>
		<tr>
			<td>
				收&ensp;件&ensp;人:
			</td>
			<td>
				{{>name}}
			</td>
			<td>
				联系电话:
			</td>
			<td>
				{{>tel}}
			</td>
		</tr>
		<tr>
			<td>
				物流单号：
			</td>
			<td>
				{{>waybill_no}}
			</td>
			<td>
				物流公司:
			</td>
			<td>
				{{>waybill_name}}
			</td>
		</tr>
		<tr>
			<td>
				发货地址：
			</td>
			<td colspan="1" style="border:1px solid rgb(172,203,234);">
				{{>supplier_address}}
			</td>
			 <td>
				收货地址：
			</td>
			<td colspan="1" style="border:1px solid rgb(172,203,234);">
				{{>area}}{{>subarea}}-{{>address}}
			</td>
		</tr>
	   
	</tbody>
	</script>
	
	<script id="theTmpl2" type="text/x-jsrender">
	<div class="vertical-timeline-block">
		<div class="vertical-timeline-icon navy-bg">
		</div>
		<div class="vertical-timeline-content">
			<p>
				<span>{{>add_time}}</span>&#12288;&#12288;
				<span>{{>title}}</span>&#12288;&#12288;
				<span>操作人：{{>operator}}</span>
				<br/>
				<span>备注：{{>remark}}</span>
			</p>
		</div>
	</div>
	</script>
	
	<script id="theTmpl3" type="text/x-jsrender">
		<option value="{{>id}}">{{>name}}</option>
	</script>
	<script id="theTmpl4" type="text/x-jsrender">
		<li data-option="" data-value="{{>id}}"><span>{{>name}}</span></li>
	</script>
	<script id="theTmpl5" type="text/x-jsrender">
		<option value="{{>id}}">{{>name}}</option>
	</script>
	<script id="theTmpl6" type="text/x-jsrender">
		<li data-option="" data-value="{{>id}}"><span>{{>name}}</span></li>
	</script>
	
	<script id="theTmp2Ax" type="text/x-jsrender">
	<option {{>select}} value="{{>name}}">{{>name}}</option>
	</script>
	<script id="theTmp3Ax" type="text/x-jsrender">
		<option {{>select}} value="{{>name}}">{{>name}}</option>

	</script>
	<script id="theTmp4Ax" type="text/x-jsrender">
		<option value="{{>name}}">{{>name}}</option>

	</script>

	<script>
	function repose_con_info(tel)
	{
		var reponseurl='<?php echo U("index/index/con_info");?>';
		$.ajax({
			type: "post",
			url: reponseurl,
			data: {val2: tel},
			success: function (data) {
				var status = data.status;
				var msg = data.msg;
				var area = data.result.area;
				var subarea = data.result.subarea;
				var cons = data.result.info.cons;
				var addr = data.result.info.addr;
				$("#sh_name").val(cons);
				$("#sh_address").val(addr);
				$.templates("#theTmp2Ax").link("#sh_area", area);
				$.templates("#theTmp3Ax").link("#sh_subarea", subarea);
			   
				$('#sh_area').change(function () {
					var reponseurl='<?php echo U("index/index/subarea_find");?>';
					var optionVal = $('#sh_area option:selected').val();
					$.ajax({
						type: "post",
						url: reponseurl,
						data: {area: optionVal},
						success: function (data) {
							var status = data.status;
							var msg = data.msg;
							var result = data.result;
							if (status == 1) {
								$.templates("#theTmp4Ax").link("#sh_subarea", result);
							} else {
								$('#sh_search_msg').text(msg);
								return false;
							}
						}
					});
				});

				if (status == 0) {
					$('#sh_search_msg').text(msg);
					return false;
				}
			}
		});
	}
    $(document).ready(function() {
	$('.js-batch-receive-one').click(function(){
		$('#sh_form1')[0].reset();
		var obj=$("#sh_tel,#sh_name,#sh_area,#sh_subarea,#sh_address,#sh_remark");
		obj.attr("disabled","disabled");
		$('#sh_area,#sh_subarea').val('');
	});
	$('#sh_waybill_no').bind('input propertychange',function(){
		var obj=$("#sh_tel,#sh_name,#sh_area,#sh_subarea,#sh_address,#sh_remark");
		var obj2=$("#sh_supplier,#sh_supplier_tel,#sh_supplier_leader,#sh_supplier_address");
		obj.val("");
		obj2.val("");
		obj.attr("disabled","disabled");
		var waybill_no = $.trim($(this).val());
		if (waybill_no != '') 
		{
			var reg = /^[a-zA-Z0-9]+$/;
			if (!reg.test(waybill_no))
			{
				$('#sh_search_msg').text('请输入正确物流单号！');
				return false;
			}
			var len = waybill_no.length;
			if (len > 14) 
			{
				len = 14;
				var valuex = waybill_no.substring(0, len);
				$(this).val(valuex);
				waybill_no=valuex;
			}
			if (len>1 && len<=14) 
			{
				var reponseurl='<?php echo U("index/index/search_waybill_no");?>';
				$.ajax({
					type: "post",
					url: reponseurl,
					data: {waybill_no: waybill_no},
					success: function (data) {
						var status = data.code;
						var msg = data.msg;
						var datax = data.data;
						$('#sh_search_msg').text(msg);
						if (status == 0) {
							$("#js-receive-sh-ok").attr('tag',1);
							return false;
						}
						else
						{
							obj.removeAttr("disabled");
							$("#js-receive-sh-ok").attr('tag',0);
							
							//供应商
							$('#sh_supplier').val(datax.supplier_name);
							$('#sh_supplier_tel').val(datax.supplier_tel);
							$('#sh_supplier_leader').val(datax.supplier_leader);
							$('#sh_supplier_address').val(datax.supplier_address);
							
							//用户信息
							$('#sh_tel').val(datax.tel);
							var area = data.data.area_list;
							var subarea = data.data.subarea_list;
							$.templates("#theTmp2Ax").link("#sh_area", area);
							$.templates("#theTmp3Ax").link("#sh_subarea", subarea);
							$('#sh_area').change(function () {
								var reponseurl='<?php echo U("index/index/subarea_find");?>';
								var optionVal = $('#sh_area option:selected').val();
								$.ajax({
									type: "post",
									url: reponseurl,
									data: {area: optionVal},
									success: function (data) {
										var status = data.status;
										var msg = data.msg;
										var result = data.result;
										if (status == 1) {
											$.templates("#theTmp4Ax").link("#sh_subarea", result);
										} else {
											$('#sh_search_msg').text(msg);
											return false;
										}
									}
								});
							});
							$('#sh_name').val(datax.name);
							$('#sh_address').val(datax.address);
							$('#sh_remark').val(datax.remark);
							
						}
					}
				});
			}
		}
	});
	
	repose_con_info('');
								
	$('#sh_tel').bind('input propertychange', function () {
			var obj=$("#sh_name,#sh_area,#sh_subarea,#sh_address");
            var tel = $.trim($(this).val());
            obj.val('');
			if (tel != '') 
			{
                var len = tel.length;
                if (len > 12) {
                    len = 12;
                    var valuex = tel.substring(0, len);
                    $(this).val(valuex);
                }
                if (len>6 && len<=12) {
					var isMob=/^1[3-9]{1}[0-9]{9}$/;
					var isTel=/^([0-9]{3,4}-)?[0-9]{7,8}$/;
                    if (!isMob.test(tel) && !isTel.test(tel))
					{
                        $('#sh_search_msg').text('请输入正确的电话号码！');
                        return false;
                    }
					else
					{
						$('#sh_search_msg').text('');
					}
					
					var reponseurl='<?php echo U("index/index/con_info");?>';
                    $.ajax({
                        type: "post",
                        url: reponseurl,
                        data: {val2: tel},
                        success: function (data) {
                            var status = data.status;
                            var msg = data.msg;
                            var area = data.result.area;
                            var subarea = data.result.subarea;
                            var cons = data.result.info.cons;
                            var addr = data.result.info.addr;
                            $("#sh_name").val(cons);
                            $("#sh_address").val(addr);
                            $.templates("#theTmp2Ax").link("#sh_area", area);
                            $.templates("#theTmp3Ax").link("#sh_subarea", subarea);
                           
							$('#sh_area').change(function () {
								var reponseurl='<?php echo U("index/index/subarea_find");?>';
                                var optionVal = $('#sh_area option:selected').val();
                                $.ajax({
                                    type: "post",
                                    url: reponseurl,
                                    data: {area: optionVal},
                                    success: function (data) {
                                        var status = data.status;
                                        var msg = data.msg;
                                        var result = data.result;
                                        if (status == 1) {
                                            $.templates("#theTmp4Ax").link("#sh_subarea", result);
                                        } else {
                                            $('#sh_search_msg').text(msg);
                                            return false;
                                        }
                                    }
                                });
                            });

                            if (status == 0) {
                                $('#sh_search_msg').text(msg);
                                return false;
                            }
                        }
                    });
                }
            }
        });
		
	$("#area").prev().find("li").click(function(){
		var val_area=$(this).attr('data-value');
		var val_area_name=$(this).text();
		var reponseurl='<?php echo U("index/index/subarea");?>';
		var postdata={parent_id:val_area};
		$.post(reponseurl,postdata,function(data){
			var code=data.code;
			var msg=data.msg;
			var subarea=data.data;
			if(code==1){	
				
				var template = $.templates("#theTmpl3");
				var htmlOutput= template.render(subarea);
				$("#subarea").html(htmlOutput);
				
				var template2 = $.templates("#theTmpl4");
				var htmlOutput2= template2.render(subarea);
				$("#subarea").prev().find("ul").html(htmlOutput2);
				$("#subarea").prev().prev().text('请选择所在县市区');
				$("#subarea").prev().children('li').removeAttr('class');
				
				$("#wangdian").prev().prev().text('请选择网点');
				$("#wangdian").prev().children('li').removeAttr('class');
				$("#wangdian").prev().find("ul").html('');
				
				
				$("#subarea").prev().find("li").click(function(){
					var text=$(this).text();
					$("#subarea").prev().prev().text(text);
					$(this).addClass('cs-selected');
					$(this).siblings().removeClass('cs-selected');
					$(this).siblings().removeAttr('class');
					$("#subarea").parent().removeClass('cs-active');
					
					var reponseurl='<?php echo U("index/index/get_wangdian");?>';
					var postdata={area:val_area_name,subarea:text};
					$.post(reponseurl,postdata,function(data){
					var code=data.code;
					var msg=data.msg;
					var subarea=data.data;
					if(code==1){
						var template = $.templates("#theTmpl5");
						var htmlOutput= template.render(subarea);
						$("#wangdian").html(htmlOutput);
						
						var template2 = $.templates("#theTmpl6");
						var htmlOutput2= template2.render(subarea);
						$("#wangdian").prev().find("ul").html(htmlOutput2);
						
						$("#wangdian").prev().prev().text('请选择网点');
						$("#wangdian").prev().children('li').removeAttr('class');
						
						$("#wangdian").prev().find("li").click(function(){
							var val=$(this).attr('data-value');
							var text=$(this).text();
							$("#wangdian").prev().prev().text(text);
							$(this).addClass('cs-selected');
							$(this).siblings().removeClass('cs-selected');
							$(this).siblings().removeAttr('class');
							$("#wangdian").parent().removeClass('cs-active');
						});
					}else{
						$("#wangdian").prev().find("ul").html('');
						swal(msg, "", "error");
						return false;
					}
					});
				});
			}else{
				$("#subarea").prev().find("ul").html('');
				swal(msg, "", "error");
				return false;
			}
		},"json");
		return false;
	});
	
	$("#js-receive-sh-ok").click(function(){
		var objs=$(this);
		var tag=objs.attr('tag');
		if(tag==0)
		{
			objs.attr('tag',1);
			objs.addClass('btn-click-gray');
			setTimeout(function(){
				objs.attr('tag',0);
				objs.removeClass('btn-click-gray');
				
			},300);
		
			var waybill_no=$.trim($('#sh_waybill_no').val());
			var tel=$.trim($('#sh_tel').val());
			var name=$.trim($('#sh_name').val());
			var area=$.trim($('#sh_area').val());
			var subarea=$.trim($('#sh_subarea').val());
			var address=$.trim($('#sh_address').val());
			var remark=$.trim($('#sh_remark').val());
			var reponseurl='<?php echo U("index/index/receive_do_v3");?>';
			var postdata={tag:1,tel:tel,name:name,subarea:subarea,area:area,address:address,remark:remark,waybill_no:waybill_no};
			$.post(reponseurl,postdata,function(data){
				var code=data.code;
				var msg=data.msg;
				if(code==1){ 
					window.location.reload();
				}else{
					swal(msg, "", "error");
					return false;
				}
			});
		}
	});
	
	$("#js-batch-receive-ok").click(function(){
		var tags=$('#waybill_add_rec').getTags();
		
		var waybill_no=$.trim(tags);
		
		var reponseurl='<?php echo U("index/index/receive_do");?>';
		var postdata={waybill_no:waybill_no};
		$.post(reponseurl,postdata,function(data){
			var code=data.code;
			var msg=data.msg;
			if(code==1){
				window.location.reload();
			}else{
				swal(msg, "", "error");
				return false;
			}
		});
		return false;
	});
	
	$("#js-batch-send-ok").click(function(){
		var tags=$('#waybill_add_send').getTags();
		
		var driver=$("#driver").prev().find("li.cs-selected").attr('data-value');
		var driver_name=$("#driver").prev().prev().text();
		var num=$(this).attr('num');
		var area=$("#area").prev().find("li.cs-selected").attr('data-value');
		
		var subarea=$("#subarea").prev().find("li.cs-selected").attr('data-value');
		
		var wangdian=$("#wangdian").prev().find("li.cs-selected").attr('data-value');
		var wangdian_name=$("#wangdian").prev().prev().text();
		
		var waybill_no=$.trim(tags);
		
		var reponseurl='<?php echo U("index/index/send_do");?>';
		var postdata={tag:1,num:num,driver:driver,area:area,subarea:subarea,wangdian:wangdian,driver_name:driver_name,wangdian_name:wangdian_name,waybill_no:waybill_no};
		$.post(reponseurl,postdata,function(data){
			var code=data.code;
			var msg=data.msg;
			var datax=data.data;
			if(code==1){
				window.location.reload();
			}else if(code==10){
				swal({
					title: "您确定要继续提交订单吗？",
					text: "请谨慎操作！",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "确定",
					cancelButtonText: "取消",
					closeOnConfirm: false,
					showLoaderOnConfirm: true,
					closeOnCancel: true
				},function(){
					postdata.num=(num+datax);
					$.post(reponseurl,postdata,function(data){
						var code=data.code;
						var msg=data.msg;
						if(code==1){
							window.location.reload();
						}
						else
						{
							swal(msg, "", "error");
							return false;
						}
					});
				});
			}else{
				swal(msg, "", "error");
				return false;
			}
		});
		return false;
	});
	
	$("#js-batch-send-ok-x2").click(function(){
		var tags=$('#waybill_add_send_x2').getTags();
		
		var zcxjy=$("#zcxjy").prev().find("li.cs-selected").attr('data-value');
		var zcxjy_name=$("#zcxjy").prev().prev().text();
		
		var waybill_no=$.trim(tags);
		var num=$(this).attr('num');
		var reponseurl='<?php echo U("index/index/send_do");?>';
		var postdata={tag:0,num:num,zcxjy:zcxjy,zcxjy_name:zcxjy_name,waybill_no:waybill_no};
		$.post(reponseurl,postdata,function(data){
			var code=data.code;
			var msg=data.msg;
			if(code==1){
				window.location.reload();
			}else{
				swal(msg, "", "error");
				return false;
			}
		});
		return false;
	});
	
    $.jgrid.defaults.styleUI = "Bootstrap";
	var mydata =<?php echo $waybill;?>;
    $("#table_list_2").jqGrid({
        data: mydata,
        datatype: "local",
        height: "calc(100% - 150px)",
        autowidth: true,
        shrinkToFit: true,
        rowNum: 20,
        /*rowList: [10, 20, 30],*/
        colNames: ["编号","运单号码", "供应商","配送司机","物流网点", "客户", "联系方式","收货地址", "当前状态","付款方式","应付金额", "备注","操作"],
        colModel: [
		{
            name: "id",
            index: "id",
            editable: true,
            width: 75,           
            search: true
        },
		{
            name: "waybill_no",
            index: "waybill_no",
            editable: true,
            width: 75,           
            search: true
        },
		 {
            name: "supplier",
            index: "supplier",
            editable: true,
            width: 90,
            align: "center",
            sorttype: "float"
        },
		{
            name: "driver",
            index: "driver",
            editable: true,
            width: 90,
            align: "center",
            sorttype: "float"
        },
		{
            name: "branch_name",
            index: "branch_name",
            editable: true,
            width: 90,
            align: "center",
            sorttype: "float"
        },
        {
            name: "name",
            index: "name",
            editable: true,
            width: 60
        },
        {
            name: "tel",
            index: "tel",
            editable: true,
            width: 60,
            align: "center",
        },
        {
            name: "address",
            index: "address",
            editable: true,
            width: 90,
            align: "center",

        },
        {
            name: "status_name",
            index: "status_name",
            editable: true,
            width: 60,
            sortable: false
        },
		{
            name: "pay_type",
            index: "pay_type",
            editable: true,
            width: 60,
            sortable: false
        },
		{
            name: "price",
            index: "price",
            editable: true,
            width: 60,
            sortable: false
        },
        {name:'remark',index:'remark', width:70,sortable:false},
        {name:'act',index:'act', width:70,sortable:false},
        ],
        pager: "#pager_list_2",
        viewrecords: true,
        caption: "运单",
        add: true,
        edit: true,
        addtext: "Add",
        edittext: "Edit",
        hidegrid: false,
        width:400,
        toolbar : [true,"top"],
        gridComplete: function(){
			var ids = jQuery("#table_list_2").jqGrid('getDataIDs');
			for(var i=0;i < ids.length;i++){
				var cl = ids[i];
				be = "<input class='btn btn-w-m btn-info glyphicon-detail'  data-toggle='modal' data-target='#myModal2' type='button' value='查看详情'>"; 
	   
				jQuery("#table_list_2").jqGrid('setRowData',ids[i],{act:be});
			}
			$(".glyphicon-detail").click(function(){
				$(this).parent().trigger('click');
				var id = jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
				get_history(id);
				get_map(id);
			}); 
		},
    });

	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='search_btn  glyphicon glyphicon-search'><span style='position:relative;margin-left:2px;'>搜索</span></span>");
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-refresh'><span style='position:relative;margin-left:2px;'>刷新</span></span>");
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-folder-open'><span style='position:relative;margin-left:5px;'>导出数据</span></span>");
	
	$(".glyphicon-search").click(function(){
		$("#search_table_list_2").trigger('click');
	}); 
	$(".glyphicon-refresh").click(function(){
		//$("#refresh_table_list_2").trigger('click');
		window.location.reload();
		return false;
	}); 
	$(".glyphicon-folder-open").click(function(){
		var open='<?php echo U("index/index/loadout");?>';
		window.open(open);
		return false;
	}); 	

    $("#table_list_2").setSelection(4, true);
    $("#table_list_2").jqGrid("navGrid", "#pager_list_2", {
        edit: false,
        add: false,
        del: false,
        search: true,
    },
    {
        height: 100,
        reloadAfterSubmit: true,
    });
    $(window).bind("resize",
    function() {
        var width = $(".jqGrid_wrapper").width();
        $("#table_list_1").setGridWidth(width);
        $("#table_list_2").setGridWidth(width)
    });
    $("#pager_list_2").css('width','100%');
    // $("#table_list_2 ").css('height','60%');
	});
    </script>
	<script>
	function get_map(id){
		var reponseurl='<?php echo U("index/index/get_pos");?>';
		var postdata={id:id};
		$.post(reponseurl,postdata,function(data){
			var code=data.code;
			var msg=data.msg;
			var longitude=data.data.longitude;
			var latitude=data.data.latitude;
			var icon=data.data.icon;
			if(code==1){
				baidu_map(longitude,latitude,icon);
			}else{
				//alert(msg);
			}
		});
	}
	
	function baidu_map(longitude,latitude,icon){
		var map = new BMap.Map("staffmap");
		var point = new BMap.Point(longitude, latitude);
		map.centerAndZoom(point,25);

		//创建图
		var pt1 = new BMap.Point(longitude,latitude);
		var myIcon = new BMap.Icon("/Public"+icon, new BMap.Size(300, 157));
		var marker1 = new BMap.Marker(pt1, { icon: myIcon });  // 创建标注
		map.addOverlay(marker1);
		map.enableScrollWheelZoom(true);
	}
	
	function get_history(id){
		var reponseurl='<?php echo U("index/index/get_history");?>';
		var postdata={id:id};
		$.post(reponseurl,postdata,function(data){
			var code=data.code;
			var msg=data.msg;
			var waybill=data.data.waybill;
			var history=data.data.history;
			if(code==1){
				var template = $.templates("#theTmpl");
				var htmlOutput = template.render(waybill);
				$("#render_table").html(htmlOutput);
				
				var template2 = $.templates("#theTmpl2");
				var htmlOutput2 = template2.render(history);
				$("#vertical-timeline").html(htmlOutput2);
				$("#myModal2").show();
			}else{
				//alert(msg);
				$("#vertical-timeline").html(msg);
				$("#myModal2").show();
				return false;
			}
		},"json");
	}
    </script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
</html>
<!--  -->