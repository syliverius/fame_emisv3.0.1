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
    <h4 class="card-title">Generators and Machines Fuel Usages</h4>

      <?php 
            if(isset($sms)){
                echo $sms;
            }
        ?>

        <form class="row g-3" id="fuel_usage_form" method="post">
          <div class="col-md-4">
            <label for="reading_date">Reading Date</label>
            <input type="date" name="reading_date" class="form-control">
          </div>
          <div class="col-md-4">
            <label for="amount">Amount Used (in Liters)</label>
            <input type="number" name="amount" class="form-control">
          </div>
          <div class="col-md-4">
            <label for="time">Refilling Time </label>
            <input type="time" name="time" class="form-control"> <!-- come back here to test time -->
          </div>    
          <div class="col-md-4">
            <label for="generator_reading">Generator Running time reading</label>
            <input type="text" name="generator_reading" class="form-control">
          </div>
          <div class="col-md-4">
            <label for="machine_id">Name of machine </label>
            <select name="machine_id" class="form-control">
              <?php 
                $machines = $this->estate->getAllMachines();
                foreach($machines as $machine){ ?>
                  <option value="<?= $machine->id; ?>"><?= $machine->name; ?></option>
                <?php } ?>
            </select>
          </div> 
          <div class="col-md-4">
            <label for="today">Date Of Update </label>
            <input type="date" name="today" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
          </div>
        <div class="text-center">
          <button type="button" class="btn btn-primary" onclick="record_machines_fuel_usage()">Submit</button>
          <button class="btn btn-danger" type="reset">Cancel</button>
        </div>
    </form>
    <!--end of create roaster form-->
  </div>
</div>