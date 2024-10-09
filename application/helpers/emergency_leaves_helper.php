<?php

 function get_emergency_leaves_options(){
 	$options = array(
 		'Maternity' => 'Maternity',
        'Paternity' => 'Paternity',
 		'Funeral' => 'Funeral',
 		'Sick' => 'Home/Hospital sick',
 		'Education' => 'In/out Education training',
 		'Others' => 'Others'
 	);

    return $options;
 }


?>
