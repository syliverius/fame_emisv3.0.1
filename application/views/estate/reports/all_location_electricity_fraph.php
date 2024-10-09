<?php $this->load->helper('estate_helper'); ?>
<div class="card">
    <div class="card-body">
        <h3 class="card-title text-center"><b><i>Electricity Usage for all locations for year <?= $year; ?></i></b></h3>
        <br />

        <?php
            $check_if_data_exists = $this->estate->check_All_location_electricity_data($year);
            if ($check_if_data_exists->num_rows() <= 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, there is no data for the selected year <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }else{ ?>

                <div id="electricity_chart" style="min-height: 500px;" class="echart"></div>
                <?php 

                $locations = $this->estate->getAllElectricityLocation();
                $data = $check_if_data_exists->result();
                $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                $december_Data = $this->estate->getPreviousYearDecemberUnits(($year-1));

                $all_months_data = [];

                foreach($locations as $loc) {
                    foreach($months as $mon){
                        $all_months_data[$loc->name][$mon] = 0;
                    }
                }

                $yearDataArray = [];
                foreach($data as $row){
                    $yearDataArray[$row->name][$row->month] = $row->units_recorded;
                }


                foreach($data as &$raw){
                    $month = $raw->month;
                    $location = $raw->name;
                    $units_recorded = $raw->units_recorded;
                    if($month == "January"){
                        $december_units = returnsDecemberUnits($location,$december_Data);
                        if($december_units <= 0){
                            $units = 0 ;
                        }else{
                            $units = round($units_recorded - $december_units,1);
                        }
                    }else{
                        $prev_month = getPreviousMonth($month);
                        if(isset($yearDataArray[$location][$prev_month])){
                        $prev_month_units = $yearDataArray[$location][$prev_month];
                        }else{
                            $prev_month_units = 0;
                        }
                        if($prev_month_units <= 0){
                            $units = 0;
                        }else{
                           $units = round(($units_recorded - $prev_month_units), 1); 
                        }
                    }

                    if($units <= 0){
                        $units = 0; 
                    }

                    $raw->units_recorded = $units;
                } 


                //we need to find units deffence and embbed them as units recorded before we go any 

                $location_names = extractLocationsNames($locations);
                

                $resultantArray = [];

                foreach ($months as $month) {
                    $result = ['units' => $month];
                    foreach ($location_names as $loc){
                        $result[$loc] = 0;
                    }

                    $resultantArray [] = $result;
                }

                foreach ($data as $record) {
                   $month = $record->month;
                   $location = $record->name;
                   $units = $record->units_recorded;

                   foreach($resultantArray as &$result){
                     if ($result["units"] === $month) {
                        $result[$location] = $units;
                        break;
                    }
                   }
                }

                $plotting_data = array_map(function($item) {
                return (object)$item;
                    }, $resultantArray);
            }
        ?>

        <script type="text/javascript">
            var myChart = echarts.init(document.getElementById('electricity_chart'));
            var option = {
                tooltip: {},
                xAxis: { type: 'category' },
                yAxis: {},
                series: <?php echo json_encode(array_map(function($location) {
                    return ["name" => $location, "type" => 'bar', "encode" => ["x" => 'units', "y" => $location],"barWidth => 20"];
                }, $location_names)); ?>,
                legend: {
                    data: <?php echo json_encode($location_names); ?>
                },
                dataset: {
                    source: <?php echo json_encode($plotting_data); ?>
                },
                 grid: {
                    left: '3%',
                    right: '3%',
                    bottom: '3%',
                    containLabel: true
                },
                dataZoom: [
                    {
                        type: 'slider',
                        xAxisIndex: 0,
                        filterMode: 'empty'
                    }
                ]
            };
            myChart.setOption(option);
        </script>
    </div>
</div>