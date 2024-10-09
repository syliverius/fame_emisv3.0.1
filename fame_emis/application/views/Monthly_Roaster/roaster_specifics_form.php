<?php $this->load->helper('estate_helper'); ?>
<div class="card">
  <div class="card-body">
    <div class="card-title">Create This Month Roaster</div>
      <!-- Settings Form -->
        <form id="department_roaster">
          <input type="text" name="department_id" value="<?= $this->session->userdata('department_id'); ?>" hidden>
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
              <div class="col-sm-3">
                <select class="form-control" id="month" name="month">
                  <?php
                    $months = getMonths();
                    foreach($months as $month){ ?>
                      <option><?= $month; ?></option>
                  <?php  }
                  ?>
                </select>
              </div>

            <div class="col-sm-2">
              <button type="button" class="btn btn-primary" onclick="generate_roaster(event)">create</button>
            </div>
          </div>
        </form>
          <!-- End of performance report -->
  </div>
</div>