<?php

 function return_number_of_available_employee(){
 	 $CI = get_instance();
 	 $CI->load->model('Dashboard_Model','dashboard');
 	 $data = $CI->dashboard->get_all_employee_id();
     $count = 0;
     foreach ($data as $employee){
        $annual_leave = $CI->dashboard->check_employee_in_annual_leave($employee->employee_id);
        $emergency_leave = $CI->dashboard->check_employee_in_emergency_leave($employee->employee_id);
        if($annual_leave || $emergency_leave){
        }else{
            $count++;
        }
     }
     return $count;
 }

 function check_returned_shifts($shifts,$department_id){
    $i = 0;
    if(empty($shifts)){
        return '<td><span class="badge bg-warning">roster Unavailable</span></td><td><span class="badge rounded-pill bg-info text-dark">0 % </span></td>';
    }else{
        $available_employee = check_valid_shift($shifts);
        if($available_employee <= 0){
            return '<td><span class="badge bg-primary">All members are Off duty</span></td><td><span class="badge rounded-pill bg-info text-dark">0 % </span></td>';
        }else{
            $CI = get_instance();
            $CI->load->model('Dashboard_Model','dashboard');
            $get_total_dept_members = count($CI->dashboard->get_Department_Members($department_id));
            return '<td><i class="bi bi-people"></i> '.$available_employee. '</td><td><span class="badge rounded-pill bg-info text-dark">'.round(($available_employee/$get_total_dept_members)*100,1).' % </span></td>';
        }
    }
 }

 function check_valid_shift($shifts){
    $count = 0;
    foreach($shifts as $shift){
        if($shift->work_period != "Off"){
            $count++;
        }
    }
    return $count;
 }

 function get_7_day_date(){
    $today = new DateTime();
    $futureDate = $today->modify('+6 days');
    $formattedDate = $futureDate->format('Y-m-d');
    return $formattedDate;
 }

?>