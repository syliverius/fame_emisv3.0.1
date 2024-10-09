<div class="card">
  <div class="card-body">
    <div class="card-title">Generate Department Monthly Roster</div>
      <!-- Settings Form -->
        <form id="dept_roster_summary">
            <div class="row mb-3">
              <label for="year" class="col-sm-2 col-form-label">Select Year</label>
              <div class="col-sm-4">
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
              <div class="col-sm-4">
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
              <label for="department" class="col-sm-3 col-form-label">Choose Department</label>
                <div class="col-sm-4">
                  <select class="form-control"  name="department_name">
                    <?php 
                    $departments = $this->attendance->departments();
                  foreach($departments as $department){?>
                    <option value="<?= $department->department_name; ?>"><?= $department->department_name; ?></option>
                  <?php } ?>
                  </select>
                </div>
            </div class="row mb-3">
            <center>
              <div class="col-sm-3">
                <button type="button" class="btn btn-primary" onclick="generate_dept_roster(event)">create</button>
              </div>
            </center>
            <div>
              
            </div>
        </form>
          <!-- End of performance report -->
  </div>
</div>