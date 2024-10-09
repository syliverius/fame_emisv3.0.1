<?php 

	if(empty($leave_info)){
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Sorry information retrieval failed please contact our awesome administrator for more clarification <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	}else{ ?>

<div class="modal-body row g-3">
	<input type="number" class="form-control" name="benefit_id" value="<?= $leave_info->benefit_id; ?>" hidden>
	<input type="number" class="form-control" name="leave_id" value="<?= $leave_info->leave_id; ?>" hidden>

	<div class="col-md-4">
	    <label for="names">JINA</label>
	    <input type="text" class="form-control" name="names" value="<?= $leave_info->names; ?>" readonly>
	</div>
	
	<div class="col-md-4">
	    <label for="today">TAREHE YA KUAPPLY LIKIZO</label>
	    <input type="date" class="form-control" name="today" id="today" value="<?= $leave_info->request_date; ?>" readonly>
	</div>

	<div class="col-md-4">
        <label for="idara">IDARA</label>
        <input type="text" class="form-control" name="idara" id="idara" value="<?= $leave_info->department_name; ?>" readonly>
    </div>
	
	<div class="col-md-6">
	    <label for="kazi">KAZI/CHEO</label>
	    <input type="text" class="form-control" name="kazi" id="kazi" value="<?= $leave_info->professional_name;?>" readonly>
	</div>
	
	<div class="col-md-6">
	    <label for="phone_number">SIMU</label>
	    <input type="tel" class="form-control" name="phone_number" id="phone_number" value="<?= $leave_info->phone_number; ?>" readonly>
	</div>

	<div class="col-md-12">
	    <label>Fomu hii ili kuwasilisha maombi yangu ya likizo/mapumziko ya kila mwaka, kama ilivyoainishwa kwenye mkataba, tafadhali hakiki kibali hiki cha kutokuwepo kwa muda wa siku</label>
	    <input type="number" class="form-control" name="days" id="days" value="<?= $leave_info->days_off; ?>" onchange="change_endDate()">
	     <span id="error_message" style="color: red;"></span>
	</div>
	
	<div class="col-md-4">
	    <label for="start_date">Kuanzia Tarehe</label>
	    <input type="date" class="form-control" name="start_date" id="leave_start_date" value="<?= $leave_info->start_date; ?>" onchange="complete_date()">
	</div>
	
	<div class="col-md-4">
	    <label for="end_date">Mpaka Tarehe</label>
	    <input type="date" class="form-control" name="end_date" id="leave_end_date" value="<?= $leave_info->end_date; ?>" readonly>
	</div>
	
	<?php 
		$regions = $this->request->regional_autosuggestion();
	?>
	<div class='col-md-5'>
	    <label for='adress'>Ntasafiri Kwenda:Mkoa</label>
        <select class="form-control region" name="region" id="region" onchange="suggest_region_districts()">
        	<?php 
        		foreach($regions as $region){ 
        			if ($region->id == $leave_info->mkoa) { ?>
        				<option value="<?= $region->id; ?>" selected><?= $region->region_name; ?></option>
        			<?php }else { ?>
        				<option value="<?= $region->id; ?>"><?= $region->region_name; ?></option>
        	<?php } } ?>
        </select>
	</div>

	<?php $districts = $this->request->get_district_autosuggestion($leave_info->mkoa); ?>

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

	<?php $wards = $this->request->get_wards_autosuggestion($leave_info->wilaya); ?>
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
	    	if($leave_info->amount == 0){ ?>
	    		<input type="number" class="form-control" name="amount" id="amount" value="<?= $leave_info->amount; ?>" readonly>
	    	<?php }else{ ?>
	    		<input type="number" class="form-control" name="amount" id="amount" value="<?= $leave_info->amount; ?>" min="0" max="1000000">
	    		<! -- start of description -->
	    			<?php
	    			$data['leave_info'] = $leave_info; 
	    			$this->load->view('hr/leave_benefits_description',$data); 
	    			?>
	    		<!-- end of description -->
		<?php } ?>
	    
	</div>
	
	<p><b>WATEGEMEZI</b></p>
	<div class="col-md-4">
	    <label for="mtegemezi_01">Mtegemezi:1</label>
	    <input type="text" class="form-control" name="mtegemezi1" value="<?= $leave_info->mtegemezi_1; ?>">
	</div>
	
	<div class="col-md-4">
	    <label for="mtegemezi_01">Mtegemezi:2</label>
	    <input type="text" class="form-control" name="mtegemezi2" value="<?= $leave_info->mtegemezi_2; ?>">
	</div>

	<div class="col-md-4">
	    <label for="mtegemezi_01">Mtegemezi:3</label>
	    <input type="text" class="form-control" name="mtegemezi3" value="<?= $leave_info->mtegemezi_3; ?>">
	</div>
	
	<div class="col-md-4">
	    <label for="mtegemezi_01">Mtegemezi:4</label>
	    <input type="text" class="form-control" name="mtegemezi4" value="<?= $leave_info->mtegemezi_4; ?>">
	</div>
	
	<div class="col-md-4">
	    <label for="mtegemezi_01">Mtegemezi:5</label>
	    <input type="text" class="form-control" name="mtegemezi5" value="<?= $leave_info->mtegemezi_5; ?>">
	</div>
	
	<p><b><i>IMEPITIWA NA</i></b></p>
	<div class="col-md-5">
	    <label for="mkuu wa idara"><b>Mkuu wa Idara</b></label>
	    <input type="text" class="form-control" name="dept_head_name" value="<?= $this->admin->getDepartmentHeadinfo($leave_info->dept_head_id)->names;?>" readonly>
	</div>

	<div class="col-md-4">
	    <label for="mkuu wa idara">Tarehe</label>
	    <input type="text" class="form-control" name="dept_head_name" value="<?= $leave_info->dept_sign_date; ?>" readonly>
	</div>

	<div class="col-md-5">
	    <label for="mkuu wa idara"><b>Mkuu Rasimali Watu</b></label>
	    <input type="text" class="form-control" name="dept_head_name" value="<?= $this->session->userdata("full_name"); ?>" readonly>
	</div>

	<div class="col-md-2">
	    <label for="tarehe">Tarehe</label>
	    <input type="text" class="form-control" name="date" value="<?= date("Y-m-d");?>" readonly>
	</div>

	<div class="col-md-5">
		<label for="exampleTextarea1">Write comments here</label>
		<textarea class="form-control" id="comments" name="comments" rows="2"><?= $leave_info->hr_comment; ?></textarea>
	</div>
</div>

<?php } ?>