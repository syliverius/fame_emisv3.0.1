<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.6
 * @since       2023-11-22
 * @description This page is used to present audit trail specifics to generate report .
 * @license     Open Source

-->

<main id="main" class="main">
    <div class="pagetitle">
	   <h1>Audit Trial </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Audit_Trial</a></li>
			</ol>
		</nav>
	</div> <!--End of page title -->

	<div class="card">
		<div class="card-body">
			<div class="card-title">System usage surveillance</div>
			<!-- Settings Form -->
            <div id="book2_response_message"></div>
            <form method="post" id="audit_form">
                <div class="row">
                    <label for="input_file" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-3">
                      <input class="form-control" type="date"  name="start_date" id="start_date">
                    </div>
                    <label for="input_file" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-3">
                      <input class="form-control" type="date" name="end_date" id="end_date">
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-primary" onclick="audit_trial(event)">Create</button>
                    </div>
                </div>
            </form>
            <br />
        <div id="audit_trial_report"></div>
		</div>
	</div>
</main>

<script type="text/javascript">

    function audit_trial(e){
        e.preventDefault();
        var data = $('#audit_form').serialize();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if(start_date === '' || end_date === ''){
            alert("Start and End dates must be selected!!");
        }else{
        $.ajax({
            type : 'post',
            url : "<?php echo base_url(); ?>reports/reports/generate_audit_trial",
            data : data,
            beforeSend: function(){
            },
            success: function(response){
                $('#audit_trial_report').html(response);
            }
        });
    }
        return false;
    }
</script>