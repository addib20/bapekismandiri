<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('m_auth');
    }	
	public function index()
	{
		$data = "";
		$this->template->display('login',$data);
	}
	public function in_login (){
		$usr_admin = $this->input->post('usr');
		$pwd_admin = $this->input->post('pwd');
		
		$cek_user = $this->m_auth->cek_login($usr_admin,$pwd_admin);
		$is_logged = $cek_user->row_array();
		
		if($cek_user->num_rows() > 0){
			$msg = array();
			/*if($is_logged['login_status'] == 1 && ($is_logged['login_session'] <> "NULL" || !empty($is_logged['login_session']))){
				$msg['error_message'] = "Username Sedang Digunakan. ";
			}
			else{*/
				$cek_role = $this->m_auth->cek_role($is_logged["id_pengguna"]);
				$role_user = $cek_role->row_array();
				$log_sess = $this->m_auth->update_login($usr_admin,$pwd_admin);
				$sess_data = array(
	                   'name'			=> $is_logged["nama_lengkap"],
	                   'username'		=> $is_logged["nama_pengguna"],
	                   'email'			=> $is_logged["email"],
					   'akses'			=> $role_user["role_name"],
					   'role_id'		=> $role_user["id"],
					   'last_login'		=> $is_logged["last_login"],
					   'foto'			=> $is_logged["foto"],
	                   'log_sess'		=> $log_sess,
	                   'last_activity'	=> strtotime(date("Y-m-d H:i:s")),
	                   'userID'			=> $is_logged["id_pengguna"],
	                   'logged_in'		=> TRUE
	               );

				$this->session->set_userdata($sess_data);
				$msg['error_message'] = "true";
				$msg['url'] = $this->session->userdata("last_access");
				$msg['base_admin'] = base_url().'admin/dashboard';
			//}
		}
		else{
			$msg['error_message'] = "Username atau Password Salah. ";
		}
		echo json_encode($msg);
	}
	public function logout()
	{
		$log_sess = $this->session->userdata("log_sess");
		$this->m_auth->update_logout($log_sess);
		$sess_data = array(
	           'name'			=> '',
	           'username'		=> '',
	           'email'			=> '',
	           'log_sess'		=> '',
               'last_activity'	=> '',
               'userID'			=> '',
	           'logged_in'		=> FALSE
	       );
		$this->session->unset_userdata($sess_data);
		redirect("admin");
	}
}