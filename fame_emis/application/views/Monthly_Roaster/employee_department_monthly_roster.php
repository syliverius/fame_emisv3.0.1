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
      
      /*styling table 2*/
       #table2 {
            margin-top: 20px;
            width: 100%;
          }
</style>

<div class="card" id="">
  <div class="card-body">
    <div id="print_table">
    <!-- <div class="card-title text-center"><?= $data['month'];?> - <?= $data['year']; ?> <?= strtoupper($data['dept_name']);?> DUTY ROSTER </div> -->
    <br /> <br />
    <div style="float: right;">
        <button type="button" class="btn btn-secondary" onclick="print()"><i class="bi bi-printer"></i></button>
        <button type="button" class="btn btn-success" onclick="export_to_excel()"><i class="bi bi-file-excel"></i></button>
        <button type="button" class="btn btn-secondary"><i class="bi bi-download"></i></button>
    </div>
        <input type="text" id="roster_name" value="<?= strtoupper($data['dept_name']).' '.strtoupper($data['month']).' '.$data['year'].' ROSTER';?>" hidden>
    <div style="">
    <?php 
        $shifts_array = array();
        $number = 1;
     foreach($data['shifts'] as $shifts){
        echo '<i>'.$shifts->name.'</i> : <b>'.$shifts->abbreviation.'</b>,';
        $shifts_array[$number] = '<i>'.$shifts->name.'</i> : <b>'.$shifts->abbreviation.'</b>,';
         $number ++;
         } ?>
    </div>

    <div class="table-container">
    	<table id="myTable">
		  <?php

			//from the provided year and month let get the number of days
			$year = $data['year'];
			$month = $data['month'];

			$date = new DateTime("$year-$month-01"); //get the first day of the month
			$number_of_days = $date->format('t');
			?>
            <input type="text" name="month" value="<?= $month; ?>" hidden>
            <input type="text" name="year" value="<?= $year; ?>" hidden>
			<thead>
                <tr><td colspan="<?= $number_of_days+1; ?>"><b><?= strtoupper($data['month']);?> - <?= $data['year']; ?> <?= strtoupper($data['dept_name']);?> DUTY ROSTER</b></td></tr>
    		 	<tr>
    		 	<th class="col-sm-5">Dates</th>
    		 	<?php
    			for($i = 1;$i <= $number_of_days;$i++){ ?>
    				<th><?= $i; ?></th>
    			<?php } ?>
    			</tr>
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
                       $shifts = $employeeShifts['shifts']; 
                       $color;
                       ?>
                       <tr>
                        <td class="col-sm-5"><b><?= $employee_names; ?></b></td>
                        <?php foreach ($shifts as $shift) { 
                        	foreach($data['shifts'] as $shifts){
                        		if($shift->shift_type_abbrev == $shifts->abbreviation){
                        			$color = $shifts->color;
                                    $text_color = $shifts->text_color;
                        		}
                        	}?>
                           <td style="background-color: #<?= $color; ?>;color:#<?= $text_color; ?>; "><?= $shift->shift_type_abbrev; ?></td> 
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
                for($i = 1;$i <= $number_of_days; $i++){
                    $day_of_week = $date->format('w'); ?>

                    <th><?= get_day_of_week($day_of_week); ?></th>
                        <?php $date->modify('+1 day');
                    } ?>
                </tr>
                <!--still a trouble read below-->
                    <?php
                        $counts = 0;
                        if($number > 8){?>
                            <tr><td colspan="<?= $number_of_days+1;?>">
                            <?php for($i=1;$i<=8;$i++){
                                echo $shifts_array[$i];
                            }?>
                            </td></tr>
                            <tr><td colspan="<?= $number_of_days+1;?>">
                            <?php for($i=9;$i<=$number-1;$i++){
                                echo $shifts_array[$i];
                            }?>
                            </td></tr>
                        <?php }else{ ?>
                            <tr><td colspan="<?= $number_of_days+1;?>">
                                <?php
                                    foreach($data['shifts'] as $shifts){
                                        echo '<i>'.$shifts->name.'</i> : <b>'.$shifts->abbreviation.'</b>,';
                                    }
                                ?>
                        </td></tr>
                        <?php }
                    ?>
                 <!--this is going out of boundary for security roster -->
            </tfoot>
		</table>
		</div><br /><br /></div>
	   </div>
	</div>

    <script type="text/javascript">
        function print(){
            var mywindow = window.open('', '_blank', 'width=900,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');
            mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css" />');
            mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/core.min.css" rel="stylesheet" type="text/css" />');
            mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/components.min.css" rel="stylesheet" type="text/css" />');
            mywindow.document.write('</head><body >');

            mywindow.document.write(document.getElementById('print_table').innerHTML);

            mywindow.print();
            mywindow.close();


            return true;
        }

        function export_to_excel(month){
            var this_month = document.getElementById("roster_name").value;
            // var message = this_month + ' roaster';
            $("#myTable").table2excel({
                exclude: ".no-export", // Add class 'no-export' to elements you want to exclude from export
                filename: this_month, // Name of the Excel file
                fileext: ".xls", // File extension (".xls" for Excel 2003 or older, ".xlsx" for Excel 2007 or newer)
                preserveColors: true
              });
        }
    </script>



