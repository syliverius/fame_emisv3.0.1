<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_Approval_Dept_Head extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			redirect('auth');
		}else{
             date_default_timezone_set('UTC');
			 $this->session->set_userdata('last_activity', time()); // update the last activity time
			 $this->load->model('Hd_Leave_Approval_Model','approval');
			 $this->load->model('Hr_Dashboard_Model','hr');
			 $this->load->model('Admin_Dashboard_Model','admin');
			 $this->load->model('User_dashboard_Model','user');
		}
	}

public function index(){
	$module_name = "annual_leave_head";
    if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
		$data['values'] = $this->getEmployeeToApprove();
		$module['module_name'] = $module_name;
		$this->load->view('head',$module);
		$this->load->view('hd/hd_leave_approval',$data);
		$this->load->view('footer');
	}
}


	public function getEmployeeToApprove(){

		$toBeApproved = array();
		
		$data = $this->approval->getAllUnapprovedEmployee();
		if ($data) {
			foreach($data as $row){
				$getEmpId= $this->approval->getEmployeeId($row->leave_id); //return row
				if($getEmpId){
					$checkDeptId = $this->approval->check_Department_Id_get_Name($getEmpId->employee_id);
					if($checkDeptId){
						$toBeApproved[] = array (
							'benefit_id' => $row->benefit_id,
							'names' => $checkDeptId->names,
							'start_date' => $row->start_date,
							'end_date' => $row->end_date,
							'region' => $row->mkoa,
							'district' => $row->wilaya,
							'ward' => $row->kata,
							'request_data' => $row->request_date,
							'phone_number' => $checkDeptId->phone_number,
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
		}else{
			//if no any data retrieved
		}

		return $toBeApproved;
	}

	public function more_details(){
		$benefit_id = $this->input->post("ids");

		$data['leave_info'] = $this->admin->getEmployeeAnnualLeaveInfo($benefit_id);
		$this->load->view('hd/view_more_employee_leave_form',$data);
	}

	public function approval(){
		$benefit_id = $this->input->post("ids");
		$names = $this->input->post("names");
		$today = date('Y-m-d');
		$data = array(
			'dept_head_sign' => true,
			'dept_head_id' => $this->session->userdata('employee_id'),
			'dept_sign_date' => $today		
		);

		$result = $this->approval->update_dept_head_approval($benefit_id,$data);

		if($result){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Annual leave approval',
	    		'description' => 'Annual leave records for '.$names.' was approved successful',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);

			$this->session->set_flashdata('hd_success_message','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Leave approved successful, now tell the employer to visit HR office !!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			echo "approved";
		}
	}

	public function hd_update_employee_leave(){
		$benefit_id = $this->input->post('benefit_id');
		$days_off = $this->input->post('days');
		$names = $this->input->post('names');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		
		$hd_update_data = array(
			'days_off' => $days_off,
			'start_date' => $start_date,
			'end_date' => $end_date
		);

		$prev_info = $this->admin->getEmployeeAnnualLeaveInfo($benefit_id); 
		$result = $this->hr->hr_update_leave_model($benefit_id,$hd_update_data);
		
		if($result){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Annual Leave Update',
	    		'description' => 'leave info for '.$prev_info->names.' changed : leave days changed from '.$prev_info->days_off.' => '.$days_off.',start date changed from'.$prev_info->start_date.' => '.$start_date.' and end date chaged from '.$prev_info->end_date.' => '.$end_date,
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);

			$this->session->set_flashdata('hd_update_message','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Leave details for <span>'.$names.'</span> updated successful, now continue with leave approval!!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect('Leave_Approval_Dept_Head');
		}else{
			//also we will set frash data for error
		}
	}

} 


?>