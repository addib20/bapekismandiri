<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilege_user extends MX_Controller {
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
				'type'=>'upload'
			),
			array(
				'name'=>'role_id',
				'label'=>'Hak Akses',
				'type'=>'select',
				'opt'=>'optpriv',
				'class_validate'=>'required_opt'
			)
		);
	function __construct() {
        parent::__construct();
		$this->load->model('m_common');
		$this->load->library('datatables');
		$this->load->helper("datatables_helper");
    }	
	public function index()
	{
		$data['cols'] = array('id','Nama Lengkap','Nama Pengguna','Email','Login Terakhir','Status');
		$data['btn_add'] = cekPermissionAdd();
		$this->template->display('list',$data,'admin');
	}
	function list_table($value='')
	{
		$this->datatables
			->select('id_pengguna, nama_lengkap, nama_pengguna, email, last_login, deleted')
			->from('prv_user')
			->add_column('Action', '$1', 'cekPermission(id_pengguna)')
			->edit_column('last_login', '$1', 'formatDate2(last_login)')
			->edit_column('deleted', '$1', 'convert_delete(deleted)');
		echo $this->datatables->generate();
	}
	public function add_form(){
		if(!empty($_POST)){
			$this->load->library('upload');
			$post = $this->input->post();
			$post_privilege = array();
			$post_privilege['role_id'] = $post['role_id'];
			$permalink = $post['nama_pengguna'];
			
			$upload_path='./assets/img/user/';
			if(!is_dir($upload_path)) {
				mkdir($upload_path,0777,TRUE);
			}
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png|JPEG|JPG|jpg';
			$config['max_width']  = '1536';
			$config['max_height'] = '1152';
			$config['file_name']  = 'user_'.$permalink;
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('foto')) {
				$data=$this->upload->data();
				$post["foto"] = "assets/img/user/".$data['file_name'];
			}
			else{
				unset($post["foto"]);
			}
			unset($post['sandi2']);
			unset($post['role_id']);
			$post['sandi'] = hash('sha256', md5($post['sandi']).'s1mp3l');
			$post['created'] = date("Y-m-d H:i:s");
			$this->db->insert('prv_user',$post);
			$post_privilege['user_id'] = $this->db->insert_id();
			$post_privilege['created'] = date("Y-m-d H:i:s");
			$this->db->insert('prv_user_roles',$post_privilege);
			redirect("privilege/privilege_user");
		}
		else{
			$privilege=$this->m_common->get_all_privilege()->result_array();
			$optpriv=array(' '=>'- Pilih Hak Akses -');
			foreach($privilege as $p) {
				$optpriv[$p["id"]]=$p['role_name'];
			}
			$data["insert_field"] = $this->insert_data;
			$data['opt'] = array("optpriv"=>$optpriv);
			$data['url'] = "privilege/privilege_user/add_form";
			$this->template->display('add',$data,'admin');
		}
	}
	function edit_form($id=''){
		if(!empty($_POST)){
			$this->load->library('upload');
			$post = $this->input->post();
			$id = $post['id_pengguna'];
			$permalink = $post['nama_pengguna'];
			
			$post['sandi'] = hash('sha256', md5($post['sandi']).'s1mp3l');
			$post['modified'] = date("Y-m-d H:i:s");
			$post_privilege = array();
			$post_privilege['role_id'] = $post['role_id'];
			$post_privilege['user_id'] = $post['id_pengguna'];
			$post_privilege['created'] = date("Y-m-d H:i:s");
			
			$upload_path='./assets/img/user/';
			if(!is_dir($upload_path)) {
				mkdir($upload_path,0777,TRUE);
			}
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png|JPEG|JPG|jpg';
			$config['max_width']  = '1536';
			$config['max_height'] = '1152';
			$config['file_name']  = 'user_'.$permalink;
			$this->upload->initialize($config);
			
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
			redirect("privilege/privilege_user");
		}
		else{
			$data_user = $this->m_common->get_data_by_id('prv_user','id_pengguna',$id)->row_array();
			$data_priv = $this->m_common->get_data_by_id('prv_user_roles','user_id',$id)->row_array();
			$privilege=$this->m_common->get_all_privilege()->result_array();
			$optpriv=array(''=>'- Pilih Hak Akses -');
			foreach($privilege as $p) {
				$optpriv[$p["id"]]=$p['role_name'];
			}
			$data_user['role_id'] = $data_priv['role_id'];
			$data["data_val"] = $data_user;
			$data["insert_field"] = $this->insert_data;
			unset($data["insert_field"][2]);
			unset($data["insert_field"][3]);
			$data['opt'] = array("optpriv"=>$optpriv);
			$data['url'] = "privilege/privilege_user/edit_form";
			$data['pk']=$this->pk;
			$this->template->display('edit',$data,'admin');
		}
	}
	function delete_form($id){
		$this->db->where('user_id', $id);
			if($this->db->delete('prv_user_roles')) {
				$this->db->where('id_pengguna', $id);
				$this->db->delete('prv_user');
				//$post['deleted']=1;
				//$this->m_common->updateTable("prv_user","id_pengguna",$id,$post);
		}
		redirect("privilege/privilege_user");
	}
}