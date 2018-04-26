<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilege_user_group extends MX_Controller {
	private $pk = 'id';
	private $insert_data = 
		array(
			array(
				'name'=>'role_name',
				'label'=>'Nama Group User',
				'type'=>'input',
				'class_validate'=>'required'
			),
			array(
				'name'=>'status',
				'label'=>'Status',
				'type'=>'select',
				'opt'=>'optstatus',
				'class_validate'=>'required_opt'
			),
			array(
				'name'=>'privilege',
				'label'=>'Privilege',
				'type'=>'free',
				'source'=>'grp_priv',
				'class_validate'=>'required'
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
		$data['cols'] = array('id','Nama Group','Status');
		$data['btn_add'] = cekPermissionAdd();
		$this->template->display('list',$data,'admin');
	}
	function list_table($value='')
	{
		$this->datatables
			->select('id,role_name,status')
			->from('prv_role_data')
			->where('deleted','0')
			->add_column('Action', '$1', 'cekPermission(id)')
			->edit_column('role_name', '<a href="'.site_url("admin/privilege_user_group/edit_form/$1").'">$2</a>', 'id, role_name')
			->edit_column('status', "$1", 'convert_aktif(status)');
		echo $this->datatables->generate();
	}
	public function add_form(){
		if(!empty($_POST)){
			$post = $this->input->post();
			$privilege=$post['privilege'];
			$privileges=array();
			$post['create_date'] = date("Y-m-d H:i:s");
			$post['user_create'] = $this->session->userdata("userID");
			unset($post['privilege']);
			$this->db->insert('prv_role_data',$post);
			$groupId = $this->db->insert_id();
			if(is_array($privilege)) {
				foreach($privilege as $prv=>$p) {
					$v=0;
					foreach($p as $pp){
						$v=$v+$pp;
					}
					$privileges[$prv]=$v;
				}
			}
			if(is_array($privileges)) {
				$now=date('Y-m-d H:i:s');
				foreach($privileges as $prv=>$p) {
					$prvnya=array('role_id'=>$groupId,'perm_id'=>$prv,'value'=>$p,'created'=>$now);
					$this->db->insert('prv_role_perms',$prvnya);
				}
			}
			redirect("privilege/privilege_user_group");
		}
		else{
			$menus = $this->m_common->get_all_menu()->result_array();
		    $hasil ='<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th rowspan=2>Module</th>
								<th colspan=4>Privilege</th>
							</tr>
							<tr>
								<th>View</th>
								<th>Create</th>
								<th>Update</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>';
			foreach ($menus as $key => $m) {
				$style = ($m["parent"] == 0) ? "text-align: left; cursor: pointer" : "text-align: center; cursor: pointer" ;
				$hasil .= "<tr>
							<td style='".$style."' onclick=\"_toggleCheckBoxes(this)\"><span style=\"font-weight: bold\">" . $m['perm_name'] . "</span></td>
							<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 8, set_checkbox($m['perm_name'] . $m['id'] . '[]', 8))) . "</td>
							<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 4, set_checkbox($m['perm_name'] . $m['id'] . '[]', 4))) . "</td>
							<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2))) . "</td>
							<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>
						</tr>";
			}
							
			$hasil .='</tbody></table>';
			$optstatus=array(' '=>'- Pilih Status -','0'=>'Tidak Aktif','1'=>'Aktif');
			$data["insert_field"] = $this->insert_data;
			$data['opt'] = array("optstatus"=>$optstatus);
			$data['url'] = "privilege/privilege_user_group/add_form";
			$data['source'] = array("grp_priv"=>$hasil);
			$this->template->display('add',$data,'admin');
		}
	}
	function edit_form($id=''){
		if(!empty($_POST)){
			$post = $this->input->post();
			$id = $post['id'];
			$privilege=$post['privilege'];
			
			$post['update_date'] = date("Y-m-d H:i:s");
			$post['user_update'] = $this->session->userdata("userID");
			
			unset($post['privilege']);
			unset($post['id']);
			
			$this->m_common->updateTable("prv_role_data","id",$id,$post);
			
			$privileges=array();
			if(is_array($privilege)) {
				foreach($privilege as $prv=>$p) {
					$v=0;
					foreach($p as $pp){
						$v=$v+$pp;
					}
					$privileges[$prv]=$v;
				}
			}
			if(is_array($privileges)) {
				$groupId=$id;
				$now=date('Y-m-d H:i:s');
				$this->db->where('role_id', $groupId);
				if($this->db->delete('prv_role_perms')) {
					foreach($privileges as $prv=>$p) {
						$prvnya=array('role_id'=>$groupId,'perm_id'=>$prv,'value'=>$p,'created'=>$now);
						$this->db->insert('prv_role_perms',$prvnya);
					}
				}
			}
			redirect("privilege/privilege_user_group");
		}
		else{
			$menus = $this->m_common->get_all_menu()->result_array();
			$data_group = $this->m_common->get_data_by_id('prv_role_data','id',$id)->row_array();
		    $hasil ='<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th rowspan=2>Module</th>
								<th colspan=4>Privilege</th>
							</tr>
							<tr>
								<th>View</th>
								<th>Create</th>
								<th>Update</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>';
			foreach ($menus as $key => $m) {
				$privilege = $this->m_common->get_role($id,$m["id"])->row_array();
				$v = (isset($privilege["value"])) ? $privilege["value"] : 0 ;
				$style = ($m["parent"] == 0) ? "text-align: left; cursor: pointer" : "text-align: center; cursor: pointer" ;
				$hasil .= "<tr>
							<td style='".$style."' onclick=\"_toggleCheckBoxes(this)\"><span style=\"font-weight: bold\">" . $m['perm_name'] . "</span></td>";
				if($v >= 8){
					$v = $v-8;
					$hasil .="<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 8, set_checkbox($m['perm_name'] . $m['id'] . '[]', 8)), '', TRUE) . "</td>";
					if($v >= 4){
						$v = $v-4;
						$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 4, set_checkbox($m['perm_name'] . $m['id'] . '[]', 4)), '', TRUE) . "</td>";
						if($v >= 2){
							$v = $v-2;
							$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2)), '', TRUE) . "</td>";
							if($v >= 1){
								$v = $v-1;
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1)), '', TRUE) . "</td>";
							}
							else{
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>";
							}
						}
						else{
							$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2))) . "</td>";
							if($v >= 1){
								$v = $v-1;
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1)), '', TRUE) . "</td>";
							}
							else{
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>";
							}
						}
					}
					else{
						$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 4, set_checkbox($m['perm_name'] . $m['id'] . '[]', 4))) . "</td>";
						if($v >= 2){
							$v = $v-2;
							$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2)), '', TRUE) . "</td>";
							if($v >= 1){
								$v = $v-1;
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1)), '', TRUE) . "</td>";
							}
							else{
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>";
							}
						}
						else{
							$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2))) . "</td>";
							if($v >= 1){
								$v = $v-1;
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1)), '', TRUE) . "</td>";
							}
							else{
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>";
							}
						}
					}
				}
				else{
					$hasil .="<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 8, set_checkbox($m['perm_name'] . $m['id'] . '[]', 8))) . "</td>";
					if($v >= 4){
						$v = $v-4;
						$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 4, set_checkbox($m['perm_name'] . $m['id'] . '[]', 4)), '', TRUE) . "</td>";
						if($v >= 2){
							$v = $v-2;
							$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2)), '', TRUE) . "</td>";
							if($v >= 1){
								$v = $v-1;
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1)), '', TRUE) . "</td>";
							}
							else{
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>";
							}
						}
						else{
							$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2))) . "</td>";
							if($v >= 1){
								$v = $v-1;
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1)), '', TRUE) . "</td>";
							}
							else{
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>";
							}
						}
					}
					else{
						$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 4, set_checkbox($m['perm_name'] . $m['id'] . '[]', 4))) . "</td>";
						if($v >= 2){
							$v = $v-2;
							$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2)), '', TRUE) . "</td>";
							if($v >= 1){
								$v = $v-1;
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1)), '', TRUE) . "</td>";
							}
							else{
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>";
							}
						}
						else{
							$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 2, set_checkbox($m['perm_name'] . $m['id'] . '[]', 2))) . "</td>";
							if($v >= 1){
								$v = $v-1;
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1)), '', TRUE) . "</td>";
							}
							else{
								$hasil .= "<td style=\"text-align: center\">" . form_checkbox(array('name' => 'privilege[' . $m['id'] . '][]', 'value' => 1, set_checkbox($m['perm_name'] . $m['id'] . '[]', 1))) . "</td>";
							}
						}
					}
				}
				$hasil .= "</tr>";
			}
							
			$hasil .='</tbody></table>';
			$optstatus=array(' '=>'- Pilih Status -','0'=>'Tidak Aktif','1'=>'Aktif');
			$data["insert_field"] = $this->insert_data;
			$data["data_val"] = $data_group;
			$data['opt'] = array("optstatus"=>$optstatus);
			$data['url'] = "privilege/privilege_user_group/edit_form";
			$data['source'] = array("grp_priv"=>$hasil);
			$data['pk']=$this->pk;
			$this->template->display('edit',$data,'admin');
		}
	}
	function delete_form($id){
		$this->db->where('id', $id);
		if($this->db->delete('prv_role_data')) {
			$this->db->where('role_id', $id);
			$this->db->delete('prv_role_perms');
			//$post['deleted']=1;
			//$this->m_common->updateTable("prv_user","id_pengguna",$id,$post);
		}
		redirect("privilege/privilege_user_group");
	}
}