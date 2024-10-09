<?php 

	class Employee_Performance_Model extends CI_Model{

		function get_employee_details($names,$department_id){
			$this->db->select('employee.employee_id,employee.gender,professional.professional_name,employee.dob,employee.dept1,employee.dept2,employee.dept3,employee.dept4,employee.dept5,employee.dept6');
			$this->db->from('employee');
			$this->db->from('professional');
			$this->db->where('employee.names',$names);
			$this->db->where('employee.department_id',$department_id);
			$this->db->where('professional.id = employee.profession_id');

			return $this->db->get()->row();
		}

		function employee_exist_null_date($employee_id){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('date',NULL);
			$result = $this->db->get('employee_performance');

			if($result->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		function insert($data){
			return $this->db->insert('employee_performance',$data);
		}
		function employee_exist_this_year($employee_id,$current_year){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('DATE_FORMAT(date,"%Y")',$current_year);
			$result = $this->db->get('employee_performance');
			if($result->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		function update_form($employee_id,$data){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('date',NULL);
			return $this->db->update('employee_performance',$data);
		}

		function hd_update_evaluation_form($employee_id,$data){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('DATE_FORMAT(date,"%Y")',date('Y'));
			$this->db->where('jina_la_msimamizi = ',NULL);
			return $this->db->update('employee_performance',$data);
		}

		function update_average_performance($employee_id,$data){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('DATE_FORMAT(date,"%Y")',date('Y'));
			$this->db->where('jina_la_msimamizi != ',NULL);
			$this->db->where('hr_sign_date = ',NULL);
			$this->db->update('employee_performance',$data);
		}

		function get_employee_total_performance($employee_id){
			$this->db->select('(mahusiano_kazini_1_msimamizi
				+mahusiano_kazini_1_maafikiano
				+mahusiano_kazini_2_msimamizi
				+mahusiano_kazini_2_maafikiano
				+mahusiano_kazini_3_msimamizi
				+mahusiano_kazini_3_maafikiano
				+mawasiliano_na_usikivu_1_msimamizi
				+mawasiliano_na_usikivu_1_maafikiano
				+mawasiliano_na_usikivu_2_msimamizi
				+mawasiliano_na_usikivu_2_maafikiano
				+mawasiliano_na_usikivu_3_msimamizi
				+mawasiliano_na_usikivu_3_maafikiano
				+mawasiliano_na_usikivu_4_msimaizi
				+mawasiliano_na_usikivu_4_maafikiano
				+uongozi_na_usimamizi_1_msimamizi
				+uongozi_na_usimamizi_1_maafikiano
				+uongozi_na_usimamizi__2_msimamizi
				+uongozi_na_usimamizi__2_maafikiano
				+uongozi_na_usimamizi_3_msimamizi
				+uongozi_na_usimamizi_3_maafikiano
				+ubora_na_utendaji_1_msimamizi
				+ubora_na_utendaji_1_maafikiano
				+ubora_na_utendaji_2_msimamizi
				+ubora_na_utendaji_2_maafikiano
				+utendaji_wa_wingi_wa_matokeo_1_msimamizi
				+utendaji_wa_wingi_wa_matokeo_1_maafikiano
				+utendaji_wa_wingi_wa_matokeo_2_msimamizi
				+utendaji_wa_wingi_wa_matokeo_2_maafikiano
				+uajibikaji_utoaji_maamuzi_1_mtumishi
				+uajibikaji_utoaji_maamuzi_1_maafikiano
				+uajibikaji_utoaji_maamuzi_2_msimamizi
				+uajibikaji_utoaji_maamuzi_2_maafikiano
				+kuthamini_wateja_1_msimamizi
				+kuthamini_wateja_1_maafikiano
				+uaminifu_1_msimamizi
				+uaminifu_1_maafikiano
				+uaminifu_2_msimamizi
				+uaminifu_2_maafikiano
				+uaminifu_3_msimamizi
				+uaminifu_3_maafikiano
				+uadilifu_1_msimamizi
				+uadilifu_1_maafikiano
				+uadilifu_2_msimamizi
				+uadilifu_2_maafikiano
				+uadilifu_3_msimamizi
				+uadilifu_3_maafikiano
				+mahusiano_kazini_1_mtumishi
				+mahusiano_kazini_2_mtumishi
				+mahusiano_kazini_3_mtumishi
				+mawasiliano_na_usikivu_1_mtumishi
				+mawasiliano_na_usikivu_2_mtumishi
				+mawasiliano_na_usikivu_3_mtumishi
				+mawasiliano_na_usikivu_4_mtumishi
				+uongozi_na_usimamizi_1_mtumishi
				+uongozi_na_usimamizi_2_mtumishi
				+uongozi_na_usimamizi_3_mtumishi
				+ubora_na_utendaji_1_mtumishi
				+ubora_na_utendaji_2_mtumishi
				+utendaji_wa_wingi_wa_matokeo_1_mtumishi
				+utendaji_wa_wingi_wa_matokeo_2_mtumishi
				+uajibikaji_utoaji_maamuzi_1_msimamizi
				+uajibikaji_utoaji_maamuzi_2_mtumishi
				+kuthamini_wateja_1_mtumishi
				+uaminifu_1_mtumishi
				+uaminifu_2_mtumishi
				+uaminifu_3_mtumishi
				+uadilifu_1_mtumishi
				+uadilifu_2_mtumishi
				+uadilifu_3_mtumishi) as performance_total');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('DATE_FORMAT(date,"%Y")',date('Y'));
			$this->db->where('hr_sign_date = ',NULL);
			return $this->db->get('employee_performance')->row();
		}


		function hd_get_employee_total_performance($employee_id){
			$this->db->select('(mahusiano_kazini_1_msimamizi
				+mahusiano_kazini_1_maafikiano
				+mahusiano_kazini_2_msimamizi
				+mahusiano_kazini_2_maafikiano
				+mahusiano_kazini_3_msimamizi
				+mahusiano_kazini_3_maafikiano
				+mawasiliano_na_usikivu_1_msimamizi
				+mawasiliano_na_usikivu_1_maafikiano
				+mawasiliano_na_usikivu_2_msimamizi
				+mawasiliano_na_usikivu_2_maafikiano
				+mawasiliano_na_usikivu_3_msimamizi
				+mawasiliano_na_usikivu_3_maafikiano
				+mawasiliano_na_usikivu_4_msimaizi
				+mawasiliano_na_usikivu_4_maafikiano
				+uongozi_na_usimamizi_1_msimamizi
				+uongozi_na_usimamizi_1_maafikiano
				+uongozi_na_usimamizi__2_msimamizi
				+uongozi_na_usimamizi__2_maafikiano
				+uongozi_na_usimamizi_3_msimamizi
				+uongozi_na_usimamizi_3_maafikiano
				+ubora_na_utendaji_1_msimamizi
				+ubora_na_utendaji_1_maafikiano
				+ubora_na_utendaji_2_msimamizi
				+ubora_na_utendaji_2_maafikiano
				+utendaji_wa_wingi_wa_matokeo_1_msimamizi
				+utendaji_wa_wingi_wa_matokeo_1_maafikiano
				+utendaji_wa_wingi_wa_matokeo_2_msimamizi
				+utendaji_wa_wingi_wa_matokeo_2_maafikiano
				+uajibikaji_utoaji_maamuzi_1_mtumishi
				+uajibikaji_utoaji_maamuzi_1_maafikiano
				+uajibikaji_utoaji_maamuzi_2_msimamizi
				+uajibikaji_utoaji_maamuzi_2_maafikiano
				+kuthamini_wateja_1_msimamizi
				+kuthamini_wateja_1_maafikiano
				+uaminifu_1_msimamizi
				+uaminifu_1_maafikiano
				+uaminifu_2_msimamizi
				+uaminifu_2_maafikiano
				+uaminifu_3_msimamizi
				+uaminifu_3_maafikiano
				+uadilifu_1_msimamizi
				+uadilifu_1_maafikiano
				+uadilifu_2_msimamizi
				+uadilifu_2_maafikiano
				+uadilifu_3_msimamizi
				+uadilifu_3_maafikiano
				+mahusiano_kazini_1_mtumishi
				+mahusiano_kazini_2_mtumishi
				+mahusiano_kazini_3_mtumishi
				+mawasiliano_na_usikivu_1_mtumishi
				+mawasiliano_na_usikivu_2_mtumishi
				+mawasiliano_na_usikivu_3_mtumishi
				+mawasiliano_na_usikivu_4_mtumishi
				+uongozi_na_usimamizi_1_mtumishi
				+uongozi_na_usimamizi_2_mtumishi
				+uongozi_na_usimamizi_3_mtumishi
				+ubora_na_utendaji_1_mtumishi
				+ubora_na_utendaji_2_mtumishi
				+utendaji_wa_wingi_wa_matokeo_1_mtumishi
				+utendaji_wa_wingi_wa_matokeo_2_mtumishi
				+uajibikaji_utoaji_maamuzi_1_msimamizi
				+uajibikaji_utoaji_maamuzi_2_mtumishi
				+kuthamini_wateja_1_mtumishi
				+uaminifu_1_mtumishi
				+uaminifu_2_mtumishi
				+uaminifu_3_mtumishi
				+uadilifu_1_mtumishi
				+uadilifu_2_mtumishi
				+uadilifu_3_mtumishi) as performance_total');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('date',NULL);
			return $this->db->get('employee_performance')->result();
		}

		function calculate_employee_total_performance($employee_id,$year){
			$this->db->select('(mahusiano_kazini_1_msimamizi
				+mahusiano_kazini_1_maafikiano
				+mahusiano_kazini_2_msimamizi
				+mahusiano_kazini_2_maafikiano
				+mahusiano_kazini_3_msimamizi
				+mahusiano_kazini_3_maafikiano
				+mawasiliano_na_usikivu_1_msimamizi
				+mawasiliano_na_usikivu_1_maafikiano
				+mawasiliano_na_usikivu_2_msimamizi
				+mawasiliano_na_usikivu_2_maafikiano
				+mawasiliano_na_usikivu_3_msimamizi
				+mawasiliano_na_usikivu_3_maafikiano
				+mawasiliano_na_usikivu_4_msimaizi
				+mawasiliano_na_usikivu_4_maafikiano
				+uongozi_na_usimamizi_1_msimamizi
				+uongozi_na_usimamizi_1_maafikiano
				+uongozi_na_usimamizi__2_msimamizi
				+uongozi_na_usimamizi__2_maafikiano
				+uongozi_na_usimamizi_3_msimamizi
				+uongozi_na_usimamizi_3_maafikiano
				+ubora_na_utendaji_1_msimamizi
				+ubora_na_utendaji_1_maafikiano
				+ubora_na_utendaji_2_msimamizi
				+ubora_na_utendaji_2_maafikiano
				+utendaji_wa_wingi_wa_matokeo_1_msimamizi
				+utendaji_wa_wingi_wa_matokeo_1_maafikiano
				+utendaji_wa_wingi_wa_matokeo_2_msimamizi
				+utendaji_wa_wingi_wa_matokeo_2_maafikiano
				+uajibikaji_utoaji_maamuzi_1_mtumishi
				+uajibikaji_utoaji_maamuzi_1_maafikiano
				+uajibikaji_utoaji_maamuzi_2_msimamizi
				+uajibikaji_utoaji_maamuzi_2_maafikiano
				+kuthamini_wateja_1_msimamizi
				+kuthamini_wateja_1_maafikiano
				+uaminifu_1_msimamizi
				+uaminifu_1_maafikiano
				+uaminifu_2_msimamizi
				+uaminifu_2_maafikiano
				+uaminifu_3_msimamizi
				+uaminifu_3_maafikiano
				+uadilifu_1_msimamizi
				+uadilifu_1_maafikiano
				+uadilifu_2_msimamizi
				+uadilifu_2_maafikiano
				+uadilifu_3_msimamizi
				+uadilifu_3_maafikiano
				+mahusiano_kazini_1_mtumishi
				+mahusiano_kazini_2_mtumishi
				+mahusiano_kazini_3_mtumishi
				+mawasiliano_na_usikivu_1_mtumishi
				+mawasiliano_na_usikivu_2_mtumishi
				+mawasiliano_na_usikivu_3_mtumishi
				+mawasiliano_na_usikivu_4_mtumishi
				+uongozi_na_usimamizi_1_mtumishi
				+uongozi_na_usimamizi_2_mtumishi
				+uongozi_na_usimamizi_3_mtumishi
				+ubora_na_utendaji_1_mtumishi
				+ubora_na_utendaji_2_mtumishi
				+utendaji_wa_wingi_wa_matokeo_1_mtumishi
				+utendaji_wa_wingi_wa_matokeo_2_mtumishi
				+uajibikaji_utoaji_maamuzi_1_msimamizi
				+uajibikaji_utoaji_maamuzi_2_mtumishi
				+kuthamini_wateja_1_mtumishi
				+uaminifu_1_mtumishi
				+uaminifu_2_mtumishi
				+uaminifu_3_mtumishi
				+uadilifu_1_mtumishi
				+uadilifu_2_mtumishi
				+uadilifu_3_mtumishi) as performance_total,wastani_utendaji_wa_jumla,(DATE_FORMAT(date,"%Y")) as year');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('DATE_FORMAT(date,"%Y")',$year);
			return $this->db->get('employee_performance');
		}

		function get_performance_report($year_selected,$depertment_id){
			$this->db->select('employee_performance.employee_id,employee_performance.age,employee_performance.elimu,employee_performance.wastani_utendaji_wa_jumla,employee.names');
			$this->db->where('DATE_FORMAT(employee_performance.date,"%Y")',$year_selected);
			$this->db->where('employee_performance.hr_sign_date is not NULL');
			$this->db->where('employee.employee_id=employee_performance.employee_id');
			$this->db->where('employee.department_id',$depertment_id);
			$this->db->order_by('employee_performance.wastani_utendaji_wa_jumla','desc');
			$this->db->order_by('employee.names','asc');
			$this->db->from('employee_performance');
			$this->db->from('employee');
			return $this->db->get();
		}

		function view_more($employee_id,$selected_year){
			$this->db->select('')->from('employee_performance');
			$this->db->where('employee_performance.employee_id',$employee_id);
			$this->db->where('DATE_FORMAT(employee_performance.date,"%Y")',$selected_year);
			
			return $this->db->get()->row();
		}


		function get_employee_particular($employee_id){
			$this->db->select('employee.names,employee.gender,professional.professional_name,depertment.department_name,employee.department_id,employee.employee_id');
			$this->db->where('employee.employee_id',$employee_id);
			$this->db->where('professional.id=employee.profession_id');
			$this->db->where('depertment.department_id=employee.department_id');
			$this->db->from('employee');
			$this->db->from('depertment');
			$this->db->from('professional');
			return $this->db->get()->row();
		}

		function getUncheckedList($year){
			$this->db->select('employee.names,employee.gender,professional.professional_name,depertment.department_name,employee_performance.elimu,employee_performance.employee_id');
			$this->db->where('DATE_FORMAT(employee_performance.date,"%Y")',$year);
			$this->db->where('employee_performance.jina_la_msimamizi != ',NULL);
			$this->db->where('employee_performance.hr_sign_date',NULL);
			$this->db->where('employee.employee_id=employee_performance.employee_id');
			$this->db->where('professional.id=employee.profession_id');
			$this->db->where('depertment.department_id=employee.department_id');
			$this->db->from('employee');
			$this->db->from('depertment');
			$this->db->from('professional');
			$this->db->from('employee_performance');

			return $this->db->get();
		}

		public function get_hd_UncheckedList($year){
			$this->db->select('employee.names,employee.gender,professional.professional_name,employee_performance.elimu,employee_performance.employee_id');
			$this->db->where('DATE_FORMAT(employee_performance.date,"%Y")',$year);
			$this->db->where('employee_performance.jina_la_msimamizi',NULL);
			$this->db->where('employee.employee_id=employee_performance.employee_id');
			$this->db->where('employee.department_id',$this->session->userdata('department_id'));
			$this->db->where('professional.id = employee.profession_id');
			$this->db->from('employee');
			$this->db->from('professional');
			$this->db->from('employee_performance');
			return $this->db->get();
		}

		function hr_performance_update($employee_id,$data,$year){
			$this->db->select('');
			$this->db->where('employee_id',$employee_id);
			$this->db->where('DATE_FORMAT(date,"%Y")',$year);
			$this->db->where('hr_sign_date',NULL);
			return $this->db->update('employee_performance',$data);
		}

		function get_all_performance_report($year){
			$this->db->select('employee_performance.employee_id,employee_performance.age,employee_performance.elimu,employee_performance.wastani_utendaji_wa_jumla,employee.names,depertment.department_name');
			$this->db->where('employee_performance.hr_sign_date is not NULL');
			$this->db->where('DATE_FORMAT(employee_performance.date,"%Y")',$year);
			$this->db->where('employee.employee_id=employee_performance.employee_id');
			$this->db->where('depertment.department_id=employee.department_id');
			$this->db->order_by('employee_performance.wastani_utendaji_wa_jumla','desc');
			$this->db->order_by('employee.names','asc');
			$this->db->from('employee_performance');
			$this->db->from('employee');
			$this->db->from('depertment');
			return $this->db->get();
		}

	}


?>