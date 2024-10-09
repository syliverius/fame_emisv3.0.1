<?php

defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Report extends CI_Controller
	{
		
		function __construct(){
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); // update the last activity time
				//put the modal here
				 $this->load->model("hr_dashboard_model","hr");
				 $this->load->model("employee_performance/Employee_performance_Model","performance");
			}
		}

		function department_report(){
			$year_selected = $this->input->post("year_selected");
			$depertment_id = $this->input->post("department_id");
			$data['info'] = array ();

			$result = $this->performance->get_performance_report($year_selected,$depertment_id);
			$data['info'] = array('year_selected' => $year_selected,
				'employee_info' => $result);

			if($result){
				$this->load->view('employee_performance/performance_history_result',$data);
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Samahani!!!, kuna tatizo kwenye mfumo wetu, wasiliana na admin kwa maelezo zaidi. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}

		function view_more(){
			$data = array();
			$employee_id = $this->input->post('employee_id');
			$selected_year = $this->input->post('selected_year');

			$result1 = $this->performance->view_more($employee_id,$selected_year);
			$result2 = $this->performance->get_employee_particular($employee_id);
			$result3 = $this->hr->get_dept_head_name($this->session->userdata("department_id"));
			$data['info'] = array(
							'performance_info' => $result1,
							'employee_info' => $result2,
							'head_info' => $result3
						);

			if($result1 && $result2 && $result3){
				$this->load->view('employee_performance/employee_performance_review/view_more_hd_report',$data);
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Samahani!!!, kuna tatizo kwenye mfumo wetu, wasiliana na admin kwa maelezo zaidi. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			
		}

		function department_report_hr(){
			$department = $this->input->post('department');
			$year_selected = $this->input->post('year_selected');
			$data = array();
			$department_name = "";

			if($department == "ALL"){
				$result = $this->performance->get_all_performance_report($year_selected);
			}else{
				$department_id = $this->hr->get_dept_id($department);
				$result = $this->performance->get_performance_report($year_selected,$department_id->department_id);
				$department_name = $department;
			}

			$data['info'] = array('year_selected' => $year_selected,
				'report' => $result,
				'department' => $department_name
			);

			if($result->num_rows() > 0){
				
				$this->load->view('employee_performance/employee_performance_review/hr_performance_report',$data);

			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry! There is no employee evaluation info for year '.$year_selected.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			
		}
	}


?>