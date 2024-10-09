<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			redirect('auth');
		}else{
			 $this->session->set_userdata('last_activity', time()); // update the last activity time
			 $this->load->model('User_dashboard_Model','request');
			 $this->load->model('Hr_Dashboard_Model','hr');
			 $this->load->model('Admin_Dashboard_Model','admin');
			 $this->load->model('employee_performance/Employee_performance_Model','performance');
			}
	}


	public function index(){
		$module_name = "user_dashboard";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$data['profile_info'] = $this->admin->getEmployeeInfo($this->session->userdata('full_name'));
			$data['summary'] = $this->getActivitySummary();
			$this->get_leave_id();
			$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('user_dashboard',$data);
			$this->load->view('footer');
		}
	}

	public function district_autosuggestion(){
		$region_id = $this->input->post('region_id');
        $districts = $this->request->get_district_autosuggestion($region_id);
        if($districts){
            echo "<option>Select district</option>";
            foreach($districts as $row){
                echo "<option value=".$row->id.">".$row->district_name."</option>";
            }

        }else{
            echo "<option>Unknown</option>";
        }
	}

	public function ward_autosuggestion(){
		$district_id = $this->input->post('district_id');
        $wards = $this->request->get_wards_autosuggestion($district_id);

        if($wards){
            echo "<option>Select ward</option>";
            foreach($wards as $row){
                echo "<option value=".$row->id.">".$row->ward_name."</option>";
            }

        }else{
            echo "<option>Unknown</option>";
        }
	}

	function getActivitySummary(){
		$data = array();
		$annual_leave = $this->request->get_annual_leave_details();
		$performance = $this->performance->calculate_employee_total_performance($this->session->userdata('employee_id'),date('Y'));
		if($performance->num_rows() > 0 && $annual_leave){
			$performance = $performance->row();
			$data = array(
				'performance' => $performance,
				'annual_leave' => $annual_leave
			);
		}else{
			$performance = $this->performance->calculate_employee_total_performance($this->session->userdata('employee_id'),(date('Y')-1));
			if($performance->num_rows() > 0 && $annual_leave){
				$performance = $performance->row();
				$data = array(
					'performance' => $performance,
					'annual_leave' => $annual_leave
				);
			}else{
				if($annual_leave){
					$data = array('annual_leave' => $annual_leave);
				}
			}
		}
		return $data;
	}

	public function get_leave_id(){

		$leave_ids = $this->request->check_employee_leave_ids();
		$this->check_leave_benefits($leave_ids);
	}

	 public function check_leave_benefits($data){
        $leave_benefit = false; //this is to verify if employee already took his/her leave benefit this/previous year, we set true if he already took and false if not

        if($data){
            foreach($data as $row){
                $value = $this->request->check_leave_benefits_model($row->leave_id);
                if($value == true){
                	$leave_benefit = true;
                }
            }
        }

        $this->session->set_userdata('benefit',$leave_benefit);
    }

    public function create_leave(){
    	// dont forget to use leave_id of this year
    	$names = $this->input->post('names');
    	$today = $this->input->post('today');
    	$phone_number = $this->input->post('phone_number');
    	$number_days = $this->input->post('days');
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
    	$nauli_kiasi = $this->input->post('nauli');
    	$nauli_count = $this->input->post('nauli_times');
    	$chakula_kiasi = $this->input->post('chakula');
    	$chakula_count = $this->input->post('chakula_times');
    	$maradhi_kiasi = $this->input->post('maradhi');
    	$maradhi_count = $this->input->post('maradhi_times');

    	$year = date('Y');
    	$employee_id = $this->session->userdata('employee_id');

    	$leave_id = $this->request->get_thisyear_leave_id($employee_id,$year);
    	//first we need to check the number of days left 
    	if($leave_id){
    		$current_leave_id = $leave_id->leave_id;
    		$days_left = $leave_id->days_left;

    		//double check if statement to make sure all conditions are catched
    		//return the max number left user can request a leave

    		if($number_days <= $days_left){
    			$data = array(
    			'leave_id' => $current_leave_id,
    			'request_date' => $today,
    			'days_off' => $number_days,
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
    			'nauli_kiasi' => $nauli_kiasi,
    			'nauli_count' => $nauli_count,
    			'chakula_kiasi' => $chakula_kiasi,
    			'chakula_count' => $chakula_count,
    			'maradhi_kiasi' => $maradhi_kiasi,
    			'maradhi_count' => $maradhi_count
    		);
    			//in here we tested db rollback and complete
    			$create_leave_data = $this->request->create_employee_leave($employee_id,$phone_number,$data);

    		if($create_leave_data){
    			echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Waooooh!! </strong> Congratulation leave created successful, now visit your <strong>Head of department</strong> for signature <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    		}else{
    			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry!! We have database problem. Please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    		}
    		}else{
    			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Sorry!! </strong>Only '.$days_left.' days left for you to complete 28days of your annual leave <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    		}
    		
    	}else{
    		echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry!! Our system failed to retrieve your Annual leave id since your head of department not scheduled your annual leave id <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    	}
    }

	//planning to change it so that to be performed using only js
	public function get_end_date(){
		$days = $this->input->post('days');
		$start_date = $this->input->post('start_date');
		$start_date = date_create($start_date);
		date_add($start_date, date_interval_create_from_date_string("$days days"));
		$end_date = date_format($start_date, "Y-m-d");
		echo "<input type='date' class='form-control' name='end_date' id='end_date' readonly value=$end_date>";

	}

	function create_Emergency_leave(){
		$data = array(
				'employee_id' => $this->session->userdata('employee_id'),
				'date' => $this->input->post('today'),
				'emergency_days' => $this->input->post('emergency_days'),
				'start_date' => $this->input->post('start_date1'),
				'end_date' => $this->input->post('end_date1'),
				'sababu' => $this->input->post('sababu'),
				'comments' => $this->input->post('comments')
		);

		if($this->request->create_emergency_leave($data)){
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation!! </strong>Emergency days request successfully now vist your department head for approval <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Sorry!! </strong>Our system failed to submit your request please contact our awesome system administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
	}

}


 ?>