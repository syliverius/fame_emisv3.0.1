<?php

	function getStartAndEndWeekDate($suppliedWeek){
		list($year, $week) = explode('-W', $suppliedWeek);
    
	    $date = new DateTime();
	    $date->setISODate($year, $week);
	    
	    // Set the day of the week to Monday (ISO 1) and Sunday (ISO 7)
	    $startDate = $date->format('Y-m-d');
	    $date->modify('+6 days');
	    $endDate = $date->format('Y-m-d');

	    return ['start_date' => $startDate, 'end_date' => $endDate];
	}

	function getDateOfDay($day,$week){
		$year = (int)substr($week, 0, 4); // Extract the year
	    $week_number = (int)substr($week, 6); // Extract the week number

	    // Initialize a DateTime object to the first day (Monday) of the specified week
	    $date = new DateTime();
	    $date->setISODate($year, $week_number, 1);

	    // Loop through the days of the week and find the date for the specified day
	    while ($date->format('l') !== $day) {
	        $date->add(new DateInterval('P1D'));
	    }

	    //return date you'll format on the displaying page
	    return $date;
	}

	function getSignInTime($day,$week,$employee_id){
		$CI = get_instance();
 	 	$CI->load->model('Attendance_Model');
		$year = (int)substr($week, 0, 4); // Extract the year
	    $week_number = (int)substr($week, 6); // Extract the week number

	    // Initialize a DateTime object to the first day (Monday) of the specified week
	    $date = new DateTime();
	    $date->setISODate($year, $week_number, 1);

	    // Loop through the days of the week and find the date for the specified day
	    while ($date->format('l') !== $day) {
	        $date->add(new DateInterval('P1D'));
	    }

	    // Return the date in the desired format
	    $date = $date->format('Y-m-d'); //6:00 8:00 also consider multiple sin in we pick the first one 
	    $expectedEarlySignIn = strtotime($date . ' 00:00:00');
	    $expectedLateSignIn = strtotime($date . ' 23:59:59');
	    $returnedTime = $CI->attendance->checkSignInTime($expectedEarlySignIn,$expectedLateSignIn,$employee_id);
	    if($returnedTime == "empty"){
	    	return "";
	    }else{
	    	return $returnedTime->datetime;
	    }
	}

	function getSignOutTime($day,$week,$employee_id,$signintime){
		$CI = get_instance();
 	 	$CI->load->model('Attendance_Model');
		$year = (int)substr($week, 0, 4);
	    $week_number = (int)substr($week, 6);

	    $date = new DateTime();
	    $date->setISODate($year, $week_number, 1);

	    // Loop through the days of the week and find the date for the specified day
	    while ($date->format('l') !== $day) {
	        $date->add(new DateInterval('P1D'));
	    }
	    $date = $date->format('Y-m-d'); //6:00 8:00 also consider multiple sin in we pick the first one 
	    $expectedEarlySignOut = strtotime($date . ' ' . $signintime . ':00');
	    $expectedLateSignOut = strtotime('+15 hours', $expectedEarlySignOut);
	    $returnedTime = $CI->attendance->checkSignOutTime($expectedEarlySignOut,$expectedLateSignOut,$employee_id);
	    if($returnedTime == "empty" || $signintime == ""){
	    	return "";
	    }else{
	    	return $returnedTime->datetime;
	    }
	}

	function convertsIntoMinutes($timestamp){
		if($timestamp != ""){
			$dateObj = new DateTime();
			$dateObj->setTimestamp($timestamp);
			return $dateObj->format("H:i");
		}else{
			return "";
		}
	}

	function timeDifference($signtime,$signouttime){
		
		if($signtime != "" && $signouttime != ""){
			$start = DateTime::createFromFormat('H:i', $signtime);
			$end = DateTime::createFromFormat('H:i', $signouttime);

			// Calculate the time difference
			$interval = $start->diff($end);

			// Get the difference in hours and minutes
			$hours = $interval->format('%h');
			$minutes = $interval->format('%i');

			echo "$hours hours && $minutes minutes";
		}else{
			echo "";
		}
	}

	
	//This method is used to check the reason for employee absence on attendance
	function checkabsentreasons($employee_id,$date){
		$CI = get_instance();
 	 	$CI->load->model('Attendance_Model','attendance');
 	 	$shift = $CI->attendance->get_date_shift($employee_id,$date); 
 	 	if (empty($shift)) {
 	 		echo '<span class="badge bg-warning"><i class="bi bi-exclamation-triangle me-1"></i>No Roster</span>';
 	 	}else{
 	 		if($shift->work_period == "Off"){
 	 			echo '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>'.$shift->name.'</span>';
 	 		}else{
 	 			if($CI->attendance->check_emergency($employee_id,$date) || $CI->attendance->check_annual_leaves($employee_id,$date)){
 	 			echo '<span class="badge bg-info"><i class="bi bi-info-circle me-1"></i>Emergency/Annual leave</span>';
 	 			}else{
	 	 			echo '<span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>'.$shift->name.'</span>';
 	 			}
 	 		}
 	 	}
	}

	function get_shift_name($employee_id,$date){
		$CI = get_instance();
 	 	$CI->load->model('Attendance_Model','attendance');
 	 	$shift = $CI->attendance->get_date_shift($employee_id,$date); 
 	 	if(empty($shift)){
 	 		echo "";
 	 	}else{
 	 		echo '<span class="badge bg-primary"><i class="bi bi-star me-1"></i>'.$shift->name.'</span>';
 	 	}
	}



?>