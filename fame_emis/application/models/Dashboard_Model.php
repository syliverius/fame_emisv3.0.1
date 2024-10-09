<?php 

	class Dashboard_Model extends CI_Model {


		function return_total_active_employee(){
			return $this->db->select('')->from('employee')->where('status',"active")->get()->num_rows();
		}

		function get_all_employee_id(){
			return $this->db->select('employee_id')->from('employee')->where('status','active')->get()->result();
		}

		function check_employee_in_annual_leave($employee_id){
			$this->db->select('employee_id');
			$this->db->where('leave_benefits.leave_id = leave_details.leave_id');
			$this->db->where('leave_benefits.end_date >=',date('Y-m-d'));
			$this->db->where('leave_benefits.start_date <=',date('Y-m-d'));
			$this->db->where('leave_benefits.hr_sign',true);
			$this->db->where('leave_benefits.accoutant_sign',true);
			$this->db->where('leave_details.employee_id',$employee_id);
			$this->db->from('leave_benefits');
			$this->db->from('leave_details');
			$rows = $this->db->get();
			if($rows->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		function check_employee_in_emergency_leave($employee_id){
			$this->db->select('')->from('emergency_leaves');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('start_date <=',date('Y-m-d'));
			$this->db->where('end_date >=',date('Y-m-d'));
			$this->db->where('hr_signature',true);
			$rows = $this->db->get();
			if($rows->num_rows()){
				return true;
			}else{
				return false;
			}
		}

		function getTotalEmployeeInDepartment($department_id){
			$this->db->select('')->from('employee')->where('department_id',$department_id)->where('status','active');
			return $this->db->get()->num_rows();
		}

		function get_Department_Members($department_id){
			$this->db->select('employee.names,employee.gender,professional.professional_name,employee.hiring_date');
			$this->db->where('employee.department_id',$department_id);
			$this->db->where('employee.status','active');
			$this->db->where('professional.id = employee.profession_id');
			$this->db->from('employee');
			$this->db->from('professional');
			return $this->db->get()->result();
		}

		function getTotalProfessional($professional_id){
			$this->db->select('')->from('employee');
			$this->db->where('profession_id',$professional_id);
			$this->db->where('status','active');
			return $this->db->get()->num_rows();
		}

		function get_profession_members($profession_id){
			$this->db->select('employee.names,employee.gender,depertment.department_name,employee.hiring_date');
			$this->db->where('employee.profession_id',$profession_id);
			$this->db->where('employee.status','active');
			$this->db->where('depertment.department_id = employee.department_id');
			$this->db->from('employee');
			$this->db->from('depertment');
			return $this->db->get()->result();
		}

		function get_profession_name($profession_id){
			return $this->db->select('')->from('professional')->where('id',$profession_id)->get()->row();
		}

		function return_present_employee($department_id,$date){
			$this->db->select('monthly_shifts.employee_id,employee.names,shifts_names.work_period,shifts_names.name');
			$this->db->where('monthly_shifts.date', $date);
			$this->db->where('employee.employee_id = monthly_shifts.employee_id');
			$this->db->where('employee.department_id', $department_id);
			$this->db->from('monthly_shifts');
			$this->db->join('employee', 'employee.employee_id = monthly_shifts.employee_id');
			$this->db->join('depertment', 'employee.department_id = depertment.department_id');
			$this->db->join('shifts_names','shifts_names.abbreviation = monthly_shifts.shift_type_abbrev');
			return $this->db->get()->result();
		}

		function get_employee_on_annual_leave(){
			$this->db->select('leave_benefits.start_date,leave_benefits.end_date,employee.names,depertment.department_name');
			$this->db->where('leave_benefits.start_date <=',date('Y-m-d'));
			$this->db->where('leave_benefits.end_date >=',date('Y-m-d'));
			$this->db->where('leave_benefits.accoutant_sign',true);
			$this->db->where('leave_details.leave_id = leave_benefits.leave_id');
			$this->db->where('employee.employee_id = leave_details.employee_id');
			$this->db->where('depertment.department_id = employee.department_id');
			$this->db->from('leave_benefits');
			$this->db->from('leave_details');
			$this->db->from('employee');
			$this->db->from('depertment');
			return $this->db->get()->result();
		}

		function get_expected_annual_leave($date){
			$this->db->select('leave_details.start_date,employee.names,depertment.department_name');
			$this->db->where('leave_details.start_date >=',date('Y-m-d'));
			$this->db->where('leave_details.start_date <=',$date);
			$this->db->where('employee.employee_id = leave_details.employee_id');
			$this->db->where('depertment.department_id = employee.department_id');
			$this->db->from('leave_details');
			$this->db->from('employee');
			$this->db->from('depertment');
			return $this->db->get()->result();
		}

		function get_coming_annual_leave($date){
			$this->db->select('leave_benefits.end_date,employee.names,depertment.department_name');
			$this->db->where('leave_benefits.end_date >=',date('Y-m-d'));
			$this->db->where('leave_benefits.end_date <=',$date);
			$this->db->where('leave_benefits.accoutant_sign',true);
			$this->db->where('leave_details.leave_id = leave_benefits.leave_id');
			$this->db->where('employee.employee_id = leave_details.employee_id');
			$this->db->where('depertment.department_id = employee.department_id');
			$this->db->from('leave_benefits');
			$this->db->from('leave_details');
			$this->db->from('employee');
			$this->db->from('depertment');
			return $this->db->get()->result();
		}

		function get_employee_on_emergency_leave(){
			$this->db->select('emergency_leaves.end_date,employee.names,depertment.department_name');
			$this->db->where('emergency_leaves.start_date <=',date('Y-m-d'));
			$this->db->where('emergency_leaves.end_date >=',date('Y-m-d'));
			$this->db->where('emergency_leaves.hd_signature',true);
			$this->db->where('emergency_leaves.hr_signature',true);
			$this->db->where('employee.employee_id = emergency_leaves.employee_id');
			$this->db->where('depertment.department_id = employee.department_id');
			$this->db->from('emergency_leaves');
			$this->db->from('employee');
			$this->db->from('depertment');
			return $this->db->get()->result();
		}
	}

?>