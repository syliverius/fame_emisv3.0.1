<?php $this->load->helper('estate_helper'); ?>
<div class="card">
    <div class="card-body">
        <h3 class="card-title text-center"><b><i>Car Fuel Consumption Comparison for year <?= $year; ?></i></b></h3>
        <br />
        <?php
        $check_existence = $this->estate->check_All_cars_data($year);
        if ($check_existence->num_rows() > 0) { ?>
            <div id="car_fuel_chart" style="min-height: 400px;" class="echart"></div>
        	<?php 
        		//here first we create dimensions of which is car name
        	$all_cars = $this->estate->getAllCars();

        	$data = $check_existence->result();
        	$cars_names = extractCarNames($all_cars);
        	$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];


        	$resultArray = [];

			foreach ($months as $month) {
			    $result = ["Liters" => $month];
			    
			    foreach ($cars_names as $carName) {
			        $result[$carName] = 0;
			    }
			    
			    $resultArray[] = $result;
			}

			foreach ($data as $record) {
			    $month = $record->month;
			    $carName = $record->name;
			    $fuelUsed = $record->fuel_used;

			    foreach ($resultArray as &$result) {
			        if ($result["Liters"] === $month) {
			            $result[$carName] = $fuelUsed;
			            break;
			        }
			    }
			}

			$plotting_data = array_map(function($item) {
			    return (object)$item;
			}, $resultArray);
			?>

			<script type="text/javascript">
			    var myChart = echarts.init(document.getElementById('car_fuel_chart'));
			    var option = {
			        tooltip: {},
			        xAxis: { type: 'category' },
			        yAxis: {},
			        series: <?php echo json_encode(array_map(function($carName) {
			            return ["name" => $carName, "type" => 'bar', "encode" => ["x" => 'Liters', "y" => $carName]];
			        }, $cars_names)); ?>,
			        legend: {
			            data: <?php echo json_encode($cars_names); ?>
			        },
			        dataset: {
			            source: <?php echo json_encode($plotting_data); ?>
			        }
			    };
			    myChart.setOption(option);
			</script>

			<!-- here we will create bar graph for km covered by each car every month -->
			<br /> <br /><br />

			<h3 class="card-title text-center"><b><i>Car Km Covered Comparison for year <?= $year; ?></i></b></h3>
            <div id="car_km_chart" style="min-height: 400px;" class="echart"></div>
			<?php 
			$resultArray = [];
			foreach ($months as $month) {
			    $result = ["Km" => $month];
			    
			    foreach ($cars_names as $carName) {
			        $result[$carName] = 0;
			    }
			    
			    $resultArray[] = $result;
			}

			foreach ($data as $record) {
			    $month = $record->month;
			    $carName = $record->name;
			    $km_covered = $record->km_covered;

			    foreach ($resultArray as &$result) {
			        if ($result["Km"] === $month) {
			            $result[$carName] = $km_covered;
			            break;
			        }
			    }
			}

			$plotting_data = array_map(function($item) {
			    return (object)$item;
			}, $resultArray);
			?>

			<script type="text/javascript">
			    var myChart = echarts.init(document.getElementById('car_km_chart'));
			    var option = {
			        tooltip: {},
			        xAxis: { type: 'category' },
			        yAxis: {},
			        series: <?php echo json_encode(array_map(function($carName) {
			            return ["name" => $carName, "type" => 'bar', "encode" => ["x" => 'km', "y" => $carName]];
			        }, $cars_names)); ?>,
			        legend: {
			            data: <?php echo json_encode($cars_names); ?>
			        },
			        dataset: {
			            source: <?php echo json_encode($plotting_data); ?>
			        }
			    };
			    myChart.setOption(option);
			</script>


        <?php } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, there is no data for the selected year <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
        ?>
    </div>
</div>
