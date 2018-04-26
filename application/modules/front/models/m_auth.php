<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function cek_login($usr,$pwd)
	{
		$this->db->where("nama_pengguna",$usr);
		$this->db->where("sandi",hash('sha256', md5($pwd).'s1mp3l'));
		$this->db->where("aktif",1);
 		$query=$this->db->get("prv_user");
		return $query;
	}
	public function cek_role($user_id)
	{
		$sql = "SELECT r.role_name,r.id FROM prv_user_roles ur
				LEFT JOIN prv_role_data r ON ur.role_id=r.id
				WHERE ur.user_id = '".$user_id."'";
		return $this->db->query($sql);
	}
	public function cek_cabang($user_id,$role_id)
	{
		if($role_id==2){
			$where = " AND pic_training IN('".$user_id."')";
		}
		else if($role_id==3){
			$where = " AND pincab IN('".$user_id."')";
		}
		else if($role_id==5){
			$where = " AND wapincab IN('".$user_id."')";
		}
		else{
			$where = " AND cabang_id= '70'";
		}
		$sql = "SELECT cabang_id,cabang FROM pel_cabang
				WHERE status = '1' ".$where;
		return $this->db->query($sql);
	}
	public function update_login($usr,$pwd)
	{
		$strtime = strtotime(date("Y-m-d H:i:s"));
		$data = array(
				'login_status'=>1,
				'login_session'=>md5($strtime.$pwd.'s1mp3l'),
				'last_login'=>date("Y-m-d H:i:s")
				);
		$this->db->where("nama_pengguna",$usr);
		$this->db->where("sandi",hash('sha256', md5($pwd).'s1mp3l'));
		$this->db->where("aktif",1);
		$this->db->update('prv_user', $data);
		return $data['login_session'];
	}
	public function update_logout($log_sess){
		$data = array(
				'login_status'=>0,
				'login_session'=>''
				);
		$this->db->where("login_session",$log_sess);
		$this->db->update('prv_user', $data);
		return TRUE;
	}
}