<main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management'); ?>">Home</a></li>
          <li class="breadcrumb-item">Welcome to Admin Dashboard</li>
          <!-- <li class="breadcrumb-item active">Profile</li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs d-flex">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#employee_mgt">Employee Management</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#dept_mgt">Department Management</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#leave_mgt">Leave Management</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#attendance">Attendance</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#user_mgt">User Management</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#group_mgt">Group Management</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#monthly_roster">Monthly Duty Roster Shifts</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#create_roster">Create Monthly Roster</button>
                </li>
              </ul>


              <div class="tab-content pt-2">

<!--********************************** START OF EMPLOYEE MGT TAB*********************************************-->
                <div class="tab-pane show active" id="employee_mgt">
                  
                  <!-- employee who are waiting hr editing and approval -->
                  <div class="card">
                    <div class="card-body">
                      <!-- start of table for displaying data -->
                      <div class="col-lg-12">
                        <h3 class="card-title"><b></b></h3>
                          <div class="accordion" id="accordionExample">

                            <!------------------- ACCORDION FOR ADD NEW EMPLOYEE ----------------------->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingNewEmployee">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewEmployee" aria-expanded="false" aria-controls="collapseNewEmployee">
                                  <i class="bi bi-person-plus"></i>&nbsp;&nbsp; ADD NEW EMPLOYEE
                                </button>
                              </h2>
                              <div id="collapseNewEmployee" class="accordion-collapse collapse" aria-labelledby="headingNewEmployee"          data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                   <div class="">
                                     <?php $this->load->view('create_new_employee');?>
                                   </div>
                                </div>
                              </div>
                            </div>
                            <!------------------- END OF ACCORDION FOR ADD NEW EMPLOYEE ----------------------->

                            <!------------------- ACCORDION FOR EMPLOYEE TRANSFER ----------------------->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingTransfer">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTransfer" aria-expanded="false" aria-controls="collapseTransfer">
                                    <i class="bi bi-skip-end"></i>&nbsp;&nbsp; TRANFER EMPLOYEE TO NEW DEPARTMENT
                                </button>
                              </h2>
                              <div id="collapseTransfer" class="accordion-collapse collapse" aria-labelledby="headingTransfer" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <h4 class="card-title">Employee Department Transfer Form</h4>
                                    <form class="forms-sample" id="trensfer_employee_form" method="post">
                                      <div id="transfer_employee_response"></div>     
                                      <div class="row input-group mb-3">
                                        <label for="names" class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="typeahead form-control" id="employee_names" name="names" placeholder="By entering the first letter,select from the auto suggested names" onchange="get_current_department()">
                                        </div>
                                      </div>
                                      <div class="row input-group mb-3">
                                        <label for="cureent_department" class="col-sm-2 col-form-label">Current Department</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="cureent_department" id="cureent_department" readonly>
                                        </div>
                                      </div>
                                      <div class="row input-group mb-3">
                                        <label for="new_department" class="col-sm-2 col-form-label">New Department</label>
                                        <div class="col-sm-6">
                                          <select class="form-control" name="new_department" id="new_department">
                                            <option></option>
                                            <?php 
                                              foreach($department as $row){
                                                echo "<option>$row->department_name</option>";
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="text-center">
                                          <button type="button" class="btn btn-primary" onclick="transfer_employee()">Submit</button>
                                          <button class="btn btn-danger" type="reset">Cancel</button>
                                      </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                            <!------------------- END OF ACCORDION FOR EMPLOYEE TRANSFER ----------------------->

                            <!------------------- ACCORDION FOR DELETING EMPLOYEE ----------------------->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingDelete">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDelete" aria-expanded="false" aria-controls="collapseDelete">
                                    <i class="bi bi-person-x"></i>&nbsp;&nbsp; DELETE EMPLOYEE PERMANENTLY
                                </button>
                              </h2>
                              <div id="collapseDelete" class="accordion-collapse collapse" aria-labelledby="headingDelete" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <h4 class="card-title">Employee Deletion/Deactivate Form</h4>
                                    <form class="forms-sample" id="deletion_employee_form" method="post">
                                      <div id="deactivate_employee_response"></div>     
                                      <div class="row input-group mb-3">
                                        <label for="names" class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="typeahead form-control" id="typed_names" name="typed_names" placeholder="By entering the first letter,select from the auto suggested names" onchange="get_current_department()">
                                        </div>
                                        <div class="col-sm-4">
                                          <button type="button" class="btn btn-primary" onclick="employee_deactivate()">Delete/Deactivate</button>
                                      </div>
                                      </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                            <!------------------- END OF ACCORDION FOR DELETING EMPLOYEE ----------------------->

                            <!------------------- ACCORDION FOR EMPLOYEE INFO EDITING  ----------------------->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingEdit">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEdit" aria-expanded="false" aria-controls="collapseEdit">
                                     <i class="bi bi-person-check"></i>&nbsp;&nbsp;EDIT EMPLOYEE INFORMATION
                                </button>
                              </h2>
                              <div id="collapseEdit" class="accordion-collapse collapse" aria-labelledby="headingEdit" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <h4 class="card-title">Employee Information Editing Form</h4>
                                  <div class="row input-group mb-3">
                                    <label for="names" class="col-sm-2 col-form-label">Full Name</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="typeahead form-control" id="editing_name" name="typed_names" placeholder="By entering the first letter,select from the auto suggested names" onchange="employee_info_form()">
                                      </div>
                                  </div>
                                  <hr /><hr />
                                  <div id="employee_info_data"></div>
                                </div>
                              </div>
                            </div>
                            <!-------------------END OF ACCORDION FOR EMP INFO EDITING  ----------------------->
                          </div><!-- End of accordion  -->
                        </div>
                    </div>
                  </div>
                </div>
<!--**********************************END OF EMPLOYEE MGT TAB *********************************************-->

<!--******************************** ANNUAL AND EMERGENCY LEAVES ******************************************-->  

                <div class="tab-pane fade pt-3" id="dept_mgt">

                  <div class="card">
                    <div class="card-body">
                      <!-- we create department mgt -->
                      
                    </div>
                  </div>

                </div>
                <!--*****END OF LEAVES TAB****-->

        
 
              <!-- ***** START OF LEAVE HISTORY TAB ******-->

                <div class="tab-pane pt-3" id="leave_mgt">
                  <br />
                  <div class="card">
                    <div class="card-body">
                      <?php $this->load->view('admin/main_leave_mgt_form'); ?>
                    </div>
                  </div>
                </div> 
<!--**********************************END  OF LEAVE HISTORY TAB *********************************************-->  

<!-- *********************** ATTENDANCE ******************************* -->
                <div class="tab-pane pt-3" id="attendance">
                  <br />
                  <div class="card">
                    <div class="card-body">
                      <?php $this->load->view('attendance/import_attendance')?>
                    </div>
                  </div>
                </div> 
  <!-- ******************** END OF ATTENDANCE ************************* -->
<!--********************************** START OF USER MANAGEMENT PANEL *********************************************-->  
                <div class="tab-pane pt-3" id="user_mgt">

                  <div class="card">
                    <div class="card-body">
                      <div class="content-wrapper">

                      <!-- Main content -->
                      <section class="content">        

                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Manage Employee </h4>
                            <table class="table table-striped datatable">
                              <tr>
                                <th>S/N</th>
                                <th>Names</th>
                                <th>Gender</th>
                                <th>Group_name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Profession</th>
                                <th>Action</th>
                              </tr>
                              <?php
                              $i = 0;
                              
                                  foreach ($employee as $privi): $i++;
                                      ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $privi->names; ?></td>
                                <td><?php echo $privi->gender; ?></td>
                                <td><?php echo $privi->group_name; ?></td>
                                <td><?php echo $privi->department_name; ?></td>
                                <td><?php echo $privi->position; ?></td>
                                <td><?php echo $privi->professional_name; ?></td>
                                <th>
                                    <?php if ($privi->user_group_id > 2) { ?>
                                        <a href="<?php echo base_url() . "admin_dashboard/delete_user/" . $privi->employee_id; ?>" title="Delete this user type" onclick="return confirm('Confirm delete User!')"><span class="bi bi-trash"></span></a> | 
                                    <?php } ?>
                                    <a href="javascript:void()" class="btn-xs" onclick="UpdateUsers( <?php echo $privi->employee_id ?> ,<?php echo $privi->user_group_id ?>)"><span class="bi bi-edit">Manage</span></a>
                                </th>
                              </tr>
                               <?php
                                endforeach;                     
                                ?>
                            </table>
                          </div>
                      </div>
                  </section>
              </div>
            </div>
          </div>                  
        </div> 
<!--**********************************END OF USER MANAGEMENT  *********************************************-->  


 <!--**********************************START OF GROUP MANAGEMENT *********************************************-->
                  
    <div class="tab-pane fade pt-3" id="group_mgt">
      <div class="card">
        <div class="card-body">
          <div class="content-wrapper">
           <!-- Main content -->
          <section class="content">        
            <center>
              <a onClick='$("#newuser").toggle(400);' href="#newuser" class="btn btn-default" title="Add new system user"><b>New User Group</b></a>
              <div> <!--flash data success message --></div>
              </center><br/>

              <div class="row" id="newuser" style="display:none">

                <div class="col-lg-12"> <!-- we closed here -->
                  <div class="panel panel-default">
                    <div class="panel-heading">New User Group</div>
                      <div class="panel-body">
                        <table align="center">
                          <?php echo form_open('admin_dashboard/new_user_group','method="post"'); ?>
                          <tr>
                            <td><input type="text" class="form-control" name="group_name" placeholder="Name: eg:Admin" value=""></td>
                            <td><input type="text" class="form-control" name="description" placeholder="Descriptions" value=""></td>
                            <th><input type="submit" class="btn btn-primary" value="Group Create"></th>
                          </tr>
                          </form><br/>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage user groups </h4>
                      <table class="table table-striped datatable">
                        <tr>
                          <th>S/N</th>
                          <th>User Group</th>
                          <th>Description</th>
                          <th>Operations</th>
                        </tr>
                          <?php
                          $i = 0;
                          
                              foreach ($privileges as $privi): $i++;
                                  ?>
                                  <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $privi->group_name; ?></td>
                                      <td><?php echo $privi->group_description; ?></td>
                                      <th>
                                          <?php if ($privi->user_group_id >2) { ?>
                                              <a href="<?php echo base_url() . "admin_dashboard/delete_user_group/" . $privi->user_group_id; ?>" title="Delete this user type" onclick="return confirm('Confirm delete User!')"><span class="bi bi-trash"></span></a> | 
                                          <?php } ?>
                                          <a href="<?php echo base_url() . "admin_dashboard/edit_user_privileges/" . $privi->user_group_id; ?>" title="View & Edit Privileges"><span class="bi bi-edit"></span>Edit</a>
                                      </th>
                                  </tr>
                                  <?php
                              endforeach;                     
                          ?>
                      </table>
                  </div>
              </div>
            </section>
          </div>       
        </div>
      </div>
    </div> 

    <div class="tab-pane pt-3" id="monthly_roster">
      <br />
      <div class="card">
        <div class="card-body">
          <div id="updated_shift">
            <?php $this->load->view('Monthly_Roaster/add_attribute'); ?>
          </div>
        </div>
      </div>
    </div> 

    <div class="tab-pane pt-3" id="create_roster">
      <br />
      <div class="card">
        <div class="card-body">
          <div id="updated_shift">
            <?php $this->load->view('Monthly_Roaster/admin_monthly_roster_specifics'); ?>
            <div id="monthly_roaster"></div>
          </div>
        </div>
      </div>
    </div>
<!--**********************************END OF SUMMARY TAB*********************************************-->   

                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
      
    </section>

    <!--ALL MODEL WILL BE IMPLEMENTED HERE-->
    <div class="modal fade" id="usrsUpdate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width:1000px">
          <div class="modal-body" >
            <div id="usrsUpdate_form"></div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="employee_annual_detail_modal" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <h6 class="modal-title text-center" > <b>
                      <p>FOMU YA MAOMBI YA LIKIZO</p>
                            <p>FAME LOGO</p>
                      <p>P.O.BOX 351 KARATU,TANZANIA</p>
                    </b></h6>
          <form method='post' id="employee_annual_leave_form">
            <div id="employee_annual_leave_details">
              <!-- Here we will pass modal data from the database -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="update_employee_leave()">Update</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
          </div>
        </div>
      </div> 
   
</main><!-- End #main -->


 <!--ajax/js codes here-->
  <script>

    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get('<?php echo base_url('auth/user_AutoSuggestion_List'); ?>', { query: query }, function (response) {
                console.log(response);
                response  = $.parseJSON(response);
                return process(response);
            });
        }
    });

    function UpdateUsers(uid, priv) {
        $('#usrsUpdate').modal('show');
        $('#usrsUpdate_form').load('<?php echo base_url() . 'admin_dashboard/userUpdateForm/'; ?>' + uid + '/' + priv);
    }

    function create_new_employee(){
      $("#new_employee_form").validate({
        rules: {
            names: {
                required: true,
            },
            hiring_date: {
                required: true,
            },
        phone_number: {
                required: true,
            } 
        },
        messages: {
            names:{
              required: "<span style='color:#ce0000;'>The names field cannot be left blank</span>"
             },
             hiring_date:{
              required: "<span style='color:#ce0000;'>The hiring date field cannot be left blank</span>"
             },
        phone_number:{
        required: "<span style='color:#ce0000;'>Insert the phone number of new hired employee</span>"
        },
      },

        submitHandler: createEmployee
      });   
    function createEmployee(){
      var data = $("#new_employee_form").serialize(); 

      $.ajax({
        method : "post",
        url : "<?php echo base_url() ?>admin_dashboard/create_new_employee",
        dataType : "html",
        data : data,
        beforeSend : function(){ 
            },
        success : function(response){
          if (response == "ok"){
            $("#new_employee_response").fadeIn(1000, function(){               
              $("#new_employee_response").html('<tr><td colspan="5"><div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i><strong>Congratulation!!.</strong>New employee created successful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
              });
          }else if(response == "failed"){
              $("#new_employee_response").fadeIn(1000, function(){               
              $("#new_employee_response").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-x-circle me-1"></i>Failed to create employee please contact our awesome administrator <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
              });
          }else if (response == "name_found") {
              $("#new_employee_response").fadeIn(1000, function(){               
                $("#new_employee_response").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-x-circle me-1"></i>employee  name you entered already exists in our current database <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
                });
          }else{
              $("#new_employee_response").fadeIn(1000, function(){               
              $("#new_employee_response").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-x-circle me-1"></i>Unknown error occured please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
              });
          }
          clear();
        }
      });
    }
  }

  function clear(){
    $("input[type=text]").val('')
  }

  function get_current_department(){
    var names = $('#employee_names').val();
    $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>admin_dashboard/get_current_department",
          data:{
                "full_name" : names
              },
          beforSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            document.getElementById('cureent_department').value=response;
          }
      });
  }

  function transfer_employee(){
    var new_department = $('#new_department').val();
    var names = $('#employee_names').val();
    if(new_department !='' && names !=''){
      $.ajax({
        method : "post",
        url : "<?php echo base_url() ?>admin_dashboard/transfer_employee",
        dataType : "html",
        data : {
          "names" : names,
          "new_department" : new_department
        },
        beforeSend : function(){ 

        },
        success : function(response){
          if (response == "ok"){
            $("#transfer_employee_response").fadeIn(1000, function(){               
              $("#transfer_employee_response").html('<tr><td colspan="5"><div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i><strong>Congratulation!!.</strong>Employee transferred to new department <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
              });
          }else if(response == "insert_fail"){
              $("#transfer_employee_response").fadeIn(1000, function(){               
              $("#transfer_employee_response").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-x-circle me-1"></i>Sorry!!, failed to insert data into the database, please contact our awesome administrator <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
              });
          }else if (response == "failed") {
              $("#transfer_employee_response").fadeIn(1000, function(){               
                $("#transfer_employee_response").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-x-circle me-1"></i>Sorry!, our system failed to generate department and employee id, please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
                });
          }else{
              $("#transfer_employee_response").fadeIn(1000, function(){               
              $("#transfer_employee_response").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-x-circle me-1"></i>Unknown error occured please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
              });
          }
          clear();
        }
      });
    }else{
      alert('make sure all the field are filled with information');
    }
  }

  function employee_deactivate(){
    var data = $("#deletion_employee_form").serialize();                
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>admin_dashboard/deactivate_employee",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
        if (response == "ok") {
          $("#deactivate_employee_response").fadeIn(1000, function(){               
              $("#deactivate_employee_response").html('<tr><td colspan="5"><div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i><strong>Congratulation!!.</strong>Employee Deactivation done successful <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
              });
                } else{
                  $("#deactivate_employee_response").fadeIn(1000, function(){               
                    $("#deactivate_employee_response").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i><strong>Sorry!!.</strong>Employee Deactivation failed please contact our awesome programmer for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
                  });
                }  
            }
        });
        return false;
    }

    function employee_info_form(){
      var names = $('#editing_name').val();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>admin_dashboard/employee_info_form",
        data : {
          "names" : names
          },
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#employee_info_data').html(response);
            }
        });
      return false;
    }

    function get_employee_annual_leave_form(){
      var names = $('#employee_name').val();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>admin_dashboard/get_employee_annual_leave_form",
        data : {
          "names" : names
          },
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#annual_leave_form').html(response);
            }
        });
      return false;
    }

    function complete_date(){
      var startDate = document.getElementById("start_date").value;
      var annual_days = parseInt(document.getElementById("days").value)-1;
      var errorMessageElement = document.getElementById("error_message");

      if (!isNaN(annual_days) && startDate) {
         errorMessageElement.textContent = "";
        var startDateObj = new Date(startDate);
        var endDateObj = new Date(startDateObj.getTime() + (annual_days * 24 * 60 * 60 * 1000));

        // Format the end date as "YYYY-MM-DD"
        var endDateFormatted = endDateObj.toISOString().split('T')[0];
        document.getElementById("end_date").value = endDateFormatted;
      }else{
         document.getElementById("start_date").value = "";
         errorMessageElement.textContent = "Number of days can't be left empty.";
      }
    }

   function change_endDate(){
      var startDate = document.getElementById("start_date").value;
      if(!startDate){}else{
        var days = parseInt(document.getElementById("days").value)-1;
        var startDateObj = new Date(startDate);
        var endDateObj = new Date(startDateObj.getTime() + (days * 24 * 60 * 60 * 1000));
        // Format the end date as "YYYY-MM-DD"
        var endDateFormatted = endDateObj.toISOString().split('T')[0];
        document.getElementById("end_date").value = endDateFormatted;
      }
    }

    function suggest_region_districts(){
      var region = $('.region').val();
      var data = {"region_id":region};
      if(region != "Select region"){
      $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>admin_dashboard/get_region_districts",
        data: data,
        beforSend:function(){
          $("#ward").fadeOut();
        },
        success:function(response){
          $('#district').html(response);
        }
      })
    }else{
      alert('please select the valid region');
    }
  }

  function autosuggest_ward() {
    var district_id = $('.district').val();
    var data = {"district_id":district_id};
    if(region != "Select district"){
    $.ajax({
      type: "post",
      url: "<?php echo base_url(); ?>admin_dashboard/get_district_wards",
      data: data,
      beforSend:function(){
        // $("#suggested_ward").fadeOut();
      },
      success:function(response){
        $('#ward').html(response);
      }
    })
    }else{
      alert('please select the valid region');
    }
 }

 function submit_leave_request(){

    $("#leave_request_form").validate({
    
        rules: {
            phone_number: {
                required: true,
            },
      start_date: {
                required: true,
            },
      end_date: {
                required: true,
            },
      days: {
                required: true,
            },
      district: {
                required: true,
            },
      region: {
                required: true,
            },  
        },
        messages: {
            phone_number:{
              required: "<span style='color:#ce0000;'>Please insert your phone number</span>"
             },
            start_date:{
              required: "<span style='color:#ce0000;'>select the starting date!!</span>"
             },
             end_date:{
               required: "<span style='color:#ce0000;'>select the end date!!</span>"
             },
             days:{
               required: "<span style='color:#ce0000;'>Please type the number of days need by employee for annual leave!!</span>"
             },
             region:"<span style='color:#ce0000;'>select the region of your destination !!</span>",
              },
              district:{
               required: "<span style='color:#ce0000;'>select the district of your destination !!</span>"
             },

        submitHandler: submitForm   
    });    

    /* Handling login functionality */
    function submitForm() {     
        var data = $("#leave_request_form").serialize();
        var responseMessageDiv = document.getElementById('leave_response_message');               
         $.ajax({               
            type : 'post',
            url  : "<?php echo base_url() ?>admin_dashboard/create_employee_annual_leave",
            data : data,
            beforeSend: function(){ 
                // $("#leave_response_message").fadeOut();
            },
        success : function(response){   
                responseMessageDiv.innerHTML = response;
            }
        });
        return false;
    }   
  }

  function view_more_employee_leave(benefit_id) {
    var data = { "benefit_id" : benefit_id};
    $('#employee_annual_detail_modal').modal('show');
    $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>admin_dashboard/employee_annual_leave_details",
            data: data,
            beforSend: function()
            {
               $('#employee_annual_leave_details').html();
            },
            success: function(response){
               $('#employee_annual_leave_details').html(response);
                 
            },
            error: function ()
            {

            }
        });
    return false;
  }

  function update_employee_leave(){
    var data = $("#employee_annual_leave_form").serialize();
    $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>admin_dashboard/update_employee_leave",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
          $('#employee_annual_detail_modal').modal('hide');
          $('#employee_leave_form_update_response').html(response);
          }
        });
    return false;
  }

  function delete_employee_leave(benefit_id){
    if(confirm("Are you sure you want to delete this leave record?")){
      var data = {"benefit_id" : benefit_id};
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>admin_dashboard/delete_employee_leave",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            //on suceess how can i refresh this div unapproved_leave
            $('#unapproved_leave').html(response);
          }
        });
    }
  }

  function moveAnnualLeaveTo(benefit_id) {
    var move_to = $('#'+benefit_id+'_id').val();
    if(move_to == "choose where to move"){

    }else{
      var data = {"benefit_id" : benefit_id,"destination" : move_to};
      if(confirm("are you sure you want to move this record to " + move_to)){
        $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>admin_dashboard/transfer_employee_leave_records",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#unapproved_leave').html(response);
          }
        });
      }
    }
  }


