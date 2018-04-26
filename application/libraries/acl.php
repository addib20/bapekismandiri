<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class acl {
	/* Actions::::
	* Create 1
	* Read 2
	* Update 4
	* Delete 8
	* The allowance is made by a sum of the actions allowed.
	* Ex.: user can read and update (2+4)=6 … so ill put 6 instead of 1 or 0.
	*
	* if(!$this->acl->hasPermission('entries_complete_access')) {
			echo "No no";
		} else
	* 		echo "yeah";
		}
	*
	*/
	
	var $perms = array(); //Array : Stores the permissions for the user
	var $userID; //Integer : Stores the ID of the current user
	var $userRoles = array(); //Array : Stores the roles of the current user
	var $ci;
	public $_insertPrivilege;
	public $_updatePrivilege;
	public $_deletePrivilege;
	
	function __construct($config=array()) {
		$this->ci = &get_instance();
		
		$usID = $this->ci->session->userdata('userID') ? $this->ci->session->userdata('userID') : '0';
		$this->userID = floatval($usID);
		$this->userRoles = $this->getUserRoles();
		$this->buildACL();
	}
	
	function buildACL() {
		//first, get the rules for the user's role
		if (count($this->userRoles) > 0) {
			$this->perms = array_merge($this->perms, $this->getRolePerms($this->userRoles));
		}
		//then, get the individual user permissions
		$this->perms = array_merge($this->perms, $this->getUserPerms($this->userID));	
	}
	
	function getPermKeyFromID($permID) {
		//$strSQL = "SELECT `permKey` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1″;
		$this->ci->db->select('perm_key');
		$this->ci->db->where('id', floatval($permID));
		$sql = $this->ci->db->get('prv_perm_data', 1);
		$data = $sql->result();
		return $data[0]->perm_key;
	}
	
	function getPermNameFromID($permID) {
		//$strSQL = "SELECT `permName` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1″;
		$this->ci->db->select('perm_name');
		$this->ci->db->where('id', floatval($permID));
		$sql = $this->ci->db->get('prv_perm_data', 1);
		$data = $sql->result();
		return $data[0]->perm_name;
	}
	
	function getRoleNameFromID($roleID) {
		//$strSQL = "SELECT `roleName` FROM `".DB_PREFIX."roles` WHERE `ID` = " . floatval($roleID) . " LIMIT 1″;
		$this->ci->db->select('role_name');
		$this->ci->db->where('id', floatval($roleID), 1);
		$sql = $this->ci->db->get('role_data');
		$data = $sql->result();
		return $data[0]->role_name;
	}
	
	function getUserRoles() {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."prv_user_roles` WHERE `userID` = " . floatval($this->userID) . " ORDER BY `addDate` ASC";
		
		$this->ci->db->where(array('user_id' => floatval($this->userID)));
		$this->ci->db->order_by('created', 'asc');
		$sql = $this->ci->db->get('prv_user_roles');
		$data = $sql->result();
		
		$resp = array();
		foreach ($data as $row) {
			$resp[] = $row->role_id;
		}
		return $resp;
	}
	
	function getAllRoles($format='ids') {
		$format = strtolower($format);
		//$strSQL = "SELECT * FROM `".DB_PREFIX."roles` ORDER BY `roleName` ASC";
		$this->ci->db->order_by('role_name', 'asc');
		$sql = $this->ci->db->get('role_data');
		$data = $sql->result();
		
		$resp = array();
		foreach ($data as $row) {
			if ($format == 'full') {
				$resp[] = array("id" => $row->ID, "name" => $row->roleName);
			} 
			else {
				$resp[] = $row->ID;
			}
		}
		return $resp;
	}
	
	function getAllPerms($format='ids') {
		$format = strtolower($format);
		//$strSQL = "SELECT * FROM `".DB_PREFIX."permissions` ORDER BY `permKey` ASC";
		
		$this->ci->db->order_by('perm_key', 'asc');
		$sql = $this->ci->db->get('prv_perm_data');
		$data = $sql->result();
		
		$resp = array();
		foreach ($data as $row) {
			if ($format == 'full') {
				$resp[$row->perm_key] = array('id' => $row->ID, 'name' => $row->perm_name, 'key' => $row->perm_key);
			} 
			else {
				$resp[] = $row->ID;
			}
		}
		return $resp;
	}
	
	function getRolePerms($role) {
		if (is_array($role)) {
			//$roleSQL = "SELECT * FROM `".DB_PREFIX."prv_role_perms` WHERE `roleID` IN (" . implode(",",$role) . ") ORDER BY `ID` ASC";
			$this->ci->db->where_in('role_id', $role);
		} 
		else {
			//$roleSQL = "SELECT * FROM `".DB_PREFIX."prv_role_perms` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
			$this->ci->db->where(array('role_id' => floatval($role)));
		}
		$this->ci->db->order_by('id', 'asc');
		$sql = $this->ci->db->get('prv_role_perms'); //$this->db->select($roleSQL);
		$data = $sql->result();
		$perms = array();
		foreach ($data as $row) {
			$pK = strtolower($this->getPermKeyFromID($row->perm_id));
			
			if ($pK == '') {
				continue;
			}
			/*if ($row->value == '1') {
			$hP = true;
			} else {
			$hP = false;
			}*/
			if ($row->value == '0') {
				$hP = false;
			} 
			else {
				$hP = $row->value ;
			}
		
			$perms[$pK] = array('perm' => $pK, '1inheritted' => true, 'value' => $hP, 'name' => $this->getPermNameFromID($row->perm_id), 'id' => $row->perm_id);
		}
	return $perms;
	}
	
	function getUserPerms($userID) {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."prv_user_perms` WHERE `userID` = " . floatval($userID) . " ORDER BY `addDate` ASC";
		
		$this->ci->db->where('user_id', floatval($userID));
		$this->ci->db->order_by('created', 'asc');
		$sql = $this->ci->db->get('prv_user_perms');
		$data = $sql->result();
		
		$perms = array();
		foreach ($data as $row) {
			$pK = strtolower($this->getPermKeyFromID($row->perm_id));
			if ($pK == '') {
				continue;
			}
			/*if ($row->value == '1') {
			$hP = true;
			} else {
			$hP = false;
			}*/
			if ($row->value == '0') {
				$hP = false;
			} 
			else {
				$hP = $row->value ;
			}
			
			$perms[$pK] = array('perm' => $pK, '2inheritted' => false, 'value' => $hP, 'name' => $this->getPermNameFromID($row->perm_id), 'id' => $row->perm_id);
		}
		return $perms;
	}
	
	function hasRole($roleID) {
		foreach ($this->userRoles as $k => $v) {
			if (floatval($v) === floatval($roleID)) {
				return true;
			}
		}
		return false;
	}
	
	function actionPerm($value, $wanted) {
		/* Actions::::
		* View, 8
		* Create 4
		* Update, 2
		* Delete 1
		*/
		$action['view'] = array('8', '9', '10', '12', '14', '13','11','15'); //8
		$action['create'] = array('4', '12', '14', '13', '15'); //4
		$action['update'] = array('2', '10', '14', '11', '15'); //2
		$action['delete'] = array('1', '9', '13', '11', '15'); //1
		$action['all'] = array('15');
		
		$passes = array('createproses','updateproses','deleteproses','login','inproses','logout','signup','upproses');
		//echo $value;
		//echo '<pre>';
		//print_r($action['update']);
		//echo '</pre>';
		if(in_array($wanted, $passes)) return TRUE;
		
		if (in_array($value, $action[$wanted], true)) {
			return true;
		} 
		else {
			return false;
		}
	}
	function hasPermission($permKey, $action = 'all') {
		if($permKey == '' || $permKey == 'login') {
			return true;
		}
		if($this->ci->session->userdata('userID') && $this->ci->session->userdata('userID')) {		
			$permKey = strtolower($permKey);
			
			if (array_key_exists($permKey, $this->perms)) {
				if ($this->actionPerm($this->perms[$permKey]['value'], $action)) {			
					return true;
				} 
				else {
					return false;
				}
			} 
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	public function setUpdatePrivilege($v) {
		$this->_updatePrivilege=$v;
	}
	public function setDeletePrivilege($v) {
		$this->_deletePrivilege=$v;	
	}
	public function setInsertPrivilege($v) {
		$this->_insertPrivilege=$v; 
	}
	public function getUpdatePrivilege() {
		return $this->_updatePrivilege;
	}
	public function getDeletePrivilege() {
		return $this->_deletePrivilege;
	}
	public function getInsertPrivilege() {
		return $this->_insertPrivilege;
	}
}