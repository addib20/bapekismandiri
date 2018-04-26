<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends MX_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->model('m_menu');
	}
	public function index() {
		$p_menu = $this->m_menu->get_parent_menus()->result_array();
		foreach($p_menu as $menu) {
			if($this->acl->hasPermission($menu['perm_key'],'view')) {
				if($menu['parent'] == 0 || $menu['parent'] == NULL) {
					$ada=$this->m_menu->count_sub_menu($menu['id']);
					if($ada > 0) {
						$sub_menu = array();					
						$subs=$this->m_menu->get_sub_menu($menu['id'])->result_array();
						foreach($subs as $sub) {
							if($this->acl->hasPermission($sub['perm_key'],'view')) {
								$sub_menu[]=array('label'=>$sub['perm_name'],'url'=>$sub['perm_key'],'icon'=>$sub['class_icon']);
								$url_sub_menu[]=$sub['perm_key'];
							}
						}
						$items[]=array('label'=>$menu['perm_name'],'url'=>$menu['perm_key'],'icon'=>$menu['class_icon'],'sub_menu'=>$sub_menu,'url_sub_menu'=>$url_sub_menu);
					}
					else {
						$items[]=array('label'=>$menu['perm_name'],'url'=>$menu['perm_key'],'icon'=>$menu['class_icon'],'sub_menu'=>array(),'url_sub_menu'=>array());
					}
				}
			}
		}		
		return $items; 
	}
	public function get_child_menus($parent) {
		$perm_ids = $this->m_menu->get_id($parent);
		if($perm_ids->num_rows() > 0) {
			$id = $perm_ids->row_array();
			$perm_id = $id['id'];
		}
		else {
			$perm_id = 6;
		}
		return $this->m_menu->get_child_menus($perm_id)->result_array();
	}
	public function get($menu) {
		$perm_ids = $this->m_menu->get_id($menu);
		if($perm_ids->num_rows() > 0) {
			$id = $perm_ids->row_array();
			$perm_id = $id['id'];
		}
		else {
			$perm_id = 0;
		}
		$cmenu = $this->m_menu->get_child_menus($perm_id)->result_array();
		$label = $this->m_menu->get_label_menu($menu);
		
		$resp = array();
		$resp['status'] = TRUE; 
		$resp['menu'] = $label['perm_name'];
		$resp['resp'] = array();
		
		$this->load->library('acl',array('userID'=>$this->session->userdata('userID')));
		
		$i=0;
		foreach($cmenu as $cm) {
			//if($this->acl->hasPermission($cm['perm_key'],'view')) {
				$resp['resp'][$i]['url'] = $cm['perm_key'];
				$resp['resp'][$i]['label'] = $cm['perm_name'];
				$i++;
			//}				
		}
		echo json_encode($resp);
	}
	
}

/* End of file home.php */
/* Location: .Modules/Home/controllers/home.php */