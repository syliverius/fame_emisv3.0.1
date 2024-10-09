<?php

 class Create_Roaster_Model extends CI_Model{

 	public function get_Auto_Suggestion_Employee($key,$dept_id){
 		$status = "active";
 		$query = "SELECT * FROM `employee` WHERE names like '" .$key. "%' AND department_id= '$dept_id' AND status= '$status' ORDER BY names LIMIT 0,6";

 		$response = $this->db->query($query);
		return $response->result();
 	}

 	public function create_Roaster($data){
 		return $this->db->insert('leave_details',$data);
 	}

 	public function get_roaster_data($current_year){
 		$this->db->select('employee.employee_id,employee.names,leave_details.start_date,leave_details.end_date,leave_details.reason,leave_details.comments');
 		$this->db->where('DATE_FORMAT(leave_details.start_date,"%Y")',$current_year);
 		$this->db->where('employee.employee_id = leave_details.employee_id');
 		$this->db->where('employee.department_id',$this->session->userdata('department_id'));
 		$this->db->from('leave_details');
 		$this->db->from('employee');

 		return $this->db->get();
 	}

 	public function check_name_and_department($employee_id,$dept_id){
 		$this->db->select('*');
 		$this->db->where('employee_id',$employee_id);
 		$this->db->where('department_id',$dept_id);
 		$result = $this->db->get('employee');
 		
 		if($result->num_rows()>0){
 			return $result->row();
 		}else{
 			return false;
 		}
 	}

 	public function is_employee_roaster_exists($employee_id,$current_year){
 		$this->db->select('*');
 		$this->db->where('employee_id',$employee_id);
 		$this->db->where('DATE_FORMAT(start_date,"%Y")',$current_year);
 		$result = $this->db->get('leave_details');

 		if($result->num_rows() <= 0){
 			return true;
 		}else{
 			return false;
 		}
 	}

 	public function get_employee_details($employee_id,$year){
 		$this->db->select('*');
 		$this->db->where('employee_id',$employee_id);
 		$this->db->where('DATE_FORMAT(start_date,"%Y")',$year);
 		$result = $this->db->get('leave_details');

 		if($result->num_rows()>0){
 			return $result->row();
 		}else{
 			return false;
 		}
 	}

 	//merhods like this need some ammendments
 	public function get_name($employee_id){ 
 		$this->db->select('*');
 		$this->db->where('employee_id',$employee_id);
 		$result = $this->db->get('employee');

 		if($result->num_rows()>0){
 			return $result->row();
 		}else{
 			return false;
 		}
 	}

 	public function delete_roaster_data($employee_id,$year){
 		$this->db->select('*');
 		$this->db->where('employee_id',$employee_id);
 		$this->db->where('DATE_FORMAT(start_date,"%Y")',$year);
 		$this->db->delete('leave_details');

 		if($this->db->affected_rows()){
 		 	return true;
		 	}else{
		 		return false;
		 	}
	 }

	public function update_roaster_data($employee_id,$year,$data){
		$this->db->select('*');
		$this->db->where('leave_id',$employee_id);
		$this->db->where('DATE_FORMAT(start_date,"%Y")',$year);
		$this->db->update('leave_details',$data);

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

public function upload_file($data){

	return $this->db->insert('uploads',$data);
}



 }

?>