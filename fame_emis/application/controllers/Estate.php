 
<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2023-12-30
 * @description For all estate management controllers
 * @license     Rwazi.co.tz

-->

 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Estate extends CI_Controller{
		function __construct(){
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
			  redirect('auth');
			}else{
				$this->session->set_userdata('last_activity', time()); // update the last activity time

				//Collection of useful modal 
				$this->load->model('estate_model','estate');

			}
		}

		//		***  START OF CARS ***

		function cars(){
			$module_name = "cars";
	        	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
		          $module['module_name'] = $module_name;
		          $this->load->view('head',$module);
		    		$this->load->view('estate/cars/home');
		    		$this->load->view('footer');
		     }
		}

		function Add_new_car(){
			$sms = "";
			$data = array(
					'name' => $this->input->post('name'),
					'registration_number' => $this->input->post('reg_number'),
					'uses' => $this->input->post('uses')
				);

			if($this->estate->addNewCar($data)){
				$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>New car added successful<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to add new cars, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			$data['sms'] = $sms;
			$this->load->view('estate/cars/available_cars',$data);
		}

		function add_cars_consumption_record(){
			$sms = "";
			$data = array('car_id' => $this->input->post('car_id'),
					'fuel_used' => $this->input->post('fuel_used'),
					'km_covered' => $this->input->post('km_covered'),
					'month' => $this->input->post('month'),
					'date_recorded' => $this->input->post('date_recorded'),
					'date_updated' => $this->input->post('today'),
					'signature' => $this->session->userdata('full_name') 
			);

			if($this->estate->create_car_consumption($data)){
				$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation cars fuel consumption added successful<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to add  cars fuel consumption, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			$data['sms'] = $sms;
			$this->load->view('estate/cars/cars_fuel_consumption',$data);
			$this->load->view('estate/cars/this_year_car_summary');
		}


		function create_car_annual_report(){
			$year = $this->input->post('year');
			$data['year'] = $year;
			$this->load->view('estate/cars/annual_usage_summary',$data);
		}



		//		*** END OF CARS ***


		//		*** START OF GENERATORS && MACHINES ***

		function generator_and_machines(){
			$module_name = "generator_and_machines";
	        	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
		          $module['module_name'] = $module_name;
		          $this->load->view('head',$module);
		    		$this->load->view('estate/generator_and_machines/home');
		    		$this->load->view('footer');
		     }
		}

		function add_new_machine(){
			$sms1 = "";
			$data = array('machine_id' => $this->input->post('machine_id'),
					'name' => $this->input->post('machine_name'),
					'others' => $this->input->post('uses')
			);

			if($this->estate->create_new_machine($data)){
				$sms1 = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation New machine added successful<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$sms1 = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to add  new machine, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			$data['sms1'] = $sms1;
			$this->load->view('estate/generator_and_machines/add_shell_and_machines',$data);
		}

		function add_new_fuel_station(){
			$sms2 = "";
			$data = array('name' => $this->input->post('fuel_station'),
					'others' => $this->input->post('comments')
			);

			if($this->estate->create_new_fuel_station($data)){
				$sms2 = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation New Fuel Station added successful<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$sms2 = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to add  new Fuel Station, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			$data['sms2'] = $sms2;
			$this->load->view('estate/generator_and_machines/add_shell_and_machines',$data);
		}

		function fuel_purchases(){
			$sms = "";
			$data = array('date_bought' => $this->input->post('purchase_day'),
					'amount' => $this->input->post('amount'),
					'station_id' => $this->input->post('station_id'),
					'cost_per_litre' => $this->input->post('cost'),
					'Recept_number' => $this->input->post('receipt_number'),
					'date_updated' => $this->input->post('today'),
					'signature' => $this->session->userdata('full_name')
			);
			if($this->estate->create_new_fuel_purchase($data)){
				$sms =  '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation New Fuel Purchase record added successful<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to add  new fuel purchases record, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			$response['sms'] = $sms;
			$this->load->view('estate/generator_and_machines/fuel_purchase',$response);
		}

		function fuel_usage(){
			$data = array('date_recorder' => $this->input->post('reading_date'),
					'amount_used' => $this->input->post('amount'),
					'Refilling_time' => $this->input->post('time'),
					'running_time' => $this->input->post('generator_reading'),
					'machine_id' => $this->input->post('machine_id'),
					'date_updated' => $this->input->post('today'),
					'signature' => $this->session->userdata('full_name')
				);
			if($this->estate->machine_fuel_usage($data)){
				$sms =  '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation New Fuel usages record added successful<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to add  new fuel usages record, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			$response['sms'] = $sms;
			$this->load->view('estate/generator_and_machines/fuel_usage',$response);
		}


		//		*** END OF GENERATOR && MACHINES ***


		//		*** START OF WATER && ELECTRICITY ***

		function water_and_electricity(){
			$module_name = "water_and_electricity";
	        	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
		          $module['module_name'] = $module_name;
		          $this->load->view('head',$module);
		    		$this->load->view('estate/water_and_electricity/home');
		    		$this->load->view('footer');
		     }
		}

		function add_new_electricity_location(){
			$sms = "";
			$data = array(
					'name' => $this->input->post('name'),
					'House_code_number' => $this->input->post('code'),
					'uses' => $this->input->post('uses')
				);

			if($this->estate->add_new_electricity_location($data)){
				$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>New Electricity location added successful<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to add new electricity location, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
			$data['sms'] = $sms;
			$this->load->view('estate/water_and_electricity/add_electricity_location',$data);
		}

		function electricity_usage_form(){
			$data = array("year" => $this->input->post("year"),
						"month" => $this->input->post("month")
				); 
			$check_data = $this->estate->check_electricity_usage($data);
			if($check_data->num_rows() > 0 && element('month',$data) == date('F',strtotime('last month')) && element('year',$data) == date('Y')){
				$value['data'] = $data;
				$value['current_data'] = $check_data->row();
				$this->load->view('estate/water_and_electricity/editable_electricity_usage',$value);
			}else if($check_data->num_rows() > 0 && element('month',$data) == date('F',strtotime('last month')) && element('year',$data) != date('Y')){
				$value['data'] = $data;
				$this->load->view('estate/water_and_electricity/uneditable_electricity_usage',$value);
			}
			else if($check_data->num_rows() > 0 && element('month',$data) != date('F',strtotime('last month'))){
				$value['data'] = $data;
				$this->load->view('estate/water_and_electricity/uneditable_electricity_usage',$value);
			}else{
				$value['data'] = $data;
				$this->load->view('estate/water_and_electricity/new_electricity_usage',$value);
			}
		}

		function create_new_usage(){
			$locations = $this->estate->getAllElectricityLocation();
			$sms = "";
			foreach($locations as $loc){
				$data = array('location_id' => $loc->id,
						'month' => $this->input->post('month'),
						'year' => $this->input->post('year'),
						'recorded_date' => $this->input->post($loc->id.'_date'),
						'units_recorded' => $this->input->post($loc->id.'_units'),
						'print_date' => date('Y-m-d'),
						'signature' => $this->session->userdata('full_name')
				);

				if(element('units_recorded',$data) == ""){
					$data['units_recorded'] = 0;
				}

				if($this->estate->create_new_electricity_usage($data)){
					$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation Data inserted successful. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				}else{
					$sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to insert new data, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				}
			}

			echo $sms;

		}

		function Update_electricity_usage(){
			$locations = $this->estate->getAllElectricityLocation();
			$sms = "";
			foreach($locations as $loc){
				$data = array(
						'location_id' => $loc->id,
						'recorded_date' => $this->input->post($loc->id.'_date'),
						'units_recorded' => $this->input->post($loc->id.'_units'),
						'print_date' => date('Y-m-d'),
						'signature' => $this->session->userdata('full_name')
					);

				if($this->estate->update_electricity_usages($data)){
					$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation Data Updated successful. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				}else{
					$sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Failed to update  data, for more details contact our awesome administrator<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				}
			}
			echo $sms;
		}



		//		*** END OF WATER && ELECTRICITY ***

		//		*** START OF ESTATE REPORTS ***

		function reports(){
			$module_name = "estate_reports";
	        	if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
		          $module['module_name'] = $module_name;
		          $this->load->view('head',$module);
		    		$this->load->view('estate/reports/home');
		    		$this->load->view('footer');
		     }
		}

		function cars_fuel_usage_report(){
			$data = array('year' => $this->input->post('year'),
					'car' => $this->input->post('car') 
				);
			if(element("car",$data) == "all"){
				$value['year'] = element('year',$data);
				$this->load->view('estate/reports/All_cars_graphs',$value);
			}else{
				$value['data'] = $data;
				$this->load->view('estate/reports/specific_car_graph',$value);
			}
		}

		function machines_reports(){
			 $year['year'] = $this->input->post('year');
			 $report_name = $this->input->post('report_name');
			 if($report_name == "Fuel Purchases"){
			 	$this->load->view('estate/reports/fuel_purchases_report',$year);
			 }else if($report_name == "Fuel Consumption"){
			 	$this->load->view('estate/reports/machines_fuel_consumptions',$year);
			 }else if($report_name == "Quartery Report"){
			 	$this->load->view('estate/reports/machine_quarter_report',$year);
			 }else{
			 	
			 }
		}

		function electricity_usage_graphs(){
			$thisYear = $this->input->post('year');
			$year['year'] = $thisYear;
			$id = $this->input->post('location');

			if($id == "all"){
				$this->load->view('estate/reports/all_location_electricity_fraph',$year);
			}else{
				$lastYear = $this->input->post('year')-1; //we need to check if is zero, if so january is zero others 
				$lastYearDecemberUnits = $this->estate->getDecemberUnits($lastYear,$id);
				if(empty($lastYearDecemberUnits)){
					$lastYearDecemberUnits = 0;
				}else{
					$lastYearDecemberUnits = $lastYearDecemberUnits->units_recorded;
				}

				$thisYearData = $this->estate->getThisyearUnits($thisYear,$id);
				
				$data['info'] = array('year' => $thisYear, 'DecemberUnits' => $lastYearDecemberUnits,"thisYearData" => $thisYearData,'location_id' => $id);
				$this->load->view('estate/reports/location_yearly_electricity_graph',$data);
			}

		}

	}

?>