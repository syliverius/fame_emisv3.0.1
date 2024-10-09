<main id="main" class="main">

	<div class="pagetitle">
		<h1> Menu Book Audit Trail</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Menu Book Audit Trail</li>
			</ol>
		</nav>
	</div> <!--End of page title -->

  <div class="card">
    <div class="card-body">
       
       <div class="card">
        <div class="card-body">
          <div class="card-title">Create Menu Book Trial</div>
          <div><?php echo $this->session->flashdata('new_book_response'); ?></div> <!-- as a flashdata -->
          <!-- Settings Form -->
          <form id="audit_trial_specifications">
            <div class="row mb-3">
              <label for="date" class="col-sm-2 col-form-label">Select Date</label>
              <div class="col-sm-4">
                <input type="date" class="form-control" id="date" name="date">  
              </div>
              <label for="location" class="col-sm-2 col-form-label">Select Ward</label>
              <div class="col-sm-4">
                <select class="form-control" id="ward" name="ward">
                  <option value="">Select Ward...</option>
                  <option value="Ward One"> Medical Ward </option>
                  <option value="Surgical Ward"> Surgical Ward </option>
                  <option value="Maternity Ward"> Maternity Ward </option>
                </select>
              </div> <br/>
            </div>
            <center>
              <div class="col-sm-2">
                  <button type="button" class="btn btn-primary" onclick="generate_audit_trial(event)">create</button>
              </div>
            </center>
          </form>
        </div>
      </div>

      <div id="audit_trial_report"></div>           
    </div>
  </div>
</main>

<script type="text/javascript">
  
  function generate_audit_trial(e){
    var ward = document.getElementById('ward').value;
    var date = document.getElementById('date').value;
    if(!ward || !date){
      alert("Please make sure you select correct date and location");
    }else{
      var data = $('#audit_trial_specifications').serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/generate_menu_audit_report",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#audit_trial_report').html(response);
          }
        });
      return false;
    }
  }

</script>