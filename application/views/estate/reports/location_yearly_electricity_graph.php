<?php $this->load->helper('estate_helper'); ?>
<div class="card">
    <div class="card-body">
        <h3 class="card-title text-center"><b><i>Electricity Usage for <?= $this->estate->getLocationName($info['location_id'])->name; ?> year <?= $info['year']; ?></i></b></h3>
        <br />

        <?php 

            if($info['thisYearData']->num_rows() <= 0){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, there is no data for the selected year <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }else{ ?>
                <div id="electricity_chart" style="min-height: 500px;" class="echart"></div> 
            <?php 
                $allMonths = [
                    'January' => 0,
                    'February' => 0,
                    'March' => 0,
                    'April' => 0,
                    'May' => 0,
                    'June' => 0,
                    'July' => 0,
                    'August' => 0,
                    'September' => 0,
                    'October' => 0,
                    'November' => 0,
                    'December' => 0
                ];

                $yearDataArray = [];
                foreach($info['thisYearData']->result() as $row){
                    $yearDataArray[$row->month] = $row->units_recorded;
                } 

                foreach($info['thisYearData']->result() as $raw){
                    $month = $raw->month;
                    $units_recorded = $raw->units_recorded;
                    if($month == "January"){
                        if($info['DecemberUnits'] <= 0){
                            $units = 0;
                        }else{
                            $units = round($units_recorded - $info['DecemberUnits'],1);
                        }
                    }else{
                        $prev_month = getPreviousMonth($month);
                        if($yearDataArray[$prev_month] <= 0){
                            $units = 0;
                        }else{
                        $units = round(($units_recorded - $yearDataArray[$prev_month]), 1);
                        }
                    }

                    if($units < 0){
                        $allMonths[$month] = 0; 
                    }else{
                       $allMonths[$month] = $units; 
                    }
                }

                $object_data = json_encode(array_map(function($month, $units) {
                    return ['month' => $month, 'units_recorded' => $units];
                }, array_keys($allMonths), $allMonths));
            }
            ?>

            <script type="text/javascript">
            var myChart = echarts.init(document.getElementById('electricity_chart'));
            var data = <?php echo $object_data; ?>;
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            var completeData = months.map(month => {
                var dataPoint = data.find(d => d.month === month);
                return dataPoint || { month, units_recorded: 0 };
            });

            var options = {
                title: {
                    text: 'Units utilized Per Month'
                },
                tooltip: {},
                xAxis: {
                    type: 'category',
                    data: completeData.map(item => item.month)
                },
                yAxis: {
                    type: 'value',
                    position: 'left'
                },
                legend: {
                    data: ['Units Utilized']
                },
                series: [
                    {
                        name: 'Units utilized',
                        type: 'bar',
                        data: completeData.map(item => item.units_recorded)
                    }
                ]
            };

            myChart.setOption(options);
        </script> 
    </div>
</div>
