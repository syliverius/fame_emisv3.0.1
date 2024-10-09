<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-17
 * @description Here we organise machine's fuel purchases by quarters
 * @license     Open Source
-->

<div class="card">
	<div class="card-body">
		<h3 class="card-title">Machines & Generators Fuel Purchases by year <b><i><?= $year; ?></i></b></h3>

		<?php
			$data_existance = $this->estate->getFuelPurchases($year);
			if($data_existance->num_rows() > 0){ $data = $data_existance->result();
						$quartersArray = array(
						    'Q1' => array('January', 'February', 'March'),
						    'Q2' => array('April', 'May', 'June'),
						    'Q3' => array('July', 'August', 'September'),
						    'Q4' => array('October', 'November', 'December')
						);

						foreach($quartersArray as $quarter => $q1_months){ 
							$quarter_total_cost = 0;
							$quarter_total_fuel = 0;
							$quarter_average_fuel = 0;
							if($quarter == "Q1"){
								$title = "START OF QUARTER ONE (Q1)";
								$summary_title = "QUARTER ONE (Q1) SUMMARY"; 
							}else if($quarter == "Q2"){
								$title = "START OF QUARTER TWO (Q2)";
								$summary_title = "QUARTER TWO (Q2) SUMMARY";
							}else if($quarter == "Q3"){
								$title = "START OF QUARTER THREE (Q3)";
								$summary_title = "QUARTER THREE (Q3) SUMMARY";
							}else{
								$title = "START OF QUARTER FOUR (Q4)";
								$summary_title = "QUARTER FOUR (Q4) SUMMARY";
							}
							?>
							<table class="table table-bordered border-primary text-center table-hover">
								<thead class="table-danger">
									<tr>
										<th colspan="7"><?= $title; ?></th>
									</tr>
									<tr>
										<th>MONTH</th>
										<th>DATE</th>
										<th>AMOUNT BROUGHT(L)</th>
										<th>NAME OF FUEL STATION</th>
										<th>RECEIPT NUMBER</th>
										<th>COST/LITRE(TSH)</th>
										<th>TOTAL FUEL COST</th>
									</tr>
								</thead>
								<tbody>

							<?php foreach($q1_months as $month){
								 $totalAmounts[$month] = 0;
								 $i = 0;
								foreach($data as $item){
									if($month == $item->month_name){
										$i++;
									 ?> <!-- TRACK MONTH WITH DO NOT PRESENT IT ON THE TABLE -->
										<tr>
											<td><?= $item->month_name; ?></td>
											<td><?= $item->date_bought; ?></td>
											<td><?= $item->amount; ?></td>
											<td><?= $item->name; ?></td>
											<td><?= $item->Recept_number; ?></td>
											<td><?= $item->cost_per_litre; ?></td>
											<td><?= number_format(($item->amount)*($item->cost_per_litre),2); ?></td>
										</tr>

									<?php 
									$quarter_total_fuel += $item->amount;
									$totalAmounts[$month] += ($item->amount) * ($item->cost_per_litre); } } ?>
									<?php if($i > 0){?>
									<tr>
										<td colspan="5"></td>
										<td class="table-primary"><b>TOTAL</b></td>
										<td class="table-primary"><?= number_format($totalAmounts[$month],2); ?></td>
									</tr>

						<?php  $quarter_total_cost += $totalAmounts[$month];  } } ?>
						<tr>
							<td colspan="7"></td>
						</tr>
						<tr>
							<th colspan="7" class="text-center table-secondary"><?= $summary_title; ?></th>
						</tr>
						<tr class="table-success">
							<th colspan="3">TOTAL FUEL PURCHASED</th>
							<td colspan="4"><b><?= $quarter_total_fuel; ?> Litres</b></td>
						</tr>
						<tr class="table-success">
							<th colspan="3">AVERAGE PURCHASE COST</th>
							
							<td colspan="4"><b><?= round(($quarter_total_fuel != 0) ? $quarter_total_cost/$quarter_total_fuel : 0,2);?> Tshs</b></td>
						</tr>
						<tr class="table-success">
							<th colspan="3">TOTAL FUEL COST</th>
							<td colspan="4"><b><?= number_format($quarter_total_cost); ?> Tshs</b></td>
						</tr>
						</tbody>
				</table><br/>
					<?php 
						}
					?>
					


 	<!-- all left now is to rotate through all quarters and print the exactly same thing except different month and data -->

			<?php }else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, there is no data for the selected year <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}

		?>


	</div>
</div>