<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class Emergency_leave extends CI_Controller{

 	function __construct(){
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); //update time activity session 
	             date_default_timezone_set('UTC');
				 $this->load->model("Hd_Leave_Approval_Model","hd");
				 $this->load->model("hr_dashboard_model","hr");
				 $this->load->model('Admin_Dashboard_Model','admin');
			}
		}

	function index(){
		$module_name = "emergency_leave_form";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
        	$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$data['emergency'] = $this->hd->getUnapprovedEmergencyLeave();
			$this->load->view('hd/hd_emergency_approval',$data);
			$this->load->view('footer');
		}
	}

	function View_emergency(){
		$emergency_id = $this->input->post('emergency_id');
		$result = $this->hd->getEmergencyLeaveInfo($emergency_id);
		$data['emergency_details'] = $result;
		$this->load->view('user_leaves/emergency_leave_details',$data);
	}

	function update_employee_emergency(){
		$names = $this->input->post('names'); 
		$emergency_id = $this->input->post('emergency_id');
		$emergency_days = $this->input->post('emergency_days');
		$start_date = $this->input->post('start_date1');
		$end_date = $this->input->post('end_date1');
		$sababu = $this->input->post('sababu');
		$comments = $this->input->post('comments'); 
		$data = array (
			'emergency_id' => $emergency_id,
			'emergency_days' => $emergency_days,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'sababu' => $sababu,
			'comments' => $comments
		);

		$prev_info = $this->hd->getEmergencyLeaveInfo($emergency_id);
		if($this->hd->update_emergency_leave($data)){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Emergency leave Updation',
	    		'description' => 'Emergency leave info for '.$prev_info->names.' changed : leave days changed from '.$prev_info->emergency_days.' => '.$emergency_days.',start date changed from'.$prev_info->start_date.' => '.$start_date.',end date chaged from '.$prev_info->end_date.' => '.$end_date.',Reason chaged from '.$prev_info->sababu.' => '.$sababu.' , comments chaged from '.$prev_info->comments.' => '.$comments,
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
			$this->session->set_flashdata('emergency_leave_sms','<div class="alert alert-success alert-dismissible fade show" role="alert">Congraturation,emergency leave record for <b>'.$names.'</b> updated successful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		}else{
			$this->session->set_flashdata('emergency_leave_sms','<div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry!!,emergency leave record for <b>'.$names.'</b> Failed to update. Please contact our awesome admin for more information. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		}

	}

	function hd_approve_emergency_leave(){
		$emergency_id = $this->input->post('emergency_id');
		$names = $this->input->post('employee_names');
		$data = array(
			'hd_signature' => 1,
			'hd_date' => date('Y-m-d'),
			'hd_id' => $this->session->userdata('employee_id'),
			'hr_signature' => 1,
			'hr_id' => $this->session->userdata('employee_id'),
			'hr_date' => date('Y-m-d')
		);
		if($this->hd->emergency_leave_approval($emergency_id,$data)){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Emergency leave Head of department panel',
	    		'description' => 'Emergency leave info for '.$names.' approved successful',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
			$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert">Congraturation,emergency leave record for <b>'.$names.'</b> approved successful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}else{
			$sms = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry!!,emergency leave record for <b>'.$names.'</b> failed to be approved, please contact our awesome administrator for more clarification <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
		$this->session->set_flashdata('emergency_leave_sms',$sms);
	}

	function hd_reject_emergency(){
		$emergency_id = $this->input->post('emergency_id');
		$names = $this->input->post('employee_names');
		if($this->hd->delete_emergency_record($emergency_id)){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Emergency leave panel',
	    		'description' => 'Emergency leave info for '.$names.' Rejected ',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
			$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert">Congraturation,emergency leave record for <b>'.$names.'</b> Humbly declined successful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}else{
			$sms = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry!!,emergency leave record for <b>'.$names.'</b> failed to be approved, please contact our awesome administrator for more clarification <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
		$this->session->set_flashdata('emergency_leave_sms',$sms);
	}

	function hd_send_to_hr(){
		$emergency_id = $this->input->post('emergency_id');
		$names = $this->input->post('employee_names');
		$data = array('hd_signature' => 1,
						'hd_id' => $this->session->userdata('employee_id'),
						'hd_date' => date('Y-m-d'),
						'hr_signature' => 0
			);
		if($this->hd->send_to_hr($emergency_id,$data)){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Emergency leave Head of department panel',
	    		'description' => 'Emergency leave info for '.$names.' Send to HR ',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
			$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert">Congraturation,emergency leave record for <b>'.$names.'</b> Humbly Sent to HR, tell the employee to visit hr office for approval <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}else{
			$sms = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry!!,emergency leave record for <b>'.$names.'</b> failed to be sent to HR off, Contact our awesome administrator for more info <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
		$this->session->set_flashdata('emergency_leave_sms',$sms);
	}

	function hr_emergency_review(){
		$module_name = "hr_emergency_approval";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
        	$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$data['emergency'] = $this->hr->getHrUnapprovedEmergencyLeave();
			$this->load->view('hr/emergency_leave',$data); //prepare unapproved leave data 
			$this->load->view('footer');
		}
	}

	function hr_view_emergency(){
		$emergency_id = $this->input->post('emergency_id');
		$result = $this->hr->getEmergencyLeaveInfo($emergency_id);
		$data['emergency_details'] = $result;
		$this->load->view('hr/emergency_leave_details',$data);
	}

	function hr_approve_emergency_leave(){
		$emergency_id = $this->input->post('emergency_id');
		$names = $this->input->post('employee_names');
		$data = array(
			'hr_signature' => 1,
			'hr_id' => $this->session->userdata('employee_id'),
			'hr_date' => date('Y-m-d')
		);
		if($this->hr->emergency_leave_approval($emergency_id,$data)){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Emergency leave HR of department panel',
	    		'description' => 'Emergency leave info for '.$names.' approved successful ',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
			$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert">Congraturation,emergency leave record for <b>'.$names.'</b> approved successful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}else{
			$sms = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry!!,emergency leave record for <b>'.$names.'</b> failed to be approved, please contact our awesome administrator for more clarification <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
		$this->session->set_flashdata('emergency_leave_sms',$sms);
	}

	function hr_view_emergency_history(){
		$employee_id = $this->input->post('employee_id');
		$result['details'] = $this->hr->get_emergency_history($employee_id);
		$result['employee_id'] = $employee_id;
		$this->load->view('hr/emergency_leave_history',$result);
	}

 }

?>