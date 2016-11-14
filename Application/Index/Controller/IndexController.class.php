<?php
namespace Index\Controller;
class IndexController extends BaseController 
{
	
	/*
	 *加载框架
	 */
    public function index()
	{
		$this->display();
	}
	
	/**
	 *v1版本
	 */
	public function index_v1()
	{
		
		$this->display();
	}
	
	/**
	* 获取记录数据
	* 0 删除失败
	* 1 删除成功
	*/
	public function fs_delete()
	{
		//参数设定
		$id=I('post.id',0);
		if($id==0)
		{
			return_json(0,'删除失败','');
			exit;
		}
		
		//获取状态码
		$where=array();
		$where['id']=$id;
		$field='status';
		$waybill=M('waybill')->field($field)->where($where)->find();
		$status=$waybill['status'];
		
		//获取前一个状态码
		$where=array();
		$where['waybill_id']=$id;
		$where['next_status']=$status;
		$field2='pre_status';
		$history=M('history')->field($field2)->where($where)->find();
		$pre_status=$history['pre_status'];
		
		//更新当前状态
		$where=array();
		$where['id']=$id;
		
		$data=array();
		$data['status']=$pre_status;
		
		if($pre_status==''){
			return_json(1,'删除成功','');
			exit;
		}
		
		$save=M('waybill')->field($field)->where($where)->data($data)->save();
		
		
		if($save)
		{
			return_json(1,'删除成功','');
			exit;
		}
		else
		{
			return_json(0,'删除失败','');
			exit;
		}
		
	}
	
	/**
	* 获取记录数据
	* 0 获取失败
	* 1 获取成功
	*/
	public function get_history()
	{
		//参数设定
		$id=I('post.id',0);
		if($id==0)
		{
			return_json(0,'获取失败','');
			exit;
		}
		
		$where=array();
		$where['id']=$id;
		
		$field='waybill_no,waybill_name,supplier,tel,name,area,subarea,address';
		$waybill=M('waybill')->field($field)->where($where)->find();
		$waybill['supplier_name']=$waybill['supplier'];
		$waybill['supplier_tel']='无';
		$waybill['supplier_address']='无';
		
		
		$where=array();
		$where['waybill_id']=$id;
		$field2='title,operator,remark,add_time';
		$order='add_time desc';
		$history=M('history')->field($field2)->where($where)->order($order)->select();
		foreach($history as $key=>$value)
		{
			$history[$key]['add_time']=date('Y-m-d H:i:s',$value['add_time']);
		}
		$data=array();
		$data['waybill']=$waybill;
		$data['history']=$history;
		
		return_json(1,'获取成功',$data);
		exit;
	}
	
	/**
	* 获取县市区
	* 0 获取失败
	* 1 获取成功
	*/ 
	public function subarea()
	{
		//参数
		$parent_id=I('post.parent_id',0);
		if($parent_id==0)
		{
			return_json(0,'参数错误','');
			exit;
		}
		
		$where=array();
		$where['parent_id']=$parent_id;
		$subarea=M('area')->where($where)->select();
		
		if($subarea)
		{
			return_json(1,'获取成功',$subarea);
			exit;
		}
		else
		{
			return_json(0,'暂无县市区','');
			exit;
		}
	}
	
	/**
	* 运单 v2版本
	*/
	public function yundan_v2()
	{
		//初始化核心类
		$class=new LogisticsStatusController();
		
		//获取角色所属机构
		$u_branch_id=$this->u_branch_id;
		$u_waycompany_id=$this->u_waycompany_id;
		
		//获取参数
		$no=I('get.no','','trim');
		
		//初始化查询条件
		$where=array();
		if($u_waycompany_id!=0 and $u_branch_id!=0)
		{
			$where['worder.branch']=$u_branch_id;
		}
		
		$order='worder.id desc';
		if($no!='')
		{
			$where['worder.waybill_no']=$no;
		}
		
		//值域
		$field='worder.id,worder.waybill_no,worder.waybill_name,worder.name,worder.tel,worder.area,worder.subarea,worder.address,worder.remark,worder.status,worder.supplier';
		$field.=',worder.price,worder.pay_type';
		$field.=',wuser.name driver';
		$field.=',wbranch.name branch_name';
		
		//联合查询
		$join='left join '.C('DB_PREFIX').'user wuser on wuser.id=worder.driver';
		$join2='left join '.C('DB_PREFIX').'branch wbranch on wbranch.id=worder.branch';
		
		//执行查询
		$waybill=M('waybill worder')->field($field)->join($join)->join($join2)->where($where)->order($order)->select();
		
		foreach($waybill as $key=>$value)
		{
			$status_name=$this->getStatusName($value['status']);
			$waybill[$key]['status_name']=$status_name;
		}
		
		$waybill_json=json_encode($waybill);
		$this->assign('waybill',$waybill_json);
		
		//获取区域信息
		$area=area_list(0);//0获取大区域，1获取县市区
		$arealist=area_list_option($area);
		$this->assign('arealist',$arealist);
		$this->assign('area',$area);//大区域
		
		//获取货车司机
		$role_code=$class->driver_role_code();
		$field='u.id,u.name';
		$drivers=users($role_code,$field);
		$this->assign('drivers',$drivers);
		
		//获取网点小件员
		$role_code=$class->xjy_role_code();
		$field='u.id,u.name';
		$zcxjys=users($role_code,$field,$this->u_branch_id);
		$this->assign('zcxjys',$zcxjys);
		$this->display();
	}
	
