
<main id="main" class="main">

	<div class="pagetitle">
		<h1> Head Of Department Emergency Leave Appproval </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Emergency Leave Appproval</a></li>
			</ol>
		</nav>
	</div> <!--End of page title -->

	<div class="card">
    <div class="card-body">
    <!-- start of table for displaying data -->
    <div class="col-lg-12">
    <?= $this->session->flashdata('emergency_leave_sms'); ?>
    
    <h3 class="card-title"><b>List employee who needs emergency leave approval</b></h3>
    <div id="dept_head_approval_response_message"></div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col" class="col-sm-3">Full Name</th>
          <th scope="col">Days</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Reasons</th>
          <th scope="col">Comments</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $i=1;
          foreach ($emergency as $row){
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?= $row->names; ?></td>
            <td><?= $row->emergency_days; ?></td>
            <td><?= $row->start_date; ?></td>
            <td><?= $row->end_date; ?></td>
            <td><?= $row->sababu; ?></td>
            <td><?= $row->comments; ?></td>
            <td>
              <button type="button" class="btn  btn-primary"  onclick="view_emergency_leave(<?= $row->emergency_id; ?>)">View</button>
              <button type="button" class="btn btn-success" onclick="approve_emergency_leave(<?= $row->emergency_id; ?> , '<?= $row->names; ?>')">Approve</button>   
            </td>

            <?php $i++; ?>
          </tr>
          <?php
          } ?>
                          		
      </tbody>
      <tfoot>
        <th scope="col">No.</th>
        <th scope="col" class="col-sm-3">Full Name</th>
        <th scope="col">Days</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Reason</th>
        <th scope="col">Comments</th>
        <th scope="col">Action</th>
      </tfoot>
    </table>
  </div>
  <!-- End of displaying data table -->
  </div>
</div>


  <!-- View modal for head edit,update and reject -->
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
</main>

<script type="text/javascript">
  
  function view_emergency_leave(emergency_id){
    var data = {"emergency_id" : emergency_id};
    $('#view_modal').modal('show');
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>emergency_leave/View_emergency",
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

  function change_endDate(){
    var startDate = document.getElementById("start_date1").value;
    var emergencyDays = parseInt(document.getElementById("emergency_days").value)-1;
    var startDateObj = new Date(startDate);
    var endDateObj = new Date(startDateObj.getTime() + (emergencyDays * 24 * 60 * 60 * 1000));
    // Format the end date as "YYYY-MM-DD"
    var endDateFormatted = endDateObj.toISOString().split('T')[0];
    document.getElementById("end_date1").value = endDateFormatted;
  }

  function update_emergency(){
    var start_date = document.getElementById("start_date1").value;
    var emergencyDays = document.getElementById("emergency_days").value-1;
    var errorMessageElement = document.getElementById("error_message");
    var start_dateErrorMessageElement = document.getElementById("startdate_error_message");
    if(start_date == ""){
      start_dateErrorMessageElement.textContent = "start date field can't be left empty.";
    }else if(emergencyDays == ""){
      errorMessageElement.textContent = "Number of days can't be left empty.";
    }else{
    var data = $("#employee_emergency_form").serialize();                
         $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>emergency_leave/update_employee_emergency",
            data : data,
            beforeSend: function(){ 
                // $("#response_message").fadeOut();
            },
        success : function(response){  
                window.location.reload(); 
            }
        });
       }
        return false;
  }

  function approve_emergency_leave(emergency_id,employee_names){
    var data = {
      "emergency_id" : emergency_id,
      "employee_names" : employee_names
    };
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>emergency_leave/hd_approve_emergency_leave",
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

  function send_to_hr(emergency_id,employee_names){
    var data = {
      "emergency_id" : emergency_id,
      "employee_names" : employee_names
    };
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>emergency_leave/hd_send_to_hr",
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


