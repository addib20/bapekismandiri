<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller {
	private $pk = 'id_pengguna';
	private $insert_data = 
		array(
			array(
				'name'=>'nama_lengkap',
				'label'=>'Nama Lengkap',
				'type'=>'input',
				'class_validate'=>'required'
			),
			array(
				'name'=>'nama_pengguna',
				'label'=>'Nama Pengguna',
				'type'=>'input',
				'class_validate'=>'required'
			),
			array(
				'name'=>'sandi',
				'label'=>'Kata Sandi',
				'type'=>'password',
				'class_validate'=>'required'
			),
			array(
				'name'=>'sandi2',
				'label'=>'Ulangi Kata Sandi',
				'type'=>'password',
				'class_validate'=>'required-same'
			),
			array(
				'name'=>'email',
				'label'=>'Email',
				'type'=>'input',
				'class_validate'=>'required-email'
			),
			array(
				'name'=>'foto',
				'label'=>'Foto',
				'type'=>'upload',
				'class_validate'=>'required-email'
			)
		);
	function __construct() {
        parent::__construct();
		$this->load->model('m_common');
    }	
	public function index()
	{
		
	}
	function edit_form(){
		if(!empty($_POST)){
			$post = $this->input->post();
			$id = $post['id_pengguna'];
			
			$post['sandi'] = hash('sha256', md5($post['sandi']).'s1mp3l');
			$post['modified'] = date("Y-m-d H:i:s");
			$post_privilege = array();
			//$post_privilege['role_id'] = $post['role_id'];
			$post_privilege['user_id'] = $post['id_pengguna'];
			$post_privilege['created'] = date("Y-m-d H:i:s");
			
			$upload_path='./assets/img/user/';
			if(!is_dir($upload_path)) {
				mkdir($upload_path,0755,TRUE);
			}
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png|JPEG|JPG|jpg';
			$config['max_width']  = '1536';
			$config['max_height'] = '1152';
			$config['file_name']  = 'user_'.$permalink;
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('foto')) {
				$data=$this->upload->data();
				$post["foto"] = "assets/img/user/".$data['file_name'];
			}
			else{
				unset($post["foto"]);
			}
			
			unset($post['sandi']);
			unset($post['sandi2']);
			unset($post['role_id']);
			unset($post['id_pengguna']);
			
			$this->m_common->updateTable("prv_user","id_pengguna",$id,$post);
			if($this->db->delete('prv_user_roles', array('user_id' => $id))){
				$this->db->insert('prv_user_roles',$post_privilege);
			}
			redirect(base_url());
		}
		else{
			$id = $this->session->userdata("userID");
			$data_user = $this->m_common->get_data_by_id('prv_user','id_pengguna',$id)->row_array();
			//$data_priv = $this->m_common->get_data_by_id('prv_user_roles','user_id',$id)->row_array();
			$privilege=$this->m_common->get_all_privilege()->result_array();
			$optpriv=array(''=>'- Pilih Hak Akses -');
			foreach($privilege as $p) {
				$optpriv[$p["id"]]=$p['role_name'];
			}
			//$data_user['role_id'] = $data_priv['role_id'];
			$data["data_val"] = $data_user;
			$data["insert_field"] = $this->insert_data;
			unset($data["insert_field"][2]);
			unset($data["insert_field"][3]);
			
			$data['opt'] = array("optpriv"=>$optpriv);
			$data['url'] = "user/profile/edit_form";
			$data['pk']=$this->pk;
			$this->template->display('edit',$data,'admin');
		}
	}
	public function change_password(){
		$msg = array();
		
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$id = $this->session->userdata("userID");
		
		$cek_password = $this->m_common->cek_password($old_pass,$id);
		$is_logged = $cek_password->row_array();
		
		if($cek_password->num_rows() > 0){
			$post['sandi'] = hash('sha256', md5($new_pass).'s1mp3l');
			$this->m_common->updateTable("prv_user","id_pengguna",$id,$post);
			$msg['error_message'] = "true";
			$msg['url'] = "";
			$msg['base_admin'] = base_url();
		}
		else{
			$msg['error_message'] = "Password Lama Anda Salah";
		}
		echo json_encode($msg);
	}
}