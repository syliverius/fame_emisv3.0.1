<!--create roaster form-->
<div class="card">
  <div class="card-body">
    <h4 class="card-title">create roster </h4>
      <?php echo $this->session->flashdata('message'); ?>
        <form class="forms-sample" id="roster_create_form" method="post">
        <!--form success/error sms --> 
          <div id="response_message"></div>     
          <div class="row input-group mb-3">
            <label for="names" class="col-sm-2 col-form-label">Full Name</label>
              <div class="col-sm-6">
                <input type="text" class="typeahead form-control" id="names" name="names" placeholder="Name">
              </div>
          </div>
          <div class="row input-group mb-3">
            <label for="startDate" class="col-sm-2 col-form-label">StartDate</label>
              <div class="col-sm-4">
                <input type="date" class="form-control"name="startDate" id="startDate" placeholder="startDate" onchange="create_end_date() ">
              </div>
              <label for="endDate" class="col-sm-2 col-form-label">EndDate</label>
              <div class="col-sm-4">
                  <input type="date" class="form-control" name="endDate" id="endDate" readonly>
              </div>
          </div>

          <div class="row input-group mb-3">
            <label for="selectLeaveReason" class="col-sm-2 col-form-label">Reason</label>
            <div class="col-sm-3">
              <select class="form-control" id="selectLeaveReason" name="reason">
                <option>Likizo</option>
                <option>Mafunzo ya kujiendeleza</option>
                <option>Kozi fupi</option>
                <option>Sababu nyinginezo</option>
              </select>
            </div>
            <label for="exampleTextarea1" class="col-sm-2 col-form-label">Other Comments</label>
          <div class="col-sm-5">
            <textarea class="form-control" id="comments" name="comments" rows="2"></textarea>
          </div>
        </div>
        
        <div class="text-center">
          <button type="submit" class="btn btn-primary" id="roster_create_btn" name="roster_create_btn">Submit</button>
          <button class="btn btn-danger" type="reset">Cancel</button>
        </div>
    </form>
    <!--end of create roaster form-->
  </div>
</div>