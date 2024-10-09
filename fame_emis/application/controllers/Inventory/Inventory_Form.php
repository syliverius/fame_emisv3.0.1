<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Inventory_Form extends CI_Controller{
		function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
			}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
				redirect('auth');
			}else{
				 $this->session->set_userdata('last_activity', time()); // update the last activity time
				 $this->load->model('Inventory/Inventory_Model','inventory');
			}
		}

		function increment_bar_code($bar_code){
			$parts = explode('/', $bar_code);
			$number = end($parts);
			$number = intval($number) + 1;

			//Replace the original number with the incremented one 
			$parts[count($parts)-1] = $number;
			$bar_code = implode('/', $parts);
			return $bar_code;
		}

		public function insert_items(){
			$count = $this->input->post('count');
			$i = 0;
			$item_id = $this->inventory->get_item_id($this->input->post('item'))->item_id;
			$location_id = $this->inventory->get_location_id($this->input->post('location'))->location_id;
			$brand = $this->input->post('brand');
			$category = $this->input->post('category');
			$year_of_purchase = $this->input->post('year_of_purchase');
			$average_years = $this->input->post('average_years');
			$purchase_price = $this->input->post('purchase_price');
			$service_cost = $this->input->post('service_cost');
			$status = $this->input->post('status');
			$remarks = $this->input->post('remarks');
			$vendor = $this->input->post('vendor');
			$serial = $this->input->post('serial');
			$bar_code = $this->input->post('bar_code');
			$asset_type = $this->input->post('asset_type');
			$created_date = date('Y-m-d');

			$data = array(
				'item_key' => $item_id,
				'created_date' =>$created_date,
				'year_purchased' => $year_of_purchase,
				'average_life' => $average_years,
				'price_of_purchase' =>$purchase_price,
				'service_contract_cost' => $service_cost,
				'status' => $status,
				'remarks' => $remarks,
				'vendor' => $vendor,
				'location_id' => $location_id,
				'bar_code' => $bar_code,
				'item_serial_number' => $serial,
				'asset_type' => $asset_type,
				'brand' => $brand,
				'category' => $category,
			);

			if($item_id && $location_id){
				do{
					$data = array(
						'item_key' => $item_id,
						'created_date' =>$created_date,
						'year_purchased' => $year_of_purchase,
						'average_life' => $average_years,
						'price_of_purchase' =>$purchase_price,
						'service_contract_cost' => $service_cost,
						'status' => $status,
						'remarks' => $remarks,
						'vendor' => $vendor,
						'location_id' => $location_id,
						'bar_code' => $bar_code,
						'item_serial_number' => $serial,
						'asset_type' => $asset_type,
						'brand' => $brand,
						'category' => $category,
					);
					if($this->inventory->create_inventory($data)){
						$this->session->set_flashdata('inventory_insert_sms','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> <b>Congratulation!!...  </b> item/items inserted into our database successfull!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					} else{
						$this->session->set_flashdata('inventory_insert_sms','<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> <b>Sorry! ... There is problem with our system inserting your data into the database, please contact our awesome admin for more information<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					}
					$bar_code = $this->increment_bar_code($bar_code);
					$i++;
				}while($i < $count);					
			}
		}

		
	}

?>