<?php

class Admin_Dashboard_Model extends CI_Model{

	function get_privileges() {
        $this->db->select('');
        $this->db->from('user_group');
        return $this->db->get()->result();
    }

    function user_inf($usr_id) {
        $this->db->select('*');
        $this->db->from('user_group');
        $this->db->where('user_group_id', $usr_id);

        return $this->db->get();
    }

    function user_settings($usr_id) {
        $this->db->select('modules.module_id,modules.label,modules.description');
        $this->db->from('modules');
        $this->db->from('privilege');
        $this->db->where('modules.module_id = privilege.module_id');
        $this->db->where('privilege.privilege_id', $usr_id);

        return $this->db->get();
    }

    function list_unassigned_privileges($usr_id, $list_assigned) {
        $this->db->select('modules.module_id,modules.label,modules.description');
        $this->db->from('modules');
        $this->db->where_not_in('modules.module_id', $list_assigned);

        return $this->db->get();
    }

    function assign_menu($add_menu) {
        $this->db->insert('privilege', $add_menu);
    }

    function module_detls($mdid) {
        $this->db->select();
        $this->db->from('modules');
        $this->db->where('module_id', $mdid);

        return $this->db->get();
    }

    function remov_user_priv($usr_id, $m_id) {
        $this->db->where('privilege_id', $usr_id);
        $this->db->where('module_id', $m_id);
        $this->db->delete('privilege');
    }

    function delete_user($employee_id){
        $this->db->where('employee_id',$employee_id);
        return $this->db->delete('users');
    }


