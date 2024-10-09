<?php

class Reports_Model extends CI_Model{

	public function get_Employee_name($employee_id){
		$status = "active";
		$this->db->select('')->from('employee');
		$this->db->where('employee_id',$employee_id);
		$this->db->where('status',$status);
		$this->db->join('professional','professional.id=employee.profession_id');
		$response = $this->db->get();

		if($response->num_rows() > 0){
			return $response->row();
		}else{
			return false;
		}
	}

	public function get_book10_data($current_year){
 		$this->db->select('employee.employee_id,employee.names,leave_details.start_date,leave_details.end_date,leave_details.reason,leave_details.comments');
 		$this->db->where('DATE_FORMAT(leave_details.start_date,"%Y")',$current_year);
 		$this->db->where('employee.employee_id = leave_details.employee_id');
 		$this->db->from('leave_details');
 		$this->db->from('employee');

 		return $this->db->get();
 	}

 	function generate_system_trial_report($start_date_stamp,$end_date_stamp){
 		$this->db->select('*')->from('audit_trial');
 		$this->db->where('time_stamp >=',$start_date_stamp);
 		$this->db->where('time_stamp <=',$end_date_stamp);
 		return $this->db->get()->result();
 	}

	
}


?>