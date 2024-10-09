<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-02
 * @description This page is used to record the purchased fuel for machines and generators
 * @license     Open Source

-->
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Generators and Machines Fuel Purchases</h4>

      <?php 
            if(isset($sms)){
                echo $sms;
            }
        ?>

        <form class="row g-3" id="fuel_puchases_form" method="post">
          <div class="col-md-4">
            <label for="purchase_day">Fuel Purchase Day</label>
            <input type="date" name="purchase_day" class="form-control">
          </div>
          <div class="col-md-4">
            <label for="amount">Amount(Liters)</label>
            <input type="number" name="amount" class="form-control">
          </div>
          <div class="col-md-4">
            <label for="cost">Cost per Litre </label>
            <input type="number" name="cost" class="form-control">
          </div>    
          <div class="col-md-4">
            <label for="shell_name">Fuel Station Name</label>
            <select class="form-control" name="station_id">
              <?php 
                $shells = $this->estate->getAllShells();
                foreach($shells as $shell){ ?>
                  <option value="<?= $shell->id; ?>"><?= $shell->name; ?></option>
                <?php } ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="receipt_number">Receipt Number </label>
            <input type="number" name="receipt_number" class="form-control">
          </div> 
          <div class="col-md-4">
            <label for="today">Date Of Update </label>
            <input type="date" name="today" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
          </div>
        <div class="text-center">
          <button type="button" class="btn btn-primary" onclick="create_fuel_purchase()">Submit</button>
          <button class="btn btn-danger" type="reset">Cancel</button>
        </div>
    </form>
    <!--end of create roaster form-->
  </div>
</div>