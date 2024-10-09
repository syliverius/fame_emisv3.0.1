<div class="card">
  <div class="card-body">
    <div class="card-title">Create Electricity Usage</div>
      <!-- Settings Form -->
        <form id="electricity_usage_form" method="post">
            <div class="row mb-3">
              <label for="year" class="col-sm-2 col-form-label">Select Year</label>
              <div class="col-sm-3">
                <select class="form-control" id="year_selected" name="year">
                  <?php
                    $year = date("Y")-1;
                    $i = $year;
                    for($i;$i<$year+2;$i++){
                  ?>
                  <option><?php echo $i; ?></option>
                  <?php }; ?>
                </select>
              </div>

              <label for="year" class="col-sm-2 col-form-label">Select Month</label>
              <div class="col-sm-3">
                <select class="form-control" id="month" name="month">
                  <?php
                    $year = date("Y");
                    for($i=1;$i<=12;$i++){
                      $month = date("F", mktime(0, 0, 0, $i, 1, $year));
                      if ($month == date('F', strtotime('-1 month'))) {?>
                        <option selected><?php echo $month; ?></option>
                      <?php }else{?>
                        <option ><?php echo $month; ?></option>                
                  <?php }}; ?>
                </select>
              </div>

            <div class="col-sm-2">
              <button type="button" class="btn btn-primary" onclick="create_usage_form(event)">create</button>
            </div>
          </div>
        </form>
          <!-- End of Electricity usage Form -->
  </div>
</div>