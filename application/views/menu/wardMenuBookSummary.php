<div class="card">
	<div class="card-body">
		<center><h3 class="card-title">Patient Menu Book Report for <b> <?= $attributes['ward']; ?></b> Between  <b><?= $attributes['start_date']; ?></b> And <b><?= $attributes['end_date']; ?></b></h3></center>

		<table class="table table-bordered border-primary text-center">
				<thead>
				<tr>
					<th>Ward</th>
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
					
					//convert start and end date into dateTime objects
					$start_date = new DateTime($attributes['start_date']);
					$end_date = new DateTime($attributes['end_date']);

					//iterate through date
					$current_date = clone($start_date);
					$general_breakfast_total = 0;$general_breakfast_sum = 0;$general_before_lunch_total = 0;$general_before_lunch_sum = 0;
					$general_lunch_total = 0;$general_luch_sum = 0;$general_before_dinner_total = 0;$general_before_dinner_sum = 0;
					$general_dinner_total = 0;$general_dinner_sum = 0;$general_after_dinner_total = 0;$general_after_dinner_sum = 0;
					while($current_date <= $end_date){
						$breakfast_total = 0;$breakfast_sum = 0;$before_lunch_total = 0;$before_lunch_sum = 0;
						$lunch_total = 0;$luch_sum = 0;$before_dinner_total = 0;$before_dinner_sum = 0;
						$dinner_total = 0;$dinner_sum = 0;$after_dinner_total = 0;$after_dinner_sum = 0;
						foreach($menus as $menu){
							if($menu->breakfast && $menu->date == $current_date->format('Y-m-d')){
								$breakfast_total = $breakfast_total + 1;
								$breakfast_sum = $breakfast_sum + ($this->menu->get_menu_amount($menu->breakfast));
							}

							if($menu->before_luch && $menu->date == $current_date->format('Y-m-d')){
								$before_lunch_total = $before_lunch_total + 1;
								$before_lunch_sum = $before_lunch_sum + ($this->menu->get_menu_amount($menu->before_luch));
							}

							if($menu->lunch && $menu->date == $current_date->format('Y-m-d')){
								$lunch_total = $lunch_total + 1;
								$luch_sum = $luch_sum + ($this->menu->get_menu_amount($menu->lunch));
							}

							if($menu->before_dinner && $menu->date == $current_date->format('Y-m-d')){
								$before_dinner_total = $before_dinner_total + 1;
								$before_dinner_sum = $before_dinner_sum + ($this->menu->get_menu_amount($menu->before_dinner));
							}

							if($menu->dinner && $menu->date == $current_date->format('Y-m-d')){
								$dinner_total = $dinner_total + 1;
								$dinner_sum = $dinner_sum + ($this->menu->get_menu_amount($menu->dinner));
							}

							if($menu->after_dinner && $menu->date == $current_date->format('Y-m-d')){
								$after_dinner_total = $after_dinner_total + 1;
								$after_dinner_sum = $after_dinner_sum + ($this->menu->get_menu_amount($menu->after_dinner));
							}
						} ?>

						<tr>
							<th><?= $current_date->format('Y-m-d'); ?></th>
							<td><?= $breakfast_total; ?></td>
							<td><?= $before_lunch_total; ?></td>
							<td><?= $lunch_total; ?></td>
							<td><?= $before_dinner_total; ?></td>
							<td><?= $dinner_total; ?></td>
							<td><?= $after_dinner_total; ?></td>
						</tr>
						<?php 
							$general_breakfast_total += $breakfast_total;
							$general_breakfast_sum += $breakfast_sum;
							$general_before_lunch_total += $before_lunch_total;
							$general_before_lunch_sum += $before_lunch_sum;
							$general_lunch_total += $lunch_total;
							$general_luch_sum += $luch_sum;
							$general_before_dinner_total += $before_dinner_total;
							$general_before_dinner_sum += $before_dinner_sum;
							$general_dinner_total += $dinner_total;
							$general_dinner_sum += $dinner_sum;
							$general_after_dinner_total += $after_dinner_total;
							$general_after_dinner_sum += $after_dinner_sum;

							$current_date->modify('+1 day');
					}

				?>
				
				<tr>
					<th>Total</th>
					<td><?= number_format($general_breakfast_total); ?></td>
					<td><?= number_format($general_before_lunch_total); ?></td>
					<td><?= number_format($general_lunch_total); ?></td>
					<td><?= number_format($general_before_dinner_total); ?></td>
					<td><?= number_format($general_dinner_total); ?></td>
					<td><?= number_format($general_after_dinner_total); ?></td>
				</tr>
				<tr>
					<th>Amount</th>
					<td><?= number_format($general_breakfast_sum); ?></td>
					<td><?= number_format($general_before_lunch_sum); ?></td>
					<td><?= number_format($general_luch_sum); ?></td>
					<td><?= number_format($general_before_dinner_sum); ?></td>
					<td><?= number_format($general_dinner_sum); ?></td>
					<td><?= number_format($general_after_dinner_sum); ?></td>
				</tr>

				<tr>
					<th colspan="3">Total Amount</th>
					<td colspan="4"><?= number_format($general_breakfast_sum+$general_before_lunch_sum+$general_luch_sum+$general_before_dinner_sum+$general_dinner_sum+$general_after_dinner_sum); ?></td>
				</tr>

			</tbody>
		</table>
	</div>
</div>