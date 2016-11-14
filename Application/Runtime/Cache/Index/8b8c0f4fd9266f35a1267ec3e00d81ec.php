<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物流网点</title>
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
	    height: 50% !important;
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
		    margin-right: 10px;
        }
        .test1
        {
            z-index: 1 !important;
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
                    <span class="sr-only">Close</span> </button>
                <h6 class="modal-title" style="color:black;color:white">添加物流网点</h6>
            </div>
            
            <div class="modal-body">
            <div class="test">
                  <span>网点名称：</span>
                  <input type="text" name="">
                  
                  <span>负 &nbsp;责&nbsp;人： </span>
                  <input type="" name="">
                  </div>
                  <div class="test">
                  <span>联系电话：</span>
                  <input type="" name="">
                  </div>
                   <div style="width: 480px;margin: 30px auto;">
                <span>所属公司：</span>
                <section style="display:inline-block">
                <select class="cs-select cs-skin-underline">
                    <option value="" disabled selected>请选择所属公司</option>
                    <option value="1">顺丰快递</option>
                    <option value="2">申通快递</option>
                    <option value="3">圆通快递</option>
                    <option value="4">韵达快递</option>
                </select>
                  </section>
                  </div>
                <div style="width: 480px;margin: 30px auto;">
                <span>所在区域：</span>
                <section style="display:inline-block">
                <select class="cs-select cs-skin-underline test1" style="z-index:-1 !important;">
                    <option value="" disabled selected>请选择区域</option>
                    <option value="1">贵阳市</option>
                    <option value="2">六盘水市</option>
                    <option value="3">遵义市</option>
                    <option value="4">安顺市</option>
                    <option value="5">毕节市</option>
                    <option value="6">铜仁市</option>
                    <option value="7">黔西南州</option>
                    <option value="8">黔东南州</option>
                    <option value="9">黔南州</option>
                </select>
                  </section>
                   <section style="display:inline-block">
                <select class="cs-select cs-skin-underline">
                    <option value="" disabled selected>请选择城市</option>
                    <option value="1">贵阳市</option>
                    <option value="2">六盘水市</option>
                    <option value="3">遵义市</option>
                    <option value="4">安顺市</option>
                    <option value="5">毕节市</option>
                    <option value="6">铜仁市</option>
                    <option value="7">黔西南州</option>
                    <option value="8">黔东南州</option>
                    <option value="9">黔南州</option>
                </select>
                  </section>
                  </div>
                  <div class="test">
                  <span>详细地址：</span>
                  <input type="" name="" style="width:355px;">
                  </div>         
		</div>
      <div class="modal-footer"> 
      <button type="button" class="btn btn-white" data-dismiss="modal" style="background-color:#1ab394;
      color:#ffffff">关闭</button>
         <button type="button" class="btn btn-white" style="background:rgb(33,198,200);color:white">保存</button>
      </div></div></div>
	  </div-->
    <div class="wrapper wrapper-content ">
                <div class="jqGrid_wrapper">
    
                <table id="table_list_2"> </table>
                <div id="pager_list_2"></div>
                    </div>
    <script src="/Public/style_HUI/js/jquery.toolbar.js" type="text/javascript"> </script>     
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
	var mydata =<?php echo $branchxs;?>;
	/*
    var mydata = [
   {
        id: "1",
        invdate: "花溪--顺丰快递",
        name: "贵阳市",
        city:"南明区",
        address:"中华南路中都大厦20层",
        people:"Shixud",
        tel:"17008056660",
    },
    {
         id: "2",
        invdate: "中华南路--顺丰快递",
        name: "贵阳市",
        city:"南明区",
        address:"中华南路中都大厦20层",
        people:"Shixud",
        tel:"17008056660",
       
    },

    {
        id: "3",
        invdate: "A--顺丰快递",
        name: "贵阳市",
        city:"南明区",
        address:"中华南路中都大厦20层",
        people:"Shixud",
        tel:"17008056660",
       
       
    }];*/
	var arealist='<?php echo $arealistsel;?>';
	var companylistsel='<?php echo $companylistsel;?>';
    $("#table_list_2").jqGrid({
        data: mydata,
        datatype: "local",
        height: "calc(100% - 150px)",
        autowidth: true,
        shrinkToFit: true,
        rowNum: 20,
        /*rowList: [10, 20, 30],*/
        colNames: ["编号", "所属公司","网点名称", "所在区域","所在城市", "详细地址", "负责人", "联系电话","操作"],
        colModel: [
        {
            name: "id",
            index: "id",
            editable: true,
            width: 75,           
            search: true
        },
		{
            name: "namep",
            index: "namep",
            editable: true,
			edittype : "select",
			editoptions : {value :companylistsel},
            width: 60,
        },
        {
            name: "name",
            index: "name",
            editable: true,
            width: 60,
        },
        {
            name: "area",
            index: "area",
            editable: true,
            edittype : "select",
			editoptions : {
				value :arealist,
				dataEvents:[
					{
						type: 'change',
						fn: function(e) {
							var str = "";
							var url='<?php echo U("index/info/subarea");?>';
							$.ajax({
								url: url,
								async: false,
								cache: false,
								dataType: "json",
								data:{
									id:this.value  //传入值，到后台获取json
								},
								success: function(json) {
									if (json != null) {
										var jsonobj = eval(json);
										var code = jsonobj.code;
										var msg = jsonobj.msg;
										var datax = jsonobj.data;
										var length =datax.length;
										for (var i = 0; i < length; i++) {	//循环option
											if (i != length - 1) {
												str += '<option>' + datax[i].name + '</option>;';
											} else {
												str += '<option>' + datax[i].name + '</option>';
											}
										}
									}
								}
							});
							var rolename = $("select#subarea");	//获取下面下拉框RoleName对象					
							rolename.html(str);					// 然后绑定下拉框
						}
					}
				]
			},
            width: 60
        },
         {
            name: "subarea",
            index: "subarea",
            editable: true,
			edittype : "select",
			editoptions : {
				value :{'':'请选择县市区'},
				dataEvents:[
					{
						type: 'click',
						fn: function(e) {
							var area=$("select#area").val();
							var subarea=$("select#subarea").find("option:selected").text();
							var subareav=$("select#subarea").val();
							if(subareav!=''){
								return false;
							}
							var str = "";
							var url='<?php echo U("index/info/subarea");?>';
							$.ajax({
								url: url,
								async: false,
								cache: false,
								dataType: "json",
								data:{
									id:area  //传入值，到后台获取json
								},
								success: function(json) {
									if (json != null) {
										var jsonobj = eval(json);
										var code = jsonobj.code;
										var msg = jsonobj.msg;
					
										if(code==1){
											var datax = jsonobj.data;
											var length =datax.length;
											for (var i = 0; i < length; i++) {	//循环option
												if (i != length - 1) {
													str += '<option>' + datax[i].name + '</option>;';
												} else {
													str += '<option>' + datax[i].name + '</option>';
												}
											}
											var rolename = $("select#subarea");	//获取下面下拉框RoleName对象					
											rolename.html(str);
											return false;
										}else{
											swal(msg, "", "error");
											return false;
										}
									}
								}
							});
						}
					}
				]
			},
            width: 75,           
            search: true
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
			name:'act',
			index:'act', 
			width:70,
			sortable:false
		},
        ],
        pager: "#pager_list_2",
        viewrecords: true,
        caption: "添加网点信息",
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
				$(this).parent().trigger('click');
				var gr=jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
				if (gr != null){
					jQuery("#table_list_2").jqGrid('editGridRow', gr, {
						height : 300,
						reloadAfterSubmit : true
					});
					$("#sData").click(function(){
						var editurl='<?php echo U("index/info/wangdian_edit");?>';
						var id=$.trim($(".FormGrid #id").val());
						var namep=$.trim($(".FormGrid #namep").val());
						var name=$.trim($(".FormGrid #name").val());
						var area=$.trim($(".FormGrid #area").find("option:selected").text());
						var subarea=$.trim($(".FormGrid #subarea").find("option:selected").text());
						var address=$.trim($(".FormGrid #address").val());
						var leader=$.trim($(".FormGrid #leader").val());
						var tel=$.trim($(".FormGrid #tel").val());
						var postdata={id:id,namep:namep,name:name,area:area,subarea:subarea,address:address,leader:leader,tel:tel};
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
				//$("#edit_table_list_2").trigger('click');
			});  
			$(".del_table").click(function(){
				$(this).parent().trigger('click');
				var gr = jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
				if (gr != null){
					jQuery("#table_list_2").jqGrid('delGridRow', gr, {
						reloadAfterSubmit : true
					});
					$("#dData").click(function(){
						var delurl='<?php echo U("index/info/wangidan_delete");?>';
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
		//editurl:'<?php echo U("index/info/wangdian_edit");?>',
    });

	$("#t_table_list_2").append("<span style='height: 20px;color: #000000;cursor:Pointer; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='tianjia  glyphicon glyphicon-plus'><span 	style='position:relative;margin-left:2px;'>添加</span></span>");
    $("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='search_btn  glyphicon glyphicon-search'><span style='position:relative;margin-left:2px;'>搜索</span></span>");
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-refresh'><span style='position:relative;margin-left:2px;'>刷新</span></span>");
	//$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-folder-open'><span style='position:relative;margin-left:5px;'>导出数据</span></span>");
	
	$(".glyphicon-search").click(function(){
		$("#search_table_list_2").trigger('click');
	}); 
	$(".glyphicon-refresh").click(function(){
		//$("#refresh_table_list_2").trigger('click');
		window.location.reload();
		return false;
	}); 
    $(".glyphicon-plus").click(function(){
		jQuery("#table_list_2").jqGrid('editGridRow', "new", {
			height : 300,
			reloadAfterSubmit : true
		});
		
		$("#sData").click(function(){
			var editurl='<?php echo U("index/info/wangdian_add");?>';
			var namep=$.trim($(".FormGrid #namep").val());
			var name=$.trim($(".FormGrid #name").val());
			var area=$.trim($(".FormGrid #area").find("option:selected").text());
			var subarea=$.trim($(".FormGrid #subarea").find("option:selected").text());
			var address=$.trim($(".FormGrid #address").val());
			var leader=$.trim($(".FormGrid #leader").val());
			var tel=$.trim($(".FormGrid #tel").val());
			var postdata={namep:namep,name:name,area:area,subarea:subarea,address:address,leader:leader,tel:tel};
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
    
});
	</script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
   
</body>
</html>
<!--  -->