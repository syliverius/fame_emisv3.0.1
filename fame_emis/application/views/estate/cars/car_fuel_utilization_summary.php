<div class="card">
  <div class="card-body">
    <div class="card-title">Create a report of Cars fuel utilization annually</div>
      <!-- Settings Form -->
        <form id="car_annual_report_form" method="post">
            <div class="row mb-3">
              <label for="year" class="col-sm-2 col-form-label">Select Year</label>
              <div class="col-sm-3">
                <select class="form-control" id="year_selected" name="year" id="year">
                  <?php
                    $current_year = date('Y');
                    for($year = 2022;$year <= $current_year; $year++){
                  ?>
                  <option value="<?= $year; ?>"><?= $year; ?></option>
                  <?php }; ?>
                </select>
              </div>
            <div class="col-sm-2">
              <button type="button" class="btn btn-primary" onclick="create_car_report(event)">create</button>
            </div>
          </div>
        </form>
          <!-- End of Electricity usage Form -->
  </div>
</div>