<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $year = date('Y');?> Cars Fuel Utilization Summary</h4>

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
                    <th>LITERS</th>
                    <th>KM</th>
                    <th>Litre/km</th>
                    <?php } ?>
                    <th>LITERS(TOTAL)</th>
                    <th>KM(TOTAL)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $months = getMonths(); 
                    $year_total_fuel = 0; // For summing liters for the year
                    $year_total_km = 0;   // For summing km for the year
                    $car_total_fuel = array(); // Array to hold total fuel for each car
                    $car_total_km = array();   // Array to hold total km for each car

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
                                        // Calculate totals for the month
                                        $total_fuel += $usage->fuel_used;
                                        $total_km += $usage->km_covered;

                                        // Accumulate totals for the year
                                        if (!isset($car_total_fuel[$car->car_id])) {
                                            $car_total_fuel[$car->car_id] = 0;
                                            $car_total_km[$car->car_id] = 0;
                                        }
                                        $car_total_fuel[$car->car_id] += $usage->fuel_used;
                                        $car_total_km[$car->car_id] += $usage->km_covered;

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

                    <!-- Add the total row for the year -->
                    <tr class="table-success">
                        <th>TOTAL FOR YEAR</th>
                        <?php foreach($cars as $car){ ?>
                            <td><?= number_format($car_total_fuel[$car->car_id],2); ?></td>
                            <td><?= number_format($car_total_km[$car->car_id],2); ?></td>
                            <td></td>
                        <?php } ?>
                        <td><?= number_format(array_sum($car_total_fuel),2); ?> </td>
                        <td><?= number_format(array_sum($car_total_km),2); ?> </td>
                    </tr>

            </tbody>
        </table>
    </div>
</div>
