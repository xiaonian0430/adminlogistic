<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2016 xiaonian All rights reserved.
// +----------------------------------------------------------------------
// | Author: xiaonian0430@163.com
// +----------------------------------------------------------------------
// | Time: 2016/09/02
// +----------------------------------------------------------------------

/**
 * 物流后台系统函数库
 */

/**
 * 获取和设置配置参数 支持批量定义
 * @param $waybill 配置值
 * @return waybill_json
 */

function waybillData($waybill=null,$status_name) {
   
   $waybillx=array();
   if(!$waybill){
		$key=0;
		$waybillx[$key]['waybill_no']=$value['waybill_no'];
		$waybillx[$key]['waybill_name']=$value['waybill_name'];
		$waybillx[$key]['name']=$value['name'];
		$waybillx[$key]['tel']=$value['tel'];
		$waybillx[$key]['address']=$value['area'].$value['subarea'].'-'.$value['address'];
		$waybillx[$key]['address2']=$value['supplier'];
		$waybillx[$key]['status']=$status_name;
		$waybillx[$key]['remark']=$value['remark'];
		$waybillx[$key]['action']="<input class='btn btn-w-m btn-info glyphicon-edit' id='0' data-toggle='modal' data-target='#myModal2' type='button' value='无'>";
   }else{
	   foreach($waybill as $key=>$value){
			
			$waybillx[$key]['waybill_no']=$value['waybill_no'];
			$waybillx[$key]['waybill_name']=$value['waybill_name'];
			$waybillx[$key]['name']=$value['name'];
			$waybillx[$key]['tel']=$value['tel'];
			$waybillx[$key]['address']=$value['area'].$value['subarea'].'-'.$value['address'];
			$waybillx[$key]['address2']=$value['supplier'];
			$waybillx[$key]['status']=$status_name;
			$waybillx[$key]['remark']=$value['remark'];
			$waybillx[$key]['action']="<input class='btn btn-w-m btn-info glyphicon-edit' id='".$value['id']."' data-toggle='modal' data-target='#myModa".$value['id']."' type='button' value='查看详情'>";
			$waybillx[$key]['action'].="<input id='".$value['id']."' class='btn btn-w-m btn-danger del_table' type='button' value='删除'>";
		}
	}
	$waybill_json=json_encode($waybillx);
    return $waybill_json;
}

/**
* 获取用户信息
*/
function users($role_code='',$field='',$branch_id=0){
	$where=array();
	if($role_code){
		$where['r.code']=$role_code;
	}
	if($branch_id){
		$where['u.branch_id']=$branch_id;
	}
	$join_role_user='left join '.C('DB_PREFIX').'role_user ru on ru.user_id=u.id';
	$join_role='left join '.C('DB_PREFIX').'role r on r.id=ru.role_id';
	$users=M('user u')->field($field)->where($where)->join($join_role_user)->join($join_role)->select();
	return $users;
}


/*
* 获取区域名称
* 参数：0（大区域）/1（县市区） 
*/

function area_list($parent_id=0){
	$where=array();
	$where['parent_id']=$parent_id;
	$area=M('area')->where($where)->select();
	return $area;
}

/*
* 获取区域 下拉菜单
* 参数：区域数组 
*/
function area_list_option($area){
	$str='';
	foreach($area as $key=>$value){
		if($str==''){
			$str='<option value="" disabled selected>请选择区域</option>';
		}
		$str.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
	}
	if($str==''){
		$str='<option value="" disabled selected>请选择区域</option>';
	}
	return $str;
}

/*
* 获取员工 在线、离线、位置信息
* 参数：员工数组
*/
function staff_info($userx){
	$time=time();
	$disx=C('WL_DIS_TIME');
	foreach($userx as $key=>$value){
		$online_time=$value['online_time'];
		$dis_time=$time-$online_time;
		if($dis_time>$disx){
			$userx[$key]['info_online']='<span class="label">离线</span>';
		}else{
			$userx[$key]['info_online']='<span class="label label-info">在线</span>';
		}
	}
	return $userx;
}

/*
* 获取区域名称
* 参数：0（大区域）/1（县市区） 
*/

function arealist($area){
	$arealistsel='';
	foreach($area as $key =>$value){
		$id=$value['id'];
		$name=$value['name'];
		if($arealistsel==''){
			$arealistsel="0:第一级区域";
		}
		$arealistsel.=";".$id.":".$name;
		
	}
	return $arealistsel;
}

function arealist_v2($area){
	$arealistsel='';
	foreach($area as $key =>$value){
		$name=$value['name'];
		$id=$value['id'];
		if($arealistsel==''){
			$arealistsel="0:请选择区域";
		}
		$arealistsel.=";".$id.":".$name;
	}
	return $arealistsel;
}

