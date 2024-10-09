<?php $this->load->helper('dashboard_helper'); ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">

            <!-- Total employee Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Employees</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php $total_employee =  $this->dashboard->return_total_active_employee(); echo $total_employee; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- Total Employee card -->

            <! -- employee who are not in either emergency/annual leave -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Available</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php $available_employee = return_number_of_available_employee(); echo $available_employee; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Emergency and annual leave employee-->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Unavailable</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-dash"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $total_employee-$available_employee; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- Total unavailable Employees card -->
            
            <!-- ******************************************** -->
            <!-- all leaves summary -->

            <?php $this->load->view('reports/all_leaves_summary')?>

            <!-- end of all leave summary -->

            <!-- accordion -->
            <div class="card">
              <div class="card-body">
              <h5 class="card-title">This section provides a summary for employees allocation </span></h5>
              <div class="accordion accordion-flush" id="accordionFlushExample"> 

                <div class="accordion-item">
                  <h2 class="accordion-header" id="roster_head">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#roster_body" aria-expanded="false" aria-controls="roster_body">
                              The employees expected to be present at work today as per the roster
                    </button>
                  </h2>
                  <div id="roster_body" class="accordion-collapse collapse" aria-labelledby="#roster_head" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">                         
                      <!-- present employee  -->
                        <?php $this->load->view('reports/employee_present_per_roster'); ?>
                      <!-- end of present employee  -->                               
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="department_head">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#department_body" aria-expanded="false" aria-controls="department_body">
                              Allocation of Employees by Department
                    </button>
                  </h2>
                  <div id="department_body" class="accordion-collapse collapse" aria-labelledby="#department_head" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <!-- Department size -->
                      <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                          <div class="card-body">
                            <h5 class="card-title">Allocation of Employees by Department </span></h5>
                            <table class="table table-borderless datatable">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Department Name</th>
                                  <th scope="col">Department Head</th>
                                  <th scope="col"># of Employees</th>
                                  <th scope="col">% per total employees</th>
                                  <th scope="col">View</th>
                                </tr>
                              </thead>
                              <?php $departments = $this->hr->getDepartments(); ?>
                              <tbody>
                                <?php 
                                 $count = 1;
                                  foreach($departments as $department){ ?>
                                  <tr>
                                    <th scope="row"><?= $count; ?></th>
                                    <td><?= $department->department_name; ?></td>
                                    <td><?php $head_name = $this->hr->get_dept_head_name($department->department_id);
                                      if(empty($head_name)){
                                        echo "";
                                      }else{echo $head_name->names; }
                                     ?></td>
                                    <td> <i class="bi bi-people"></i> <?php $total = $this->dashboard->getTotalEmployeeInDepartment($department->department_id); echo $total; ?></td>
                                    <td><span class="badge rounded-pill bg-info text-dark"><?= round(($total/$total_employee)*100,1); ?> % </span></td>
                                    <td><button type="button" class="btn btn-secondary" onclick="ShowDepartmentEmployee(<?= $department->department_id; ?>)"><i class="bi bi-eye"></i></button></td>
                                  </tr>
                                  <?php $count++;  }   ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div><!-- end of Department size  -->                                                          
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="profession_head">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profession_body" aria-expanded="false" aria-controls="profession_body">
                      Organizational Staff Segmentation by Profession
                    </button>
                  </h2>
                  <div id="profession_body" class="accordion-collapse collapse" aria-labelledby="#profession_head" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <!-- professional section  -->
                      <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                          <div class="card-body">
                            <h5 class="card-title">Organizational Staff Segmentation by Profession</span></h5>
                            <table class="table table-borderless datatable">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Proffesional</th>
                                  <th scope="col"># of employee</th>
                                  <th scope="col">% per total employee</th>
                                  <th scope="col">View</th>
                                </tr>
                              </thead>
                              <?php $proffessional = $this->admin->get_professional(); ?>
                              <tbody>
                                <?php
                                 $count = 1;
                                  foreach($proffessional as $prof){ ?>
                                  <tr>
                                    <th scope="row"><?= $count; ?></th>
                                    <td><?= $prof->professional_name; ?></td>
                                    <td> <i class="bi bi-people"></i> <?php $total_prof = $this->dashboard->getTotalProfessional($prof->id); echo $total_prof; ?> </td>
                                    <td><span class="badge rounded-pill bg-info text-dark"> <?= round(($total_prof/$total_employee)*100,1); ?>% </span></td>
                                    <td><button type="button" class="btn btn-secondary" onclick="ShowProffesionalMember(<?= $prof->id; ?>)"><i class="bi bi-eye"></i></button></td>
                                  </tr>
                                  <?php $count++;  }   ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div><!-- Professional  -->                           
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div><!--end of accordion -->  
      </div>
    </section>

    <!-- all this page models goes here -->

    <!-- this for department members -->
    <div class="modal fade" id="Department_employees" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div id="members">
                <!-- in here we will insert edit data from the database using javascrip/ajax -->
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- this is for professional members -->
    <div class="modal fade" id="professional_members" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div id="prof_members">
                <!-- in here we will insert edit data from the database using javascrip/ajax -->
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- this is for present employee as per roster -->
    <div class="modal fade" id="roster_today_display" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div id="present_members">
                <!-- in here we will insert edit data from the database using javascrip/ajax -->
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>
</main><!-- End #main -->


  <script type="text/javascript">

    function ShowDepartmentEmployee(department_id){
      var data = {"department_id" : department_id};
      $('#Department_employees').modal('show');
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>dashboard/view_department_member",
          data: data,
          beforeSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#members').html(response);
          }
      });
      return false;
    }

    function ShowProffesionalMember(profession_id){
      var data = {"profession_id" : profession_id};
      $('#professional_members').modal('show');
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>dashboard/view_professional_members",
          data: data,
          beforeSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#prof_members').html(response);
          }
      });
      return false;
    }

    function showPresentEmployee(shifts,department_id){
      var data = {"shifts" : shifts , "department_id" : department_id};
      $('#roster_today_display').modal('show');
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>dashboard/view_present_members",
          data: data,
          beforeSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#present_members').html(response);
          }
      });
      return false;
    }

    function display_roster(day) {
      var date;
      var formatted_date;
      var today = new Date();

      if (day == "yesterday") {
          today.setDate(today.getDate() - 1);
      } else if (day == "tommorow"){
          today.setDate(today.getDate() + 1);
      }else{
          today.setDate(today.getDate());
      }

      formatted_date = today.getFullYear() + '-' +
                       ('0' + (today.getMonth() + 1)).slice(-2) + '-' +
                       ('0' + today.getDate()).slice(-2);
      var data = {"date" : formatted_date,"day" : day};
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>dashboard/display_present_members_on_date",
          data: data,
          beforeSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#roster_members_body').html(response);
          }
      });
      return false; 
    }

    
    function show_annual_leave_members(returned_info){
      var data = { "info" : returned_info };
      $('#professional_members').modal('show');
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>dashboard/display_employee_on_annual_leave",
          data: data,
          beforeSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#prof_members').html(response);
          }
      });
      return false;
    }

    function get_expected_annual_leave(returned_info){
      var data = { "info" : returned_info };
      $('#professional_members').modal('show');
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>dashboard/expected_annual_leave",
          data: data,
          beforeSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#prof_members').html(response);
          }
      });
      return false;
    }

    function get_returning_from_annual_leave(returned_info){
      var data = { "info" : returned_info };
      $('#professional_members').modal('show');
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>dashboard/displaying_from_annual_leave",
          data: data,
          beforeSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#prof_members').html(response);
          }
      });
      return false;
    }

    function get_employees_on_emergency_leave(returned_info){
      var data = { "info" : returned_info };
      $('#professional_members').modal('show');
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>dashboard/display_employees_on_emergency_leave",
          data: data,
          beforeSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#prof_members').html(response);
          }
      });
      return false;
    }

  </script>