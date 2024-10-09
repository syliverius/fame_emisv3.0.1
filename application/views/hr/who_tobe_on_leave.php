<div class="card">
  <div class="card-body">
    <div class="card-title">Create report of employee Who to be on leave between the specified dates</div>
    <!-- Settings who to be on leave form -->
    <form id="to_be_on_leave_form">
      <div id="response_message"></div>
      <div class="row">
        <label for="input_file" class="col-sm-2 col-form-label">Start Date</label>
        <div class="col-sm-3">
          <input class="form-control" type="date"  name="start_date" min="<?php echo date("Y-m-d"); ?>">
        </div>
        <label for="input_file" class="col-sm-2 col-form-label">End Date</label>
        <div class="col-sm-3">
          <input class="form-control" type="date" name="end_date" min="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-primary" onclick="who_to_be_on_leave()">Create</button>
        </div>
      </div>
    </form>
  <!-- End of setting who to be on leave  -->
  </div>
</div>
<!-- here we'll insert the report -->
<div id="tobeonleave_report"></div>