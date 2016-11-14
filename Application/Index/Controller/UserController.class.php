<?php
namespace Index\Controller;
use Think\Controller;
class UserController extends BaseController {
	
	/**
	* 用户信息
	*/
	public function user()
	{
		//获取用户列表
		$users=$this->get_user_list();
		$users_json=json_encode($users);
		$this->assign('users',$users_json);
		
		//获取角色列表		
		$roles=$this->get_role_list();
		$role_list=role_list_v2($roles);
		$this->assign('role_list',$role_list);
		
		$u_waycompany_id=$this->u_waycompany_id;
		$u_branch_id=$this->u_branch_id;
		
		//网点
		$brancklistsel=branchlist($this->u_waycompany_id,$this->u_branch_id,1);
		$this->assign('brancklistsel',$brancklistsel);
		
		//获取物流公司
		$companylistsel=companylist($this->u_waycompany_id);
		$this->assign('companylistsel',$companylistsel);
		
		$this->assign('u_id',$this->u_id);
		$this->display();
	}
	
	/**
	* 获取系统用户列表
	*/
	function get_user_list()
	{
		//初始化查询条件
		$where=array();
		
		//获取角色订单显示情况
		$u_branch_id=$this->u_branch_id;
		$u_waycompany_id=$this->u_waycompany_id;
		
		if($u_waycompany_id!=0){
			if($u_branch_id!=0){
				$where['userx.branch_id']=$u_branch_id;
			}else{
				$where['userx.waycompany_id']=$u_waycompany_id;
			}
		}
		
		$join='left join '.C('DB_PREFIX').'waycompany waycompany on waycompany.id=userx.waycompany_id';
		$join_branch='left join '.C('DB_PREFIX').'branch branch on branch.id=userx.branch_id';
		$join_role_user='join '.C('DB_PREFIX').'role_user ru on ru.user_id=userx.id';
		$join_role='left join '.C('DB_PREFIX').'role r on r.id=ru.role_id';
		
		$field='userx.id,userx.name,userx.sex,userx.address,userx.tel,userx.join_time,userx.username';
		$field.=',waycompany.name name_company';
		$field.=',branch.name name_branch';
		$field.=',r.name role_name';
		$order='userx.id desc';
		$users=M('user userx')->field($field)->join($join)->join($join_branch)->join($join_role_user)->join($join_role)->where($where)->order($order)->select();
		foreach($users as $key=>$value){
			$users[$key]['join_time']=$value['join_time']?date('Y-m-d',$value['join_time']):'';
		}
		return $users;
	}
	
	/**
	* 获取角色角色列表
	*/
	function get_role_list()
	{
		$where=array();
		$where['id']=array('in',$this->u_sub_role);
		
		$order='listsort asc';
		$field='id,name,code';
		$roles=M('role')->where($where)->field($field)->order($order)->select();
		return $roles;
	}
	
	/**
	* 获取角色选择信息
	* 0 参数错误
	* 1 不需要所属于物流公司
	* 2 需要所属于物流公司
	*/
	public function role_sel_info_wlgs()
	{
		$id=I('get.id',0);
		if($id==0)
		{
			return_json(0,'请选择系统用户类型','');
			exit;
		}
		$role_info=$this->get_role_info($id);
		$role_code=$role_info['code'];
		
		$class=new LogisticsStatusController();
		$belong=$class->role_belong($role_code);
		if($belong==0)
		{
			return_json(1,'','');
			exit;
		}
		if($belong==1)
		{
			return_json(2,'','');
			exit;
		}
		if($belong==2){
			return_json(3,'','');
			exit;
		}
	}
	
	
	/**
	* 返回角色码
	* 参数：主键id
	*/
	function get_role_info($id){
		$data_return=array();
		if($id!=0){
			$where=array();
			$where['id']=$id;
			$field='code';
			$data_return=M('role')->where($where)->field($field)->find();
		}
		return $data_return;
	}
	/**
	* 获取角色选择信息
	*/
	public function role_sel_info_wangdian(){
		$id=I('get.id',0);
		$role=I('get.role',0);
		if($role==0){
			return_json(0,'请选择系统用户类型','');
			exit;
		}
		if($id==0){
			return_json(0,'请选择所属物流公司','');
			exit;
		}
		$role_info=$this->get_role_info($role);
		$role_code=$role_info['code'];
		$class=new LogisticsStatusController();
		$belong=$class->role_belong($role_code);
		$brancklistsel=branchlist($id);
		if($belong==1){
			return_json(1,'',$brancklistsel);
			exit;
		}
		if($belong==2){
			return_json(2,'',$brancklistsel);
			exit;
		}
		
	}
	
