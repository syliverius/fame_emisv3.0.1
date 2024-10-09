<?php

function leave_options(){
        $options = array(
                'Likizo' => 'Likizo',
                'Mafunzo ya kujiendeleza' => 'Mafunzo ya kujiendeleza',
                'Kozi fupi' => 'Kozi fupi',
                'Sababu nyinginezo' => 'Sababu nyinginezo'
        );

    return $options;
 }

function monthly_roster_work_periods(){
       $options = array(
              'Day' => 'Day',
              'Night' => 'Night',
              'Off' => 'Off'
       );
       return $options;
 }
 
?>