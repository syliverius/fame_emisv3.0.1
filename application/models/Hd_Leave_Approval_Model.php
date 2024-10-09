<?php

class Hd_Leave_Approval_Model  extends CI_Model{

	public function getAllUnapprovedEmployee(){

		$year = date('Y');
		$this->db->select('*');
		$this->db->where('dept_head_sign',false);
		$this->db->where('DATE_FORMAT(start_date,"%Y")',$year);
		$result = $this->db->get('leave_benefits');

		return $result->result();
	}

	public function getEmployeeId($leave_id){
		$this->db->select('*');
		$this->db->where('leave_id',$leave_id);
		$result = $this->db->get('leave_details');

		return $result->row();
	}

	public function check_Department_Id_get_Name($employee_id){
		$this->db->select('')->from('employee');
		$this->db->select('')->from('professional');
		$this->db->where('employee_id',$employee_id);
		$this->db->where('department_id',$this->session->userdata('department_id'));
		$this->db->where('professional.id=employee.profession_id');
		$result = $this->db->get();

		return $result->row();
	}

	public function get_leave_id($benefit_id){
		$this->db->select('*');
		$this->db->where('benefit_id',$benefit_id);
		$result = $this->db->get('leave_benefits');

		return $result->row();
	}

	public function get_department_name($dept_Id){

		$this->db->select('*');
		$this->db->where('department_id',$dept_Id);
		$response = $this->db->get('depertment');

		return $response->row();
	}

	public function update_dept_head_approval($benefit_id,$data){
		$this->db->select('*');
		$this->db->where('benefit_id',$benefit_id);
		$query = $this->db->update('leave_benefits',$data);

		return $query;
	}

	function getUnapprovedEmergencyLeave(){
		$this->db->select('employee.names,emergency_leaves.emergency_id,emergency_leaves.start_date,emergency_leaves.end_date,emergency_leaves.emergency_days,emergency_leaves.sababu,emergency_leaves.comments');
		$this->db->where('employee.employee_id = emergency_leaves.employee_id');
		$this->db->where('employee.department_id',$this->session->userdata('department_id'));
		$this->db->where("emergency_leaves.hd_signature",false);
		$this->db->from('employee');
		$this->db->from('emergency_leaves');
		return $this->db->get()->result();
	}

	function getEmergencyLeaveInfo($emergency_id){
		$this->db->select('employee.names,employee.phone_number,emergency_leaves.emergency_id,emergency_leaves.date,emergency_leaves.emergency_days,emergency_leaves.start_date,emergency_leaves.end_date,emergency_leaves.sababu,emergency_leaves.comments,professional.professional_name,depertment.department_name');
		$this->db->where('emergency_leaves.emergency_id',$emergency_id);
		$this->db->where('employee.employee_id = emergency_leaves.employee_id');
		$this->db->where('depertment.department_id = employee.department_id');
		$this->db->where('professional.id = employee.profession_id');
		$this->db->from('emergency_leaves');
		$this->db->from('employee');
		$this->db->from('depertment');
		$this->db->from('professional');
		return $this->db->get()->row();
	}

	function update_emergency_leave($data){
		$this->db->select('');
		$this->db->where('emergency_id',element('emergency_id',$data));
		return $this->db->update('emergency_leaves',$data);
	}

	function emergency_leave_approval($emergency_id,$data){
		$this->db->select('');
		$this->db->where('emergency_id',$emergency_id);
		return $this->db->update('emergency_leaves',$data);
	}

	function delete_emergency_record($emergency_id){
		$this->db->select('');
		$this->db->where('emergency_id',$emergency_id);
		return $this->db->delete('emergency_leaves');
	}

	function send_to_hr($emergency_id,$data){
		$this->db->select('');
		$this->db->where('emergency_id',$emergency_id);
		return $this->db->update('emergency_leaves',$data);
	}
}

?>