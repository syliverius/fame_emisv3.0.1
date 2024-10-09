<div class="card">
	<div class="card-body">
		<center><h3 class="card-title">Patient Menu Book Report for <b> ALL WARDS </b> Between  <b><?= $attributes['start_date']; ?></b> And <b><?= $attributes['end_date']; ?></b></h3></center>

		<table class="table table-bordered border-primary text-center">
				<thead>
				<tr>
					<th colspan="2">Ward</th>
					<th>Break Fast</th>
					<th>Before Lunch</th>
					<th>Lunch</th>
					<th>Before dinner</th>
					<th>Dinner</th>
					<th>After Dinner</th>
				</tr>
			</thead>
			<tbody>

				<?php 

					$wards = ['Surgical Ward','Ward One','Maternity Ward'];

					
					$general_breakfast_total = 0;$general_breakfast_sum = 0;$general_before_lunch_total = 0;$general_before_lunch_sum = 0;
					$general_lunch_total = 0;$general_luch_sum = 0;$general_before_dinner_total = 0;$general_before_dinner_sum = 0;
					$general_dinner_total = 0;$general_dinner_sum = 0;$general_after_dinner_total = 0;$general_after_dinner_sum = 0;

					  foreach($wards as $ward){
						$breakfast_total = 0;$breakfast_sum = 0;$before_lunch_total = 0;$before_lunch_sum = 0;
						$lunch_total = 0;$luch_sum = 0;$before_dinner_total = 0;$before_dinner_sum = 0;
						$dinner_total = 0;$dinner_sum = 0;$after_dinner_total = 0;$after_dinner_sum = 0;
						foreach($menus as $menu){
							if($menu->breakfast && $menu->ward == $ward){
								$breakfast_total = $breakfast_total + 1;
								$breakfast_sum = $breakfast_sum + ($this->menu->get_menu_amount($menu->breakfast));
							}

							if($menu->before_luch && $menu->ward == $ward){
								$before_lunch_total = $before_lunch_total + 1;
								$before_lunch_sum = $before_lunch_sum + ($this->menu->get_menu_amount($menu->before_luch));
							}

							if($menu->lunch && $menu->ward == $ward){
								$lunch_total = $lunch_total + 1;
								$luch_sum = $luch_sum + ($this->menu->get_menu_amount($menu->lunch));
							}

							if($menu->before_dinner && $menu->ward == $ward){
								$before_dinner_total = $before_dinner_total + 1;
								$before_dinner_sum = $before_dinner_sum + ($this->menu->get_menu_amount($menu->before_dinner));
							}

							if($menu->dinner && $menu->ward == $ward){
								$dinner_total = $dinner_total + 1;
								$dinner_sum = $dinner_sum + ($this->menu->get_menu_amount($menu->dinner));
							}

							if($menu->after_dinner && $menu->ward == $ward){
								$after_dinner_total = $after_dinner_total + 1;
								$after_dinner_sum = $after_dinner_sum + ($this->menu->get_menu_amount($menu->after_dinner));
							}
						} ?>

						<tr>
							<th rowspan="3"><?= $ward; ?></th>
							<td>Total</td>
							<td><?= $breakfast_total; ?></td>
							<td><?= $before_lunch_total; ?></td>
							<td><?= $lunch_total; ?></td>
							<td><?= $before_dinner_total; ?></td>
							<td><?= $dinner_total; ?></td>
							<td><?= $after_dinner_total; ?></td>
						</tr>
						<tr>
							<td>Amount</td>
							<td><?= number_format($breakfast_sum); ?></td>
							<td><?= number_format($before_lunch_sum); ?></td>
							<td><?= number_format($luch_sum); ?></td>
							<td><?= number_format($before_dinner_sum); ?></td>
							<td><?= number_format($dinner_sum); ?></td>
							<td><?= number_format($after_dinner_sum); ?></td>
						</tr>
						<tr>
							<td><b>Total Amount</b></td>
							<td class="text-center" colspan="6"><b><?= number_format($breakfast_sum+$before_lunch_sum+$luch_sum+$before_dinner_sum+$dinner_sum+$after_dinner_sum); ?></b></td>
						</tr>
						<?php 
							$general_breakfast_sum += $breakfast_sum;
							$general_before_lunch_sum += $before_lunch_sum;
							$general_luch_sum += $luch_sum;
							$general_before_dinner_sum += $before_dinner_sum;
							$general_dinner_sum += $dinner_sum;
							$general_after_dinner_sum += $after_dinner_sum;

					}
				?>
				<tr>
					<td colspan="2" class="text-center"><b>Overall Amount</b></td>
					<td colspan="6" class="text-center"><b><?= number_format($general_breakfast_sum + $general_before_lunch_sum + $general_luch_sum + $general_before_dinner_sum + $general_dinner_sum + $general_after_dinner_sum); ?></b></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>