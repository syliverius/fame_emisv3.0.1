<?php 
	if(empty($leave_info)){
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Sorry information retrieval failed please contact our awesome administrator for more clarification <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	}else{ ?>

<div class="modal-body row g-3">
	<input type="number" class="form-control" name="benefit_id" value="<?= $leave_info->benefit_id?>" hidden>
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
		<input type="text" class="form-control" name="kazi" id="kazi" value="<?= $leave_info->professional_name; ?>" readonly>
	</div>
	<div class="col-md-6">
		<label for="phone_number">SIMU</label>
		<input type="tel" class="form-control" name="phone_number" id="phone_number" value="<?= $leave_info->phone_number; ?>" readonly>
	</div>
	<div class="col-md-12">
		<label>Fomu hii ili kuwasilisha maombi yangu ya likizo/mapumziko ya kila mwaka, kama ilivyoainishwa kwenye mkataba, tafadhali hakiki kibali hiki cha kutokuwepo kwa muda wa siku</label>
		<input type="number" class="form-control" name="days" id="days" value="<?= $leave_info->days_off; ?>" onchange="change_endDate()">
		<span id="error_message" style="color:red;"></span>
	</div>
	<div class="col-md-4">
		<label for="start_date">Kuanzia Tarehe</label>
		<input type="date" class="form-control" name="start_date" id="start_date" value="<?= $leave_info->start_date;  ?>" onchange="change_endDate()">
	</div>
	<div class="col-md-4">
		<label for="end_date">Mpaka Tarehe</label>
		<input type="date" class="form-control" name="end_date" id="end_date" value="<?= $leave_info->end_date; ?>" readonly>
	</div>
	<div class="col-md-5">
		<label for="location">Ntasafiri Kwenda:Mkoa</label>
		<input type="text" class="form-control" name="region" id="region" value="<?= $this->user->get_region_name($leave_info->mkoa)->region_name; ?>" readonly>
	</div>
	<div class="col-md-4">
		<label for="district">Wilaya</label>
		<input type="text" class="form-control" name="district" id="district" value="<?= $this->user->get_district_name($leave_info->wilaya)->district_name; ?>" readonly>
	</div>
	<div class="col-md-3">
		<label for="ward">Kata</label>
		<input type="text" class="form-control" name="ward" id="ward" value="<?= $this->user->get_ward_name($leave_info->kata)->ward_name; ?>" readonly>
	</div>
	<div class="col-md-7">
		<label for="amount">Gharama zangu za kujikimu safarini kama zinavyotolewa kila baada ya mwaka mmoja ni Tsh</label>
		<input type="number" class="form-control" name="amount" id="amount" value="<?= $leave_info->amount; ?>" readonly>
	</div>
	<p><b>WATEGEMEZI</b></p>
	<div class="col-md-4">
		<label for="mtegemezi_01">Mtegemezi:1</label>
		<input type="text" class="form-control" name="mtegemezi1" value="<?= $leave_info->mtegemezi_1; ?>" readonly>
	</div>
	<div class="col-md-4">
		<label for="mtegemezi_01">Mtegemezi:2</label>
		<input type="text" class="form-control" name="mtegemezi2" value="<?= $leave_info->mtegemezi_2; ?>" readonly>
		</div>
	<div class="col-md-4">
		<label for="mtegemezi_01">Mtegemezi:3</label>
		<input type="text" class="form-control" name="mtegemezi3" value="<?= $leave_info->mtegemezi_3; ?>" readonly>
	</div>
	<div class="col-md-4">
		<label for="mtegemezi_01">Mtegemezi:4</label>
		<input type="text" class="form-control" name="mtegemezi4" value="<?= $leave_info->mtegemezi_4; ?>" readonly>
	</div>
	<div class="col-md-4">
		<label for="mtegemezi_01">Mtegemezi:5</label>
		<input type="text" class="form-control" name="mtegemezi5" value="<?= $leave_info->mtegemezi_5; ?>" readonly>
	</div>
</div>

<?php } ?>
            	