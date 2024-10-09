<?php 

	function getPatientId($data,$bed_id){
		$data = $data->result();
		foreach($data as $item){
			if($item->bed_id == $bed_id){
				return $item->patient_id;
			}
		}
	}

	function getPatientName($data,$bed_id){
		$data = $data->result();
		foreach($data as $item){
			if($item->bed_id == $bed_id){
				return $item->names;
			}
		}
	}

	function getBedOccupyInfo($data,$bed_id){
		foreach($data as $item){
			if($item->bed_id == $bed_id){
				return $item;	
			}
		}
		return null;
	}
?>