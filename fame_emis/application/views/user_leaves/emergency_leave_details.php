<?php $this->load->helper('emergency_leaves_helper'); ?>
<input type="text" name="emergency_id" value="<?= $emergency_details->emergency_id; ?>" hidden>
<div class='modal-body row g-3'>
<div class="col-md-4">
  <label for="names">JINA</label>
    <input type="text" class="form-control" name="names" value="<?= $emergency_details->names; ?>" readonly>
</div>
<div class="col-md-4">
  <label for="today">TAREHE YA MAOMBI</label>
  <input type="date" class="form-control" name="today" value="<?= $emergency_details->date; ?>" readonly>
</div>
<div class="col-md-4">
  <label for="idara">IDARA</label>
  <input type="text" class="form-control" name="idara" id="idara" value="<?= $emergency_details->department_name; ?>" readonly>
</div>

<div class="col-md-6">
  <label for="kazi">KAZI/CHEO</label>
  <input type="text" class="form-control" name="kazi" id="kazi" value="<?= $emergency_details->professional_name; ?>" readonly>
</div>
<div class="col-md-6">
  <label for="phone_number">SIMU</label>
  <input type="tel" class="form-control" name="phone_number" id="phone_number" value="<?= $emergency_details->phone_number; ?>" readonly>
</div>

<div class="col-md-12">
  <label>Fomu hii ili kuwasilisha maombi yangu ya kutokuwepo kazini, tafadhali hakiki kibali hiki cha kutokuwepo kwa muda wa siku</label>
  <input type="number" class="form-control" name="emergency_days" id="emergency_days" value="<?= $emergency_details->emergency_days; ?>" onchange="change_endDate()">
  <span id="error_message" style="color: red;"></span>
</div>

<div class="col-md-4">
  <label for="start_date">Kuanzia Tarehe</label>
  <input type="date" class="form-control" name="start_date1" id="start_date1" value="<?= $emergency_details->start_date; ?>" onchange="complete_date()">
  <span id="startdate_error_message" style="color: red;"></span>
</div>
<div class="col-md-4">
  <label for="end_date">Mpaka Tarehe</label>
  <input type="date" class="form-control" name="end_date1" id="end_date1" value="<?= $emergency_details->end_date; ?>" readonly> 
</div>
<div class="col-md-4">
  <label for="sababu">Sababu Ya Dharura</label>
  <select class="form-control" name="sababu" id="sababu" onchange="checkOthers()">
    <?php 
      $result = get_emergency_leaves_options();
      foreach($result as $options=>$display){
        if($display == $emergency_details->sababu){?>
          <option selected><?= $display; ?></option>
        <?php }else{ ?>
          <option><?= $display; ?></option>
        <?php }
      }
    ?>
  </select> <!--if others selected we need to output a comment section -->
</div>
<div class="col-md-8" id="comment">
  <label for="comment">Specify other reasons/comment</label>
  <textarea class="form-control" name="comments"><?= $emergency_details->comments; ?></textarea>
</div>
</div>

<div class="modal-footer">
  <div class="col-md-12 text-center">
    <button type="button" class='btn btn-danger' onclick="reject_emergency(<?= $emergency_details->emergency_id; ?>,'<?= $emergency_details->names; ?>')">Reject</button>
    <button type="button" class='btn btn-primary' onclick="update_emergency()">Update</button>
    <button type="button" class='btn btn-info' onclick="send_to_hr(<?= $emergency_details->emergency_id; ?>,'<?= $emergency_details->names; ?>')">Send to HR</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  </div>
</div>