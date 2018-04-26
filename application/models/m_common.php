<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_common extends CI_Model {
	private $table = 'prv_user';
	public function get_all_user(){
		$sql = "Select * From ".$this->db->dbprefix($this->table)." order by nama_lengkap";
		return $this->db->query($sql);
	}
	public function get_all_privilege(){
		$sql = "Select * From ".$this->db->dbprefix("prv_role_data")." where status = 1 and deleted = 0 order by role_name asc";
		return $this->db->query($sql);
	}
	public function get_data_by_id($table,$field_id,$id){
		$sql = "Select * From ".$this->db->dbprefix($table)." where ".$field_id." = '".$id."'";
		return $this->db->query($sql);
	}
	public function insertTable($table,$data){
		$this->db->insert($table, $data);
	}
	public function updateTable($table,$field_id,$id,$data){
		$this->db->where($field_id, $id);
		$this->db->update($table, $data);
	}
	function deleteData($table,$kondisi){
		$this->db->delete($table, $kondisi); 
	}
	public function get_parent_menu($id=''){
		$sql = "SELECT * FROM ".$this->db->dbprefix('prv_perm_data')." WHERE parent = 0 AND deleted = 0 AND id != '".$id."' ORDER BY perm_name";
		return $this->db->query($sql);
	}
	public function get_data_sql($sql){
		return $this->db->query($sql);
	}
	function check_url($table,$field_id,$id,$trim){
		$this->db->where('name_trim',$trim);
		$this->db->where($field_id,$id);
		return $this->db->get($table)->num_rows();
	}
	function get_all_menu(){
		$sql = "SELECT p.id,p.perm_key,p.perm_name,p.parent,p.status FROM ".$this->db->dbprefix('prv_perm_data')." p 
				WHERE p.status = '1' AND deleted = 0
				ORDER by bobot,parent asc";
		return $this->db->query($sql);
	}
	function get_role($id_role,$id_perm){
		$sql = "SELECT * FROM ".$this->db->dbprefix('prv_role_perms')."
				WHERE role_id = ".$id_role." AND perm_id = ".$id_perm;
		return $this->db->query($sql);
	}
	function get_role_id($user_id){
		$sql = "SELECT * FROM ".$this->db->dbprefix('prv_user_roles')."
				WHERE user_id = '".$user_id."'";
		return $this->db->query($sql);
	}
	function get_user_nama($user_id){
		$sql = "SELECT * FROM ".$this->db->dbprefix('prv_user')."
				WHERE id_pengguna = '".$user_id."'";
		return $this->db->query($sql);
	}
	public function cek_password($pwd,$id)
	{
		$this->db->where("id_pengguna",$id);
		$this->db->where("sandi",hash('sha256', md5($pwd).'s1mp3l'));
		$this->db->where("aktif",1);
 		$query=$this->db->get("prv_user");
		return $query;
	}
}