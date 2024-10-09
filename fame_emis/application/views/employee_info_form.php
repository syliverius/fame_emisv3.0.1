<?php if(isset($employeeInfo)){
  ?>
<h3 class="card-title">Edit Employee Information For <?= $employeeInfo->names; ?></h3>
<div id="employee_info_data_updated"></div>
  <form method="post"  id="edit_employee_info_form" class="row g-3">
      <div class="col-md-3">
        <label for="employee_id">Employee System_Id</label>
        <input type="text" class="form-control" name="employee_id"  value="<?= $employeeInfo->employee_id; ?>" readonly>
      </div>
      <div class="col-md-5">
        <label for="names">Employee Name</label>
        <input type="text" class="form-control" name="names" value="<?= $employeeInfo->names; ?>">
      </div>
      <div class="col-md-4">
        <label for="department">Department</label>
        <select class="form-control" name="Department" value="<?= $employeeInfo->department_name;?>">
          <?php 
            foreach($department as $row){
              if($row->department_name == $employeeInfo->department_name){
                echo "<option selected>$row->department_name</option>";
              }else{
                echo "<option>$row->department_name</option>";
              }
            }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <label for="position">Position</label>
        <select class="form-control" name="Position" id="Position">
          <?php 
            if($employeeInfo->position == "HEAD"){
              echo "<option selected>HEAD</option>";
              echo "<option>USER</option>";
            }else{
              echo "<option>HEAD</option>";
              echo "<option selected>USER</option>";
            }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <label for="Professional">Professional</label>
        <select class="form-control" name="professional">
          <?php
            foreach($professional as $row){
              if($row->professional_name == $employeeInfo->professional_name){
                ?>
                <option selected><?= $row->professional_name;?></option>
                <?php
              }else{
                ?>
                <option><?= $row->professional_name;?></option>
                <?php
              }
            }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <label for="gender">Gender</label>
        <select class="form-control" name="gender">
          <?php 
            if($employeeInfo->gender =="Male"){
              echo "<option selected>Male</option>";
              echo "<option>Female</option>";
            }else{
              echo "<option>Male</option>";
              echo "<option selected>Female</option>";
            }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <label for="status">Status</label>
        <select class="form-control" name="status">
          <?php 
            if($employeeInfo->status == "active"){
              echo "<option selected>active</option>";
              echo "<option>inactive</option>";
            }else{
              echo "<option>active</option>";
              echo "<option selected>inactive</option>";
            }
          ?>
        </select>
        <!--input type="text" name="status" class="form-control"value="<?= $employeeInfo->status;?>"-->
      </div>
      <div class="col-md-4">
        <label for="phone_number">Phone Number</label>
        <input type="text" class="form-control" name="phone_number" value="<?= $employeeInfo->phone_number;?>">
      </div>
      <div class="col-md-4">
        <label for="dob">Date Of Birth</label>
        <input type="date" class="form-control" name="dob" value="<?= $employeeInfo->dob; ?>">
      </div>
      <div class="col-md-4">
        <label for="hiring_date">Hiring Date</label>
        <input type="date" class="form-control" name="hiring_date" value="<?= $employeeInfo->hiring_date; ?>">
      </div>
      <div class="text-center">
        <button type="button" class="btn btn-primary" onclick="update_employee_info()">Update</button>
        <button class="btn btn-danger" type="reset">Cancel</button>
      </div>
    </form>
    <?php } ?>
  <script type="text/javascript">
    
    function update_employee_info(){
      var data = $("#edit_employee_info_form").serialize(); 

       $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>admin_dashboard/edit_employee_info",
        data : data,
        beforeSend: function(){ 
          // $("#employee_info_data_updated").fadeOut();
        },
        success : function(response){
            $('#employee_info_data_updated').html(response);
            }
        });

      return false;
    }

  </script>