	/**
	* 运单
	*/
	public function yundan()
	{
		//初始化核心类
		$class=new LogisticsStatusController();
		
		//获取角色所属机构
		$u_branch_id=$this->u_branch_id;
		$u_waycompany_id=$this->u_waycompany_id;
		
		//获取参数
		$no=I('get.no','','trim');
		
		//初始化查询条件
		$where=array();
		if($u_waycompany_id!=0 and $u_branch_id!=0)
		{
			$where['worder.branch']=$u_branch_id;
		}
		
		$order='worder.id desc';
		if($no!='')
		{
			$where['worder.waybill_no']=$no;
		}
		
		//值域
		$field='worder.id,worder.waybill_no,worder.waybill_name,worder.name,worder.tel,worder.area,worder.subarea,worder.address,worder.remark,worder.status,worder.supplier';
		$field.=',worder.price,worder.pay_type';
		$field.=',wuser.name driver';
		$field.=',wbranch.name branch_name';
		
		//联合查询
		$join='left join '.C('DB_PREFIX').'user wuser on wuser.id=worder.driver';
		$join2='left join '.C('DB_PREFIX').'branch wbranch on wbranch.id=worder.branch';
		
		//执行查询
		$waybill=M('waybill worder')->field($field)->join($join)->join($join2)->where($where)->order($order)->select();
		
		foreach($waybill as $key=>$value)
		{
			$status_name=$this->getStatusName($value['status']);
			$waybill[$key]['status_name']=$status_name;
		}
		
		$waybill_json=json_encode($waybill);
		$this->assign('waybill',$waybill_json);
		
		//获取区域信息
		$area=area_list(0);//0获取大区域，1获取县市区
		$arealist=area_list_option($area);
		$this->assign('arealist',$arealist);
		$this->assign('area',$area);//大区域
		
		//获取货车司机
		$role_code=$class->driver_role_code();
		$field='u.id,u.name';
		$drivers=users($role_code,$field);
		$this->assign('drivers',$drivers);
		
		//获取网点小件员
		$role_code=$class->xjy_role_code();
		$field='u.id,u.name';
		$zcxjys=users($role_code,$field,$this->u_branch_id);
		$this->assign('zcxjys',$zcxjys);
		$this->display();
	}
	
