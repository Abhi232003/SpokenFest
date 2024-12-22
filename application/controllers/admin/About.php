<?php defined('BASEPATH') OR exit('No direct script access allowed');
class About extends MY_Controller {
	public function __construct(){
		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Common_model','Common_model');
	}
	public function index(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/about/about_edit');
		$this->load->view('admin/includes/_footer');
	}
	public function edit($id = 0){
		//$this->rbac->check_operation_access(); // check opration permission
		if($this->input->post('submit')){
			$this->form_validation->set_rules('aboutDescription', 'About description', 'trim|required');
			$this->form_validation->set_rules('aboutDays', 'About day', 'trim|required');
			$this->form_validation->set_rules('aboutStages', 'About stages', 'trim|required');
			$this->form_validation->set_rules('aboutArtists', 'About artists', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/about/edit/'.$id),'refresh');
			}else{
				$data = array(
				    'aboutDescription' => str_replace(['<p>', '</p>'],'',$this->input->post('aboutDescription')),
				    'aboutDays' => $this->input->post('aboutDays'),
				    'aboutArtists' => $this->input->post('aboutArtists'),
					'aboutStages' => $this->input->post('aboutStages'),
					'aboutHeartbeats' => $this->input->post('aboutHeartbeats'),
					'metaTitle' => $this->input->post('metaTitle'),
					'metaKeyword' => $this->input->post('metaKeyword'),
					'metaContent' => $this->input->post('metaContent'),
					'dateModified' => date('Y-m-d h:i:s'),
				);
				$params = $this->security->xss_clean($data);
				$where = ['aboutID' => $id];
				$result = $this->Common_model->updateRecord('fx_about', $params, $where);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'About  has been updated successfully!');
					redirect(base_url('admin/about/edit/1'));
				}
			}
		}else{
			$data['about'] = $this->Common_model->getRow('fx_about',array('aboutID'=>$id));
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/about/about_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}
	public function file_check1()
	{
		if(empty($_FILES['about_image']['name'][0]))
		{
			$this->form_validation->set_message('file_check1','Image is required');
			return false;
		}else
		{
			return true;
		}
	}
}
?>