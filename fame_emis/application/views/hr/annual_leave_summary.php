<div class="card">
  <div class="card-body">
    <h4 class="card-title">Department Leave Schedule </h4>
    <form method="post"  id="hr_department_summary_form" class="row g-3">
      <!-- print error or success message -->
      <div id="hr_department_summary_response"></div>
      <div class="row mb-3">
        <label for="department" class="col-sm-2 col-form-label">Choose Department</label>
        <div class="col-sm-4">
          <select class="form-control"  name="deparment">
            <?php 
              $departments = $this->attendance->departments();
              foreach($departments as $department){?>
                <option value="<?= $department->department_name; ?>"><?= $department->department_name; ?></option>
            <?php } ?>
          </select> 
        </div>

        <label for="year" class="col-sm-1 col-form-label">Year</label>
        <div class="col-sm-3">
          <select class="form-control" id="year" name="year">
            <?php
              $year = 2021;
              while ($year < date("Y")){
                $year++;
            ?>
            <option><?php echo $year; ?></option>
              <?php }; ?>
          </select>
        </div>

        <div class="col-sm-2">
          <button type="button" class="btn btn-primary" onclick="hr_department_summary()">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>

                  
<div id="hr_summary_table_data">
  <!--in here we will insert all the information retrieved from the database-->
</div>