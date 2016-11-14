<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>供应商</title>
    <link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/style_HUI/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/jqgrid/ui.jqgridffe4.css?0820" rel="stylesheet">
    <link href="/Public/style_HUI/css/animate.min.css" rel="stylesheet">
    <link href="/Public/style_HUI/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/jqgrid/main.css" rel="stylesheet">
	<link href="/Public/style_HUI/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!--link rel="stylesheet" type="text/css" href="css/shouhuo/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/shouhuo/cs-select.css" />
    <link rel="stylesheet" type="text/css" href="css/shouhuo/cs-skin-underline.css" /-->
    <!--style type="text/css">
        .modal-content1
        {
	    top: 5% !important;
	    left: 30% !important;
	    height: 40% !important;
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
      		width: 480px; margin:30px auto;"
      		
      	}
      	.test > input
      	{
      		line-height: normal;
		    height: 30px;
		    width: 150px;
		    text-indent: 2em;
		    color: gray;
		    border: 1px solid rgb(33,198,200);
		    font-size: 15px;
		    margin-right: 10px;      	}
    </style-->
</head>
<body class="gray-bg">


<!-- Modal -->

    <div class="wrapper wrapper-content ">
		<div class="jqGrid_wrapper">
			<table id="table_list_2"> </table>
			<div id="pager_list_2"></div>
		</div>
	</div>
    <script src="/Public/style_HUI//js/jquery.toolbar.js" type="text/javascript"> </script>     
    <script src="/Public/style_HUI/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Public/style_HUI/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Public/style_HUI/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/Public/style_HUI/js/plugins/jqgrid/i18n/grid.locale-cnffe4.js?0820"></script>
    <script src="/Public/style_HUI/js/plugins/jqgrid/jquery.jqGrid.minffe4.js?0820"></script>
    <script src="/Public/style_HUI/js/content.min.js?v=1.0.0"></script>
	<script src="/Public/style_HUI/js/plugins/sweetalert/sweetalert.min.js"></script>
    <!--script type="text/javascript" src="css/shouhuo/classie.js"></script>
    <script type="text/javascript" src="css/shouhuo/selectFx.js"></script-->
    <script>
            (function() {
                [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {    
                    new SelectFx(el);
                } );
            })();
        </script>
    <script>
    $(document).ready(function() {
    $.jgrid.defaults.styleUI = "Bootstrap";
	var mydata =<?php echo $supplier;?>;
	
    $("#table_list_2").jqGrid({
        data: mydata,
        datatype: "local",
        height: "calc(100% - 150px)",
        autowidth: true,
        shrinkToFit: true,
        rowNum: 20,
        /*rowList: [10, 20, 30],*/
        colNames: ["编号", "供应商名称", "详细地址", "负责人", "联系电话","计价方式","操作"],
        colModel: [
        {
            name: "id",
            index: "id",
            editable: true,
            width: 75,           
            search: true
        },
        {
            name: "name",
            index: "name",
            editable: true,
            width: 60,
            
        },
        {
            name: "address",
            index: "address",
            editable: true,
            width: 75,           
            search: true
        },
        {
            name: "leader",
            index: "leader",
            editable: true,
            width: 75,           
            search: true
        },
        {
            name: "tel",
            index: "tel",
            editable: true,
            width: 75,           
            search: true
        },
		{
            name: "pay_style",
            index: "pay_style",
            editable: true,
            width: 75,
			edittype : "select",
			editoptions : {value :"0:请选择计价方式;1:重量;2:台数"},			
            search: true
        },
		{name:'act',index:'act', width:70,sortable:false},
        
        ],
        pager: "#pager_list_2",
        viewrecords: true,
        caption: "添加供应商",
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
            be = "<input class='btn btn-w-m btn-info glyphicon-edit'   type='button' value='修改'>"; 
            se = "<input class='btn btn-w-m btn-danger del_table'  type='button' value='删除'>";      
            jQuery("#table_list_2").jqGrid('setRowData',ids[i],{act:be+se});
                 
        }  
		$(".glyphicon-edit").click(function(){
			//$("#edit_table_list_2").trigger('click');
			$(this).parent().trigger('click');
				var gr=jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
				if (gr != null){
					jQuery("#table_list_2").jqGrid('editGridRow', gr, {
						height : 300,
						reloadAfterSubmit : true
					});
					$("#sData").click(function(){
						var editurl='<?php echo U("index/info/gys_edit");?>';
						var id=$.trim($(".FormGrid #id").val());
						var namep=$.trim($(".FormGrid #namep").val());
						var name=$.trim($(".FormGrid #name").val());
						var area=$.trim($(".FormGrid #area").val());
						var subarea=$.trim($(".FormGrid #subarea").val());
						var address=$.trim($(".FormGrid #address").val());
						var leader=$.trim($(".FormGrid #leader").val());
						var tel=$.trim($(".FormGrid #tel").val());
						var pay_style=$.trim($(".FormGrid #pay_style").val());
						var postdata={id:id,namep:namep,name:name,area:area,subarea:subarea,address:address,leader:leader,tel:tel,pay_style:pay_style};
						$.post(editurl,postdata,function(data){
							var code=data.code;
							var msg=data.msg;
							//alert(msg);
							if(code==1){
								//$("#table_list_2").trigger("reloadGrid");
								window.location.reload();
							}else{
								swal(msg, "", "error");
							}
						},"json");
						return false;
					});
				}else{
				  swal('请选择一行数据', "", "error");
				}
				return false;
		});  
		$(".del_table").click(function(){
			$(this).parent().trigger('click');
				var gr = jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
				if (gr != null){
					jQuery("#table_list_2").jqGrid('delGridRow', gr, {
						reloadAfterSubmit : true
					});
					$("#dData").click(function(){
						var delurl='<?php echo U("index/info/gys_delete");?>';
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
				}else{
					swal('请选择一行数据', "", "error");
				}
				return false;
			//$("#del_table_list_2").trigger('click');
		});     
		},
		//editurl:'<?php echo U("index/info/gys_edit");?>',
    });

	$("#t_table_list_2").append("<span style='height: 20px;color: #000000;cursor:Pointer; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='tianjia  glyphicon glyphicon-plus'><span 	style='position:relative;margin-left:2px;'>添加</span></span>");
    $("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='search_btn  glyphicon glyphicon-search'><span style='position:relative;margin-left:2px;'>搜索</span></span>");
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-refresh'><span style='position:relative;margin-left:2px;'>刷新</span></span>");
    //$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-folder-open'><span style='position:relative;margin-left:5px;'>导出数据</span></span>");
   
	$(".glyphicon-search").click(function(){
		$("#search_table_list_2").trigger('click');
		return false;
	}); 
    $(".glyphicon-refresh").click(function(){
		//$("#refresh_table_list_2").trigger('click');
		window.location.reload();
		return false;
	}); 
    $(".glyphicon-plus").click(function(){
		//$("#add_table_list_2 ").trigger('click');
		jQuery("#table_list_2").jqGrid('editGridRow', "new", {
			height : 300,
			reloadAfterSubmit : true
		});
		
		$("#sData").click(function(){
			var editurl='<?php echo U("index/info/gys_add");?>';
			var name=$.trim($(".FormGrid #name").val());
			var address=$.trim($(".FormGrid #address").val());
			var leader=$.trim($(".FormGrid #leader").val());
			var tel=$.trim($(".FormGrid #tel").val());
			var pay_style=$.trim($(".FormGrid #pay_style").val());
			var postdata={name:name,address:address,leader:leader,tel:tel,pay_style:pay_style};
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
		return false;
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
    
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
   
</body>
</html>
<!--  -->