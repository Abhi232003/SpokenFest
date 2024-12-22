<?php defined('BASEPATH') OR exit('No direct script access allowed');
class lineup extends My_Controller {
	public function __construct() {
		parent::__construct();
		auth_check();
// 		$this->rbac->check_module_access();
		$this->rbac->check_module_access();
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Common_model','Common_model');
	}
	public function index(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/lineup/lineup_list');
		$this->load->view('admin/includes/_footer');
	}
	public function lineupYear(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/lineupYear/lineupYear_list');
		$this->load->view('admin/includes/_footer');
	}
		public function datatable_json(){				   					   
		$records['data'] = $this->Common_model->getRecords('fx_lineup',array('status'=>1));
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$data[]= array(
				++$i,
				'<img height="50px" width="50px" src="'.base_url('uploads/lineup/'.$row['lineupThumbImage']).'">',
				'<img height="50px" width="50px" src="'.base_url('uploads/lineup/'.$row['lineupDetailImage']).'">',
				$row['lineupHeading'],
			   '<a title="Edit" class="update btn btn-success-rgba" href="'.base_url('admin/lineup/add_edit/'.$row['lineupID']).'"> <i class="feather icon-edit-2"></i></a>
				<a title="Delete" class="delete btn btn-danger-rgba" href='.base_url("admin/lineup/lineup_delete/".$row['lineupID']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="feather icon-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);	
	}
	function change_status()
	{ 
		$params = array('is_active' => $this->input->post('status'));
		$where = ['lineupID' => $this->input->post('id')];
		$update = $this->Common_model->updateRecord('fx_lineup', $params, $where);
	}
	function add_edit($id = 0) {
		//$this->rbac->check_operation_access(); // check opration permission
		$this->load->library('form_validation');
		$page_data = array();
		if ($this->input->post('submit')){
			$this->form_validation->set_rules('lineupYear', 'select lineup year', 'trim|required');
			$this->form_validation->set_rules('lineupHeading', 'lineup heading', 'trim|required');
			 if ($_POST['lineupID'] == 0) {
				$this->form_validation->set_rules('lineupThumbImage', 'lineup thumb image', 'callback_file_check1');
				$this->form_validation->set_rules('lineupDetailImage', 'lineup detail image', 'callback_file_check2');
			}
			$this->form_validation->set_rules('lineupDescription','lineup long description','trim|required');
           
			if ($this->form_validation->run() == FALSE){
				$data = array(
					'errors' => validation_errors(),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$lineupID = $_POST['lineupID'];
				if ($_POST['lineupID'] > 0) {
					redirect(base_url('admin/lineup/add_edit/' . $lineupID . ''), 'refresh');
				} else {
					redirect(base_url('admin/lineup/add_edit'), 'refresh');
				}
			} else {
				if (isset($_POST) && !empty($_POST)) {
					$config = array(
						'upload_path' => 'uploads/lineup/',
						'allowed_types' => 'jpg|jpeg|gif|png',
						'file_name' => rand(1, 9999),
						'max_size' => 0,
					);
                    $this->load->library('upload',$config);
					if ($_FILES['lineupThumbImage']['name'] != '') {
						if ($this->upload->do_upload('lineupThumbImage')) {
							$dt = $this->upload->data();
							$_POST['lineupThumbImage'] = $dt['file_name'];
						} else {
							$_POST['lineupThumbImage'] = $_POST['old_lineupThumbImage'];
							$data['error'] = $this->upload->display_errors();
						}
					} else {
						$_POST['lineupThumbImage'] = $_POST['old_lineupThumbImage'];
						$data['error'] = $this->upload->display_errors();
					}
					if ($_FILES['lineupDetailImage']['name'] != '') {
						if ($this->upload->do_upload('lineupDetailImage')) {
							$dt = $this->upload->data();
							$_POST['lineupDetailImage'] = $dt['file_name'];
						} else {
							$_POST['lineupDetailImage'] = $_POST['old_lineupDetailImage'];
							$data['error'] = $this->upload->display_errors();
						}
					} else {
						$_POST['lineupDetailImage'] = $_POST['old_lineupDetailImage'];
						$data['error'] = $this->upload->display_errors();
					}
					$new_seo;
		    		$seoUri = makeSeoUri($this->input->post('lineupHeading'));
		    		$check_seo = $this->Common_model->getRecords('fx_lineup',array('seoUri'=>$seoUri));
		    		if(sizeof($check_seo) > 0){
		    		$new_seo = $seoUri.rand(1,999);
		    		} else {
		    		$new_seo = $seoUri;
		    		} 
		    		$new_seo = makeSeoUri($this->input->post('lineupHeading'));
					$params = array(
                        'seoUri'=>$new_seo,
                        'lineupYear' =>  $this->input->post('lineupYear'),
						'lineupHeading' => $this->input->post('lineupHeading'),
						'lineupThumbImage' => $_POST['lineupThumbImage'],
						'lineupDetailImage' => $_POST['lineupDetailImage'],
						'lineupDescription' => str_replace(['<p>', '</p>'],'',$this->input->post('lineupDescription')),
						'metaTitle' => $this->input->post('metaTitle'),
					    'metaKeyword' => $this->input->post('metaKeyword'),
					    'metaDescription' => $this->input->post('metaDescription'),
						'dateAdded' => date('Y-m-d h:i:s'),
						'dateModified' => date('Y-m-d h:i:s'),
					);
					$lineupID = $_POST['lineupID'];
					$data = $this->security->xss_clean($params);
					if ($_POST['lineupID'] > 0){
						$where = ['lineupID' => $lineupID];
						$params = $this->Common_model->updateRecord('fx_lineup', $data, $where);
						if ($params) {
							$this->session->set_flashdata('success', 'lineup updated successfully!');
							redirect(base_url('admin/lineup'));
						}
					} else {
						$insert = $this->Common_model->insertRecord('fx_lineup', $data);
						if ($insert) {
							$this->session->set_flashdata('success', 'lineup added successfully!');
							redirect(base_url('admin/lineup'));
						}
			        }
			    } else {
					$this->session->set_flashdata('errors', 'Something is Wrong!!');
					redirect(base_url('admin/lineup/add_edit'), 'refresh');
				}
			}
		} else {
			$lineupID = $this->uri->segment(4);
			if ($lineupID > 0) {
			     $page_data['datas'] = $this->Common_model->getRecords('fx_years', array('status' => '1'));
                $page_data['Fetch_data'] = $this->Common_model->getRow('fx_lineup',array('lineupID'=>$id));
			} else {
			    $page_data['datas'] = $this->Common_model->getRecords('fx_years', array('status' => '1'));
				$page_data['Fetch_data'] = array();
			}
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/lineup/add_edit', $page_data);
			$this->load->view('admin/includes/_footer');
		}
	}
	function lineup_view($id = 0) {
		$page_data['Fetch_data'] = $this->Common_model->getRow('fx_lineup', array('lineupID' => $lineupID));
		// print_r($page_data);die();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/lineup/add_edit', $page_data);
		$this->load->view('admin/includes/_footer');
	}
	public function file_check1() {
		if (empty($_FILES['lineupThumbImage']['name'][0])) {
			$this->form_validation->set_message('file_check1', "The lineup thumb image field is required.");
			return false;
		} else {
			return true;
		}
	}
	public function file_check2() {
		if (empty($_FILES['lineupDetailImage']['name'][0])) {
			$this->form_validation->set_message('file_check2', "The lineup detail image field is required.");
			return false;
		} else {
			return true;
		}
	}
	public function lineup_delete($id = 0)
	{
		$params = array('status' => 0);
		$where = ['lineupID' => $id];
		$update = $this->Common_model->updateRecord('fx_lineup', $params, $where);
		$this->session->set_flashdata('success', ' lineup has been deleted successfully!');
		redirect(base_url('admin/lineup'));
	}
}