<?php
namespace Index\Controller;
use Think\Controller;
class OrderController extends Controller 
{	
	/**
	* 获取我的处理中运单
	* 参数：app员工电话号码
	* 0 失败
	* 1 成功
	*/
	public function get_orders_ing()
	{
		$tel=I('post.tel','');
		if(tel=='')
		{
			return_json_v2(0,'电话号码不能为空！','');
			exit;
		}
		$status='S06';
		$type='neq';
		$waybill=$this->get_waybill($tel,$status,$type);
		if($waybill)
		{
			return_json_v2(1,'获取成功',$waybill);
			exit;
		}
		else
		{
			return_json_v2(0,'获取失败','');
			exit;
		}
	}
	
	/**
	* 获取我的完成运单
	* 参数：app员工电话号码
	* 0 失败
	* 1 成功
	*/
	public function get_orders_over()
	{
		$tel=I('post.tel','');
		if(tel=='')
		{
			return_json_v2(0,'电话号码不能为空！','');
			exit;
		}
		$status='S06';
		$type='eq';
		$waybill=$this->get_waybill($tel,$status,$type);
		if($waybill)
		{
			return_json_v2(1,'获取成功',$waybill);
			exit;
		}
		else
		{
			return_json_v2(0,'获取失败','');
			exit;
		}
	}
	
	public function get_waybill($tel,$status,$type)
	{
		$where=array();
		$where['tel']=$tel;
		$where['status']=array($type,$status);
		$field='waybill_no,supplier,packages';
		$waybill=M('waybill')->field($field)->where($where)->select();
		return $waybill;
	}
}