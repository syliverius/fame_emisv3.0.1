<?php $this->load->helper('estate_helper'); ?>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Car's Fuel Consumption</h4>

      <?php 
            if(isset($sms)){
                echo $sms;
            }
        ?>

        <form class="row g-3" id="fuel_consumption_form" method="post">
          <?php 
            $cars = $this->estate->getAllCars();
          ?>
          <div class="col-md-4">
            <label for="car_name">Car Name</label>
            <select class="form-control" name="car_id" id="car_id">
              <option value="">Choose car name ...</option>
              <?php 
                foreach($cars as $car){ ?>; 
                <option value="<?= $car->car_id; ?>"><?= $car->name; ?></option>
                <?php }
              ?>
            </select>
          </div>   
          <div class="col-md-4">
            <label for="month">Month</label>
            <select class="form-control" name="month" id="month">
              <option value="">Choose month ...</option>
              <?php 
                $months = getMonths();
                foreach($months as $month){
                  ?>
                  <option value="<?= $month; ?>"><?= $month; ?></option>
              <?php
                  }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="fuel_used">Fuel Used(Liters)</label>
            <input type="number" class="form-control" name="fuel_used">
          </div>
          <div class="col-md-4">
            <label for="km_covered">Kilometer Covered(km)</label>
            <input type="number" class="form-control" name="km_covered">
          </div>
          <div class="col-md-4">
            <label for="date_recorded">Date Recorded</label>
            <input type="date" class="form-control" name="date_recorded">
          </div>
          <div class="col-md-4">
            <label for="today">Today's Date</label>
            <input type="text" class="form-control" name="today" value="<?= date('Y-m-d'); ?>" readonly>
          </div>
        
        <div class="text-center">
          <button type="button" class="btn btn-primary" onclick="create_cars_record()">Submit</button>
          <button class="btn btn-danger" type="reset">Cancel</button>
        </div>
    </form>
    <!--end of create roaster form-->
  </div>
</div>