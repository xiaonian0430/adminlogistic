<?php
namespace Index\Controller;
use Think\Controller;
class LoginController extends Controller {
	
	public function index(){
		$this->display();
	}
	
	/*
	* 登录
	*/
	public function in()
	{
		$username=I('post.username','','trim');
		$password=I('post.password','','trim');
		
		if($username=='')
		{
			return_json(0,'用户名不能为空','');
			exit;
		}
		
		if($password=='')
		{
			return_json(0,'登录密码不能为空','');
			exit;
		}else{
			$password=xx_md5($password);
		}
		
		$where=array();
		$where['username']=$username;
		$where['password']=$password;

		$find=$this->get_user_info($username,$password);
		if($find)
		{
			
			$role_code=$find['role_code'];
			$name=$find['name'];
			$role_name=$find['role_name'];
			if($find['pc']==1)
			{
				session('wl_unxx',$username);
				session('wl_pdxx',$password);
				return_json(1,'登录成功','');
				exit;
			}
			else
			{
				return_json(0,'您的身份是【'.$role_name.'】无权限登陆pc端','');
				exit;
			}
			
		}
		else
		{
			return_json(0,'登录失败【用户名/密码错误】','');
			exit;
		}
	}
	
	/**
	* 获取用户信息验证
	*/
	public function get_user_info($username,$password)
	{
		if($username=='')
		{
			return_json(0,'用户名不能为空','');
			exit;
		}
		
		if($password=='')
		{
			return_json(0,'登录密码不能为空','');
			exit;
		}
		$where=array();
		$where['userx.username']=$username;
		$where['userx.password']=$password;
		$join_role_user='join '.C('DB_PREFIX').'role_user ru on ru.user_id=userx.id';
		$join_role='left join '.C('DB_PREFIX').'role r on r.id=ru.role_id';
		$field='userx.id';
		$field.=',r.name role_name,r.code role_code,r.pc';
		$find=M('user userx')->join($join_role_user)->join($join_role)->field($field)->where($where)->find();
		return $find;
	}
	
	/*
	* 退出
	*/
	public function out()
	{
		unset($_SESSION['wl_unxx']);
		unset($_SESSION['wl_pdxx']);
		redirect(U('index/login/index'));
	}
}