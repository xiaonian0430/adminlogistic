<?php
/*
* 微信端签收
* 需要参数：公众号
*/
namespace Index\Controller;
use Think\Controller;
class QiansController extends Controller {
	
	public $token;//公众号token值
	
	/*
	* 初始化
	*/
	public function _initialize(){
		
		//获取公众号参数
		$token=I('get.token','','trim');
		$this->token=$token;
		session('token',$token);
		$this->assign('token',$token);
	}
	
	/**
	* 签收-主页
	*/
	public function index(){
		$this->display();
	}
	
	/**
	* 签收-完毕列表
	*/
	public function qs_over(){
		$this->display();
	}
	
	/**
	* 签收-操作
	*/
	public function qs_do(){
		//参数
		$status='S06';
		$add_time=time();
		
		$LogisticsStatus=new LogisticsStatus();
		$title=$LogisticsStatus->get_name($status);
		
		//post参数验证
		$waybill_no=I('post.waybill_no','','trim');
		$name_img=I('post.name_img','','trim');
		if($waybill_no==''){
			return_json(0,'物流单号为空','');
			exit;
		}
		
		if($name_img==''){
			return_json(0,'物流签收人名字不能为空','');
			exit;
		}
		
		//物流单号验证
		$where=array();
		$where['waybill_no']=$waybill_no;
		$field='id,status';
		$waybill=M('waybill')->field($field)->where($where)->find();
		
		if(!$waybill){
			return_json(0,'物流单号不存在','');
			exit;
		}
		
		//添加记录
		$data_his=array();
		$data_his['waybill_id']=$waybill['id'];
		$data_his['user_id']=0;
		$data_his['title']=$title;
		$data_his['operator']=$operator;
		$data_his['pre_status']=$waybill['status'];
		$data_his['next_status']=$status;
		$data_his['name_img']=$name_img;
		$data_his['add_time']=$add_time;
		
		$where2=array();
		$where2['waybill_id']=$waybill['id'];
		$where2['next_status']=$status;
		$find=M('history')->where($where2)->find();
		
		if($find){
			M('history')->where($where2)->data($data_his)->save();
		}else{
			M('history')->data($data_his)->add();
		}
		
		//更新物流订单
		$data_wb=array();
		$data_wb['status']=$status;
		$data_wb['last_user_id']=0;
		$data_wb['last_time']=$add_time;
		M('waybill')->where($where)->data($data_wb)->save();
		
		return_json(1,'签收成功','');
	}
}