<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>系统用户</title>
	<link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico"> 
	<link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/style_HUI/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/jqgrid/ui.jqgridffe4.css?0820" rel="stylesheet">
    <link href="/Public/style_HUI/css/animate.min.css" rel="stylesheet">
    <link href="/Public/style_HUI/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/jqgrid/main.css" rel="stylesheet">
    <link href="/Public/style_HUI/css/plugins/datapicker/datepicker3.css" rel="stylesheet"> <!-- 后面引入的时间插件 -->
	<link href="/Public/style_HUI/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
</head>
<body class="gray-bg">
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
    <script type="text/javascript" src="/Public/style_HUI/js/plugins/datapicker/bootstrap-datepicker.js"></script> <!-- 后面引入的时间插件 -->
	<script src="/Public/style_HUI/js/plugins/sweetalert/sweetalert.min.js"></script>
   
	<script>
    $(document).ready(function() {
    
	$.jgrid.defaults.styleUI = "Bootstrap";
	var mydata =<?php echo $users;?>;
	var role_list='<?php echo $role_list;?>';
	var companylistsel='<?php echo $companylistsel;?>';
	var brancklistsel='<?php echo $brancklistsel;?>';
    $("#table_list_2").jqGrid({
        data: mydata,
        datatype: "local",
        height: "calc(100% - 150px)",
        autowidth: true,
        shrinkToFit: true,
        rowNum: 20,
        /*rowList: [10, 20, 30],*/
        colNames: ["员工ID", "姓名", "性别", "联系电话", "入职时间","住址","员工类型","物流公司","所属网点","用户名称","密码","操作"],
        colModel: [
         {
            name: "id",
            index: "id",
            width: 75,
            editable: true,
            sorttype: "string",
            search: true,

        },
        {
            name: "name",
            index: "name",
            width: 60,
            editable: true,
            sorttype: "string",
            search: true,
        },
        {
            name: "sex",
            index: "sex",
            editable: true,
            width: 60,
            edittype : "select",
            editoptions : {value :":请选择性别;男:男;女:女"}
        },
        {
            name: "tel",
            index: "tel",
            width: 80,
            editable: true,
            align: "center",
            sorttype: "number",
        },
        {
            name:'join_time',
			index:'join_time', 
			width:80, 
			editable:true,
            editoptions:{
				size:12,
				dataInit:function(el){
					$(el).datepicker({dateFormat:'yy-mm-dd'});
				},
				defaultValue: function(){
					var currentTime = new Date();
					var month = parseInt(currentTime.getMonth() + 1);
					month = month <= 9 ? "0"+month : month;
					var day = currentTime.getDate();
					day = day <= 9 ? "0"+day : day;
					var year = currentTime.getFullYear();
					return year+"-"+month + "-"+day;        
				}
            },
			formoptions:{ rowpos:0, elmprefix:"",elmsuffix:"" },
			editrules:{required:true}
		},
        {
            name: "address",
            index: "address",
            editable: true,
            width: 60,
            align: "center",
        },
        {
            name: "role_name",
            index: "role_name",
            editable: true,
            width: 100,
            sortable: false,
			edittype : "select",
            editoptions : {
				value :role_list,
				dataEvents:[
					{
						type: 'change',
						fn: function(e) {
							var name_company = $("select#name_company");	//获取下面下拉框RoleName对象
							var name_company_first = $("select#name_company option:first");	//获取下面下拉框RoleName对象
							var name_branch = $("select#name_branch");	//获取下面下拉框RoleName对象
							var name_branch_first =$("select#name_branch option:first");	//获取下面下拉框RoleName对象
							name_company_first.prop("selected", 'selected'); 
							name_branch.attr("disabled","disabled");
							name_branch_first.prop("selected", 'selected');
							var str = "";
							var url='<?php echo U("index/user/role_sel_info_wlgs");?>';
							$.ajax({
								url: url,
								async: false,
								cache: false,
								dataType: "json",
								data:{
									id:this.value  //传入值，到后台获取json
								},
								success: function(json) 
								{
									if (json != null) 
									{
										var jsonobj = eval(json);
										var code = jsonobj.code;
										var msg = jsonobj.msg;
										if(code==0)
										{
											swal(msg, "", "error");
											return false;
										}
										else if(code==1)
										{
											name_company.attr("disabled","disabled");
										}
										else if(code==2)
										{
											var options_num=name_company.children('option').length;
											if(options_num==1)
											{
												name_company.attr("disabled","disabled");
											}
											else
											{
												name_company.removeAttr("disabled");
											}
										}
										else if(code==3)
										{
											var options_num=name_company.children('option').length;
											if(options_num==1)
											{
												name_company.attr("disabled","disabled");
												var options_num_branch=name_branch.children('option').length;
												if(options_num==1)
												{
													name_branch.attr("disabled","disabled");
												}
												else
												{
													name_branch.removeAttr("disabled");
												}
												
											}
											else
											{
												name_company.removeAttr("disabled");
											}
											
											
										}
									}
								}
							});
						}
					}
				]
			}
        },
        {
            name: "name_company",
            index: "name_company",
            editable: true,
            width: 75,
            sorttype: "string",
            search: true,
            edittype : "select",
            editoptions : {
				value :companylistsel,
				dataEvents:[
					{
						type: 'change',
						fn: function(e) {
							var name_branch = $("select#name_branch");	//获取下面下拉框RoleName对象
							var name_branch_first =$("select#name_branch option:first");	//获取下面下拉框RoleName对象
							
							var str = "";
							var role=$("select#role_name").val();
							var url='<?php echo U("index/user/role_sel_info_wangdian");?>';
							$.ajax({
								url: url,
								async: false,
								cache: false,
								dataType: "json",
								data:{
									id:this.value,  //传入值，到后台获取json
									role:role
								},
								success: function(json) {
									if (json != null) {
										var jsonobj = eval(json);
										var code = jsonobj.code;
										var msg = jsonobj.msg;
										if(code==0){
											swal(msg, "", "error");
											return false;
										}
										else
										{
											var datax = jsonobj.data;
											var length =datax.length;
											for (var i = 0; i < length; i++) 
											{	//循环option
												if(i==0)
												{
													str='<option value="0">请选择网点</option>';
												}
												str += '<option value="'+datax[i].id+'">' + datax[i].name + '</option>';
											}
											name_branch.html(str);// 然后绑定下拉框
												
											if(code==2)
											{
												name_branch.removeAttr("disabled");  
												name_branch_first.prop("selected", 'selected');
											}
											else
											{
												name_branch.attr("disabled","disabled");  
											}
											
										}
									}
								}
							});
							
						}
					}
				]
			}
        },
        {
            name: "name_branch",
            index: "name_branch",
            editable: true,
            width: 75,
            sorttype: "string",
            search: true,
            edittype : "select",
            editoptions : {value :brancklistsel}
        }, 
		{
            name: "username",
            index: "username",
            editable: true,
            width: 60,
            align: "center",
        },
		{
            name: "password",
            index: "password",
            editable: true,
            width: 60,
            align: "center",
        },
        {
			name:'act',
			index:'id', 
			width:100,
			sortable:true, 
			bgbutton: true
		},
        ],
        pager: "#pager_list_2",
        viewrecords: true,
        caption: "监控报警",
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
						reloadAfterSubmit : false
					});
					var name_company = $("select#name_company");	//获取下面下拉框RoleName对象
					var name_branch = $("select#name_branch");	//获取下面下拉框RoleName对象
					name_company.attr("disabled", 'disabled'); 
					name_branch.attr("disabled","disabled");
					$("#sData").click(function(){
						var editurl='<?php echo U("index/user/user_edit");?>';
						var id=$.trim($(".FormGrid #id").val());
						var name=$.trim($(".FormGrid #name").val());
						var sex=$.trim($(".FormGrid #sex").val());
						var tel=$.trim($(".FormGrid #tel").val());
						var join_time=$.trim($(".FormGrid #join_time").val());
						var address=$.trim($(".FormGrid #address").val());
						var role_code=$.trim($(".FormGrid #role_name").val());
						var waycompany_id=$.trim($(".FormGrid #name_company").val());
						var branch_id=$.trim($(".FormGrid #name_branch").val());
						var username=$.trim($(".FormGrid #username").val());
						var password=$.trim($(".FormGrid #password").val());
						var postdata={id:id,name:name,sex:sex,tel:tel,join_time:join_time,address:address,role_code:role_code,waycompany_id:waycompany_id,branch_id:branch_id,username:username,password:password};
						$.post(editurl,postdata,function(data){
							var code=data.code;
							var msg=data.msg;
							//swal(msg, "", "error");
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
				//$("#edit_table_list_2").trigger('click');
			});  
			$(".del_table").click(function(){
				$(this).parent().trigger('click');
				var gr = jQuery("#table_list_2").jqGrid('getGridParam', 'selrow');
				var uid="<?php echo $u_id;?>";
				if(uid==gr)
				{
					swal('不能删除自己', "", "error");
					return false;
				}
				if (gr != null){
					jQuery("#table_list_2").jqGrid('delGridRow', gr, {
						reloadAfterSubmit : true
					});
					$("#dData").click(function(){
						var delurl='<?php echo U("index/user/user_delete");?>';
						var id = gr;
						var postdata={id:id};
						$.post(delurl,postdata,function(data){
							var code=data.code;
							var msg=data.msg;
							//swal(msg, "", "error");
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
		//editurl:'<?php echo U("index/user/user_edit");?>',
    });
	
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000;cursor:Pointer; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='tianjia  glyphicon glyphicon-plus'><span    style='position:relative;margin-left:2px;'>添加</span></span>");
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px;  font-size: 1.1em;' class='search_btn  glyphicon glyphicon-search'><span style='position:relative;margin-left:2px;'>搜索</span></span>");
    
    $("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon glyphicon-refresh'><span style='position:relative;margin-left:2px;'>刷新</span></span>");
	$("#t_table_list_2").append("<span style='height: 20px;color: #000000; line-height: 21px; margin-left: 30px; font-size: 1.1em;' class='search_btn glyphicon add-rule ui-add glyphicon-folder-open'><span style='position:relative;margin-left:5px;'>导出数据</span></span>");
	
	$(".glyphicon-refresh").click(function(){
		window.location.reload();
		//$("#refresh_table_list_2").trigger('click');
	}); 
	$(".glyphicon-search").click(function(){
		$("#search_table_list_2").trigger('click');
	}); 
	
	$(".glyphicon-folder-open").click(function(){
		var open='<?php echo U("index/user/loadout");?>';
		window.open(open);
		return false;
	});
	
	$(".glyphicon-plus").click(function(){
		jQuery("#table_list_2").jqGrid('editGridRow', "new", {
			height : 300,
			reloadAfterSubmit : true
		});
		var name_company = $("select#name_company");	//获取下面下拉框RoleName对象
		var name_branch = $("select#name_branch");	//获取下面下拉框RoleName对象
		name_company.attr("disabled", 'disabled'); 
		name_branch.attr("disabled","disabled");
		$("#sData").click(function(){
			var editurl='<?php echo U("index/user/user_add");?>';
			var name=$.trim($(".FormGrid #name").val());
			var sex=$.trim($(".FormGrid #sex").val());
			var tel=$.trim($(".FormGrid #tel").val());
			var address=$.trim($(".FormGrid #address").val());
			var join_time=$.trim($(".FormGrid #join_time").val());
			var role_code=$.trim($(".FormGrid #role_name").val());
			var waycompany_id=$.trim($(".FormGrid #name_company").val());
			var branch_id=$.trim($(".FormGrid #name_branch").val());
			var username=$.trim($(".FormGrid #username").val());
			var password=$.trim($(".FormGrid #password").val());
			var postdata={name:name,sex:sex,tel:tel,address:address,join_time:join_time,role_code:role_code,waycompany_id:waycompany_id,branch_id:branch_id,username:username,password:password};
			$.post(editurl,postdata,function(data){
				var code=data.code;
				var msg=data.msg;
				//swal(msg, "", "error");
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
    $("#table_list_2").jqGrid("navGrid", "#pager_list_2", 
	{
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