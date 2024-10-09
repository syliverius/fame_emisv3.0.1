<div class="card">
  <div class="card-body">
    <div class="card-title">
      <center>
        FOMU YA MAOMBI YA LIKIZO YA DHARURA
        </center><center>
          FAME LOGO
        </center>
        <center>
          P.O.BOX 351 KARATU,TANZANIA
        </center>
    </div>

    <div id="emergency_response_message"></div>
    <form class="row g-3" id="emergency_leave">

        <div class="col-md-4">
            <label for="names">JINA</label>
            <input type="text" class="form-control" name="names" value="<?= $profile_info->names;?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="today">TAREHE</label>
            <input type="date" class="form-control" name="today" value="<?php echo date('Y-m-d'); ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="idara">IDARA</label>
            <input type="text" class="form-control" name="idara" id="idara" value="<?= $profile_info->department_name;?>" readonly>
          </div>

          <div class="col-md-6">
            <label for="kazi">KAZI/CHEO</label>
            <input type="text" class="form-control" name="kazi" id="kazi" value="<?= $profile_info->professional_name;?>" readonly>
          </div>
          <div class="col-md-6">
            <label for="phone_number">SIMU</label>
            <input type="tel" class="form-control" name="phone_number" id="phone_number" value="<?= $profile_info->phone_number; ?>" readonly>
          </div>
          <div class="col-md-12">
            <label>Fomu hii ili kuwasilisha maombi yangu ya kutokuwepo kazini, tafadhali hakiki kibali hiki cha kutokuwepo kwa muda wa siku</label>
            <input type="number" class="form-control" name="emergency_days" id="emergency_days">
            <span id="error_message" style="color: red;"></span>
          </div>

        <div class="col-md-4">
            <label for="start_date">Kuanzia Tarehe</label>
            <input type="date" class="form-control" name="start_date1" id="start_date1" onchange="complete_date()">
          </div>
          <div class="col-md-4">
            <label for="end_date">Mpaka Tarehe</label>
            <input type="date" class="form-control" name="end_date1" id="end_date1" readonly> 
        </div>
        <div class="col-md-4">
          <label for="sababu">Sababu Ya Dharura</label>
          <select class="form-control" name="sababu" id="sababu" onchange="checkOthers()">
            <?php 
              $result = get_emergency_leaves_options();
              foreach($result as $options=>$display){?>
                <option><?= $display; ?></option>
              <?php }
            ?>
          </select> <!--if others selected we need to output a comment section -->
        </div>
        <div class="col-md-8" id="comment" style="display: none;">
          <label for="comment">Specify other reasons/comment</label>
          <textarea class="form-control" name="comments"></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary" onclick="submit_emergency_leave()">Submit</button>
          <button class="btn btn-danger" type="reset">Cancel</button>
      </div>
    </form>
  </div>
</div>