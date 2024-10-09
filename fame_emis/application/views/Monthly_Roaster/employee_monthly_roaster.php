<div class="card">
  <div class="card-body">
    <div class="card-title">Generate Monthly Roaster summary</div>
      <!-- Settings Form -->
        <form id="employee_roster_summary">
            <div class="row mb-3">
              <label for="year" class="col-sm-2 col-form-label">Select Year</label>
              <div class="col-sm-3">
                <select class="form-control" id="year_selected" name="year">
                  <?php
                    $year = date("Y");
                    $i = $year;
                    for($i;$i<$year+2;$i++){
                  ?>
                  <option><?php echo $i; ?></option>
                  <?php }; ?>
                </select>
              </div>

              <label for="year" class="col-sm-2 col-form-label">Select Month</label>
              <div class="col-sm-5">
                <select class="form-control" id="month" name="month">
                  <?php
                    $year = date("Y");
                    for($i=1;$i<=12;$i++){
                      $month = date("F", mktime(0, 0, 0, $i, 1, $year));
                      if ($month == date('F', strtotime('+1 month'))) {?>
                        <option selected><?php echo $month; ?></option>
                      <?php }else{?>
                        <option ><?php echo $month; ?></option>                
                  <?php }}; ?>
                </select>
              </div>
          </div>
          <div class="row mb-3">
            <label for="roster_type" class="col-sm-3 col-form-label">Select Roster Type</label>
            <div class="col-sm-5">
              <select class="form-control" name="roster_type">
                <option value="1">My Roster</option>
                <option value="2">Department Roster</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <center>
              <div class="col-sm-2">
                <button type="button" class="btn btn-primary" onclick="employee_monthly_roster(event)">create</button>
              </div>
            </center>
          </div>
        </form>
          <!-- End of performance report -->
  </div>
</div>