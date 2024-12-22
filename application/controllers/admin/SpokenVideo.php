<?php defined('BASEPATH') OR exit('No direct script access allowed');
class SpokenVideo extends My_Controller {
	public function __construct() {
		parent::__construct();
		auth_check();
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Common_model','Common_model');
	}
	public function index(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/spokenVideo/spokenVideo_list');
		$this->load->view('admin/includes/_footer');
	}
	public function datatable_json(){				   					   
		$records['data'] = $this->Common_model->getRecords('fx_spokenvideo',array('status'=>1));
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
// 			$spokenVideoLink = mb_strimwidth($row['spokenVideoLink'],0,25,'...');
		{  
			$data[]= array(
				++$i,
				'<img height="50px" width="50px" src="'.base_url('uploads/spokenVideo/'.$row['spokenVideoThumbImage']).'">',
				mb_strimwidth($row['spokenVideoLink'],0,25,'...'),
			   '<a title="Edit" class="update btn btn-success-rgba" href="'.base_url('admin/spokenVideo/add_edit/'.$row['spokenVideoID']).'"> <i class="feather icon-edit-2"></i></a>
				<a title="Delete" class="delete btn btn-danger-rgba" href='.base_url("admin/spokenVideo/spokenVideo_delete/".$row['spokenVideoID']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="feather icon-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);	
	}
	function change_status()
	{ 
		$params = array('is_active' => $this->input->post('status'));
		$where = ['spokenVideoID' => $this->input->post('id')];
		$update = $this->Common_model->updateRecord('fx_spokenvideo', $params, $where);
	}
	function add_edit($id = 0) {
		//$this->rbac->check_operation_access(); // check opration permission
		$this->load->library('form_validation');
		$page_data = array();
		if ($this->input->post('submit')){
			$this->form_validation->set_rules('spokenVideoLink', 'spoken video link', 'trim|required|callback_no_sql');
			 if ($_POST['spokenVideoID'] == 0) {
				$this->form_validation->set_rules('spokenVideoThumbImage', 'spoken video thumb image', 'callback_file_check1');
				
			}
// 			$this->form_validation->set_rules('spokenVideoDescription','spokenVideo long description','trim|required');
           
			if ($this->form_validation->run() == FALSE){
				$data = array(
					'errors' => validation_errors(),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$spokenVideoID = $_POST['spokenVideoID'];
				if ($_POST['spokenVideoID'] > 0) {
					redirect(base_url('admin/spokenVideo/add_edit/' . $spokenVideoID . ''), 'refresh');
				} else {
					redirect(base_url('admin/spokenVideo/add_edit'), 'refresh');
				}
			} else {
				if (isset($_POST) && !empty($_POST)) {
					$config = array(
						'upload_path' => 'uploads/spokenVideo/',
						'allowed_types' => 'jpg|jpeg|gif|png',
						'file_name' => rand(1, 9999),
						'max_size' => 0,
					);
                    $this->load->library('upload',$config);
					if ($_FILES['spokenVideoThumbImage']['name'] != '') {
						if ($this->upload->do_upload('spokenVideoThumbImage')) {
							$dt = $this->upload->data();
							$_POST['spokenVideoThumbImage'] = $dt['file_name'];
						} else {
							$_POST['spokenVideoThumbImage'] = $_POST['old_spokenVideoThumbImage'];
							$data['error'] = $this->upload->display_errors();
						}
					} else {
						$_POST['spokenVideoThumbImage'] = $_POST['old_spokenVideoThumbImage'];
						$data['error'] = $this->upload->display_errors();
					}
					$params = array(
						'spokenVideoLink' => $this->input->post('spokenVideoLink'),
						'spokenVideoThumbImage' => $_POST['spokenVideoThumbImage'],
				// 		'spokenVideoDescription' => str_replace(['<p>', '</p>'],'',$this->input->post('spokenVideoDescription')),
						'metaTitle' => $this->input->post('metaTitle'),
					    'metaKeyword' => $this->input->post('metaKeyword'),
					    'metaDescription' => $this->input->post('metaDescription'),
						'dateAdded' => date('Y-m-d h:i:s'),
						'dateModified' => date('Y-m-d h:i:s'),
					);
					$spokenVideoID = $_POST['spokenVideoID'];
					$data = $this->security->xss_clean($params);
					if ($_POST['spokenVideoID'] > 0){
						$where = ['spokenVideoID' => $spokenVideoID];
						$params = $this->Common_model->updateRecord('fx_spokenvideo', $data, $where);
						if ($params) {
							$this->session->set_flashdata('success', 'Spoken video updated successfully!');
							redirect(base_url('admin/spokenVideo'));
						}
					} else {
						$insert = $this->Common_model->insertRecord('fx_spokenvideo', $data);
						if ($insert) {
							$this->session->set_flashdata('success', 'Spoken video added successfully!');
							redirect(base_url('admin/spokenVideo'));
						}
			        }
			    } else {
					$this->session->set_flashdata('errors', 'Something is Wrong!!');
					redirect(base_url('admin/spokenVideo/add_edit'), 'refresh');
				}
			}
		} else {
			$spokenVideoID = $this->uri->segment(4);
			if ($spokenVideoID > 0) {
                $page_data['Fetch_data'] = $this->Common_model->getRow('fx_spokenvideo',array('spokenVideoID'=>$id));
			} else {
				$page_data['Fetch_data'] = array();
			}
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/spokenVideo/add_edit', $page_data);
			$this->load->view('admin/includes/_footer');
		}
	}
	function spokenVideo_view($id = 0) {
		$page_data['Fetch_data'] = $this->Common_model->getRow('fx_spokenvideo', array('spokenVideoID' => $spokenVideoID));
		// print_r($page_data);die();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/spokenVideo/add_edit', $page_data);
		$this->load->view('admin/includes/_footer');
	}
	public function file_check1() {
		if (empty($_FILES['spokenVideoThumbImage']['name'][0])) {
			$this->form_validation->set_message('file_check1', "The spoken video thumb image field is required.");
			return false;
		} else {
			return true;
		}
	}
	public function file_check2() {
		if (empty($_FILES['spokenVideoDetailImage']['name'][0])) {
			$this->form_validation->set_message('file_check2', "The spoken video detail image field is required.");
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
	public function spokenVideo_delete($id = 0)
	{
		$params = array('status' => 0);
		$where = ['spokenVideoID' => $id];
		$update = $this->Common_model->updateRecord('fx_spokenvideo', $params, $where);
		$this->session->set_flashdata('success', ' Spoken video has been deleted successfully!');
		redirect(base_url('admin/spokenVideo'));
	}
}