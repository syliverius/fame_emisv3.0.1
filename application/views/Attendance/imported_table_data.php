<?php

	$data = $this->attendance->get_imported_data();
	$count = 1;
	foreach($data as $row){ ?>
		<tr>
	        <td><?= $count; ?></td>
	        <?php 
	        $employee = $this->hr->return_employee_name($row->employee_id);
	        ?>
	        <td><?= $employee->names; ?></td>
	        <td><?= $this->hr->get_Department_Details($employee->department_id)->department_name;?></td>
	        <td><?= $row->datetime; ?></td>
	        <td><?= $row->status; ?></td>
        </tr>

<?php $count++; } ?>