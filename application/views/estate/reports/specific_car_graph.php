<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-14
 * @description We will draw the graph of a specific car selected
 * @license     Open Source

-->
<?php 
    $carInfo = $this->estate->getCarInfo($data['car']);
?>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Fuel consumption and KM covered by <b><i><?= $carInfo->name."(".$carInfo->registration_number.")"; ?></i></b></h3>
        <br />
        <?php
            $check_existence = $this->estate->check_car_data($data);
            if ($check_existence->num_rows() > 0) { ?>
                <div id="car_chart" style="min-height: 400px;" class="echart"></div>
                    <?php 
                        
                        $car_coverage = $check_existence->result(); 
                        $car_data = [];
                        foreach($car_coverage as $car){
                            $car_data_monthly = [
                                    'month' => $car->month,
                                    'fuel_use' => floatval($car->fuel_used),
                                    'km_covered' => floatval($car->km_covered)
                                ];

                                $car_data[] = $car_data_monthly;
                        }
                        $object_data = json_encode($car_data);
                    ?>
    

                <script type="text/javascript">
                    var myChart = echarts.init(document.getElementById('car_chart'));
                    var data = <?php echo $object_data; ?>;
                    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                    var completeData = months.map(month => {
                    var dataPoint = data.find(d => d.month === month);
                    return dataPoint || { month, liters: 0, km: 0 };
                        });

                        var options = {
                         title: {
                                text: 'Liters and KM vs Months'
                            },
                            tooltip: {},
                            xAxis: {
                                type: 'category',
                                data: completeData.map(item => item.month)
                            },
                            yAxis: {
                                type: 'value',
                                position: 'left', // Align to the left side
                            },
                            legend: {
                                data: ['Liters', 'KM']
                            },
                            series: [
                                {
                                    name: 'Liters',
                                    type: 'bar',
                                    data: completeData.map(item => item.fuel_use),
                                },
                                {
                                    name: 'KM',
                                    type: 'bar',
                                    data: completeData.map(item => item.km_covered)
                                    
                                }
                            ]
                        };
                    // Render the char
                    myChart.setOption(options);
                </script>
            <?php } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, there is no data for the selected year <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        ?>
    </div>
</div>
