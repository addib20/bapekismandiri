<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class datecalc{
	private $_ci;
	function __construct() {
		$this->_ci=&get_instance();
	} 
	function comparedate($date1, $date2){
    	$d = strtotime($date1);
	  	$gregorian1 = gregoriantojd(date('m',$d),date('d',$d),date('Y',$d));	  
      	$t = strtotime($date2);
      	$gregorian2 = gregoriantojd(date('m',$t),date('d',$t),date('Y',$t));
      	$diff = $gregorian2 - $gregorian1;
      	return $diff;
	}
	function datepanjang($date = false, $style = 'hbt', $time = false) {
		$date = $date == false ? date('Y-m-d') : $date;
		$style = strtolower($style);
		if($style == 'hhbt') {
			$hari = date('w',strtotime($date));
			switch($hari){     
		        case 0: 
		        	$hari='Minggu';
		        	break;
		        case 1: 
		        	$hari='Senin';
		        	break;
				case 2: 
		        	$hari='Selasa';
		        	break;
				case 3: 
		        	$hari='Rabu';
		        	break;
				case 4: 
		        	$hari='Kamis';
		        	break;
				case 5: 
		        	$hari='Jumat';
		        	break;
				case 6: 
		        	$hari='Sabtu';
		        	break;
		        default:
		        	$hari='UnKnown';
		        	break;
		    }
			$hasil = $hari.', '.date('d F Y',strtotime($date));
		}
		elseif($style == 'dhbt') {
			$hari = date('w',strtotime($date));
			switch($hari){     
		        case 0: 
		        	$hari='Minggu';
		        	break;
		        case 1: 
		        	$hari='Senin';
		        	break;
				case 2: 
		        	$hari='Selasa';
		        	break;
				case 3: 
		        	$hari='Rabu';
		        	break;
				case 4: 
		        	$hari='Kamis';
		        	break;
				case 5: 
		        	$hari='Jumat';
		        	break;
				case 6: 
		        	$hari='Sabtu';
		        	break;
		        default:
		        	$hari='UnKnown';
		        	break;
		    }
			$hasil = $hari.', '.date('d/m/Y',strtotime($date));
		}
		elseif($style == 'hbt') {
			$hasil = date('d F Y',strtotime($date));
		}
		elseif($style == 'hbtin') {
			$bul = $this->get_bulan($date);
			$hari = date("d",strtotime($date));
			$tahun = date("Y",strtotime($date));
			//$hasil = date('d F Y',strtotime($date));
			$hasil = $hari." ".$bul." ".$tahun;
		}
		elseif($style == 'hmt') {
			$hasil = date('d M Y',strtotime($date));
		}
		elseif($style == 'bt') {
			$hasil = date('F Y',strtotime($date));
		}
		elseif($style == 'sql') {
			$hasil = date('Y-m-d',strtotime($date));
		}
		elseif($style == 'uk') {
			$hasil = date('d/m/Y',strtotime($date));
		}
		elseif($style == 'us') {
			$hasil = date('m/d/Y',strtotime($date));
		}
		elseif($style == 'idn') {
			$hasil = date('d-m-Y',strtotime($date));
		}
		elseif($style == 'url') {
			$hasil = date('Y/m/d',strtotime($date));
		}
		else {
			$hasil = date('d F Y',strtotime($date));
		}
		$hasil .= $time == true ? ' '.date('G:i:s',strtotime($date)) : '';
		return $hasil;
	}
	function penanggalan($date1, $date2){
		$hari_1 = date("d",strtotime($date1));
		$hari_2 = date("d",strtotime($date2));
		
		$bulan_1 = date("m",strtotime($date1));
		$bulan_2 = date("m",strtotime($date2));
		
		$tahun_1 = date("Y",strtotime($date1));
		$tahun_2 = date("Y",strtotime($date2));
		if($hari_1==$hari_2 && $bulan_1==$bulan_2){
			$bul = $this->get_bulan($date1);
			$hasil = $hari_1." ".$bul." ".$tahun_1;
		}
		else if($bulan_1 == $bulan_2){
			$bul = $this->get_bulan($date1);
			$hasil = $hari_1." - ".$hari_2." ".$bul." ".$tahun_1;
		}
		else{
			$bul_1 = $this->get_bulan($date1);
			$bul_2 = $this->get_bulan($date2);
			$hasil = $hari_1." ".$bul_1." ".$tahun_1." - ".$hari_2." ".$bul_2." ".$tahun_2;
		}
		return $hasil;
	}
	function get_bulan ($date){
		$bul = date("n",strtotime($date));
		switch($bul){
			case 1: 
				$bul='Januari';
				break;
			case 2: 
				$bul='Februari';
				break;
			case 3: 
				$bul='Maret';
				break;
			case 4: 
				$bul='April';
				break;
			case 5: 
				$bul='Mei';
				break;
			case 6: 
				$bul='Juni';
				break;
			case 7: 
				$bul='Juli';
				break;
			case 8: 
				$bul='Agustus';
				break;
			case 9: 
				$bul='September';
				break;
			case 10: 
				$bul='Oktober';
				break;
			case 11: 
				$bul='November';
				break;
			case 12: 
				$bul='Desember';
				break;
			default:
				$bul='UnKnown';
				break;
		}
		return $bul;
	}
}