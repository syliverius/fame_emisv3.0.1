<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-21
 * @description Here we organise machine's fuel Consumption by quarters
 * @license    Rwazi.co.tz
-->

<div class="card">
	<div class="card-body">
		<div style="float: right;">
            <button type="button" class="btn btn-success" onclick="export_to_excel()"><i class="bi bi-file-excel"></i>Export</button>
        </div>
		<h3 class="card-title">Machines & Generators Fuel Consumption by year <b><i><?= $year; ?></i></b></h3>
		<input type="text" name="summary_name" id="summary_name" value="achines & Generators Fuel Consumption by year <?= $year; ?>" hidden>
		<?php 
			$data_existance = $this->estate->getFuelConsumption($year);
			if($data_existance->num_rows() > 0){ $data = $data_existance->result();
				$quartersArray = array(
				    'Q1' => array('January', 'February', 'March'),
				    'Q2' => array('April', 'May', 'June'),
				    'Q3' => array('July', 'August', 'September'),
				    'Q4' => array('October', 'November', 'December')
				);
				foreach($quartersArray as $quarter => $q1_months){ 
					$quarter_data = array();
					if($quarter == "Q1"){
						$summary_title = "QUARTER ONE (Q1) SUMMARY"; 
					}else if($quarter == "Q2"){
						$summary_title = "QUARTER TWO (Q2) SUMMARY";
					}else if($quarter == "Q3"){
						$summary_title = "QUARTER THREE (Q3) SUMMARY";
					}else{
						$summary_title = "QUARTER FOUR (Q4) SUMMARY";
					}
					foreach($q1_months as $month){ 
						$month_machines_used = array();
						$month_summary_title = $month." USAGE SUMMARY ";
						?>

					<table class="table table-bordered border-primary text-center table-hover">
						<thead class="table-danger">
							<tr>
								<th>MONTH</th>
								<th>DATE</th>
								<th>AMOUNT USED(L)</th>
								<th>REFILLING TIME</th>
								<th>GENERATOR RUNNING TIME READING(HRS)</th>
								<th>TYPE OF MACHINE</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						foreach($data as $item){
							if($month == $item->month_name){ ?>
								<tr>
									<td><?= $item->month_name; ?></td>
									<td><?= $item->date_recorder; ?></td>
									<td><?= $item->amount_used; ?></td>
									<td><?= $item->Refilling_time; ?></td>
									<td><?= $item->running_time; ?></td>
									<td><?= $item->name; ?></td>
								</tr>
								<?php $month_machines_used[] = array('machine_name' => $item->name,
									'amount' => $item->amount_used
								); 
								$quarter_data[] = array('machine_name' => $item->name,
										'amount' => $item->amount_used
									);
							} 
						} ?>
								<tr>
									<td colspan="7"></td>
								</tr>
								<tr class="text-center table-dark">
									<td colspan="7"><b><?= $month_summary_title; ?></b></td>
								</tr>
								<?php 
									$machines = $this->estate->getAllMachines();
									foreach($machines as $machine){
									$sum = 0;
									$i = 0;
										foreach($month_machines_used as $item){
											if($item['machine_name'] == $machine->name){
												$sum += $item['amount'];
												$i++;
											}
										} if($i > 0){ ?>
										<tr class="table-success">
										 	<td colspan="3"><b><?= $machine->name; ?></b></td>
										 	<td colspan="4"><b><?= $sum." Litres"; ?></b></td>
										</tr> 
									<?php } }
								?>
							</tbody>
						</table>

						<?php } ?>
						
						<table class="table table-bordered border-primary text-center table-hover table-primary">
							<thead>
								<th colspan="7"><?= $summary_title; ?></th>
							</thead>
							<tbody>
								<?php 
									foreach($machines as $machine){
										$sum = 0;
										$i = 0;
										foreach($quarter_data as $item){
											if ($item['machine_name'] == $machine->name) {
												$sum += $item['amount'];
												$i++;
											}
										}if($i > 0){ ?>

											<tr>
											 	<td colspan="3"><b><?= $machine->name; ?></b></td>
											 	<td colspan="4"><b><?= $sum." Litres"; ?></b></td>
											</tr> 

								<?php		}
									}
								?>
							</tbody>
						</table>

						<?php } } else{
									echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, there is no data for the selected year <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} ?>

	</div>
</div>

<script type="text/javascript">
    function export_to_excel(month){
	    var this_year_summary = document.getElementById("summary_name").value;
	    var combinedTable = $("<table></table>");
	    
	    $("table").each(function() {
	        combinedTable.append($(this).clone());
	    });

	    combinedTable.table2excel({
	        exclude: ".no-export",  
	        filename: this_year_summary,
	        fileext: ".xls", 
	        preserveColors: true 
	    });
    }
</script>