<?php $this->load->helper('menu_helper'); ?>
<div class="card">
	<div class="card-body">
	<center><h3 class="card-title">Menu book for <b> <?= $attributes['ward']; ?></b> on <b><?= $attributes['date']; ?></b></h3></center>

		<form method="post" id="new_book_form">
			<input type="date" name="date" value="<?= $attributes['date']; ?>" hidden>
			<input type="text" name="location_id" value="<?= $attributes['location']; ?>" hidden>
			<input type="text" name="ward" value="<?= $attributes['ward']; ?>" hidden>
			<?php 
				$beds = $menus;
				$breakfast = $this->menu->getBreakfast();
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
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php

					//we can check the name of ward and decide what to do with the beds 
					$Ward_beds = $this->menu->getWardBeds($attributes['location']);

					foreach($Ward_beds as $bed){
						$menu = getBedOccupyInfo($beds,$bed->id); 
						echo "<tr>";
						if($menu){ ?>
							<td><?= $menu->name; ?></td>
							<td><?= $menu->patient_id; ?></td>
							<td><?= $menu->names; ?></td>
							<td> <?= $this->menu->get_menu_name($menu->Breakfast); ?></td>
							<td><?= $this->menu->get_menu_name($menu->before_luch); ?></td>
							<td><?= $this->menu->get_menu_name($menu->lunch); ?></td>
							<td><?= $this->menu->get_menu_name($menu->before_dinner); ?></td>
							<td><?= $this->menu->get_menu_name($menu->dinner); ?></td>
							<td><?= $this->menu->get_menu_name($menu->after_dinner); ?></td>
							<td><button type="button" class="btn btn-secondary" onclick="showPresentMenu(<?php echo $menu->id; ?>)"><i class="bi bi-eye"></i></button></td>
						<?php }else{ 
							$new_data = json_encode(array("bed_name" => $bed->name,
										"date" => $attributes['date'],
										"bed_id" => $bed->id,
										"location_id" => $attributes['location'],
										"ward" => $attributes['ward'] 
									));
							
							// print_r($new_data);
							?>
							<td><?= $bed->name; ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><button type="button" class="btn btn-secondary" onclick="showNewMenu(<?php  echo htmlspecialchars($new_data); ?>)"><i class="bi bi-eye"></i></button></td>
						<?php }
						echo "</tr>";
					} ?>
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
						<th>Action</th>
					</tr>
				</tfoot>
			</table>
		</form>
	</div>
</div>