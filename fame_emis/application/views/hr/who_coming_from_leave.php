<div class="card">
  <div class="card-body">
    <div class="card-title">Create a report of employee Who's coming from leave between the specified dates</div>
    <!-- Settings whose coming from leave form -->
    <form id="coming_from_leave_form">
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
          <button type="submit" class="btn btn-primary" onclick="who_coming_from_leave()">Create</button>
        </div>
      </div>
    </form>
  <!-- End of setting whose coming from leave  -->
  </div>
</div>

<!-- who is coming from leave report -->
<div id="whoiscoming_report"></div>