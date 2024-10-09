<main id="main" class="main">

  <div class="pagetitle">
    <h1>Emergency Leaves</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
        <li class="breadcrumb-item">Emergency Leaves </a></li>
      </ol>
    </nav>
  </div> <!--End of page title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs d-flex">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#review">Emergency Leave Review</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#who_is_on_emergency">Who is on Emergency Leave</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#emergency_history">Emergency Leave History</button>
              </li>
            </ul>


            <div class="tab-content pt-2">

<!--**********************************  UNAPPROVED EMERGENCY *********************************************-->
            <div class="tab-pane show active" id="review">     
              <?php $this->load->view('hr/unapproved_emergency'); ?>
            </div> 
<!--*****************************END OF UNAPPROVED EMERGENCY REPORT   **********************************-->

  
<!--**************************START OF WHO ON EMERGENCY LEAVE *********************************--> 

                <div class="tab-pane pt-3" id="who_is_on_emergency">
                      <?php $this->load->view('hr/employee_on_emergency_leave'); ?>
                </div> 
<!--**********************************  END  *******************************************-->  

<!-- ************************ START OF EMERGENCY HISTORY ********************* -->
                <div class="tab-pane pt-3" id="emergency_history">
                      <?php $this->load->view('hr/emergency_days_count'); ?>
                </div> 
<!-- *************************** END **************************  -->
                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
    </section> 

    <!-- all modal goes here -->
     <div class="modal fade" id="view_modal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center"> <b>
              FOMU YA MAOMBI YA LIKIZO YA DHARURA
              </b></h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <form method="post" id="employee_emergency_form">
              <div id="emergency_details">
                <!-- in here we will insert edit data from the database using javascrip/ajax -->
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="emergency_history_modal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div id="year_emergency_history">
                <!-- in here we will insert edit data from the database using javascrip/ajax -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
</main>

<script type="text/javascript">
  
  function view_emergency_leave(emergency_id){
    var data = {"emergency_id" : emergency_id};
    $('#view_modal').modal('show');
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>emergency_leave/hr_view_emergency",
        data: data,
        beforSend:function(){
          // $("#end_date").fadeOut();
        },
        success:function(response){
          $('#emergency_details').html(response);
        }
    });
    return false;
  }

  function View_more_history(employee_id){
    var data = {"employee_id" : employee_id };
    $('#emergency_history_modal').modal('show');
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>emergency_leave/hr_view_emergency_history",
        data: data,
        beforSend:function(){
          // $("#end_date").fadeOut();
        },
        success:function(response){
          $('#year_emergency_history').html(response);
        }
    });
    return false;
  }

  function change_endDate(){
    var startDate = document.getElementById("start_date1").value;
    var emergencyDays = parseInt(document.getElementById("emergency_days").value)-1;
    var startDateObj = new Date(startDate);
    var endDateObj = new Date(startDateObj.getTime() + (emergencyDays * 24 * 60 * 60 * 1000));
    // Format the end date as "YYYY-MM-DD"
    var endDateFormatted = endDateObj.toISOString().split('T')[0];
    document.getElementById("end_date1").value = endDateFormatted;
  }

  function complete_date(){
    var startDate = document.getElementById("start_date1").value;
    var emergencyDays = parseInt(document.getElementById("emergency_days").value)-1;
    var errorMessageElement = document.getElementById("error_message");

    if (!isNaN(emergencyDays) && startDate) {
       errorMessageElement.textContent = "";
      var startDateObj = new Date(startDate);
      var endDateObj = new Date(startDateObj.getTime() + (emergencyDays * 24 * 60 * 60 * 1000));

      // Format the end date as "YYYY-MM-DD"
      var endDateFormatted = endDateObj.toISOString().split('T')[0];
      document.getElementById("end_date1").value = endDateFormatted;
    }else{
       document.getElementById("start_date1").value = "";
       errorMessageElement.textContent = "Number of days can't be left empty.";
    }
  }

  function update_emergency(){
    var emergencyDays = document.getElementById("emergency_days").value;
    var errorMessageElement = document.getElementById("error_message");
    if(emergencyDays == ""){
      errorMessageElement.textContent = "Number of days can't be left empty.";
    }else{
    var data = $("#employee_emergency_form").serialize();                
         $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>emergency_leave/update_employee_emergency",
            data : data,
            beforeSend: function(){ 
                $("#response_message").fadeOut();
            },
        success : function(response){  
                window.location.reload(); 
            }
        });
       }
        return false;
  }

  function reject_emergency(emergency_id,employee_names){
    var data = {
      "emergency_id" : emergency_id,
      "employee_names" : employee_names
    };
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>emergency_leave/hd_reject_emergency",
        data: data,
        beforeSend:function(){
          // $("#end_date").fadeOut();
        },
        success:function(response){
          window.location.reload();
        }
    });
    return false;
  }

  function approve_emergency_leave(emergency_id,employee_names){
    var data = {
      "emergency_id" : emergency_id,
      "employee_names" : employee_names
    };
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>emergency_leave/hr_approve_emergency_leave",
        data: data,
        beforeSend:function(){
          // $("#end_date").fadeOut();
        },
        success:function(response){
          window.location.reload();
        }
    });
    return false;
  }

</script>