    function get_employees() {
        $this->db->select('employee.employee_id,employee.names,employee.position,employee.profession_id,
		 employee.gender,users.user_name,user_group.group_name,
		 depertment.department_name,user_group.user_group_id,professional.professional_name');
        $this->db->from('user_group');
        $this->db->from('employee');
        $this->db->from('depertment');
        $this->db->from('users');
        $this->db->from('professional');
		$this->db->where('user_group.user_group_id = users.user_group_id');
		$this->db->where('user_group.user_group_id = users.user_group_id');
		$this->db->where('employee.employee_id = users.employee_id');
		$this->db->where('depertment.department_id = employee.department_id');
        $this->db->where('professional.id = employee.profession_id');
        return $this->db->get()->result();
    }

    function user_settings_all($usr_id, $priv) {
        $this->db->select('modules.module_id,modules.label,modules.description');
        $this->db->from('modules');
        $this->db->from('privilege');
        $this->db->where('modules.module_id = privilege.module_id');
        $this->db->where("(privilege.privilege_id ='$usr_id' OR privilege.privilege_id ='$priv')");

        return $this->db->get();
    }

    public function get_group_id($new_group_name){
        $this->db->select('');
        $this->db->where('group_name',$new_group_name);

        return $this->db->get('user_group')->row();
    }

    public function change_user_group($employee_id,$new_group_id){

        $data = array(
            'user_group_id' => $new_group_id
        );
        $this->db->select('');
        $this->db->where('employee_id',$employee_id);
        return $this->db->update('users',$data);
    }

    public function create_new_user_group($data){

        return $this->db->insert('user_group',$data);
    }

    public function delete_user_group($group_id){
        $this->db->select('');
        $this->db->where('user_group_id',$group_id);
        return $this->db->delete('user_group');
    }

    //delete user 


    public function get_professional(){
        $this->db->select('')->from('professional')->order_by('professional_name','ASC');
        return $this->db->get()->result();
    }

    public function get_professional_id($name){
        $this->db->select('')->from('professional');
        $this->db->where('professional_name',$name);
        return $this->db->get()->row();
    }
    public function get_department_name($dept_name){
        $this->db->select('*')->from('depertment');
        $this->db->where('department_name',$dept_name);
        return $this->db->get()->row();
    }

    public function add_new_employee($data){
        return $this->db->insert('employee',$data);
    }

    public function get_current_department_name($names){
        $this->db->select('depertment.department_name');
        $this->db->from('employee');
        $this->db->from('depertment');
        $this->db->where('employee.names',$names);
        $this->db->where('depertment.department_id = employee.department_id');
        return $this->db->get()->row();
    }

    public function get_dept_employee_id($names,$department_name){
        $this->db->select('employee.employee_id,depertment.department_id');
        $this->db->from('employee');
        $this->db->from('depertment');
        $this->db->where('employee.names',$names);
        $this->db->where('depertment.department_name',$department_name);
        return $this->db->get()->row();
    }

    public function transfer_employee($employee_id,$data){
        $this->db->select('');
        $this->db->where('employee_id',$employee_id);
        return $this->db->update('employee',$data);
    }

    public function getEmployeeInfo($fullname){
        $this->db->select('employee.employee_id,employee.names,employee.position,employee.gender,employee.phone_number,employee.status,employee.dob,depertment.department_name,professional.professional_name,employee.dept1,employee.dept1_relation,employee.dept1_dob,employee.dept2,employee.dept2_relation,employee.dept2_dob,employee.dept3,employee.dept3_relation,employee.dept3_dob,employee.dept4,employee.dept4_relation,employee.dept4_dob,employee.dept5,employee.dept5_relation,employee.dept5_dob,employee.dept6,employee.dept6_relation,employee.dept6_dob,employee.hiring_date,employee.hr_dept_update ');
        $this->db->from('employee');
        $this->db->from('professional');
        $this->db->from('depertment');
        $this->db->where('employee.names',$fullname);
        $this->db->where('depertment.department_id = employee.department_id');
        $this->db->where('professional.id = employee.profession_id');
        return $this->db->get()->row();
    }

    public function update_employee_information($employee_id,$data){
        $this->db->select('');
        $this->db->where('employee_id',$employee_id);
        return $this->db->update('employee',$data);
    }

    function get_leave_details($employee_id){
        $this->db->select('leave_id,days_left'); 
        $this->db->where('employee_id',$employee_id);
        $this->db->where('DATE_FORMAT(start_date,"%Y")',date('Y'));
        return $this->db->get('leave_details')->row();
    }

    function getUnapprovedAnnualLeaves() {
        $this->db->select('leave_benefits.benefit_id, employee.names, depertment.department_name, leave_benefits.dept_head_sign, leave_benefits.hr_sign, leave_benefits.accoutant_sign');
        $this->db->where('leave_details.leave_id = leave_benefits.leave_id');
        $this->db->where('employee.employee_id = leave_details.employee_id');
        $this->db->where('depertment.department_id = employee.department_id');
        $this->db->from('leave_benefits');
        $this->db->from('leave_details');
        $this->db->from('employee');
        $this->db->from('depertment');
        $this->db->group_start();
        $this->db->or_where('leave_benefits.dept_head_sign', false);
        $this->db->or_where('leave_benefits.hr_sign', false);
        $this->db->or_where('leave_benefits.accoutant_sign', false);
        $this->db->group_end();
        return $this->db->get()->result();
    }

    function getEmployeeAnnualLeaveInfo($benefit_id){
        $this->db->select('leave_benefits.benefit_id,leave_benefits.leave_id,leave_benefits.request_date,leave_benefits.days_off,leave_benefits.start_date,leave_benefits.end_date,leave_benefits.mkoa,leave_benefits.wilaya,leave_benefits.kata,leave_benefits.mtegemezi_1,leave_benefits.mtegemezi_2,leave_benefits.mtegemezi_3,leave_benefits.mtegemezi_4,leave_benefits.mtegemezi_5,leave_benefits.dept_sign_date,leave_benefits.dept_head_sign,,leave_benefits.hr_sign_date,leave_benefits.hr_sign,leave_benefits.accoutant_sign,leave_benefits.hr_comment,employee.names,depertment.department_name,depertment.department_id,employee.phone_number,professional.professional_name,leave_benefits.amount,leave_benefits.nauli_kiasi,leave_benefits.nauli_count,leave_benefits.chakula_kiasi,leave_benefits.chakula_count,leave_benefits.maradhi_kiasi,leave_benefits.maradhi_count,leave_benefits.dept_head_id,leave_benefits.hr_id');
        $this->db->where('leave_benefits.benefit_id',$benefit_id);
        $this->db->where('leave_details.leave_id = leave_benefits.leave_id');
        $this->db->where('employee.employee_id = leave_details.employee_id');
        $this->db->where('professional.id = employee.profession_id');
        $this->db->where('depertment.department_id = employee.department_id');
        $this->db->from('leave_benefits');
        $this->db->from('leave_details');
        $this->db->from('employee');
        $this->db->from('professional');
        $this->db->from('depertment');
        return $this->db->get()->row();
    }

    function getDepartmentHeadinfo($employee_id){
        $this->db->select('')->from('employee');
        $this->db->where('employee_id',$employee_id);
        return $this->db->get()->row();
    }

    function change_user_password($employee_id, $password,$username){
        $this->db->where('employee_id', $employee_id);
        $this->db->set('password', $password);
        $this->db->set('user_name',$username);
        return $this->db->update('users'); 
    }

    //function to save users logs
     function save_logs($data){
        $this->db->insert('audit_trial',$data);
     }

     function get_monthly_roster_shifts(){
       return $this->db->select('*')->from('shifts_names')->get()->result();
     }

     function delete_shift($shift_id){
        $this->db->where('id',$shift_id);
        return $this->db->delete('shifts_names');
     }

     function get_shift_information($shift_id){
        return $this->db->select('*')->from('shifts_names')->where('id',$shift_id)->get()->row();
     }

     function update_shift_info($shift_id,$data){
        $this->db->select('*');
        $this->db->where('id',$shift_id);
        return $this->db->update('shifts_names',$data);
     }

     function insert_new_shift($data){
        return $this->db->insert('shifts_names',$data);
     }

     function getUsername($user_id){
        return $this->db->select('*')->from('users')->where('employee_id',$user_id)->get()->row();
     }
}



?>