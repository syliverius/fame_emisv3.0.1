<?php

 class User_dashboard_Model extends CI_Model{

    public function regional_autosuggestion(){

        $this->db->select('*');
        $result = $this->db->get('region_table');
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return false;
        }
    }
  
    public function get_region_id($region_name){
        $this->db->select('*');
        $this->db->where('region_name',$region_name);
        $this->db->order_by('region_name','ASC');
        $result = $this->db->get('region_table');

        return $result->row();
    }

    function get_region_name($region_id){
       return $this->db->select('')->from('region_table')->where('id',$region_id)->get()->row();
    }

    function get_district_name($district_id){
       return $this->db->select('')->from('district_table')->where('id',$district_id)->get()->row(); 
    }

    function get_ward_name($ward_id){
       return $this->db->select('')->from('ward_table')->where('id',$ward_id)->get()->row(); 
    }

    public function get_district_autosuggestion($region_id){
        $this->db->select('*');
        $this->db->where('region_id',$region_id);
        $this->db->order_by('district_name','ASC');
        $result = $this->db->get('district_table');

         return $result->result();
    }

    public function get_district_id($district_name){
        $this->db->select('*');
        $this->db->where('district_name',$district_name);
        $result = $this->db->get('district_table');

        return $result->row();
    }

    public function get_wards_autosuggestion($district_id){
        $this->db->select('*');
        $this->db->where('district_id',$district_id);
        $this->db->order_by('ward_name','ASC');
        return $this->db->get('ward_table')->result();
    }

    public function check_employee_leave_ids(){
        $employee_id = $this->session->userdata('employee_id');
        $this->db->select('*');
        $this->db->where('employee_id',$employee_id);
        $result = $this->db->get('leave_details');

        return $result->result();
    }

   public function check_leave_benefits_model($leave_id){
        $leave_benefit = false;
        $year = date('Y');
        $prev_year = $year-1;
        $this->db->select('*');
        $this->db->where('leave_id',$leave_id);
        $this->db->where('DATE_FORMAT(start_date,"%Y")',$year);
        $this->db->or_where('DATE_FORMAT(start_date,"%Y")',$prev_year);
        $result = $this->db->get('leave_benefits');

        if($result){
            foreach($result->result() as $row){
                if($row->amount != 0 && $row->accoutant_sign != false){
                        $leave_benefit = true;
                 }
            }
        }

        return $leave_benefit;
   }

   public function get_thisyear_leave_id($employee_id,$year){

    $this->db->select('');
    $this->db->where('employee_id',$employee_id);
    $this->db->where('DATE_FORMAT(start_date,"%Y")',$year);
    $result = $this->db->get('leave_details');

    if($result->num_rows()>0){
        return $result->row();
    }else{
        return false;
    }
   }


   public function create_employee_leave($employee_id,$phone_number,$data){
            $this->db->trans_start();
            $update_phone_number = $this->db->query("UPDATE `employee` SET `phone_number`='$phone_number' WHERE `employee_id`='$employee_id'");
            $create_leave = $this->db->insert('leave_benefits',$data);
            if($update_phone_number && $create_leave){
                $this->db->trans_complete();
                return true;
            }else{
                $this->db->trans_rollback();
                return false;
            }
        
   }

   function get_annual_leave_details(){
    $this->db->select('start_date,end_date,days_left');
    $this->db->where('employee_id',$this->session->userdata('employee_id'));
    $this->db->where('DATE_FORMAT(start_date,"%Y")',date('Y'));
    $this->db->from('leave_details');
    return $this->db->get()->row();
   }

   function create_emergency_leave($data){
    return $this->db->insert('emergency_leaves',$data);
   }
 }

?>