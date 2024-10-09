<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class Admin_Dashboard extends CI_Controller{
 	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
            redirect('auth');
        }else{
             $this->session->set_userdata('last_activity', time()); // update the last activity time
			$this->load->model('Hd_Leave_Approval_Model','approval');
            $this->load->model('User_dashboard_Model','user');
			$this->load->model('Hr_Dashboard_Model','hr');
			$this->load->model('Admin_Dashboard_Model','admin');
            $this->load->model('Notification_Model','notify');
            $this->load->model('Attendance_Model','attendance');
		}
	}

	public function index(){
        $module_name = "admin_dashboard";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
    		$data['privileges'] = $this->admin->get_privileges();
    		$data['employee'] = $this->admin->get_employees();
            $data['professional'] = $this->admin->get_professional();
            $data['department'] = $this->hr->getDepartments();
            $module['module_name'] = $module_name;
            $this->load->view('head',$module);
    		$this->load->view('admin_dashboard',$data);
    		$this->load->view('footer');
        }
	}

	function edit_user_privileges() {
        $module_name = "admin_dashboard";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
		  $usr_id = $this->uri->segment(3);
        
            $data['user_info'] = $this->admin->user_inf($usr_id)->result();
            $data['setting'] = $this->admin->user_settings($usr_id)->result();
            $list_assign = $this->admin->user_settings($usr_id);
            $list_assigned = array(0);
            if ($list_assign->num_rows() > 0) {
                foreach ($list_assign->result() as $row) {
                    array_push($list_assigned, $row->module_id);
                }
            }
            $data['unassigned_priv'] = $this->admin->list_unassigned_privileges($usr_id, $list_assigned)->result();
            $module['module_name'] = $module_name;
            $this->load->view('head',$module);
    		$this->load->view('edit_user',$data);
    		$this->load->view('footer');
        }
    }

    function delete_user(){
        $employee_id = $this->uri->segment(3);
        if($this->admin->delete_user($employee_id)){
            redirect('admin_dashboard');
        }else{
            //
        }
    }

    function asssign_privileges()
    {
        $usr_id = $this->uri->segment(4);
        $add_menu = array(
            'privilege_id' => $this->uri->segment(4),
            'module_id' => $this->uri->segment(3),
        );
        $this->admin->assign_menu($add_menu);
        $modldetails = $this->admin->module_detls($this->uri->segment(3))->result();
        $userdetails = $this->admin->user_inf($usr_id)->result();

        $res = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Module assigned successful.</strong> User must Login again for changes to take effects. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        $this->session->set_flashdata('res', $res);
        redirect('admin_dashboard/edit_user_privileges/' . $usr_id);
    }

    function remove_privilege()
    {
        $usr_id = $this->uri->segment(4);
        $m_id = $this->uri->segment(3);

        $this->admin->remov_user_priv($usr_id, $m_id);

        $res = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Module Removed successful.</strong> User must Login again for changes to take effects. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        $this->session->set_flashdata('res', $res);
        redirect('admin_dashboard/edit_user_privileges/' . $usr_id);
    }

    function userUpdateForm()
    {
        $data = array(
            'setting' => $this->admin->user_settings($this->uri->segment(4))->result(),
            'user_id' => $this->uri->segment(3),
            'priv_id' => $this->uri->segment(4),
            'groups' => $this->admin->get_privileges()
        );
        $this->load->view('update_users_roles', $data);
    }

    function unassgnd_permissions(){
        $list_assign = $this->admin->user_settings_all($this->uri->segment(3), $this->uri->segment(4));
        $list_assigned = array();
        if ($list_assign->num_rows() > 0) {
            foreach ($list_assign->result() as $row) {
                array_push($list_assigned, $row->module_id);
            }
        }
        $unassigned_priv = $this->admin->list_unassigned_privileges($this->uri->segment(3), $list_assigned);
        if ($unassigned_priv->num_rows() > 0) {
            $sn = 0;
            echo '<table class="table table-bordered">
                            <tr>
                                <th>S/N</th>
                                <th>Module name</th>
                                <th>Descriptions</th>
                                <th>&nbsp;</th>
                            </tr>';
            foreach ($unassigned_priv->result() as $ass_priv) {
                $sn++;
                echo '<tr>';
                echo '<td>' . $sn . '</td>';
                echo '<td>' . $ass_priv->label . '</td>';
                echo '<td>' . $ass_priv->description . '</td>';
                echo "<td><center><a href=\"javascript:void()\" onclick=\"AssgnSpecialModule('" . $ass_priv->module_id . "')\" title=\"assign this Module\"><span class=\"bi bi-plus-circle\"></span></a></center></td>";
                echo '</tr>';
            }
            echo '</table';
        } else {
            echo 'No unassigned module.';
        }
    }

    function load_special_permissions(){
        $sps = $this->admin->user_settings($this->uri->segment(3));
        if ($sps->num_rows() > 0) {
            $sn = 0;
            echo '<table class="table table-bordered">
                            <tr>
                                <th>S/N</th>
                                <th>Module name</th>
                                <th>Descriptions</th>
                                <th>&nbsp;</th>
                            </tr>';
            foreach ($sps->result() as $sp) {
                $sn++;
                echo '<tr>';
                echo '<td>' . $sn . '</td>';
                echo '<td>' . $sp->label . '</td>';
                echo '<td>' . $sp->description . '</td>';
                echo "<td><center><a href=\"javascript:void()\" onclick=\"UnassgnSpecialModule('" . $sp->module_id . "')\" title=\"Unassign this Module\"><span class=\"bi bi-dash-circle\"></span></a></center></td>";
                echo '</tr>';
            }
            echo '</table';
        } else {
            echo 'No special permission assigned.';
        }
    }


    function add_special_permissions()
    {
        $add_menu = array(
            'privilege_id' => $this->input->post('user'),
            'module_id' => $this->input->post('modl'),
        );
        $this->admin->assign_menu($add_menu);
  
    }

    function remove_special_permissions()
    {
        $this->admin->remov_user_priv($this->input->post('user'), $this->input->post('modl'));

    }

    public function change_user_group(){
    	$employee_id = $this->input->post('employee_id');
    	$group_name = $this->input->post('selected_group');

    	//we need to get the group id selected
    	$group_id = $this->admin->get_group_id($group_name);

    	$new_group_id = $group_id->user_group_id;

    	//change user group
    	 if($this->admin->change_user_group($employee_id,$new_group_id)){
    	 	echo "true";
    	 }else{
    	 	echo "false";
    	 }
    }

    public function change_user_password(){
        $employee_id = $this->input->post('employee_id');
        $password = md5($this->input->post('password'));
        $username = $this->input->post('username');

        // echo $employee_id.' '.$password;

         if($this->admin->change_user_password($employee_id,$password,$username)){
            echo "true";
         }else{
            echo "false";
         }
    }

    public function new_user_group(){
    	$group_name = $this->input->post('group_name');
    	$description = $this->input->post('description');
    	if($group_name != "" && $description != ""){
    		$data = array(
    		'group_name' => $group_name,
    		'group_description' => $description
    	);

	    	if($this->admin->create_new_user_group($data)){
	    		//how to set alert from the controller 
	    		redirect('admin_dashboard' );
	    	}else{
	    		//stay on the same page 
	    	}

    	}else{
    		//do something else
    	}
    	
    }

    public function delete_user_group(){
    	$group_id = $this->uri->segment(3);

    	if($this->admin->delete_user_group($group_id)){
    		redirect('admin_dashboard' );
    	}else{
    		//do something else
    	}
    }

    public function create_new_employee(){
        $this->load->model('Registration_Model');
        $name_is_found = $this->Registration_Model->is_FullName_Found($this->input->post('names')); //if not present <none> will be returned
        if ($name_is_found == "none") {
            $proffesion_id = $this->admin->get_professional_id($this->input->post('Professional'));
            $department_id = $this->admin->get_department_name($this->input->post('Department'));
            $data = array('names' => $this->input->post('names'), 
                          'department_id' => $department_id->department_id,
                          'position' => $this->input->post('Position'),
                          'profession_id' => $proffesion_id->id,
                          'gender' => $this->input->post('gender'),
                          'phone_number' => $this->input->post('phone_number'),
                          'dob' => $this->input->post('dob'),
                          'hiring_date' => $this->input->post('hiring_date'),
                          'status' => "active"
                 );
            if($this->admin->add_new_employee($data)){
                echo "ok";
            }else{
                echo "failed"; //failed to insert data 
            }
        }else{
            echo "name_found";
        }
    }

    public function get_current_department(){
        $names = $this->input->post('full_name');
        $get_dept = $this->admin->get_current_department_name($names);
        if($get_dept){
            echo $get_dept->department_name;
        }else{
            echo "unknown";
        }
    }

    public function transfer_employee(){
        $names = $this->input->post('names');  //get employee id
        $department_name = $this->input->post('new_department'); //also get department
        $result = $this->admin->get_dept_employee_id($names,$department_name); 
        //echo .;
        if($result){
            $data = array("department_id" => $result->department_id);
            if($this->admin->transfer_employee($result->employee_id,$data)){
                echo "ok";
            }else{
                echo "insert_fail";
            }
        }else{
            echo "failed"; 
        }
    }
    public function deactivate_employee(){
        $names = $this->input->post('typed_names'); //get employee id
        $employee_id = $this->hr->getEmployeeId($names)->employee_id;
        $data = array("status" =>"inactive");
        if($employee_id){
            if($this->admin->transfer_employee($employee_id,$data)){
                echo "ok";
            }else{
                //
            }
        }else{
            //
        }
     }

     public function employee_info_form(){
        $data = array();
        $data['professional'] = $this->admin->get_professional();
        $data['department'] = $this->hr->getDepartments();
        $names = $this->input->post('names');
        $result = $this->admin->getEmployeeInfo($names); 
        if($result){
            $data['employeeInfo'] = $result;
        }else{

        }
        $this->load->view('employee_info_form',$data);
     }

    public function edit_employee_info(){
        $proffesion_id = $this->admin->get_professional_id($this->input->post('professional'));
        $department_id = $this->admin->get_department_name($this->input->post('Department'));
        $employee_id = $this->input->post('employee_id');

        $data = array(
            'employee_id' => $employee_id,
            'names' => $this->input->post('names'),
            'department_id' => $department_id->department_id,
            'position' => $this->input->post('Position'),
            'profession_id' => $proffesion_id->id,
            'gender' => $this->input->post('gender'),
            'phone_number' => $this->input->post('phone_number'),
            'status' => $this->input->post('status'),
            'dob' => $this->input->post('dob'),
            'hiring_date' => $this->input->post('hiring_date')
        );

        if($this->admin->update_employee_information($employee_id,$data)){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> Congratulation employee information updated successful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry failed to update employee information contact our awesome programmer for more information<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }


    function get_employee_annual_leave_form(){
        $data = array();
        $names = $this->input->post('names');
        $info = $this->admin->getEmployeeInfo($names);
        if($info){
            $leave_details = $this->admin->get_leave_details($info->employee_id);
            if($leave_details){
                if($leave_details->days_left > 0){
                    $data['info'] = $info;
                    $data['leave_details'] = $leave_details;
                    $this->load->view('admin/annual_leave_form',$data); 
                }else{
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"> No annual leaves days left for this employee <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> ';
                }
            }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"> Employee annual leave was not scheduled by his/her head of department <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> ';
            }
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"> Please select names from the ones autosuggested by putting the initial letters <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> ';
        }
        
    }

    function get_region_districts(){
        $region_id = $this->input->post('region_id');
        $districts = $this->user->get_district_autosuggestion($region_id);
        if($districts){
            echo "<option>Select district</option>";
            foreach($districts as $row){
                echo "<option value=".$row->id.">".$row->district_name."</option>";
            }

        }else{
            echo "<option>Unknown</option>";
        }
    }

    function get_district_wards(){
        $district_id = $this->input->post('district_id');
        $wards = $this->user->get_wards_autosuggestion($district_id);

        if($wards){
            echo "<option>Select ward</option>";
            foreach($wards as $row){
                echo "<option value=".$row->id.">".$row->ward_name."</option>";
            }

        }else{
            echo "<option>Unknown</option>";
        }
    }

    function create_employee_annual_leave(){
        $phone_number = $this->input->post('phone_number');
        $employee_id = $this->input->post('employee_id');
        $nauli_kiasi = $this->input->post('nauli');
        $nauli_count = $this->input->post('nauli_times');
        $chakula_kiasi = $this->input->post('chakula');
        $chakula_count = $this->input->post('chakula_times');
        $maradhi_kiasi = $this->input->post('maradhi');
        $maradhi_count = $this->input->post('maradhi_times');
        $data = array(
        'leave_id' => $this->input->post('leave_id'),
        'request_date' => $this->input->post('today'),
        'days_off' => $this->input->post('days'),
        'start_date' => $this->input->post('start_date'),
        'end_date' => $this->input->post('end_date'),
        'mkoa' => $this->input->post('region'),
        'wilaya' => $this->input->post('district'),
        'kata' => $this->input->post('ward'),
        'amount' => $this->input->post('amount'),
        'mtegemezi_1' => $this->input->post('mtegemezi1'),
        'mtegemezi_2' => $this->input->post('mtegemezi2'),
        'mtegemezi_3' => $this->input->post('mtegemezi3'),
        'mtegemezi_4' => $this->input->post('mtegemezi4'),
        'mtegemezi_5' => $this->input->post('mtegemezi5'),
        'nauli_kiasi' => $nauli_kiasi,
        'nauli_count' => $nauli_count,
        'chakula_kiasi' => $chakula_kiasi,
        'chakula_count' => $chakula_count,
        'maradhi_kiasi' => $maradhi_kiasi,
        'maradhi_count' => $maradhi_count
        );
        //in here we tested db rollback and complete, but failed
        $create_leave_data = $this->user->create_employee_leave($employee_id,$phone_number,$data);

        if($create_leave_data){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congratulation!! </strong>leave created successful, now  tell the employee to visit his/her <strong>Head of department</strong> for signature <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry!! We have database problem. Please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }

    }

    function employee_annual_leave_details(){
        $benefit_id = $this->input->post('benefit_id');

        $leave_info = $this->admin->getEmployeeAnnualLeaveInfo($benefit_id);
        $data['leave_info'] = $leave_info;
        if($leave_info){
            $this->load->view('admin/detailed_employee_leave_form',$data);
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Failed to retrieve employee information, please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }

    public function update_employee_leave(){

        $benefit_id = $this->input->post('benefit_id');
        $employee_names = $this->input->post('names');
        $nauli_kiasi = $this->input->post('nauli');
        $nauli_count = $this->input->post('nauli_times');
        $chakula_kiasi = $this->input->post('chakula');
        $chakula_count = $this->input->post('chakula_times');
        $maradhi_kiasi = $this->input->post('maradhi');
        $maradhi_count = $this->input->post('maradhi_times');

        $hr_update_data = array(
            'days_off' => $this->input->post('days'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'mkoa' => $this->input->post('region'),
            'wilaya' => $this->input->post('district'),
            'kata' => $this->input->post('ward'),
            'amount' => $this->input->post('amount'),
            'mtegemezi_1' => $this->input->post('mtegemezi1'),
            'mtegemezi_2' => $this->input->post('mtegemezi2'),
            'mtegemezi_3' => $this->input->post('mtegemezi3'),
            'mtegemezi_4' => $this->input->post('mtegemezi4'),
            'mtegemezi_5' => $this->input->post('mtegemezi5'),
            'nauli_kiasi' => $nauli_kiasi,
            'nauli_count' => $nauli_count,
            'chakula_kiasi' => $chakula_kiasi,
            'chakula_count' => $chakula_count,
            'maradhi_kiasi' => $maradhi_kiasi,
            'maradhi_count' => $maradhi_count
        );
        $result = $this->hr->hr_update_leave_model($benefit_id,$hr_update_data);

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Leave details for <b>'.$employee_names.'</b> updated successful.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Leave details for <span>'.$employee_names.'</span> Failed to be updated. Please contact our awesome administrator for more information. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

        }
    }

    function delete_employee_leave(){
        $benefit_id = $this->input->post("benefit_id");
        $response = "";
        if($this->hr->reject_employee_request($benefit_id)){
            $response ='<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Employee annual leave record deleted successful<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

        }else{
            $response = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!.. Failed to delete employee annual leave record, please contact our awesome administrator on what must be the reason for failure.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

        }
        $message['sms'] = $response;
        $this->load->view('admin/track_unapprove_leave',$message);
    }

    function transfer_employee_leave_records(){
        $benefit_id = $this->input->post('benefit_id');
        $destination = $this->input->post('destination');
        $sms = "";

        $leave_info = $this->admin->getEmployeeAnnualLeaveInfo($benefit_id);
        if($leave_info->dept_head_sign == false){
            if($destination == "Accountant"){
               if($leave_info->amount > 0){
                $data = array('dept_head_sign' => true,
                            'dept_sign_date' => date('Y-m-d'),
                            'dept_head_id' => $this->session->userdata('employee_id'),
                            'hr_sign' => true,
                            'hr_sign_date' => date('Y-m-d'),
                            'hr_id' => $this->session->userdata('employee_id')
                );
                if($this->hr->hr_update_leave_model($benefit_id,$data)){
                    $message['sms'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, employee leave records transferred safely to HR office, now tell employee to visit hr office for more approval.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }else{
                    $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!.. there was a problem completing the task please contact our awesome administrator for more information.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
               }else{
                $data = array('dept_head_sign' => true,
                                'dept_head_id' => $this->session->userdata('employee_id'),
                            'dept_sign_date' => date('Y-m-d'),
                            'hr_sign' => true,
                            'hr_id' => $this->session->userdata('employee_id'),
                            'hr_sign_date' => date('Y-m-d'),
                            'accoutant_sign' => true,
                            'accountant_id' => $this->session->userdata('employee_id'),
                            'accoutant_sign_date' => date('Y-m-d')
                );
                if($this->hr->hr_update_leave_model($benefit_id,$data)){
                    $message['sms'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, employee leave records transferred safely and since our employee has no leave benefit his/her leave records stored and the leave verification completed successful. Now congratulate our employee and wish him/her a joyful, serene & adventerous leave on behalf of FAME MEDICAL HOSPITAL.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }else{
                    $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!.. there was a problem completing the task please contact our awesome administrator for more information.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
               }
            }else if($destination == "Human Resource"){
                $data = array('dept_head_sign' => true,
                                'dept_head_id' => $this->session->userdata('employee_id'),
                            'dept_sign_date' => date('Y-m-d')
                );
                if($this->hr->hr_update_leave_model($benefit_id,$data)){
                    $message['sms'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, employee leave records transferred safely to HR office, now tell employee to visit hr office for more approval.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }else{
                    $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!.. there was a problem completing the task please contact our awesome administrator for more information.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            }else{
                $data = array('dept_head_sign' => true,
                                'dept_head_id' => $this->session->userdata('employee_id'),
                            'dept_sign_date' => date('Y-m-d'),
                            'hr_sign' => true,
                            'hr_id' => $this->session->userdata('employee_id'),
                            'hr_sign_date' => date('Y-m-d'),
                            'accoutant_sign' => true,
                            'accountant_id' => $this->session->userdata('employee_id'),
                            'accoutant_sign_date' => date('Y-m-d')
                );
                if($this->hr->hr_update_leave_model($benefit_id,$data)){
                    $message['sms'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, Employee leave approved successful.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }else{
                    $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!.. there was a problem completing the task please contact our awesome administrator for more information.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            }
        }else if($leave_info->hr_sign == false){
            if($destination == "Accountant"){
                if ($leave_info->amount > 0) {
                $data = array('hr_sign' => true,
                            'hr_id' => $this->session->userdata('employee_id'),
                            'hr_sign_date' => date('Y-m-d')
                );
                if($this->hr->hr_update_leave_model($benefit_id,$data)){
                    $message['sms'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, employee leave records transferred safely to Accountant office, now tell employee to visit Accountant office for more approval.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }else{
                    $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!.. there was a problem completing the task please contact our awesome administrator for more information.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                }else{
                $data = array( 'hr_sign' => true,
                            'hr_sign_date' => date('Y-m-d'),
                            'hr_id' => $this->session->userdata('employee_id'),
                            'accoutant_sign' => true,
                            'accountant_id' => $this->session->userdata('employee_id'),
                            'accoutant_sign_date' => date('Y-m-d')
                );
                if($this->hr->hr_update_leave_model($benefit_id,$data)){
                    $message['sms'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, employee leave records transferred safely and since our employee has no leave benefit his/her leave records stored and the leave verification completed successful. Now congratulate our employee and wish him/her a joyful, serene & adventerous leave on behalf of FAME MEDICAL HOSPITAL.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }else{
                    $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!.. there was a problem completing the task please contact our awesome administrator for more information.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                }
            }else{
                $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry employee leave record is already on hr office.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }else{
            if ($leave_info->amount <= 0) {
                $data = array('accoutant_sign' => true,
                            'accountant_id' => $this->session->userdata('employee_id'),
                            'accoutant_sign_date' => date('Y-m-d')
                );
                if($this->hr->hr_update_leave_model($benefit_id,$data)){
                    $message['sms'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, Employee leave approved successfully. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }else{
                    $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry!!.. there was a problem completing the task please contact our awesome administrator for more information.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                }else{
                
                $message['sms'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Action can not be completed, since employee has leave benefits he/she needs to visit accountant office physically.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }

        }

        $this->load->view('admin/track_unapprove_leave',$message);
    }

    function edit_shift_info(){
        $shift_id['shift_id'] = $this->uri->segment(3);

        $module_name = "admin_dashboard";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
            $module['module_name'] = $module_name;
            $this->load->view('head',$module);
            $this->load->view('monthly_roaster/edit_shift_information',$shift_id);
            $this->load->view('footer');
        }
    }

    function update_shift_info(){
        $shift_id = $this->input->post('shift_id');
         $module_name = "admin_dashboard";
        $module['module_name'] = $module_name;

        $data = array(
            'color' => $this->input->post('box_color'),
            'department_ids' => implode(',',$this->input->post('department_check')),
            'text_color' => $this->input->post('text_color'),
            'work_period' => $this->input->post('Work_period')
        );

        if($this->admin->update_shift_info($shift_id,$data)){
            $this->session->set_flashdata('shift_update','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, Shift info changed successful. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }else{
            $this->session->set_flashdata('shift_update','<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Sorry, Shift info failed to be updated. Please contact our awesome administrator for more information. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        }
        $shift_id_value['shift_id'] = $shift_id;
        $this->load->view('head',$module);
        $this->load->view('monthly_roaster/edit_shift_information',$shift_id_value);
        $this->load->view('footer');
    }

    function create_new_duty_shift(){
        $module_name = "admin_dashboard";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
            $module['module_name'] = $module_name;
            $this->load->view('head',$module);
            $this->load->view('monthly_roaster/create_new_shift');
            $this->load->view('footer');
        }
    }

    function insert_new_shift_info(){
        $data = array(
            'name' => $this->input->post('shift_name'),
            'abbreviation' => $this->input->post('Abbreviation'),
            'color' => $this->input->post('box_color'),
            'department_ids' => implode(',',$this->input->post('department_check')),
            'text_color' => $this->input->post('text_color'),
            'work_period' => $this->input->post('Work_period')
        );

        if($this->admin->insert_new_shift($data)){

        $this->session->set_flashdata('new_shift_response','<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, New shift created successful. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }else{
            $this->session->set_flashdata('new_shift_response','<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Sorry, Unable to create new shift. Please contact our awesome administrator for more information. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        }
        $this->create_new_duty_shift();
    }

    function delete_shift(){
        $shift_id = $this->input->post('shift_id');

        if($this->admin->delete_shift($shift_id)){
            $sms = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Congratulation, shift Deleted successful. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else{
            $sms = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Sorry, Unable to delete new shift. Please contact our awesome administrator for more information. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

        }

        $message['sms'] = $sms;
        $this->load->view('Monthly_Roaster/add_attribute',$message);
    }

}