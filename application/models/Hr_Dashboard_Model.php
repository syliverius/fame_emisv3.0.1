<?php
 class Hr_Dashboard_Model extends CI_Model{

 	public function getAllUnapprovedEmployee(){

		$year = date('Y');
		$this->db->select('*');
		$this->db->where('hr_sign',false);
		$this->db->where('dept_head_sign',true);
		$this->db->where('DATE_FORMAT(start_date,"%Y")',$year);
		$result = $this->db->get('leave_benefits');

		return $result->result();
	}

	public function get_Employee_Name($employee_id){
		$this->db->select('')->from('employee');
		$this->db->select('')->from('professional');
		$this->db->where('employee_id',$employee_id);
		$this->db->where('professional.id=employee.profession_id');
		$result = $this->db->get();

		return $result->row();
	}

	public function get_Department_Details($department_id){
		$this->db->select('*');
		$this->db->where('department_id',$department_id);
		$result = $this->db->get('depertment');

		return $result->row();
	}

	public function get_dept_head_name($department_id){
		$this->db->select('*');
		$this->db->where('department_id',$department_id);
		$this->db->where('position','HEAD');
		$result = $this->db->get('employee');

		return $result->row();

	}

	public function emergency_approval_name($employee_id){
		$this->db->select('*');
		$this->db->where('employee_id',$employee_id);
		$result = $this->db->get('employee');

		return $result->row();

	}

	public function hr_update_leave_model($benefit_id,$update_data){
		$this->db->select('*');
		$this->db->where('benefit_id',$benefit_id);
		$result = $this->db->update('leave_benefits',$update_data);
		// $result2 = $this->db->query($query);

		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function get_Benefit_info($benefit_id){
		$this->db->select('*');
		$this->db->where('benefit_id',$benefit_id);
		$result = $this->db->get('leave_benefits');

		return $result->row();
	}

	public function update_hr_approval($benefit_id,$data,$update_off_days){
		//below here we need to search a query to minus in the database
		$current_leave_id = element('leave_id',$update_off_days);
		$days_off = element('days_off',$update_off_days);
		$query = "UPDATE `leave_details` SET `days_left`=(`days_left`- $days_off) WHERE `leave_id`='$current_leave_id'";
		$this->db->select('*');
		$this->db->where('benefit_id',$benefit_id);
		$query1 = $this->db->update('leave_benefits',$data);
		$query2 = $this->db->query($query);
		if($query1 && $query2){
			return true;
		}else{
			return false;
		}
	}

	function getWhoWhentOnLeave($start_date,$end_date){
		$this->db->select('leave_benefits.start_date,leave_benefits.end_date,employee.names,depertment.department_name');
		$this->db->where('leave_benefits.start_date >=',$start_date);
		$this->db->where('leave_benefits.start_date <=',$end_date);
		$this->db->where('leave_benefits.accoutant_sign',true);
		$this->db->where('leave_details.leave_id = leave_benefits.leave_id');
		$this->db->where('employee.employee_id = leave_details.employee_id');
		$this->db->where('depertment.department_id = employee.department_id');
		$this->db->from('leave_benefits');
		$this->db->from('leave_details');
		$this->db->from('employee');
		$this->db->from('depertment');
		return $this->db->get();
	}

	function getWhoComingFromLeave($start_date,$end_date){
		$this->db->select('leave_benefits.start_date,leave_benefits.end_date,employee.names,depertment.department_name');
		$this->db->where('leave_benefits.end_date >=',$start_date);
		$this->db->where('leave_benefits.end_date <=',$end_date);
		$this->db->where('leave_benefits.accoutant_sign',true);
		$this->db->where('leave_details.leave_id = leave_benefits.leave_id');
		$this->db->where('employee.employee_id = leave_details.employee_id');
		$this->db->where('depertment.department_id = employee.department_id');
		$this->db->from('leave_benefits');
		$this->db->from('leave_details');
		$this->db->from('employee');
		$this->db->from('depertment');
		return $this->db->get();
	}

	public function getEmployeeId($employee_names){
		$this->db->select('*');
		$this->db->where('names',$employee_names);
		$result = $this->db->get('employee');

		return $result->row();
	}

	public function get_leave_ids($employee_id){
		$this->db->select('*');
		$this->db->where('employee_id',$employee_id);
		$result = $this->db->get('leave_details');

		return $result->result();
	}

	public function getBenefitDetails($leave_id){
		$this->db->select('benefit_id,start_date,end_date,days_off,mkoa,wilaya,kata,amount,mtegemezi_1,mtegemezi_2,mtegemezi_3,mtegemezi_4,mtegemezi_5,nauli_kiasi,nauli_count,chakula_kiasi,chakula_count,maradhi_kiasi,maradhi_count');
		$this->db->where('leave_id',$leave_id);
		$this->db->where('dept_head_sign',true);
		$this->db->where('hr_sign',true);
		$this->db->where('accoutant_sign',true);
		$result = $this->db->get('leave_benefits');

		return $result->result();

	}

	function getWhoIsGoingToLeave($start_date,$end_date){
		$this->db->select('leave_details.start_date,leave_details.end_date,employee.names,depertment.department_name');
		$this->db->where('leave_details.start_date >=',$start_date);
		$this->db->where('leave_details.start_date <=',$end_date);
		$this->db->where('employee.employee_id = leave_details.employee_id');
		$this->db->where('depertment.department_id = employee.department_id');
		$this->db->from('leave_details');
		$this->db->from('employee');
		$this->db->from('depertment');
		return $this->db->get();
	}

	public function getWhoIsGoingToLeave2($start_date,$end_date){
		$this->db->select('*');
		$this->db->where('start_date >=',$start_date);  //select the dates between
		$this->db->where('start_date <=',$end_date);
		$result = $this->db->get('leave_details');

		return $result->result();
	}

	public function check_Department_Id_get_Name($employee_id){
		$this->db->select('*');
		$this->db->where('employee_id',$employee_id);
		$result = $this->db->get('employee');

		return $result->row();
	}

	public function getDepartments(){
		$this->db->select('');
		$this->db->order_by('department_name','ASC');
		return $this->db->get('depertment')->result();
	}

	public function get_roaster_data($current_year){
 		$sql = "SELECT * FROM `leave_details` WHERE (DATE_FORMAT(start_date,'%Y'))=$current_year";
 		$result = $this->db->query($sql);

 		if($result->num_rows()>0){
 			return $result->result();
 		}else{
 			return false;
 		}
 	}

 	public function get_dept_id($dept_name){
 		$this->db->select('');
 		$this->db->where('department_name',$dept_name);
 		$dept_id = $this->db->get('depertment');

 		return $dept_id->row();
 	}

 	function reject_employee_request($benefit_id){
 		$this->db->select('');
 		$this->db->from('leave_benefits');
 		$this->db->where('benefit_id',$benefit_id);
 		return $this->db->delete();
 	}

 	function getHrUnapprovedEmergencyLeave(){
 		$this->db->select('employee.names,depertment.department_name,emergency_leaves.emergency_id,emergency_leaves.start_date,emergency_leaves.end_date,emergency_leaves.emergency_days,emergency_leaves.sababu,emergency_leaves.comments');
		$this->db->where('employee.employee_id = emergency_leaves.employee_id');
		$this->db->where('depertment.department_id = employee.department_id');
		$this->db->where("emergency_leaves.hd_signature",true);
		$this->db->where("emergency_leaves.hr_signature",false);
		$this->db->where('DATE_FORMAT(emergency_leaves.date,"%Y")',date('Y'));
		$this->db->from('employee');
		$this->db->from('emergency_leaves');
		$this->db->from('depertment');
		return $this->db->get()->result();
 	}

 	function getEmergencyLeaveInfo($emergency_id){
 		$this->db->select('employee.names,employee.department_id,employee.phone_number,emergency_leaves.emergency_id,emergency_leaves.date,emergency_leaves.emergency_days,emergency_leaves.start_date,emergency_leaves.end_date,emergency_leaves.sababu,emergency_leaves.comments,emergency_leaves.hd_date,emergency_leaves.hd_id,professional.professional_name,depertment.department_name');
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

	function emergency_leave_approval($emergency_id,$data){
		$this->db->select('');
		$this->db->where('emergency_id',$emergency_id);
		return $this->db->update('emergency_leaves',$data);
	}

	function get_employee_on_leave(){
		$this->db->select('');
		$this->db->from('emergency_leaves');
		$this->db->where('start_date <=',date('Y-m-d'));
		$this->db->where('end_date >=',date('Y-m-d'));
		$this->db->where('hd_signature',true);
		$this->db->where('hr_signature',true);
		return $this->db->get()->result();
	}

	function getAllEmployee(){
		$this->db->select('employee_id,names,department_id');
		$this->db->from('employee');
		return $this->db->get()->result();
	}

	function count_emergency_days($employee_id){
		$this->db->select('*')->from('emergency_leaves');
		$this->db->where('employee_id',$employee_id);
		$this->db->where('hr_signature',true);
		$this->db->where('DATE_FORMAT(hr_date,"%Y")',date('Y'));
		
		return $this->db->get()->result();
	}

	function get_emergency_history($employee_id){
		$this->db->select('emergency_leaves.emergency_id,emergency_leaves.hd_date,emergency_leaves.date,emergency_leaves.start_date,emergency_leaves.end_date,emergency_leaves.emergency_days,emergency_leaves.sababu,emergency_leaves.comments,employee.names,employee.phone_number,employee.employee_id,depertment.department_name,depertment.department_id,professional.professional_name');
		$this->db->where('emergency_leaves.employee_id',$employee_id);
		$this->db->where('emergency_leaves.hr_signature',true);
		$this->db->where('DATE_FORMAT(emergency_leaves.hr_date,"%Y")',date('Y'));
		$this->db->where('employee.employee_id = emergency_leaves.employee_id');
		$this->db->where('depertment.department_id = employee.department_id');
		$this->db->where('professional.id = employee.profession_id');
		$this->db->from('emergency_leaves');
		$this->db->from('employee');
		$this->db->from('depertment');
		$this->db->from('professional');
		return $this->db->get()->result();
	}

	function return_employee_name($employee_id){
		return $this->db->select('names,department_id')->from('employee')->where('employee_id',$employee_id)->get()->row();
	}
	
 }

?>