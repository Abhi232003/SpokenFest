<?php defined('BASEPATH') OR exit('No direct script access allowed');
class gallery extends My_Controller {
	public function __construct() {
		parent::__construct();
		auth_check();
// 		$this->rbac->check_module_access();
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Common_model','Common_model');
	}
	public function index(){
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/gallery/gallery_list');
		$this->load->view('admin/includes/_footer');
	}
		public function datatable_json(){				   					   
		$records['data'] = $this->Common_model->getRecords('fx_gallery',array('status'=>1));
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$data[]= array(
				++$i,
				'<img height="50px" width="50px" src="'.base_url('uploads/gallery/'.$row['galleryImage']).'">',
			   '<a title="Edit" class="update btn btn-success-rgba" href="'.base_url('admin/gallery/add_edit/'.$row['galleryID']).'"> <i class="feather icon-edit-2"></i></a>
				<a title="Delete" class="delete btn btn-danger-rgba" href='.base_url("admin/gallery/gallery_delete/".$row['galleryID']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="feather icon-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);	
	}
	function change_status()
	{ 
		$params = array('is_active' => $this->input->post('status'));
		$where = ['galleryID' => $this->input->post('id')];
		$update = $this->Common_model->updateRecord('fx_gallery', $params, $where);
	}
	function add_edit_($id = 0) {
		//$this->rbac->check_operation_access(); // check opration permission
		$this->load->library('form_validation');
		$page_data = array();
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('sort_order', 'gallery sort order', 'trim|required');
            if ($_POST['galleryID'] == 0) {
				$this->form_validation->set_rules('galleryImage', 'gallery Thumb Image', 'callback_file_check1');
			}
			if ($this->form_validation->run() == FALSE){
				$data = array(
					'errors' => validation_errors(),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$galleryID = $_POST['galleryID'];
				if ($_POST['galleryID'] > 0) {
					redirect(base_url('admin/gallery/add_edit/' . $galleryID . ''), 'refresh');
				} else {
					redirect(base_url('admin/gallery/add_edit'), 'refresh');
				}
			} else {
				if (isset($_POST) && !empty($_POST)) {
					$config = array(
						'upload_path' => 'uploads/gallery/',
						'allowed_types' => 'jpg|jpeg|gif|png',
						'file_name' => rand(1, 9999),
						'max_size' => 0,
					);
                    $this->load->library('upload',$config);
					if ($_FILES['galleryImage']['name'] != '') {
						if ($this->upload->do_upload('galleryImage')) {
							$dt = $this->upload->data();
							$_POST['galleryImage'] = $dt['file_name'];
						} else {
							$_POST['galleryImage'] = $_POST['old_galleryImage'];
							$data['error'] = $this->upload->display_errors();
						}
					} else {
						$_POST['galleryImage'] = $_POST['old_galleryImage'];
						$data['error'] = $this->upload->display_errors();
					}
					$params = array(
						'sort_order' => $this->input->post('sort_order'),
						'galleryImage' => $_POST['galleryImage'],
						'dateAdded' => date('Y-m-d h:i:s'),
						'dateModified' => date('Y-m-d h:i:s'),
					);
					$galleryID = $_POST['galleryID'];
					$data = $this->security->xss_clean($params);
					if ($_POST['galleryID'] > 0) {
						$where = ['galleryID' => $galleryID];
						$params = $this->Common_model->updateRecord('fx_gallery', $data, $where);
						// echo $this->db->last_query();
						// echo "<pre>";
						// print_r($params);die();
						if ($params) {
							$this->session->set_flashdata('success', 'gallery updated successfully!');
							redirect(base_url('admin/gallery'));
						}
					} else {
						$insert = $this->Common_model->insertRecord('fx_gallery', $data);
						if ($insert) {
							$this->session->set_flashdata('success', 'gallery added successfully!');
							redirect(base_url('admin/gallery'));
						}
			        }
			    } else {
					$this->session->set_flashdata('errors', 'Something is Wrong!!');
					redirect(base_url('admin/gallery/add_edit'), 'refresh');
				}
			}
		} else {
			$galleryID = $this->uri->segment(4);
			if ($galleryID > 0) {
                $page_data['Fetch_data'] = $this->Common_model->getRow('fx_gallery',array('galleryID'=>$id));
                // $page_data['datas'] = $this->Common_model->getProductCategory();
                // echo "<pre>";
                // print_r($page_data['datas']);die();
			} else {
				$page_data['Fetch_data'] = array();
				// $page_data['datas'] = $this->Common_model->getProductCategory();
			}
			// $page_data['datas'] = $this->Common_model->getgallerySection();
				// echo '<pre>';
				// print_r($page_data);
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/gallery/add_edit', $page_data);
			$this->load->view('admin/includes/_footer');
		}
	}

	function add_edit($id = 0) {
		//$this->rbac->check_operation_access(); // check opration permission
		$this->load->library('form_validation');
		$page_data = array();
		if ($this->input->post('submit')){
			$this->form_validation->set_rules('sort_order', 'gallery sort order', 'trim|required');
			 if ($_POST['galleryID'] == 0) {
				$this->form_validation->set_rules('galleryImage', 'gallery image', 'callback_file_check1');
			}
			if ($this->form_validation->run() == FALSE){
				$data = array(
					'errors' => validation_errors(),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$galleryID = $_POST['galleryID'];
				if ($_POST['galleryID'] > 0) {
					redirect(base_url('admin/gallery/add_edit/' . $galleryID . ''), 'refresh');
				} else {
					redirect(base_url('admin/gallery/add_edit'), 'refresh');
				}
			} else {
				if (isset($_POST) && !empty($_POST)) {
					$config = array(
						'upload_path' => 'uploads/gallery/',
						'allowed_types' => 'jpg|jpeg|gif|png',
						'file_name' => rand(1, 9999),
						'max_size' => 0,
					);
                    $this->load->library('upload',$config);
					if ($_FILES['galleryImage']['name'] != '') {
						if ($this->upload->do_upload('galleryImage')) {
							$dt = $this->upload->data();
							$_POST['galleryImage'] = $dt['file_name'];
						} else {
							$_POST['galleryImage'] = $_POST['old_galleryImage'];
							$data['error'] = $this->upload->display_errors();
						}
					} else {
						$_POST['galleryImage'] = $_POST['old_galleryImage'];
						$data['error'] = $this->upload->display_errors();
					}
					$params = array(
                        'seoUri'=>$new_seo,
                        'sort_order' =>  $this->input->post('sort_order'),
						'galleryImage' => $_POST['galleryImage'],
						'dateAdded' => date('Y-m-d h:i:s'),
						'dateModified' => date('Y-m-d h:i:s'),
					);
					$galleryID = $_POST['galleryID'];
					$data = $this->security->xss_clean($params);
					if ($_POST['galleryID'] > 0){
						$where = ['galleryID' => $galleryID];
						$params = $this->Common_model->updateRecord('fx_gallery', $data, $where);
						if ($params) {
							$this->session->set_flashdata('success', 'gallery updated successfully!');
							redirect(base_url('admin/gallery'));
						}
					} else {
						$insert = $this->Common_model->insertRecord('fx_gallery', $data);
						if ($insert) {
							$this->session->set_flashdata('success', 'gallery added successfully!');
							redirect(base_url('admin/gallery'));
						}
			        }
			    } else {
					$this->session->set_flashdata('errors', 'Something is Wrong!!');
					redirect(base_url('admin/gallery/add_edit'), 'refresh');
				}
			}
		} else {
			$galleryID = $this->uri->segment(4);
			if ($galleryID > 0) {
                $page_data['Fetch_data'] = $this->Common_model->getRow('fx_gallery',array('galleryID'=>$id));
			} else {
				$page_data['Fetch_data'] = array();
			}
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/gallery/add_edit', $page_data);
			$this->load->view('admin/includes/_footer');
		}
	}
	function gallery_view($id = 0) {
		$page_data['Fetch_data'] = $this->Common_model->getRow('fx_gallery', array('galleryID' => $galleryID));
		// print_r($page_data);die();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/gallery/add_edit', $page_data);
		$this->load->view('admin/includes/_footer');
	}
	public function file_check1() {
		if (empty($_FILES['galleryImage']['name'][0])) {
			$this->form_validation->set_message('file_check1', "The gallery thumb image field is required.");
			return false;
		} else {
			return true;
		}
	}
	public function gallery_delete($id = 0)
	{
		$params = array('status' => 0);
		$where = ['galleryID' => $id];
		$update = $this->Common_model->updateRecord('fx_gallery', $params, $where);
		$this->session->set_flashdata('success', ' gallery has been deleted successfully!');
		redirect(base_url('admin/gallery'));
	}
}