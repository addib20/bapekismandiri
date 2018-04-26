<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('m_common');
		
    }	
	public function index()
	{
		$data='';
		$this->template->display('home',$data);
	}
	public function search(){
		$idLang=$this->session->userdata('site_lang');
		$keyword=preg_replace("/[^A-Za-z0-9 ]/", '',$_GET['keyword']);
		$qBlog="SELECT *,DATE_FORMAT(datecreated,'%d') hari,DATE_FORMAT(datecreated,'%M') bulan,DATE_FORMAT(datecreated,'%Y') tahun FROM konten WHERE tipe=23 AND publish_status=1  and bahasa_id=$idLang and ((judul LIKE '%$keyword%') or (detail LIKE '%$keyword%')) ORDER BY datecreated DESC LIMIT 10";
		$qProducts="SELECT p.*,pk.produk_kategori,pk.detail FROM produk p LEFT JOIN produk_kategori pk ON pk.produk_kategori_id = p.kategori_id
				  WHERE p.publish_status=1 and p.bahasa_id=$idLang and ((p.nama_produk LIKE '%$keyword%') or (p.detail_produk LIKE '%$keyword%') or (pk.detail LIKE '%$keyword%')or (pk.produk_kategori LIKE '%$keyword%')) Limit 10";
		$data['keyword']=$keyword;
		$data['blogs'] = $this->m_common->findAll($qBlog);
		$data['products'] = $this->m_common->findAll($qProducts);
		$this->template->display('search_result',$data);
	}
	public function contact()
	{
		if(!empty($_POST)){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama', 'Fullname', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('captcha', 'Captcha', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				//$service=$this->m_common->findAll("SELECT service_id,judul FROM services ORDER BY  judul ASC");
				$data['services'] = ""; //$service;
				$this->template->display('home',$data);
			}
			else{
				if(cek_captcha($_POST['captcha'])){
					$newsletter=isset($_POST['newsletter'])?$_POST['newsletter']:0;
					$data=array(
						'name'=>$_POST['nama'],
						'email'=>$_POST['email'],
						'subject'=>$_POST['subject'],
						'message'=>$_POST['message'],
						'datereceive'=>date('Y-m-d H:i:s')
					);
					$this->m_common->insertTable('contact_us',$data);
					redirect(base_url()."front/home/success_sent");
				}
			}
		}
		else{
			//$service=$this->m_common->findAll("SELECT service_id,judul FROM services ORDER BY  judul ASC");
			$data['services'] = "";//$service;
			$this->template->display('home',$data);
		}
	}
	public function success_sent(){
		$data['title']='Success';
		$data['message']='Thank you, Your message was sent. Please wait, We will follow up your message';
		display('themes/front/content/success_contact',$data,'themes/front/template_warning');
	}
}