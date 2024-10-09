<?php

defined('BASEPATH') OR exit('No direct script access allowed');


	class Inventory_Items extends CI_Controller {

		function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); // update the last activity time
				 $this->load->model('Inventory/Inventory_Model','lists');			}
		}

		public function index(){
			$module_name = "inventory_home";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$data['location'] = $this->lists->locations();
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('inventory/inventory_items',$data);
				$this->load->view('footer');
			}
		}

		public function items_lists_autosuggestion(){
				$data = $this->input->get('query');
			 	$items = $this->lists->get_items_list($data);

			 	$data = array();
			 	foreach($items as $item){
			 		$data[]= $item->item_name;
			 	}
			 	echo json_encode($data); 
			}

		public function department_summary(){
			$data = array();
			$location_name = $this->input->post('location');
			$data['location_name'] =  $location_name;
			$location_id = $this->lists->get_location_id($location_name)->location_id; 
			$data['location_id'] = $location_id;
			if($location_id){
				$dept_items = $this->lists->getDeptItemList($location_id);
				if($dept_items){
					$data['dept_items'] = $dept_items;
				}else{
					//failed to retrieve department items 
				}
			}else{
				//cant find location id 
			}
			
			$this->load->view('inventory/department_summary', $data);	
		}

		public function item_view_edit(){

			$data = array();
			$data['locations'] = $this->lists->locations();
			$inventory_id = $this->input->post('inventory_id');
			$inventory_details = $this->lists->getInventoryDetails($inventory_id);

			if($inventory_details){
				$data['details'] = $inventory_details;
			}else{
				//failed to retrieve inventory details
			}

			$this->load->view('inventory/inventory_item_details',$data);
		}

		public function	update_inventory_item(){
			$location_id = $this->lists->get_location_id($this->input->post('location'))->location_id;
			$sms = "";
			$modified_date = date('Y-m-d');
			$display = array();
			$display['location_name'] = $this->input->post('location');
			$data = array(
				'inventory_id' => $this->input->post('inventory_id'),
				'year_purchased' => $this->input->post('year_of_purchase'),
				'average_life' => $this->input->post('average_years'),
				'price_of_purchase' =>$this->input->post('purchase_price'),
				'service_contract_cost' => $this->input->post('service_cost'),
				'status' => $this->input->post('status'),
				'remarks' => $this->input->post('remarks'),
				'vendor' => $this->input->post('vendor'),
				'location_id' => $location_id,
				'bar_code' => $this->input->post('bar_code'),
				'item_serial_number' => $this->input->post('serial'),
				'asset_type' => $this->input->post('asset_type'),
				'brand' => $this->input->post('brand'),
				'category' => $this->input->post('category'),
				'modified_date' => $modified_date
			);

			if($this->lists->update_inventory_data($data)){
				$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"> Item info updated successful  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				$sms = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry we encountered a problem in updating an item. please contact our awesome admin for more information  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
				$this->get_updated_location_items($location_id,$this->input->post('item_id'),$sms);
		}

		public function create_new_location(){
			$location_name = $this->input->post('new_location');
			if($this->lists->create_new_location($location_name)){
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> Conglatulation ' .$location_name.' created as the new location <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry a problem occured during creating new location  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}

		}

		public function create_new_item(){
			$item_name = $this->input->post('new_item');
			if($this->lists->create_new_item($item_name)){
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> Conglatulation ' .$item_name.' created as the new item <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry a problem occured during creating new item  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}

		public function get_suggested_barCode(){
			$result = "";
			$item_name = $this->input->post('item_name');
			$location = $this->input->post('location');
			if($item_name && $location != ""){
				//first get location details
				$location_details = $this->lists->get_location_id($location);
				//get item details
				$item_details = $this->lists->get_item_id($item_name);
				//count same items in a certain location 
				$total_items = $this->lists->getItemCountsDepertmentWise($item_details->item_id,$location_details->location_id)+1;
				if($location == "RECEPTION" || $location == "OPD PHARMACY(PH)" || $location == "CASHIER OFFICE" || $location == "DOCTORS ROOM(DR)" || $location == "PROCEDURE ROOM(PR)" || $location == "TRIAGE"){
					$result = "FM/OPD/".$location_details->abbreviation."/".str_replace(' ', '_', $item_name)."/".$total_items;
				}
				else if($location =="RAYNES HOUSE(RAYNES)" || $location == "JOYCE HOUSE(JOYCE)" || $location == "KOEING HOUSE" || $location == "NEAL HOUSE(NEAL)" || $location == "ROBERT HOUSE"){
					$result = "FM/VOL/".$location_details->abbreviation."/".str_replace(' ', '_', $item_name)."/".$total_items;
					}else{
						$result = "FM/".$location_details->abbreviation."/".str_replace(' ', '_', $item_name)."/".$total_items;
					}
				}else{
					$result = "please_fill_item_field_first";
				}
					echo "<input type='text' class='form-control' name='bar_code' value =$result>";
			}

			function getAllParticularItem(){
				$data = array();
				$item_id = $this->input->post('item_id');
				$location_id = $this->input->post('location_id');

				$items = $this->lists->getAllParticularItem($item_id,$location_id);

				$data['items'] = $items;
				$data['location_id'] = $location_id;
				$data['item_id'] = $item_id;

				$this->load->view('inventory/All_specified_dept_item',$data);
			}

			function delete_item(){
				$inventory_id = $this->input->post('inventory_id');
				$item_key = $this->input->post('item_key');
				$location_id = $this->input->post('location_id');

				if($this->lists->delete_item($inventory_id)){
					$sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"> Item delete successful from our current inventory  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				}else{
					$sms = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> Sorry!!... Failed to delete the item, please contact our awesome administrator for more information  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

				}

					$this->get_updated_location_items($location_id,$item_key,$sms);
			}

			function get_updated_location_items($location_id,$item_id,$sms){
				$data = array();
				$location_id = $location_id;
				$items = $this->lists->getAllParticularItem($item_id,$location_id);

				$data['items'] = $items;
				$data['location_id'] = $location_id;
				$data['item_id'] = $item_id;
				$data['sms'] = $sms;   

				$this->load->view('inventory/All_specified_dept_item',$data);
			}
		}

?>