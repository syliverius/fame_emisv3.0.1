<!-- this page location and dates changes ids are same as of creating new employee form, so if the do not wotk remember to refresh the page <it bad coding i know > -->
<div class='modal-body row g-3'>
	<input type='number' class='form-control' name='benefit_id' value='<?= $leave_info->benefit_id; ?>' hidden>
	<input type='number' class='form-control' name='leave_id' value='<?= $leave_info->leave_id; ?>' hidden>

	<div class='col-md-4'>
	    <label for='names'>JINA</label>
	    <input type='text' class='form-control' name='names' value='<?= $leave_info->names; ?>' readonly>
	</div>
	
	<div class='col-md-4'>
	    <label for='today'>TAREHE YA KUAPPLY LIKIZO</label>
	    <input type='date' class='form-control' name='today' id='today' value='<?= $leave_info->request_date; ?>' readonly>
	</div>

	<div class='col-md-4'>
        <label for='idara'>IDARA</label>
        <input type='text' class='form-control' name='idara' id='idara' value='<?= $leave_info->department_name; ?>' readonly>
    </div>
	
	<div class='col-md-6'>
	    <label for='kazi'>KAZI/CHEO</label>
	    <input type='text' class='form-control' name='kazi' id='kazi' value='<?= $leave_info->professional_name;?>' readonly>
	</div>
	
	<div class='col-md-6'>
	    <label for='phone_number'>SIMU</label>
	    <input type='tel' class='form-control' name='phone_number' id='phone_number' value='<?= $leave_info->phone_number; ?>' readonly>
	</div>

	<div class='col-md-12'>
	    <label>Fomu hii ili kuwasilisha maombi yangu ya likizo/mapumziko ya kila mwaka, kama ilivyoainishwa kwenye mkataba, tafadhali hakiki kibali hiki cha kutokuwepo kwa muda wa siku</label>
	    <input type='number' class='form-control' name='days' id='days' value='<?= $leave_info->days_off; ?>' onchange="change_endDate()">
	     <span id="error_message" style="color: red;"></span>
	</div>
	
	<div class='col-md-4'>
	    <label for='start_date'>Kuanzia Tarehe</label>
	    <input type='date' class='form-control' name='start_date' id='start_date' value='<?= $leave_info->start_date; ?>' onchange="complete_date()">
	</div>
	
	<div class='col-md-4'>
	    <label for='end_date'>Mpaka Tarehe</label>
	    <input type='date' class='form-control' name='end_date' id='end_date' value='<?= $leave_info->end_date; ?>' readonly>
	</div>

	<?php 
		$regions = $this->user->regional_autosuggestion();
	?>
	<div class='col-md-5'>
	    <label for='adress'>Ntasafiri Kwenda:Mkoa</label>
        <select class="form-control region" name="region" id="region" onchange="suggest_region_districts()">
        	<?php 
        		foreach($regions as $region){ 
        			if ($region->id == $leave_info->mkoa) { ?>
        				<option value="<?= $region->id; ?>" selected><?= $region->region_name; ?></option>
        			<?php }else { ?>
        				<option value="<?= $region->id?>"><?= $region->region_name; ?></option>
        	<?php } } ?>
        </select>
	</div>

	<?php $districts = $this->user->get_district_autosuggestion($leave_info->mkoa); ?>

	<div class='col-md-4'>
	    <label for='district'>Wilaya</label>
	    <select class="form-control district" name="district" id="district" onchange="autosuggest_ward()">
        	<?php 
        		foreach($districts as $district){ 
        			if ($district->id == $leave_info->wilaya) { ?>
        				<option value="<?= $district->id; ?>" selected><?= $district->district_name; ?></option>
        			<?php }else { ?>
        				<option value="<?= $district->id?>"><?= $district->district_name; ?></option>
        	<?php } } ?>
        </select>
	</div>

	<?php $wards = $this->user->get_wards_autosuggestion($leave_info->wilaya); ?>
	<div class='col-md-3'>
	    <label for='wards'>Kata</label>
	    <select class="form-control" name="ward" id="ward">
        	<?php 
        		foreach($wards as $ward){ 
        			if ($ward->id == $leave_info->kata) { ?>
        				<option value="<?= $ward->id; ?>" selected><?= $ward->ward_name; ?></option>
        			<?php }else { ?>
        				<option value="<?= $ward->id?>"><?= $ward->ward_name; ?></option>
        	<?php } } ?>
        </select>
	</div>

	<div class="col-md-7">
          <label for="amount">Gharama zangu za kujikimu safarini kama zinavyotolewa kila baada ya mwaka mmoja ni Tsh</label>
          <?php 
                if ($this->session->userdata('benefit') == false) { ?>
                  <input type='number' class='form-control' name='amount' id='amount' min='0' max='1000000'>

                  <!-- here we put description of leave benefit -->
                <?php 
                $data['leave_info'] = $leave_info;
                $this->load->view('hr/leave_benefits_description',$data);
              }else{
                  echo "<input type='number' class='form-control' name='amount' id='amount' value='0' readonly>";
                }
           ?>
    </div>
	
	<p><b>WATEGEMEZI</b></p>
	<div class='col-md-4'>
	    <label for='mtegemezi_01'>Mtegemezi:1</label>
	    <input type='text' class='form-control' name='mtegemezi1' value='<?= $leave_info->mtegemezi_1; ?>'>
	</div>
	
	<div class='col-md-4'>
	    <label for='mtegemezi_01'>Mtegemezi:2</label>
	    <input type='text' class='form-control' name='mtegemezi2' value='<?= $leave_info->mtegemezi_2; ?>'>
	</div>

	<div class='col-md-4'>
	    <label for='mtegemezi_01'>Mtegemezi:3</label>
	    <input type='text' class='form-control' name='mtegemezi3' value='<?= $leave_info->mtegemezi_3; ?>'>
	</div>
	
	<div class='col-md-4'>
	    <label for='mtegemezi_01'>Mtegemezi:4</label>
	    <input type='text' class='form-control' name='mtegemezi4' value='<?= $leave_info->mtegemezi_4; ?>'>
	</div>
	
	<div class='col-md-4'>
	    <label for='mtegemezi_01'>Mtegemezi:5</label>
	    <input type='text' class='form-control' name='mtegemezi5' value='<?= $leave_info->mtegemezi_5; ?>'>
	</div>
</div>