<?php $this->load->helper('estate_helper'); ?>
<div class="card">
	<div class="card-body">
		<h4 class="card-title"><?= $year;?> Cars Fuel Utilization Summary</h4>

		<?php $cars = $this->estate->getAllCars(); ?>

		<table class="table table-bordered border-primary text-center table-hover">
            <thead>
                <tr class="table-info">
                    <th rowspan="2"></th>
                    <?php foreach ($cars as $car) { ?>
                    	<th colspan="3"><?= $car->registration_number."<br />".$car->name; ?></th>
                    <?php } ?>
                    <th colspan="2">TOTAL FOR ALL CARS</th>
                </tr>
                <tr class="table-danger">
                    <?php foreach ($cars as $car) { ?>
                	<th >LITERS</th>
                	<th >KM</th>
                    <th>Litre/km</th>
                    <?php } ?>
                    <th colspan="1">LITERS(TOTAL)</th>
                	<th colspan="1">KM(TOTAL)</th>
                </tr>
            </thead>
            <tbody>
            	<?php 

            		$months = getMonths(); 
            		foreach($months as $month){ 
                        $total_fuel = 0;
                        $total_km = 0;
                        ?>
            			<tr>
            				<th><?= $month; ?></th>

            				<?php 
            					foreach($cars as $car){ 
            						$usage = $this->estate->get_car_month_usage($month,$car->car_id,$year);
            						if(empty($usage)){ ?>
            							<td></td>
            							<td></td>
                                        <td></td>
            						<?php }else{ 
                                        $total_fuel = $total_fuel + $usage->fuel_used;
                                        $total_km = $total_km + $usage->km_covered;
                                        ?>
            							<td><?= $usage->fuel_used; ?></td>
            							<td><?= $usage->km_covered; ?></td>
                                        <?php 
                                            if($usage->fuel_used == 0){ ?>
                                                <td></td>
                                            <?php }else{ ?>
                                                <td><?= round((($usage->km_covered)/($usage->fuel_used)),2); ?></td>
                                            <?php } ?>
            					<?php } } ?>

            					<td><?= $total_fuel; ?> </td>
            					<td><?= $total_km; ?></td>
            			</tr>
            		<?php } ?>
            </tbody>
        </table>
	</div>
</div>