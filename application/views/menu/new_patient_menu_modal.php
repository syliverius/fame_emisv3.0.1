 <center><h3 class="card-title">New Patient Menu Info  for bed <b><?= $data['bed_name']; ?></b> on <b><?= $data['date']; ?></b> </h3></center>

<div class='modal-body row g-3'>
	<input type="date" class="form-control" name="date" id="menu_date" value="<?= $data['date']; ?>" hidden>
	<input type="number" name="location_id" id="location_id" value="<?= $data['location_id']; ?>" hidden>
	<input type="text" name="ward" id="menu_ward" value="<?= $data['ward']; ?>" hidden>
	<input type="text" name="bed_id" id="menu_bed_id" value="<?= $data['bed_id']; ?>" hidden>
	<div class='col-md-4'>
	    <label for='bed_name'>Bed_No </label>
	    <input type='text' class='form-control' name='bed_name' id='bed_name' value='<?= $data["bed_name"]; ?>' readonly>
	</div>

	<div class='col-md-4'>
	    <label for='file'>Patient File </label>
	    <input type='text' class='form-control' name='patient_id' value=''>
	</div>
	
	<div class='col-md-4'>
	    <label for='names'>Patient Names</label>
	    <input type='text' class='form-control' name='names' value=''>
	</div>

	<div class='col-md-4'>
        <label for='menu'>Breakfast</label>
        <select class="form-control" name="breakfast">
			<option value=""></option>
		        <?php
		        $breakfast = $this->menu->getBreakfast();
		        foreach ($breakfast as $fast) {
		            ?>
		            <option value="<?= $fast->id; ?>"><?= $fast->names; ?></option>
		            <?php
		        }
		    ?>
		</select>
    </div>

    <div class='col-md-4'>
        <label for='menu'>Before Lunch</label>
        <select class="form-control" name="before_luch">
			<option value=""></option>
		        <?php
		        $extra = $this->menu->getExtra();
		        foreach ($extra as $extra) {
		            ?>
		            <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		            <?php
		        }
		    ?>
		</select>
    </div>

    <div class='col-md-4'>
        <label for='menu'>Lunch</label>
        <select class="form-control" name="lunch">
			<option value=""></option>
		    
		        <?php
		        $lunch = $this->menu->getLunch();
		        foreach ($lunch as $lunch) {
		            ?>
		            <option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
		            <?php
		        }
		    ?>
		</select>
    </div>

    <div class='col-md-4'>
        <label for='menu'>Before Dinner</label>
        <select class="form-control" name="before_dinner" >
			<option value=""></option>
		        <?php
		        $extra = $this->menu->getExtra();
		        foreach ($extra as $extra) {
		            ?>
		            <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		            <?php
		        }
		    ?>
		</select>
    </div>

    <div class='col-md-4'>
        <label for='menu'>Dinner</label>
        <select class="form-control" name="dinner">
			<option value=""></option>
		        <?php
		        $lunch = $this->menu->getLunch();
		        foreach ($lunch as $lunch) {
		            ?>
		            <option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
		            <?php
		        }
		    ?>
			</select>
    </div>

    <div class='col-md-4'>
        <label for='menu'>After Dinner</label>
        <select class="form-control" name="after_dinner">
		<option value=""></option>
		        <?php
		        $extra = $this->menu->getExtra();
		        foreach ($extra as $extra) {
		            ?>
		            <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		            <?php
		        }
		    ?>
			</select>
    </div>

    <div class="col-md-9">
    	<label for="comment">Other Comments</label>
    	<textarea class="form-control" cols="2" name="comments"></textarea>
    </div>
</div>