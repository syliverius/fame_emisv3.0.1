<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.1.1
 * @since       2024-06-04
 * @description This view display uneditable menu summary for supervisors
 * @license     fameafrica.org

-->
<div class="card">
	<div class="card-body">
	<center><h3 class="card-title">Menu book for <b> <?= $attributes['ward']; ?></b> on <b><?= $attributes['date']; ?></b></h3></center>

		<form method="post" id="new_book_form">
			<input type="date" name="date" value="<?= $attributes['date']; ?>" hidden>
			<input type="text" name="location_id" value="<?= $attributes['location']; ?>" hidden>
			<input type="text" name="ward" value="<?= $attributes['ward']; ?>" hidden>
			<?php 
				$beds = $menus;
				// $breakfast = $this->menu->getBreakfast();
			?>
			<table class="table table-bordered border-primary text-center">
				<thead>
					<tr>
						<th>Bed_No</th>
						<th>Patient File</th>
						<th>Patient Names</th>
						<th>Break Fast</th>
						<th>Before Lunch</th>
						<th>Lunch</th>
						<th>Before dinner</th>
						<th>Dinner</th>
						<th>After Dinner</th>
						<th>Comments</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$breakfastCount = 0; $before_luchCount = 0; $lunchCount = 0; $before_dinnerCount = 0; $dinnerCount = 0; $after_dinnerCount = 0;
					$breakfastTotal = 0; $before_luchTotal = 0; $lunchTotal = 0; $before_dinnerTotal = 0; $dinnerTotal = 0; $after_dinnerTotal = 0;

						foreach ($beds as $menu) { ?>
							<tr>
								<td><?= $menu->name; ?></td>
								<td><?= $menu->patient_id; ?></td>
								<td><?= $menu->names; ?></td>
								<?php 
									if($menu->Breakfast){
										$breakfastCount ++;
										$breakfastTotal = $breakfastTotal+($this->menu->get_menu_amount($menu->Breakfast));
									}
								?>
								<td> <?= $this->menu->get_menu_name($menu->Breakfast); ?></td>
								<?php 
								if($menu->before_luch){
										$before_luchCount ++;
										$before_luchTotal = $before_luchTotal+($this->menu->get_menu_amount($menu->before_luch));
									}
								?>
								<td><?= $this->menu->get_menu_name($menu->before_luch); ?></td>
								<?php
								if($menu->lunch){
										$lunchCount ++;
										$lunchTotal = $lunchTotal+($this->menu->get_menu_amount($menu->lunch));
									}
								?>
								<td><?= $this->menu->get_menu_name($menu->lunch); ?></td>
								<?php
								if($menu->before_dinner){
										$before_dinnerCount ++;
										$before_dinnerTotal = $before_dinnerTotal + ($this->menu->get_menu_amount($menu->before_dinner));
									}
								 ?>
								<td><?= $this->menu->get_menu_name($menu->before_dinner); ?></td>
								<?php 
								if($menu->dinner){
										$dinnerCount ++;
										$dinnerTotal = $dinnerTotal + ($this->menu->get_menu_amount($menu->dinner));
									}
								?>
								<td><?= $this->menu->get_menu_name($menu->dinner); ?></td>
								<?php
								if($menu->after_dinner){
										$after_dinnerCount ++;
										$after_dinnerTotal = $after_dinnerTotal + ($this->menu->get_menu_amount($menu->after_dinner));
									}
								?>
								<td><?= $this->menu->get_menu_name($menu->after_dinner); ?></td>

								<td><?= $menu->comments; ?></td>
							</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Bed_No</th>
						<th>Patient File</th>
						<th>Patient Names</th>
						<th>Break Fast</th>
						<th>Before Lunch</th>
						<th>Lunch</th>
						<th>Before dinner</th>
						<th>Dinner</th>
						<th>After Dinner</th>
						<th>Comments</th>
					</tr>
					<tr>
						<th colspan="3">Total</th>
						<th><?= $breakfastCount; ?> </th>
						<th><?= $before_luchCount; ?></th>
						<th><?= $lunchCount; ?></th>
						<th><?= $before_dinnerCount; ?></th>
						<th><?= $dinnerCount; ?></th>
						<th><?= $after_dinnerCount; ?></th>
						<th></th>
					</tr>
					<tr>
						<th colspan="3">Amount</th>
						<th><?= number_format($breakfastTotal); ?></th>
						<th><?= number_format($before_luchTotal); ?></th>
						<th><?= number_format($lunchTotal); ?></th>
						<th><?= number_format($before_dinnerTotal); ?></th>
						<th><?= number_format($dinnerTotal); ?></th>
						<th><?= number_format($after_dinnerTotal); ?></th>
						<th></th>
					</tr>
					<tr>
						<th colspan="3">Grand Total</th>
						<th colspan="9"><?= number_format($breakfastTotal+$before_luchTotal+$lunchTotal+$before_dinnerTotal+$dinnerTotal+$after_dinnerTotal); ?></th>
					</tr>
				</tfoot>
			</table>
		</form>
	</div>
</div>