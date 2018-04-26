<?php if (!defined('BASEPATH'))	exit('No direct script access allowed');
class M_menu extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function get_parent_menus() {
		$sql = "SELECT * FROM ".$this->db->dbprefix('prv_perm_data')." p 
				WHERE p.deleted = 0 AND status=1 AND p.parent = 0
				ORDER BY p.bobot ASC";
		return $this->db->query($sql);
	}
	function get_sub_menu($parent=0) {
		return $this->db->where('deleted',0)
        				->where('parent',$parent)
        				->where('status',1)
						->from('prv_perm_data')
                    	->order_by('bobot','asc')
                    	->get();
    }
	function count_sub_menu($parent=0) {
		return $this->db->where('deleted',0)
        				->where('parent',$parent)
        				->where('status',1)
						->from('prv_perm_data')
                    	->count_all_results();
    }
	function get_child_menus($parent='0') {
		return $this->db->where('deleted',0)
        				->where('parent',$parent)
        				->where('status',1)
						->from('prv_perm_data')
                    	->order_by('bobot','asc')
                    	->get();
	}
	function get_label_menu($permKey) {
		return $this->db->select('permName')
						->where('permKey',$permKey)
						->from('prv_perm_data')
                    	->get()->row_array();
	}
	function get_id($key) {
		$sql = "SELECT ID 
				FROM ".$this->db->dbprefix('prv_perm_data')." p 
				WHERE p.permKey = '".$key."'";
		return $this->db->query($sql);
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
	function get_parent_byid($id){
		$sql = "SELECT perm_name 
				FROM ".$this->db->dbprefix('prv_perm_data')." p 
				WHERE p.id = '".$id."'";
		$r =  $this->db->query($sql)->row_array();
		return $r['perm_name'];
	}
}

/* End of file Menu.php */
/* Location: .Modules/Menu/controllers/Menu.php */
