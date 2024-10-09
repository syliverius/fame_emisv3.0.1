<div class="card">
  <div class="card-body">
    <h4 class="card-title">Search Employee leave history </h4>
      <form method="post" id="leave_history_form" class="row g-3">
      <!-- print error or success message -->
        <div id="response_message"></div>
          <div class="row mb-3">
            <label for="input_file" class="col-sm-3 col-form-label">Employee Name</label>
              <div class="col-sm-6">
                  <input class="typeahead form-control" type="text"  name="names" id="names">
                </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </div>
        </form>
    </div>
</div>
<hr /><hr />
<!-- display employee leave history-->                        
<div id="leave_history_response">
</div>