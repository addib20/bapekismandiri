<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends MX_Controller {
	function __construct() {
        parent::__construct();
    }
	function cek_permission_table(){
		$referer = explode("/", $_SERVER['HTTP_REFERER']);
		$arr = array_values(array_slice($referer, -3, 3, true));
		$param = $arr[2];
		$add_button = $this->acl->hasPermission($param,'create') ? $param : 'not';
		echo $add_button;
	}
}