<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.6
 * @since       2023-11-25
 * @description On admin dashboard we create monthly duty roster shifts
 * @license     Open Source

-->

<?php $this->load->helper('annual_leave_helper'); ?>
<main id="main" class="main">
  	<div class="pagetitle">
	    <h1>Creating new monthly roster shift</h1>
	    <nav>
	      <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
	        <li class="breadcrumb-item">New Shift</a></li>
	      </ol>
	    </nav>
	</div> <!--End of page title -->
	<div class="content-wrapper">
	    <section class="content">
	        <center class="codrops-demos">
	            <a href="<?php echo base_url(); ?>admin_dashboard" class="btn btn-primary" title="Back to Other User Groups">&Ll; Shift Abrreviations / Admin Panel</a>
	        </center> <br />
	        <div class="card">
	        	<div class="card-body">
	        		<div class="card-title">Specify the information to create new Shift</b></div>
	        		<div><?= $this->session->flashdata('new_shift_response'); ?></div>
				    <form class="row g-3" method="post" action="<?= base_url()."admin_dashboard/insert_new_shift_info"; ?>">
				        <div class="col-md-4">
				          <label for="Shif_name">Shift Name</label>
				          <input type="text" class="form-control" name="shift_name">
				        </div>
				        <div class="col-md-4">
				          <label for="Abbreviation">Abbreviation</label>
				          <input type="text" class="form-control" name="Abbreviation">
				        </div>
				        <div class="col-md-4">
				          <label for="box_color">Box Color</label>
				          <input type="text" class="form-control" name="box_color" placeholder="eg. FFFFFF">
				        </div>
				        <div class="col-md-12">
				        	<div class="row">
				          <label for="departments"><b>Departments:</b></label><br />
				          <?php  
				          	$departments = $this->hr->getDepartments();
				          	foreach($departments as $department){ ?>
				          		<div class="col-md-3">
					          		<div class="form-check">
					          			<input class="form-check-input" type="checkbox" name="department_check[]" value="<?= $department->department_id; ?>">
					          		<label class="form-check-label" for="gridCheck2">
				                        <?= $department->department_name; ?>
				                    </label>
				                    </div>
				                </div>
				        	<?php } ?>
				    	</div><br />
				    	<div class="row">
						    <div class="col-md-4">
					          <label for="text_color">Text Color</label>
					          <input type="text" class="form-control" name="text_color" placeholder="eg. FFFFFF">
						    </div>
						    <div class="col-md-4">
						          <label for="Work_period">Work Period</label>
						          <select class="form-control" name="Work_period">
						          	<?php 
						          	 $periods = monthly_roster_work_periods();
						          	 foreach($periods as $period){
						          	 		echo "<option value=".$period.">".$period."</option>";
						         		}
						          	?>
						          </select>
						    </div>
						</div><br />

				        <div class="text-center">
				          <button type="submit" class="btn btn-primary">Create</button>
				          <button class="btn btn-danger" type="reset">Cancel</button>
				        </div>
				    </form>
	        	</div>
	        </div>
	    </section>
	</div>	
</main>