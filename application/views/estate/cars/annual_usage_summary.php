<?php $this->load->helper('estate_helper'); ?>
<div class="card">
    <div class="card-body">
        <div style="float: right;">
            <button type="button" class="btn btn-success" onclick="export_to_excel()"><i class="bi bi-file-excel"></i>Export</button>
        </div>
        <h4 class="card-title"><?= $year; ?> Cars Fuel Utilization Summary</h4>
        <?php $cars = $this->estate->getAllCars(); ?>
        <input type="text" name="summary_name" id="summary_name" value="<?= $year; ?> Cars fuel utilization" hidden>
        <table class="table table-bordered border-primary text-center table-hover" id="myTable">
            <thead>
                <tr class="table-info">
                    <th rowspan="2"></th>
                    <?php foreach ($cars as $car) { ?>
                        <th colspan="3"><?= $car->registration_number . "<br />" . $car->name; ?></th>
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
                    $monthCounter = 0;
                    $quarter = 1;

                    // Initialize arrays to track quarterly totals for each car and overall
                    $quarterlyTotals = array_fill_keys(array_column($cars, 'car_id'), ['fuel' => 0, 'km' => 0]);
                    $overallQuarterFuel = 0;
                    $overallQuarterKm = 0;

                    foreach ($months as $month) { 
                        $total_fuel = 0;
                        $total_km = 0;
                        ?>
                        <tr>
                            <th><?= $month; ?></th>

                            <?php foreach ($cars as $car) { 
                                $usage = $this->estate->get_car_month_usage($month, $car->car_id, $year);
                                if (empty($usage)) { ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php } else { 
                                    // Calculate totals
                                    $total_fuel += $usage->fuel_used;
                                    $total_km += $usage->km_covered;

                                    // Add to car's quarterly totals
                                    $quarterlyTotals[$car->car_id]['fuel'] += $usage->fuel_used;
                                    $quarterlyTotals[$car->car_id]['km'] += $usage->km_covered;

                                    $overallQuarterFuel += $usage->fuel_used;
                                    $overallQuarterKm += $usage->km_covered;
                                    ?>
                                    <td><?= $usage->fuel_used; ?></td>
                                    <td><?= $usage->km_covered; ?></td>
                                    <td><?= $usage->fuel_used == 0 ? '' : round($usage->km_covered / $usage->fuel_used, 2); ?></td>
                                <?php } 
                            } ?>

                            <td><?= $total_fuel; ?></td>
                            <td><?= $total_km; ?></td>
                        </tr>
                        
                        <?php 
                        $monthCounter++;

                        if ($monthCounter % 3 == 0) { ?>
                            <tr class="table-info">
                                <th><i>Quarter <?= $quarter; ?> </i></th>
                                <?php foreach ($cars as $car) { ?>
                                    <td><?= $quarterlyTotals[$car->car_id]['fuel']; ?></td>
                                    <td><?= $quarterlyTotals[$car->car_id]['km']; ?></td>
                                    <td>
                                        <?= $quarterlyTotals[$car->car_id]['fuel'] == 0 ? '' : round($quarterlyTotals[$car->car_id]['km'] / $quarterlyTotals[$car->car_id]['fuel'], 2); ?>
                                    </td>
                                <?php } ?>
                                <td><?= $overallQuarterFuel; ?></td>
                                <td><?= $overallQuarterKm; ?></td>
                            </tr>
                            <tr><th></th></tr>
                            <?php 
                            foreach ($quarterlyTotals as &$totals) {
                                $totals['fuel'] = 0;
                                $totals['km'] = 0;
                            }
                            unset($totals);
                            $overallQuarterFuel = 0;
                            $overallQuarterKm = 0;
                            $quarter++;
                        }
                    } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function export_to_excel(month){
            var this_month = document.getElementById("summary_name").value;
            // var message = this_month + ' roaster';
            $("#myTable").table2excel({
                exclude: ".no-export", // Add class 'no-export' to elements you want to exclude from export
                filename: this_month, // Name of the Excel file
                fileext: ".xls", // File extension (".xls" for Excel 2003 or older, ".xlsx" for Excel 2007 or newer)
                preserveColors: true
              });
        }
</script>
