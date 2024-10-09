<?php


class Menu_Model extends CI_Model{

	function check_menu_info($ward, $date){
		$this->db->select('hospital_menu_data.id,hospital_menu_data.patient_id,hospital_menu_data.names,hospital_menu_data.location_id,hospital_menu_data.ward,hospital_menu_data.date,hospital_menu_data.Breakfast,hospital_menu_data.before_luch,hospital_menu_data.lunch,hospital_menu_data.before_dinner,hospital_menu_data.dinner,hospital_menu_data.after_dinner,hospital_menu_data.creation_date,hospital_beds.name,hospital_menu_data.comments,hospital_menu_data.bed_id');
		$this->db->where('hospital_menu_data.date',$date);
		$this->db->where('hospital_menu_data.ward',$ward);
		$this->db->where('hospital_menu_data.status',false);
		$this->db->where('hospital_beds.id = hospital_menu_data.bed_id');
		$this->db->from('hospital_menu_data');
		$this->db->from('hospital_beds');
		$data = $this->db->get();
		if($data->num_rows()>0){
			return $data->result();
		}else{
			false;
		}
	}

	function get_menu_summary($ward, $date){
		$this->db->select('hospital_menu_data.id,hospital_menu_data.patient_id,hospital_menu_data.names,hospital_menu_data.location_id,hospital_menu_data.ward,hospital_menu_data.date,hospital_menu_data.Breakfast,hospital_menu_data.before_luch,hospital_menu_data.lunch,hospital_menu_data.before_dinner,hospital_menu_data.dinner,hospital_menu_data.after_dinner,hospital_menu_data.creation_date,hospital_beds.name,hospital_menu_data.comments,hospital_menu_data.bed_id');
		$this->db->where('hospital_menu_data.date',$date);
		$this->db->where('hospital_menu_data.ward',$ward);
		$this->db->where('hospital_beds.id = hospital_menu_data.bed_id');
		$this->db->from('hospital_menu_data');
		$this->db->from('hospital_beds');
		$data = $this->db->get();
		if($data->num_rows()>0){
			return $data->result();
		}else{
			false;
		}
	}


	function getWardBeds($location_id){
		return $this->db->select('*')->from('hospital_beds')->where('ward',$location_id)->get()->result();
	}

	function getBreakfast(){
		return $this->db->select('')->from('hospital_menu')->where('category','Breakfast')->order_by('names','ASC')->get()->result();
	}
	function getLunch(){
		return $this->db->select('')->from('hospital_menu')->where('category','Lunch & Dinner')->order_by('names','ASC')->get()->result();
	}
	function getExtra(){
		return $this->db->select('')->from('hospital_menu')->where('category','Extra')->order_by('names','ASC')->get()->result();
	}


	function submit_new_book($data){
		return $this->db->insert('hospital_menu_data',$data);
	}

	function menu_audit_trial($data){
		$this->db->insert('menu_book_audit',$data);
	}

//changes were made here, adding || ""
	function get_menu_name($id){
		if($id == 0 || ""){
			return "";
		}else{
			return $this->db->select('names')->from('hospital_menu')->where('id',$id)->get()->row()->names;
		}
	}

	function get_bed_menu_info($menu_id){
		$this->db->select('hospital_menu_data.id,hospital_menu_data.bed_id,hospital_menu_data.patient_id,hospital_menu_data.names,hospital_menu_data.location_id,hospital_menu_data.ward,hospital_menu_data.date,hospital_menu_data.Breakfast,hospital_menu_data.before_luch,hospital_menu_data.lunch,hospital_menu_data.before_dinner,hospital_menu_data.dinner,hospital_menu_data.after_dinner,hospital_beds.name,hospital_menu_data.comments');
		$this->db->where('hospital_menu_data.id',$menu_id);
		$this->db->where('hospital_beds.id = hospital_menu_data.bed_id');
		$this->db->from('hospital_menu_data');
		$this->db->from('hospital_beds');
		return $this->db->get()->row();
	}


	function update_menu_info($menu_id,$data){
		$this->db->select('*');
		$this->db->where('id',$menu_id);
		return $this->db->update('hospital_menu_data',$data);
	}

	function discharge($menu_id){
		$this->db->select('*');
		$this->db->where('id',$menu_id);
		$this->db->set('status','1');
		return $this->db->update('hospital_menu_data');
	}

	function getAllMenuSummary($start_date,$end_date){
		$this->db->select('hospital_menu_data.bed_id,hospital_menu_data.ward,hospital_menu_data.breakfast,hospital_menu_data.before_luch,hospital_menu_data.lunch,hospital_menu_data.before_dinner,hospital_menu_data.dinner,hospital_menu_data.after_dinner,hospital_menu_data.date');
		$this->db->where('hospital_menu_data.date >=',$start_date);
		$this->db->where('hospital_menu_data.date <=',$end_date);
		$this->db->from('hospital_menu_data');
		return $this->db->get();
	}

	function getWardMenuSummary($ward,$start_date,$end_date){
		$this->db->select('hospital_menu_data.bed_id,hospital_menu_data.ward,hospital_menu_data.breakfast,hospital_menu_data.before_luch,hospital_menu_data.lunch,hospital_menu_data.before_dinner,hospital_menu_data.dinner,hospital_menu_data.after_dinner,hospital_menu_data.date');
		$this->db->where('hospital_menu_data.date >=',$start_date);
		$this->db->where('hospital_menu_data.date <=',$end_date);
		$this->db->where('hospital_menu_data.ward',$ward);
		$this->db->from('hospital_menu_data');
		return $this->db->get();
	}

	function get_menu_amount($id){
		$amount = $this->db->select('')->from('hospital_menu')->where('id',$id)->get();
		if($amount->num_rows() > 0){
			return $amount->row()->cost;
		}else{
			return 0;
		}
	}

	function getyesterdayPatientInfo($date,$ward){
		$this->db->select('bed_id,patient_id,names');
		$this->db->where('date',$date);
		$this->db->where('ward',$ward);
		$this->db->where('status',false);
		$this->db->from('hospital_menu_data');
		return $this->db->get();
	}

	function get_audit_report($ward,$date){
		$this->db->select('');
		$this->db->where('ward',$ward);
		$this->db->where('date',$date);
		return $this->db->get('menu_book_audit');
	}

}

?>