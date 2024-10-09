<?php 

 class Auth extends CI_Controller{

 	public function __construct(){
			parent::__construct();
			$this->load->model('Registration_Model','get');
			$this->load->model('Login_Model','login');
		}

 	public function index(){
 		$this->load->view('login_page');
 	}

 	public function registration(){
	 	$this->load->view('registration_page'); //entering into this page took me 2days due to caps error
	 }


	 	 public function user_AutoSuggestion_List(){

	 	$data = $this->input->get('query'); 
	 	$names = $this->get->get_Auto_Suggestion_Users($data);

	 	$data = array();
	 	foreach($names as $name){
	 		$data[]= $name->names;
	 	}
	 	echo json_encode($data);
	 }

	 //creating new user

	 public function creating_New_User_Account(){

	 	$this->form_validation->set_rules('full_name','Full Name','trim|required',array('required' => 'The employee full name field cannot be left empty'));
	 	$this->form_validation->set_rules('username','User Name','trim|required',array('required' => 'username field cannot be left empty'));
	 	$this->form_validation->set_rules('password','Password','trim|required|min_length[8]|md5',array('required' => 'This field cannot be left empty'));
	 	$this->form_validation->set_rules('re_password','Confirm Password','trim|required|matches[password]|md5',array('required' => 'This field cannot be left empty '));

	 	if($this->form_validation->run() == FALSE){
	 		$this->load->view('registration_page');
	 	}else{

	 		$returned_result = $this->get->is_FullName_Found($this->input->post('full_name'));
		 	if($returned_result != "none"){
		 		if($this->get->is_User_And_Username_Found(element('employee_id',$returned_result),$this->input->post('username'))){
		 			$this->session->set_flashdata('message','<div class="alert alert-danger text-center">Oops! Error. Your account exist !!!</div>');
		 			redirect('auth/registration');
		 		}else{
		 			$system_role = element('employee_role',$returned_result);
		 			if($system_role == "USER"){
		 				$system_role = "8";
		 			}else{
		 				$system_role = "7";
		 			}
		 				$data = array(
		 					'employee_id' => element('employee_id',$returned_result),
					 		'user_name' => $this->input->post('username'),
					 		'password' => $this->input->post('password'),
					 		'user_group_id' => $system_role
					 		);

		 				if($this->get->create_User_Account($data)){
		 					$this->session->set_flashdata('message','<div class="alert alert-success text-center">You are Successfully Registered!!!. <a href="index" class="text-primary">login</a></div>');
		 					redirect('auth/registration');
		 				}else{
		 					$this->session->set_flashdata('message','<div class="alert alert-danger text-center">Oops! Error.  we have database problems please contact our awesome system administrator !!!</div>');
		 					redirect('auth/registration');
		 				}
		 			}
		 	}else{
		 		$this->session->set_flashdata('message','<div class="alert alert-danger text-center">Ooops! You are not in our current employee list please contact our awesome system administrator !!!</div>');
		 			redirect('auth/registration');
		 		}
		 	}
	 	}

	 	public function user_Login(){
	 		//capture the user input and verify them
	 		$this->form_validation->set_rules('username','username','trim|required',array('required' => 'User Name field cannot be left empty'));
	 	$this->form_validation->set_rules('password','Password','trim|md5',array('required' => 'Password field cannot be left empty '));

	 		if($this->form_validation->run() == FALSE){
	 			$this->load->view('login_page');
	 		}else{
	 			
	 			$data = array('user_name' => $this->input->post('username'),
	 							'password' => $this->input->post('password')
	 						);
	 			$returned_result = $this->login->login_credentials($data);
	 			
	 			if($returned_result <> "failed"){
	 				$employee_details = $this->login->get_Employee_Details(element('employee_id',$returned_result)); 
	 				if($employee_details <> "failed" && element('status',$employee_details) <> "inactive"){
	 					//get dept name
	 				$department_details = $this->login->get_department_Details(element('department_id',$employee_details));

	 				if($department_details <> "failed"){
	 					//privilege details
						$allowed['allowed'] = $this->login->allowed_items(element('system_roles_id',$returned_result), element('employee_id',$returned_result))->result();
						$security['security'] = $this->login->security_method(element('system_roles_id',$returned_result), element('employee_id',$returned_result))->result();

						//here we will add the function to retrieve all menus and submenus for the purpose of preventing unathorized access of controllers 

	                    $this->session->set_userdata($allowed);
	                    $this->session->set_userdata($security);

	 					$user_details = array('full_name' => element('names',$employee_details),
	 											'profession' => element('profession',$employee_details),
	 											'gender' => element('gender',$employee_details),
	 											'position' => element('position',$employee_details),
	 											'user_Role' => element('system_roles_id',$returned_result),
	 											'user_id' => element('user_id',$returned_result),
	 											'department_name' => element('dept_Name',$department_details),
	 											'department_id' => element('department_id',$employee_details),
	 											'employee_id' => element('employee_id',$returned_result)
	 										);	
	 					//set session data then display home page
	 					$this->session->set_userdata($user_details);
	 					$this->session->set_userdata('last_activity', time()); //for automatically log-out
	 				}else{
	 				$this->session->set_flashdata('message','<div class="alert alert-danger text-center">Oops! Error. Some problem occured with our database please contact our Awesome Administrator !!!</div>');
	 				redirect('auth');
	 				}
	 			}else{
	 				$this->session->set_flashdata('message','<div class="alert alert-danger text-center">Oops! Error. Some problem occured with our database, maybe user is inactive, please contact our Awesome Administrator !!!</div>');
	 				redirect('auth');
	 			}
	 		
	 				redirect('profile_management');
	 			}else{
	 				$this->session->set_flashdata('message','<div class="alert alert-danger text-center">Oops! Error. Incorrect User Name or Password !!!.<a href="auth/registration" class="text-primary">create account </a></div>');
	 				redirect('auth');
	 			}
	 			
	 			
	 		}
	 	}

	 	public function logout(){
	 		$this->session->sess_destroy();
	 		redirect('auth');
	 	}
}


?>