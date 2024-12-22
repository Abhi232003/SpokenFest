<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('common');
		$this->load->model('Common_model');
		$this->load->library('user_agent');
		date_default_timezone_set("Asia/Calcutta");
	  }
	public function index()
	{
	    $data['aboutData'] = $this->Common_model->getrow('fx_about', array('aboutID' => 1));
		$data['ethosData'] = $this->Common_model->getrow('fx_ethos', array('ethosID' => 1));
		$data['stages'] = $this->Common_model->getRecords('fx_stages', array('status' => 1));
		$data['galleryImage'] = $this->Common_model->sort_gallery();
		$data['spokenVideos'] = $this->Common_model->getRecords('fx_spokenvideo', array('status' => 1));
		$data['spokenNews'] = $this->Common_model->getRecords('fx_news', array('status' => 1));
		$data['year'] = $this->Common_model->getRecords('fx_years', array('status' => 1));
		$this->load->view('common/header.php');
		$this->load->view('index.php',$data);
		$this->load->view('common/footer.php');


	}
	public function thankyou()
	{
	    
		$this->load->view('common/header.php');
		$this->load->view('thankyou.php');
		$this->load->view('common/footer.php');


	}
	public function book_tickets()
	{
	  
		$this->load->view('common/header.php');
		$this->load->view('booktickets.php');
		$this->load->view('common/footer.php');


	}
	public function partnerForm(){
		if (isset($_POST)) {
			$emailMatch = $this->Common_model->getRow('fx_partner', array('partnerEmail' => $this->input->post('partnerEmail')));
			if ($emailMatch) {
				echo json_encode(array('success' => 'emailMatch'));
				exit;
			}
			$mobileMatch = $this->Common_model->getRow('fx_partner', array('partnerPhone' => $this->input->post('partnerPhone')));
			if ($emailMatch) {
				echo json_encode(array('success' => 'mobileMatch'));
				exit;
			}
			$userData = array(
				'partnerName' => $_POST['partnerName'],
				'partnerEmail' => $_POST['partnerEmail'],
				'partnerPhone' =>$_POST['partnerPhone'],
				'partnerType' =>$_POST['partnerType'],
				'partnerComment' => $_POST['partnerComment'],
				'dateAdded' => date('Y-m-d h:i:s'),
				'dateModified' => date('Y-m-d h:i:s')
			);
			$Data = $this->security->xss_clean($userData);
			$result = $this->Common_model->insertRecord('fx_partner', $Data);
			if ($result > 0) 
			{
				echo json_encode(array('success' => 'ok'));exit;
			} else {
				echo json_encode(array('success' => 'err'));exit;
			}
		}

	}
 

	public function site_lang($site_lang) {
		echo $site_lang;
		echo '<br>';
		echo 'you will be redirected to :'.$_SERVER['HTTP_REFERER'];
		$language_data = array(
			'site_lang' => $site_lang
		);

		$this->session->set_userdata($language_data);
		if ($this->session->userdata('site_lang')) {
			echo 'user session language is = '.$this->session->userdata('site_lang');
		}
		redirect($_SERVER['HTTP_REFERER']);

		exit;
	}
}
