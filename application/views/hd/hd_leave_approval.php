<main id="main" class="main">

	<div class="pagetitle">
		<h1> Head Of Department Leave Appproval </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Leave Appproval</a></li>
			</ol>
		</nav>
	</div> <!--End of page title -->

	<div class="card">
    <div class="card-body">
      <!-- start of table for displaying data -->
      <div class="col-lg-12">
        <?php echo $this->session->flashdata('hd_success_message'); ?>
        <?php echo $this->session->flashdata('hd_update_message'); ?>
        <h3 class="card-title"><b>List employee who needs leave approval</b></h3>
        <div id="dept_head_approval_response_message"></div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col" class="col-sm-3">Full Name</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Destination Region</th>
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
          			<td>
                  <button type="button" class="btn  btn-primary more_details_btn"  data-id="<?= $row['benefit_id']; ?>" >More Details</button>
                  <button type="button" class="btn btn-success dept_head_approve_btn" 
                    data-id="<?= $row['benefit_id']; ?>" 
                    data-name="<?= htmlspecialchars($row['names']); ?>">Approve</button>
   
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
              <th scope="col">Action</th>
          </tfoot>
        </table>
        </div>
      <!-- End of displaying data table -->
    </div>
  </div>


  <!-- In here we're going to emplement view more details modal -->
  <div class="modal fade" id="more_details_modal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <b>LEAVE APPLICATION FORM  </b></h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <form method='post' action='<?= base_url(); ?>leave_approval_dept_head/hd_update_employee_leave'>
              <div id="more_details_data">
                <!-- in here we will insert edit data from the database using javascrip/ajax -->
              </div>
              <div class="modal-footer">
                <button type='submit' class='btn btn-primary'>Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>

</main>

<script type="text/javascript">
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
</script>


