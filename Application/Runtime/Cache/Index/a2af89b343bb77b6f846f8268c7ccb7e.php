<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>WL物流系统-登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> 
	<link href="/Public/style_HUI/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/style_HUI/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="/Public/style_HUI/css/animate.min.css" rel="stylesheet">
    <link href="/Public/style_HUI/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">WL</h1>

            </div>
            <h3>欢迎使用-WL物流系统</h3>

            <form class="m-t" role="form" action="" method="post" id="form1">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" id="username" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="密码" required="">
                </div>
                <button type="" class="btn btn-primary block full-width m-b" id="jsin">登 录</button>
				<p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="#">注册一个新账号</a></p>
				<p class="text-muted text-center" style="color:red;" id="msg"></p>
            </form>
        </div>
    </div>
    <script src="/Public/style_HUI/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Public/style_HUI/js/bootstrap.min.js?v=3.3.6"></script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
<script>
$(document).ready(function(){
	$("#jsin").click(function(){
		var options = {
			url: '<?php echo U("index/login/in");?>',
			type: 'post',
			dataType: 'text',
			data: $("#form1").serialize(),
			success: function (datax) {
				var data=$.parseJSON(datax);
				var code=data.code;
				var msg=data.msg;
				if(code==1){
					var index='<?php echo U("index/index/index");?>';
					window.location=index;
				}else{
					$("#msg").text(msg);
					return false;
				}
			}
		};
		$.ajax(options);
		return false;
	});
	
	$("#username,#password").focus(function(){
		$("#msg").text('');
	});
});
</script>

<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
</html>