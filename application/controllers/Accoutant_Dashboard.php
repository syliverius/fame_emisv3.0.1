<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accoutant_Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			redirect('auth');
		}else{
			$this->session->set_userdata('last_activity', time()); // update the last activity time
             date_default_timezone_set('UTC');
			$this->load->model('Hd_Leave_Approval_Model','approval');
			$this->load->model('Accoutant_Dashboard_Model','accoutant');
			$this->load->model('Hr_Dashboard_Model','hr');
			$this->load->model('Notification_Model','notify');
			$this->load->model('User_dashboard_Model','user');
			$this->load->model('Attendance_Model','attendance');
			$this->load->model('Admin_Dashboard_Model','admin');
		}
	}

	public function index(){
		$module_name = "accountant_dashboard";
		if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$data['values'] = $this->getEmployeeToApprove();
			$data['department'] = $this->getDepartments();
			$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('accountant/accoutant_Dashboard',$data);
			$this->load->view('footer');
		}
	}


		public function getEmployeeToApprove(){

		$toBeApproved = array();
		
		$data = $this->accoutant->getAllUnapprovedEmployee();
		if ($data) {
			foreach($data as $row){
				$getEmpId= $this->approval->getEmployeeId($row->leave_id); //return row
				if($getEmpId){
					$getEmployeesDetails = $this->hr->get_Employee_Name($getEmpId->employee_id);
					if($getEmployeesDetails){
						$getDepartment_name = $this->hr->get_Department_Details($getEmployeesDetails->department_id);
						if($getDepartment_name){
							$toBeApproved[] = array (
							'benefit_id' => $row->benefit_id,
							'names' => $getEmployeesDetails->names,
							'dept_name' => $getDepartment_name->department_name,
							'start_date' => $row->start_date,
							'end_date' => $row->end_date,
							'region' => $row->mkoa,
							'district' => $row->wilaya,
							'ward' => $row->kata,
							'request_data' => $row->request_date,
							'phone_number' => $getEmployeesDetails->phone_number,
							'siku' => $row->days_off,
							'amount' => $row->amount,
							'mtegemezi_1' => $row->mtegemezi_1,
							'mtegemezi_2' => $row->mtegemezi_2,
							'mtegemezi_3' => $row->mtegemezi_3,
							'mtegemezi_4' => $row->mtegemezi_4,
							'mtegemezi_5' => $row->mtegemezi_5
						);

						}
					}
				}	
			}
		}else{
			//if no any data retrieved
		}

		return $toBeApproved;
	}

	public function getDepartments(){
		$result = $this->hr->getDepartments();

		return $result;
	}

	public function more_details(){
		$benefit_id = $this->input->post("ids");
		$data['leave_info'] = $this->admin->getEmployeeAnnualLeaveInfo($benefit_id);
		$this->load->view('accountant/view_more_employee_annual_leave',$data);
	}

	public function accoutant_update_employee_leave(){
		$benefit_id = $this->input->post('benefit_id');
		$amount = $this->input->post('amount');
		$nauli_kiasi = $this->input->post('nauli');
    	$nauli_count = $this->input->post('nauli_times');
    	$chakula_kiasi = $this->input->post('chakula');
    	$chakula_count = $this->input->post('chakula_times');
    	$maradhi_kiasi = $this->input->post('maradhi');
    	$maradhi_count = $this->input->post('maradhi_times');
		
		$hr_update_data = array(
			'amount' => $amount,
			'nauli_kiasi' => $nauli_kiasi,
			'nauli_count' => $nauli_count,
			'chakula_kiasi' => $chakula_kiasi,
			'chakula_count' => $chakula_count,
			'maradhi_kiasi' => $maradhi_kiasi,
			'maradhi_count' => $maradhi_count
		);

		$prev_info = $this->admin->getEmployeeAnnualLeaveInfo($benefit_id);
		$result = $this->hr->hr_update_leave_model($benefit_id,$hr_update_data);

		if($result){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Annual Leave Update Accountant panel',
	    		'description' => 'leave info for '.$prev_info->names.' changed : Leave benefit changed from '.$prev_info->amount.' => '.$amount,
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
			$this->session->set_flashdata('accoutant_update_message','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Leave details for <span>an employee </span> updated successful, now continue with leave approval!!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect('accoutant_dashboard');
		}else{
			//also we will set frash data for error
		}
	}

	public function accoutant_leave_approval(){
		$data =array();
		$benefit_id = $this->input->post("ids");
		$names = $this->input->post('names');
		$today = date('Y-m-d');
				$data = array(
				'accoutant_sign' => true,
				'accountant_id' => $this->session->userdata('employee_id'),
				'accoutant_sign_date' => $today
				);

			$result = $this->accoutant->update_accountant_approval($benefit_id,$data);

			if($result){
				$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Annual Leave approval accountant dashboard',
	    		'description' => 'leave info for '.$names.' approved successful',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
				$this->session->set_flashdata('accoutant_success_message','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Employee leave payment approved successfully !!!,Now congratulate our employee and wish him/her a joyful, serene & adventerous leave on behalf of FAME MEDICAL HOSPITAL  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				echo "approved";
			}else{
				echo "unapproved";
			}
		}
		

}



?>