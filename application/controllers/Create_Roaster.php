<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Create_Roaster extends CI_Controller{

function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			redirect('auth');
		}else{
			 $this->session->set_userdata('last_activity', time()); // update the last activity time
			 $this->load->model('Registration_Model','get_id');
			 $this->load->model('Create_Roaster_Model','create');
		}
	}

	public function index(){
		$module_name = "create_roster";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$returned_result['table'] = $this->roaster_table_data();
			$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('create_roaster',$returned_result);
			$this->load->view('footer');
		}
	}


	public function department_Members_AutoSuggestion(){

		$data = $this->input->get('query');
		$dept_id = $this->session->userdata('department_id');
		$this->load->model('Create_Roaster_Model','get'); 
	 	$names = $this->get->get_Auto_Suggestion_Employee($data,$dept_id);

	 	$data = array();
	 	foreach($names as $name){
	 		$data[]= $name->names;
	 	}
	 	echo json_encode($data); 
	}

	public function create_Roaster_Function(){
		
		$names = $this->input->post('names');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$reason = $this->input->post('reason');
		$comments = $this->input->post('comments');
		$days_left = 28;
		$message = "";
		
		//here we get employee id from table employee
        $returned_id = $this->get_id->is_FullName_Found($names); //also check if the name exists in the same dept
        if($returned_id != "none"){ 
        	$employee_id = element('employee_id',$returned_id);
        	if($this->create->is_employee_roaster_exists($employee_id,date('Y'))){

        		$data = array(
		        	'employee_id' => $employee_id,
		        	'start_date' => $startDate,
		        	'end_date' => $endDate,
		        	'reason' => $reason,
		        	'comments' => $comments,
		        	'days_left' => $days_left
		        );

        		if($this->create->create_Roaster($data)){
        			$message = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Congratulation!!..<b>'.$names.'</b> Annual roster created successful. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        			
		        }else{
		        	$message = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!.. We have a database problem, please contact our awesome administrator for more information<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		        }

	        	}else{
	        		$message = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i><b>'.$names.'</b> already exists in our current Annual roster <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	        	}
        	
		        }else{
		        	$message = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Sorry <b>'.$names.'</b> do not belong into this department, select from autosuggestion or contact our awesome administrator for more information. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		        }

		        $this->session->set_flashdata('message',$message);
	}

	public function roaster_table_data(){
		//here we will pass the current year
		$current_year = date('Y');
		$returned_result = $this->create->get_roaster_data($current_year);
		
		return $returned_result->result();
	}

	function department_roaster_report(){
		$year = $this->input->post('year_selected');
		$data['year'] = $year;
		$returned_data = $this->create->get_roaster_data($year);

		if($returned_data->num_rows() > 0){
			$data['data'] = $returned_data;
			$this->load->view('hd/annual_roster_summary',$data);
		}else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Sorry!! a Annual Leave Roster for the selected year do not exists <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>";
		}
	}

	public function roster_update(){
		//it would been wise to use leave id of a certain year
		$info = array();
		$employee_id = $this->input->post("ids");
		$current_year = date('Y');
		$data = $this->create->get_employee_details($employee_id,$current_year); //im considering creating new method 
		$name = $this->create->get_name($employee_id);
		if($data && $name){

			$info['employee_roaster_details'] = array(
				'id' => $data->leave_id,
				'names' => $name->names,
				'start_date' => $data->start_date,
				'end_date' => $data->end_date,
				'reason' => $data->reason,
				'comments' => $data->comments
			);
		}else{
			// echo "sorry we encountered database error contact our awesome administrator";
		}
		$this->load->view('hd/update_roaster',$info);
	}

	public function delete_roaster_data(){
		 $employee_id = $this->input->post('employee_id');
		 $current_year = date('Y');
		 $names = $this->input->post('names');

		 $result = $this->create->delete_roaster_data($employee_id, $current_year);

		 if($result){ 
		 	$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> <b>'.$names.'</b>  deleted successful from our current annual leave roster. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		 	redirect('create_roaster');
		 }else{
		 	$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry!!  failed to delete employee from our current roaster. There is database problem please contact our awesome administrator.  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		 	redirect('create_roaster');
		 }

	}

	public function update_roaster_data(){
		$current_year = date('Y');
		$names = $this->input->post('names');
		$leave_id = $this->input->post('leave_id');
		$start_date = $this->input->post('startDate');
		$end_date = $this->input->post('endDate');
		$reason = $this->input->post('reason');
		$comments = $this->input->post('comments');

		$data = array(
			'start_date' => $start_date,
			'end_date' => $end_date,
			'reason' => $reason,
			'comments' => $comments 
		);
		$result = $this->create->update_roaster_data($leave_id,$current_year,$data);

		if($result){
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Employee updated successful in our current roster. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		 	redirect('create_roaster');
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry!!  failed to update employee in our current Annual Leave Roster. There is database problem please contact our awesome administrator.  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		 	redirect('create_roaster');
		}

	}

	public function upload_excel_file(){

		$config = array(
                'allowed_types' => 'pdf|docx|xlsx|zip',
                'upload_path' => './assets/uploads',
                'overwrite' => TRUE,
                'remove_spaces' => TRUE,
            );

		$this->load->library('upload', $config);
        $this->upload->initialize($config);

	    if($this->upload->do_upload("file")){
	    	$file_data = $this->upload->data();
	    	$data = array(
	    		'tittle' => $file_data['file_name'],
	    		'department_id' => $this->session->userdata('department_id'),
	    		'employee_id' => $this->session->userdata('employee_id'),
	    		'date' => date('Y-m-d')
	    	);

	    	if($this->create->upload_file($data)){
	    	  echo "ok";
	    	}else{
	    		echo "database_error";
	    	}
	    }else{
	    	echo "failed"; 
	    }
	}
	
}


?>