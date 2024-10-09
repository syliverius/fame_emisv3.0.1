<?php 

	class Head_Of_Dept extends CI_Model{

		function check_roaster_existance($department_id,$year,$month){

			$this->db->select('monthly_shifts.employee_id,monthly_shifts.date,employee.department_id');
			$this->db->where('employee.employee_id = monthly_shifts.employee_id');
			$this->db->where('employee.department_id',$department_id);
			$this->db->where('DATE_FORMAT(monthly_shifts.date,"%Y")',$year);
			$this->db->where('DATE_FORMAT(monthly_shifts.date,"%M")',$month);
			$this->db->from('monthly_shifts');
			$this->db->from('employee');
			$result = $this->db->get();
			if($result->num_rows() >= 1){
				return true;
			}else{
				return false;
			}

		}

		function get_Department_Members($department_id){
			$this->db->select('names,employee_id');
			$this->db->where('department_id',$department_id);
			$this->db->where('status',"active");
			$this->db->from('employee');
			return $this->db->get()->result();
		}

		function getShifts($department_id){
			$query = $this->db->query('SELECT * FROM shifts_names WHERE FIND_IN_SET(?,department_ids) > 0',array($department_id));
			return $query->result();
		}

		function create_roaster($data){
			return $this->db->insert('monthly_shifts',$data);
		}

		function get_editable_shifts_data($value,$month){
			$this->db->select('date,shift_type_abbrev');
			$this->db->where('employee_id',$value);
			$this->db->where('DATE_FORMAT(date,"%M")',$month);
			return $this->db->get('monthly_shifts')->result();
		}

		function getShifts_sample($department_id,$month){
			$this->db->select('employee.employee_id,employee.names,monthly_shifts.date,monthly_shifts.shift_type_abbrev');
			$this->db->where('employee.department_id',$department_id);
			$this->db->where('monthly_shifts.employee_id=employee.employee_id');
			$this->db->where('DATE_FORMAT(monthly_shifts.date,"%M")',$month);
			$this->db->from('employee');
			$this->db->from('monthly_shifts');
			return $this->db->get()->result();
		}

		function update_roaster($data){
			$this->db->select('');
			$this->db->where('employee_id',element('employee_id',$data));
			$this->db->where('date',element('date',$data));
			return $this->db->update('monthly_shifts',$data);
		}

		function Create_new_shift_type($data){
			return $this->db->insert('shifts_names',$data);
		}

		function get_employee_month_summary($data){
			$this->db->select('monthly_shifts.date,monthly_shifts.shift_type_abbrev');
			$this->db->where('employee.employee_id',element('employee_id',$data));
			$this->db->where('employee.department_id',element('department_id',$data));
			$this->db->where('monthly_shifts.employee_id=employee.employee_id');
			$this->db->where('DATE_FORMAT(monthly_shifts.date,"%M")',element('month',$data));
			$this->db->where('DATE_FORMAT(monthly_shifts.date,"%Y")',element('year',$data));
			$this->db->from('employee');
			$this->db->from('monthly_shifts');
			return $this->db->get()->result();
		}

		public function get_department_id($dept_name){

		$this->db->select('*');
		$this->db->where('department_name',$dept_name);
		$response = $this->db->get('depertment');

		return $response->row();
	}

	function getEmployeeShift($employee_id,$date){
		$this->db->select('shift_type_abbrev')->from('monthly_shifts');
		$this->db->where('employee_id',$employee_id);
		$this->db->where('date',$date);
		return $this->db->get()->row();
	}

	function save_monthly_roster_changes($updates){
		return $this->db->insert('monthly_roaster_updates',$updates);
	} 

	function get_roster_updates($department_id,$month,$year){
		$this->db->select('update_id,date,updates,comments')->from('monthly_roaster_updates');
		$this->db->where('department_id',$department_id);
		$this->db->where('DATE_FORMAT(date,"%M")',$month);
		$this->db->where('DATE_FORMAT(date,"%Y")',$year);
		return $this->db->get();
	}
}

?>