<?php defined('BASEPATH') OR exit('No direct script access allowed');
class News extends My_Controller {
	public function __construct() {
		parent::__construct();
		auth_check();
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Common_model','Common_model');
	}
	public function index(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/news/news_list');
		$this->load->view('admin/includes/_footer');
	}
	public function datatable_json(){				   					   
		$records['data'] = $this->Common_model->getRecords('fx_news',array('status'=>1));
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$data[]= array(
				++$i,
				'<img height="50px" width="50px" src="'.base_url('uploads/news/'.$row['newsThumbImage']).'">',
				mb_strimwidth($row['newsLink'],0,30,'...'),
			   '<a title="Edit" class="update btn btn-success-rgba" href="'.base_url('admin/news/add_edit/'.$row['newsID']).'"> <i class="feather icon-edit-2"></i></a>
				<a title="Delete" class="delete btn btn-danger-rgba" href='.base_url("admin/news/news_delete/".$row['newsID']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="feather icon-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);	
	}
	function change_status()
	{ 
		$params = array('is_active' => $this->input->post('status'));
		$where = ['newsID' => $this->input->post('id')];
		$update = $this->Common_model->updateRecord('fx_news', $params, $where);
	}
	function add_edit($id = 0) {
		//$this->rbac->check_operation_access(); // check opration permission
		$this->load->library('form_validation');
		$page_data = array();
		if ($this->input->post('submit')){
			$this->form_validation->set_rules('newsLink', 'news link', 'trim|required');
			 if ($_POST['newsID'] == 0) {
				$this->form_validation->set_rules('newsThumbImage', 'news thumb image', 'callback_file_check1');
				
			}
			$this->form_validation->set_rules('newsDescription','news long description','trim|required');
           
			if ($this->form_validation->run() == FALSE){
				$data = array(
					'errors' => validation_errors(),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$newsID = $_POST['newsID'];
				if ($_POST['newsID'] > 0) {
					redirect(base_url('admin/news/add_edit/' . $newsID . ''), 'refresh');
				} else {
					redirect(base_url('admin/news/add_edit'), 'refresh');
				}
			} else {
				if (isset($_POST) && !empty($_POST)) {
					$config = array(
						'upload_path' => 'uploads/news/',
						'allowed_types' => 'jpg|jpeg|gif|png',
						'file_name' => rand(1, 9999),
						'max_size' => 0,
					);
                    $this->load->library('upload',$config);
					if ($_FILES['newsThumbImage']['name'] != '') {
						if ($this->upload->do_upload('newsThumbImage')) {
							$dt = $this->upload->data();
							$_POST['newsThumbImage'] = $dt['file_name'];
						} else {
							$_POST['newsThumbImage'] = $_POST['old_newsThumbImage'];
							$data['error'] = $this->upload->display_errors();
						}
					} else {
						$_POST['newsThumbImage'] = $_POST['old_newsThumbImage'];
						$data['error'] = $this->upload->display_errors();
					}
					$params = array(
						'newsLink' => $this->input->post('newsLink'),
						'newsThumbImage' => $_POST['newsThumbImage'],
						'newsDescription' => str_replace(['<p>', '</p>'],'',$this->input->post('newsDescription')),
						'metaTitle' => $this->input->post('metaTitle'),
					    'metaKeyword' => $this->input->post('metaKeyword'),
					    'metaDescription' => $this->input->post('metaDescription'),
						'dateAdded' => date('Y-m-d h:i:s'),
						'dateModified' => date('Y-m-d h:i:s'),
					);
					$newsID = $_POST['newsID'];
					$data = $this->security->xss_clean($params);
					if ($_POST['newsID'] > 0){
						$where = ['newsID' => $newsID];
						$params = $this->Common_model->updateRecord('fx_news', $data, $where);
						if ($params) {
							$this->session->set_flashdata('success', 'news updated successfully!');
							redirect(base_url('admin/news'));
						}
					} else {
						$insert = $this->Common_model->insertRecord('fx_news', $data);
						if ($insert) {
							$this->session->set_flashdata('success', 'news added successfully!');
							redirect(base_url('admin/news'));
						}
			        }
			    } else {
					$this->session->set_flashdata('errors', 'Something is Wrong!!');
					redirect(base_url('admin/news/add_edit'), 'refresh');
				}
			}
		} else {
			$newsID = $this->uri->segment(4);
			if ($newsID > 0) {
			     $page_data['datas'] = $this->Common_model->getRecords('fx_years', array('status' => '1'));
                $page_data['Fetch_data'] = $this->Common_model->getRow('fx_news',array('newsID'=>$id));
			} else {
			    $page_data['datas'] = $this->Common_model->getRecords('fx_years', array('status' => '1'));
				$page_data['Fetch_data'] = array();
			}
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/news/add_edit', $page_data);
			$this->load->view('admin/includes/_footer');
		}
	}
	function news_view($id = 0) {
		$page_data['Fetch_data'] = $this->Common_model->getRow('fx_news', array('newsID' => $newsID));
		// print_r($page_data);die();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/news/add_edit', $page_data);
		$this->load->view('admin/includes/_footer');
	}
	public function file_check1() {
		if (empty($_FILES['newsThumbImage']['name'][0])) {
			$this->form_validation->set_message('file_check1', "The news thumb image field is required.");
			return false;
		} else {
			return true;
		}
	}
	public function file_check2() {
		if (empty($_FILES['newsDetailImage']['name'][0])) {
			$this->form_validation->set_message('file_check2', "The news detail image field is required.");
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
	public function news_delete($id = 0)
	{
		$params = array('status' => 0);
		$where = ['newsID' => $id];
		$update = $this->Common_model->updateRecord('fx_news', $params, $where);
		$this->session->set_flashdata('success', ' news has been deleted successfully!');
		redirect(base_url('admin/news'));
	}
}