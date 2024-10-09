<div class="card">
	<div class="card-body">
		<div class="card-title">YOUR <?= date('Y'); ?> ACTIVITY SUMMARY</div>
		<table class="table table-bordered border-primary text-center">
			<thead>
				<tr>
					<th>TOPIC</th>
					<th colspan="4">DESCRIPTION</th>
			</tr>
			</thead>
			<tbody>
				<tr>
					<th rowspan="2">Annual Roster(<?= date('Y'); ?>)</th>
					<th colspan="1">Start date</th>
					<th colspan="1">End Date</th>
					<th colspan="1">Spent Days</th>
					<th colspan="1">Days left</th>
				</tr>
				<tr>
					<?php 
						if(isset($summary['annual_leave'])){ ?>
							<td><?= $summary['annual_leave']->start_date; ?></td>
							<td><?= $summary['annual_leave']->end_date ?></td>
							<td><?= 28-$summary['annual_leave']->days_left; ?></td>
							<td><?= $summary['annual_leave']->days_left; ?></td>
						<?php }else{ ?>
							<td><pre>unassigned</pre></td>
							<td><pre>unassigned</pre></td>
							<td>Unknown</td>
							<td>Unknown</td>
					<?php }
					?>
					
				</tr>
				<tr>
					<?php 
						$emergency_days = 0;
						$count = $this->hr->count_emergency_days($this->session->userdata('employee_id'));
						if(count($count)>0){
							foreach($count as $count){
								$emergency_days += $count->emergency_days;
							}
						}
					?>
					<th>Emergency leaves( <?= date('Y'); ?> )</th>
					<td colspan="4">Total days spent : <?= $emergency_days; ?></td>
				</tr>
				<tr>
					<?php 
				if(isset($summary['performance'])){
					?>
					<th>Performance Review(<?php echo $summary['performance']->year."/".($summary['performance']->year+1); ?>)</th>
					<td colspan="4">Jumuisho la kiwango cha alama za utendaji :<b> <?= $summary['performance']->performance_total; ?></b>  Average <b><?= $summary['performance']->wastani_utendaji_wa_jumla; ?></b></td>
				<?php }else { ?>
					<th>Performance Review(<?= (date('Y')-1)."/".date('Y'); ?>)</th>
					<td colspan="4">Jumuisho la kiwango cha alama za utendaji : <b> ... </b>Average <b>...</b></td>
				<?php } ?>
					
				</tr>
			</tbody>

		</table>
	</div>
</div>