	/**
	* 获取区域内 县市区
	* 0 失败
	* 1 成功
	*/
	public function subarea(){
		$id=I('get.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		$where=array();
		$where['parent_id']=$id;
		$subarea=M('area')->where($where)->select();
		if($subarea){
			return_json(0,'获取县市区成功',$subarea);
			exit;
		}else{
			return_json(0,'获取县市区失败','');
			exit;
		}
	}
	
	/**
	* 添加用户
	* 1添加成功
	* 0添加失败
	*/
	public function user_add(){
		//return_json(0,'后台调试中，暂不能添加员工账号，请使用下面已有的账号进行测试！','');
			//exit;
			
		$role_id=I('post.role_id',0);
		$role_code=I('post.role_code',0);
		$waycompany_id=I('post.waycompany_id',0);
		$branch_id=I('post.branch_id',0);
		$name=I('post.name','');
		$sex=I('post.sex','');
		$tel=I('post.tel','');
		$join_time=I('post.join_time','');
		$address=I('post.address','');
		$username=I('post.username','');
		$password=I('post.password','');
		
		
		if($name==''){
			return_json(0,'姓名不能为空','');
			exit;
		}
		if($sex==''){	
			return_json(0,'性别不能为空','');
			exit;
		}
		if($tel==''){
			return_json(0,'联系电话不能为空','');
			exit;
		}
		
		if($join_time==''){
			return_json(0,'入职时间不能为空','');
			exit;
		}else{
			$join_time=strtotime($join_time);
		}
		
		if($address==''){
			return_json(0,'地址不能为空','');
			exit;
		}
		
		if($role_code==0){
			return_json(0,'用户类型不能为空','');
			exit;
		}
		if(!$waycompany_id)
		{
			$waycompany_id=$this->u_waycompany_id;
		}
		if(!$branch_id)
		{
			$branch_id=$this->u_branch_id;
		}
		if($username==''){
			return_json(0,'用户名不能为空','');
			exit;
		}
		
		$where=array();
		$find=0;
		$where['username']=$username;
		$find=M('user')->where($where)->find();
		if($find){
			return_json(0,'用户名已存在','');
			exit;
		}
		
		if($password==''){
			return_json(0,'用户密码不能为空','');
			exit;
		}
		
		$data=array();
		$data['waycompany_id']=$waycompany_id;
		$data['branch_id']=$branch_id;
		$data['name']=$name;
		$data['sex']=$sex;
		$data['tel']=$tel;
		$data['address']=$address;
		$data['join_time']=$join_time;
		
		$data['username']=$username;
		$data['password']=xx_md5($password);
		
		$cur_time=time();
		$data['add_time']=$cur_time;
		$data['update_time']=$cur_time;
		
		
		$add=M('user')->data($data)->add();	
		
		if($add){
			$where=array();
			$where['username']=$username;
			$user_id=M('user')->where($where)->getField('id');
			
			$data_ru=array();
			$data_ru['role_id']=$role_code;
			$data_ru['user_id']=$user_id;
			$data_ru['update_time']=$cur_time;
			
			M('role_user')->data($data_ru)->add();
			
			return_json(1,'用户添加成功','');
			exit;
		}else{
			return_json(0,'用户添加失败','');
			exit;
		}
	}
	
	/*
	* 获取角色名称
	*/
	public function role_name($code){
		$LogisticsStatus=new LogisticsStatusController();
		$role_name=$LogisticsStatus->role_name($code);
		return $role_name;
	}
	
	/**
	* 删除用户
	* 1 成功
	* 0 失败
	*/
	public function user_delete()
	{
		$id=I('post.id',0);
		if($id==0)
		{
			return_json(0,'参数错误！','');
			exit;
		}
		if($id==$this->u_id)
		{
			return_json(0,'不能删除自己！','');
			exit;
		}
		$where=array();
		$where['id']=$id;
		$delete=M('user')->where($where)->delete();
		if($delete){
			$where=array();
			$where['user_id']=$id;
			M('role_user')->where($where)->delete();
			return_json(1,'删除成功','');
			exit;
		}else{
			return_json(0,'删除失败','');
			exit;
		}
	}
	
	/**
	* 编辑用户
	* 1 成功
	* 0 失败
	*/
	public function user_edit(){
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		
		$role_code=I('post.role_code',0);
		$waycompany_id=I('post.waycompany_id',0);
		$branch_id=I('post.branch_id',0);
		$name=I('post.name','');
		$sex=I('post.sex','');
		$tel=I('post.tel','');
		$address=I('post.address','');
		$join_time=I('post.join_time','');
		$username=I('post.username','');
		$password=I('post.password','');
		
		if($name==''){
			return_json(0,'姓名不能为空','');
			exit;
		}
		if($sex==''){
			return_json(0,'性别不能为空','');
			exit;
		}
		if($tel==''){
			return_json(0,'联系电话不能为空','');
			exit;
		}
		
		if($join_time==''){
			return_json(0,'入职时间不能为空','');
			exit;
		}else{
			$join_time=strtotime($join_time);
		}
		
		if($address==''){
			return_json(0,'地址不能为空','');
			exit;
		}
		
		if($role_code==0){
			return_json(0,'用户类型不能为空','');
			exit;
		}
		
		if($username==''){
			return_json(0,'用户名不能为空','');
			exit;
		}
		$where=array();
		$where['username']=$username;
		$where['id']=array('neq',$id);
		$find=M('user')->where($where)->find();
		if($find){
			return_json(0,'用户名已存在','');
			exit;
		}
		
		$cur_time=time();
		$data=array();
		if($password!=''){
			$data['password']=xx_md5($password);
		}
		
		
		$data['waycompany_id']=$waycompany_id;
		$data['branch_id']=$branch_id;
		$data['name']=$name;
		$data['sex']=$sex;
		$data['tel']=$tel;
		$data['address']=$address;
		$data['join_time']=$join_time;
		
		$data['username']=$username;
		$data['add_time']=$cur_time;
		
		$where=array();
		$where['id']=$id;
		
		$save=M('user')->where($where)->data($data)->save();
		if($save){
			$where=array();
			$where['user_id']=$id;
			
			$data_ru=array();
			$data_ru['user_id']=$id;
			$data_ru['role_id']=$role_code;
			$data_ru['update_time']=$cur_time;
			
			$find=M('role_user')->where($where)->find();
			if($find){
				
				M('role_user')->where($where)->data($data_ru)->save();
			}else{
				M('role_user')->data($data_ru)->add();
			}
						
			return_json(1,'用户更新成功','');
			exit;
		}else{
			return_json(0,'用户更新失败','');
			exit;
		}
	}
	
	/**
	* 业务追踪
	*/
	public function staffmap(){
		//初始化核心类
		$class=new LogisticsStatusController();
		
		//用户信息
		$userx=$this->get_staff_map_info($class);
		
		//用户数据输出
		$usery=staff_info($userx);

		//框架模板赋值
		$this->assign('userx',$usery);
		
		$orders=$this->get_staff_orders($class);
		foreach($orders as $key=>$value){
			$href=U("index/index/yundan/no/".$value['waybill_no']);
			$ordersm[$value['id']].="<a href='".$href."' target='J_iframe'><p class='stylex'>".$value['waybill_no']."</p></a>";
		}
		
		foreach($userx as $keyx=>$valuex){
			$userx[$keyx]['orders']=$ordersm[$valuex['id']];
		}

		$userx_json=json_encode($userx);
		$this->assign('userx_json',$userx_json);
		
		//模板渲染
		$this->display();
	}
	
	/**
	* 获取用户当前拥有的订单以及位置信息
	*/
	public function  get_staff_map_info($class){
		//获取角色订单显示情况
		$u_branch_id=$this->u_branch_id;
		$u_waycompany_id=$this->u_waycompany_id;
		//初始化查询条件
		$where=array();
		if($u_waycompany_id!=0){
			if($u_branch_id!=0){
				$where['userx.branch_id']=$u_branch_id;
				$code_list=$class->app_role_code_list();//app端角色
				$where['r.code']=array('in',$code_list);
			}else{
				$where['userx.waycompany_id']=$u_waycompany_id;
			}
		}
		
		$join='left join '.C('DB_PREFIX').'waybill waybill on waybill.last_user_id=userx.id';
		$join_role_user='join '.C('DB_PREFIX').'role_user ru on ru.user_id=userx.id';
		$join_role='left join '.C('DB_PREFIX').'role r on r.id=ru.role_id';
		//$join_map_icon='left join '.C('DB_PREFIX').'map_icon mi on ru.role_id=mi.role_id';
		$field='userx.id,userx.name,userx.online_time,userx.longitude,userx.latitude';
		$field.=',count(*) as waybill_num';
		$field.=',r.name role_name,r.code role_code';
		$group='userx.id';
		$order='waybill_num desc';
		
		//数据查询
		$userx=M('user userx')->join($join)->join($join_role_user)->join($join_role)->join($join_map_icon)->field($field)->where($where)->group($group)->order($order)->select();
		return $userx;
	}
	
	/**
	* 获取用户当前拥有的订单以及位置信息
	*/
	public function  get_staff_orders($class){
		//获取角色订单显示情况
		$u_branch_id=$this->u_branch_id;
		$u_waycompany_id=$this->u_waycompany_id;
		//初始化查询条件
		$where=array();
		if($u_waycompany_id!=0){
			if($u_branch_id!=0){
				$where['userx.branch_id']=$u_branch_id;
				$code_list=$class->app_role_code_list();//app端角色
				$where['r.code']=array('in',$code_list);
			}else{
				$where['userx.waycompany_id']=$u_waycompany_id;
			}
		}
		$join='left join '.C('DB_PREFIX').'waybill waybill on waybill.last_user_id=userx.id';
		$join_role_user='join '.C('DB_PREFIX').'role_user ru on ru.user_id=userx.id';
		$join_role='left join '.C('DB_PREFIX').'role r on r.id=ru.role_id';
		$field='userx.id';
		$field.=',waybill.waybill_no';
		$ordersm=array();
		$orders=M('user userx')->join($join)->join($join_role_user)->join($join_role)->field($field)->where($where)->select();
		return $orders;
	}
	
	
	/**
	* 获取用户当前拥有的订单以及位置信息
	* 0 获取失败
	* 1 获取成功
	*/
	public function  get_staff_pos(){
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		$where=array();
		$where['u.id']=$id;
		$join_role_user='join '.C('DB_PREFIX').'role_user ru on ru.user_id=u.id';
		$join_role='left join '.C('DB_PREFIX').'role r on r.id=ru.role_id';
		$field='u.name,r.name role_name,u.longitude,u.latitude,mi.icon';
		$join_map_icon='join '.C('DB_PREFIX').'map_icon mi on ru.role_id=mi.role_id';
		
		$user=M('user u')->where($where)->join($join_role_user)->join($join_role)->join($join_map_icon)->field($field)->find();
		if($user){
			$ordersm=$this->staff_orders_str($id);
			$user['orders']=$ordersm;
			return_json(1,'获取成功',$user);
			exit;
		}else{
			return_json(0,'获取失败','');
			exit;
		}
		
	}
	
	/**
	* 获取用户当前拥有的订单
	* 0 获取失败
	* 1 获取成功
	*/
	public function staff_orders_str($id){
		$ordersm='';
		
		$field='waybill_no';
		$where=array();
		$where['last_user_id']=$id;
		$orders=M('waybill')->field($field)->where($where)->select();
		foreach($orders as $key=>$value){
			$href=U("index/index/yundan/no/".$value['waybill_no']);
			$ordersm.="<a href='".$href."' target='J_iframe'><p class='stylex'>".$value['waybill_no']."</p></a>";
		}
		return $ordersm;
	}
	
	/**
	* 获取用户当前拥有的订单
	* 0 获取失败
	* 1 获取成功
	*/
	public function staff_orders(){
		//post参数过滤
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		
		//查询条件
		$where=array();
		$where['last_user_id']=$id; 
		
		$field='id,waybill_no,waybill_name';
		
		//数据查询
		$waybill=M('waybill')->field($field)->where($where)->select();
		if($waybill){
			return_json(1,'获取成功',$waybill);
			exit;
		}else{
			return_json(0,'获取失败','');
			exit;
		}
	}
}