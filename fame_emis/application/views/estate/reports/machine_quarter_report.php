<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-24
 * @description Here we display all estates reports
 * @license     Rwazi.co.tz

-->

<div class="card">
	<div class="card-body">
		<h3 class="card-title">Machines & Generators Fuel Purchases and Consumption for year <b><i><?= $year; ?></i></b></h3>

		<!-- we retrieve data from the db by quoter and must be submitted in total/select by total -->
		<?php 
		$data_consumption = $this->estate->getFuelConsumption($year);
		$data_purchases = $this->estate->getFuelPurchases($year);

		if($data_consumption->num_rows() > 0 || $data_purchases->num_rows() > 0 ){ 
			$data = $data_consumption->result();
			$data_purchase = $data_purchases->result();
			?>

		<table class="table table-bordered border-primary text-center table-hover">
			<thead class="table-danger">
				<tr>
					<th></th>
					<th>PURCHASES</th>
					<th>CONSUMPTION</th>
				</tr>
			</thead>
			<tbody>
		<?php $quartersArray = array(
				    'Q1' => array('January', 'February', 'March'),
				    'Q2' => array('April', 'May', 'June'),
				    'Q3' => array('July', 'August', 'September'),
				    'Q4' => array('October', 'November', 'December')
				);
		$plotting_data = [];
		foreach($quartersArray as $quarter => $q1_months){
			$total_consumed = 0;
			$total_purchased = 0;
			foreach($q1_months as $month){
				foreach($data as $item){
					if($month == $item->month_name){
						$total_consumed += $item->amount_used;
					}
				}

				foreach($data_purchase as $purchase){
					if($month == $purchase->month_name){
						$total_purchased += $purchase->amount;
					}
				}

			} ?>
			<tr>
				<td><b><?= $quarter; ?></b></td>
				<td><?= $total_purchased; ?></td>
				<td><?= $total_consumed; ?></td>
			</tr>

		<?php 
			$plotting_data[] = array('quarter' => $quarter,
					'total_purchased' => $total_purchased,
					'total_consumed' => $total_consumed
				);
		} ?>
		</tbody>
	</table>
	<br />
	<h3 class="card-title">Total Fuel Purchased and Total Consumed vs Quarters</h3>
    <div id="quarter_graph" style="min-height: 400px;" class="echart"></div>

	<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('quarter_graph'));
    var data = <?php echo json_encode($plotting_data); ?>;
    var quarters = data.map(item => item.quarter);

    var options = {
        title: {
            text: ''
        },
        tooltip: {},
        xAxis: {
            type: 'category',
            data: quarters
        },
        yAxis: {
            type: 'value',
            position: 'left', // Align to the left side
        },
        legend: {
            data: ['Total Fuel Purchased', 'Total Fuel Consumed']
        },
        series: [
            {
                name: 'Total Fuel Purchased',
                type: 'bar',
                data: data.map(item => item.total_purchased),
            },
            {
                name: 'Total Fuel Consumed',
                type: 'bar',
                data: data.map(item => item.total_consumed)
            }
        ]
    };
    // Render the chart
    myChart.setOption(options);
</script>

		<?php }else{
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, there is no data for the selected year <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		} ?>
	</div>
</div>