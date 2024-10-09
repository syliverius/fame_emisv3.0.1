<main id="main" class="main">

    <div class="pagetitle">
      <h1>Accoutant Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management'); ?>">Home</a></li>
          <li class="breadcrumb-item">Welcome to Accoutant Dashboard</li>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#leave_request">Annual Leave Request</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#monthly_roaster">Department Monthly Roaster</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history">Employee leave History</button>
                </li>
              </ul>


              <div class="tab-content pt-2">

<!--**********************************ACCOUTANT LEAVE REQUEST VERIFICATION FORM*********************************************-->
                <div class="tab-pane show active" id="leave_request">
                  
                  <!-- employee who are waiting hr editing and approval -->
                  <div class="card">
                    <div class="card-body">
                      <!-- start of table for displaying data -->
                      <div class="col-lg-12">
                        <?php echo $this->session->flashdata('accoutant_success_message'); ?>
                        <?php echo $this->session->flashdata('accoutant_update_message'); ?>
                        <h3 class="card-title"><b>List of employee who needs leaves approval and review</b></h3>
                        <div id="accoutant_approval_response_message"></div>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">No.</th>
                              <th scope="col" class="col-sm-3">Full Name</th>
                              <th scope="col">Start Date</th>
                              <th scope="col">End Date</th>
                              <th scope="col">Destination Region</th>
                              <th scope="col">Department</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $i=1;
                            foreach ($values as $row){
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?= $row['names']; ?></td>
                                <td><?= $row['start_date']; ?></td>
                                <td><?= $row['end_date']; ?></td>
                                <td><?= $this->user->get_region_name($row['region'])->region_name;?></td>
                                <td><?= $row['dept_name']; ?></td>
                                <td>
                                  <button type="button" class="btn  btn-primary more_details_accoutant_btn"  data-id="<?= $row['benefit_id']; ?>" >More Details</button>
                                  <button type="button" class="btn btn-success accoutant_approve_btn" data-id="<?= $row['benefit_id']; ?>" data-name="<?= htmlspecialchars($row['names']); ?>" id="approvalbtn'.<?= $row['benefit_id']; ?>.'">Approve</button>   
                                </td>

                                <?php $i++; ?>
                              </tr>
                            <?php
                            } ?>
                          </tbody>
                          <tfoot>
                            <th scope="col">No.</th>
                              <th scope="col" class="col-sm-3">Full Name</th>
                              <th scope="col">Start Date</th>
                              <th scope="col">End Date</th>
                              <th scope="col">Destination Region</th>
                              <th scope="col">Department</th>
                              <th scope="col">Action</th>
                          </tfoot>
                        </table>
                        </div>
                      <!-- End of displaying data table -->
                    </div>
                  </div>
                </div>
<!--**********************************END OF ACCOUTANT VERIFICATION FORM *********************************************-->

  
<!--**********************************START OF LEAVE HISTORY TAB*********************************************-->   
                 <div class="tab-pane pt-3" id="monthly_roaster">
                    <?php $this->load->view('Monthly_Roaster/department_monthly_roaster_specifics'); ?>
                  <div id="monthly_roster_summary"></div>
                </div> 
<!--**********************************END  OF LEAVE HISTORY TAB *********************************************-->  

     <!--**********************************START OF SUMMARY TAB*********************************************-->
                 <div class="tab-pane pt-3" id="history">
                  <?php $this->load->view('user_leaves/employee_leave_history_specifics'); ?>
                </div> 
<!--**********************************END OF SUMMARY TAB*********************************************-->   

                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
      
    </section>

    <!--ALL MODEL WILL BE IMPLEMENTED HERE-->
    <!-- In here we're going to emplement view more details modal for hr -->
  <div class="modal fade" id="accoutant_more_details_modal" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <h6 class="modal-title text-center" > <b>
                      <p>FOMU YA MAOMBI YA LIKIZO</p>
                            <p>FAME LOGO</p>
                      <p>P.O.BOX 351 KARATU,TANZANIA</p>
                    </b></h6>
          <form method='post' action='<?= base_url(); ?>accoutant_dashboard/accoutant_update_employee_leave'>
            <div id="accoutant_more_details_data">
              <!-- Here we will pass modal data from the database -->
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-primary'>Update</button>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            </div>
          </form>
          </div>
        </div>
      </div>    
</main><!-- End #main -->


 <!--ajax codes -->
<script type="text/javascript">
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

$('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get('<?php echo base_url('auth/user_AutoSuggestion_List'); ?>', { query: query }, function (response) {
                console.log(response);
                response  = $.parseJSON(response);
                return process(response);
            });
        }
    });
 </script>
  
<!--End of ajax codes -->