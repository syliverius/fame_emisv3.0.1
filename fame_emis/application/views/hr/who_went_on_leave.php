<!-- who went on leave section -->
<div class="card">
  <div class="card-body">
    <div class="card-title">Create a report of employee who went on leave between the specified dates</div>
    
    <form method="post" id="who_went_on_leave_form" class="row g-3">
    <!-- print error or success message -->
      <div id="response_message"></div>

      <div class="row mb-3">
        <label for="input_file" class="col-sm-2 col-form-label">Start Date</label>
        <div class="col-sm-3">
          <input class="form-control" type="date"  name="start_date" id="start_date">
        </div>
        <label for="input_file" class="col-sm-2 col-form-label">End Date</label>
        <div class="col-sm-3">
          <input class="form-control" type="date" name="end_date"  max="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-primary" onclick="who_went_on_leave()">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- the report response will be captured here -->
<div id="retrieved_report"></div>

