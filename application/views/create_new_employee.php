<div id="new_employee_response"></div>
  <h3 class="card-title">Please fill the following form below to create new employee</h3>
    <form method="post"  id="new_employee_form" class="row g-3">
      <!-- print error or success message -->
      <div id="new_employee_form_response"></div>

      <div class="col-md-6">
        <label for="names">Employee Name</label>
        <input type="text" class="typeahead form-control" name="names" id="names">
      </div>

      <div class="col-md-6">
        <label for="department">Department</label>
        <select class="form-control" name="Department" id="Department">
          <?php 
            foreach($department as $row){
              echo "<option>$row->department_name</option>";
            }
          ?>
        </select>
      </div>
      <div class="col-md-4">
        <label for="Professional">Professional</label>
        <select class="form-control" name="Professional" id="Professional">
          <?php 
            foreach($professional as $row){
              echo "<option>$row->professional_name</option>";
            }
          ?>
        </select>
      </div>

      <div class="col-md-4">
        <label for="gender">Gender</label>
        <select class="form-control" name="gender" id="Gender">
          <option>Male</option>
          <option>Female</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" class="form-control" id="phone_number">
      </div>

      <div class="col-md-4">
        <label for="dob">Date Of Birth</label>
        <input type="date" name="dob" class="form-control" id="dob">
      </div>

      <div class="col-md-4">
        <label for="hiring_date">Hiring Date</label>
        <input type="date" name="hiring_date" class="form-control" id="hiring_date">
      </div>

      <div class="col-md-4">
        <label for="position">Position</label>
          <select class="form-control" name="Position" id="Position">
            <option>HEAD</option>
            <option>USER</option>
          </select>
      </div>

      <div class="text-center">
        <button class="btn btn-primary" name="" onclick="create_new_employee()">Submit</button>
        <button class="btn btn-danger" type="reset">Cancel</button>
      </div>
    </form>