<div class="card">
  <div class="card-body">
    <div class="card-title">Weekly Attendance Report</div>
      <!-- Settings Form -->
        <form id="attendance_report">
            <div class="row mb-3">
              <label for="year" class="col-sm-2 col-form-label">Select Year</label>
            <div class="col-sm-4">
              <select class="form-control" name="year" id="year" onchange="autogenerateWeeks()">
                <?php
                  $year = 2020;
                  while ($year < date("Y")){
                    $year++;
                    if($year == date('Y')){ ?>
                      <option selected><?= $year; ?></option>
                   <?php }else{
                ?>
                <option><?= $year; ?></option>
                <?php } } ?>
              </select>
            </div>
            <label for="week" class="col-sm-2 col-form-label">Select Week</label>
            <div class="col-sm-4">
              <select class="form-control" name="week">
                <!-- here weeks options will be populated dynamically -->
              </select>
            </div>
            </div>
            <div class="row mb-3">
              <label for="week" class="col-sm-3 col-form-label">Department</label>
              <?php 
                 $departments = $this->attendance->departments();
              ?>
            <div class="col-sm-5">
              <select class="form-control" id="department" name="department">
                <?php 
                  foreach($departments as $department){?>
                    <option value="<?= $department->department_id; ?>"><?= $department->department_name; ?></option>
                  <?php }
                ?>
              </select>
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary" onclick="create_weekly_attendance_report(event)">create</button>
            </div>
            </div>
        </form>
          <!-- End of performance report -->
  </div>
</div>