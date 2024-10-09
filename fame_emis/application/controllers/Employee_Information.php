<?php

defined('BASEPATH') OR exit('No direct script access allowed');


	class Employee_Information extends CI_Controller{
		function __construct(){
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); //update time activity session 
				 $this->load->model("Wategemezi_Model","wategemezi");
				 $this->load->helper('wategemezi_option_helper');
			}
		}

		function index(){
			$module_name = "employee_details";
        	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
        		$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('employee_information_form');
				$this->load->view('footer');
			}
		}

		function get_employee_info() {
		    $data = array();
		    $names = $this->input->post("names");
		    $result = $this->wategemezi->get_employee_details($names);

		    $data = array(
		        "employee_id" => $result->employee_id,
		        "dob" => $result->dob,
		        "phone_number" => $result->phone_number,
		        "professional" => $result->professional_name,
		        "department_name" => $result->department_name,
		        "hiring_date" => $result->hiring_date
		    );

		    if ($result->hr_dept_update == NULL || $result->hr_dept_update != "0000-00-00") {
		        for ($i = 1; $i <= 6; $i++) {
		            $data["dept$i"] = $result->{"dept$i"};
		            $data["dept${i}_relation"] = $result->{"dept${i}_relation"};
		            $data["dept${i}_dob"] = $result->{"dept${i}_dob"};
		        }
		    } else {
		        for ($i = 1; $i <= 6; $i++) {
		            $data["dept$i"] = "";
		            $data["dept${i}_relation"] = "";
		            $data["dept${i}_dob"] = "";
		        }
		    }

		    echo json_encode($data);
		}


		function update_wategemezi(){
			$data = array (
				'dept1' => $this->input->post('mtegemezi1'),
				'dept2' => $this->input->post('mtegemezi2'),
				'dept3' => $this->input->post('mtegemezi3'),
				'dept4' => $this->input->post('mtegemezi4'),
				'dept5' => $this->input->post('mtegemezi5'),
			);
			if($this->wategemezi->update_wategemezi($this->input->post('employee_id'),$data)){
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Employee Wategemezi successful changed  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Employee Wategemezi failed to be changed, please contact our awesome Administrator form more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}
	}

?>