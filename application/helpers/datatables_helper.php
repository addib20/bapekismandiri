<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('convert_publish'))
{
	function convert_publish($var)
    {
        $hasil = ($var==1)? "Publish": "Tidak Publish";
        return $hasil;
    }
}
if (!function_exists('convert_aktif'))
{
	function convert_aktif($var)
    {
        $hasil = ($var==1)? "Aktif": "Tidak AKtif";
        return $hasil;
    }
}
if (!function_exists('convert_delete'))
{
	function convert_delete($var)
    {
        $hasil = ($var==1)? "Sudah Dihapus": "Aktif";
        return $hasil;
    }
}
if (!function_exists('convert_booking'))
{
	function convert_booking($var)
    {
    	if($var==0){
    		$hasil='<span class="label label-warning">Menunggu Pembayaran</span>';
    	}
		else if($var==1){
			
			$hasil='<span class="label label-success">Sudah Lunas</span>';
		}
		else{
			$hasil='<span class="label label-danger">Cancel</span>';
		}
		
        return $hasil;
    }
}
if (!function_exists('convert_YN'))
{
	function convert_YN($var)
    {
        $hasil = ($var==1)? "Ya": "Tidak";
        return $hasil;
    }
}
if (!function_exists('formatDate'))
{
	function formatDate($date,$time=false)
    {
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
			$hasil .= $time == true ? ' '.date('G:i:s',strtotime($date)) : '';
			return empty($date) ? '-' : $hasil;;
    }
}
if (!function_exists('formatDate2'))
{
	function formatDate2($date,$time=false)
    {
		$hasil = $hasil = date('d/m/Y',strtotime($date));
		$hasil .= $time == true ? ' '.date('G:i:s',strtotime($date)) : '';
		return empty($date) ? '-' : $hasil;
    }
}
if (!function_exists('formatPeriod'))
{
	function formatPeriod($date)
    {
		$hasil = $hasil = date('F Y',strtotime($date));
		return empty($date) ? '-' : $hasil;;
    }
}
if (!function_exists('formatDate3'))
{
	function formatDate3($date1,$date2,$time=false)
    {
    	$strdate1 = strtotime($date1);
		$strdate2 = strtotime($date2);
    	if($strdate1 == $strdate2 || $date2 == '0000-00-00'){
    		$hasil = date('d F Y',strtotime($date1));
    	}
		else{
			$hasil = date('d F Y',strtotime($date1));
			$hasil = $hasil." - ".date('d F Y',strtotime($date2));
			
		}
		$hasil .= $time == true ? ' '.date('G:i:s',strtotime($date1)) : '';
		return empty($date1) ? '-' : $hasil;
    }
}
if (!function_exists('formatDate4'))
{
	function formatDate4($date,$time=false)
    {
		$hasil = $hasil = date('d F Y',strtotime($date));
		$hasil .= $time == true ? ' '.date('G:i:s',strtotime($date)) : '';
		return empty($date) ? '-' : $hasil;
    }
}
if (!function_exists('dateRange'))
{
	function dateRange($date1,$date2)
    {
		$CI =&get_instance();
		$hasil = $CI->datecalc->penanggalan($date1,$date2);
		return $hasil;
    }
}
if (!function_exists('formatRP'))
{
	function formatRP($var)
    {
			$hasil = number_format($var, 0, ',', '.');
			return $hasil;
    }
}
if (!function_exists('cekPermission'))
{
	function cekPermission($id)
    {
			$CI =&get_instance();
			$param = $CI->uri->segment(2);
			$module = $CI->uri->segment(1);
			$edit_button = $CI->acl->hasPermission($param,'update') ? '<li><a href="'.site_url($module."/".$param."/edit_form/".$id).'">Edit Row</a></li>' : '';
			$delete_button = $CI->acl->hasPermission($param,'delete') ? '<li><a class="del_row_'.$id.'" href="'.site_url($module."/".$param."/delete_form/".$id).'" onclick="delete_row('.$id.',event)">Delete Row</a></li>' : '';
			
			if(empty($edit_button) && empty($delete_button)){
				$hasil = 'You Do not Have Access this Action';
			}
			else{
				$hasil = '<div class="btn-group">
						  <button data-toggle="dropdown" class="btn btn-primary btn-small dropdown-toggle">Action <span class="caret"></span></button>
						  <ul class="dropdown-menu pull-right">'.$edit_button.$delete_button.'</ul>
						</div>';
			}
			return $hasil;
    }
}
if (!function_exists('cekPermissionMemo'))
{
	function cekPermissionMemo($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$edit_button = $CI->acl->hasPermission($param,'update') ? '<li><a href="'.site_url($module."/".$param."/edit_form/".$id).'">Edit Row</a></li>' : '';
		$delete_button = $CI->acl->hasPermission($param,'delete') ? '<li><a class="del_row_'.$id.'" href="'.site_url($module."/".$param."/delete_form/".$id).'" onclick="delete_row('.$id.',event)">Delete Row</a></li>' : '';
		
		$q = 'SELECT approve,approve_date,status,file_approve_ppl FROM pel_pengajuan_kegiatan where pengajuan_kegiatan_id = '.$id;
		$data_memo=$CI->m_common->get_data_sql($q)->row_array();
		
		if(empty($edit_button) && empty($delete_button) && $data_memo['status'] > 1){
			$hasil = 'You Do not Have Access this Action <br \>
						<a target="_blank" title="Cetak Memo" href="'.site_url('cetak/memo/'.$id).'" class="btn btn-mini"><i class="icon-print"></i></a>';
		}
		else if(empty($edit_button) && empty($delete_button)){
			$hasil = 'You Do not Have Access this Action';
		}
		else{
			if($data_memo['approve'] > 0){
				$apprv = ($data_memo['approve']==1)? "Sudah disetujui": "Tidak disetujui";
				$hasil = '<strong>'.$apprv.'</strong><br /><a target="_blank" title="Cetak Memo" href="'.site_url('cetak/memo/'.$id).'" class="btn btn-mini"><i class="icon-print"></i></a>';
			}
			else{
				$hasil = '<div class="btn-group">
					  <button data-toggle="dropdown" class="btn btn-primary btn-small dropdown-toggle">Action <span class="caret"></span></button>
					  <ul class="dropdown-menu pull-right">'.$edit_button.$delete_button.'</ul>
					</div>';
			}
		}
		$hasil .= (!empty($data_memo['file_approve_ppl'])) ? '<a target="_blank" title="Download Persetujuan" href="'.site_url('download/modul?id='.$id.'&tipe=file_approve_ppl').'" class="btn btn-mini"><i class="icon-download-alt"></i></a>' : ''; 
		return $hasil;
    }
}
if (!function_exists('cekPermissionRealisasi'))
{
	function cekPermissionRealisasi($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$edit_button = $CI->acl->hasPermission($param,'update') ? '<li><a href="'.site_url($module."/".$param."/edit_form/".$id).'">Edit Row</a></li>' : '';
		$delete_button = $CI->acl->hasPermission($param,'delete') ? '<li><a class="del_row_'.$id.'" href="'.site_url($module."/".$param."/delete_form/".$id).'" onclick="delete_row('.$id.',event)">Delete Row</a></li>' : '';
		
		$q = 'SELECT verify,approved,status,file_persetujuan FROM pel_realisasi_kegiatan where realisasi_kegiatan_id = '.$id;
		$data_memo=$CI->m_common->get_data_sql($q)->row_array();
		
		if(empty($edit_button) && empty($delete_button) && $data_memo['status'] > 1){
			$hasil = 'You Do not Have Access this Action<br \>
						<a target="_blank" href="'.site_url('cetak/pertanggungjawab/'.$id).'" class="btn btn-mini"><i class="icon-print"></i></a>';
		}
		else if(empty($edit_button) && empty($delete_button)){
			$hasil = 'You Do not Have Access this Action';
		}
		elseif ($data_memo['status'] > 1){
			$hasil = '<strong>Tidak Bisa dirubah</strong><br \>
					<a target="_blank" href="'.site_url('cetak/pertanggungjawab/'.$id).'" class="btn btn-mini"><i class="icon-print"></i></a>';
		}
		else{
			$hasil = '<div class="btn-group">
				  <button data-toggle="dropdown" class="btn btn-primary btn-small dropdown-toggle">Action <span class="caret"></span></button>
				  <ul class="dropdown-menu pull-right">'.$edit_button.$delete_button.'</ul>
				</div>';
		}
		$hasil .= (!empty($data_memo['file_persetujuan'])) ? '<a target="_blank" title="Download Persetujuan" href="'.site_url('download/lpj?id='.$id.'&tipe=file_persetujuan').'" class="btn btn-mini"><i class="icon-download-alt"></i></a>' : ''; 
		return $hasil;
    }
}
if (!function_exists('cekPermissionUpload'))
{
	function cekPermissionUpload($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$upload_peserta_button = $CI->acl->hasPermission($param,'update') ? '<a title="Upload Data Peserta" href="javascript:void(0)" onclick="send_peserta('.$id.');" class="btn btn-mini btn-info"><i class="fa fa-upload"></i> Peserta</a>' : '';
		$upload_pemateri_button = $CI->acl->hasPermission($param,'update') ? '<a id="upload_data" title="Upload Data Pemateri" href="'.site_url('report/upload_hris/pemateri?id='.$id).'" class="btn btn-mini btn-info"><i class="fa fa-upload"></i> Pemateri</a>' : '';
		
		$q = 'SELECT upload_peserta_sts,upload_pemateri_sts FROM pel_realisasi_kegiatan where realisasi_kegiatan_id = '.$id;
		$data_upload=$CI->m_common->get_data_sql($q)->row_array();
		
		if(empty($upload_peserta_button) || empty($upload_pemateri_button)){
			$hasil = 'You Do not Have Access this Action';
		}
		else{
			$button_upload_peserta = $data_upload['upload_peserta_sts']==0 ? $upload_peserta_button : "Sudah Upload";
			$button_upload_pemateri = $data_upload['upload_pemateri_sts']==0 ? $upload_pemateri_button : "Sudah Upload";
			$hasil = $button_upload_peserta."&nbsp;".$button_upload_pemateri;
		}
		return $hasil;
    }
}
if (!function_exists('cekPermissionApprove'))
{
	function cekPermissionApprove($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$edit_button = $CI->acl->hasPermission($param,'update') ? '<a href="'.site_url($module."/".$param."/edit_form/".$id).'" class="btn btn-inverse add-button"><i class="glyphicon glyphicon-plus"></i> Approve Atasan</a>' : '';
		
		if(empty($edit_button)){
			$hasil = 'You Do not Have Access this Action';
		}
		else{
			$hasil = $edit_button;
		}
		return $hasil;
    }
}
if (!function_exists('cekPermissionValidasi'))
{
	function cekPermissionValidasi($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$edit_button = $CI->acl->hasPermission($param,'update') ? '<a href="'.site_url($module."/".$param."/edit_form/".$id).'" class="btn btn-inverse add-button"><i class="glyphicon glyphicon-plus"></i> Validasi</a>' : '';
		
		if(empty($edit_button)){
			$hasil = 'You Do not Have Access this Action';
		}
		else{
			$hasil = $edit_button.'<a target="_blank" href="'.site_url('cetak/memo/'.$id).'" class="btn btn-primary add-button"><i class="icon-print"></i> Cetak</a>';
		}
		return $hasil;
    }
}
if (!function_exists('cekPermissionVerfikasi'))
{
	function cekPermissionVerfikasi($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$edit_button = $CI->acl->hasPermission($param,'update') ? '<a href="'.site_url($module."/".$param."/edit_form/".$id).'" class="btn btn-inverse add-button"><i class="glyphicon glyphicon-plus"></i> Verfikasi</a>' : '';
		
		if(empty($edit_button)){
			$hasil = 'You Do not Have Access this Action';
		}
		else{
			$hasil = $edit_button.'<a target="_blank" href="'.site_url('cetak/pertanggungjawab/'.$id).'" class="btn btn-primary add-button"><i class="icon-print"></i> Cetak</a>';
		}
		return $hasil;
    }
}
if (!function_exists('cekPermissionPersetujuan'))
{
	function cekPermissionPersetujuan($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$edit_button = $CI->acl->hasPermission($param,'update') ? '<a href="'.site_url($module."/".$param."/edit_form/".$id).'" class="btn btn-inverse add-button"><i class="glyphicon glyphicon-plus"></i> Approve Pusat</a>' : '';
		
		if(empty($edit_button)){
			$hasil = 'You Do not Have Access this Action';
		}
		else{
			$hasil = $edit_button;
		}
		return $hasil;
    }
}
if (!function_exists('statusPengajuan'))
{
	function statusPengajuan($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$btn_add = $CI->acl->hasPermission($param,'create') ? '<a href="'.site_url($module."/".$param."/add_trainer/".$id).'" class="btn btn-inverse add-button"><i class="glyphicon glyphicon-plus"></i> Add</a>' : '';
		
		$q = 'SELECT approve,register,approve_ppl,status FROM pel_pengajuan_kegiatan where pengajuan_kegiatan_id = '.$id;
		$data_status=$CI->m_common->get_data_sql($q)->row_array();
		
		if($data_status['status'] == 1 || $data_status['status'] == 0){
			$hasil = "Pengajuan baru dibuat";
		}
		elseif($data_status['status'] == 2 ){
			if($data_status['approve'] == 1){
				$hasil = "Pengajuan disetujui Pinca";
			}
			elseif($data_status['approve'] == 2){
				$hasil = "Pengajuan tidak disetujui Pinca";
			}
		}
		elseif($data_status['status'] == 3 ){
			if($data_status['register'] == 1){
				$hasil = "Data Pengajuan Valid";
			}
			elseif($data_status['register'] == 2){
				$hasil = "Data Pengajuan harus direvisi";
			}
		}
		elseif($data_status['status'] == 4 ){
			if($data_status['approve_ppl'] == 1){
				$hasil = "Data Pengajuan disetujui Pusat";
			}
			elseif($data_status['approve_ppl'] == 2){
				$hasil = "Data Pengajuan tidak disetujui Pusat";
			}
		}
		return $hasil;
    }
}
if (!function_exists('cekTrainer'))
{
	function cekTrainer($id)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$btn_add = $CI->acl->hasPermission($param,'create') ? '<a href="'.site_url($module."/".$param."/add_trainer/".$id).'" class="btn btn-inverse add-button"><i class="glyphicon glyphicon-plus"></i> Add</a>' : '';
		
		$q = 'SELECT count(*) as jumlah_trainer FROM pel_pengajuan_trainer where pengajuan_kegiatan_id = '.$id;
		$data_trainer=$CI->m_common->get_data_sql($q)->row_array();
		
		if($data_trainer['jumlah_trainer'] > 0 ){
			$hasil = $data_trainer['jumlah_trainer'];
		}
		else{
			$hasil = $btn_add;
		}
		return $hasil;
    }
}
if (!function_exists('cekRealisasiTrainer'))
{
	function cekRealisasiTrainer($id,$no_memo)
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		
		$query = 'SELECT pengajuan_kegiatan_id FROM pel_pengajuan_kegiatan where no_memo = "'.$no_memo.'"';
		$data_pengajuan=$CI->m_common->get_data_sql($query)->row_array();
		
		$btn_add = $CI->acl->hasPermission($param,'create') ? '<a href="'.site_url($module."/".$param."/add_trainer/".$data_pengajuan['pengajuan_kegiatan_id']).'" class="btn btn-inverse add-button"><i class="glyphicon glyphicon-plus"></i> Add</a>' : '';
		
		$q = 'SELECT count(*) as jumlah_trainer FROM pel_realisasi_trainer where realisasi_kegiatan_id = '.$id;
		$data_trainer=$CI->m_common->get_data_sql($q)->row_array();
		
		if($data_trainer['jumlah_trainer'] > 0 ){
			$hasil = " Jumlah Trainer ".$data_trainer['jumlah_trainer'];
		}
		else{
			$hasil = $btn_add;
		}
		return $hasil;
    }
}
if (!function_exists('cekPermissionAdd'))
{
	function cekPermissionAdd()
    {
		$CI =&get_instance();
		$param = $CI->uri->segment(2);
		$module = $CI->uri->segment(1);
		$btn_add = $CI->acl->hasPermission($param,'create') ? '<a href="'.site_url($module."/".$param."/add_form").'" class="btn btn-inverse add-button"><i class="glyphicon glyphicon-plus"></i> Add</a>' : '';
		$hasil = $btn_add.'&nbsp;<button type="button" class="btn btn-inverse">Export</button>';
		return $hasil;
    }
}
if (!function_exists('cekPelamar'))
{
	function cekPelamar($id)
    {
			$CI =&get_instance();
			$CI->load->model('m_admin_content');
			$param = $CI->uri->segment(2);
			
			$edit_button = $CI->acl->hasPermission($param,'update') ? '<li><a href="'.site_url("admin/".$param."/edit_form/".$id).'">Edit Row</a></li>' : '';
			$delete_button = $CI->acl->hasPermission($param,'delete') ? '<li><a class="del_row_'.$id.'" href="'.site_url("admin/".$param."/delete_form/".$id).'" onclick="delete_row('.$id.',event)">Delete Row</a></li>' : '';
			$pelamar_button = '<li><a href="'.site_url("admin/".$param."/detail/".$id).'">Detail<br>Pelamar</a></li>';
			
			if(empty($edit_button) && empty($delete_button) && empty($pelamar_button)){
				$hasil = 'You Do not Have Access this Action';
			}
			else{
				$hasil = '<div class="btn-group">
						  <button data-toggle="dropdown" class="btn btn-primary btn-small dropdown-toggle">Action <span class="caret"></span></button>
						  <ul class="dropdown-menu">'.$edit_button.$pelamar_button.$delete_button.'</ul>
						</div>';
			}
			return $hasil;
    }
}
if (!function_exists('formatJenisMateri'))
{
	function formatJenisMateri($jenis_id)
    {
		$klasifikasi="";
		if($jenis_id == "1"){
			$klasifikasi = "Materi Pengatar";
		}
		if($jenis_id == "2"){
			$klasifikasi = "Materi Pokok";
		}
		if($jenis_id == "3"){
			$klasifikasi = "Materi Pelengkap";
		}
		if($jenis_id == "4"){
			$klasifikasi = "Materi Kebijakan";
		}
		
		return $klasifikasi;	
    }
}
if (!function_exists('formatCabang'))
{
	function formatCabang($cabang_id)
    {
		$CI =&get_instance();
		$CI->load->model('m_common');
		$q = 'SELECT cabang FROM pel_cabang where cabang_id = '.$cabang_id;
		$cabang=$CI->m_common->get_data_sql($q)->row_array();
		
		
		$hasil = (isset($cabang['cabang'])?$cabang['cabang']:"") ;
		return $hasil;	
    }
}
if (!function_exists('getPelamar'))
{
	function getPelamar($id)
    {
		$CI =&get_instance();
		$CI->load->model('m_admin_content');
		$q = 'SELECT count(id_applicant) as pelamar FROM c_vacancy_applicant where id_vacancy = '.$id;
		$applicant=$CI->m_admin_content->get_data_sql($q)->row_array();
		
		$hasil = $applicant['pelamar'];
		return $hasil;	
    }
}
if (!function_exists('cekPermissionKirim'))
{
	function cekPermissionKirim($id)
    {
			$CI =&get_instance();
			$param = $CI->uri->segment(2);
			
			$edit_button = $CI->acl->hasPermission($param,'update') ? '<a href="'.site_url("admin/".$param."/resend_email/".$id).'" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Resend</a>' : '';
			
			if(empty($edit_button) && empty($delete_button)){
				$hasil = 'You Do not Have Access this Action';
			}
			else{
				$hasil = $edit_button;
			}
			return $hasil;
    }
}
if (!function_exists('cekPermissionSend'))
{
	function cekPermissionSend($id)
    {
			$CI =&get_instance();
			$param = $CI->uri->segment(2);
			
			$edit_button = $CI->acl->hasPermission($param,'update') ? '<a href="'.site_url("admin/".$param."/edit_form/".$id).'" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Reply</a>' : '';
			
			if(empty($edit_button) && empty($delete_button)){
				$hasil = 'You Do not Have Access this Action';
			}
			else{
				$hasil = $edit_button;
			}
			return $hasil;
    }
}
if (!function_exists('str_cut'))
{
	function str_cut($var)
    {
			$CI =&get_instance();
			$max_word_deskripsi = 150;
			$string = strip_tags($var);
			if (strlen($string) > $max_word_deskripsi)
			{
			    $string = wordwrap($string, $max_word_deskripsi);
			    $i = strpos($string, "\n");
			    if ($i) {
			        $string = substr($string, 0, $i).'...';
			    }
			}
			return $string;
    }
}
if (!function_exists('getDetail'))
{
	function getDetail($id,$val)
    {
			$CI =&get_instance();
			$hasil = '<span class="popover-peserta">'.$val.'</span>';
			return $hasil;
    }
}
if (!function_exists('stat_faq'))
{
	function stat_faq($var)
    {
		$hasil = ($var==1)? "<span class='label label-success'>Sudah dibalas</span>": "<span class='label label-warning'>Belum dibalas</span>";
        return $hasil;
    }
}
if (!function_exists('stat_newsletter'))
{
	function stat_newsletter($var)
    {
		$hasil = ($var==1)? "<span class='label label-success'>Sudah dikirim</span>": "<span class='label label-warning'>Belum dikirim</span>";
        return $hasil;
    }
}
if (!function_exists('stat_comment'))
{
	function stat_comment($var)
    {
		$hasil = ($var==1)? "<span class='label label-success'>Publish</span>": "<span class='label label-warning'>Unpublish</span>";
        return $hasil;
    }
}
if (!function_exists('cek_event_report'))
{
	function cek_event_report($var)
    {
    	$CI =&get_instance();
		$s = explode("-", $var);
		$hasil = '';
		if(strtolower($s[0])=='event'){
			$data_event = $CI->m_priv->get_data_by_id('event','id',$s[1])->row_array();
			$hasil = "Event : ".ucwords($data_event["judul_event"]);
		}
		elseif(strtolower($s[0])=='report'){
			$data_report = $CI->m_priv->get_data_by_id('event_report','id',$s[1])->row_array();
			$hasil = "Report : ".ucwords($data_report["judul_report"]);
		}
		elseif(strtolower($s[0])=='berita'){
			$data_report = $CI->m_priv->get_data_by_id('berita','id',$s[1])->row_array();
			$hasil = "Berita : ".ucwords($data_report["judul_berita"]);
		}
		elseif(strtolower($s[0])=='galeri'){
			$data_report = $CI->m_priv->get_data_by_id('galeri_event','id',$s[1])->row_array();
			$hasil = "Galeri : ".ucwords($data_report["judul"]);
		}
		return $hasil;
    }
}
if (!function_exists('convert_kategori'))
{
	function convert_kategori($var)
    {
        $hasil = ($var==1)? "Portofolio": "Gallery";
        return $hasil;
    }
}
if (!function_exists('getUser'))
{
	function getUser($id)
    {
    	$CI =&get_instance();
		$hasil = '';
		if($id>0){
			$data_user = $CI->m_common->get_data_by_id('prv_user','id_pengguna',$id)->row_array();
			$hasil = $data_user["nama_lengkap"];
		}
		else{
			$hasil = "-";
		}
		
		return $hasil;
    }
}