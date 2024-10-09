<?php

class Accoutant_Dashboard_Model extends CI_Model{

	public function getAllUnapprovedEmployee(){
		$year = date('Y');
		$this->db->select('*');
		$this->db->where('accoutant_sign',false);
		$this->db->where('dept_head_sign',true);
		$this->db->where('hr_sign',true);
		$this->db->where('DATE_FORMAT(start_date,"%Y")',$year);
		$result = $this->db->get('leave_benefits');

		return $result->result();
	}

	public function get_hr_head_name(){
		$this->db->select('*');
		$this->db->where('department_id',14);
		$this->db->where('position','HEAD');
		$result = $this->db->get('employee');

		return $result->row();

	}

	function update_accountant_approval($benefit_id,$data){
		$this->db->select('*');
		$this->db->where('benefit_id',$benefit_id);
		$query1 = $this->db->update('leave_benefits',$data);
		if($query1){
			return true;
		}else{
			return false;
		}
	}

}



?>