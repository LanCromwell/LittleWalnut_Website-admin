<?php
namespace App\Libs;
/**
 * Created by PhpStorm.
 * User: yaqia
 * Date: 2018/12/17
 * Time: 20:48
 */
class DateHelper
{
	/**
	 * 计算两个时间戳之间相差的日时分秒
	 * @param $unixTime_1 开始时间戳
	 * @param $unixTime_2 结束时间戳
	 * @return array
	 */
	public static function timeDiff($unixTime_1, $unixTime_2) {
		$timediff = abs($unixTime_2 - $unixTime_1);
		//计算天数
		$days = intval($timediff / 86400);
		//计算小时数
		$remain = $timediff % 86400;
		$hours = intval($remain / 3600);
		//计算分钟数
		$remain = $remain % 3600;
		$mins = intval($remain / 60);
		//计算秒数
		$secs = $remain % 60;
		return ['day' => $days, 'hour' => $hours, 'min' => $mins, 'sec' => $secs];
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

	/**
	 * @param $date
	 * @return array
	 */
	public static function getTheMonth($date)
	{
		$firstDay = date('Y-m-01', strtotime($date));
		$lastDay = date('Y-m-d', strtotime("$firstDay +1 month -1 day"));
		return array($firstDay, $lastDay);

	}
}