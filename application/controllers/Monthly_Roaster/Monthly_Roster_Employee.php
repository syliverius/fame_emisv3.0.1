<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Monthly_Roster_Employee extends CI_Controller{
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
			}
			
		}

		function employee_roaster_summary(){
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$roster = $this->input->post('roster_type');
			$department_id = $this->session->userdata('department_id');
			$retrieved_data = array();

			if($roster == 1){
				$data = array(
				'month' => $month,
				'year' => $year,
				'department_id' => $department_id,
				'employee_id' => $this->session->userdata('employee_id') 
			);

			//if zero field selected means record do not exists
			$result = $this->roaster->get_employee_month_summary($data);
			$shifts = $this->get_Shifts_Names();
			if($result){
				$mothly_shift['data'] = array('month' => $month,
											  'dept_name' => $this->session->userdata('department_name'), 
											  'year' => $year,
											  'shifts' => $shifts,
											  'current_shifts' => $result
											); 

				$this->load->view('user_leaves/mothly_roster_presentation',$mothly_shift);
			}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!... The roster of selected month do not exists <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			} }else{
				//here we implement viewing of department roster on employee side

				$return = $this->roaster->check_roaster_existance($department_id,$year,$month);
			if($return){
				$shifts = $this->get_Shifts_Names2($department_id);
				$names = $this->roaster->get_Department_Members($department_id);
				foreach($names as $row){
					$data = $this->roaster->get_editable_shifts_data($row->employee_id,$month);
					$retrieved_data[] = array('employee_id' => $row->employee_id,
												'names' => $row->names,
												'shifts' => $data
											) ; //we'll count on the rotation of printing on table

				}
					$data['data'] = array('year' => $year,
										'dept_name' => $this->session->userdata('department_name'),
										'month' => $month,
										'shifts' => $shifts,
										'shifts_present' => $retrieved_data,
									);
					$this->load->view('monthly_roaster/employee_department_monthly_roster',$data);
			}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!!... Roster of <b>'.$month.' '.$year.'</b> Do not exists <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}

		}

		function get_Shifts_Names(){
			$shifts = $this->roaster->getShifts($this->session->userdata('department_id'));
			return $shifts;
		}

		function get_Shifts_Names2($department_id){
			$shifts = $this->roaster->getShifts($department_id);
			return $shifts;
		}

	}




?>