<?php
/*
* 物流系统状态类
* 
*/
namespace Index\Controller;
use Think\Controller;
class LogisticsStatusController extends Controller{
	public $status_array;	//订单状态
	public $role_array;	//订单状态
	public $role_login;	//pc、app
	public $role_model;	//功能模块
	public $role_set;	//功能模块
	public $driver_role_code;	//货车司机
	public $xjy_role_code;	//总仓小件员
	public $index_array;	//首页参数配置
	
	/**
	* 默认构造函数
	*/
	
	public function __construct(){
		
		/**
		* R03 货车司机
		* R04 网点管理员（用于网点收货扫码记录）
		* R05 网点小件员
		* R06 客车司机
		* R10 物流公司管理员
		* R11 超级管理员
		*/
		$role3=array('R03'=>1);
		$role4=array('R04'=>1);
		$role5=array('R05'=>1);
		$role6=array('R06'=>1);
		$role7=array('R07'=>1);
		$rolex=array();//无任何角色
		
		$this->status_array=array(
			'S01'=>array(
				'status_code'=>'S01',
				'status_name'=>'接货录入信息',
				'time_limit'=>0,
				'nextstep'=>array(
					//新增改动流程
					array('status_code'=>'S04','flow_name'=>'网点收货','role'=>$role4),
				)
			),
			'S0301'=>array(
				'status_code'=>'S0301',
				'status_name'=>'仓库发货',
				'time_limit'=>0,
				'nextstep'=>array(
					array('status_code'=>'S04','flow_name'=>'网点收货','role'=>$role4),
					array('status_code' => 'S0501', 'flow_name' => '网点小件员收货', 'role' => $role5),
					array('status_code' => 'S0502', 'flow_name' => '网点客车司机收货', 'role' => $role6),
					array('status_code' => 'S06', 'flow_name' => '终端收货人签收', 'role' => $rolex),
				)
			),
			'S0302'=>array(
				'status_code'=>'S0302',
				'status_name'=>'司机扫码发货',
				'time_limit'=>0,
				'nextstep'=>array(
					array('status_code'=>'S04','flow_name'=>'网点收货','role'=>$role4),
					array('status_code' => 'S0501', 'flow_name' => '网点小件员收货', 'role' => $role5),
					array('status_code' => 'S0502', 'flow_name' => '网点客车司机收货', 'role' => $role6),
					array('status_code' => 'S06', 'flow_name' => '终端收货人签收', 'role' => $rolex),
				)
			),
			'S04'=>array(
				'status_code'=>'S04',
				'status_name'=>'网点收货',
				'time_limit'=>0,
				'nextstep'=>array(
					array('status_code'=>'S0501','flow_name'=>'小件员扫码收货','role'=>$role5),
					array('status_code'=>'S0502','flow_name'=>'客车司机扫码收货','role'=>$role6),
					array('status_code'=>'S06','flow_name'=>'终端收货人签收','role'=>$rolex),
					
					//新增改动流程
					array('status_code'=>'S0401','flow_name'=>'网点发货','role'=>$role4),
					array('status_code'=>'S0302','flow_name'=>'货车司机扫码发货','role'=>$role3),
				)
			),
			'S0401'=>array(
				'status_code'=>'S0401',
				'status_name'=>'网点发货(发货给：货车/小件员/客车)',
				'time_limit'=>0,
				'nextstep'=>array(
					array('status_code'=>'S0501','flow_name'=>'小件员扫码收货','role'=>$role5),
					array('status_code'=>'S0502','flow_name'=>'客车司机扫码收货','role'=>$role6),
					array('status_code'=>'S06','flow_name'=>'终端收货人签收','role'=>$rolex),
					
					//新增改动流程
					array('status_code'=>'S04','flow_name'=>'网点收货','role'=>$role4),
				)
			),
			'S0501x' => array(
				'status_code' => 'S0501x',
				'status_name' => '总仓发货',
				'time_limit' => 0,
				'nextstep' => array(
					array('status_code' => 'S06', 'flow_name' => '终端收货人签收', 'role' => $rolex),
					array('status_code' => 'S0502', 'flow_name' => '客车司机扫码收货', 'role' => $role6),
				)
			),
			'S0501'=>array(
				'status_code'=>'S0501',
				'status_name'=>'小件员扫码收货',
				'time_limit'=>0,
				'nextstep'=>array(
					array('status_code'=>'S06','flow_name'=>'终端收货人签收','role'=>$rolex),
					array('status_code' => 'S0502', 'flow_name' => '客车司机扫码收货', 'role' => $role6),
				)
			),
			'S0502'=>array(
				'status_code'=>'S0502',
				'status_name'=>'客车司机扫码收货',
				'time_limit'=>0,
				'nextstep'=>array(
					array('status_code'=>'S06','flow_name'=>'终端收货人签收','role'=>$rolex),
				)
			),
			'S06'=>array(
				'status_code'=>'S06',
				'status_name'=>'终端收货人签收',
				'time_limit'=>0,
				'nextstep'=>array(
					//签收结束
				)
			),
		);
		
		//首页显示数据配置
		$this->index_array=array(
			'time_out'=>432000, //5天时间
			'finish_status'=>'S06', //结束运单状态
			'onway_status'=>'S0301,S0302', //途中运单状态
		);
		
		//角色中文名称配置
		$this->role_array=array(
			'R10'=>'超级管理员',
			'R01'=>'接货人',
			'R02'=>'仓库人员',
			'R03'=>'货车司机',
			'R04'=>'网点收货员',
			'R05'=>'网点小件员',
			'R06'=>'客车司机',
			'R07'=>'仓库小件员',
		);
		
		
		//角色模块管理
		$this->role_model=array(
			'R02'=>1,
			'R04'=>1,
			'R10'=>0,
		);
		
		//角色配置  说明：部分关系逻辑处理已经搬到数据表，暂留勿删除。
		/*
		* name 角色名称
		* belong 角色所属机构（0无机构，1物流公司，2物流公司&网点）
		* login 登录权限0/1表示 pc登录电脑版本  app登录手机版本 
		* model 可执行模块	 
		* menu 可显示菜单	 
		* sub_role 子角色	 
		*/
		$this->driver_role_code='R03';
		$this->xjy_role_code='R05';
		
		$this->role_set=array(
			'R11'=>array(
				'name'=>'超级管理员',
				'belong'=>0,
				'login'=>array('pc'=>1,'app'=>0),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>1,'submenu'=>array('yundan'=>1)),
							'users'=>array('display'=>1,'submenu'=>array('user'=>1,'staffmap'=>1)),
							'infos'=>array('display'=>1,'submenu'=>array('area'=>1,'wangdian'=>1,'wlgs'=>1,'gys'=>1)),
						), //菜单
				'sub_role'=>array('R01'=>1,'R02'=>1,'R03'=>1,'R04'=>1,'R05'=>1,'R06'=>1,'R10'=>1,'R11'=>1), //
			),
			'R10'=>array(
				'name'=>'物流公司管理员',
				'belong'=>1,
				'login'=>array('pc'=>1,'app'=>0),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>1,'submenu'=>array('yundan'=>1)),
							'users'=>array('display'=>1,'submenu'=>array('user'=>1,'staffmap'=>1)),
							'infos'=>array('display'=>1,'submenu'=>array('area'=>1,'wangdian'=>1,'wlgs'=>1,'gys'=>1)),
						), //菜单
				'sub_role'=>array('R01'=>1,'R02'=>1,'R03'=>1,'R04'=>1,'R05'=>1,'R06'=>1,'R10'=>1), //
			),
			'R01'=>array(
				'name'=>'接货人',
				'belong'=>1,
				'login'=>array('pc'=>0,'app'=>1),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>0,'submenu'=>array()),
							'users'=>array('display'=>0,'submenu'=>array()),
							'infos'=>array('display'=>0,'submenu'=>array()),
						), //菜单
				'sub_role'=>array(), //
			),
			'R02'=>array(
				'name'=>'仓库人员',
				'belong'=>1,
				'login'=>array('pc'=>1,'app'=>0),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>1,'submenu'=>array('yundan'=>1)),
							'users'=>array('display'=>1,'submenu'=>array('user'=>1,'staffmap'=>1)),
							'infos'=>array('display'=>0,'submenu'=>array()),
						), //菜单
				'sub_role'=>array('R02'=>1,'R03'=>1,'R04'=>1,'R05'=>1,'R06'=>1), //
			),
			'R07'=>array(
				'name'=>'仓库小件员',
				'belong'=>1,
				'login'=>array('pc'=>0,'app'=>1),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>1,'submenu'=>array('yundan'=>1)),
							'users'=>array('display'=>1,'submenu'=>array('user'=>1,'staffmap'=>1)),
							'infos'=>array('display'=>0,'submenu'=>array()),
						), //菜单
				'sub_role'=>array(), //
			),
			'R03'=>array(
				'name'=>'货车司机',
				'belong'=>1,
				'login'=>array('pc'=>0,'app'=>1),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>0,'submenu'=>array()),
							'users'=>array('display'=>0,'submenu'=>array()),
							'infos'=>array('display'=>0,'submenu'=>array()),
						), //菜单
				'sub_role'=>array(), //
			),
			'R04'=>array(
				'name'=>'网点收货员',
				'belong'=>2,
				'order'=>1,
				'login'=>array('pc'=>1,'app'=>0),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>1,'submenu'=>array('yundan'=>1)),
							'users'=>array('display'=>1,'submenu'=>array('user'=>1,'staffmap'=>1)),
							'infos'=>array('display'=>0,'submenu'=>array()),
						), //菜单
				'sub_role'=>array('R04'=>1,'R05'=>1,'R06'=>1), //
			),
			'R05'=>array(
				'name'=>'网点小件员',
				'belong'=>2,
				'login'=>array('pc'=>0,'app'=>1),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>0,'submenu'=>array()),
							'users'=>array('display'=>0,'submenu'=>array()),
							'infos'=>array('display'=>0,'submenu'=>array()),
						), //菜单
				'sub_role'=>array(), //
			),
			'R06'=>array(
				'name'=>'客车司机',
				'belong'=>2,
				'login'=>array('pc'=>0,'app'=>1),
				'model'=>array(), //功能模块
				'menu'=>array(
							'yundans'=>array('display'=>0,'submenu'=>array()),
							'users'=>array('display'=>0,'submenu'=>array()),
							'infos'=>array('display'=>0,'submenu'=>array()),
						), //菜单
				'sub_role'=>array(), //
			),
		);
		
		/**
		*角色码说明：
		* R01 接货人
		* R02 仓库人员
		* R03 货车司机
		* R04 网点收货员（用于网点收货扫码记录）
		* R05 网点小件员
		* R06 客车司机
		* R07 仓库小件员
		* R10 超级管理员
		*/
	}
	
	
	/**
	* 获取状态信息
	* 参数：状态码
	*/
	public function get($status){
		return $this->status_array[$status];
	}
	
	/**
	* 获取状态信息
	*/
	public function get_nextstep($status){
		return $this->status_array[$status]['nextstep'];
	}
	
	/**
	* 获取状态信息
	*/
	public function getNameList(){
		return $this->status_array;
	}
	
	/**
	* 获取状态信息
	*/
	public function get_name($status){
		return $this->status_array[$status]['status_name'];
	}
	
	/**
     * 获取下一个状态
     * $status, $role 有值
     * $arr值为null
     * $next_info的值为null
     */

    public function get_next_status_code($status, $role,$role2='')
    {
        $arr = $this->get_nextstep($status);  //status为运单状态，get_nextstep获取下一个状态
        $next_info = array();
        foreach ($arr as $key => $value) 
		{
            $status_code = $value['status_code'];
            $status_role = $value['role'];
            $flow_name = $value['flow_name'];
			if($role2)
			{
				if ($status_role[$role] == 1 and $status_role[$role2] == 1) {
					$next_info['status_code'] = $status_code;
					$next_info['flow_name'] = $flow_name;
					break;
				}
			}
			else
			{
				if ($status_role[$role] == 1) {
					$next_info['status_code'] = $status_code;
					$next_info['flow_name'] = $flow_name;
					break;
				}
			}
            
        } 
       return $next_info; 
    }
	
	/**
	* 获取报警超时时间单位：秒
	*/
	public function get_time_out(){
		return $this->index_array['time_out'];
	}
	
	/**
	* 获取流程结束状态码
	*/
	public function get_finish_status(){
		return $this->index_array['finish_status'];
	}
	
	/**
	* 获取正在途中运单状态码
	*/
	public function get_onway_status(){
		return $this->index_array['onway_status'];
	}
	
	/**
	* 获取角色所属机构
	*/
	public function role_belong($role){
		return $this->role_set[$role]['belong'];
	}
	
	
	/**
	* 获取货车司机角色码
	*/
	public function driver_role_code(){
		return $this->driver_role_code;
	}
	
	/**
	* 获取总仓小件员角色码
	*/
	public function xjy_role_code(){
		return $this->xjy_role_code;
	}
	
	/**
	* 获取app端角色码
	*/
	public function app_role_code_list(){
		$arr=$this->role_set;
		$list='';
		foreach($arr as $key=>$value){
			$app=$value['login']['app'];
			if($app==1){
				if($list==''){
					$list=$key;
				}else{
					$list.=','.$key;
				}
			}
		}
		return $list;
	}
	
	/**
	* 获取角色列表-所有角色
	*/
	public function role_list(){
		$arr=$this->role_set;
		$return_arr=array();
		foreach($arr as $key=>$value){
			$name=$value['name'];
			$return_arr[$key]=$name;
		}
		return $return_arr;
	}
	
	/*
	* 获取子角色
	*/
	public function sub_role($role){
		$arr=array();
		$sub_role_arr=$this->role_set[$role]['sub_role'];
		foreach($sub_role_arr as $key=>$value){
			if($value==1){
				$arr[$key]=$this->role_name($key);
			}
		}
		return $arr;
	}

	/**
	* 获取角色名称
	*/
	public function role_name($role){
		return $this->role_set[$role]['name'];
	}
	
	/*
	*
	*角色登陆端权限配置
	*/
	public function login_set(){
		return $this->role_login;
	}
	
	/*
	*
	*角色登陆端权限配置
	*/
	public function login_set_v2($role){
		$arr=$this->role_set;
		$return_arr=array();
		
		foreach($arr as $key=>$value){
			if($role==$key){
				$pc=$value['login']['pc'];
				$app=$value['login']['app'];
				$return_arr['pc']=$pc;
				$return_arr['app']=$app;
				break;
			}
			
		}
		
		return $return_arr;
	}
}
?>