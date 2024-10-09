<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class Employee_performance_form extends CI_Controller{

 	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			redirect('auth');
		}else{
			 $this->session->set_userdata('last_activity', time()); // update the last activity time

			//put the modal here
			 $this->load->model("hr_dashboard_model","hr");
			 $this->load->model("employee_performance/Employee_performance_Model","performance");
		}
	}

	public function index(){
		$module_name = "performance_form";
		if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$module['module_name'] = $module_name;
			$data['info'] = $this->unApprovedList();
			$this->load->view('head',$module);
			$this->load->view('employee_performance/employee_performance_hd_form',$data);
			$this->load->view('footer');
		}

	}

	function unApprovedList(){
		$data = array();
			$result = $this->performance->get_hd_UncheckedList(date('Y'),$this->session->userdata('department_id'));
			if($result){
				$data = $result;
			}else{
				//empty 
			}
			return $data;
	}

	function user_performance(){
		$module_name = "employee_performance_user";
		if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('employee_performance/user_1st_form');
			$this->load->view('footer');
		}
	}

	function getDeptHead(){
		return $this->hr->get_dept_head_name($this->session->userdata("department_id"));
	}

	function get_employee_info(){
		$age ="";
		$count = 0;
		$names = $this->input->post("names");
		$result = $this->performance->get_employee_details($names,$this->session->userdata("department_id"));
		if($result->dob !== NULL && $result->dob !== "0000-00-00"){
			$birthDate = new DateTime($result->dob);
			$currentDate = new DateTime();
			$age = $currentDate->diff($birthDate)->y;
		}
		for($i=1; $i<=6; $i++){
			$var = "dept".$i;
			if($result->$var != ""){
				$count++;
			}
		}
		$data = array(
			"employee_id" => $result->employee_id,
			"gender" => $result->gender,
			"cheo" => $result->professional_name,
			"age" => $age,
			"wategemezi" => $count
		);

		echo json_encode($data);
	}

	function process_1st_form(){
		$employee_id = $this->input->post("employee_id");
		$data = array(
			"employee_id" => $employee_id,
			"age" => $this->input->post("age"),
			"nationality" => $this->input->post("nationality"),
			"marital_status" => $this->input->post("marital_status"),
			"wategemezi" => $this->input->post("wategemezi"),
			"elimu" => $this->input->post("elimu"),
			"masharti_ya_kazi" => $this->input->post("masharti_ya_kazi")
		);

		$employee_info['from_form_1'] = array('employee_id' => $employee_id);

		if($this->performance->employee_exist_null_date($employee_id)){
			if($this->performance->update_form($employee_id,$data)){
				$this->load->view("employee_performance/user_second_form",$employee_info);
			}else{
				$this->session->set_flashdata('sms','<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kurekebisha taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				echo "fail";
			}
		}else{
			if($this->performance->employee_exist_this_year($employee_id,date('Y'))){
			$this->session->set_flashdata('sms','<div class="alert alert-warning alert-dismissible fade show" role="alert">Taarifa zako za Evaluation zimesha wasilishwa kwa mkuu wako wa idara <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			echo "fail";
			}else{
				if($this->performance->insert($data)){
					$this->load->view("employee_performance/user_second_form",$employee_info);
				}else{
					$this->session->set_flashdata('sms','<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kusave taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					echo "fail";
				}
			}
		}
	}

	function hd_process_1st_form(){
		$employee_id = $this->input->post("employee_id");
		$data = array(
			"employee_id" => $employee_id,
			"age" => $this->input->post("age"),
			"nationality" => $this->input->post("nationality"),
			"marital_status" => $this->input->post("marital_status"),
			"wategemezi" => $this->input->post("wategemezi"),
			"elimu" => $this->input->post("elimu"),
			"masharti_ya_kazi" => $this->input->post("masharti_ya_kazi")
		);

		$employee_info['from_form_1'] = array('employee_id' => $employee_id);

		if($this->performance->employee_exist_null_date($employee_id)){
			if($this->performance->update_form($employee_id,$data)){
				$this->load->view("employee_performance/hd_2nd_form",$employee_info);
			}else{
				$this->session->set_flashdata('sms','<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kurekebisha taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				echo "fail";
			}
		}else{
			if($this->performance->employee_exist_this_year($employee_id,date('Y'))){
			$this->session->set_flashdata('sms','<div class="alert alert-warning alert-dismissible fade show" role="alert">Taarifa zako za Evaluation zimesha wasilishwa kwa mkuu wako wa idara <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			echo "fail";
			}else{
				if($this->performance->insert($data)){
					$this->load->view("employee_performance/hd_2nd_form",$employee_info);
				}else{
					$this->session->set_flashdata('sms','<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kusave taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					echo "fail";
				}
			}
		}
	}

	function process_2nd_user_form(){
		$employee_info['dept'] = $this->getDeptHead();
		$data = array(
			"uajibikaji_utoaji_maamuzi_1_mtumishi" => $this->input->post("uajibikaji_utoaji_maamuzi_1_mtumishi"),
			"mahusiano_kazini_1_mtumishi" => $this->input->post("mahusiano_kazini_1_mtumishi"),
			"mahusiano_kazini_2_mtumishi" => $this->input->post("mahusiano_kazini_2_mtumishi"),
			"mahusiano_kazini_3_mtumishi" => $this->input->post("mahusiano_kazini_3_mtumishi"),
			"mawasiliano_na_usikivu_1_mtumishi" => $this->input->post("mawasiliano_na_usikivu_1_mtumishi"),
			"mawasiliano_na_usikivu_2_mtumishi" => $this->input->post("mawasiliano_na_usikivu_2_mtumishi"),
			"mawasiliano_na_usikivu_3_mtumishi" => $this->input->post("mahusiano_kazini_1_msimamizi"),
			"mawasiliano_na_usikivu_4_mtumishi" => $this->input->post("mawasiliano_na_usikivu_4_mtumishi"),
			"uongozi_na_usimamizi_1_mtumishi" => $this->input->post("uongozi_na_usimamizi_1_mtumishi"),
			"uongozi_na_usimamizi_2_mtumishi" => $this->input->post("uongozi_na_usimamizi_2_mtumishi"),
			"uongozi_na_usimamizi_3_mtumishi" => $this->input->post("uongozi_na_usimamizi_3_mtumishi"),
			"ubora_na_utendaji_1_mtumishi" => $this->input->post("ubora_na_utendaji_1_mtumishi"),
			"ubora_na_utendaji_2_mtumishi" => $this->input->post("ubora_na_utendaji_2_mtumishi"),
			"utendaji_wa_wingi_wa_matokeo_1_mtumishi" => $this->input->post("utendaji_wa_wingi_wa_matokeo_1_mtumishi"),
			"utendaji_wa_wingi_wa_matokeo_2_mtumishi" => $this->input->post("utendaji_wa_wingi_wa_matokeo_2_mtumishi"),
			"uajibikaji_utoaji_maamuzi_2_mtumishi" => $this->input->post("uajibikaji_utoaji_maamuzi_2_mtumishi"),
			"kuthamini_wateja_1_mtumishi" => $this->input->post("kuthamini_wateja_1_mtumishi"),
			"uaminifu_1_mtumishi" => $this->input->post("uaminifu_1_mtumishi"),
			"uaminifu_2_mtumishi" => $this->input->post("uaminifu_2_mtumishi"),
			"uaminifu_3_mtumishi" => $this->input->post("uaminifu_3_mtumishi"),
			"uadilifu_1_mtumishi" => $this->input->post("uadilifu_1_mtumishi"),
			"uadilifu_2_mtumishi" => $this->input->post("uadilifu_2_mtumishi"),
			"uadilifu_3_mtumishi" => $this->input->post("uadilifu_3_mtumishi")
		);
		$employee_info['from_form_2'] = array('employee_id' => $this->input->post("employee_id"));
		//update the table where date is null 
		if($this->performance->update_form($this->input->post("employee_id"),$data)){
			$this->load->view("employee_performance/user_third_form",$employee_info);
		}else{
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kusave taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
	}


	function hd_process_2nd_form(){
		$employee_info['dept'] = $this->getDeptHead();
		$data = array(
			"mahusiano_kazini_1_msimamizi" => $this->input->post("mahusiano_kazini_1_msimamizi"),
			"mahusiano_kazini_1_maafikiano" => $this->input->post("mahusiano_kazini_1_maafikiano"),
			"mahusiano_kazini_2_msimamizi" => $this->input->post("mahusiano_kazini_2_msimamizi"),
			"mahusiano_kazini_2_maafikiano" => $this->input->post("mahusiano_kazini_2_maafikiano"),
			"mahusiano_kazini_3_msimamizi" => $this->input->post("mahusiano_kazini_3_msimamizi"),
			"mahusiano_kazini_3_maafikiano" => $this->input->post("mahusiano_kazini_3_maafikiano"),
			"mawasiliano_na_usikivu_1_msimamizi" => $this->input->post("mawasiliano_na_usikivu_1_msimamizi"),
			"mawasiliano_na_usikivu_1_maafikiano" => $this->input->post("mawasiliano_na_usikivu_1_maafikiano"),
			"mawasiliano_na_usikivu_2_msimamizi" => $this->input->post("mawasiliano_na_usikivu_2_msimamizi"),
			"mawasiliano_na_usikivu_2_maafikiano" => $this->input->post("mawasiliano_na_usikivu_2_maafikiano"),
			"mawasiliano_na_usikivu_3_msimamizi" => $this->input->post("mawasiliano_na_usikivu_3_msimamizi"),
			"mawasiliano_na_usikivu_3_maafikiano" => $this->input->post("mawasiliano_na_usikivu_3_maafikiano"),
			"mawasiliano_na_usikivu_4_msimaizi" => $this->input->post("mawasiliano_na_usikivu_4_msimaizi"),
			"mawasiliano_na_usikivu_4_maafikiano" => $this->input->post("mawasiliano_na_usikivu_4_maafikiano"),
			"uongozi_na_usimamizi_1_msimamizi" => $this->input->post("uongozi_na_usimamizi_1_msimamizi"),
			"uongozi_na_usimamizi_1_maafikiano" => $this->input->post("uongozi_na_usimamizi_1_maafikiano"),
			"uongozi_na_usimamizi__2_msimamizi" => $this->input->post("uongozi_na_usimamizi__2_msimamizi"),
			"uongozi_na_usimamizi__2_maafikiano" => $this->input->post("uongozi_na_usimamizi__2_maafikiano"),
			"uongozi_na_usimamizi_3_msimamizi" => $this->input->post("uongozi_na_usimamizi_3_msimamizi"),
			"uongozi_na_usimamizi_3_maafikiano" => $this->input->post("uongozi_na_usimamizi_3_maafikiano"),
			"ubora_na_utendaji_1_msimamizi" => $this->input->post("ubora_na_utendaji_1_msimamizi"),
			"ubora_na_utendaji_1_maafikiano" => $this->input->post("ubora_na_utendaji_1_maafikiano"),
			"ubora_na_utendaji_2_msimamizi" => $this->input->post("ubora_na_utendaji_2_msimamizi"),
			"ubora_na_utendaji_2_maafikiano" => $this->input->post("ubora_na_utendaji_2_maafikiano"),
			"utendaji_wa_wingi_wa_matokeo_1_msimamizi" => $this->input->post("utendaji_wa_wingi_wa_matokeo_1_msimamizi"),
			"utendaji_wa_wingi_wa_matokeo_1_maafikiano" => $this->input->post("utendaji_wa_wingi_wa_matokeo_1_maafikiano"),
			"utendaji_wa_wingi_wa_matokeo_2_msimamizi" => $this->input->post("utendaji_wa_wingi_wa_matokeo_2_msimamizi"),
			"utendaji_wa_wingi_wa_matokeo_2_maafikiano" => $this->input->post("utendaji_wa_wingi_wa_matokeo_2_maafikiano"),
			"uajibikaji_utoaji_maamuzi_1_mtumishi" => $this->input->post("uajibikaji_utoaji_maamuzi_1_mtumishi"),
			"uajibikaji_utoaji_maamuzi_1_maafikiano" => $this->input->post("uajibikaji_utoaji_maamuzi_1_maafikiano"),
			"uajibikaji_utoaji_maamuzi_2_msimamizi" => $this->input->post("uajibikaji_utoaji_maamuzi_2_msimamizi"),
			"uajibikaji_utoaji_maamuzi_2_maafikiano" => $this->input->post("uajibikaji_utoaji_maamuzi_2_maafikiano"),
			"kuthamini_wateja_1_msimamizi" => $this->input->post("kuthamini_wateja_1_msimamizi"),
			"kuthamini_wateja_1_maafikiano" => $this->input->post("kuthamini_wateja_1_maafikiano"),
			"uaminifu_1_msimamizi" => $this->input->post("uaminifu_1_msimamizi"),
			"uaminifu_1_maafikiano" => $this->input->post("uaminifu_1_maafikiano"),
			"uaminifu_2_msimamizi" => $this->input->post("uaminifu_2_msimamizi"),
			"uaminifu_2_maafikiano" => $this->input->post("uaminifu_2_maafikiano"),
			"uaminifu_3_msimamizi" => $this->input->post("uaminifu_3_msimamizi"),
			"uaminifu_3_maafikiano" => $this->input->post("uaminifu_3_maafikiano"),
			"uadilifu_1_msimamizi" => $this->input->post("uadilifu_1_msimamizi"),
			"uadilifu_1_maafikiano" => $this->input->post("uadilifu_1_maafikiano"),
			"uadilifu_2_msimamizi" => $this->input->post("uadilifu_2_msimamizi"),
			"uadilifu_2_maafikiano" => $this->input->post("uadilifu_2_maafikiano"),
			"uadilifu_3_msimamizi" => $this->input->post("uadilifu_3_msimamizi"),
			"uadilifu_3_maafikiano" => $this->input->post("uadilifu_3_maafikiano"),
			"mahusiano_kazini_1_mtumishi" => $this->input->post("mahusiano_kazini_1_mtumishi"),
			"mahusiano_kazini_2_mtumishi" => $this->input->post("mahusiano_kazini_2_mtumishi"),
			"mahusiano_kazini_3_mtumishi" => $this->input->post("mahusiano_kazini_3_mtumishi"),
			"mawasiliano_na_usikivu_1_mtumishi" => $this->input->post("mawasiliano_na_usikivu_1_mtumishi"),
			"mawasiliano_na_usikivu_2_mtumishi" => $this->input->post("mawasiliano_na_usikivu_2_mtumishi"),
			"mawasiliano_na_usikivu_3_mtumishi" => $this->input->post("mahusiano_kazini_1_msimamizi"),
			"mawasiliano_na_usikivu_4_mtumishi" => $this->input->post("mawasiliano_na_usikivu_4_mtumishi"),
			"uongozi_na_usimamizi_1_mtumishi" => $this->input->post("uongozi_na_usimamizi_1_mtumishi"),
			"uongozi_na_usimamizi_2_mtumishi" => $this->input->post("uongozi_na_usimamizi_2_mtumishi"),
			"uongozi_na_usimamizi_3_mtumishi" => $this->input->post("uongozi_na_usimamizi_3_mtumishi"),
			"ubora_na_utendaji_1_mtumishi" => $this->input->post("ubora_na_utendaji_1_mtumishi"),
			"ubora_na_utendaji_2_mtumishi" => $this->input->post("ubora_na_utendaji_2_mtumishi"),
			"utendaji_wa_wingi_wa_matokeo_1_mtumishi" => $this->input->post("utendaji_wa_wingi_wa_matokeo_1_mtumishi"),
			"utendaji_wa_wingi_wa_matokeo_2_mtumishi" => $this->input->post("utendaji_wa_wingi_wa_matokeo_2_mtumishi"),
			"uajibikaji_utoaji_maamuzi_1_msimamizi" => $this->input->post("uajibikaji_utoaji_maamuzi_1_msimamizi"),
			"uajibikaji_utoaji_maamuzi_2_mtumishi" => $this->input->post("uajibikaji_utoaji_maamuzi_2_mtumishi"),
			"kuthamini_wateja_1_mtumishi" => $this->input->post("kuthamini_wateja_1_mtumishi"),
			"uaminifu_1_mtumishi" => $this->input->post("uaminifu_1_mtumishi"),
			"uaminifu_2_mtumishi" => $this->input->post("uaminifu_2_mtumishi"),
			"uaminifu_3_mtumishi" => $this->input->post("uaminifu_3_mtumishi"),
			"uadilifu_1_mtumishi" => $this->input->post("uadilifu_1_mtumishi"),
			"uadilifu_2_mtumishi" => $this->input->post("uadilifu_2_mtumishi"),
			"uadilifu_3_mtumishi" => $this->input->post("uadilifu_3_mtumishi")
		);
		$employee_info['from_form_2'] = array('employee_id' => $this->input->post("employee_id"));
		//update the table where date is null 
		if($this->performance->update_form($this->input->post("employee_id"),$data)){
			$total_performance = $this->hd_get_total_performance($this->input->post("employee_id"));
			$employee_info['from_form_2_performance'] = array('total_performance' => ($total_performance[0]->performance_total)/69);
			$this->load->view("employee_performance/hd_3rd_form",$employee_info);

		}else{
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kusave taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
	}

	function hd_process_3rd_form(){
		$data = array(
			'maoni_ya_mtumishi' => $this->input->post('mtumishi_maoni'),
			'jina_la_msimamizi' => $this->input->post('hd_names'),
			'tuzo_au_hatua' => $this->input->post('tuzo'),
			'maoni_ya_msimamizi' => $this->input->post('hd_maoni'),
			'employee_id'  => $this->input->post('employee_id'),
			'wastani_utendaji_wa_jumla'  => $this->input->post('wastani'),
			'date' => date('Y-m-d')
		);

		if($this->performance->update_form($this->input->post("employee_id"),$data)){
			
			$this->session->set_flashdata('sms','<div class="alert alert-success alert-dismissible fade show" role="alert"> Hongera sana taarifa za mtumishi zimesaviwa tayali kwa mwaka huu <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		}else{
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kusave taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}

		// $this->load->view("employee_performance/hd_1st_form");
	}


	function get_total_performance($employee_id){ 
		$result = $this->performance->get_employee_total_performance($employee_id);
		if($result){
			return $result;
		}else{
			return false;
		}
	}

	function hd_get_total_performance($employee_id){ 
		$result = $this->performance->hd_get_employee_total_performance($employee_id);
		if($result){
			return $result;
		}else{
			return false;
		}
	}


	function process_3rd_user_form(){
		$data = array(
			'maoni_ya_mtumishi' => $this->input->post('mtumishi_maoni'),
			'employee_id'  => $this->input->post('employee_id'),
			'date' => date('Y-m-d')
		);

		if($this->performance->update_form($this->input->post("employee_id"),$data)){
			
			$this->session->set_flashdata('sms','<div class="alert alert-success alert-dismissible fade show" role="alert"> Hongera sana taarifa zako zimewasilishwa kwa Mkuu wa department kwa mapitio zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		}else{

			$this->session->set_flashdata('sms','<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kusave taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		}

	}

	function hd_view_more_edit(){
			$data = array();
			$employee_id = $this->input->post('employee_id');
			$selected_year = date('Y');

			$result1 = $this->performance->view_more($employee_id,$selected_year);
			$result2 = $this->performance->get_employee_particular($employee_id);
			//$result3 = $this->hr->get_dept_head_name($result2->department_id);
			$data['info'] = array(
							'performance_info' => $result1,
							'employee_info' => $result2
						);

			if($result1 && $result2){
				$this->load->view('employee_performance/employee_performance_review/view_more_hd',$data);
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry!!!, We have some technical problem please contact our awesome administrator for more information. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}

		function hd_evaluation_update(){
			$total_performance = 0;
			$employee_names = $this->input->post("employee_name");
			$employee_id = $this->input->post("employee_id");
			$data = array(
				"mahusiano_kazini_1_msimamizi" => $this->input->post("mahusiano_kazini_1_msimamizi"),
				"mahusiano_kazini_1_maafikiano" => $this->input->post("mahusiano_kazini_1_maafikiano"),
				"mahusiano_kazini_2_msimamizi" => $this->input->post("mahusiano_kazini_2_msimamizi"),
				"mahusiano_kazini_2_maafikiano" => $this->input->post("mahusiano_kazini_2_maafikiano"),
				"mahusiano_kazini_3_msimamizi" => $this->input->post("mahusiano_kazini_3_msimamizi"),
				"mahusiano_kazini_3_maafikiano" => $this->input->post("mahusiano_kazini_3_maafikiano"),
				"mawasiliano_na_usikivu_1_msimamizi" => $this->input->post("mawasiliano_na_usikivu_1_msimamizi"),
				"mawasiliano_na_usikivu_1_maafikiano" => $this->input->post("mawasiliano_na_usikivu_1_maafikiano"),
				"mawasiliano_na_usikivu_2_msimamizi" => $this->input->post("mawasiliano_na_usikivu_2_msimamizi"),
				"mawasiliano_na_usikivu_2_maafikiano" => $this->input->post("mawasiliano_na_usikivu_2_maafikiano"),
				"mawasiliano_na_usikivu_3_msimamizi" => $this->input->post("mawasiliano_na_usikivu_3_msimamizi"),
				"mawasiliano_na_usikivu_3_maafikiano" => $this->input->post("mawasiliano_na_usikivu_3_maafikiano"),
				"mawasiliano_na_usikivu_4_msimaizi" => $this->input->post("mawasiliano_na_usikivu_4_msimaizi"),
				"mawasiliano_na_usikivu_4_maafikiano" => $this->input->post("mawasiliano_na_usikivu_4_maafikiano"),
				"uongozi_na_usimamizi_1_msimamizi" => $this->input->post("uongozi_na_usimamizi_1_msimamizi"),
				"uongozi_na_usimamizi_1_maafikiano" => $this->input->post("uongozi_na_usimamizi_1_maafikiano"),
				"uongozi_na_usimamizi__2_msimamizi" => $this->input->post("uongozi_na_usimamizi__2_msimamizi"),
				"uongozi_na_usimamizi__2_maafikiano" => $this->input->post("uongozi_na_usimamizi__2_maafikiano"),
				"uongozi_na_usimamizi_3_msimamizi" => $this->input->post("uongozi_na_usimamizi_3_msimamizi"),
				"uongozi_na_usimamizi_3_maafikiano" => $this->input->post("uongozi_na_usimamizi_3_maafikiano"),
				"ubora_na_utendaji_1_msimamizi" => $this->input->post("ubora_na_utendaji_1_msimamizi"),
				"ubora_na_utendaji_1_maafikiano" => $this->input->post("ubora_na_utendaji_1_maafikiano"),
				"ubora_na_utendaji_2_msimamizi" => $this->input->post("ubora_na_utendaji_2_msimamizi"),
				"ubora_na_utendaji_2_maafikiano" => $this->input->post("ubora_na_utendaji_2_maafikiano"),
				"utendaji_wa_wingi_wa_matokeo_1_msimamizi" => $this->input->post("utendaji_wa_wingi_wa_matokeo_1_msimamizi"),
				"utendaji_wa_wingi_wa_matokeo_1_maafikiano" => $this->input->post("utendaji_wa_wingi_wa_matokeo_1_maafikiano"),
				"utendaji_wa_wingi_wa_matokeo_2_msimamizi" => $this->input->post("utendaji_wa_wingi_wa_matokeo_2_msimamizi"),
				"utendaji_wa_wingi_wa_matokeo_2_maafikiano" => $this->input->post("utendaji_wa_wingi_wa_matokeo_2_maafikiano"),
				"uajibikaji_utoaji_maamuzi_1_maafikiano" => $this->input->post("uajibikaji_utoaji_maamuzi_1_maafikiano"),
				"uajibikaji_utoaji_maamuzi_2_msimamizi" => $this->input->post("uajibikaji_utoaji_maamuzi_2_msimamizi"),
				"uajibikaji_utoaji_maamuzi_2_maafikiano" => $this->input->post("uajibikaji_utoaji_maamuzi_2_maafikiano"),
				"kuthamini_wateja_1_msimamizi" => $this->input->post("kuthamini_wateja_1_msimamizi"),
				"kuthamini_wateja_1_maafikiano" => $this->input->post("kuthamini_wateja_1_maafikiano"),
				"uaminifu_1_msimamizi" => $this->input->post("uaminifu_1_msimamizi"),
				"uaminifu_1_maafikiano" => $this->input->post("uaminifu_1_maafikiano"),
				"uaminifu_2_msimamizi" => $this->input->post("uaminifu_2_msimamizi"),
				"uaminifu_2_maafikiano" => $this->input->post("uaminifu_2_maafikiano"),
				"uaminifu_3_msimamizi" => $this->input->post("uaminifu_3_msimamizi"),
				"uaminifu_3_maafikiano" => $this->input->post("uaminifu_3_maafikiano"),
				"uadilifu_1_msimamizi" => $this->input->post("uadilifu_1_msimamizi"),
				"uadilifu_1_maafikiano" => $this->input->post("uadilifu_1_maafikiano"),
				"uadilifu_2_msimamizi" => $this->input->post("uadilifu_2_msimamizi"),
				"uadilifu_2_maafikiano" => $this->input->post("uadilifu_2_maafikiano"),
				"uadilifu_3_msimamizi" => $this->input->post("uadilifu_3_msimamizi"),
				"uadilifu_3_maafikiano" => $this->input->post("uadilifu_3_maafikiano"),
				"uajibikaji_utoaji_maamuzi_1_msimamizi" => $this->input->post("uajibikaji_utoaji_maamuzi_1_msimamizi"),
				"jina_la_msimamizi" => $this->input->post("jina_la_msimamizi"),
				"tuzo_au_hatua" => $this->input->post("tuzo"),
				"maoni_ya_msimamizi" => $this->input->post("hd_maoni")
		);
		if($this->performance->hd_update_evaluation_form($employee_id,$data)){

			$employee_performance = $this->get_total_performance($employee_id);
			if($employee_performance !== false && is_object($employee_performance)){
				if(property_exists($employee_performance,'performance_total')){
					$total_performance = round($employee_performance->performance_total/69,1);
				}
			}
			$data = array('wastani_utendaji_wa_jumla' => ($total_performance));

			$this->performance->update_average_performance($employee_id,$data);
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert"> Congratulation!, Employee performance evaluation for <b>'.$employee_names.' </b> Completed and submitted to HR office for more review. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		}else{
			$this->session->set_flashdata('message' ,'<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry!! system yetu imeshindwa kusave taarifa za mtumishi, wasiliana na admin wetu kwa maelezo zaidi <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		}

		$this->index();
	}

}

?>