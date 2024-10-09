<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller{


	public function index(){
		$module_name = "malnutrition_report";
		if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
			$data['values'] = $this->all_Viewed_Patients();
			$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('malnutrition/report',$data);
			$this->load->view('footer');
		}
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