/*
* 获取物流公司列表
* 参数： 
*/

function companylist($id=0)
{
	$companylistsel='';
	$where=array();
	if($id)
	{
		$where['id']=$id;
		$waycompany=M('waycompany')->where($where)->select();
		$name=$waycompany[0]['name'];
		$companylistsel=$id.":".$name;
	}
	else
	{
		$waycompany=M('waycompany')->where($where)->select();
		foreach($waycompany as $key =>$value)
		{
			$id=$value['id'];
			$name=$value['name'];
			if($companylistsel=='')
			{
				$companylistsel="0:请选择物流公司";
			}
			$companylistsel.=";".$id.":".$name;
		}
	}
	return $companylistsel;
}

/*
* 获取物流公司列表
* 参数： 
*/

function branchlist($company_id=0,$branch_id=0,$tag=0)
{
	$where=array();
	$field='id,name';
	if($company_id)
	{
		$where['waycompany_id']=$company_id;
		if(!$tag)
		{
			if($branch_id)
			{
				$where['id']=$branch_id;
			}
			
			$branch=M('branch')->where($where)->field($field)->select();
			return $branch;
		}
	}
	
	$companylistsel='';
	if($branch_id)
	{
		$where['id']=$branch_id;
		$branch=M('branch')->where($where)->field($field)->select();
		$name=$branch[0]['name'];
		$companylistsel=$branch_id.":".$name;
	}
	else
	{
		$branch=M('branch')->where($where)->field($field)->select();
		foreach($branch as $key =>$value)
		{
			$id=$value['id'];
			$name=$value['name'];
			if($companylistsel=='')
			{
				$companylistsel="0:请选择网点";
			}
			$companylistsel.=";".$id.":".$name;
		}
	}
	return $companylistsel;
	
}

/*
* 返回收货列表数据
*/

function waybill_data($status='',$order='',$no){
	if($order==''){
		$order='id desc';
	}
	$where=array();
	if($status!=''){
		$where['status']=$status;
	}
	if($no!=''){
		$where['waybill_no']=$no;
	}
	$field='id,waybill_no,waybill_name,name,tel,area,subarea,address,remark,status,supplier';
	$waybill=M('waybill')->field($field)->where($where)->order($order)->select();
	
    return $waybill;
}


/*
* 返回 去掉json最外层‘{}’符号
*/

function role_list($data=''){
	
	if($data==''){
		return '';
	}
	
	$data_str='';
	foreach($data as $key=>$value){
		if($data_str==''){
			$data_str=':请选择用户类型';
		}
		$data_str.=';'.$key.':'.$value;
	}
	
    return $data_str;
}

/*
* 返回 去掉json最外层‘{}’符号 字符串
*/

function role_list_v2($data=''){
	
	if($data==''){
		return '';
	}
	
	$data_str='';
	foreach($data as $key=>$value){
		if($data_str==''){
			$data_str='0:请选择用户类型';
		}
		$data_str.=';'.$value['id'].':'.$value['name'];
	}
	
    return $data_str;
}

/**
* 返回json数据
*/
function return_json($code,$msg = 'success', $data = ''){
	$message = array('code' => $code,'msg' => $msg, 'data' => $data);
	header('Content-Type: application/json');
	echo json_encode($message);
}

function return_json_v2($code,$msg = 'success', $data = ''){
	$message = array('status' => $code,'msg' => $msg, 'result' => $data);
	header('Content-Type: application/json');
	echo json_encode($message);
}

/**
* md5加密,前后添加字符串
*/
function xx_md5($str){
	$start=C('XPASS_START');
	$end=C('XPASS_END');
	$md5x=md5($start.$str.$end);
	return $md5x;
}

/**
 * 获取和设置配置参数 支持批量定义
 * @param string|array $name 配置变量
 * @param mixed $value 配置值
 * @param mixed $default 默认值
 * @return mixed
 */
function CX($name=null, $value=null,$default=null) {
    static $_config = array();
    // 无参数时获取所有
    if (empty($name)) {
        return $_config;
    }
    // 优先执行设置获取或赋值
    if (is_string($name)) {
        if (!strpos($name, '.')) {
            $name = strtoupper($name);
            if (is_null($value))
                return isset($_config[$name]) ? $_config[$name] : $default;
            $_config[$name] = $value;
            return null;
        }
        // 二维数组设置和获取支持
        $name = explode('.', $name);
        $name[0]   =  strtoupper($name[0]);
        if (is_null($value))
            return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
        $_config[$name[0]][$name[1]] = $value;
        return null;
    }
    // 批量设置
    if (is_array($name)){
        $_config = array_merge($_config, array_change_key_case($name,CASE_UPPER));
        return null;
    }
    return null; // 避免非法参数
}