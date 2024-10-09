<?php

	class Inventory_Model extends CI_Model{

		public function locations(){
			$this->db->select('');
			$this->db->from('location');
			return $this->db->get()->result();
		}

		public function get_items_list($key_name){ 
				
			$this->db->select('item_name');
			$this->db->like('item_name',$key_name);
			$this->db->limit(10, 0); //display only 5 records starting from 0
			$this->db->order_by('item_name', 'asc');
			$response = $this->db->get('hospital_items');
			return $response->result();
		}

		public function get_item_id($item_name){
			$this->db->select('');
			$this->db->where('item_name',$item_name);
			$result = $this->db->get('hospital_items');

			return $result->row();
		}

		public function get_item_name($item_id){
			$this->db->select('');
			$this->db->where('item_id',$item_id);
			$result = $this->db->get('hospital_items');

			return $result->row();
		}

		public function get_location_name($location_id){
			$this->db->select('');
			$this->db->where('location_id',$location_id);
			$result = $this->db->get('location');

			return $result->row();
		}

		public function get_location_id($location_name){
			$this->db->select('');
			$this->db->where('location_name',$location_name);
			$result = $this->db->get('location');

			return $result->row();
		}

		public function create_inventory($data){
			return $this->db->insert('inventory',$data);
		}

		public function getDeptItemList($location_id){
			$this->db->select('*')->from('inventory');
			$this->db->where('location_id',$location_id);
			$this->db->join('hospital_items','hospital_items.item_id=inventory.item_key');
			return $this->db->get()->result();
		}

		public function getInventoryDetails($inventory_id){
			$this->db->select('*')->from('inventory');
			$this->db->where('inventory_id',$inventory_id);
			$this->db->join('hospital_items','hospital_items.item_id=inventory.item_key');
			$this->db->join('location','location.location_id = inventory.location_id');


			return $this->db->get()->row();
		}

		public function update_inventory_data($data){
			$this->db->select('');
			$this->db->where('inventory_id',element('inventory_id',$data));
			return $this->db->update('inventory',$data);
		}

		public function create_new_location($location_name){
			$data = array('location_name' => $location_name);
			return $this->db->insert('location',$data);
		}

		public function create_new_item($item_name){
			$data = array('item_name' => $item_name);
			return $this->db->insert('hospital_items',$data);
		}

		public function getAllItems(){
			$this->db->select('')->from('hospital_items');
			return $this->db->get()->result();
		}

		public function getItemCounts($item_id){
			$this->db->select('')->from('inventory');
			$this->db->where('item_key',$item_id);

			return $this->db->get()->num_rows();
		}

		public function getItemCountsDepertmentWise($item_id,$location_id){
			$this->db->select('')->from('inventory');
			$this->db->where('item_key',$item_id);
			$this->db->where('location_id',$location_id);

			return $this->db->get()->num_rows();
		}

		public function getAllParticularItem($item_id,$location_id){
			$this->db->select('')->from('inventory');
			$this->db->where('item_key',$item_id);
			$this->db->where('location_id',$location_id);
			$this->db->join('hospital_items','hospital_items.item_id=inventory.item_key');
			return $this->db->get()->result();
		}

		function delete_item($item_id){
			$this->db->select('');
			$this->db->where('inventory_id',$item_id);
			return $this->db->delete('inventory');
		}

	}


?>