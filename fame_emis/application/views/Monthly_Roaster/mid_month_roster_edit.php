
<style>
      /* Style for the table container */
      .table-container {
        width: 100%;
        overflow-x: scroll;
        margin-top: 20px;
        position: relative;
      }
      
      /* Style for the table */
      table {
        border-collapse: separate;
        min-width: max-content;
        width: max-content;
      }
      
      table th{
      	position: sticky;
      	background: #CD5C5C;
      	text-align: center;
      	color: #fff;
      	border: 1px solid #ccc;
      	font-size: 16px;
      }

      table td{
      	background: #fff;
      	text-align: center;
      	border: 1px solid #ccc;
      }

      td:first-child,th:first-child{
      	position: sticky;
      	left: 0;
      	z-index: 2;
      }
</style>

<div class="card">
  <div class="card-body">
    <div class="card-title text-center"><?= $data['month'];?> - <?= $data['year']; ?> <?= $this->hd->get_department_name($data['department_id'])->department_name; ?> DUTY ROSTER</div>
    <form method="post" id="mid_roaster_update">
    <?php 
     foreach($data['shifts'] as $shifts){
        echo '<i>'.$shifts->name.'</i> : <b>'.$shifts->abbreviation.'</b> , ';?>
        <input type="text" name="" id="shifts" value="<?= $shifts->abbreviation; ?>" hidden>
       <?php }
    ?>
    <div class="table-container">
    	<table>
		  <?php

			//from the provided year and month let get the number of days
			$year = $data['year'];
			$month = $data['month'];

			$date = new DateTime("$year-$month-1"); //get the first day of the month
			$number_of_days = $date->format('t');
			?>
            <input type="text" name="month" value="<?= $month; ?>" hidden>
            <input type="text" name="year" value="<?= $year; ?>" hidden>
            <input type="text" name="department_id" value="<?= $data['department_id']; ?>" hidden>
			<thead>
		 	<tr>
		 	<th class="col-sm-5">Dates</th>
		 	<?php
			for($i = 1;$i <= $number_of_days;$i++){ ?>
				<th><?= $i; ?></th>
			<?php } ?>
			</tr>

			<!--here we print days-->
			<tr>
		 	<th class="col-sm-5">Days</th>
		 	<?php
			for($i = 1;$i <= $number_of_days;$i++){
				$day_of_week = $date->format('w'); ?>

				<th><?= get_day_of_week($day_of_week); ?></th>
					<?php $date->modify('+1 day');
				} ?>
			</tr>
		</thead>
		<tbody>
			<?php function get_day_of_week($index) {
		    $days = array('SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT');
		    return $days[$index];
			} ?>

            <?php 
                foreach($data['shifts_present'] as $employeeShifts){
                   $i = 1;
                   $employeeId = $employeeShifts['employee_id'];
                   $employee_names = $employeeShifts['names']; 
                   $shifts = $employeeShifts['shifts']; ?>
                   <tr>
                    <!--now ill create i=0, so as to create name="<?= $row->employee_id.'_'.$i; ?>"-->
                    <td class="col-sm-5"><b><?= $employee_names; ?></b></td>
                    <?php foreach ($shifts as $shift) { ?>
                       <td><input type="text" size="5" id="days" name="<?= $employeeId.'_'.$i; ?>" class="text-center" value="<?= $shift->shift_type_abbrev; ?>"></td> 
                        <?php $i++; } ?>
                   </tr>
                    <?php } ?>
		 </tbody>
         <tfoot>
            <tr>
            <th class="col-sm-3">Dates</th>
            <?php
            $date = new DateTime("$year-$month-01"); //get the first day of the month
            $number_of_days = $date->format('t');
            for($i = 1;$i <= $number_of_days;$i++){ ?>
                <th><?= $i; ?></th>
            <?php } ?>
            </tr>

            <!--here we print days-->
            <tr>
            <th class="col-sm-3">Days</th>
            <?php
            for($i = 1;$i <= $number_of_days;$i++){
                $day_of_week = $date->format('w'); ?>

                <th><?= get_day_of_week($day_of_week); ?></th>
                    <?php $date->modify('+1 day');
                } ?>
            </tr>
        </tfoot>
		 </table>
         <!-- Here we will add publish button  -->
		</div><br />       
        <label for="update_reasons" class="col-sm-12 col-form-label success-label"><b>Please state the reasons for the changes you made above </b></label>
          <div class="col-sm-12">
            <textarea class="form-control" id="update_reason" name="update_reason" rows="2"></textarea>
          </div>
          <br />
        <center>
            <button type="button" class="btn btn-primary text-center" onclick="mid_month_update(event)">Update</button>
        </center>
        </form>
		</div>
	</div>

