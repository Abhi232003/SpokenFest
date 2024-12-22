<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Stages extends My_Controller {
	public function __construct() {
		parent::__construct();
		auth_check();
// 		$this->rbac->check_module_access();
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Common_model','Common_model');
	}
	public function index(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/stages/stages_list');
		$this->load->view('admin/includes/_footer');
	}
	
		public function datatable_json(){				   					   
		$records['data'] = $this->Common_model->getRecords('fx_stages',array('status'=>1));
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$data[]= array(
				++$i,
				'<img height="50px" width="50px" src="'.base_url('uploads/stages/'.$row['stagesThumbImage']).'">',
				'<img height="50px" width="50px" src="'.base_url('uploads/stages/'.$row['stagesDetailImage']).'">',
				$row['stagesHeading'],
			   '<a title="Edit" class="update btn btn-success-rgba" href="'.base_url('admin/stages/add_edit/'.$row['stagesID']).'"> <i class="feather icon-edit-2"></i></a>
				<a title="Delete" class="delete btn btn-danger-rgba" href='.base_url("admin/stages/stages_delete/".$row['stagesID']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="feather icon-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);	
	}
	function change_status()
	{ 
		$params = array('is_active' => $this->input->post('status'));
		$where = ['stagesID' => $this->input->post('id')];
		$update = $this->Common_model->updateRecord('fx_stages', $params, $where);
	}
	function add_edit($id = 0) {
		//$this->rbac->check_operation_access(); // check opration permission
		$this->load->library('form_validation');
		$page_data = array();
		if ($this->input->post('submit')){
			$this->form_validation->set_rules('stagesHeading', 'stages heading', 'trim|required|callback_no_sql');
			 if ($_POST['stagesID'] == 0) {
				$this->form_validation->set_rules('stagesThumbImage', 'stages thumb image', 'callback_file_check1');
				$this->form_validation->set_rules('stagesDetailImage', 'stages detail image', 'callback_file_check2');
			}
			$this->form_validation->set_rules('stagesDescription','stages long description','trim|required');
           
			if ($this->form_validation->run() == FALSE){
				$data = array(
					'errors' => validation_errors(),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$stagesID = $_POST['stagesID'];
				if ($_POST['stagesID'] > 0) {
					redirect(base_url('admin/stages/add_edit/' . $stagesID . ''), 'refresh');
				} else {
					redirect(base_url('admin/stages/add_edit'), 'refresh');
				}
			} else {
				if (isset($_POST) && !empty($_POST)) {
					$config = array(
						'upload_path' => 'uploads/stages/',
						'allowed_types' => 'jpg|jpeg|gif|png',
						'file_name' => rand(1, 9999),
						'max_size' => 0,
					);
                    $this->load->library('upload',$config);
					if ($_FILES['stagesThumbImage']['name'] != '') {
						if ($this->upload->do_upload('stagesThumbImage')) {
							$dt = $this->upload->data();
							$_POST['stagesThumbImage'] = $dt['file_name'];
						} else {
							$_POST['stagesThumbImage'] = $_POST['old_stagesThumbImage'];
							$data['error'] = $this->upload->display_errors();
						}
					} else {
						$_POST['stagesThumbImage'] = $_POST['old_stagesThumbImage'];
						$data['error'] = $this->upload->display_errors();
					}
					if ($_FILES['stagesDetailImage']['name'] != '') {
						if ($this->upload->do_upload('stagesDetailImage')) {
							$dt = $this->upload->data();
							$_POST['stagesDetailImage'] = $dt['file_name'];
						} else {
							$_POST['stagesDetailImage'] = $_POST['old_stagesDetailImage'];
							$data['error'] = $this->upload->display_errors();
						}
					} else {
						$_POST['stagesDetailImage'] = $_POST['old_stagesDetailImage'];
						$data['error'] = $this->upload->display_errors();
					}
					$new_seo;
		    		$seoUri = makeSeoUri($this->input->post('stagesHeading'));
		    		$check_seo = $this->Common_model->getRecords('fx_stages',array('seoUri'=>$seoUri));
		    		if(sizeof($check_seo) > 0){
		    		$new_seo = $seoUri.rand(1,999);
		    		} else {
		    		$new_seo = $seoUri;
		    		} 
		    		$new_seo = makeSeoUri($this->input->post('stagesHeading'));
					$params = array(
                        'seoUri'=>$new_seo,
						'stagesHeading' => $this->input->post('stagesHeading'),
						'stagesThumbImage' => $_POST['stagesThumbImage'],
						'stagesDetailImage' => $_POST['stagesDetailImage'],
						'stagesDescription' => str_replace(['<p>', '</p>'],'',$this->input->post('stagesDescription')),
						'metaTitle' => $this->input->post('metaTitle'),
					    'metaKeyword' => $this->input->post('metaKeyword'),
					    'metaDescription' => $this->input->post('metaDescription'),
						'dateAdded' => date('Y-m-d h:i:s'),
						'dateModified' => date('Y-m-d h:i:s'),
					);
					$stagesID = $_POST['stagesID'];
					$data = $this->security->xss_clean($params);
					if ($_POST['stagesID'] > 0){
						$where = ['stagesID' => $stagesID];
						$params = $this->Common_model->updateRecord('fx_stages', $data, $where);
						if ($params) {
							$this->session->set_flashdata('success', 'stages updated successfully!');
							redirect(base_url('admin/stages'));
						}
					} else {
						$insert = $this->Common_model->insertRecord('fx_stages', $data);
						if ($insert) {
							$this->session->set_flashdata('success', 'stages added successfully!');
							redirect(base_url('admin/stages'));
						}
			        }
			    } else {
					$this->session->set_flashdata('errors', 'Something is Wrong!!');
					redirect(base_url('admin/stages/add_edit'), 'refresh');
				}
			}
		} else {
			$stagesID = $this->uri->segment(4);
			if ($stagesID > 0) {
			     $page_data['datas'] = $this->Common_model->getRecords('fx_years', array('status' => '1'));
                $page_data['Fetch_data'] = $this->Common_model->getRow('fx_stages',array('stagesID'=>$id));
			} else {
			    $page_data['datas'] = $this->Common_model->getRecords('fx_years', array('status' => '1'));
				$page_data['Fetch_data'] = array();
			}
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/stages/add_edit', $page_data);
			$this->load->view('admin/includes/_footer');
		}
	}
	function stages_view($id = 0) {
		$page_data['Fetch_data'] = $this->Common_model->getRow('fx_stages', array('stagesID' => $stagesID));
		// print_r($page_data);die();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/stages/add_edit', $page_data);
		$this->load->view('admin/includes/_footer');
	}
	public function file_check1() {
		if (empty($_FILES['stagesThumbImage']['name'][0])) {
			$this->form_validation->set_message('file_check1', "The stages thumb image field is required.");
			return false;
		} else {
			return true;
		}
	}
	public function file_check2() {
		if (empty($_FILES['stagesDetailImage']['name'][0])) {
			$this->form_validation->set_message('file_check2', "The stages detail image field is required.");
			return false;
		} else {
			return true;
		}
	}
	public function no_sql($str) {
        if (preg_match("/(AND|OR|SELECT|INSERT|UPDATE|DELETE|UNION|FROM|TABLE|DATABASE|script|<|>|{|})/i", $str)) {
            $this->form_validation->set_message('no_sql', 'The %s field cannot contain SQL queries.');
            return false;
        } else {
            return true;
        }
    }
    public function no_sql1($str) {
        if (preg_match("/(AND|OR|SELECT|INSERT|UPDATE|DELETE|UNION|FROM|TABLE|DATABASE|script|<|>|{|})/i", $str)) {
            $this->form_validation->set_message('no_sql1', 'The %s field cannot contain SQL queries.');
            return false;
        } else {
            return true;
        }
    }
	public function stages_delete($id = 0)
	{
		$params = array('status' => 0);
		$where = ['stagesID' => $id];
		$update = $this->Common_model->updateRecord('fx_stages', $params, $where);
		$this->session->set_flashdata('success', ' stages has been deleted successfully!');
		redirect(base_url('admin/stages'));
	}
}