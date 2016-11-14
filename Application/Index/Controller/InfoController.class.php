<?php
namespace Index\Controller;
use Think\Controller;
class InfoController extends BaseController {
    //区域信息
	public function area(){
		$area=area_list(0);//0获取大区域，1获取县市区
		$this->assign('area',$area);
		
		$where=array();
		$where['areac.parent_id']=array('gt',0);
		$join='left join wl_area areap on areap.id=areac.parent_id';
		$field='areac.id,areac.name,areap.name namep';
		$arealist=M('area areac')->field($field)->join($join)->where($where)->select();
		$arealist_json=json_encode($arealist);
		$this->assign('arealist',$arealist_json);
		
		$arealistsel=arealist($area);
		$this->assign('arealistsel',$arealistsel);
		
		$this->display();
	}
	
	/**
	*   区域保存
	* 0 添加失败
	* 1 添加成功
	*/
	public function area_add(){
		//参数验证
		$parentid=I('post.namep',0);
		$name=I('post.name','');
		if($name==''){
			return_json(0,'未填写区域名称','');
			exit;
		}
		$where=array();
		$where['parent_id']=$parentid;
		$where['name']=$name;
		$find=M('area')->where($where)->find();
		if($find){
			return_json(1,'该名称已存在','');
			exit;
		}
		
		//添加数据项
		$data=array();
		$data['parent_id']=$parentid;
		$data['name']=$name;
		$data['add_time']=time();
		
		
		$add=M('area')->data($data)->add();
		
		if($add){
			return_json(1,'区域添加成功','');
			exit;
		}else{
			return_json(0,'区域添加失败','');
			exit;
		}
	}
	
	/**
	* 删除地区数据
	*/
	public function area_delete(){
		//参数验证
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		
		//条件
		$where=array();
		$where['id']=$id;
		
		$delete=M('area')->where($where)->delete();
		if($delete){
			return_json(1,'删除成功','');
			exit;
		}else{
			return_json(0,'删除失败','');
			exit;
		}
	}
	
	/**
	* 编辑地区数据
	*/
	public function area_edit(){
		//参数验证
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		$parentid=I('post.namep',0);
		$name=I('post.name','');
		if($name==''){
			return_json(0,'未填写区域名称','');
			exit;
		}
		
		//添加数据项
		$data=array();
		$data['parent_id']=$parentid;
		$data['name']=$name;
		$data['add_time']=time();
		
		$where=array();
		$where['id']=$id;
		$save=M('area')->where($where)->data($data)->save();
		
		if($save){
			return_json(1,'更新成功','');
			exit;
		}else{
			return_json(0,'更新失败','');
			exit;
		}
	}
	
	/**
	* 供应商
	*/
	public function gys(){
		
		$where=array();
		$supplier=M('supplier')->where($where)->select();
		foreach($supplier as $key=>$value){
			$pay_style=$value['pay_style'];
			if($pay_style==1){
				$pay_style='重量';
			}else if($pay_style==2){
				$pay_style='台数';
			}else{
				$pay_style='无';
			}
			
			$supplier[$key]['pay_style']=$pay_style;
		}
		$supplier_json=json_encode($supplier);
		$this->assign('supplier',$supplier_json);
		
		$this->display();
	}
	
	/**
	* 添加供应商
	* 1添加成功
	* 0添加失败
	*/
	public function gys_add(){
		$name=I('post.name','');
		$leader=I('post.leader','');
		$tel=I('post.tel','');
		$address=I('post.address','');
		$pay_style=I('post.pay_style',0);
		
		if($name==''){
			return_json(0,'供应商名称不能为空','');
			exit;
		}
		
		$where=array();
		$where['name']=$name;
		$find=M('supplier')->where($where)->find();
		if($find){
			return_json(0,'供应商名称已存在','');
			exit;
		}
		
		if($address==''){
			return_json(0,'供应商详细地址不能为空','');
			exit;
		}
		if($leader==''){
			return_json(0,'供应商负责人不能为空','');
			exit;
		}
		if($tel==''){
			return_json(0,'供应商联系电话不能为空','');
			exit;
		}
		
		$data=array();
		$data['name']=$name;
		$data['address']=$address;
		$data['tel']=$tel;
		$data['leader']=$leader;
		$data['pay_style']=$pay_style;
		$data['add_time']=time();
		
		
		$add=M('supplier')->data($data)->add();
		
		if($add){
			return_json(1,'供应商添加成功','');
			exit;
		}else{
			return_json(0,'供应商添加失败','');
			exit;
		}
	}
	
