<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Ethos extends MY_Controller {
	public function __construct(){
		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Common_model','Common_model');
	}
	public function index(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/ethos/ethos_edit');
		$this->load->view('admin/includes/_footer');
	}
	public function edit($id = 0){
		//$this->rbac->check_operation_access(); // check opration permission
		if($this->input->post('submit')){
			$this->form_validation->set_rules('ethosHeading', 'ethos description', 'trim|required');
			$this->form_validation->set_rules('ethosCreativityDescription', 'ethos day', 'trim|required');
			$this->form_validation->set_rules('ethosSafetyDescription', 'ethos stages', 'trim|required');
			$this->form_validation->set_rules('ethosSustainabilityDescription', 'ethos artists', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/ethos/edit/'.$id),'refresh');
			}else{
				$data = array();
				$config['upload_path'] = "./uploads/ethos/";
				$config['allowed_types'] = "gif|png|jpg|jpeg";

				$this->load->library('upload',$config);

				if (!$this->upload->do_upload('ethosImageOne')) 
				{
					if (empty($_FILES['ethosImageOne']['name'])) 
					{
						$_POST['ethosImageOne'] = $_POST['old_image'];
						$data['error'] = $this->upload->display_errors();
					}
				}else 
				{
					$dt = $this->upload->data();
					$_POST['ethosImageOne'] = $dt['file_name'];
					$params['ethosImageOne'] = $dt['file_name'];
				}

				if (!$this->upload->do_upload('ethosImageTwo')) 
				{
					if (empty($_FILES['ethosImageTwo']['name'])) 
					{
						$_POST['ethosImageTwo'] = $_POST['old_image'];
						$data['error'] = $this->upload->display_errors();
					}
				}else 
				{
					$dt = $this->upload->data();
					$_POST['ethosImageTwo'] = $dt['file_name'];
					$params['ethosImageTwo'] = $dt['file_name'];
				}
				$data = array(
				    'ethosHeading' => str_replace(['<p>', '</p>'],'',$this->input->post('ethosHeading')),
				    'ethosCreativityDescription' => str_replace(['<p>', '</p>'],'',$this->input->post('ethosCreativityDescription')),
				    'ethosSustainabilityDescription' => str_replace(['<p>', '</p>'],'',$this->input->post('ethosSustainabilityDescription')),
					'ethosSafetyDescription' => str_replace(['<p>', '</p>'],'',$this->input->post('ethosSafetyDescription')),
					'ethosImageOne' => $_POST['ethosImageOne'],
					'ethosImageTwo' => $_POST['ethosImageTwo'],
					'metaTitle' => $this->input->post('metaTitle'),
					'metaKeyword' => $this->input->post('metaKeyword'),
					'metaContent' => $this->input->post('metaContent'),
					'dateModified' => date('Y-m-d h:i:s'),
				);
				$params = $this->security->xss_clean($data);
				$where = ['ethosID' => $id];
				$result = $this->Common_model->updateRecord('fx_ethos', $params, $where);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'ethos  has been updated successfully!');
					redirect(base_url('admin/ethos/edit/1'));
				}
			}
		}else{
			$data['ethos'] = $this->Common_model->getRow('fx_ethos',array('ethosID'=>$id));
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/ethos/ethos_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}
}
?>