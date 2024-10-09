<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Hr_Wategemezi_Review extends CI_Controller{

		function __construct(){
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); //update time activity session 
				 $this->load->model("Wategemezi_Model","wategemezi");
				 // $this->load->helper('wategemezi_option_helper');
			}
		}


		function index(){
			$module_name = "wategemezi_hr";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$info['data'] = $this->unapproved_wategemezi();
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('wategemezi/hr_wategemezi_review',$info);
				$this->load->view('footer');
			}
		}

		function unapproved_wategemezi(){
			$result = array();
			$employee_info = $this->wategemezi->get_employee_wategemezi_info();
			foreach($employee_info as $employee_info){
				$count = 0;
				for($i=1; $i<=6; $i++){
					$var = "dept".$i;
					if($employee_info->$var != "" && $employee_info->$var != Null){
						$count++;
					}
				}
				$result[] = array('employee_id' => $employee_info->employee_id,
							 'names' => $employee_info->names,
							 'dept_name' => $employee_info->department_name,
							 'wategemezi' => $count
					);
			}
			return $result;	
		}

		function view_more_page(){
			$employee_id = $this->uri->segment(4);
			$wategemezi_details['wategemezi'] = $this->wategemezi->get_employee_wategemezi($employee_id);
			$module_name = "wategemezi_hr";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$info['data'] = $this->unapproved_wategemezi();
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);

				$this->load->view('head');
				$this->load->view('wategemezi/wategemezi_edit_form',$wategemezi_details);
				$this->load->view('footer');
			}
		}

		function delete_mtegemezi(){
			$employee_id = $this->uri->segment(4);
			$dept_no = $this->uri->segment(5);
			$response = "";

			$deptName = 'dept' . $dept_no;
            $deptRel = 'dept' . $dept_no .'_relation';
            $deptDob = 'dept' . $dept_no .'_dob';
            $data = array($deptName => '',
            			$deptRel => '',
            			$deptDob => ''
        		);
            if($this->wategemezi->delete_mtegemezi($employee_id,$data)){
            	$response = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Mtegemezi ametolewa kwenye list ya wategemezi wa mtumishi.</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }else{
            	$response = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Mfumo umeshindwa kumuondoa mtegemezi wa mtumishi. Tafadhari wasiliana na admin kwa maelezo zaidi.</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }

            $this->session->set_flashdata('mtegemezi_message',$response);

            redirect('wategemezi/hr_wategemezi_review/view_more_page/' . $employee_id);
		}

		function save_wategemezi(){
			$employee_id = $this->uri->segment(4);
			$data = array('hr_dept_update' => date('Y-m-d') 
					);
			$save_sms = "";


			if($this->wategemezi->save_wategemezi($employee_id,$data)){
				$save_sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Taarifa za wategemezi wa mtumishi zimesaviwa. </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$save_sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Kuna tatizo katika mfumo la kusave taarifa za mtumishi!!. Tafadhani wasiliana na admin wetu kwa maelezo zaidi.</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			$this->session->set_flashdata('wategemezi_save_sms',$save_sms);
			redirect('wategemezi/hr_wategemezi_review');
		}
	}


?>