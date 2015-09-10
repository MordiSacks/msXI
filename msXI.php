<?php

/**
 * Created by PhpStorm.
 * User: any-m7
 * Date: 27/08/2015
 * Time: 22:51
 */
class msXI {

	/**
	 * @param $type
	 * @param $name
	 */

	public static function make($type, $name) {

		$key = sha1($type . $name . time() . microtime() . rand(1000000, 9999999));
		$field = ['type' => $type, 'name' => $name,];

		$_SESSION['msXI'][$key] = $field;
		echo $key;
	}

	/**
	 * @param bool $key
	 */
	public static function request($key = false) {
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			foreach($_POST as $k_p => $post){
				if(isset($_SESSION['msXI'][$k_p])){
					$_POST[$_SESSION['msXI'][$k_p]['name']] = static::sanitize($_SESSION['msXI'][$k_p]['type'], $post);
					unset($_POST[$k_p]);
					unset($_SESSION['msXI'][$k_p]);
				} else {
					unset($_POST[$k_p]);
				}
			}
		}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
			foreach($_GET as $k_g => $get){
				if(isset($_SESSION['msXI'][$k_g])){
					$_GET[$_SESSION['msXI'][$k_g]['name']] = static::sanitize($_SESSION['msXI'][$k_g]['type'], $get);
					unset($_GET[$k_g]);
					unset($_SESSION['msXI'][$k_g]);
				}
			}
		}
	}

	/**
	 * @param $type
	 * @param $val
	 * @return null
	 */
	public static function sanitize($type, $val){
		switch($type){
			case 'num':
			case 'number':
				return (preg_match('/^\d*$/',$val) ? $val : null);
				break;
			case 'alpha':
				return (ctype_alpha($val) ? $val : null);
				break;
			case 'alnum':
				return (ctype_alnum($val) ? $val : null);
				break;
			default:
				return null;
				break;
		}
	}
}