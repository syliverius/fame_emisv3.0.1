<?php

	function get_wategemezi_option(){

		return array(
			'Mama' => 'Mama',
			'Baba' => 'Baba',
			'Mke' => 'Mke',
			'Mme' => 'Mme',
			'Mtoto' => 'Mtoto',
			'Wengineo' => 'wengineo'
		);
		
	}

	function calculate_year($dob){
		$years = "";
		if($dob != "" && $dob != "0000-00-00"){
			$birthDate = new DateTime($dob);
			$currentDate = new DateTime();
			$interval = $currentDate->diff($birthDate);
			$years = $interval->y;
		}
		

		return $years;
	}

?>