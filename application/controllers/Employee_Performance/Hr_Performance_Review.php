<?php
	
defined('BASEPATH') OR exit('No direct script access allowed');

	class  Hr_Performance_Review extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); // update the last activity time

				//put the modal here
				 $this->load->model("hr_dashboard_model","hr");
				 $this->load->model('Attendance_Model','attendance');
				 $this->load->model("employee_performance/Employee_performance_Model","performance");
			}
		}

		function index(){
			$module_name = "hr_perfromance_review";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$data['department'] = $this->hr->getDepartments();
				$data['info'] = $this->unApprovedList(); 
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('employee_performance/employee_performance_review/hr_performance_review',$data);
				$this->load->view('footer');
			}
		
		}

		function unApprovedList(){
			$data = array();
			$result = $this->performance->getUncheckedList(date('Y'));
			if($result){
				$data = $result;
			}else{
				//empty 
			}
			return $data;
		}

		function view_more_edit(){
			$data = array();
			$employee_id = $this->input->post('employee_id');
			$selected_year = date('Y');

			$result1 = $this->performance->view_more($employee_id,$selected_year);
			$result2 = $this->performance->get_employee_particular($employee_id);
			//$result3 = $this->hr->get_dept_head_name($result2->department_id);
			$data['info'] = array(
							'performance_info' => $result1,
							'employee_info' => $result2
						);

			if($result1 && $result2){
				$this->load->view('employee_performance/employee_performance_review/view_more_hr',$data);
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry!!!, We have some technical problem please contact our awesome administrator for more information. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			
		}

		function update_hr_form(){
			$employee_id = $this->input->post('employee_id');
			$hr_comments = $this->input->post('hr_maoni');
			$hr_date = $this->input->post('tarehe');
			$hr_name = $this->input->post('hr_name');

			$data = array (
					'maoni_ya_hr' => $hr_comments,
					'hr_sign_date' => $hr_date,
					'hr_name' => $hr_name
			);

			if($this->performance->hr_performance_update($employee_id,$data,date('Y'))){
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert"> <b>Hongera sana !!! </b>Employee performance review form imepitiwa na kusaviwa.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert"> <b>Samahani !!! </b>Employee performance review form Imeshindwa kusaviwa.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			}
			$this->index();
		}

		function view_more_report(){
			$employee_id = $this->input->post('employee_id');
			$selected_year = $this->input->post('selected_year');	

			$result1 = $this->performance->view_more($employee_id,$selected_year);
			$result2 = $this->performance->get_employee_particular($employee_id);
			$data['info'] = array(
							'performance_info' => $result1,
							'employee_info' => $result2
						);

			if($result1 && $result2){
				$this->load->view('employee_performance/employee_performance_review/view_more_hr_report',$data);
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Samahani!!!, kuna tatizo kwenye mfumo wetu, wasiliana na admin kwa maelezo zaidi. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}

		function report(){
			$module_name = "manager_employee_performance";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('head');
				$this->load->view('employee_performance/manager_employee_performance');
				$this->load->view('footer');
			}
		}

	}

 ?>