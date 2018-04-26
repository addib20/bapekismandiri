<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once APPPATH."/third_party/PHPExcel.php";
 
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
	function excel_to_html($file_excel){
		/*$objPHPExcel = PHPExcel_IOFactory::load($file_excel);
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		//extract to a PHP readable array format 
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$worksheetTitle     = $worksheet->getTitle();
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;
			if($highestColumn<>'A' && $highestRow>1){
				echo $worksheet->getCellByColumnAndRow(0, 1)."<br>";
				echo $worksheet->getCellByColumnAndRow(0, 2)."<br>";
				echo '<table border="1"><tr>';
				for ($row = 4; $row <= $highestRow; ++ $row) {
					echo '<tr>';
					for ($col = 0; $col < $highestColumnIndex; ++ $col) {
						$cell = $worksheet->getCellByColumnAndRow($col, $row);
						$val = $cell->getValue();
						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
						echo '<td>' . $val . '</td>';
					}
					echo '</tr>';
				}
				echo '</table>';
			}
		}*/
		
		$objPHPExcel = PHPExcel_IOFactory::load($file_excel);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
		$objWriter->setSheetIndex(0);
		// Build CSS
		$objWriter->setIsPdf(true);

		// Write headers
		//$html = $objWriter->generateStyles();

		// Write navigation (tabs)
		$html = $objWriter->generateNavigation();

		// Write data
		$html .= $objWriter->generateSheetData();

		// Write footer
		//$html .= $objWriter->generateHTMLFooter();
		return $html;
	}
}