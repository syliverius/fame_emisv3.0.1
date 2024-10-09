<?php

	function getMonths(){
		$months = array("January","February","March","April","May","June","July","August","September","October","November","December");
		return $months;
	}

	function extractCarNames($cars) {
	    $carNames = [];
	    foreach ($cars as $car) {
	        $carNames[] = $car->name;
	    }
	    return $carNames;
	}

	function machineAndGeneratorReports(){
		$machines = array("Fuel Purchases","Fuel Consumption","Quartery Report");
		return $machines;
	}

	function extractLocationsNames($locations){
		$location = [];
	    foreach ($locations as $loc) {
	        $location[] = $loc->name;
	    }
	    return $location;
	}


	function getPreviousMonth($currentMonth) {
	    // Define a mapping of each month to its previous month
	    $previousMonthMap = [
	        'January' => 'December',
	        'February' => 'January',
	        'March' => 'February',
	        'April' => 'March',
	        'May' => 'April',
	        'June' => 'May',
	        'July' => 'June',
	        'August' => 'July',
	        'September' => 'August',
	        'October' => 'September',
	        'November' => 'October',
	        'December' => 'November'
	    ];

	    // Check if the provided month is valid
	    if (!array_key_exists($currentMonth, $previousMonthMap)) {
	        return "Invalid month";
	    }
	    
	    return $previousMonthMap[$currentMonth];
	}

	function returnsDecemberUnits($location,$data){
		$december_units = 0;
		if(empty($data)){
			$december_units = 0;
		}else{
			foreach($data->result() as $row){
				if($row->name == $location){
					$december_units = $row->units_recorded;
				}
			}
		}
		return $december_units;
	}

?>