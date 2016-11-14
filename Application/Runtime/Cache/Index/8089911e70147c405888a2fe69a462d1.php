<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>地州信息</title>
    <link rel="shortcut icon" href="favicon.ico"> 
	<link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link rel="shortcut icon" href="/Public/style_HUI/favicon.ico">
    <link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/style_HUI/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/jqgrid/ui.jqgridffe4.css?0820" rel="stylesheet">
    <link href="/Public/style_HUI/css/animate.min.css" rel="stylesheet">
    <link href="/Public/style_HUI/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/jqgrid/main.css" rel="stylesheet">
	<link href="/Public/style_HUI/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!--link rel="stylesheet" type="text/css" href="/Public/style_HUI/css/shouhuo/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/Public/style_HUI/css/shouhuo/cs-select.css" />
    <link rel="stylesheet" type="text/css" href="/Public/style_HUI/css/shouhuo/cs-skin-underline.css" /-->
    <!--style type="text/css">
        .modal-content1
        {
	    top: 8% !important;
	    left: 30% !important;
	    height: 30% !important;
	    width: 40% !important;
        }
        .modal-dialog,.modal-dialog
        {
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
        height:calc(100% - 80px);
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
        .modal-title
        {
        color: #444242;
        background-color: rgb(163,202,233);
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
            border:1px solid rgb(33,198,200);
            text-align: center;
        }
        div.cs-skin-underline
        {
            width: 170px;
		    background-color: rgb(255, 255, 255);
		    font-size: 12px;
		    border: 1px solid rgb(38,198,200);
        }
        .cs-placeholder
        {
            text-align: center;
            font-size: 14px;
        }
        .cs-options > ul > li > span
        {
            font-size: 12px;
        }
        section
        {
            margin-right: 10px;
        }
        .cs-options
        {
        	background: white !important;
        }
        .cs-options > ul > li
        {
        	color: gray;
        	
        }
        .cs-options > ul > li:hover
        {
        	background:rgb(33,198,200);
        	color: white !important;
        }
      	.test
      	{
      		width: 332px; margin:0 auto;"
      	}
      	.test > input
      	{
      		line-height: normal;
		    height: 30px;
		    width: 171px;
		    text-indent: 2em;
		    color: gray;
		    border: 1px solid rgb(33,198,200);
		    font-size: 15px;
      	}
    </style-->
</head>
<body class="gray-bg">

	<!-- Modal -->
    <!--div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content1  modal-content animated fadeIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span> 
					</button>
					<h6 class="modal-title" style="color:black;color:white">添加地州信息</h6>
				</div>
				
				<div class="modal-body">
					<div style="width: 332px;margin: 30px auto;">
						<span>区域：</span>
						<section style="display:inline-block">
							<select class="cs-select cs-skin-underline" name="parentid" id="parentid">
								<option value="0" disabled selected>请选择区域</option>
								<?php if(is_array($area)): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo $data['id'];?>"><?php echo $data['name'];?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</section>
						<span>不选择则为父类型</span>
					</div>
					<div class="test">
						<span>地区：</span>
						<input type="" name="area" id="area" value="" />
					</div>         
				</div>
				<div class="modal-footer"> 
					<button type="button" class="btn btn-white js-close-btn" data-dismiss="modal" style="background-color:#1ab394;color:#ffffff">关闭</button>
					<button type="button" class="btn btn-white js-save-btn" style="background:rgb(33,198,200);color:white">保存</button>
				</div>
			</div>
		</div>
	</div-->
    <div class="wrapper wrapper-content ">
		<div class="jqGrid_wrapper">
			<table id="table_list_2"> </table>
			<div id="pager_list_2"></div>
		</div>
	</div>
    <script src="/Public/style_HUI/js/jquery.toolbar.js" type="text/javascript"> </script>     
    <script src="/Public/style_HUI/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Public/style_HUI/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Public/style_HUI/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/Public/style_HUI/js/plugins/jqgrid/i18n/grid.locale-cnffe4.js?0820"></script>
    <script src="/Public/style_HUI/js/plugins/jqgrid/jquery.jqGrid.minffe4.js?0820"></script>
    <script src="/Public/style_HUI/js/content.min.js?v=1.0.0"></script>
	<script src="/Public/style_HUI/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="/Public/style_HUI/css/shouhuo/classie.js"></script>
    <script type="text/javascript" src="/Public/style_HUI/css/shouhuo/selectFx.js"></script>
    <script>
		(function(){
			[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {    
				new SelectFx(el);
			});
		})();
	</script>
    <script>
    $(document).ready(function() {
	
	
	//保存地州数据
    $.jgrid.defaults.styleUI = "Bootstrap";
	var mydata=<?php echo $arealist;?>;
	/*
	var mydata=[
		{
			id: "1",
			invdate: "贵阳市",
			name: "南明区",
		},
		{
			id: "2",
			invdate: "贵阳市",
			name: "南明区", 
		},
		{
			id: "3",
			invdate: "贵阳市",
			name: "南明区",
		}
	];*/
	var arealist='<?php echo $arealistsel;?>';
    $("#table_list_2").jqGrid({
        data: mydata,
        datatype: "local",
        height: "calc(100% - 150px)",
        autowidth: true,
        shrinkToFit: true,
        rowNum: 20,
        /*rowList: [10, 20, 30],*/
        colNames: ["编号", "所属区域", "所属城市", "操作"],
        colModel: [
			{
				name: "id",
				index: "id",
				editable: true,
				width: 75,           
				search: true,
				
			},
			{
				name: "namep",
				index: "namep",
				editable: true,
				width: 60,
				edittype : "select",
				editoptions : {value : arealist}
				
			},
			{
				name: "name",
				index: "name",
				editable: true,
				width: 60
			},
			{
				name:'act',
				index:'act', 
				width:70,
				sortable:false
			},
        ],
        pager: "#pager_list_2",
        viewrecords: true,
        caption: "地州信息",
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
				be = "<input class='btn btn-w-m btn-info glyphicon-edit js-edit-btn' id="+ids[i]+" type='button' value='修改'>"; 
				se = "<input class='btn btn-w-m btn-danger del_table js-delete-btn'  id="+ids[i]+" type='button' value='删除'>";      
				jQuery("#table_list_2").jqGrid('setRowData',ids[i],{act:be+se});
			}
			$(".js-edit-btn").click(function(){
				$(this).parent().trigger('click');
				var gr=jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
				if (gr != null){
					jQuery("#table_list_2").jqGrid('editGridRow', gr, {
						height : 300,
						reloadAfterSubmit : false
					});
					$("#sData").click(function(){
						var editurl='<?php echo U("index/info/area_edit");?>';
						var id=$.trim($(".FormGrid #id").val());
						var namep=$.trim($(".FormGrid #namep").val());
						var name=$.trim($(".FormGrid #name").val());
						var postdata={id:id,namep:namep,name:name};
						$.post(editurl,postdata,function(data){
							var code=data.code;
							var msg=data.msg;
							if(code==1){
								//$("#table_list_2").trigger("reloadGrid");
								window.location.reload();
							}else{
								swal(msg, "", "error");
								return false;
							}
						},"json");
						return false;
					});
					return false;
				}else{
				  swal("请选择一行数据", "", "error");
				}
				//$("#edit_table_list_2").trigger('click');
			});  
			$(".js-delete-btn").click(function(){
				$(this).parent().trigger('click');
					var gr = jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
					if (gr != null){
						jQuery("#table_list_2").jqGrid('delGridRow', gr, {
							reloadAfterSubmit : true
						});
						$("#dData").click(function(){
							var delurl='<?php echo U("index/info/area_delete");?>';
							var id = jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
							var postdata={id:id};
							$.post(delurl,postdata,function(data){
								var code=data.code;
								var msg=data.msg;
								//alert(msg);
								if(code==1){
									//$("#table_list_2").trigger("reloadGrid");
									window.location.reload();
								}else{
									swal(msg, "", "error");
									return false;
								}
							},"json");
							return false;
						});
						return false;
					}else{
						alert("请选择一行数据!");
					}
				//$("#del_table_list_2").trigger('click');
			});   
				
		},
		//editurl:'<?php echo U("index/info/area_edit");?>',
    });

	$("#t_table_list_2").append("<span style='height: 20px;color: #000000;cursor:Pointer; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='tianjia  glyphicon glyphicon-plus'><span  style='position:relative;margin-left:2px;'>添加</span></span>");
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='search_btn  glyphicon glyphicon-search'><span style='position:relative;margin-left:2px;'>搜索</span></span>");
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-refresh refresh'><span style='position:relative;margin-left:2px;'>刷新</span></span>");
	//$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-folder-open'><span style='position:relative;margin-left:5px;'>导出数据</span></span>");
	
	 $(".glyphicon-plus").click(function(){
		jQuery("#table_list_2").jqGrid('editGridRow', "new", {
			height : 300,
			reloadAfterSubmit : true
		});
		
		$("#sData").click(function(){
			var editurl='<?php echo U("index/info/area_add");?>';
			var namep=$.trim($(".FormGrid #namep").val());
			var name=$.trim($(".FormGrid #name").val());
			var postdata={namep:namep,name:name};
			$.post(editurl,postdata,function(data){
				var code=data.code;
				var msg=data.msg;
				//alert(msg);
				if(code==1){
					//$("#table_list_2").trigger("reloadGrid");
					window.location.reload();
				}else{
					swal(msg, "", "error");
					return false;
				}
			},"json");
			return false;
		});
		//$("#add_table_list_2 ").trigger('click');
	}); 
	
	$(".glyphicon-search","#t_table_list_2").click(function(){
		$("#search_table_list_2").trigger('click');
	}); 
	$(".tianjia","#t_table_list_2").click(function(){
		//$("# ").trigger('click');
	}); 
	$(".glyphicon-refresh").click(function(){
		window.location.reload();
		return false;
	}); 
	$("#t_table_list_2").click(function(){
		//$("#search_table_list_2").trigger('click');
	}); 
	
    $("#table_list_2").setSelection(4, true);
    $("#table_list_2").jqGrid("navGrid", "#pager_list_2", {
        edit: true,
        add: true,
        del: true,
        search: true,
    },
    {
        height: 100,
        reloadAfterSubmit: true,
    });
    $(window).bind("resize",function() {
        var width = $(".jqGrid_wrapper").width();
        $("#table_list_1").setGridWidth(width);
        $("#table_list_2").setGridWidth(width)
    });
    $("#pager_list_2").css('width','100%');
	
	$(".js-save-btn").click(function(){
		var area=$.trim($("#area").val());
		var parentid=$.trim($("#parentid").val());
		$.post('<?php echo U("index/info/area_save");?>', {area:area,parentid:parentid},function(data){
			var code=data.code;
			var msg=data.msg;
			//alert(msg);
			if(code==3){
				//$("#table_list_2").trigger("reloadGrid");
				window.location.reload();
				//$(".js-close-btn").click();
			}else{
				swal(msg, "", "error");
			}
		},"json");
		return false;
	});
});
    </script>
    
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
   
</body>
</html>
<!--  -->