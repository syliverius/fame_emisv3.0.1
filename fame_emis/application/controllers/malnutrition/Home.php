<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}
		$this->load->model('malnutrition/patient_registration_model','register');
		}
		public function index(){
			$module_name = "malnutrition_home";
			if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
				$data['values'] = $this->all_Viewed_Patients();
				$module['module_name'] = $module_name;
				$this->load->view('head',$module);
				$this->load->view('malnutrition/patient_registration',$data);
				$this->load->view('footer');
			}
		}

			public function register_new_patient(){
			$names = $this->input->post('names');
			$file_number = $this->input->post('file_number');
			$address = $this->input->post('address');
			$best_contact = $this->input->post('best_contact');
			$phone_number = $this->input->post('phone_number');
			$sex = $this->input->post('sex');
			$dob = $this->input->post('dob');
			$comments = $this->input->post('comments');

			 $patient_info = array(
			 	'names' => $names,
			 	'file_number' => $file_number,
			 	'address' => $address,
			 	'best_contact' => $best_contact,
			 	'phone' => $phone_number,
			 	'gender' => $sex,
			 	'dob' => $dob,
			 	'comments' => $comments
			 );

			 //insert data into the database
			 
			 if($this->register->new_patient($patient_info)){
			 	echo "ok";
			 }else{
			 	echo "database_error";
			 }
		}

		public function patient_Names_AutoSuggestion(){
			$data = $this->input->get('query'); 
		 	$names = $this->register->get_Auto_Suggestion_Employee($data);

		 	$data = array();
		 	foreach($names as $name){
		 		$data[]= $name->names;
		 	}
		 	echo json_encode($data);
		}

		public function present_patient(){
			$names = $this->input->post('patient_names');

			//retrieve data from the modal
			$data = $this->register->get_Patient_Info($names);

			if($data){
				$date1 = new DateTime($data->dob);
				$date2 = new DateTime();
				$diff = date_diff($date2, $date1);
				$years = $diff->y;
				$months = $diff->m;
					echo "
					<tr>
						<td scope='col' class='col-sm-2'>$data->names</td>
						<td scope='col'>$data->file_number</td>
						<td scope='col'>$data->address</td>
						<td scope='col'>$data->best_contact</td>
						<td scope='col'>$data->phone</td>
						<td scope='col'>$data->gender</td>
						<td scope='col'>$data->dob</td>
						<td scope='col'>$years</td>
						<td scope='col'>$data->comments</td>
						<td scope='col'>
						<button type='button' class='btn btn-primary create_visit_btn' data-id='$data->patient_id'>New</button>
						<button type='button' class='btn btn-secondary view_visit' data-id='$data->patient_id'>Previous</button>
						</td>
					</tr>
					";
				
			}else{
				echo "database_error";
			}
		}

		public function get_patient_info(){
			$patient_id = $this->input->post("ids");
			$data = $this->register->get_patient_information($patient_id); //im considering creating new method
			$dob = $data->dob;
			
			$date1 = new DateTime($dob);
			$date2 = new DateTime();
			$diff = date_diff($date2, $date1);
			$years = $diff->y;
			$months = $diff->m;
			$days = $diff->d;

			if($data){
				//set model body data
				echo"
				<div class='row g-3'>
					<h5>Name: <span>$data->names</span>&nbsp&nbsp&nbsp<span>Age is $years years $months months $days days</span>&nbsp&nbsp&nbspGender:<span>$data->gender</span>&nbsp&nbsp&nbsp</h5>

										 <input type='text' class='form-control' name='patient_id' value='$data->patient_id' hidden>
										<div class='col-sm-6'>
                      <label for='lenght'>Length</label>
                      <input type='text' class='form-control' name='lenght'>
                    </div>
                    <div class='col-sm-6'>
                      <label for='weight'>Weight</label>
                      <input type='text' class='form-control' name='weight'>
                    </div><div class='col-md-6'>
                      <label for='z_score'>Z-Score</label>
                      <input type='text' class='form-control' name='z_score'>
                    </div>
                    <div class='col-md-6'>
                      <label for='muac'>MUAC</label>
                      <input type='text' class='form-control' name='muac'>
                    </div>
                    <div class='col-md-6'>
                      <label for='cormobidity'>Cormobidity</label>
                      <input type='text' class='form-control' name='cormobidity'>
                    </div>
                    <div class='col-md-6'>
                      <label for='oedema'>OEDEMA</label>
                      <input type='text' class='form-control' name='oedema'>
                    </div>
                    <div class='col-md-6'>
                      <label for='nam_sam'>MAM-SAM</label>
                      <input type='text' class='form-control' name='nam_sam'>
                    </div>
                    <div class='col-md-6'>
                      <label for='admission_date'>Admission Date</label>
                      <input type='date' class='form-control' name='admission_date'>
                    </div>
                    <div class='col-md-6'>
                      <label for='discharge_date'>Discharge Date</label>
                      <input type='date' class='form-control' name='discharge_date'>
                    </div>
                    <div class='col-md-6'>
                      <label for='next_visit'>Next Visit Date</label>
                      <input type='date' class='form-control' name='next_visit'>
                    </div>
                    <div class='col-md-6'>
                      <label for='comments'>Comments If Any</label>
                      <textarea class='form-control' id='comments' name='comments' rows='2'></textarea>
                    </div>
                   </div>
				";
			}else{
				//andle error
			}
		}

		public function create_patient_visit(){

			$patient_id = $this->input->post('patient_id');
			$lenght = $this->input->post('lenght');
			$weight = $this->input->post('weight');
			$z_score = $this->input->post('z_score');
			$muac = $this->input->post('muac');
			$cormobidity = $this->input->post('cormobidity');
			$oedema = $this->input->post('oedema');
			$nam_sam = $this->input->post('nam_sam');
			$admission_date = $this->input->post('admission_date');
			$discharge_date = $this->input->post('discharge_date');
			$next_visit = $this->input->post('next_visit');
			$comments = $this->input->post('comments');
			$visit_date = date('Y-m-d');

			$date1 = date_create("".$admission_date."");
			$date2 = date_create("".$discharge_date."");
			$diff = date_diff($date2, $date1);

			$ipd_days = $diff->days;

			$data = array(
				'patient_id' => $patient_id,
				'length' => $lenght,
				'weight' => $weight,
				'z_score' => $z_score,
				'muac' => $muac,
				'commorbidity' => $cormobidity,
				'oedema' => $oedema,
				'nam_sam' => $nam_sam,
				'admission_date' => $admission_date,
				'discharge_date' => $discharge_date,
				'ipd_days' => $ipd_days,
				'visit_date' => $visit_date,
				'comments' => $comments,
				'next_vist' => $next_visit
			);

			if($this->register->create_visit($data)){
				//data inserted successful
				redirect('malnutrition/home');
			}else{
				redirect('malnutrition/home');
			}
		}

		public function previous_visit(){
			$patient_id = $this->input->post("ids");
			$data = $this->register->get_previous_visit($patient_id);
			$name = $this->register->get_patient_information($patient_id);
			echo "
					<div class='modal-header'>
						<h5 class='modal-title text-center'>$name->names</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='close'></button>
              </div>
              <div class='modal-body'>";
              if($data){
              	echo "
              	<div class='accordion' id='accordionExample'>
              	";  
            $i=1;
           foreach($data as $row){
           	echo "
           			<div class='accordion-item'>
                  <h2 class='accordion-header' id='$i'>
                    <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#$i' aria-expanded='true' aria-controls='collapse.$i'>
                      Visit $i
                    </button>
                  </h2>
                  <div id='collapse.$i' class='accordion-collapse collapse show' aria-labelledby='$i' data-bs-parent='#accordionExample'>
                    <div class='accordion-body'>
                      <p><strong>Visit date:</strong> $row->visit_date <strong> Length :</strong>$row->length <strong> Weight:</strong> $row->weight</p>
                      <p><strong> Z-Score:</strong> $row->z_score <strong> MUAC :</strong>$row->muac <strong> Cormobidity:</strong> $row->commorbidity</p>
                      <p><strong> Z-Oedema:</strong> $row->oedema <strong> MUM-SAM :</strong>$row->nam_sam <strong> Admission Date:</strong> $row->admission_date</p>
                      <p><strong> Discharge Date:</strong> $row->discharge_date <strong> IPD days :</strong>$row->ipd_days <strong> Comments:</strong> $row->comments </p><strong> Next Visit Date:</strong> $row->next_vist</p>
                    </div>
                  </div>
               </div>
           	";
           		$i++;
           }
             echo "
             		 </div><!--end of accordion -->
            </div><!-- end of modal body -->
             ";   
          }else{
          	echo "
          	 <p>there is no visit for this patient </p>
          	 </div><!-- end of modal body -->
          	";
          }
			// foreach($data as $row){

			// }
		}

		public function all_Viewed_Patients(){

		$this->load->model('malnutrition/Patient_Registration_Model','patient');

		$result = $this->patient->getAll();

		if($result){
			foreach($result as $row){
				$patient_id = $row->patient_id;
				$patient_info = $this->patient->get_patient_information($patient_id);

				$complete_info[] = array(
					'names' => $patient_info->names,
					'file_number' => $patient_info->file_number,
					'address' => $patient_info->address,
					'best_contact' => $patient_info->best_contact,
					'phone' => $patient_info->phone,
					'gender' => $patient_info->gender,
					'dob' => $patient_info->dob,
					'comments' => $patient_info->comments,
					'length' => $row->length,
					'weight' => $row->weight,
					'z_score' => $row->z_score,
					'muac' => $row->muac,
					'commorbidity' => $row->commorbidity,
					'oedema' => $row->oedema,
					'nam_sam' => $row->nam_sam,
					'admission_date' => $row->admission_date,
					'discharge_date' => $row->discharge_date,
					'ipd_days' => $row->ipd_days,
					'comments' => $row->comments,
					'visit_date' => $row->visit_date,
					'next_vist' => $row->next_vist

				); 

			}
			return $complete_info;
		}else{
			// echo "nothing";
		}

	}

}

?>