function importAttendance() {
    var inputFile = document.querySelector('input[name=import_file]');
    var fileToUpload = inputFile.files[0];
    
    // Make sure there is a file to upload
    if (typeof fileToUpload !== 'undefined') {
        var formData = new FormData();
        formData.append('file', fileToUpload);
        
        $.ajax({
            url: '<?php echo base_url(); ?>Attendance/import_attedance_data',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            beforeSend: function () {
                // $("#upload_response_message").fadeOut();
            },
            success: function (response) {
                $('#imported_table_data').html(response);
            }
        });
    } else {
        // Handle the case where no file is selected
    }
}

function formToggle(elementId) {
    var element = document.getElementById(elementId);
    if (element.style.display === "none") {
        element.style.display = "block";
    } else {
        element.style.display = "none";
    }
}

function findTotal(attr_id,attr_times_id,attr_total_id){
  var attr_amount = parseInt(document.getElementById(attr_id).value);
  var attr_times = parseInt(document.getElementById(attr_times_id).value);
  var total;
  var general_sum;

  if (isNaN(attr_amount) || attr_amount === "") {
    attr_amount = 0;
  }

  if (isNaN(attr_times) || attr_times === "") {
    attr_times = 1;
  }

  total = attr_amount * attr_times;
  document.getElementById(attr_total_id).value = total;

  var nauli_amount = parseInt(document.getElementById("nauli_amount").value);
  var maradhi_amount = parseInt(document.getElementById("maradhi_amount").value);
  var chakula_amount = parseInt(document.getElementById("chakula_amount").value);

  if (isNaN(nauli_amount) || nauli_amount === "") {
    nauli_amount = 0;
  }

  if (isNaN(maradhi_amount) || maradhi_amount === "") {
    maradhi_amount = 0;
  }

  if (isNaN(chakula_amount) || chakula_amount === "") {
    chakula_amount = 0;
  }

  general_sum = nauli_amount+maradhi_amount+chakula_amount;

  document.getElementById("general_total").value = general_sum;
  document.getElementById("amount").value = general_sum;
}

