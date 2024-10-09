<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-16
 * @description Here we will specify machine and generator reports requirement
 * @license     Rwazi.co.tz

-->
<?php $this->load->helper('estate_helper'); ?>
<div class="card">
  <div class="card-body">
    <div class="card-title">Create Machines and Generators Reports</div>
      <!-- Settings Form -->
        <form id="machines_form" method="post">
            <div class="row mb-3">
              <label for="year" class="col-sm-2 col-form-label">Select Year</label>
              <div class="col-sm-3">
                <select class="form-control" id="year_selected" name="year">
                  <?php
                    $i = 2022;
                    for($i; $i<=date('Y'); $i++){
                  ?>
                  <option><?php echo $i; ?></option>
                  <?php }; ?>
                </select>
              </div>

              <label for="report_name" class="col-sm-2 col-form-label">Type of Report</label>
              <div class="col-sm-3">
                <select class="form-control" id="report_name" name="report_name">
                  <?php
                    $machines_reports = machineAndGeneratorReports();
                    foreach ($machines_reports as $machine) { ?>
                      <option><?= $machine; ?></option>
                  <?php  } ?>
                </select>
              </div>

            <div class="col-sm-2">
              <button type="button" class="btn btn-primary" onclick="machine_reports(event)">create</button>
            </div>
          </div>
        </form>
          <!-- End of Electricity usage Form -->
  </div>
</div>