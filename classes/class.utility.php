<?php

@session_start();

class utility {

	static function pr($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}

	static function vd($a) {
		echo '<pre>';
		var_dump($a);
		echo '</pre>';
	}

	static function is_post() {
		return (
				isset($_SERVER['REQUEST_METHOD']) &&
				trim($_SERVER['REQUEST_METHOD']) != '' &&
				trim($_SERVER['REQUEST_METHOD']) == 'POST'
				) ? true : false;
	}

	static function custom_parse_str($string) {
		$array = array();

		echo $string;
		$arr1 = explode('&', $string);
		foreach ($arr1 as $k => $v) {
			$arr2 = explode('=', $v);
			$array[$arr2[0]] = trim(urldecode($arr2[1]));
		}

		return $array;
	}

	static function check_login() {
		if (
				isset($_SESSION['id']) && trim($_SESSION['id']) != '' && is_numeric($_SESSION['id'])) {
			return true;
		}
		return false;
	}

	static function check_login_and_redirect() {
		if (!utility::check_login()) {
			header("Location:login.php");
		}
	}

}
