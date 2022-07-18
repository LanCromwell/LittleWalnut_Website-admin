<?php
namespace App\Libs;
/**
 * Created by PhpStorm.
 * User: yaqia
 * Date: 2018/12/17
 * Time: 20:48
 */
class TreeHelper
{
	/**
	 * 将数据格式化成树形结构
	 * @param array $array
	 * @return array
	 */
	static function genTree($array) {
		if (empty($array)) {
			return $array;
		}
		//第一步 构造数据
		$items = array();
		foreach($array as $value){
			$items[$value['id']] = $value;
		}
		//第二部 遍历数据 生成树状结构
		$tree = array();
		foreach($items as $key => $item){
//			$items[$item['pid']]['child'] = array();
			if(isset($items[$item['pid']])){
				$items[$item['pid']]['child'][] = &$items[$key];
			}else{
				$items[$key]['child'] = [];
				$tree[] = &$items[$key];
			}
		}
		return $tree;
	}

	/**
	 * 计算两个时间戳之间相差的日时分秒
	 * @param $date1 开始时间
	 * @param $date2 结束时间
	 * @return array
	 */
	public static function diffDate($date1, $date2) {
		$datetime1 = new \DateTime($date1);
		$datetime2 = new \DateTime($date2);
		$interval = $datetime1->diff($datetime2);
		$time['year'] = $interval->format('%Y');
		$time['month'] = $interval->format('%m');
		$time['day'] = $interval->format('%d');
		$time['hour'] = $interval->format('%H');
		$time['min'] = $interval->format('%i');
		$time['sec'] = $interval->format('%s');
		$time['days'] = $interval->format('%a'); // 两个时间相差总天数
		return $time;
	}
}