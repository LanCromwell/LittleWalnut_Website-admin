<?php
namespace App\Libs;
/**
 * Created by PhpStorm.
 * User: yaqia
 * Date: 2018/12/17
 * Time: 20:48
 */
class CommonHelper
{

	/**
	 * 递归方式把数组或字符串 null转换为空''字符串
	 * @param $arr
	 * @param string $type
	 * @return array|string
	 */
	public static function unsetNull($arr, $type = ''){
		if($arr !== null){
			if(is_array($arr)){
				if(!empty($arr)){
					foreach($arr as $key => $value){
						if($value === null){
							$arr[$key] = $type;
						}else{
							$arr[$key] = self::unsetNull($value);      //递归再去执行
						}
					}
				}
			}else{
				if($arr === null){ $arr = $type; }         //注意三个等号
			}
		}else{ $arr = $type; }
		return $arr;
	}

	/**
	 * 生成邀请码
	 * @param $user_id
	 * @return string
	 */
	public static function createCode($user_id) {
		static $source_string = 'E5FCDG3HQA4B1NOPIJ2RSTUV67MWX89KLYZ';
		$num = $user_id;
		$code = '';
		while ( $num > 0) {
			$mod = $num % 35;
			$num = ($num - $mod) / 35;
			$code = $source_string[$mod].$code;
		}
		if(empty($code[3]))
			$code = str_pad($code,4,'0',STR_PAD_LEFT);
		return $code;
	}

	/**
	 * 破解邀请码
	 * @param $code
	 * @return float|int
	 */
	function decode($code) {
		static $source_string = 'E5FCDG3HQA4B1NOPIJ2RSTUV67MWX89KLYZ';
		if (strrpos($code, '0') !== false)
			$code = substr($code, strrpos($code, '0')+1);
		$len = strlen($code);
		$code = strrev($code);
		$num = 0;
		for ($i=0; $i < $len; $i++) {
			$num += strpos($source_string, $code[$i]) * pow(35, $i);
		}
		return $num;
	}

    static function is_mobile_phone ($mobile_phone)
    {
        $chars = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/";
        if(preg_match($chars, $mobile_phone))
        {
            return true;
        }
        return false;
    }
}