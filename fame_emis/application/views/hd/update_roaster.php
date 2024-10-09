<?php $this->load->helper('annual_leave_helper'); ?>
<div class="modal-header">
    <h5 class="modal-title">Edit <b><?= $employee_roaster_details['names']; ?></b> Annual Leave Information </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="row input-group mb-3">
	<div class="row input-group mb-3">
		<label for="names" class="col-sm-2 col-form-label">Full Name</label>
		<div class="col-sm-6">
        	<input type="text" class="form-control" id="names" name="names" value="<?= $employee_roaster_details['names']; ?>" readonly>
    	</div>
	</div>

	<input type="text"  name="leave_id" value="<?= $employee_roaster_details['id']; ?>" hidden>
	<div class="row input-group mb-3">
		<label for="startDate" class="col-sm-2 col-form-label">StartDate</label>
		<div class="col-sm-4">
        	<input type="date" class="form-control" name="startDate" value="<?= $employee_roaster_details['start_date']; ?>" onchange="get_end_date()" id="startDate_update">
    	</div>
    	<label for="endDate" class="col-sm-2 col-form-label">EndDate</label>
    	<div class="col-sm-4">
	        	<input type="date" class="form-control" value="<?= $employee_roaster_details['end_date']; ?>" name="endDate" id="endDate_update" readonly>
    	</div>
	</div>

	<div class="row input-group mb-3">
		<label for="selectLeaveReason" class="col-sm-2 col-form-label">Reason</label>
		<div class="col-sm-6">
	    	<select class="form-control" id="selectLeaveReason" value="" name="reason">
	    		<?php 
	    		$result = leave_options();
	    		foreach($result as $options=>$display){
	    			if($display == $employee_roaster_details['reason']){ ?>
	    				<option selected><?= $display; ?></option>
	    			<?php }else{ ?>
	    				<option><?= $display; ?></option>
	    			<?php } } ?>
	    	</select>
		</div>
	</div>
	<div class="row input-group mb-3">
		<label for="exampleTextarea1" class="col-sm-2 col-form-label">Other Comments</label>
		<div class="col-sm-8">
	    	<textarea class="form-control" id="comments" name="comments" rows="2"><?= htmlspecialchars($employee_roaster_details['comments']); ?></textarea>
		</div>
	</div>	
</div>
