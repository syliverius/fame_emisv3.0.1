<?php 
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
 	class Inventory_Dashboard extends CI_Controller{
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

		public function index(){
			$module_name = "inventory_dashboard";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$data['item_count'] = $this->getCountsOfAllItems();
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('inventory/dashboard',$data);
				$this->load->view('footer');
			}
		}
		
		public function getCountsOfAllItems(){
			$data = array();
			$items = $this->inventory->getAllItems();
			foreach ($items as $item){
				$item_counts = $this->inventory->getItemCounts($item->item_id);
				$data[] = array(
					'item_id' => $item->item_id,
					'item_name' => $item->item_name,
					'total' => $item_counts
				);
			}

			return $data;
		}

		public function item_allocation(){
			$item_id = $this->input->post('inventory_id');
			$data['item_name'] = $this->inventory->get_item_name($item_id);
			$data['item_dept_count'] = $this->getCountsOfItemDepartmentWise($item_id);

			$this->load->view('inventory/item_summary_dept',$data);
		}

		public function getCountsOfItemDepartmentWise($item_id){
			$data = array();

			$locations = $this->inventory->locations();

			foreach ($locations as $location){
				$item_counts = $this->inventory->getItemCountsDepertmentWise($item_id,$location->location_id);
				$data[] = array(
					'location_name' => $location->location_name,
					'total' => $item_counts
				);
			}

			return $data;
		}
 	}

?>