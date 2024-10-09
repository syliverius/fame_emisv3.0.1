<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

	class Monthly_Roaster_Hd extends CI_Controller{

		function __construct()
		{
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); // update the last activity time

				$this->load->model('Monthly_Roaster/Head_Of_Dept','roaster');
				$this->load->model('Create_Roaster_Model');
				$this->load->model('Attendance_Model','attendance');
				$this->load->model('Admin_Dashboard_Model','admin');
				$this->load->model('Hd_Leave_Approval_Model','hd');
			}
			
		}

		function index(){
			$module_name = "monthly_roster_hd";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('Monthly_Roaster/montly_report_hd_home');
				$this->load->view('footer');
			}
		}

		public function present_roaster(){
			$department_id = $this->input->post('department_id');
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$current_month = DateTime::createFromFormat('F', date('F'));
			$supp_month = DateTime::createFromFormat('F', $month);

			//first of all we check the existance of the same roaster by checking year and month for a given department id
			$return = $this->roaster->check_roaster_existance($department_id,$year,$month);
			$shifts = $this->get_Shifts_Names($department_id);
			$names = $this->roaster->get_Department_Members($department_id);
			$retrieved_data = array();
			if(($current_month < $supp_month || date('Y') < $year || ($current_month == $supp_month && (date('d'))<= 5 )) && $return){ //This works before we start month && new month till on 5th
				foreach($names as $row){
					$data = $this->roaster->get_editable_shifts_data($row->employee_id,$month);
					$retrieved_data[] = array('employee_id' => $row->employee_id,
												'names' => $row->names,
												'shifts' => $data
											) ;

				}
				$data['data'] = array('year' => $year,
										'month' => $month,
										'shifts' => $shifts,
										'shifts_present' => $retrieved_data,
										'department_id' => $department_id
									);

				$this->load->view('monthly_roaster/editable_roaster',$data);

			}else if($current_month == $supp_month && $return && (date('d'))<=20){
				foreach($names as $row){
					$data = $this->roaster->get_editable_shifts_data($row->employee_id,$month);
					$retrieved_data[] = array('employee_id' => $row->employee_id,
												'names' => $row->names,
												'shifts' => $data
											) ;

				}
				$data['data'] = array('year' => $year,
										'month' => $month,
										'shifts' => $shifts,
										'shifts_present' => $retrieved_data,
										'department_id' => $department_id
									);
				$this->load->view('monthly_roaster/mid_month_roster_edit',$data);

			}else if($return){
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!... Roster already exists and cannot be edited since the today date is already passed 20th of '.$month.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
					//now display roaster with names on it 
				$data['data'] = array('names' => $this->roaster->get_Department_Members($department_id),
					'year' => $year,
					'month' => $month,
					'shifts' => $shifts,
					'department_id' => $department_id
				);
					$this->load->view('monthly_roaster/new_roaster',$data);
				}
			// }

		}

		function get_Shifts_Names($department_id){
			$shifts = $this->roaster->getShifts($department_id);
			return $shifts;
		}

		function publish_roaster(){
			$month_name = $this->input->post('month');
			$month = $this->input->post('month'); //February 
			$year = $this->input->post('year'); //2024
			$department_id = $this->input->post('department_id');
			$data = array();

			$date = new DateTime("$year-$month-01"); //get the first day of the month
			$number_of_days = $date->format('t');

			//first of all lets get employee id using session department id 
			// $employee = $this->roaster->get_Department_Members($this->session->userdata('department_id'));
			$employee = $this->roaster->get_Department_Members($department_id);
			//THE ABOVE CODE NEEDS TO CHANGE TO RETRIEVE ALL INFO BASED ON SUPPLIED DEPT ID
			$month = $date->format('m');
			foreach($employee as $employee){
				for($i = 1; $i <= $number_of_days; $i++){
					$date_string = $i.'/'.$month.'/'.$year;
					$date_format = "d/m/Y";
					$date_obj = DateTime::createFromFormat($date_format, $date_string);
					$db_date_str = $date_obj->format('Y-m-d');
					$data = array('employee_id' => $employee->employee_id,
							 'date' => $db_date_str,
							 'shift_type_abbrev' => $this->input->post($employee->employee_id.'_'.$i)
						 );

					 if($this->roaster->create_roaster($data)){
					 }
				}
			}
			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Monthly roster',
	    		'description' => $month_name.' duty roster for '.$this->session->userdata('department_name').' created',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);

			echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Congratulation!.. '.$month_name.' Duty Roster created sucessfully  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

		}

		function update_monthly_roaster(){
			$month = $this->input->post('month');
			$month_name = $this->input->post('month');
			$year = $this->input->post('year');
			$department_id = $this->input->post('department_id');
			$data = array();

			$date = new DateTime("$year-$month-01"); //get the first day of the month
			$number_of_days = $date->format('t');

			//first of all lets get employee id using session department id 
			$employee = $this->roaster->get_Department_Members($department_id);
			$month = $date->format('m');
			foreach($employee as $employee){
				for($i = 1; $i <= $number_of_days; $i++){
					$date_string = $i.'/'.$month.'/'.$year;
					$date_format = "d/m/Y";
					$date_obj = DateTime::createFromFormat($date_format, $date_string);
					$db_date_str = $date_obj->format('Y-m-d');
					$data = array('employee_id' => $employee->employee_id,
							 'date' => $db_date_str,
							 'shift_type_abbrev' => $this->input->post($employee->employee_id.'_'.$i)
						 );
					 if($this->roaster->update_roaster($data)){

					 }
				}
			}

			$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Monthly roster',
	    		'description' => $month_name.' duty roster for '.$this->session->userdata('department_name').' was updated',
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);

			echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Congratulation!.. '.$month_name.' Duty Roster updated sucessfully  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}

		//this function will update the roster in mid of a month and will save its comment and those updates done
		function mid_month_update(){
			$month = $this->input->post('month');
			$month_name = $this->input->post('month');
			$year = $this->input->post('year');
			$department_id = $this->input->post('department_id');
			$comments = $this->input->post('update_reason');
			$data = array();
			$update_history = array();

			$date = new DateTime("$year-$month-01"); //get the first day of the month
			$number_of_days = $date->format('t');

			//first of all lets get employee id using session department id 
			$employee = $this->roaster->get_Department_Members($department_id);
			$month = $date->format('m');
			//loop to check if there is change of shift 
			foreach($employee as $employee){
				$history = array();
				for($i = 1; $i <= $number_of_days; $i++){
					$date_string = $i.'/'.$month.'/'.$year;
					$date_format = "d/m/Y";
					$date_obj = DateTime::createFromFormat($date_format, $date_string);
					$db_date_str = $date_obj->format('Y-m-d');
					$current_shift = $this->get_current_shift($employee->employee_id,$db_date_str);
					$updated_shift = $this->input->post($employee->employee_id.'_'.$i);
					$data = array('employee_id' => $employee->employee_id,
							 'date' => $db_date_str,
							 'shift_type_abbrev' => $updated_shift
						 );
					if($current_shift != $updated_shift){
						$history[] = array('date' => $db_date_str,
											'previous_shift_type_abbrev' => $current_shift,
											'updated_shift_type_abbrev' => $updated_shift
						);
					}

					if($this->roaster->update_roaster($data)){}	 //we do not know how to handle it	
				}
				if(!empty($history)){
					$update_history[$employee->employee_id] = $history;
				}			
			}

			$updates = array('date' => date('Y-m-d'),
						'department_id' => $this->session->userdata('department_id'),
						'updates' => json_encode($update_history),
						'comments' => $comments
				);
			if($this->roaster->save_monthly_roster_changes($updates)){
				$logs = array(
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'action_name' => 'Monthly roster',
	    		'description' => $month_name.' duty roster for '.$this->session->userdata('department_name').' update with reason being : '.$comments,
	    		'time_stamp' => strtotime('now')
			);
        	$this->admin->save_logs($logs);

				echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Congratulation!.. '.$month_name.' Duty Roster updated sucessfully  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Sorry!! We have some technical issue, please contact our awesome administrator for more explanation.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}

		function get_current_shift($employee_id,$date){
			$shift = $this->roaster->getEmployeeShift($employee_id,$date);
			if($shift){
				return $shift->shift_type_abbrev;
			}
		}

		function hd_roaster_summary(){
			$department_name = $this->input->post('department_name');
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$retrieved_data = array();
			$roster_updates = "";

			//first thing first,check the existance of roster
			$department_id = $this->roaster->get_department_id($department_name)->department_id;
			$return = $this->roaster->check_roaster_existance($department_id,$year,$month);
			if($return){
				$shifts = $this->get_Shifts_Names($department_id);
				$names = $this->roaster->get_Department_Members($department_id);
				$roster_updates = $this->roaster->get_roster_updates($department_id,$month,$year);
				foreach($names as $row){
					$data = $this->roaster->get_editable_shifts_data($row->employee_id,$month);
					$retrieved_data[] = array('employee_id' => $row->employee_id,
												'names' => $row->names,
												'shifts' => $data
											) ; //we'll count on the rotation of printing on table

				}
					$data['data'] = array('year' => $year,
										'dept_name' => $department_name,
										'month' => $month,
										'shifts' => $shifts,
										'shifts_present' => $retrieved_data,
										'updates' => $roster_updates
									);
					$this->load->view('monthly_roaster/hd_roster_summary',$data);
			}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!!... Roster of <b>'.$month.' '.$year.'</b> Do not exists <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}//


		//this needs to be modified again to meet the current requirements
		function Create_new_shift(){
			$shift_name = $this->input->post('attr_name');
			$shift_abbrev = $this->input->post('attr_abbr');
			$color = "FFFFFF";
			$department_id = $this->session->userdata('department_id');

			$data = array('name' => $shift_name,
							'abbreviation' => $shift_abbrev,
							'color' => $color,
							'department_ids' => $department_id
						);
			if($this->roaster->Create_new_shift_type($data)){
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1">Congratulation!!!. New shift type created successful .<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1">Sorry!!! .. There is a problem please contact our awesome admin form more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}

		}

		function monthly_department_roster(){
			$module_name = "department_monthly_roster";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('monthly_roaster/monthly_roster_home');
				$this->load->view('footer');
			}
		}
	}

?>