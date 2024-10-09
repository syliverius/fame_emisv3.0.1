<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Wategemezi extends CI_Controller{
		function __construct(){
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); //update time activity session 
				 $this->load->model("Wategemezi_Model","wategemezi");
				 $this->load->helper('wategemezi_option_helper');
			}
		}

		function index(){
			$module_name = "wategemezi";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$result['wategemezi'] = $this->wategemezi->get_employee_wategemezi($this->session->userdata('employee_id'));
				$result['wategemezi_option'] = get_wategemezi_option();
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('wategemezi/wategemezi_form',$result);
				$this->load->view('footer');
			}
		}

		function update_wategemezi(){
			$data = array (
				'dept1' => $this->input->post('mtegemezi1'),
				'dept1_relation' => $this->input->post('mtegemezi1_uhusiano'),
				'dept1_dob' => $this->input->post('mtegemezi1_dob'),
				'dept2' => $this->input->post('mtegemezi2'),
				'dept2_relation' => $this->input->post('mtegemezi2_uhusiano'),
				'dept2_dob' => $this->input->post('mtegemezi2_dob'),
				'dept3' => $this->input->post('mtegemezi3'),
				'dept3_relation' => $this->input->post('mtegemezi3_uhusiano'),
				'dept3_dob' => $this->input->post('mtegemezi3_dob'),
				'dept4' => $this->input->post('mtegemezi4'),
				'dept4_relation' => $this->input->post('mtegemezi4_uhusiano'),
				'dept4_dob' => $this->input->post('mtegemezi4_dob'),
				'dept5' => $this->input->post('mtegemezi5'),
				'dept5_relation' => $this->input->post('mtegemezi5_uhusiano'),
				'dept5_dob' => $this->input->post('mtegemezi5_dob'),
				'dept6' => $this->input->post('mtegemezi6'),
				'dept6_relation' => $this->input->post('mtegemezi6_uhusiano'),
				'dept6_dob' => $this->input->post('mtegemezi6_dob'),
				'employee_dept_update' => date('Y-m-d'),
				'hr_dept_update' => '0000-00-00'
			);
			if($this->wategemezi->update_wategemezi($this->session->userdata('employee_id'),$data)){
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Employee Wategemezi successful changed  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Employee Wategemezi failed to be changed, please contact our awesome Administrator form more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}

	}

?>