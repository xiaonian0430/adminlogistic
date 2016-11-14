<?php
namespace Index\Controller;
use Think\Controller;
class BaseController extends Controller {
	public $u_username;
	public $u_password;
	public $u_id;
	public $u_name;
	public $u_role_name;
	public $u_role_code;
	public $u_sub_role;
	public $u_branch_id;
	public $u_waycompany_id;
	
	public function _initialize(){
		$mx=$_SESSION['wl_unxx'];
		$my=$_SESSION['wl_pdxx'];
		
		$where=array();
		$where['username']=$mx;
		$where['password']=$my;
		
		$field='userx.id u_id,userx.name u_name,userx.branch_id u_branch_id,userx.waycompany_id u_waycompany_id';
		$field.=',r.name u_role_name,r.code u_role_code,r.sub_role u_sub_role';
		$join_role_user='join '.C('DB_PREFIX').'role_user ru on ru.user_id=userx.id';
		$join_role='left join '.C('DB_PREFIX').'role r on r.id=ru.role_id';
		$find=M('user userx')->join($join_role_user)->join($join_role)->field($field)->where($where)->find();
		if(!$find){
			 redirect(U('index/login/index'));
			 exit;
		 }else{
			session('wl_unxx',$mx);
			session('wl_pdxx',$my);
			
			$this->u_username=$mx;
			$this->u_password=$my;
			
			$this->u_id=$find['u_id'];
			$this->u_name=$find['u_name'];
			$this->u_role_name=$find['u_role_name'];
			$this->u_sub_role=$find['u_sub_role'];
			$this->u_role_code=$find['u_role_code'];
			$this->u_branch_id=$find['u_branch_id'];
			$this->u_waycompany_id=$find['u_waycompany_id'];
			
			$this->assign($find);
		 }
	}
}