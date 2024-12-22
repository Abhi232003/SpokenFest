<?php defined('BASEPATH') OR exit('No direct script access allowed');
class partner extends My_Controller {
	public function __construct() {
		parent::__construct();
// 		auth_check();
		// $this->rbac->check_module_access();
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Common_model','Common_model');
		// require(APPPATH.'third_party/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  //       require(APPPATH.'third_party/spreadsheet-reader-master/SpreadsheetReader.php');
	}
	public function index() {
	 	$page_data['title'] = 'partner List';
	 	$this->load->view('admin/includes/_header');
		$this->load->view('admin/partner/partner_list', $page_data);
	 	$this->load->view('admin/includes/_footer');
	 }
	public function partner_json() {
		$records['data'] = $this->Common_model->getRecords('fx_partner',array('status'=>1));
		$data = array();
		$i = 0;
		foreach ($records['data'] as $row) {
		    $type = $row['partnerType'];
		    $partnerType ='';
		    if($type==1){
		        $partnerType ='A food stall';
		    }else if($type==2){
		        $partnerType ='Flea market';
		    }else if($type==3){
		        $partnerType ='A Sponsor';
		    }else if($type==4){
		        $partnerType ='An artist';
		    }else if($type==5){
		        $partnerType ='A volunteer';
		    }else if($type==6){
		        $partnerType ='Other';
		    }
			$data[] = array(
				++$i,
				$row['partnerName'],
				$row['partnerEmail'],
				$row['partnerPhone'],
				$partnerType,
				date('Y-m-d', strtotime($row['dateAdded'])),
				'<a title="Delete" class="delete btn btn-danger-rgba" href='.base_url("admin/partner/partner_delete/".$row['partnerID']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="feather icon-trash"></i></a>'
			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}
	public function partner_export() {
		$str = '';
		$html = '';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fromDate', 'From Date', 'required');
		$this->form_validation->set_rules('toDate', 'To Date', 'required');
		if ($this->form_validation->run()) {
			$FromDate = $this->input->post('fromDate');
			$ToDate = $this->input->post('toDate');
			$new_FromDate = date('Y-m-d', strtotime($FromDate));
			$new_ToDate = date('Y-m-d', strtotime($ToDate));
			// get data
		    $this->db->select('*' );
			$this->db->from("fx_partner AS B");
			$this->db->where('DATE(dateAdded) >=', $new_FromDate);
			$this->db->where('DATE(dateAdded)  <=', $new_ToDate);
			$query = $this->db->get();
			$result = $query->result_array();
			// echo "<pre>";print_r($result);die();
			if (empty($result))
			{
			    // echo "There is no data between these two dates..";
			    $this->session->set_flashdata('errors', 'There is no data between these two dates..!!');
			    redirect(base_url('admin/partner'), 'refresh');
			}
			else
			{
			$filename = 'partner_us_list_' . date('Y-m-d') . '.xls';
			$str .= ' <table cellspacing="1" cellpadding="7" border="1">
			<thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Partner Email</th>
                            <th>Partner Phone</th>
                            <th>Partner Type</th>
                            <th>Partner Comment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($result as $key => $value) {
                        $type = $value['partnerType'];
            		    $partnerType ='';
            		    if($type==1){
            		        $partnerType ='A food stall';
            		    }else if($type==2){
            		        $partnerType ='Flea market';
            		    }else if($type==3){
            		        $partnerType ='A Sponsor';
            		    }else if($type==4){
            		        $partnerType ='An artist';
            		    }else if($type==5){
            		        $partnerType ='A volunteer';
            		    }else if($type==6){
            		        $partnerType ='Other';
            		    }
				// $value['fullname'] = $value['istration_formFname'] . ' ' . $value['partner_formLname'];
				$html .= '<tr>
        				<td>' . $value['partnerID'] . '</td>
        				<td>' . $value['partnerName'] . '</td>
        				<td>' . $value['partnerEmail'] . '</td>
        				<td>' . $value['partnerPhone'] . '</td>
        				<td>' . $partnerType . '</td>
        				<td>' . $value['partnerComment'] . '</td>
        				<td>' . $value['dateAdded'] . '</td>
        			</tr>
        	';
			}
			// echo "<pre>";print_r($html);die();
			$finalContent = $str . $html . '</tbody></table>';
			header("Content-type: application/vnd.ms-excel; name='excel'");
			header("Content-Disposition: filename = " . $filename . "");
			header("Pragma: ");
			header("Cache-Control: ");
			echo $finalContent;
		}
		} 
		else
		{
		$page_data['title'] = 'partner List';
	 	$this->load->view('admin/includes/_header');
		$this->load->view('admin/partner/partner_list', $page_data);
	 	$this->load->view('admin/includes/_footer');
		}
	}
     public function file_check() {
        if (empty($_FILES['uploadFile']['name'][0])) {
            $this->form_validation->set_message('file_check', "The excel field is required.");
            return false;
        } else {
            return true;
        }
    }
	public function partner_delete($id = 0)
	{
		$params = array('status' => 0);
		$where = ['partnerID' => $id];
		$update = $this->Common_model->updateRecord('fx_partner', $params, $where);
		$this->session->set_flashdata('success', ' partner has been deleted successfully!');
		redirect(base_url('admin/partner'));
	}
}
?>