	//接口调用
	public function post($server, $tel)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $server);//传入的参数
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 80);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $tel);
        $data = curl_exec($ch);//返回的数据
        curl_close($ch);
        return $data;
    }
	
	/**
     * url请求
     */
    public function info($stel)
    {
        $tel = array();
        $tel['tel'] = $stel;
        $server =C('CUS_ADDR');
        $a = $this->post($server, $tel);
        return $a;
    }
	
	/*
    *获取用户信息
    */
    public function con_info()
    {
		
		$stel = trim($_POST['val2']) ?: '';
		$where=array();
		$where['tel']= $stel;
		$field='name,area,subarea,address';
		$order='last_time desc';
		$addr_info=M('waybill')->where($where)->order($order)->find();
		if($addr_info)
		{	
			$code =1;
			$arr =$addr_info;
		}
		else
		{
			$jsondata = $this->info($stel);
			$result = json_decode($jsondata, true);
			$code = $result['code'];
			$arr = $result['data'];
		}
        $AreaController = new AreaController();
        $area = $AreaController->area_first3();
        foreach ($area as $key => $value)
		{
            if ($arr['area'] == $value['name']) 
			{
                $area[$key]['select'] = 'selected';
            }
        }

        $subarea = array();
        $areax = $arr['area'];
        if ($areax == '') 
		{
            $areax = '贵阳市';
        }

        $subarea = $AreaController->area_sub($areax);
        foreach ($subarea as $key => $value) 
		{
            if ($arr['subarea'] == $value['name']) 
			{
                $area[$key]['select'] = 'selected';
            }
        }

        $data_addr = [
            "cons" => $arr['name'],
            "addr" => $arr['address'],
            "area" => $arr['area'],
            "subarea" => $arr['subarea'],
        ];

        $data = array();
        if ($code == 0) 
		{
            $data['status'] = 2;
            $data['msg'] = '电话号码不存在';
        } 
		else
		{
            $data['status'] = 1;
            $data['msg'] = '获取成功';
        }

        $data['result'] = array('info' => $data_addr, 'area' => $area, 'subarea' => $subarea);
        $this->ajaxReturn($data);

    }
	
	 /*
   * 获取二级区域
   */
    public function subarea_find()
    {
        $area = trim($_POST['area']) ?: '';
        if ($area == '') {
            $data = array();
            $data['status'] = 0;
            $data['msg'] = '未选择区域';
            $data['result'] = '';
            $this->ajaxReturn($data);
            exit;
        }
        $AreaController = new AreaController();
        $subarea = $AreaController->area_sub($area);

        $data = array();
        $data['status'] = 1;
        $data['msg'] = '未选择区域';
        $data['result'] = $subarea;
        $this->ajaxReturn($data);
    }
	
	/**
	* 流程状态检查
	* 0 验证失败
	* 1 验证成功
	*/
	public function flow_status_check($waybill_no,$status_check)
	{
		//获取角色所属机构
		$u_branch_id=$this->u_branch_id;
		$where=array();
		$where['waybill_no']=$waybill_no;
		//$where['branch']=$this->u_branch_id;
		$where['status']=$status_check;
		$field='id';
		$find=M('waybill')->where($where)->field($field)->find();
		if($find)
		{
			return_json(0,'该运单已经处理，不能重复进行次操作，或请检测运单号是否正确！','');
			exit;
		}
	}
	
	/**
	* 流程状态检查
	* 0 验证失败
	* 1 验证成功
	*/
	public function flow_status_check_normal($waybill_no,$type)
	{
		//获取角色所属机构
		$u_branch_id=$this->u_branch_id;
		$role_code=$this->u_role_code;
		
		$msg0='系统参数错误！';
		$msg1='该运单已经处理，不能重复执行此操作或处于其他流程，或请检测运单号是否正确！';
		$msg2='该运单不存在，或请检测运单号是否正确！';
		$msg3='该运单正处于其他流程，不能执行此操作，或请检测运单号是否正确！';
		$msg4='该运单已经处理，不能重复执行此操作或处于其他流程，或请检测运单号是否正确！';
		
		$status_check_rec='S04';
		$status_check_send='S0401';
		if($type=='send')
		{
			$status_check=$status_check_send;
			$status_check_to=$status_check_rec;
		}
		else if($type=='receive')
		{
			$status_check=$status_check_rec;
			$status_check_to=$status_check_send;
		}
		else
		{
			return_json(0,$msg0,'');
			exit;
		}
		
		
		$where=array();
		$where['waybill_no']=$waybill_no;
		$field='id,status,branch';
		$find_waybill=M('waybill')->where($where)->field($field)->find();
		if(!$find_waybill)
		{
			return_json(0,$msg2,'');
			exit;
		}
		$find_waybill_status=$find_waybill['status'];
		$find_waybill_branch=$find_waybill['branch'];
		
		if($find_waybill_status==$status_check_to)
		{
			if($type=='send')
			{
				if($u_branch_id!=$find_waybill_branch)
				{
					return_json(0,$msg1,'');
					exit;
				}
			}
			else if($type=='receive')
			{
				if($u_branch_id==$find_waybill_branch)
				{
					return_json(0,$msg1,'');
					exit;
				}
			}
			else
			{
				return_json(0,$msg0,'');
				exit;
			}
			
		}
		
		
		$where=array();
		$where['waybill_no']=$waybill_no;
		$where['status']=$status_check;
		$field='id';
		$find=M('waybill')->where($where)->field($field)->find();
		if($find)
		{
			return_json(0,$msg4,'');
			exit;
		}
		
		$class=new LogisticsStatusController();
		$next_info=$class->get_next_status_code($find_waybill_status,$role_code);
		if(!$next_info)
		{
			return_json(0,$msg3,'');
			exit;
		}
		$status_code=$next_info['status_code'];
		if($status_check!=$status_code)
		{
			return_json(0,$msg3,'');
			exit;
		}
	}
	
	
	/**
	* 查找运单号
	* 0 验证失败
	* 1 验证成功
	*/
	public function search_waybill_no()
	{
		$waybill_no=trim(I('post.waybill_no'))?:0;
		if($waybill_no)
		{
			//条件语句
			$where=array();
			$where['waybill.waybill_no']=$waybill_no;
			$join_supplier='left join '.C('DB_PREFIX').'supplier supplier on supplier.id=waybill.supplier_id';
			$field='waybill.id,waybill.status,waybill.branch,waybill.packages,waybill.tel,waybill.name,waybill.area,waybill.subarea,waybill.address,waybill.remark';
			$field.=',supplier.name supplier_name,supplier.tel supplier_tel,supplier.leader supplier_leader,supplier.address supplier_address';
			$find=M('waybill waybill')->join($join_supplier)->field($field)->where($where)->find();
			if(!$find)
			{
				return_json(0,'运单号不存在！','');
				exit;
			}
			else
			{
				$AreaController = new AreaController();
				$area = $AreaController->area_first3();
				foreach ($area as $key => $value)
				{
					if ($find['area'] == $value['name']) 
					{
						$area[$key]['select'] = 'selected';
					}
				}

				$subarea = array();
				$areax = $find['area'];
				if ($areax == '') 
				{
					$areax = '贵阳市';
				}

				$subarea = $AreaController->area_sub($areax);
				foreach ($subarea as $key => $value) 
				{
					if ($find['subarea'] == $value['name']) 
					{
						$area[$key]['select'] = 'selected';
					}
				}

				$find['area_list']=$area;
				$find['subarea_list']=$subarea;
				return_json(1,'运单号查找成功！',$find);
				exit;
			}
		}
		else
		{
			return_json(0,'运单号不能为空','');
			exit;
		}
	}
	
	/**
	* 验证运单号
	* 0 验证失败
	* 2 地址/网点不匹配
	* 1 验证成功
	*/
	public function check_waybill_no_query($waybill_no)
	{
		//条件语句
		$where=array();
		$where['waybill_no']=$waybill_no;
		
		$field='id,status,branch,packages,insurance,quantity,weight,price,pay_type';
		$find=M('waybill')->field($field)->where($where)->find();
		return $find;
	}
	
	/**
	* 验证运单号
	* 0 验证失败
	* 2 地址/网点不匹配
	* 1 验证成功
	*/
	public function check_waybill_no_rec()
	{
		//初始化核心类
		$class=new LogisticsStatusController();
		
		$waybill_no=trim(I('post.waybill_no'))?:'';
		if($waybill_no=='')
		{
			return_json(0,'运单号不能为空','');
			exit;
		}
		
		$find=$this->check_waybill_no_query($waybill_no);
		if(!$find)
		{
			return_json(0,'运单号不存在！','');
			exit;
		}
		
		//验证运单状态
		$status=$find['status'];
		$this->flow_status_check_normal($waybill_no,'receive');
		$next_info=$class->get_next_status_code($status,$this->u_role_code);
		if(!$next_info)
		{
			return_json(0,'不能添加。可能原因：正处于其他流程，或者没有权限！','');
			exit;
		}
		
		//验证运单所属网点
		$branch=$find['branch'];
		$u_branch_id=$this->u_branch_id;
		if(($branch!=0) and ($u_branch_id!=$branch))
		{
			return_json(2,'运单所属网点与您当前网点不匹配！',$find);
			exit;
		}
		
		//返回json数据
		return_json(1,'验证成功',$find);
		exit;
	}
	
	/**
	* 验证运单号
	* 0 验证失败
	** 2 地址/网点不匹配
	* 1 验证成功
	*/
	public function check_waybill_no_send()
	{
		//初始化核心类
		$class=new LogisticsStatusController();
		
		$tag=trim(I('post.tag'))?:0;
		if($tag)
		{
			$id_area=trim(I('post.area'))?:0;
			if($id_area==0)
			{
				return_json(0,'发往区域不能为空！','');
				exit;
			}
			$id_subarea=trim(I('post.subarea'))?:0;
			if($id_subarea==0)
			{
				return_json(0,'发往县市区不能为空！','');
				exit;
			}
		}
		$waybill_no=trim(I('post.waybill_no'))?:'';
		if($waybill_no=='')
		{
			return_json(0,'运单号不能为空','');
			exit;
		}
		
		$find=$this->check_waybill_no_query($waybill_no);
		if(!$find)
		{
			return_json(0,'运单号不存在','');
			exit;
		}
		$status=$find['status'];
		$this->flow_status_check_normal($waybill_no,'send');
		$next_info=$class->get_next_status_code($status,$this->u_role_code);
		if(!$next_info)
		{
			return_json(0,'不能添加。可能原因：正处于其他流程','');
			exit;
		}
		
		if($tag)
		{
			$name_area=$find['area'];
			$name_subarea=$find['subarea'];
			
			$where=array();
			$where['id']=$id_area;
			$find_area=M('area')->field('name')->where($where)->find();
			$name_area_find=$find_area['name'];
			$index=strpos($name_area,$name_area_find);
			if($index===false)
			{
				return_json(2,'发往区域不匹配！',$find);
				exit;
			}
			$where=array();
			$where['id']=$id_subarea;
			$find_area=M('area')->field('name')->where($where)->find();
			$name_subarea_find=$find_area['name'];
			$index=strpos($name_subarea,$name_subarea_find);
			if($index===false)
			{
				return_json(2,'发往县市区不匹配！',$find);
				exit;
			}
		}
		return_json(1,'验证成功',$find);
		exit;
	}
	
	/**
	* 收货执行
	* 0 收货失败
	* 1 收货成功
	* 2 已收货
	*/
	public function receive_do()
	{
		$u_branch_id=$this->u_branch_id;
		if(!$u_branch_id)
		{
			return_json(0,'您不能收货！切换至网点账号','');
			exit;
		}
		//表单数据获取
		$waybill_no=I('post.waybill_no','','trim');
		if($waybill_no=='')
		{
			return_json(0,'未填入物流单号','');
			exit;
		}
		if(!preg_match("/^[0-9a-zA-Z,]+$/",$waybill_no))
		{
			return_json(0,$waybill_no.'物流单格式错误，收货失败','');
			exit;
		}
		$waybill_no_arr= explode(',',$waybill_no);
		
		//遍历验证运单号
		$this->check_waybill_no_batch($waybill_no_arr,'receive');
		$this->save_waybill_no_batch($waybill_no_arr,'receive');
		return_json(1,'收货成功','');
		exit;
	}
	
	/**
	* 收货执行
	* 0 收货失败
	* 1 收货成功
	* 2 已收货
	*/
	public function receive_do_v2()
	{
		$u_branch_id=$this->u_branch_id;
		if(!$u_branch_id)
		{
			return_json(0,'您不能收货！切换至网点账号','');
			exit;
		}
		//表单数据获取
		$waybill_no=I('post.waybill_no','','trim');
		$tel=I('post.tel','','trim');
		$name=I('post.name','','trim');
		$area=I('post.area','','trim');
		$subarea=I('post.subarea','','trim');
		$address=I('post.address','','trim');
		$remark=I('post.remark','','trim');
		if($waybill_no=='')
		{
			return_json(0,'参数错误','');
			exit;
		}
		if(!preg_match("/^[0-9a-zA-Z]+$/",$waybill_no))
		{
			return_json(0,$waybill_no.'物流单格式错误，收货失败','');
			exit;
		}
		
		//条件语句
		$where=array();
		$where['waybill_no']=$waybill_no;
		
		$field='id,status,branch,packages';
		$find=M('waybill')->field($field)->where($where)->find();
		if(!$find)
		{
			return_json(0,'运单号不存在！','');
			exit;
		}
		
		if($tel=='')
		{
			return_json(0,'电话不能为空','');
			exit;
		}
		
		if($name=='')
		{
			return_json(0,'姓名不能为空','');
			exit;
		}
		if($area=='')
		{
			return_json(0,'区域不能为空','');
			exit;
		}
		if($subarea=='')
		{
			return_json(0,'县市区不能为空','');
			exit;
		}
		if($address=='')
		{
			return_json(0,'地址不能为空','');
			exit;
		}
		$status=$find['status'];
		$this->flow_status_check_rec($waybill_no);
		$msg='收货';
		$branch_info=$this->get_model_info('branch',$this->u_branch_id);
		if($branch_info)
		{
			$remark_his=$msg.'网点【'.$branch_info['name'].'（'.$branch_info['area'].'-'.$branch_info['subarea'].'-'.$branch_info['address'].'）】';
		}
		else
		{
			$remark_his=$msg.'网点【未知】';
		}
		$class=new LogisticsStatusController();
		$next_info=$class->get_next_status_code($status,$this->u_role_code);
		if(!$next_info)
		{
			return_json(0,'物流单【'.$waybill_no_one.'】不能'.$msg.'【可能已经'.$msg.'，或该运单正处于其他流程】','');
			exit;
		}
		$next_status=$next_info['status_code'];
		$title=$next_info['flow_name'];
		$add_time=time();
		$data=array();
		$data['tel']=$tel;
		$data['name']=$name;
		$data['area']=$area;
		$data['subarea']=$subarea;
		$data['address']=$address;
		$data['branch']=$this->u_branch_id;
		$data['last_user_id']=$this->u_id;
		$data['status']=$next_status;
		$data['last_time']=$add_time;
		
		$save=M('waybill')->data($data)->where($where)->save();
		
		//参数赋值
		$waybill_id=$find['id'];
		$remark=$remark?($remark.'；'.$remark_his):$remark_his;
		//记录数据
		$data=array();
		$data['waybill_id']=$waybill_id;
		$data['user_id']=$this->u_id;
		$data['branch_id']=$this->u_branch_id;
		$data['title']=$title;
		$data['operator']=$this->u_name;
		$data['pre_status']=$status;
		$data['next_status']=$next_status;
		$data['add_time']=$add_time;
		$data['remark']=$remark;
		$where=array();
		$where['waybill_id']=$waybill_id;
		$where['branch_id']=$this->u_branch_id;
		$where['pre_status']=$status;
		$where['next_status']=$next_status;
		$findx=M('history')->where($where)->find();
		if($findx)
		{
			$his_time=$findx['add_time'];
			$dis_timex=$add_time-$his_time;
			if($dis_timex>1800) //大于半小时
			{
				M('history')->data($data)->add();
			}
			else
			{
				M('history')->where($where)->data($data)->save();
			}
			
		}
		else
		{
			M('history')->data($data)->add();
		}
		if($save)
		{
			return_json(1,'收货成功','');
			exit;
		}
		else
		{
			return_json(0,'收货失败','');
			exit;
		}
		
	}
	
	/**
	* 收货执行 录入收货人信息
	* 0 收货失败
	* 1 收货成功
	* 2 已收货
	*/
	public function receive_do_v3()
	{
		$u_branch_id=$this->u_branch_id;
		if(!$u_branch_id)
		{
			return_json(0,'您不能收货！切换至网点账号','');
			exit;
		}
		//表单数据获取
		$waybill_no=I('post.waybill_no','','trim');
		$tel=I('post.tel','','trim');
		$name=I('post.name','','trim');
		$area=I('post.area','','trim');
		$subarea=I('post.subarea','','trim');
		$address=I('post.address','','trim');
		$remark=I('post.remark','','trim');
		if($waybill_no=='')
		{
			return_json(0,'参数错误','');
			exit;
		}
		if(!preg_match("/^[0-9a-zA-Z]+$/",$waybill_no))
		{
			return_json(0,$waybill_no.'物流单格式错误，收货失败','');
			exit;
		}
		
		//条件语句
		$where=array();
		$where['waybill_no']=$waybill_no;
		
		$field='id,status,branch,packages';
		$find=M('waybill')->field($field)->where($where)->find();
		if(!$find)
		{
			return_json(0,'运单号不存在！','');
			exit;
		}
		
		if($tel=='')
		{
			return_json(0,'电话不能为空','');
			exit;
		}
		
		if($name=='')
		{
			return_json(0,'姓名不能为空','');
			exit;
		}
		if($area=='')
		{
			return_json(0,'区域不能为空','');
			exit;
		}
		if($subarea=='')
		{
			return_json(0,'县市区不能为空','');
			exit;
		}
		if($address=='')
		{
			return_json(0,'地址不能为空','');
			exit;
		}
		
		$add_time=time();
		$data=array();
		$data['tel']=$tel;
		$data['name']=$name;
		$data['area']=$area;
		$data['subarea']=$subarea;
		$data['address']=$address;
		$data['branch']=$this->u_branch_id;
		$data['last_user_id']=$this->u_id;
		$data['last_time']=$add_time;
		
		$save=M('waybill')->data($data)->where($where)->save();
		if($save)
		{
			return_json(1,'信息录入成功！','');
			exit;
		}
		else
		{
			return_json(0,'信息录入失败！','');
			exit;
		}
	}
	
	/**
	* 发货执行
	* 0 发货失败
	* 1 发货成功
	* 2 已发货
	*/
	public function send_do()
	{
		$u_branch_id=$this->u_branch_id;
		if(!$u_branch_id)
		{
			return_json(0,'您不能发货！切换至网点账号','');
			exit;
		}
		//表单数据获取
		$tag=I('post.tag',0);
		$releave_num_sends=0;
		if($tag)
		{
			$last_user_id=I('post.driver',0);
			$driver_name=I('post.driver_name','');
			if($last_user_id==0)
			{
				return_json(0,'未选择货车司机','');
				exit;
			}
			$area=I('post.area',0);
			if($area==0)
			{
				return_json(0,'未选择发往区域','');
				exit;
			}
			
			$subarea=I('post.subarea',0);
			if($subarea==0)
			{
				return_json(0,'未选择发往区域','');
				exit;
			}
			$branch=I('post.wangdian',0);
			$branch_name=I('post.wangdian_name','');
			if($branch==0)
			{
				return_json(0,'未选择网点','');
				exit;
			}
			$num_sends=I('post.num',0);
			//查询总的订单
			$where=array();
			$where['id']=$branch;
			$field='area,subarea';
			$area_info=M('branch')->where($where)->field($field)->find();
			$where=array();
			$where['area']=array('like',$area_info['area'].'%');
			$where['subarea']=array('like',$area_info['subarea'].'%');
			$where['branch']=$this->u_branch_id;
			$where['status']='S04';
			$all_num_sends=M('waybill')->where($where)->count();
			$releave_num_sends=$all_num_sends-$num_sends;
		}
		else
		{
			$last_user_id=I('post.zcxjy',0);
			$zcxjy_name=I('post.zcxjy_name','');
			if($last_user_id==0)
			{
				return_json(0,'未选择小件员','');
				exit;
			}
		}
		
		$waybill_no=I('post.waybill_no','','trim');
		if($waybill_no=='')
		{
			return_json(0,'未填入物流单号','');
			exit;
		}
		if(!preg_match("/^[0-9a-zA-Z,]+$/",$waybill_no))
		{
			return_json(0,'物流单格式错误，发货失败','');
			exit;
		}
		$waybill_no_arr= explode(',',$waybill_no);
		$num=count($waybill_no_arr);
		
		//参数赋值
		$user_id=$this->u_id;
		$user_name=$this->u_name;
		$add_time=time();
		$class=new LogisticsStatusController();
		
		if($releave_num_sends>0)
		{
			return_json(10,'检测到有遗漏订单！遗漏：'.$releave_num_sends.'单',$releave_num_sends);
			exit;
		}
		
		//遍历验证运单号
		$this->check_waybill_no_batch($waybill_no_arr,'send');
		$this->save_waybill_no_batch($waybill_no_arr,'send',$tag,$last_user_id,$branch);
		
		return_json(1,'发货成功','');
		exit;
		
	}
	
	/**
	* 物流运单批量验证
	* 0 失败
	* 1 成功
	*/
	function check_waybill_no_batch($waybill_no_arr,$type='receive')
	{
		$class=new LogisticsStatusController();
		$num=count($waybill_no_arr);
		//遍历验证运单号
		for($i=0;$i<$num;$i++)
		{
			$waybill_no_one=$waybill_no_arr[$i];
			$where=array();
			$where['waybill_no']=$waybill_no_one;
			$field='status,id';
			$find=M('waybill')->field($field)->where($where)->find();
			if($find)
			{
				$this->flow_status_check_normal($waybill_no_one,$type);
				$status=$find['status'];
				if($type=='receive')
				{
					$msg='收货';
				}
				else if($type=='send')
				{
					$msg='发货';
				}
				else
				{
					$msg='处理';
				}
				$next_info=$class->get_next_status_code($status,$this->u_role_code);
				if(!$next_info)
				{
					return_json(0,'物流单【'.$waybill_no_one.'】不能'.$msg.'【可能已'.$msg.'，或正处于其他流程】','');
					exit;
				}
			}
			else
			{
				return_json(0,'运单不存在','');
				exit;
			}
		}
	}
	
	/**
	* 物流运单批量保存
	* 0 失败
	* 1 成功
	*/
	function save_waybill_no_batch($waybill_no_arr,$type='receive',$tag=0,$last_user_id=0,$branch=0)
	{
		$data=array();
		$dis_line='=====';
		$add_time=time();
		$class=new LogisticsStatusController();
		$num=count($waybill_no_arr);
		for($i=0;$i<$num;$i++)
		{
			$waybill_no_one=$waybill_no_arr[$i];
			$where=array();
			$where['waybill_no']=$waybill_no_one;
			$field='status,id,branch';
			$find=M('waybill')->field($field)->where($where)->find();
			if($find)
			{
				$this->flow_status_check_normal($waybill_no_one,$type);
				$status=$find['status'];
				if($type=='receive')
				{
					$msg='收货';
					$branch_info=$this->get_model_info('branch',$this->u_branch_id);
					if($branch_info)
					{
						$remark=$msg.'网点【'.$branch_info['name'].'（'.$branch_info['area'].'-'.$branch_info['subarea'].'-'.$branch_info['address'].'）】';
					}
					else
					{
						$remark=$msg.'网点【未知】';
					}
					$data['last_user_id']=$this->u_id;
				}
				else if($type=='send')
				{
					$msg='发货';
					$branch_info=$this->get_model_info('branch',$this->u_branch_id);
					if($branch_info)
					{
						$remark=$msg.'网点【'.$branch_info['name'].'（'.$branch_info['area'].'-'.$branch_info['subarea'].'-'.$branch_info['address'].'）】';
					}
					else
					{
						$remark=$msg.'网点【未知】';
					}
					$user_info=$this->get_model_info('user',$last_user_id);
					if($user_info)
					{
						$user_info_show=$user_info['name'].'（'.$user_info['tel'].'-'.$user_info['address'].'）';
					}
					else
					{
						$user_info_show='未知';
					}
					
					if($tag)
					{
						$branch_info=$this->get_model_info('branch',$branch);
						if($branch_info)
						{
							$remark.=$dis_line.'发送至网点【'.$branch_info['name'].'（'.$branch_info['area'].'-'.$branch_info['subarea'].'-'.$branch_info['address'].'）】';
						}
						else
						{
							$remark.=$dis_line.'发送至网点【未知】';
						}
						$remark.=$dis_line.'运送货车司机【'.$user_info_show.'】';
						$data['last_user_id']=$last_user_id;
						$data['driver']=$last_user_id;
					}
					else
					{
						$remark.=$dis_line.'派送小件员【'.$user_info_show.'】';
						$data['last_user_id']=$last_user_id;
						$data['driver']=0;
					}
				}
				else
				{
					$msg='处理';
				}
				$next_info=$class->get_next_status_code($status,$this->u_role_code);
				if(!$next_info)
				{
					return_json(0,'物流单【'.$waybill_no_one.'】不能'.$msg.'【可能已经'.$msg.'，或该运单正处于其他流程】','');
					exit;
				}
				$next_status=$next_info['status_code'];
				$title=$next_info['flow_name'];
				$data['status']=$next_status;
				$data['last_time']=$add_time;
				
				//验证运单所属网点
				$data['branch']=$this->u_branch_id;
				M('waybill')->where($where)->data($data)->save();
				
				//参数赋值
				$waybill_id=$find['id'];
				
				//记录数据
				$data=array();
				$data['waybill_id']=$waybill_id;
				$data['user_id']=$this->u_id;
				$data['branch_id']=$this->u_branch_id;
				$data['title']=$title;
				$data['operator']=$this->u_name;
				$data['pre_status']=$status;
				$data['next_status']=$next_status;
				$data['add_time']=$add_time;
				$data['remark']=$remark;
				$where=array();
				$where['waybill_id']=$waybill_id;
				$where['branch_id']=$this->u_branch_id;
				$where['pre_status']=$status;
				$where['next_status']=$next_status;
				$findx=M('history')->where($where)->find();
				if($findx)
				{
					$his_time=$findx['add_time'];
					$dis_timex=$add_time-$his_time;
					if($dis_timex>1800) //大于半小时
					{
						M('history')->data($data)->add();
					}
					else
					{
						M('history')->where($where)->data($data)->save();
					}
					
				}
				else
				{
					M('history')->data($data)->add();
				}
			}
			else
			{
				return_json(0,'运单不存在','');
				exit;
			}
		}
	}
	
	/**
	* 获取数据信息
	* 0 失败
	* 1 成功
	*/
	function get_model_info($model,$id)
	{
		if(!$model)
		{
			return '';
		}
		if(!$id)
		{
			return '';
		}
		else
		{
			$where=array();
			$where['id']=$id;
			$info=M($model)->where($where)->find();
			return $info;
		}
		
	}
	
	/**
	* 获取当前运单位置
	* 0 失败
	* 1 成功
	*/
	public function get_pos()
	{
		$id=I('post.id',0);
		if($id==0)
		{
			return_json(0,'参数错误','');
			exit;
		}
		
		$disx=C('WL_DIS_TIME');
		
		$where=array();
		$where['wb.id']=$id;
		$field='u.longitude,u.latitude,u.online_time,mi.icon';
		$join='join '.C('DB_PREFIX').'user u on u.id=wb.last_user_id';
		$join_ru='join '.C('DB_PREFIX').'role_user ru on u.id=ru.user_id';
		$join_mapicon='join '.C('DB_PREFIX').'map_icon mi on mi.role_id=ru.role_id';
		$waybill=M('waybill wb')->join($join)->join($join_ru)->join($join_mapicon)->where($where)->field($field)->find();
		$cur=time();
		$online_time=$waybill['online_time'];
		$dis_time=$cur-$online_time;
		
		if($waybill)
		{
			if($dis_time>$disx)
			{
				return_json(0,'app员工目前处于离线状态，无法获取到最新位置信息','');
				exit;
			}
			else
			{
				return_json(1,'获取成功',$waybill);
				exit;
			}
		}
		else
		{
			return_json(0,'获取失败','');
			exit;
		}
	}
	
	/**
	* 获取区域内 县市区  所有网点
	* 0 失败
	* 1 成功
	*/
	public function get_wangdian()
	{
		$area=I('post.area','');
		if($area=='')
		{
			return_json(0,'参数错误','');
			exit;
		}
		$subarea=I('post.subarea','');
		if($subarea=='')
		{
			return_json(0,'参数错误','');
			exit;
		}
		
		$where=array();
		$where['area']=$area;
		$where['subarea']=$subarea;
		$where['id']=array('neq',$this->u_branch_id);
		$branch=M('branch')->where($where)->select();
		if($branch)
		{
			return_json(1,'获取网点成功',$branch);
			exit;
		}
		else
		{
			return_json(0,'获取网点失败','');
			exit;
		}
	}
	
	/**
	* 获取状态名称
	 */
	public function getStatusName($status='') 
	{
		if(!$status)
		{
			return '无'; // 避免非法参数
		}
		
		$LogisticsStatus=new LogisticsStatusController();
		$status_name=$LogisticsStatus->get_name($status);
		return $status_name;
	}
	
	/**
	* 获取下一个状态
	 */
	public function getFlowTitle($status='',$role='R00') 
	{
		if(!$status)
		{
			return ''; // 避免非法参数
		}
		$LogisticsStatus=new LogisticsStatusController();
		$nextstep=$LogisticsStatus->get_nextstep($status);
		foreach($nextstep as $key =>$value)
		{
			if($value['role'][$role]==1)
			{
				return $value['flow_name'];
				break;
			}
		}
		return ''; // 避免非法参数
	}
	
	
	
	/**
	* 获取下一个状态
	 */
	public function getStatusNext($status='',$role='R00') {
		if(!$status){
			return ''; // 避免非法参数
		}
		$LogisticsStatus=new LogisticsStatusController();
		$nextstep=$LogisticsStatus->get_nextstep($status);
		foreach($nextstep as $key =>$value){
			if($value['role'][$role]==1){
				return $value['status_code'];
				break;
			}
		}
		return ''; // 避免非法参数
	}
	
	/**
	 * 导出数据
	 * 参数：开始时间 $start
	 * 参数：结束时间 $end
	 * 格式：csv
	 */
	public function loadout()
	{
		//初始化核心类
		$class=new LogisticsStatusController();
		
		$start=trim(I('post.start'))?:'';
		$end=trim(I('post.end'))?:'';
		
		$start_time=$start?strtotime($start):0;
		$end_time=$end?strtotime($end):0;
		
		//查询条件
		$where=array();
		
		//查询值域
		$field='wayorder.*';
		$field.=',user1.name add_name';
		$field.=',user2.name driver_name';
		$field.=',branch.name branch_name,branch.area branch_area,branch.subarea branch_subarea,branch.address branch_address';
		
		//联合查询
		$join_user1='left join '.C('DB_PREFIX').'user user1 on user1.id=wayorder.user_id';
		$join_user2='left join '.C('DB_PREFIX').'user user2 on user2.id=wayorder.driver';
		$join_branch='left join '.C('DB_PREFIX').'branch branch on branch.id=wayorder.branch';
		
		//执行查询
		$waybill=M("waybill wayorder")->join($join_user1)->join($join_user2)->join($join_branch)->field($field)->where($where)->select();
		
		//输出数据csv
		$time=date('Ymd');
		$fileName='运单导出表_'.$time.'.csv';
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename=' . $fileName);
		//$header='订单序号,运单编号,录入人员,发往网点,网点所在区域,网点所在县市区,网点详细地址,货车司机,供应商,收货人姓名,收货人电话,收货人区域,收货人县市区,收货人详细地址,运单录入时间,运单最后更新时间,运单当前状态,付款类型,价格,重量,台数,报价金额,包裹数量,备注';
		$header='订单序号,运单编号,录入人员,发往网点,货车司机,供应商,收货人姓名,收货人电话,收货人区域,收货人县市区,收货人详细地址,运单录入时间,运单最后更新时间,运单当前状态,付款类型,价格,重量,台数,报价金额,包裹数量,备注';
		$header.='\n';
		echo iconv("UTF-8","gb2312",$header);
		
		foreach($waybill as $key =>$value)
		{			
			//写入数据
			$txt='';
			
			$txt.=$waybill[$key]['id']."\t".',';
			$txt.=$waybill[$key]['waybill_no']."\t".',';
			$txt.=$waybill[$key]['add_name']."\t".',';
			$txt.=$waybill[$key]['branch_name']?:'无'."\t".',';
			/*
			$txt.=$waybill[$key]['branch_area']."\t".',';
			$txt.=$waybill[$key]['branch_subarea']."\t".',';
			$txt.=$waybill[$key]['branch_address']."\t".',';
			*/
			$txt.=$waybill[$key]['driver_name']?:'无'."\t".',';
			$txt.=$waybill[$key]['supplier']."\t".',';
			$txt.=$waybill[$key]['name']."\t".',';
			$txt.=$waybill[$key]['tel']."\t".',';
			$txt.=$waybill[$key]['area']."\t".',';
			$txt.=$waybill[$key]['subarea']."\t".',';
			$txt.=$waybill[$key]['address']."\t".',';
			
			$add_time=trim($waybill[$key]['add_time'])?:0;
			$add_time=$this->formart_time($add_time);
			$txt.=$add_time."\t".',';
			
			$last_time=trim($waybill[$key]['last_time'])?:0;
			$last_time=$this->formart_time($last_time);
			$txt.=$last_time."\t".',';
			
			$status=$waybill[$key]['status'];
			$status_name=$class->get_name($status);
			$txt.=$status_name."\t".',';
			
			
			$txt.=$waybill[$key]['pay_type']."\t".',';
			$txt.=$waybill[$key]['price']."\t".',';
			$txt.=$waybill[$key]['weight']."\t".',';
			$txt.=$waybill[$key]['quantity']."\t".',';
			$txt.=$waybill[$key]['insurance']."\t".',';
			$txt.=$waybill[$key]['packages']."\t".',';
			$txt.=$waybill[$key]['remark']."\t".',';
			$txt.="\n";
			
			echo iconv("UTF-8","gb2312",$txt);
			
		}
	}
	
	/**
	 * 格式化时间
	 * 参数：时间戳
	 * 返回：时间格式
	 */
	public function formart_time($time=0)
	{
		$temp_time=trim($time)?:0;
		if($temp_time)
		{
			$temp_time=date('Y/m/d H:i:s',$temp_time);
		}
		else
		{
			$temp_time='';
		}
		
		return $temp_time;
	}
	
	//首页显示
	public function index_v3()
	{
		
		//初始化核心类
		$class=new LogisticsStatusController();
		$time_out=$class->get_time_out();
		$time=time()-$time_out;
		
		$finish_status=$class->get_finish_status();
		$onway_status=$class->get_onway_status();
		
		$waycompany_id=$this->u_waycompany_id;
		$branch_id=$this->u_branch_id;
		
		$where=array();
		$where['status']=array('in',$onway_status);
		$onway_count=M('waybill')->where($where)->count();
		
		$where=array();
		$field='id,status,area,add_time,last_time';
		$waybill=M('waybill')->field($field)->where($where)->select();
		
		$area_waybill=array();
		
		$time_out_count=0;
		$nowday_count=0;
		$finish_count=0;
		
		$all_count=0;
		$week_count=0;
		$week_count_pre=0;
		$month_count=0;
		$month_count_pre=0;
		$cur=strtotime(date('Y-m-d',time()))+86400;
		
		$week_time0=$week_time1-604800;
		$week_time1=$cur-604800;
		$week_time2=$cur;
		
		$month_time0=$cur-2592000;
		$month_time1=$month_time1-2592000;
		$month_time2=$cur;
		
		foreach($waybill as $key=>$value)
		{
			$area_waybill[$value['area']]++;
			
			if($value['add_time']<$time and $finish_status!=$value['status'])
			{
				$time_out_count++;
			}
			
			if($value['add_time']<$time2 and $value['add_time']>$time1){
				$nowday_count++;
			}
			
			if($value['last_time']<$time2 and $value['last_time']>$time1 and $finish_status==$value['status'])
			{
				$finish_count++;
			}
			
			$all_count++;
			if($value['add_time']<$week_time2 and $value['add_time']>$week_time1)
			{
				$week_count++;
			}
			if($value['add_time']<$week_time1 and $value['add_time']>$week_time0)
			{
				$week_count_pre++;
			}
			if($value['add_time']<$month_time2 and $value['add_time']>$month_time1)
			{
				$month_count++;
			}
			if($value['add_time']<$month_time1 and $value['add_time']>$month_time0)
			{
				$month_count_pre++;
			}
		}
		
		$week_percent=($week_count-$week_count_pre);
		$month_percent=($month_count-$month_count_pre);
		
		arsort($area_waybill);
		$area_waybill_x=array();
		$num=0;
		foreach($area_waybill as $key=>$value)
		{
			$area_waybill_x[$num]['name']=$key;
			$area_waybill_x[$num]['value']=$value;
			$num++;
		}
		$area_waybill_x_json=json_encode($area_waybill_x);
		
		//赋值
		$this->assign('time_out_count',$time_out_count);
		$this->assign('onway_count',$onway_count);
		$this->assign('nowday_count',$nowday_count);
		$this->assign('nowday_count',$nowday_count);
		$this->assign('finish_count',$finish_count);
		$this->assign('all_count',$all_count);
		$this->assign('week_count',$week_count);
		$this->assign('week_percent',$week_percent);
		$this->assign('month_count',$month_count);
		$this->assign('month_percent',$month_percent);
		$this->assign('area_waybill_x',$area_waybill_x);
		$this->assign('area_waybill_x_json',$area_waybill_x_json);
		
		//模板显示
		$this->display();
	}
}