	/**
	* 编辑供应商信息
	* 1 成功
	* 0 失败
	*/
	public function gys_edit(){
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		
		$name=I('post.name','');
		$leader=I('post.leader','');
		$tel=I('post.tel','');
		$address=I('post.address','');
		$pay_style=I('post.pay_style',0);
		
		if($name==''){
			return_json(0,'供应商名称不能为空','');
			exit;
		}
		
		if($address==''){
			return_json(0,'供应商详细地址不能为空','');
			exit;
		}
		if($leader==''){
			return_json(0,'供应商负责人不能为空','');
			exit;
		}
		if($tel==''){
			return_json(0,'供应商联系电话不能为空','');
			exit;
		}
		
		$data=array();
		$data['name']=$name;
		$data['address']=$address;
		$data['tel']=$tel;
		$data['leader']=$leader;
		$data['pay_style']=$pay_style;
		$data['add_time']=time();
		
		$where=array();
		$where['id']=$id;
		
		$save=M('supplier')->where($where)->data($data)->save();
		
		if($save){
			return_json(1,'供供应商更新成功','');
			exit;
		}else{
			return_json(0,'供应商更新失败','');
			exit;
		}
	}
	
	/**
	* 删除供应商
	* 1 成功
	* 0 失败
	*/
	public function gys_delete(){
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		
		$where=array();
		$where['id']=$id;
		$delete=M('supplier')->where($where)->delete();
		if($delete){
			return_json(1,'删除成功','');
			exit;
		}else{
			return_json(0,'删除失败','');
			exit;
		}
	}
	
	/**
	* 物流公司数据
	*/
	public function wlgs(){
		
		$where=array();
		$waycompany=M('waycompany')->where($where)->select();
		$waycompany_json=json_encode($waycompany);
		$this->assign('waycompany',$waycompany_json);
		
		$area=area_list(0);//0获取大区域，1获取县市区
		$arealistsel=arealist_v2($area);
		$this->assign('arealistsel',$arealistsel);
		
		$companylistsel=companylist();
		$this->assign('companylistsel',$companylistsel);
		
		$this->display();
	}
	
	/**
	* 添加物流公司
	* 1添加成功
	* 0添加失败
	*/
	public function wlgs_add(){
		$name=I('post.name','');
		$area=I('post.area','');
		$subarea=I('post.subarea','');
		$leader=I('post.leader','');
		$tel=I('post.tel','');
		$address=I('post.address','');
		
		if($name==''){
			return_json(0,'公司名称不能为空','');
			exit;
		}
		
		$where=array();
		$where['name']=$name;
		$find=M('waycompany')->where($where)->find();
		if($find){
			return_json(0,'公司名称已存在','');
			exit;
		}
		
		if($area==''){
			return_json(0,'公司所在区域不能为空','');
			exit;
		}
		if($subarea==''){
			return_json(0,'公司所在县市区不能为空','');
			exit;
		}
		if($address==''){
			return_json(0,'公司详细地址不能为空','');
			exit;
		}
		if($leader==''){
			return_json(0,'公司负责人不能为空','');
			exit;
		}
		if($tel==''){
			return_json(0,'公司联系电话不能为空','');
			exit;
		}
		
		$data=array();
		$data['name']=$name;
		$data['area']=$area;
		$data['subarea']=$subarea;
		$data['address']=$address;
		$data['tel']=$tel;
		$data['leader']=$leader;
		$data['add_time']=time();
		
		$add=M('waycompany')->data($data)->add();
		
		if($add){
			return_json(1,'公司添加成功','');
			exit;
		}else{
			return_json(0,'公司添加失败','');
			exit;
		}
	}
	
	/**
	* 编辑网点
	* 1 成功
	* 0 失败
	*/
	public function wlgs_edit(){
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		
		$name=I('post.name','');
		$area=I('post.area','');
		$subarea=I('post.subarea','');
		$leader=I('post.leader','');
		$tel=I('post.tel','');
		$address=I('post.address','');
		
		if($name==''){
			return_json(0,'公司名称不能为空','');
			exit;
		}
		if($area==''){
			return_json(0,'公司所在区域不能为空','');
			exit;
		}
		if($subarea==''){
			return_json(0,'公司所在县市区不能为空','');
			exit;
		}
		if($address==''){
			return_json(0,'公司详细地址不能为空','');
			exit;
		}
		if($leader==''){
			return_json(0,'公司负责人不能为空','');
			exit;
		}
		if($tel==''){
			return_json(0,'公司联系电话不能为空','');
			exit;
		}
		
		$data=array();
		$data['name']=$name;
		$data['area']=$area;
		$data['subarea']=$subarea;
		$data['address']=$address;
		$data['tel']=$tel;
		$data['leader']=$leader;
		$data['add_time']=time();
		
		$where=array();
		$where['id']=$id;
		
		$save=M('waycompany')->where($where)->data($data)->save();
		
		if($save){
			return_json(1,'公司更新成功','');
			exit;
		}else{
			return_json(0,'公司更新失败','');
			exit;
		}
	}
	
