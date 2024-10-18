<div class="card">
  <div class="card-body">
    <div class="card-title">Create cars Graphs</div>
      <!-- Settings Form -->
        <form id="car" method="post">
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

              <label for="year" class="col-sm-2 col-form-label">Select Car</label>
              <div class="col-sm-3">
                <select class="form-control" id="car" name="car">
                  <?php
                    $cars = $this->estate->getAllCars();
                    foreach ($cars as $car) { ?>
                      <option value="<?= $car->car_id; ?>"><?= $car->name."(".$car->registration_number.")"; ?></option>
                  <?php  } ?>
                  <option value="all">ALL</option>

                </select>
              </div>

            <div class="col-sm-2">
              <button type="button" class="btn btn-primary" onclick="create_car_graphs(event)">create</button>
            </div>
          </div>
        </form>
          <!-- End of Electricity usage Form -->
  </div>
</div>