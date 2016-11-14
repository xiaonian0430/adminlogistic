<?php
namespace Index\Controller;
use Think\Controller;
class BackController extends Controller {
   
   /**
	* 从手机app端回传数据
	* 0		失败
	* 1		成功
	* -1	离线
	* 数据返回结构：
	*	{'code':'服务器返回的状态码（0失败/1成功）','msg':'服务器返回提示信息','data':'服务器返回的数据'}
	*/
	public function call()
	{
		
		$user=I('post.user','','trim');
		$key=I('post.key','','trim');
		$longitude=I('post.longitude',0,'trim');
		$latitude=I('post.latitude',0,'trim');
		
		if($user=='')
		{
			return_json_v2(0,'用户user值为空，数据不能上传','');
			exit;
		}
		if($key=='')
		{
			return_json_v2(0,'用户key值为空，数据不能上传','');
			exit;
		}
		
		if($longitude==0)
		{
			return_json_v2(0,'经度参数为空，数据不能上传','');
			exit;
		}
		if($latitude==0)
		{
			return_json_v2(0,'纬度参数为空，数据不能上传','');
			exit;
		}
		
		$where=array();
		$where['username']=$user;
		$where['key']=$key;
		
		$findx=M('user')->field('id')->where($where)->find();
		if(!$findx)
		{
			return_json_v2(-1,'该用户处于离线状态，数据不能上传','');
			exit;
		}
		
		$where=array();
		$where['id']=$findx['id'];
		
		$data=array();
		$data['longitude']=$longitude;
		$data['latitude']=$latitude;
		$data['online_time']=time();
		
		$save=M('user')->where($where)->data($data)->save();
		if($save)
		{
			return_json_v2(1,'数据上传成功','');
			exit;
		}
		else
		{
			return_json_v2(0,'数据上传失败','');
			exit;
		}
	}
}