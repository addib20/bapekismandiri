<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('m_common');
		$this->load->model('m_menu');
    }	
	public function index()
	{
		$data='';
		$this->template->display('dashboard',$data,'admin');
	}
}