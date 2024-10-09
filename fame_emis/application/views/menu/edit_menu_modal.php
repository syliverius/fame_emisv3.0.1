 <center><h3 class="card-title">Edit patient menu for bed <b><?= $info->name; ?> </b>on <b><?= $info->date; ?></b></h3></center>

<div class='modal-body row g-3'>
	<input type="date" class="form-control" name="date" value="<?= $info->date; ?>" hidden>
	<input type="number" name="menu_id" value="<?= $info->id; ?>"hidden>
	<input type="number" name="location_id" value="<?= $info->location_id; ?>" hidden>
	<input type="text" name="ward" value="<?= $info->ward; ?>" hidden>

	<div class='col-md-4'>
	    <label for='bed_name'>Bed_No </label>
	    <input type='text' class='form-control' name='bed_name' value='<?= $info->name; ?>' readonly>
	</div>

	<div class='col-md-4'>
	    <label for='file'>Patient File </label>
	    <input type='text' class='form-control' name='patient_id' value='<?= $info->patient_id; ?>'>
	</div>
	
	<div class='col-md-4'>
	    <label for='names'>Patient Names</label>
	    <input type='text' class='form-control' name='names' value='<?= $info->names; ?>'>
	</div>

	<div class='col-md-4'>
        <label for='menu'>Breakfast</label>
        <select class="form-control" name="breakfast">
			<option value=""></option>
		    <?php
		    $breakfast = $this->menu->getBreakfast();
		    if ($info->Breakfast) {
		        foreach ($breakfast as $fast) {
		            if ($fast->id == $info->Breakfast) {
		                ?>
		                <option value="<?= $fast->id; ?>" selected><?= $fast->names; ?></option>
		            <?php
		            } else {
		                ?>
		                <option value="<?= $fast->id; ?>"><?= $fast->names; ?></option>
		                <?php
		            }
		        }
		    } else {
		        ?>
		        <?php
		        foreach ($breakfast as $fast) {
		            ?>
		            <option value="<?= $fast->id; ?>"><?= $fast->names; ?></option>
		            <?php
		        }
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
		    if ($info->before_luch) {
		        foreach ($extra as $extra) {
		            if ($extra->id == $info->before_luch) {
		                ?>
		                <option value="<?= $extra->id; ?>" selected><?= $extra->names; ?></option>
		            <?php
		            } else {
		                ?>
		                <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		                <?php
		            }
		        }
		    } else {
		        ?>
		        <?php
		        foreach ($extra as $extra) {
		            ?>
		            <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		            <?php
		        }
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
		    if ($info->lunch) {
		        foreach ($lunch as $lunch) {
		            if ($lunch->id == $info->lunch) {
		                ?>
		                <option value="<?= $lunch->id; ?>" selected><?= $lunch->names; ?></option>
		            <?php
		            } else {
		                ?>
		                <option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
		                <?php
		            }
		        }
		    } else {
		        ?>
		        <?php
		        foreach ($lunch as $lunch) {
		            ?>
		            <option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
		            <?php
		        }
		    }
		    ?>
		</select>
    </div>

    <div class='col-md-4'>
        <label for='menu'>Before Dinner</label>
        <select class="form-control" name="before_dinner">
			<option value=""></option>
		    <?php
				$extra = $this->menu->getExtra();
		    if ($info->before_dinner) {
		        foreach ($extra as $extra) {
		            if ($extra->id == $info->before_dinner) {
		                ?>
		                <option value="<?= $extra->id; ?>" selected><?= $extra->names; ?></option>
		            <?php
		            } else {
		                ?>
		                <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		                <?php
		            }
		        }
		    } else {
		        ?>
		        <?php
		        foreach ($extra as $extra) {
		            ?>
		            <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		            <?php
		        }
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
		    if ($info->dinner) {
		        foreach ($lunch as $lunch) {
		            if ($lunch->id == $info->dinner) {
		                ?>
		                <option value="<?= $lunch->id; ?>" selected><?= $lunch->names; ?></option>
		            <?php
		            } else {
		                ?>
		                <option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
		                <?php
		            }
		        }
		    } else {
		        ?>
		        <?php
		        foreach ($lunch as $lunch) {
		            ?>
		            <option value="<?= $lunch->id; ?>"><?= $lunch->names; ?></option>
		            <?php
		        }
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
		    if ($info->after_dinner) {
		        foreach ($extra as $extra) {
		            if ($extra->id == $info->after_dinner) {
		                ?>
		                <option value="<?= $extra->id; ?>" selected><?= $extra->names; ?></option>
		            <?php
		            } else {
		                ?>
		                <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		                <?php
		            }
		        }
		    } else {
		        ?>
		        <?php
		        foreach ($extra as $extra) {
		            ?>
		            <option value="<?= $extra->id; ?>"><?= $extra->names; ?></option>
		            <?php
		        }
		    }
		    ?>
			</select>
    </div>

    <div class="col-md-9">
    	<label for="comment">Other Comments</label>
    	<textarea class="form-control" cols="2" name="comments"><?= $info->comments; ?></textarea>
    </div>
</div>