<?php $this->load->helper('menu_helper'); ?>
<div class="card">
	<div class="card-body">
	<center><h3 class="card-title">Menu book for <b> <?= $attributes['ward']; ?></b> on <b><?= $attributes['date']; ?></b></h3></center>

		<form method="post" id="new_book_form">
			<input type="date" name="date" value="<?= $attributes['date']; ?>" hidden>
			<input type="text" name="location_id" value="<?= $attributes['location']; ?>" hidden>
			<input type="text" name="ward" value="<?= $ward = $attributes['ward']; ?>" hidden>
			<?php 
				$beds = $this->menu->getWardBeds($attributes['location']);
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
					</tr>
				</thead>
				<tbody>
					<?php
					//get menu records for yesterday if found input if not fill nill
					$yesterday = new DateTime($attributes['date']);
					$yesterday->modify('-1 day');
					$yesterday = $yesterday->format('Y-m-d');
					$info = $this->menu->getyesterdayPatientInfo($yesterday,$ward);
					//and on discharge leave the bed bed empty, for extra usage 
						if($info->num_rows() <= 0){
						foreach ($beds as $bed) { ?>
							<tr>
								<td><input type="text" name="bed" class="form-control text-center" value="<?= $bed->name;?>" readonly> </td>
								<td><input type="text" name="<?php echo $bed->name.'_patient_id'; ?>" class="form-control text-center" ></td>
								<td><input type="text" name="<?php echo $bed->name.'_patient_name'; ?>" class="form-control text-center" ></td>
								<td>
									<select name="<?php echo $bed->name.'_breakfast'; ?>" class="form-control">
										<option value=""></option>
										<?php
											foreach($breakfast as $fast){ ?>
												<option value="<?= $fast->id; ?>"><?= $fast->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_before_lunch'; ?>" class="form-control">
										<option value=""></option>
										<?php
										$extra = $this->menu->getExtra();
											foreach($extra as $extra){ ?>
												<option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_lunch'; ?>" class="form-control">
										<option value=""></option>
										<?php
										$lunch = $this->menu->getLunch();
											foreach($lunch as $lunch){ ?>
												<option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_before_dinner';?>" class="form-control">
										<option value=""></option>
										<?php
										$extra = $this->menu->getExtra();
											foreach($extra as $item){ ?>
												<option value="<?= $item->id; ?>"><?= $item->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_dinner';?>" class="form-control">
										<option value=""></option>
										<?php
										$lunch = $this->menu->getLunch();
											foreach($lunch as $lunch){ ?>
												<option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_after_dinner';?>" class="form-control">
										<option value=""></option>
										<?php
											foreach($extra as $extra){ ?>
												<option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
										<?php }
										?>
									</select>
								</td>
							</tr>
					<?php } }else{ 

						foreach ($beds as $bed) { ?>
							<tr>
								<td><input type="text" name="bed" class="form-control text-center" value="<?= $bed->name;?>" readonly> </td>
								<td><input type="text" name="<?php echo $bed->name.'_patient_id'; ?>" class="form-control text-center" value="<?= getPatientId($info,$bed->id); ?>"></td>
								<td><input type="text" name="<?php echo $bed->name.'_patient_name'; ?>" class="form-control text-center" value="<?= getPatientName($info,$bed->id); ?>"></td>
								<td>
									<select name="<?php echo $bed->name.'_breakfast'; ?>" class="form-control">
										<option value=""></option>
										<?php
											foreach($breakfast as $fast){ ?>
												<option value="<?= $fast->id; ?>"><?= $fast->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_before_lunch'; ?>" class="form-control">
										<option value=""></option>
										<?php
										$extra = $this->menu->getExtra();
											foreach($extra as $extra){ ?>
												<option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_lunch'; ?>" class="form-control">
										<option value=""></option>
										<?php
										$lunch = $this->menu->getLunch();
											foreach($lunch as $lunch){ ?>
												<option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_before_dinner';?>" class="form-control">
										<option value=""></option>
										<?php
										$extra = $this->menu->getExtra();
											foreach($extra as $item){ ?>
												<option value="<?= $item->id; ?>"><?= $item->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_dinner';?>" class="form-control">
										<option value=""></option>
										<?php
										$lunch = $this->menu->getLunch();
											foreach($lunch as $lunch){ ?>
												<option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="<?php echo $bed->name.'_after_dinner';?>" class="form-control">
										<option value=""></option>
										<?php
											foreach($extra as $extra){ ?>
												<option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
										<?php }
										?>
									</select>
								</td>
							</tr>
					<?php }


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
					</tr>
				</tfoot>
			</table>
			<center><button class="btn btn-primary" name="submit_btn" onclick="submit_new_book(event)">Submit</button></center>
		</form>
	</div>
</div>