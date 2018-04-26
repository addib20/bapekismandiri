<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilege_menu extends MX_Controller {
	private $pk = 'id';
	private $insert_data = 
		array(
			array(
				'name'=>'perm_name',
				'label'=>'Nama Menu',
				'type'=>'input',
				'class_validate'=>'required'
			),
			array(
				'name'=>'perm_key',
				'label'=>'Nama Modul',
				'type'=>'input',
				'class_validate'=>'required'
			),
			array(
				'name'=>'class_icon',
				'label'=>'Icon Menu',
				'type'=>'input'
			),
			array(
				'name'=>'parent',
				'label'=>'Menu Parent',
				'type'=>'select',
				'opt'=>'optparent'
			),
			array(
				'name'=>'status',
				'label'=>'Status Menu',
				'type'=>'select',
				'opt'=>'optstatus',
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
		$data['cols'] = array('id','Parent Menu','Menu','Icon','Status');
		$data['btn_add'] = cekPermissionAdd();
		$this->template->display('list',$data,'admin');
	}
	function list_table($value='')
	{
		$this->datatables
			->select('prv_perm_data.id,(SELECT perm_name FROM prv_perm_data p WHERE p.id = prv_perm_data.parent) as parent,perm_name,class_icon,status')
			->from('prv_perm_data')
			->where('deleted','0')
			->add_column('Action', '$1', 'cekPermission(prv_perm_data.id)')
			->edit_column('Icon', '<i class="$1"></i>', 'class_icon')
			->edit_column('status', '$1', 'convert_aktif(status)');
		echo $this->datatables->generate();
	}
	public function add_form(){
		if(!empty($_POST)){
			$post = $this->input->post();
			$post['create_date'] = date("Y-m-d H:i:s");
			$post['user_create'] = $this->session->userdata("userID");
			$this->db->insert('prv_perm_data',$post);
			$id_insert = $this->db->insert_id();
			$post_update['bobot'] = ($post['parent']>0)?$post['parent']:$id_insert;
			$this->m_common->updateTable("prv_perm_data","id",$id_insert,$post_update);
			redirect("privilege/privilege_menu");
		}
		else{
			$get_parent=$this->m_common->get_parent_menu()->result_array();
			$rdbtest = array();
			$optparent=array(' '=>'= Pilih Parent =');
			foreach($get_parent as $gp) {
				$optparent[$gp['id']]=$gp['perm_name'];
			}
			$optstatus=array(' '=>'= Pilih Status =','0'=>'Tidak Aktif','1'=>'Aktif');			
			$data["insert_field"] = $this->insert_data;
			$data['opt'] = array("optstatus"=>$optstatus,"optparent"=>$optparent);
			$data['url'] = "privilege/privilege_menu/add_form";
			$this->template->display('add',$data,'admin');
		}
	}
	function edit_form($id=''){
		if(!empty($_POST)){
			$post = $this->input->post();
			$id = $post['id'];
			$post['update_date'] = date("Y-m-d H:i:s");
			$post['user_update'] = $this->session->userdata("userID");
			$post['bobot'] = ($post['parent']>0)?$post['parent']:$id;
			unset($post['id']);
			$this->m_common->updateTable("prv_perm_data","id",$id,$post);
			
			redirect("privilege/privilege_menu");
		}
		else{
			$data_user = $this->m_common->get_data_by_id('prv_perm_data','id',$id)->row_array();
			$get_parent=$this->m_common->get_parent_menu($id)->result_array();
			$optparent=array(' '=>'= Pilih Parent =');
			foreach($get_parent as $gp) {
				$optparent[$gp['id']]=$gp['perm_name'];
			}
			$optstatus=array(' '=>'= Pilih Status =','0'=>'Tidak Aktif','1'=>'Aktif');
			$data["pk"] = $this->pk;
			$data["data_val"] = $data_user;		
			$data["insert_field"] = $this->insert_data;
			$data['opt'] = array("optstatus"=>$optstatus,"optparent"=>$optparent);
			$data['url'] = "privilege/privilege_menu/edit_form";
			$this->template->display('edit',$data,'admin');
		}
	}
	function delete_form($id){
		$this->db->where('perm_id', $id);
			if($this->db->delete('prv_role_perms')) {
				$this->db->where('id', $id);
				$this->db->delete('prv_perm_data');
				//$post['deleted']=1;
				//$this->m_common->updateTable("prv_perm_data","id",$id,$post);
		}
		redirect("privilege/privilege_menu");
	}
}