<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class hris{
	private $_ci;
	function __construct() {
		$this->_ci=&get_instance();
	} 
	function data_history_training ($nik){
		$appkey = "feJUt6H4Es8JrNThYvnEEIuDad8ru9ZuwEzm4eTLA1TDLNvahv";
		$json = file_get_contents("https://pnmsdm01:8888/training.json?appkey=" . $appkey . "&nip=" . $nik);
		$obj = json_decode($json);
		$data_history = array();
		for ($i = 0; $i < count($obj->DATA); $i++) {
			for ($j = 0; $j < count($obj->DATA[$i]); $j++) {
				$data_history[$i][$obj->COLUMNS[$j]] = $obj->DATA[$i][$j];
			}
		}
		return $data_history;
	}
	function data_employee_hris($nik){
		$appkey = "feJUt6H4Es8JrNThYvnEEIuDad8ru9ZuwEzm4eTLA1TDLNvahv";
		$json = file_get_contents("https://pnmsdm01:8888/employee.json?appkey=" . $appkey . "&nip=" . $nik);
		$obj = json_decode($json);
		$data_employee = array();
		for ($i = 0; $i < count($obj->DATA); $i++) {
			for ($j = 0; $j < count($obj->DATA[$i]); $j++) {
				$data_employee[$i][$obj->COLUMNS[$j]] = $obj->DATA[$i][$j];
			}
		}
		return $data_employee;
	}
	function upload_peserta($data_peserta){
		$data_upload = array();
		for($i=0;$i<count($data_peserta);$i++){
			$employee = $this->data_employee_hris($data_peserta[$i]["nik"]);
			$data_upload[$i]["ID"] = $employee[0]["ID"];
			$data_upload[$i]["training"] = $data_peserta[$i]["training"];
			$data_upload[$i]["jam"] = $data_peserta[$i]["jam"];
			$data_upload[$i]["skor"] = "";
			$data_upload[$i]["nilai"] = $data_peserta[$i]["nilai"];
			$data_upload[$i]["batch"] = $data_peserta[$i]["batch"];
			$data_upload[$i]["tahun"] = $data_peserta[$i]["tahun"];
			$data_upload[$i]["keterangan"] = $data_peserta[$i]["keterangan"];
		}
		return $data_upload;
	}
}