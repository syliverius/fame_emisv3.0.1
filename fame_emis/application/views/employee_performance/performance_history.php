<div class="card">
  <div class="card-body">
    <div class="card-title">Performance Report</div>
      <!-- Settings Form -->
        <form id="performance_history">
          <input type="text" name="department_id" value="<?= $this->session->userdata('department_id'); ?>" hidden>
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
              <button type="submit" class="btn btn-primary" onclick="create_performance_report(event)">create</button>
            </div>
            </div>
        </form>
          <!-- End of performance report -->
  </div>
</div>