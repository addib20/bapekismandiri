<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilege extends MX_Controller {
	function __construct() {
        parent::__construct();
    }	
	public function index()
	{
		$data["test"] = "test";
		$this->template->display('dashboard',$data);
	}
}