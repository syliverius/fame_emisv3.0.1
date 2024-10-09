<div class="card">
  <div class="card-body">
    <div class="card-title">Create Electricity Usages Graphs</div>
      <!-- Settings Form -->
        <form id="electricity_drawing_form" method="post">
            <div class="row mb-3">
              <label for="year" class="col-sm-2 col-form-label">Select Year</label>
              <div class="col-sm-3">
                <select class="form-control" id="year_selected" name="year">
                  <?php
                    $i = 2022;
                    for($i; $i <= date('Y'); $i++){
                  ?>
                  <option><?php echo $i; ?></option>
                  <?php }; ?>
                </select>
              </div>

              <label for="year" class="col-sm-2 col-form-label">Select Location</label>
              <div class="col-sm-3">
                <select class="form-control" id="location" name="location">
                  <?php
                    $locations = $this->estate->getAllElectricityLocation();
                    foreach ($locations as $location) { ?>
                      <option value="<?= $location->id; ?>"> <?= $location->name; ?></option>
                  <?php  } ?>
                  <option value="all">ALL</option>
                </select>
              </div>

            <div class="col-sm-2">
              <button type="button" class="btn btn-primary" onclick="create_electricity_graph(event)">create</button>
            </div>
          </div>
        </form>
          <!-- End of Electricity usage Form -->
  </div>
</div>