function delete_shift(shift_id) {
  if (confirm("Are you sure you want to delete this shift")) {
    var data = { "shift_id": shift_id };

    $.ajax({
      type: 'POST',
      url: "<?= base_url('admin_dashboard/delete_shift');?>",
      data: data,
      beforeSend: function () {
        
      },
      success: function (response) {
        $('#updated_shift').html(response);
      },
      error: function (xhr, status, error) {
        console.error("AJAX request failed:", status, error);
      }
    });
  }
}


function generate_roaster(e){
    var data = $('#department_roaster').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/present_roaster",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#monthly_roaster').html(response);
          }
        });
      return false;
  }

  function publish_roaster(event){
    const parentElement = document.querySelector('#monthly_roaster');
    const form = parentElement.querySelector('#roaster');
    
    //select all the form text input
      const textInputs = form.querySelectorAll('input[type="text"][id="days"]');
      const textInputs2 = form.querySelectorAll('input[type="text"][id="shifts"]');
      for (let i = 0; i < textInputs.length; i++) {
        if(checkShiftAbbr(textInputs[i].value.trim(),textInputs2)){
          alert('Unknown letter filled, please use the abbreviated letter on top of the table');
          event.preventDefault();
          return;
      }else{
        //
      }
    }

    var data = $('#roaster').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/publish_roaster",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#monthly_roaster').html(response);
          }
        });
      return false; 
  }

  function update(event){
    const parentElement = document.querySelector('#monthly_roaster');
    const form = parentElement.querySelector('#roaster_update');
    
    //select all the form text input
      const textInputs = form.querySelectorAll('input[type="text"][id="days"]');
      const textInputs2 = form.querySelectorAll('input[type="text"][id="shifts"]');
      for (let i = 0; i < textInputs.length; i++) {
      if(checkShiftAbbr(textInputs[i].value.trim(),textInputs2)){
          alert('Unknown letter filled, please use the abbreviated letter on top of the table');
          event.preventDefault();
          return;
      }else{
      }
    }

    var data = $('#roaster_update').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/update_monthly_roaster",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#monthly_roaster').html(response);
          }
        });
      return false; 
  }

  function mid_month_update(){
    const parentElement = document.querySelector('#monthly_roaster');
    const form = parentElement.querySelector('#mid_roaster_update');
    const comment =  form.querySelector('textarea[id="update_reason"]').value.trim();
    
    //select all the form text input
      const textInputs = form.querySelectorAll('input[type="text"][id="days"]');
      const textInputs2 = form.querySelectorAll('input[type="text"][id="shifts"]');
      for (let i = 0; i < textInputs.length; i++) {
      if(checkShiftAbbr(textInputs[i].value.trim(),textInputs2)){
          alert('Unknown letter filled, please use the abbreviated letter on top of the table');
          event.preventDefault();
          return;
      }else if(comment == ""){
        alert('Please you must state the reasons for the changes you have made');
          event.preventDefault();
          return;
      }else{
      }
    }

    var data = $('#mid_roaster_update').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/mid_month_update",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#monthly_roaster').html(response);
          }
        });
      return false; 
  }

  function checkShiftAbbr(input,shifts){
    var result = true;
    for(i = 0; i < shifts.length; i++){
      if (input == shifts[i].value.trim() || input == ''){
        result = false;
      }
    }
    return result;
  }

</script>
<!--End of ajax/js codes -->