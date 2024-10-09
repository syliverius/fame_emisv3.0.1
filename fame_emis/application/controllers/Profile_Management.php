<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Management extends CI_Controller{

	public function __construct(){
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
			redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			redirect('auth');
		}else{
			date_default_timezone_set('UTC');
			 $this->session->set_userdata('last_activity', time()); // update the last activity time			
			 $this->load->model('Registration_Model','get');
			 $this->load->model('Login_Model','login');
			 $this->load->model('Admin_Dashboard_Model','admin');
			 $this->load->model('Hr_Dashboard_Model','hr');
			}
		}

	public function index(){
		$module_name = "profile_management";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$data['profile_info'] = $this->admin->getEmployeeInfo($this->session->userdata('full_name')); // now seemed bad programming
			$data['professional'] = $this->admin->get_professional();
			$data['department'] = $this->hr->getDepartments();
			$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('profile',$data);
			$this->load->view('footer');
		}
	}

	public function  edit_profile_information(){
        $proffesion_id = $this->admin->get_professional_id($this->input->post('professional'));
        $department_id = $this->admin->get_department_name($this->input->post('Department'));
        $employee_id = $this->input->post('employee_id');

        $data = array(
            'employee_id' => $employee_id,
            'names' => $this->input->post('fullName'),
            'department_id' => $department_id->department_id,
            'position' => $this->input->post('Position'),
            'gender' => $this->input->post('gender'),
            'phone_number' => $this->input->post('phone'),
            'dob' => $this->input->post('dob'),
            'profession_id' => $proffesion_id->id,
            'hiring_date' => $this->input->post('hired_date')
        );
      
        if($this->admin->update_employee_information($employee_id,$data)){
        	$logs = array(
        		'employee_id' => $this->session->userdata('employee_id'),
        		'action_name' => 'Profile editing',
        		'description' => 'Some changes on employee profile were made',
        		'time_stamp' => strtotime('now')
        	);
        	$this->admin->save_logs($logs);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> Congratulation your profile information updated suceessful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry failed to update employee information contact our awesome programmer for more information<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }

    public function change_user_password(){
    	$employee_id = $this->input->post('employee_id');
    	$current_password = $this->input->post('currentPassword');
    	$new_password = $this->input->post('newpassword');
    	$retype_new_password = $this->input->post('renewpassword');

    	if($new_password <> $retype_new_password){
    		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">The password you typed do not match, retype again <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    	}else{
    		
    		if($this->login->check_password_existance($employee_id,md5($current_password))){
    			$data = array('password' => md5($new_password));
    			if($this->login->change_password($employee_id,$data)){
    				$logs = array(
		        		'employee_id' => $this->session->userdata('employee_id'),
		        		'action_name' => 'Profile editing',
		        		'description' => 'Some changes on employee profile were made',
		        		'time_stamp' => strtotime('now')
        			);
        			$this->admin->save_logs($logs);
    				echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Password changed successful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    			}else{
    				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Database error. Please contact our administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    			}
    		}else{
    			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect current Password <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    		}
    	}

    }
}

?>