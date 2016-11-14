<?php
return array(
	'TMPL_PARSE_STRING'  =>array(
            '__PUBLIC__' => '/Public', // 更改默认的__PUBLIC__ 替换规则
            '__DATA__' => '/index.php/data', // 更改默认的__PUBLIC__ 替换规则
		),
	'MODULE_ALLOW_LIST'    =>    array('Index','Data','Template'),
	'LOAD_EXT_CONFIG' 		=> 'db,info,email,safe,upfile,cache,route,app,alipay,sms,rippleos_key,platform,pay_type,scene_type',
	'OUTPUT_ENCODE'         =>  true, 			//页面压缩输出
	'CUS_ADDR'         =>'http://test.hyaomall.com/index.php?g=Home&m=CustomerAddress&a=get',
);