<?php
/*
* 区域
* 
*/
namespace Index\Controller;
class AreaController extends BaseController{
	public $data;
	
	/**
	 * 初始化接口类
	 */
	public function __construct(){
		$this->data=array(
			'99'=>array(
				'name'=>'总部',
				'sub'=>array(
					
				)
			),
			'0'=>array(
				'name'=>'贵阳市',
				'sub'=>array(
					array('name'=>'南明区'),
					array('name'=>'云岩区'),
					array('name'=>'花溪区'),
					array('name'=>'乌当区'),
					array('name'=>'白云区'),
					array('name'=>'观山湖区'),
					array('name'=>'开阳县'),
					array('name'=>'息烽县'),
					array('name'=>'修文县'),
					array('name'=>'清镇市')
				)
			),
			'1'=>array(
				'name'=>'六盘水市',
				'sub'=>array(
					array('name'=>'钟山区'),
					array('name'=>'六枝特区'),
					array('name'=>'水城县'),
					array('name'=>'盘县')
				)
			),
			'2'=>array(
				'name'=>'遵义市',
				'sub'=>array(
					array('name'=>'红花岗区'),
					array('name'=>'汇川区'),
					array('name'=>'播州区'),
					array('name'=>'桐梓县'),
					array('name'=>'绥阳县'),
					array('name'=>'正安县'),
					array('name'=>'道真县'),
					array('name'=>'务川县'),
					array('name'=>'凤冈县'),
					array('name'=>'湄潭县'),
					array('name'=>'余庆县'),
					array('name'=>'习水县'),
					array('name'=>'赤水县'),
					array('name'=>'仁怀县'),
				)
			),
			'3'=>array(
				'name'=>'安顺市',
				'sub'=>array(
					array('name'=>'镇宁县'),
					array('name'=>'西秀区'),
					array('name'=>'平坝区'),
					array('name'=>'普定县'),
					array('name'=>'关岭县'),
					array('name'=>'紫云县'),
				)
			),
			'4'=>array(
				'name'=>'毕节市',
				'sub'=>array(
					array('name'=>'七星关区'),
					array('name'=>'大方县'),
					array('name'=>'黔西县'),
					array('name'=>'金沙县'),
					array('name'=>'织金县'),
					array('name'=>'纳雍县'),
					array('name'=>'威宁县'),
					array('name'=>'赫章县'),
				)
			),
			'5'=>array(
				'name'=>'铜仁市',
				'sub'=>array(
					array('name'=>'碧江区'),
					array('name'=>'万山区'),
					array('name'=>'江口县'),
					array('name'=>'玉屏县'),
					array('name'=>'石阡县'),
					array('name'=>'思南县'),
					array('name'=>'印江县'),
					array('name'=>'德江县'),
					array('name'=>'沿河县'),
					array('name'=>'松桃县'),
				)
			),
			'6'=>array(
				'name'=>'黔西南州',
				'sub'=>array(
					array('name'=>'兴义市'),
					array('name'=>'兴仁县'),
					array('name'=>'普安县'),
					array('name'=>'晴隆县'),
					array('name'=>'贞丰县'),
					array('name'=>'望谟县'),
					array('name'=>'册亨县'),
					array('name'=>'安龙县'),
				)
			),
			'7'=>array(
				'name'=>'黔东南州',
				'sub'=>array(
					array('name'=>'镇远县'),
					array('name'=>'凯里市'),
					array('name'=>'黄平县'),
					array('name'=>'施秉县'),
					array('name'=>'三穗县'),
					array('name'=>'岑巩县'),
					array('name'=>'天柱县'),
					array('name'=>'锦屏县'),
					array('name'=>'剑河县'),
					array('name'=>'台江县'),
					array('name'=>'黎平县'),
					array('name'=>'榕江县'),
					array('name'=>'从江县'),
					array('name'=>'雷山县'),
					array('name'=>'麻江县'),
					array('name'=>'丹寨县'),
				)
			),
			'8'=>array(
				'name'=>'黔南州',
				'sub'=>array(
					array('name'=>'都匀市'),
					array('name'=>'福泉市'),
					array('name'=>'荔波县'),
					array('name'=>'贵定县'),
					array('name'=>'瓮安县'),
					array('name'=>'独山县'),
					array('name'=>'平塘县'),
					array('name'=>'罗甸县'),
					array('name'=>'长顺县'),
					array('name'=>'龙里县'),
					array('name'=>'惠水县'),
					array('name'=>'三都县'),
				)
			),
		);
	}
	
	/**
	* 获取所有区域
	*/
	public function area(){
		return $this->data;
	}
	/**
	* 获取所有区域
	*/
	public function area2(){
		$arr=$this->data;
		unset($arr[99]);
		return $arr;
	}
	
	/**
	* 获取所有一级区域
	*/
	public function area_first(){
		$first=array();
		foreach ($this->data as $key =>$value){
			$first[$key]=$value['name'];
		}
		return $first;
	}
	
	/**
	* 获取所有一级区域
	*/
	public function area_first2(){
		$first=array();
		$arr=$this->data;
		unset($arr[99]);
		foreach ($arr as $key =>$value){
			$first[$key]=$value['name'];
		}
		return $first;
	}
	/**
	* 获取所有一级区域
	*/
	public function area_first3(){
		$first=array();
		$arr=$this->data;
		unset($arr[99]);
		foreach ($arr as $key =>$value){
			$first[$key]['name']=$value['name'];
		}
		return $first;
	}
	
	/**
	* 获取指定一级区域下的所有区域
	*/
	public function area_sub($city){
		$subPlace=array();
		foreach($this->data as $value){
			if($value['name']==$city){
				$subPlace=$value['sub'];
				break;
			}
		}
		return $subPlace;
	}
	
}
?>