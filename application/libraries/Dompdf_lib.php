<?php

class Dompdf_lib {
    
	var $_dompdf = NULL;
	
	function __construct()
	{
		require_once("dompdf/dompdf_config.inc.php");
		if(is_null($this->_dompdf)){
			$this->_dompdf = new DOMPDF();
		}
	}
	
	function convert_html_to_pdf($html, $filename ='', $stream = TRUE) 
	{
		$this->_dompdf->load_html($html);
		$this->_dompdf->render();
		if ($stream) {
			$this->_dompdf->stream($filename, array("Attachment" => 0));
		} else {
			return $this->_dompdf->output();
		}
	}
	function save_pdf($html,$file_location){
		$this->_dompdf->load_html($html);
		$this->_dompdf->render();
		$output = $this->_dompdf->output();
		file_put_contents($file_location,$output); 
	}
	
}
?>