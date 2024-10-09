<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class Dashboard extends CI_Controller{
 	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
            redirect('auth');
        }else{
             $this->session->set_userdata('last_activity', time()); // update the last activity time
			$this->load->model('Dashboard_Model','dashboard');
			$this->load->model('Hr_Dashboard_Model','hr');
			$this->load->model('Admin_Dashboard_Model','admin');
            // $this->load->model('Notification_Model','notify');
		}
	}

	function index(){
		$module_name = "general_dashboard";
		if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('dashboard');
			$this->load->view('footer');
		}
	}

	function view_department_member(){
		$department_id = $this->input->post('department_id');
		$data['members'] = $this->dashboard->get_Department_Members($department_id);
		$data['department_id'] = $department_id;
		$this->load->view('reports/department_members',$data);
	}

	function view_professional_members(){
		$professional_id = $this->input->post('profession_id');
		$data['members'] = $this->dashboard->get_profession_members($professional_id);
		$data['profession_id'] = $professional_id;
		$this->load->view('reports/profession_members',$data);
	}

	function view_present_members(){
		$data['members'] = $this->input->post('shifts');
		$data['department_id'] = $this->input->post('department_id');
		$this->load->view('reports/present_department_members',$data);

	}

	function display_present_members_on_date(){
		$date['date'] = $this->input->post('date');
		$date['day'] = $this->input->post('day');
		$this->load->view('reports/display_present_members_on_date',$date);
	}

	function display_employee_on_annual_leave(){
		$info['info'] = $this->input->post('info');
		$info['title'] = "The list of employees on annual leave ";
		$this->load->view('reports/employees_on_annual_leave',$info);
	}

	function expected_annual_leave(){
		$info['info'] = $this->input->post('info');
		$info['title'] = "The list of employees on expected to be on annual leave next 7 days from today ";
		$this->load->view('reports/expected_employees_to_be_annual_leave',$info);
	}

	function displaying_from_annual_leave(){
		$info['info'] = $this->input->post('info');
		$info['title'] = "The list of employees Coming from annual leave  in next 7 days from today ";
		$this->load->view('reports/coming_from_annual_leave',$info);
	}

	function display_employees_on_emergency_leave(){
		$info['info'] = $this->input->post('info');
		$info['title'] = "The list of employees on emergency leave";
		$this->load->view('reports/employee_on_emergency_leave',$info);
	}
}
