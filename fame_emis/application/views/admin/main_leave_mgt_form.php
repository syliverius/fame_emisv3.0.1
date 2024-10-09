  <div class="accordion accordion-flush" id="accordionFlushExample"> 
    <div class="accordion-item">
      <h2 class="accordion-header" id="track_annual_leave">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#track_annual_body" aria-expanded="false" aria-controls="track_annual_body">
                  Track Annual Leaves
        </button>
      </h2>
      <div id="track_annual_body" class="accordion-collapse collapse" aria-labelledby="#track_annual_leave" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
          <div>
            <h4 class="card-title"> Annual Leave approvals progress </h4> 
            <div id="employee_leave_form_update_response"></div>                        
            <?php $this->load->view('admin/track_unapprove_leave'); ?>                           
          </div>
        </div>
      </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="create_annual_leave">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#create_annual_bdy" aria-expanded="false" aria-controls="create_annual_bdy">
                Create Annual Leave 
      </button>
    </h2>
    <div id="create_annual_bdy" class="accordion-collapse collapse" aria-labelledby="#create_annual_leave" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <h4 class="card-title">Employee annual leave form</h4>
        <div class="row input-group mb-3">
          <label for="names" class="col-sm-2 col-form-label">Employee Full Name</label>
            <div class="col-sm-6">
              <input type="text" class="typeahead form-control" id="employee_name" name="employee_name" placeholder="By entering the first letter,select from the auto suggested names" onchange="get_employee_annual_leave_form()">
            </div>
        </div>
        <hr /><hr /> 
        <div id="annual_leave_form"></div>                               
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="track_emergency_leave">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#track_emergency_body" aria-expanded="false" aria-controls="track_emergency_body">
        Track Emergency Leave 
      </button>
    </h2>
    <div id="track_emergency_body" class="accordion-collapse collapse" aria-labelledby="#track_emergency_leave" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
                                  
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="create_emergency_leave">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#create_emergency_body" aria-expanded="false" aria-controls="create_emergency_body">
        Create Emergency Leave 
      </button>
    </h2>
    <div id="create_emergency_body" class="accordion-collapse collapse" aria-labelledby="#create_emergency_leave" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
                                  
      </div>
    </div>
  </div>

</div><!--end of accordion -->  