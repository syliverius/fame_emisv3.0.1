<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Hr_Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			redirect('auth');
		}else{
			 $this->session->set_userdata('last_activity', time()); // update the last activity time
			 $this->load->model('Hd_Leave_Approval_Model','approval');
			 $this->load->model('Hr_Dashboard_Model','hr');
			 $this->load->model('Create_Roaster_Model','create');
			 $this->load->model('User_dashboard_Model','request');
			 $this->load->model('Attendance_Model','attendance');
			 $this->load->model('Admin_Dashboard_Model','admin');
		}
	}

	public function index(){
		$module_name = "hr_dashboard";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$data['values'] = $this->getEmployeeToApprove();
			$data['department'] = $this->getDepartments(); //this will be deleted in future
			$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('hr/hr_dashboard',$data);
			$this->load->view('footer');
		}
	}


	public function getEmployeeToApprove(){

		$toBeApproved = array();
		
		$data = $this->hr->getAllUnapprovedEmployee();
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
		$this->load->view('hr/more_details_view',$data);

	}

	public function hr_update_employee_leave(){

		$benefit_id = $this->input->post('benefit_id');
		$days_off = $this->input->post('days');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$region = $this->input->post('region');
		$district = $this->input->post('district');
		$ward = $this->input->post('ward');
		$amount = $this->input->post('amount');
		$mtegemezi1 = $this->input->post('mtegemezi1');
		$mtegemezi2 = $this->input->post('mtegemezi2');
		$mtegemezi3 = $this->input->post('mtegemezi3');
		$mtegemezi4 = $this->input->post('mtegemezi4');
		$mtegemezi5 = $this->input->post('mtegemezi5');
		$hr_comments = $this->input->post('comments');
		$nauli_kiasi = $this->input->post('nauli');
    	$nauli_count = $this->input->post('nauli_times');
    	$chakula_kiasi = $this->input->post('chakula');
    	$chakula_count = $this->input->post('chakula_times');
    	$maradhi_kiasi = $this->input->post('maradhi');
    	$maradhi_count = $this->input->post('maradhi_times');

		$hr_update_data = array(
			'days_off' => $days_off,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'mkoa' => $region,
			'wilaya' => $district,
			'kata' => $ward,
			'amount' => $amount,
			'mtegemezi_1' => $mtegemezi1,
			'mtegemezi_2' => $mtegemezi2,
			'mtegemezi_3' => $mtegemezi3,
			'mtegemezi_4' => $mtegemezi4,
			'mtegemezi_5' => $mtegemezi5,
			'hr_comment' => $hr_comments,
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
	    		'action_name' => 'Annual Leave Update HR panel',
	    		'description' => 'leave info for '.$prev_info->names.' changed : leave days changed from '.$prev_info->days_off.' => '.$days_off.',start date changed from'.$prev_info->start_date.' => '.$start_date.',end date chaged from '.$prev_info->end_date.' => '.$end_date.',Mkoa chaged from '.$this->request->get_region_name($prev_info->mkoa)->region_name.' => '.$this->request->get_region_name($region)->region_name.' , Wilaya chaged from '.$this->request->get_district_name($prev_info->wilaya)->district_name.' => '.$this->request->get_district_name($district)->district_name.' , ward chaged from '.$this->request->get_ward_name($prev_info->kata)->ward_name.' => '.$this->request->get_ward_name($ward)->ward_name.' , Leave benefit chaged from '.$prev_info->amount.' => '.$amount,
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
			$this->session->set_flashdata('hr_update_message','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Leave details for <span>an employee</span> updated successful, now continue with leave approval!!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect('hr_dashboard');
		}else{
			//also we will set frash data for error
		}
	}

	function reject_employee_leave(){
		$benefit_id = $this->input->post('benefit_id');
		$names = $this->input->post('names');
		if($this->hr->reject_employee_request($benefit_id)){

			//create log
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Annual Leave Update HR panel',
	    		'description' => 'Annual leave request for '.$names.' was rejected',
	    		'time_stamp' => strtotime('now'),
	    		'severity' => 'fatal'
			);
        	$this->admin->save_logs($logs);
			$this->session->set_flashdata('hr_update_message','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Leave rejected successfully, for employee to apply again he must follow the previous procedure <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		
		}
	}


	public function hr_leave_approval(){
		$data =array();
		$benefit_id = $this->input->post("ids");
		$names = $this->input->post('names');
		$today = date('Y-m-d');

		//from the database check the benefits of employee,
		$get_benefit_amaount = $this->hr->get_Benefit_info($benefit_id);

		if($get_benefit_amaount){
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Annual Leave Approval HR panel',
	    		'description' => 'Annual leave request for '.$names.'approved successful',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);
			$amount = $get_benefit_amaount->amount;
			if($amount > 0){
				$data = array(
				'hr_sign' => true,
				'hr_id' => $this->session->userdata('employee_id'),
				'hr_sign_date' => $today		
				);
				
				$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'><i class='bi bi-check-circle me-1'></i>Employee leave approved successful!!!, Now tell the employee to visit accoutant office to collect his/her leave benefit <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

			}else{
				$data = array(
				'hr_sign' => true,
				'hr_id' => $this->session->userdata('employee_id'),
				'hr_sign_date' => $today,	
				'accoutant_sign' => true,
				'accountant_id' => $this->session->userdata('employee_id'),
				'accoutant_sign_date' => $today	
				);
				$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'><i class='bi bi-check-circle me-1'></i>Employee leave approved successfully !!!,Now congratulate our employee and wish him/her a joyful, serene & adventerous leave on behalf of FAME MEDICAL HOSPITAL  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
			}
			$update_off_days = array(
				'leave_id' => $get_benefit_amaount->leave_id,
				'days_off' => $get_benefit_amaount->days_off
			);
			$result = $this->hr->update_hr_approval($benefit_id,$data,$update_off_days);

			if($result){
				$this->session->set_flashdata('hr_success_message',$message);
				echo "approved";
			}else{
				echo "unapproved";
			}
		}

	}

	function who_went_on_leave(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$data['title'] = "List employee who Went on leave between ".$start_date." and ".$end_date;
		$returned = $this->hr->getWhoWhentOnLeave($start_date,$end_date);
		if($returned->num_rows() > 0){
			$data['data'] = $returned->result();
			$this->load->view('hr/leaves_spefics_report',$data);
		}else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Sorry!!  There is no any employee who went on leave between the specified dates  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		}

	}

	function who_coming_from_leave(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$data['title'] = "List employee who're coming from leave between ".$start_date." and ".$end_date;
		$returned = $this->hr->getWhoComingFromLeave($start_date,$end_date);
		if($returned->num_rows() > 0){
			$data['data'] = $returned->result();
			$this->load->view('hr/whois_coming_from_leave_report',$data);
		}else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Sorry!!  There is no any employee who is coming from leave in between ".$start_date." and ".$end_date." <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		}
	}


	public function getEmployeeLeaveHistory(){
		$employee_names = $this->input->post('names');
		$getEmployeeId = $this->hr->getEmployeeId($employee_names);
		$info['employee_id'] = $getEmployeeId->employee_id;
		$this->load->view('user_leaves/annual_leave_history.php',$info);
	}

	function who_to_be_on_leave(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$data['title'] = "List employee who to be on leave between ".$start_date." and ".$end_date;
		$returned = $this->hr->getWhoIsGoingToLeave($start_date,$end_date);
		if($returned->num_rows() > 0){
			$data['data'] = $returned->result();
			$this->load->view('hr/leaves_spefics_report',$data);
		}else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Sorry!!  There is no any employee who went on leave between the specified dates  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		}
	}

	public function who_to_be_on_leave2(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$returned = $this->hr->getWhoIsGoingToLeave($start_date,$end_date);
		$i = 1;
		if($returned){
			foreach($returned as $row){
						$getEmployeeDetails = $this->hr->check_Department_Id_get_Name($row->employee_id);
						if($getEmployeeDetails){
							$getDepartmentName = $this->approval->get_department_name($getEmployeeDetails->department_id);
							if($getDepartmentName){
								//calculate number of days left
								$date1 = new DateTime(); 
								$date2 = new DateTime($row->start_date);
								$diff = date_diff($date2, $date1);
								$months = $diff->m;
								$days = $diff->d;
								//print the result
								echo "
								<tr>
					                <td>$i</td>
					                <td>$getEmployeeDetails->names</t>
					                <td>$row->start_date</td>
					                <td>$months months $days days</td>
					                <td>$getDepartmentName->department_name</td>
				            	</tr>";
				            	$i++;
							}
						}
			}
		}else{

			echo "<tr><td colspan='6'><div class='alert alert-danger alert-dismissible fade show' role='alert'> Sorry!!  There is no any employee who are going on leave for the specified dates  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></td></tr>";
		}
	}

	public function hr_roaster_summary(){
		$data = array();
		$getDepartment_name = $this->input->post('deparment');
		$year = $this->input->post('year'); 
		 $data['dept_name'] =  $getDepartment_name;
		 $data['year'] = $year;

		$get_dept_data = $this->roaster_table_data($getDepartment_name,$year);

		if (count($get_dept_data) > 0) {
			$data['roaster_info'] = $get_dept_data;
		}
		
		$this->load->view('reports/department_Summary', $data);	//add print and export on view
	}

	public function roaster_table_data($dept_name,$year){
		//here we will pass the current year
		$current_year = $year;
		$returned_result = $this->hr->get_roaster_data($current_year);
		$get_dept_id = $this->hr->get_dept_id($dept_name);
		$roaster_data= array();
		if($returned_result){
			$i = 1;
			foreach($returned_result as $row){
				$names = $this->create->check_name_and_department($row->employee_id,$get_dept_id->department_id);
				if($names){
					$roaster_data[] = array(
						'number' => $i,
						'employee_id' => $names->employee_id,
						'names' => $names->names, //this also wants to be retrieved using foreach loop
						'startDate' => $row->start_date,
						'endDate' => $row->end_date,
						'reason' => $row->reason,
						'comments' => $row->comments
					);
					$i++;
				}
			}

		}else{
			//leave detail table is empty right now
		}

		return $roaster_data;
	}

	public function district_autosuggestion(){
		$region_name = $this->input->post('region_name');

		$region_id = $this->request->get_region_id($region_name);

		$districts = $this->request->get_district_autosuggestion($region_id->id);
		echo "<select class='form-control' name='district' id='district' onchange='fill_Wards()'>
				<option>Select District</option>";
		if($districts){
			
			foreach($districts as $row){
				echo "
					<option>$row->district_name</option>
				";
			}

		}else{
			echo "<option>Unknown</option>";
		}
		echo "</select>";
	}

	public function ward_autosuggestion(){
		$district_name = $this->input->post('district_name');
		$district_id = $this->request->get_district_id($district_name);
		echo "<select class='form-control' name='ward' id='ward'>
				<option>Select Ward</option>";
		if($district_id){
			$wards = $this->request->get_wards_autosuggestion($district_id->id);
		
		if($wards){
			
			foreach($wards as $row){
				echo "
					<option>$row->ward_name</option>
				";
			}

		}else{
			echo "<option>Unknown</option>";
		}
	}else{
		echo "<option>Unknown</option>";
	}	
		echo "</select>";
	}

}


?>