<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Library template for codeigniter
 *  by Muhammad Addib Bahlavy
 * 2014
*/
class Template {
    protected $_ci;
    function __construct() {
        $this->_ci=&get_instance();
    }
    function display($template='home', $data=null, $theme="default") {
    	$config_breadcrumb = array();
		$data['template_content'] = $template;
		$data['base_url'] = base_url();
		
		if($theme=='admin'){
			/* check user idle until 60 minutes */
			/* and save last access page */
			$str = strtotime(date("Y-m-d H:i:s"));
			$last_activity = $this->_ci->session->userdata('last_activity');
			$expire_time = $str-$last_activity;
			if($expire_time > 3600){
				$this->_ci->load->model('m_auth');
				$log_sess = $this->_ci->session->userdata("log_sess");
				$this->_ci->m_auth->update_logout($log_sess);
				$sess_data = array(
					   'name'			=> '',
					   'username'		=> '',
					   'email'			=> '',
					   'log_sess'		=> '',
					   'last_activity'	=> '',
					   'userID'			=> '',
					   'logged_in'		=> FALSE
				   );
				$this->_ci->session->unset_userdata($sess_data);
				$this->_ci->session->set_userdata('last_access',$this->_ci->uri->segment(2));
				redirect('admin/login');
			}
			else{
				$this->_ci->session->set_userdata('last_activity',$str);
			}
			/* end check user idle */
			
			if($this->_ci->session->userdata('logged_in')) {
				$data['_top_bar']  = $this->_ci->load->view('themes/'.$theme.'/template/top_bar',$data,TRUE);
				$data['_header']  = $this->_ci->load->view('themes/'.$theme.'/template/header',$data,TRUE);
				$data['_menu']  = $this->_ci->load->view('themes/'.$theme.'/template/menu',$data,TRUE);
				$data['_footer'] = $this->_ci->load->view('themes/'.$theme.'/template/footer', $data, TRUE);
				/* cek hak akses tiap user per module */
				/* fungsi yang dipanggil untuk pengecekan : hasPermission(nama_module, nama_akses(CRUD)) */
				$this->_ci->load->library('acl',array('userID'=>$this->_ci->session->userdata('userID')));
				$acl_test = $this->_ci->uri->segment(2).'-';
				$acl_test .= ($this->_ci->uri->segment(3) == "" || $this->_ci->uri->segment(3) == "index") ? '' : $this->_ci->uri->segment(3);
				
				$parm=explode('-', $acl_test);
				if($parm[1] != '' && $parm[1] != 'detail' && $parm[1] != 'cek_peserta'){
					if($parm[1] == 'add_form' || $parm[1] == 'add_trainer' || $parm[1] == 'add_peserta'){
						$parm2 ='create';
					}
					elseif ($parm[1] == 'edit_form' || $parm[1] == 'input') {
						$parm2 ='update';
					}
					elseif ($parm[1] == 'delete_form') {
						$parm2 ='delete';
					}
				}
				else{
					$parm2 ='view';
				}
				/* end */
				
				/* custom autobreadcrumb */
				/*$config_breadcrumb['use_wrapper'] = false;
				$config_breadcrumb['set_home'] = "";
				if(isset($data['replacer'])){
					$config_breadcrumb['replacer'] = $data['replacer'];
					$data['_uri'] = $config_breadcrumb['replacer'][$parm[0]];
				}
				else{
					$data['_uri'] = ucwords(str_replace("_", " ", $parm[0]));
				}
				$data['_breadcrumb'] = set_breadcrumb("",array(''),$config_breadcrumb);*/ // create breadcrumb
				/* end */ 
				
				if(!$this->_ci->acl->hasPermission($parm[0],$parm2) && $parm[0] <> 'dashboard' && $theme=="admin" && ($parm[0] <> 'profile')
					) { // cek akses CRUD
					$data['_content'] = $this->_ci->load->view('themes/'.$theme.'/template/forbiden_menu',$data,TRUE);
				}
				else{
					$data['_content'] = $this->_ci->load->view('themes/'.$theme.'/content/'.$template,$data,TRUE);
				}
				$this->_ci->load->view('themes/'.$theme.'/template',$data); //render view
			}
			else{
				$this->_ci->load->view('themes/'.$theme.'/template/login',$data);
			}
			/* end */
		}
		else if($theme=='default'){
			
		}
    }
}