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

					//here we are going to loop by menu not by beds 

						foreach ($beds as $menu) { ?>
							<tr>
								<td><?= $menu->name; ?></td>
								<td><?= $menu->patient_id; ?></td>
								<td><?= $menu->names; ?></td>
								<td> <?= $this->menu->get_menu_name($menu->Breakfast); ?></td>
								<td><?= $this->menu->get_menu_name($menu->before_luch); ?></td>
								<td><?= $this->menu->get_menu_name($menu->lunch); ?></td>
								<td><?= $this->menu->get_menu_name($menu->before_dinner); ?></td>
								<td><?= $this->menu->get_menu_name($menu->dinner); ?></td>
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
				</tfoot>
			</table>
		</form>
	</div>
</div>