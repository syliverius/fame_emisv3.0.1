<?php
	class Registration_Model extends CI_Model{

		public function get_Auto_Suggestion_Users($key_name){ 
				
				$this->db->select('names');
				$this->db->like('names',$key_name);
				$this->db->limit(5, 0); //display only 5 records starting from 0
				$this->db->order_by('names', 'asc');
				$response = $this->db->get('employee');
				return $response->result();
		}


		public function is_FullName_Found($fullname){

			$this->db->select('*');
			$this->db->where('names',$fullname);
			$result = $this->db->get('employee'); //considering using foreign key from employee for users id

			if($result -> num_rows() > 0){
				foreach($result->result() as $row){
					$data = array('employee_id' => $row->employee_id,
						'employee_role' => $row->position
						);
				}
				return $data; 
			}else{
				return "none";
			}
		}

		public function is_User_And_Username_Found($employee_id,$username){

			$this->db->select('*');
			$this->db->where('employee_id',$employee_id);
			$this->db->or_where('user_name',$username);
			$result = $this->db->get('users');

			if($result -> num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function create_User_Account($user_Data){
			return $this->db->insert('users',$user_Data);
		}


	}


?>