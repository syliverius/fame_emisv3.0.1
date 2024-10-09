<?php


 class Attendance_Model extends CI_Model{

 	function insert_imported_data($data){
 		$this->db->insert('attendance',$data);
 	}

 	function get_imported_data(){
 		$this->db->select('*');
 		$this->db->where('print_date',date('Y-m-d'));
 		return $this->db->get('attendance')->result();
 	}

 	function get_employee_info($employee_id){
 		$this->db->select('employee.names,depertment.department_name');
 		$this->db->where('employee.employee_id',$employee_id);
 		$this->db->where('depertment.department_id = employee.employee_id');
 		$this->db->from('employee');
 		$this->db->from('depertment');
 		return $this->db->get()->row();
 	}

 	function departments(){
 		$this->db->select('');
 		$this->db->from('depertment');
 		return $this->db->get()->result();
 	}

 	function checkWeeklyReport($department_id,$startDate,$endDate){
 		$this->db->select('attendance.employee_id,attendance.datetime,attendance.status');
 		$this->db->from('employee');
 		$this->db->join('depertment', 'employee.department_id = depertment.department_id', 'left');
		$this->db->join('attendance', 'employee.employee_id = attendance.employee_id', 'left');
		$this->db->where('employee.department_id', $department_id);
		$this->db->where('attendance.datetime >=', $startDate);
		$this->db->where('attendance.datetime <=', $endDate);
 		return $this->db->get();
 	}

 	function getDepartmentMembers($department_id){
 		$this->db->select('employee_id,names');
 		$this->db->from('employee');
 		$this->db->where('department_id',$department_id);
 		$this->db->where('status','active');
 		return $this->db->get()->result();
 	}

 	function checkSignInTime($expectedEarlySignIn,$expectedLateSignIn,$employee_id){
 		$this->db->select('datetime');
 		$this->db->from('attendance');
 		$this->db->where('datetime >=',$expectedEarlySignIn);
 		$this->db->where('datetime <=',$expectedLateSignIn);
 		$this->db->where('status = "In"');
 		$this->db->where('employee_id',$employee_id);
 		$result = $this->db->get(); // remember to came back here and do some editing about what to return 
 		if($result->num_rows() > 0){
 			return $result->first_row();
 		}else{
 			return "empty";
 		}
 	}

 	function checkSignOutTime($expectedEarlySignOut,$expectedLateSignOut,$employee_id){
 		$this->db->select('datetime');
 		$this->db->from('attendance');
 		$this->db->where('datetime >=',$expectedEarlySignOut);
 		$this->db->where('datetime <=',$expectedLateSignOut);
 		$this->db->where('status = "Out"');
 		$this->db->where('employee_id',$employee_id);
 		$result = $this->db->get(); // remember to came back here and do some editing about what to return 
 		if($result->num_rows() > 0){
 			return $result->last_row();
 		}else{
 			return "empty";
 		}
 	}

 	function get_date_shift($employee_id,$date){
 		$this->db->select('shifts_names.name,shifts_names.work_period,shifts_names.abbreviation');
 		$this->db->where('monthly_shifts.date',$date);
 		$this->db->where('monthly_shifts.employee_id',$employee_id);
 		$this->db->where('shifts_names.abbreviation = monthly_shifts.shift_type_abbrev');
 		$this->db->from('monthly_shifts');
 		$this->db->from('shifts_names');
 		return $this->db->get()->row();
 	}

 	function check_emergency($employee_id,$date){
 		$this->db->select('');
 		$this->db->where('employee_id',$employee_id);
		$this->db->where('start_date <=',$date);
		$this->db->where('end_date >=',$date);
		$this->db->where('hd_signature',true);
		$this->db->where('hr_signature',true);
		$result = $this->db->get('emergency_leaves');
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
 	}

 	function check_annual_leaves($employee_id,$date){
 		$this->db->select('');
 		$this->db->where('leave_details.employee_id',$employee_id);
 		$this->db->where('leave_benefits.leave_id = leave_details.leave_id');
 		$this->db->where('leave_benefits.start_date <=',$date);
 		$this->db->where('leave_benefits.end_date >=',$date);
 		$this->db->where('leave_benefits.accoutant_sign',true);
 		$this->db->from('leave_details');
 		$this->db->from('leave_benefits');
 		$result = $this->db->get();
 		if($result->num_rows > 0){
 			return true;
 		}else{
 			return false;
 		}
 	}

 }



?>