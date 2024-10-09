<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.9
 * @since       2023-02-18
 * @description This controller deals with all hospital menus books
 * @license     fameafrica.org

-->

 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Menu extends CI_Controller{
		function __construct(){
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			  redirect('auth');
			}else{
				$this->session->set_userdata('last_activity', time()); // update the last activity time

				//Collection of useful modal 
				$this->load->model('Menu_Model','menu');
			}
		}


		function menu_book(){
			$module_name = "menu_book";
	        	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
		          $module['module_name'] = $module_name;
		          $this->load->view('head',$module);
		    		$this->load->view('menu/menu_book_home');
		    		$this->load->view('footer');
		     }
		}

		function generate_book(){
			$location = $this->input->post('ward');
			$date = $this->input->post('date');
			$ward = $location;
			if($location == "Ward One" || $location == "Surgical Ward"){
				$location = 1;
			}else{
				$location = 2;
			}
			$data['attributes'] = array('location' => $location, 'date' => $date, 'ward' => $ward);

			$editable_date = date_create(date('Y-m-d'));
			date_sub($editable_date,date_interval_create_from_date_string('3 days'));
			$editable_date = date_format($editable_date,'Y-m-d');
			$info = $this->menu->check_menu_info($ward,$date);
			if($info && $editable_date < $info[0]->creation_date){ 
				$data['menus'] = $info;
				$this->load->view('menu/editable_menu_book',$data);
			}else{
				if($info){
					$data['menus'] = $this->menu->get_menu_summary($ward,$date);
					$this->load->view('menu/menu_day_report',$data);
				}else{
					$this->load->view('menu/new_menu_book',$data);
				}
			}
		}

		function submit_new_book(){
			 $location_id = $this->input->post('location_id');
			 $ward = $this->input->post('ward');
			 $date = $this->input->post('date');

			 $beds = $this->menu->getWardBeds($location_id);
			 foreach($beds as $bed){
			 	$data = array(
			 				"bed_id" => $bed->id,
			 				"patient_id" => $this->input->post($bed->name."_patient_id"),
			 				"names" => $this->input->post($bed->name."_patient_name"),
			 				"location_id" => $this->input->post("location_id"),
			 				"ward" => $ward,
			 				"date" => $date,
			 				"breakfast" => $this->input->post($bed->name."_breakfast"),
			 				"before_luch" => $this->input->post($bed->name."_before_lunch"),
			 				"lunch" => $this->input->post($bed->name."_lunch"),
			 				"before_dinner" => $this->input->post($bed->name."_before_dinner"),
			 				"dinner" => $this->input->post($bed->name."_dinner"),
			 				"after_dinner" => $this->input->post($bed->name."_after_dinner"),
			 				"signature" => $this->session->userdata("full_name"),
			 				"creation_date" => date('Y-m-d')
			 		);
			 	//Here we'll narrate all user activities in retrospect 
			 	$content = $bed->name." : Patient File => ".$this->input->post($bed->name."_patient_id").", Patient Names => ".$this->input->post($bed->name."_patient_name").", Breakfast => ".$this->menu->get_menu_name($this->input->post($bed->name."_breakfast")). ", Before Lunch => ".$this->menu->get_menu_name($this->input->post($bed->name."_before_lunch")). ", Lunch => ".$this->menu->get_menu_name($this->input->post($bed->name."_lunch")). ", Before Dinner => ".$this->menu->get_menu_name($this->input->post($bed->name."__before_dinner")). ", Dinner => ".$this->menu->get_menu_name($this->input->post($bed->name."_dinner")). ", After Dinner => ".$this->menu->get_menu_name($this->input->post($bed->name."_after_dinner"));
			 	$menu_audit_data = array(
			 				"date" => $date,
			 				"time_stamp" => date('Y-m-d H:i:s'),
			 				"user_name" => $this->session->userdata('full_name'),
			 				"ward" => $ward,
			 				"action" => "Create",
			 				"content" => $content
			 		);
					foreach ($data as $key => $value) {
						if ($value === '') {
							// Check if the column is an integer type and set the value to NULL
							if (in_array($key, ["breakfast", "before_luch", "lunch", "before_dinner", "dinner", "after_dinner"], true)) {
								$data[$key] = null;
							}
						}
					}
			 	if($this->menu->submit_new_book($data)){
			 		$this->menu->menu_audit_trial($menu_audit_data);
			 		$this->session->set_flashdata('new_book_response','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Congratulation information saved successfully <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			 	}else{
			 		$this->session->set_flashdata('new_book_response','<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!... Failed to store information. please contact our awesome administrator for more information  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			 	}
			 }
		}


		function generate_menu_info(){
			$menu_id = $this->input->post('menu_id');
			$bed_menu_info['info'] = $this->menu->get_bed_menu_info($menu_id);
			$this->load->view('menu/edit_menu_modal',$bed_menu_info);
		}


		function edit_menu_info(){
			$menu_id = $this->input->post('menu_id');
			$date = $this->input->post('date');
			$location = $this->input->post('location_id');
			$ward = $this->input->post('ward');

			$data = array(
				'patient_id' => $this->input->post('patient_id'),
				'names' => $this->input->post('names'),
				'breakfast' => $this->input->post('breakfast'),
				'before_luch' => $this->input->post('before_luch'),
				'lunch' => $this->input->post('lunch'),
				'before_dinner' => $this->input->post('before_dinner'),
				'dinner' => $this->input->post('dinner'),
				'after_dinner' => $this->input->post('after_dinner'),
				'signature' => $this->session->userdata('full_name'),
				'comments' => $this->input->post('comments')				
			);

			//here we create audit trial 

			$menu_data = $this->menu->get_bed_menu_info($menu_id);
			$content1 = "The data on bed ".$menu_data->name." was changed from : "."patient id => ".$menu_data->patient_id.", patient name => ".$menu_data->names.", Breakfast => ".$this->menu->get_menu_name($menu_data->Breakfast). ", Before Lunch => ".$this->menu->get_menu_name($menu_data->before_luch). ", Lunch => ".$this->menu->get_menu_name($menu_data->lunch). ", Before Dinner => ".$this->menu->get_menu_name($menu_data->before_dinner). ", Dinner => ".$this->menu->get_menu_name($menu_data->dinner). ", After Dinner => ".$this->menu->get_menu_name($menu_data->after_dinner);

			$content2 = " <br /> <center><b> TO </b></center>". "patient id => ".$this->input->post('patient_id').", patient name => ".$this->input->post('names').", Breakfast => ".$this->menu->get_menu_name($this->input->post('breakfast')). ", Before Lunch => ".$this->menu->get_menu_name($this->input->post('before_luch')). ", Lunch => ".$this->menu->get_menu_name($this->input->post('lunch')). ", Before Dinner => ".$this->menu->get_menu_name($this->input->post('before_dinner')). ", Dinner => ".$this->menu->get_menu_name($this->input->post('dinner')). ", After Dinner => ".$this->menu->get_menu_name($this->input->post('after_dinner'));
			$content = $content1.$content2;

			$audit_info = array('date' => $date,'user_name' => $this->session->userdata("full_name"),'time_stamp' =>	date("Y-m-d H:i:s"),'ward' => $ward, 'action' => "Update", 'content' => $content);

			//end of audit trial 


			$info['attributes'] = array('location' => $location, 'date' => $date, 'ward' => $ward);
			if($this->menu->update_menu_info($menu_id,$data)){
				$this->menu->menu_audit_trial($audit_info);
				$info['menus'] = $this->menu->check_menu_info($ward,$date); 
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Congratulation... bed menu info update successfully <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				$this->load->view('menu/editable_menu_book',$info);
			}else{
				$info['menus'] = $this->menu->check_menu_info($ward,$date); 
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!... Failed to update bed menu info. Please contact our awesome administrator for more information  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				$this->load->view('menu/editable_menu_book',$info);
			}
		}

		function discharge_patient_menu(){
			$menu_id = $this->input->post('menu_id');
			$date = $this->input->post('date');
			$location = $this->input->post('location_id');
			$patient_id = $this->input->post('patient_id');
			$patient_names = $this->input->post('names');
			$bed_name = $this->input->post('bed_name');
			$ward = $this->input->post('ward');
			$info['attributes'] = array('location' => $location, 'date' => $date, 'ward' => $ward);
			$content = "Patient ".$patient_names." with patient id ".$patient_id." was discharged from bed ".$bed_name;
			$audit_info = array('date' => $date,'user_name' => $this->session->userdata("full_name"),"time_stamp" => date('Y-m-d H:i:s'),
				'ward' => $ward, 'action' => "Discharge", 'content' => $content);
			if($this->menu->discharge($menu_id)){
				$this->menu->menu_audit_trial($audit_info);
				$info['menus'] = $this->menu->check_menu_info($ward,$date);
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Congratulation... Patient discharged successfully <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				$this->load->view('menu/editable_menu_book',$info);
			}else{
				$info['menus'] = $this->menu->check_menu_info($ward,$date); 
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!... Failed to discharge a patient. Please contact our awesome administrator for more information  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				$this->load->view('menu/editable_menu_book',$info);
			}
		}


		function summary(){
			$module_name = "menu_book_summary";
        	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
	          $module['module_name'] = $module_name;
	          $this->load->view('head',$module);
	    		$this->load->view('menu/menu_home_summary');
	    		$this->load->view('footer');
	     }
	}

	function generate_menu_book_summary(){
		$ward = $this->input->post('ward');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$data['attributes'] = array('ward' => $ward,'start_date' => $start_date,'end_date' => $end_date);

		if($ward == "All"){
			$info = $this->menu->getAllMenuSummary($start_date,$end_date);
			if($info->num_rows() > 0){
				$data['menus'] = $info->result();
				$this->load->view('menu/AllWardMenuBookSummary',$data);
			}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!... No report to show for the specified dates  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}else{
			$info = $this->menu->getWardMenuSummary($ward,$start_date,$end_date);
			if($info->num_rows() > 0){
				$data['menus'] = $info->result();
				$this->load->view('menu/wardMenuBookSummary',$data);
			}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!... No report to show for the specified dates  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}

	}


	function new_patient_menu_info(){
		$data = $this->input->post('data');
		$info['data'] = array(
			"bed_id" => $data['bed_id'],
			"location_id" => $data['location_id'],
			"ward" => $data['ward'],
			"bed_name" => $data['bed_name'],
			"date" => $data['date']
		);

		$this->load->view('menu/new_patient_menu_modal',$info);
	}

	function new_patient_menu_insert(){ //***********************************************************
		$location = $this->input->post('location_id');
		$date = $this->input->post('date');
		$ward = $this->input->post('ward');

		$data = array('bed_id' => $this->input->post('bed_id'),
			'patient_id' => $this->input->post('patient_id'),
			'names' => $this->input->post('names'),
			'location_id' => $location,
			'ward' => $ward,
			'date' => $date,
			'breakfast' => $this->input->post('breakfast'),
			'before_luch' => $this->input->post('before_luch'),
			'lunch' => $this->input->post('lunch'),
			'before_dinner' => $this->input->post('before_dinner'),
			'dinner' => $this->input->post('dinner'),
			'after_dinner' => $this->input->post('after_dinner'),
			'comments' => $this->input->post('comments'),
			'signature' => $this->session->userdata('full_name'),
			'creation_date' => date('Y-m-d')
		);

		//start audit info 

			$content = "Bed name".$this->input->post('bed_name')." Patient id => ".$this->input->post('patient_id').", patient name => ".$this->input->post('names').", Breakfast => ".$this->menu->get_menu_name($this->input->post('breakfast')). ", Before Lunch => ".$this->menu->get_menu_name($this->input->post('before_luch')). ", Lunch => ".$this->menu->get_menu_name($this->input->post('lunch')). ", Before Dinner => ".$this->menu->get_menu_name($this->input->post('before_dinner')). ", Dinner => ".$this->menu->get_menu_name($this->input->post('dinner')). ", After Dinner => ".$this->menu->get_menu_name($this->input->post('after_dinner'));
			$audit_info = array('date' => $date,'user_name' => $this->session->userdata("full_name"),"time_stamp" => date('Y-m-d H:i:s'),
				'ward' => $ward, 'action' => "Create", 'content' => $content);

		//end of audit info 

		$info['attributes'] = array('location' => $location, 'date' => $date, 'ward' => $ward);

		foreach ($data as $key => $value) {
			if ($value === '') {
				// Check if the column is an integer type and set the value to NULL
				if (in_array($key, ["breakfast", "before_luch", "lunch", "before_dinner", "dinner", "after_dinner"], true)) {
					$data[$key] = null;
				}
			}
		}

		if($this->menu->submit_new_book($data)){
			//we need to add menu book audit *****************************************************************
			$this->menu->menu_audit_trial($audit_info);
			$info['menus'] = $this->menu->check_menu_info($ward,$date);
	 		echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Congratulation information saved successfully <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	 		$this->load->view('menu/editable_menu_book',$info);
	 	}else{
	 		$info['menus'] = $this->menu->check_menu_info($ward,$date);
	 		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!... Failed to store information. please contact our awesome administrator for more information  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	 		$this->load->view('menu/editable_menu_book',$info);
	 	}


	}

	function Uneditable_menu_book_summary(){
		$module_name = "Hospital_menu_book_summary";
        	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
	          $module['module_name'] = $module_name;
	          $this->load->view('head',$module);
	    	  $this->load->view('menu/uneditable_menu_summary');
	    	  $this->load->view('footer');
	     }
	}

	function generate_uneditable_book(){
		$location = $this->input->post('ward');
		$date = $this->input->post('date');
		$ward = $location;
		if($location == "Ward One" || $location == "Surgical Ward"){
			$location = 1;
		}else{
			$location = 2;
		}
		$data['attributes'] = array('location' => $location, 'date' => $date, 'ward' => $ward);

		$editable_date = date_create(date('Y-m-d'));
		date_sub($editable_date,date_interval_create_from_date_string('3 days'));
		$editable_date = date_format($editable_date,'Y-m-d');
		$info = $this->menu->check_menu_info($ward,$date);

		if($info){
			$data['menus'] = $this->menu->get_menu_summary($ward,$date);
			$this->load->view('menu/daily_menu_summary',$data);
		}else{
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, the requested info is not available  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		}
	}


	function audit(){
		$module_name = "menu_book_audit";
	    	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
	          $module['module_name'] = $module_name;
	          $this->load->view('head',$module);
	    	  $this->load->view('menu/menu_audit_trail');
	    	  $this->load->view('footer');
	     }
	}

	function generate_menu_audit_report(){
		$ward = $this->input->post('ward');
		$date = $this->input->post('date');
		$audit_info = $this->menu->get_audit_report($ward,$date);
		$data = array('audit_info' => $audit_info,'ward' => $ward,'date' => $date);
		$this->load->view('menu/menu_audit_report',$data);
	}

}

?>