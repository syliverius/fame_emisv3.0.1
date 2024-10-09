<div class="card">
  <div class="card-body">
    <div class="card-title">
      <center>
      FOMU YA MAOMBI YA LIKIZO
      </center>
      <center>
        FAME LOGO
      </center>
      <center>
        P.O.BOX 351 KARATU,TANZANIA
      </center>
    </div>
    <!-- Settings Form -->
    <div id="leave_response_message"></div>
      <form class="row g-3" id="leave_request_form" method="post">
        <input type="text" name="leave_id" value="<?= $leave_details->leave_id; ?>" hidden>
        <input type="text" name="employee_id" value="<?= $info->employee_id; ?>" hidden>
        <div class="col-md-4">
          <label for="names">JINA</label>
          <input type="text" class="form-control typeahead" name="names" value="<?= $info->names; ?>">
        </div>
        <div class="col-md-4">
          <label for="today">TAREHE</label>
          <input type="date" class="form-control" name="today" id="today" value="<?= date('Y-m-d'); ?>" readonly>
        </div>
        <div class="col-md-4">
          <label for="idara">IDARA</label>
          <input type="text" class="form-control" name="idara" id="idara" value="<?= $info->department_name; ?>" readonly>
        </div>
        <div class="col-md-6">
          <label for="kazi">KAZI/CHEO</label>
          <input type="text" class="form-control" name="kazi" id="kazi" value="<?= $info->professional_name; ?>" readonly>
        </div>
        <div class="col-md-6">
          <label for="phone_number">SIMU</label>
          <input type="tel" class="form-control" name="phone_number" id="phone_number" value="<?= $info->phone_number; ?>">
        </div>
        <div class="col-md-12">
          <label>Fomu hii ili kuwasilisha maombi yangu ya likizo/mapumziko ya kila mwaka, kama ilivyoainishwa kwenye mkataba, tafadhali hakiki kibali hiki cha kutokuwepo kwa muda wa siku</label>
          <input type="number" class="form-control" name="days" id="days" min="0" max="<?= $leave_details->days_left; ?>" onchange="change_endDate()">
          <span id="error_message" style="color: red;"></span>
        </div>
        <div class="col-md-4">
          <label for="start_date">Kuanzia Tarehe</label>
          <input type="date" class="form-control" name="start_date" id="start_date" onchange="complete_date()">
        </div>
        <div class="col-md-4">
          <label for="end_date">Mpaka Tarehe</label>
          <div id="endDate">
            <input type="date" class="form-control" name="end_date" id="end_date" readonly> 
          </div>
        </div>
        
        <div class="col-md-5">
          <label for="location">Ntasafiri Kwenda:Mkoa</label>
          <select class="form-control region" name="region" id="region" onchange="suggest_region_districts()">
            <option>Select region</option>
            <?php 
              $regions = $this->user->regional_autosuggestion();
              foreach ($regions as $region){ ?>
                <option value="<?= $region->id; ?>"><?= $region->region_name; ?></option>
              <?php } ?>
          </select> 
        </div>
        <div class="col-md-4">
          <label for="district">Wilaya</label>
            <select class="form-control district" name="district" id="district" onchange="autosuggest_ward()">
              <option>Select district</option>
            </select>
        </div>
        <div class="col-md-3">
          <label for="ward">Kata</label>
            <select class="form-control" name="ward" id="ward">
              <option>Select ward</option>
            </select>
        </div>
        <div class="col-md-7">
          <label for="amount">Gharama zangu za kujikimu safarini kama zinavyotolewa kila baada ya mwaka mmoja ni Tsh</label>
          <?php 
            if($this->user->check_leave_benefits_model($leave_details->leave_id)){ ?>
              <input type='number' class='form-control' name='amount' id='amount' value="0" readonly>
            <?php }else{ ?>
              <input type='number' class='form-control' name='amount' id='amount' min='0' max='1000000'>
            <?php 
            
                $this->load->view('user_leaves/leave_benefits_description');
              } 
            ?>
        </div>
        <p><b>WATEGEMEZI</b></p>
        <div class="col-md-4">
          <label for="mtegemezi_01">Mtegemezi:1(Partner)</label>
          <input type="text" class="form-control" name="mtegemezi1">
        </div>
        <div class="col-md-4">
          <label for="mtegemezi_01">Mtegemezi:2</label>
          <input type="text" class="form-control" name="mtegemezi2">
        </div>
        <div class="col-md-4">
          <label for="mtegemezi_01">Mtegemezi:3</label>
          <input type="text" class="form-control" name="mtegemezi3">
        </div>
        <div class="col-md-4">
          <label for="mtegemezi_01">Mtegemezi:4</label>
          <input type="text" class="form-control" name="mtegemezi4">
        </div>
        <div class="col-md-4">
          <label for="mtegemezi_01">Mtegemezi:5</label>
          <input type="text" class="form-control" name="mtegemezi5">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="create_requesed_leave" onclick="submit_leave_request()">Submit</button>
          <button class="btn btn-danger" type="reset">Cancel</button>
        </div>
        <!-- submit button and reset form will be here -->
    </form>
    <!-- End settings Form -->
  </div>
</div>
