<?php 

class Login_Model extends CI_Model{

	public function login_credentials($user_Data){
		$this->db->select('*');
		$this->db->where($user_Data);
		$result = $this->db->get('users');

		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$data = array('employee_id' => $row->employee_id,
								'system_roles_id' => $row->user_group_id,
								'user_id' => $row->user_id
							);
			}
			return $data;
		}else{
			return "failed";
		}
	}

	public function get_Employee_Details($employee_id){

		$this->db->select('')->from('employee');
		$this->db->where('employee_id',$employee_id);
		$this->db->join('professional','professional.id=employee.profession_id');
		$response = $this->db->get();

		if($response->num_rows() > 0){
			foreach($response->result() as $row){
				$employee_details = array('names' => $row->names,
							'position' => $row->position,
							'department_id' => $row->department_id,
							'profession' => $row->professional_name,
							'gender' => $row->gender,
							'status' => $row->status
							);
			}
			return $employee_details;
		}else{
			return "failed";
		}
	}

	public function get_department_Details($dept_Id){

		$this->db->select('*');
		$this->db->where('department_id',$dept_Id);
		$response = $this->db->get('depertment');

		if($response->num_rows() > 0){
			foreach($response->result() as $row){
				$dept_Details = array(
					'dept_Name' => $row->department_name
				);
			}
			return $dept_Details;
		}else{
			return "failed";
		}
	}
	
	function allowed_items($priv_id, $employee_id) {
       $this->db->select('modules.module_id,modules.root_path,modules.label,modules.icon_name,modules.notification,modules.parent_id,is_menu,modules.name');
        $this->db->from('modules');
        $this->db->from('privilege');
        $this->db->where("(privilege.privilege_id= '$priv_id' OR privilege.privilege_id= '$employee_id')");
        $this->db->where('privilege.module_id = modules.module_id');
        $this->db->where('modules.is_menu',1);
        return $this->db->get();
    }

    function getallowedsubmenus($privelege_id,$employee_id,$parent_id){
    	$this->db->select('modules.module_id,modules.root_path,modules.label,modules.icon_name,modules.notification,modules.parent_id,is_menu,modules.name');
    	$this->db->from('modules');
    	$this->db->from('privilege');
    	$this->db->where('modules.is_menu',0);
    	$this->db->where("(privilege.privilege_id= '$privelege_id' OR privilege.privilege_id= '$employee_id')");
    	$this->db->where('modules.parent_id',$parent_id);
    	$this->db->where('privilege.module_id = modules.module_id');
    	return $this->db->get()->result();
    }

    function is_submenu_in_this_menu($module_name,$main_menu_id){
    	$this->db->select('');
    	$this->db->from('modules');
    	$this->db->where('name',$module_name);
    	$this->db->where('parent_id',$main_menu_id);
    	$rows = $this->db->get();
    	if($rows->num_rows()>0){
    		return true;
    	}else{
    		return false;
    	}
    }

    function security_method($priv_id, $employee_id){
       $this->db->select('modules.module_id,modules.root_path,modules.label,modules.icon_name,modules.notification,modules.parent_id,is_menu,modules.name');
        $this->db->from('modules');
        $this->db->from('privilege');
        $this->db->where("(privilege.privilege_id= '$priv_id' OR privilege.privilege_id= '$employee_id')");
        $this->db->where('privilege.module_id = modules.module_id');
        return $this->db->get();
    }

    function check_password_existance($employee_id,$current_password){
    	$this->db->select('');
    	$this->db->where('employee_id',$employee_id);
    	$this->db->where('password',$current_password);
    	$result = $this->db->get('users');
    	if($result->num_rows()>=1){
    		return true;
    	}else{
    		return false;
    	}
    }

    function change_password($employee_id,$data){
    	$this->db->select('');
    	$this->db->where('employee_id',$employee_id);
    	return $this->db->update('users',$data);
    }

}


?>