<?php

class Patient_Registration_Model extends CI_Model{

	// public function __construct(){
	// 	parent ::__construct();
	// 	//$malnutrition = $this->load->database('malnutrition',true);
	// }

	// public $malnutrition = $this->load->database('malnutrition',true);

	public function new_patient($data){
		$malnutrition = $this->load->database('malnutrition',true);
		return $this->malnutrition->insert('patient',$data);
	}

	public function get_Auto_Suggestion_Employee($key){
		$malnutrition = $this->load->database('malnutrition',true);
		$query = "SELECT * FROM `patient` WHERE names like '" .$key. "%' ORDER BY names LIMIT 0,6";
 		$response = $malnutrition->query($query);
		return $response->result();

	}

	public function get_Patient_Info($names){
		$malnutrition = $this->load->database('malnutrition',true);
		$malnutrition->select('*');
		$malnutrition->where('names',$names);
		$result = $malnutrition->get('patient');

		if($result->num_rows()>0){
			return $result->row();
		}else{
			return false;
		}
	}

	public function get_patient_information($patient_id){
		$malnutrition = $this->load->database('malnutrition',true);
		$malnutrition->select('*');
 		$malnutrition->where('patient_id',$patient_id);
 		$result = $malnutrition->get('patient');

 		if($result->num_rows()>0){
 			return $result->row();
 		}else{
 			return false;
 		}
	}

	public function create_visit($data){ //ask uself if not admitted the date difference will do or 
		$malnutrition = $this->load->database('malnutrition',true);
		return $malnutrition->insert('patient_vist',$data);
	}
	
	public function get_previous_visit($patient_id){
		$malnutrition = $this->load->database('malnutrition',true);
		$malnutrition->select('*');
		$malnutrition->where('patient_id',$patient_id);
		$response = $malnutrition->get('patient_vist');
		if($response->num_rows()>0){
			return $response->result();
		}else{
			return false;
		}
	}

	public function getAll(){
		$malnutrition = $this->load->database('malnutrition',true);
		$malnutrition->select('*');
		$response = $malnutrition->get('patient_vist');
		return $response->result();
	}
}

?>