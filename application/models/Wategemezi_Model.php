<?php

	class Wategemezi_Model extends CI_Model{

		function get_employee_wategemezi($employee_id){
			$this->db->select('employee_id,names,dept1,dept1_relation,dept1_dob,dept2,dept2_relation,dept2_dob,dept3,dept3_relation,dept3_dob,dept4,dept4_relation,dept4_dob,dept5,dept5_relation,dept5_dob,dept6,dept6_relation,dept6_dob');
			$this->db->from('employee');
			$this->db->where('employee_id',$employee_id);

			return $this->db->get()->row();
		}

		function update_wategemezi($employee_id,$data){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			return $this->db->update('employee',$data);
		}

		function get_employee_details($names){
			$this->db->select('employee.employee_id,professional.professional_name,employee.dob,employee.phone_number,depertment.department_name,employee.dept1,employee.dept1_relation,employee.dept1_dob,employee.dept2,employee.dept2_relation,employee.dept2_dob,employee.dept3,employee.dept3_relation,employee.dept3_dob,employee.dept4,employee.dept4_relation,employee.dept4_dob,employee.dept5,employee.dept5_relation,employee.dept5_dob,employee.dept6,employee.dept6_relation,employee.dept6_dob,employee.hiring_date,employee.hr_dept_update');
			$this->db->from('employee');
			$this->db->from('professional');
			$this->db->from('depertment');
			$this->db->where('employee.names',$names);
			$this->db->where('employee.names',$names);
			$this->db->where('depertment.department_id = employee.department_id');
			$this->db->where('professional.id = employee.profession_id');

			return $this->db->get()->row();
		}

		function get_employee_wategemezi_info(){
			$this->db->select('employee.employee_id,employee.names,depertment.department_name,employee.dept1,employee.dept2,employee.dept3,employee.dept4,employee.dept5,employee.dept6');
			$this->db->from('employee');
			$this->db->from('depertment');
			$this->db->where('depertment.department_id = employee.department_id');
			$this->db->where('employee.hr_dept_update','0000-00-00');
			return $this->db->get()->result();
		}

		function delete_mtegemezi($employee_id,$data){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			return $this->db->update('employee',$data);
		}

		function save_wategemezi($employee_id,$data){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			return $this->db->update('employee',$data);
		}
	}


?>