	/**
	* 删除公司
	* 1 成功
	* 0 失败
	*/
	public function wlgs_delete(){
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		
		$where=array();
		$where['id']=$id;
		$delete=M('waycompany')->where($where)->delete();
		if($delete){
			return_json(1,'删除成功','');
			exit;
		}else{
			return_json(0,'删除失败','');
			exit;
		}
	}
	
	/**
	* 网点数据
	*/
	public function wangdian(){
		
		$where=array();
		$join='left join wl_waycompany waycompany on waycompany.id=branchx.waycompany_id';
		$field='branchx.*';
		$field.=',waycompany.name namep';
		$branchxs=M('branch branchx')->field($field)->join($join)->where($where)->select();
		$branchxs_json=json_encode($branchxs);
		$this->assign('branchxs',$branchxs_json);
		
		$area=area_list(0);//0获取大区域，1获取县市区
		$arealistsel=arealist_v2($area);
		$this->assign('arealistsel',$arealistsel);
		
		$companylistsel=companylist();
		$this->assign('companylistsel',$companylistsel);
		
		$this->display();
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
			return_json(1,'获取县市区成功',$subarea);
			exit;
		}else{
			return_json(0,'获取县市区失败','');
			exit;
		}
	}
	
	/**
	* 添加网点
	* 1添加成功
	* 0添加失败
	*/
	public function wangdian_add(){
		$namep=I('post.namep',0);
		$name=I('post.name','');
		$area=I('post.area','');
		$subarea=I('post.subarea','');
		$leader=I('post.leader','');
		$tel=I('post.tel','');
		$address=I('post.address','');
		
		if($namep==0){
			return_json(0,'所属物流公司不能为空','');
			exit;
		}
		if($name==''){
			return_json(0,'网点名称不能为空','');
			exit;
		}
		
		$where=array();
		$where['name']=$name;
		$find=M('branch')->where($where)->find();
		if($find){
			return_json(0,'网点名称已存在','');
			exit;
		}
		
		if($area==''){
			return_json(0,'网点所在区域不能为空','');
			exit;
		}
		if($subarea==''){
			return_json(0,'网点所在县市区不能为空','');
			exit;
		}
		if($address==''){
			return_json(0,'网点详细地址不能为空','');
			exit;
		}
		if($leader==''){
			return_json(0,'网点负责人不能为空','');
			exit;
		}
		if($tel==''){
			return_json(0,'网点联系电话不能为空','');
			exit;
		}
		
		$data=array();
		$data['waycompany_id']=$namep;
		$data['name']=$name;
		$data['area']=$area;
		$data['subarea']=$subarea;
		$data['address']=$address;
		$data['tel']=$tel;
		$data['leader']=$leader;
		$data['add_time']=time();
		
		
		
		$add=M('branch')->data($data)->add();
		
		if($add){
			return_json(1,'网点添加成功','');
			exit;
		}else{
			return_json(0,'网点添加失败','');
			exit;
		}
	}
	
	/**
	* 删除网点
	* 1 成功
	* 0 失败
	*/
	public function wangidan_delete(){
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		
		$where=array();
		$where['id']=$id;
		$delete=M('branch')->where($where)->delete();
		if($delete){
			return_json(1,'删除成功','');
			exit;
		}else{
			return_json(0,'删除失败','');
			exit;
		}
	}
	
	/**
	* 编辑网点
	* 1 成功
	* 0 失败
	*/
	public function wangdian_edit(){
		$id=I('post.id',0);
		if($id==0){
			return_json(0,'参数错误','');
			exit;
		}
		$namep=I('post.namep',0);
		$name=I('post.name','');
		$area=I('post.area','');
		$subarea=I('post.subarea','');
		$leader=I('post.leader','');
		$tel=I('post.tel','');
		$address=I('post.address','');
		
		if($namep==0){
			return_json(0,'所属物流公司不能为空','');
			exit;
		}
		if($name==''){
			return_json(0,'网点名称不能为空','');
			exit;
		}
		if($area==''){
			return_json(0,'网点所在区域不能为空','');
			exit;
		}
		if($subarea==''){
			return_json(0,'网点所在县市区不能为空','');
			exit;
		}
		if($address==''){
			return_json(0,'网点详细地址不能为空','');
			exit;
		}
		if($leader==''){
			return_json(0,'网点负责人不能为空','');
			exit;
		}
		if($tel==''){
			return_json(0,'网点联系电话不能为空','');
			exit;
		}
		
		$data=array();
		$data['waycompany_id']=$namep;
		$data['name']=$name;
		$data['area']=$area;
		$data['subarea']=$subarea;
		$data['address']=$address;
		$data['tel']=$tel;
		$data['leader']=$leader;
		$data['add_time']=time();
		
		$where=array();
		$where['id']=$id;
		
		$save=M('branch')->where($where)->data($data)->save();
		
		if($save){
			return_json(1,'网点更新成功','');
			exit;
		}else{
			return_json(0,'网点更新失败','');
			exit;
		}
	}
}