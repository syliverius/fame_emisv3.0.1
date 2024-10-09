<main id="main" class="main">

    <div class="pagetitle">
      <h1>Hr Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management'); ?>">Home</a></li>
          <li class="breadcrumb-item">Welcome to HR Dashboard</li>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#leave_request">Leave Request</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#went_on_leave">Who went on leave</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#coming_from_leave">Who is coming from leave</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#to_be_leave">Who to be On leave</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history">Employee leave History</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#summary">Annual Leave Roster</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#monthly_roaster">Monthly Duty Roster</button>
                </li>
              </ul>


              <div class="tab-content pt-2">

<!--**********************************HR LEAVE REQUEST VERIFICATION FORM*********************************************-->
                <div class="tab-pane show active" id="leave_request">
                  
                  <!-- employee who are waiting hr editing and approval -->
                  <div class="card">
                     <?php $this->load->view('hr/hr_unapproved_leaves'); ?>
                  </div>
                </div>
<!--**********************************END OF HR VERIFICATION FORM *********************************************-->

<!--**********************************WHO WENT ON LEAVE TAB*********************************************-->  

                <div class="tab-pane fade pt-3" id="went_on_leave">
                    <?php $this->load->view('hr/who_went_on_leave');?>
                </div>
<!--**********************************END OF WHO WENT ON LEAVE TAB*********************************************-->

<!--**********************************COMING FROM LEAVE TAB*********************************************-->
                <div class="tab-pane fade pt-3" id="coming_from_leave">
                   <?php $this->load->view('hr/who_coming_from_leave'); ?>
                </div>

<!--**********************************END OF COMING FROM LEAVE TAB*********************************************-->

<!--**********************************START OF WHO TO BE ON LEAVE TAB*********************************************-->
              <div class="tab-pane pt-3" id="to_be_leave">
                <?php $this->load->view('hr/who_tobe_on_leave'); ?>    
              </div> 
<!--**********************************END OF WHO TO BE ON LEAVE TAB*********************************************-->  
 
<!--**********************************START OF LEAVE HISTORY TAB*********************************************-->   
                 <div class="tab-pane pt-3" id="history">
                    <?php $this->load->view('user_leaves/employee_leave_history_specifics'); ?>
                 </div> 
<!--**********************************END  OF LEAVE HISTORY TAB *********************************************-->  

     <!--**********************************START OF LEAVE SUMMARY TAB*********************************************-->
                 <div class="tab-pane pt-3" id="summary">
                   <?php $this->load->view('hr/annual_leave_summary'); ?>
                </div> 
<!--**********************************END OF LEAVE SUMMARY TAB*********************************************-->  

<!-- ********************** START OF MONTLY ROASTER ****************--> 
                <div class="tab-pane pt-3" id="monthly_roaster">
                  <?php $this->load->view('Monthly_Roaster/department_monthly_roaster_specifics'); ?>
                  <div id="monthly_roster_summary"></div>
                </div>
<!-- ********************** END OF MONTLY ROASTER ****************--> 


                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
      
    </section>

    <!--ALL MODEL WILL BE IMPLEMENTED HERE-->
    <!-- In here we're going to emplement view more details modal for hr -->
  <div class="modal fade" id="hr_more_details_modal" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <h6 class="modal-title text-center" > <b>
                      <p>FOMU YA MAOMBI YA LIKIZO</p>
                            <p>FAME LOGO</p>
                      <p>P.O.BOX 351 KARATU,TANZANIA</p>
                    </b></h6>
          <form method='post' id="hr_view_leave" action='<?= base_url(); ?>hr_dashboard/hr_update_employee_leave'>
            <div id="hr_more_details_data">
              <!-- Here we will pass modal data from the database -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="reject_leave()">Reject</button>
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
          </div>
        </div>
      </div>    
</main><!-- End #main -->


 <!--ajax codes -->
