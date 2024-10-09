<?php

	class Notification_Model extends CI_Model{

		function unapproved_leave_dept_head(){
			$this->db->select('');
			$this->db->where('leave_benefits.dept_head_sign',false);
			$this->db->where('DATE_FORMAT(leave_benefits.start_date,"%Y")',date('Y'));
			$this->db->where('leave_benefits.leave_id = leave_details.leave_id');
			$this->db->where('leave_details.employee_id = employee.employee_id');
			$this->db->where('employee.department_id',$this->session->userdata('department_id'));
			$this->db->from('leave_benefits');
			$this->db->from('leave_details');
			$this->db->from('employee');
		    return $this->db->get()->num_rows();
		}

		function unapproved_leave_hr(){
			$this->db->select('');
			$this->db->where('leave_benefits.dept_head_sign',true);
			$this->db->where('leave_benefits.hr_sign',false);
			$this->db->where('DATE_FORMAT(leave_benefits.start_date,"%Y")',date('Y'));
			$this->db->where('leave_benefits.leave_id = leave_details.leave_id');
			$this->db->where('leave_details.employee_id = employee.employee_id');
			$this->db->from('leave_benefits');
			$this->db->from('leave_details');
			$this->db->from('employee');
		    return $this->db->get()->num_rows();
		}

		function unapproved_leave_accoutant(){
			$this->db->select('');
			$this->db->where('leave_benefits.dept_head_sign',true);
			$this->db->where('leave_benefits.hr_sign',true);
			$this->db->where('leave_benefits.accoutant_sign',false);
			$this->db->where('DATE_FORMAT(leave_benefits.start_date,"%Y")',date('Y'));
			$this->db->where('leave_benefits.leave_id = leave_details.leave_id');
			$this->db->where('leave_details.employee_id = employee.employee_id');
			$this->db->from('leave_benefits');
			$this->db->from('leave_details');
			$this->db->from('employee');
		    return $this->db->get()->num_rows();
		}

		function unapproved_performance(){
			$this->db->select('');
			$this->db->where('DATE_FORMAT(employee_performance.date,"%Y")',date('Y'));
			$this->db->where('employee_performance.hr_sign_date',NULL);
			$this->db->where('employee.employee_id=employee_performance.employee_id');
			$this->db->where('professional.id=employee.profession_id');
			$this->db->where('depertment.department_id=employee.department_id');
			$this->db->from('employee');
			$this->db->from('depertment');
			$this->db->from('professional');
			$this->db->from('employee_performance');

			return $this->db->get()->num_rows();
		}

		function unapproved_dependent(){
			$this->db->select('');
			$this->db->where('hr_dept_update','0000-00-00');
			$this->db->from('employee');
			return $this->db->get()->num_rows();
		}

		function unapproved_emergency_leave(){
			$this->db->select('emergency_leaves.employee_id,employee.department_id');
			$this->db->where('employee.employee_id = emergency_leaves.employee_id');
			$this->db->where('employee.department_id',$this->session->userdata('department_id'));
			$this->db->where("emergency_leaves.hd_signature",false);
			$this->db->from('employee');
			$this->db->from('emergency_leaves');
			return $this->db->get()->num_rows();
		}

		function hr_unapproved_emergency(){
			$this->db->select('');
			$this->db->where("emergency_leaves.hd_signature",true);
			$this->db->where("emergency_leaves.hr_signature",false);
			$this->db->where('DATE_FORMAT(emergency_leaves.date,"%Y")',date('Y'));
			$this->db->from('emergency_leaves');
			return $this->db->get()->num_rows();
		}
	}


?>