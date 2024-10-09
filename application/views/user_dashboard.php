<?php $this->load->helper('emergency_leaves_helper'); ?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Normal User Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
        <li class="breadcrumb-item">User Dashboard</a></li>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#leave_request">Annual Leave Request</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#emergency_leaves">Emergency Leaves Requests</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#monthly_roaster">Monthly Roster</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history">My Annual leave History</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#summary">Short summary</button>
              </li>
            </ul>


            <div class="tab-content pt-2">

<!--**********************************  LEAVE REQUEST FORM  *********************************************-->
              <div class="tab-pane show active" id="leave_request">
                <?php $this->load->view('user_leaves/annual_leave_request');?>   
              </div>
<!--**********************************END LEAVE REQUEST FORM   *********************************************-->
              <div class="tab-pane pt-3" id="emergency_leaves">
                <?php $this->load->view('user_leaves/emergency_leaves_request'); ?>
              </div>

<!--**********************************  MONTHLY ROSTER *********************************************-->
              <div class="tab-pane fade pt-3" id="monthly_roaster">
                   <?php $this->load->view('Monthly_Roaster/employee_monthly_roaster');?>
                   
                   <div id="employee_monthly_roster"></div>
              </div>
<!--**********************************END MONTHLY ROSTER   *********************************************-->

  
<!--**********************************START OF MY LEAVE HISTORY TAB*********************************************--> 

                <div class="tab-pane pt-3" id="history">
                  <?php 
                    $info['employee_id'] = $this->session->userdata('employee_id');
                    $this->load->view('user_leaves/annual_leave_history.php',$info);
                   ?>          
                </div> 
<!--**********************************END  OF MY LEAVE HISTORY TAB *********************************************-->  

<!-- ************** this year user short summary ***** -->
                <div class="tab-pane pt-3" id="summary">
                  <?php $this->load->view('reports/user_summaries')?>
                </div>

                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
      
    </section> 
</main>

<script type="text/javascript">
    function change_endDate(){
        var startDate = document.getElementById("start_date").value;
        if(!startDate){}else{
        var days = parseInt(document.getElementById("days").value);
        var startDateObj = new Date(startDate);
        var endDateObj = new Date(startDateObj.getTime() + (days * 24 * 60 * 60 * 1000));
        // Format the end date as "YYYY-MM-DD"
        var endDateFormatted = endDateObj.toISOString().split('T')[0];
        document.getElementById("end_date").value = endDateFormatted;
      }
    }

  function fill_endDate(){
   var startDate = document.getElementById("start_date").value;
      var annual_days = parseInt(document.getElementById("days").value);
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

  function complete_date(){
    var startDate = document.getElementById("start_date1").value;
    var emergencyDays = parseInt(document.getElementById("emergency_days").value);
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

  function fill_Districts(){
    var region = $('.region').val();
      var data = {"region_id":region};
      if(region != "Select region"){
      $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>user_dashboard/district_autosuggestion",
        data: data,
        beforSend:function(){
          $("#wards").fadeOut();
        },
        success:function(response){
          $('#district').html(response);
        }
      })
    }else{
      alert('please select the valid region');
    }
  }

  function fill_Wards(){
    var district = $('.district').val();
      var data = {"district_id":district};
      if(district != "Select District"){
      $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>user_dashboard/ward_autosuggestion",
        data: data,
        success:function(response){
          $('#ward').html(response);
        }
      })
    }else{
      alert('please select the valid ward');
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
               required: "<span style='color:#ce0000;'>Please type the number of days your won't be arround!!</span>"
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
            url  : "<?php echo base_url() ?>user_dashboard/create_leave",
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

  function employee_monthly_roster(event){
    event.preventDefault();
    var data = $('#employee_roster_summary').serialize();

        $.ajax({               
          type : 'POST',
          url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roster_Employee/employee_roaster_summary",
          data : data,
          beforeSend: function(){ 
            // $("#response_message").fadeOut();
          },
          success : function(response){
              $('#employee_monthly_roster').html(response);
            }
          });
        return false;
  }
  //we will create clear function for cleaning a form after user submit

  function submit_emergency_leave(){
    $("#emergency_leave").validate({

      rules : {
        emergency_days: {
                required: true,
            },
        start_date1: {
                required: true,
            },
        end_date1: {
                required: true,
            },
      },
      messages : {
        emergency_days: {
            required: "<span style='color:#ce0000;'>This field can't be left empty!!</span>"
          },
        start_date1: {
            required: "<span style='color:#ce0000;'>Please select starting dates!!</span>"
          },
        end_date1: {
            required: "<span style='color:#ce0000;'>By selecting start date, this will aoutogenate automatically!!</span>"
          }
      },
      submitHandler: EmergencyFormSubmit
    });

    function EmergencyFormSubmit(){
     var data = $("#emergency_leave").serialize();
     var responseMessageElement = document.getElementById("emergency_response_message");

     $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>user_dashboard/create_Emergency_leave",
        data: data,
        beforeSend : function(){

        },
        success:function(response){
          responseMessageElement.innerHTML = response;
        }
      })

    }
  }

  function checkOthers(){
    var selectElement = document.querySelector('select[name="sababu"]');
    var divComment = document.getElementById('comment');

    if (selectElement.value === 'Others') {
      divComment.style.display = 'block'; // Show the div
    } else {
      divComment.style.display = 'none'; // Hide the div
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

</script>