<script type="text/javascript">
   
    function who_went_on_leave(){

    $("#who_went_on_leave_form").validate({
    
        rules: {
      start_date: {
                required: true,
            },
      end_date: {
                required: true,
            }, 
        },
        messages: {
            start_date:{
              required: "<span style='color:#ce0000;'>select the starting date!!</span>"
             },
             end_date:{
               required: "<span style='color:#ce0000;'>select the end date!!</span>"
             },
           },

        submitHandler: wentForm   
    });    

    /* Handling who went on leave form functionality */
    function wentForm() {     
        var data = $("#who_went_on_leave_form").serialize();                
         $.ajax({               
            type : 'post',
            url  : "<?php echo base_url() ?>hr_dashboard/who_went_on_leave",
            data : data,
            
        success : function(response){   
                $('#retrieved_report').html(response);
            }
        });
        return false;
    }

  }
   
   
   function who_coming_from_leave(){
    $("#coming_from_leave_form").validate({
    
        rules: {
      start_date: {
                required: true,
            },
      end_date: {
                required: true,
            }, 
        },
        messages: {
            start_date:{
              required: "<span style='color:#ce0000;'>select the starting date!!</span>"
             },
             end_date:{
               required: "<span style='color:#ce0000;'>select the end date!!</span>"
             },
           },

        submitHandler: comingForm   
    });    

   function comingForm(){
    var data = $("#coming_from_leave_form").serialize();                                
         $.ajax({               
            type : 'post',
            url  : "<?php echo base_url() ?>hr_dashboard/who_coming_from_leave",
            data : data,
        success : function(response){   
                $('#whoiscoming_report').html(response);  
            }
        });
        return false;
      }
   }


function who_to_be_on_leave(){
    $("#to_be_on_leave_form").validate({
    
        rules: {
      start_date: {
                required: true,
            },
      end_date: {
                required: true,
            }, 
        },
        messages: {
            start_date:{
              required: "<span style='color:#ce0000;'>select the starting date!!</span>"
             },
             end_date:{
               required: "<span style='color:#ce0000;'>select the end date!!</span>"
             },
           },

        submitHandler: toBeForm   
    });    

   function toBeForm(){
    var data = $("#to_be_on_leave_form").serialize();                                
         $.ajax({               
            type : 'post',
            url  : "<?php echo base_url() ?>hr_dashboard/who_to_be_on_leave",
            data : data,
  
        success : function(response){   
                $('#tobeonleave_report').html(response); 
            }
        });
        return false;
      }
   }

    function reject_leave(){
        var data = $("#hr_view_leave").serialize(); 
        $.ajax({
            url: "<?php echo base_url() . 'hr_dashboard/reject_employee_leave'; ?>",
            type: "POST",
            data: data,
            success: function (response) {
            location.reload();
            },
            error: function () {
                alert('Error Occured');
            }
        });
    }

    //here we'll start implementing autosuggest for the last date
      function complete_date(){
      var startDate = document.getElementById("leave_start_date").value;
      var leaveDays = parseInt(document.getElementById("days").value)-1;
      var errorMessageElement = document.getElementById("error_message");

      if (!isNaN(leaveDays) && startDate) {
         errorMessageElement.textContent = "";
        var startDateObj = new Date(startDate);
        var endDateObj = new Date(startDateObj.getTime() + (leaveDays * 24 * 60 * 60 * 1000));

        // Format the end date as "YYYY-MM-DD"
        var endDateFormatted = endDateObj.toISOString().split('T')[0];
        document.getElementById("leave_end_date").value = endDateFormatted;
      }else{
         document.getElementById("leave_start_date").value = "";
         errorMessageElement.textContent = "Number of days can't be left empty.";
      }
    }

    function change_endDate(){
    var startDate = document.getElementById("leave_start_date").value;
    var emergencyDays = parseInt(document.getElementById("days").value)-1;
    var startDateObj = new Date(startDate);
    var endDateObj = new Date(startDateObj.getTime() + (emergencyDays * 24 * 60 * 60 * 1000));
    // Format the end date as "YYYY-MM-DD"
    var endDateFormatted = endDateObj.toISOString().split('T')[0];
    document.getElementById("leave_end_date").value = endDateFormatted;
  }

  function fill_Districts(){
    var region = document.getElementById('region').value;
      var data = {"region_name":region};
      if(region != "Select region"){
      $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>hr_dashboard/district_autosuggestion",
        data: data,
        beforSend:function(){
          $("#wards").fadeOut();
        },
        success:function(response){
          $('#districts').html(response);
          document.getElementById('ward').value = "";
        }
      })
    }else{
      alert('please select the valid region');
    }
  }

  function fill_Wards(){
    var district = document.getElementById('district').value;
      var data = {"district_name":district};
      if(district != "Select District"){
      $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>hr_dashboard/ward_autosuggestion",
        data: data,
        success:function(response){
          $('#wards').html(response);
        }
      })
    }else{
      alert('please select the valid ward');
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