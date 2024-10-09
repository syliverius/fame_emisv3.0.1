<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Reports extends CI_Controller{

		function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); // update the last activity time
				$this->load->model('Create_Roaster_Model','create');
				$this->load->model('Reports_Model');
				$this->load->model('Attendance_Model','attendance');
				$this->load->model('Notification_Model','notify');
				$this->load->model('Reports_Model','report');
			}
		}

		public function book2_report(){
			$module_name = "book2_report";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('reports/book2_report');
				$this->load->view('footer');
			}
		}

		public function create_Book2_Report(){
			$data = array();
			$output = array();
			$year = $this->input->post('year_selected');
			$data['year'] = array(
								'year_selected' => $year
							);			

			//return all dept data based on year selected 
			$returned_data = $this->Reports_Model->get_book10_data($year)->result();
			
			if($returned_data){
				$i = 1;
				foreach($returned_data as $row){
					$names = $this->Reports_Model->get_Employee_name($row->employee_id);
					if($names){
						$jan = $feb = $mach = $apr = $may = $jun = $jul = $aug = $sept = $oct = $nov = $dec = "";
						if(date("F",strtotime($row->start_date)) == 'January'){
							$jan = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($jan);
						}else if (date("F",strtotime($row->start_date)) == 'February') {
							$feb = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($feb);
						}else if (date("F",strtotime($row->start_date)) == 'March') {
							$mach = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($mach);
						}else if (date("F",strtotime($row->start_date)) == 'April') {
							$apr = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($apr);
						}else if (date("F",strtotime($row->start_date)) == 'May') {
							$may = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($may);
						}else if (date("F",strtotime($row->start_date)) == 'June') {
							$jun = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($jun);
						}else if (date("F",strtotime($row->start_date)) == 'July') {
							$jul = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($jul);
						}else if (date("F",strtotime($row->start_date)) == 'August') {
							$aug = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($aug);
						}else if (date("F",strtotime($row->start_date)) == 'September') {
							$sept = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($sept);
						}else if (date("F",strtotime($row->start_date)) == 'October') {
							$oct = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($oct);
						}else if (date("F",strtotime($row->start_date)) == 'November') {
							$nov = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($nov);
						}else {
							$dec = $this->check_leave_type($row->reason);
							$days_left = $this->check_days_left($dec);
						}

						$output[] = array(
									'i' => $i,
									'names' => $names->names,
									'proffesion' => $names->professional_name,
									'days_left' => $days_left,
									'jan' => $jan,
									'feb' => $feb,
									'mach' => $mach,
									'apr' => $apr,
									'may' => $may,
									'jun' => $jun,
									'jul' => $jul,
									'aug' => $aug,
									'sept' => $sept,
									'oct' => $oct,
									'nov' => $nov,
									'dec' => $dec,
									'comments' => $row->comments
								);
						$i++;
					}
				}
				
			}
			$data['output'] = $output;
			$this->load->view('reports/book2_summary',$data);
		}

		public function check_leave_type($leave_reasons){
			if($leave_reasons == "Likizo"){
				return "L";
			}else if($leave_reasons == "Kozi fupi"){
				return "K";
			}else if($leave_reasons == "Mafunzo ya kujiendeleza"){
				return "M";
			}else{
				return "N";
			}
		}

		public function check_days_left($reason){
			if($reason == "L" || $reason == "K" || $reason == "N"){
				return "28";
			}else{
				return "";
			}
		}

		function annual_leave_roster(){
			$module_name = "annual_leave_roster";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('user_leaves/annual_leave_roster');
				$this->load->view('footer');
			}
		}

		function system_audit(){
			$module_name = "system_audit";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('reports/system_audit');
				$this->load->view('footer');
			}
		}

		function generate_audit_trial(){
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$start_date_time_stamp = strtotime($start_date . ' 00:00:00');
			$end_date_time_stamp = strtotime($end_date . ' 23:59:59');
			$data = array(
				'start_date' => $start_date,
				'end_date' => $end_date,
				'trials' => $this->report->generate_system_trial_report($start_date_time_stamp,$end_date_time_stamp)
			);

			$this->load->view('reports/system_audit_report',$data);
		}

	}
?>