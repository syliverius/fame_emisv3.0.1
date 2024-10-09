<div class="card">
  <div class="card-body">
    <div class="card-title">Roaster Report </div>
    <!-- Settings Form -->
      <form id="department_roaster_report">
        <div id="report_response_message"></div>
        <div class="row mb-3">

          <label for="year" class="col-sm-2 col-form-label">Select Year</label>
            <div class="col-sm-3">
              <select class="form-control" id="year_selected" name="year_selected">
                <?php
                  $year = 2019;
                  while ($year < date("Y")){
                  $year++;
                ?>
                <option><?php echo $year; ?></option>
                <?php }; ?>
              </select>
            </div>

            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary" name="dept_report_btn" id="dept_report_btn">create</button>
            </div>

        </div>
      </form>
  </div>
</div>
<div id="returned_result"></div>