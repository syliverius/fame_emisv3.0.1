<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.6
 * @since       2023-11-24
 * @description This form edits Shifts presented on monthly duty roster
 * @license     Open Source

-->
<?php $this->load->helper('annual_leave_helper'); ?>
<main id="main" class="main">
  	<div class="pagetitle">
	    <h1>Shift Info View and Editing</h1>
	    <nav>
	      <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
	        <li class="breadcrumb-item">Shift Information </a></li>
	      </ol>
	    </nav>
	</div> <!--End of page title -->
	<div class="content-wrapper">
	    <section class="content">
	        <center class="codrops-demos">
	            <a href="<?php echo base_url(); ?>admin_dashboard" class="btn btn-primary" title="Back to Other User Groups">&Ll; Shift Abrreviations / Admin Panel</a>
	        </center> <br />
	        <?php $shift_info = $this->admin->get_shift_information($shift_id); ?>
	        <div class="card">
	        	<div class="card-body">
	        		<div class="card-title">Edit shift info for : <b><?= $shift_info->name; ?></b></div>
	        		<div id="response_message"><?= $this->session->flashdata('shift_update'); ?></div> <!--  we will be setting flashdata-->
				    <form class="row g-3" method="post" action="<?= base_url()."admin_dashboard/update_shift_info "; ?>">
				    	<input type="text" name="shift_id" value="<?= $shift_id; ?>" hidden>
				        <div class="col-md-4">
				          <label for="Shif_name">Shift Name</label>
				          <input type="text" class="form-control" name="shift_name" value="<?= $shift_info->name;?>" readonly>
				        </div>
				        <div class="col-md-4">
				          <label for="Abbreviation">Abbreviation</label>
				          <input type="text" class="form-control" name="Abbreviation" value="<?= $shift_info->abbreviation; ?>" readonly>
				        </div>
				        <div class="col-md-4">
				          <label for="box_color">Box Color</label>
				          <input type="text" class="form-control" name="box_color" value="<?= $shift_info->color; ?>" >
				        </div>
				        <div class="col-md-12">
				        	<div class="row">
				          <label for="departments"><b>Departments:</b></label><br />
				          <?php  
				          	$departments = $this->hr->getDepartments();
				          	$supplied_depts = explode(',',$shift_info->department_ids);
				          	foreach($departments as $department){ ?>
				          		<div class="col-md-3">
					          		<div class="form-check">
					          		<?php if(in_array($department->department_id, $supplied_depts)){ ?>
					          			<input class="form-check-input" type="checkbox" name="department_check[]" value="<?= $department->department_id; ?>" checked>
					          		<?php }else{ ?>
					          			<input class="form-check-input" type="checkbox" name="department_check[]" value="<?= $department->department_id; ?>">
					          		<?php } ?>
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
					          <input type="text" class="form-control" name="text_color" value="<?= $shift_info->text_color; ?>">
						    </div>
						    <div class="col-md-4">
						          <label for="Work_period">Work Period</label>
						          <select class="form-control" name="Work_period">
						          	<?php 
						          	 $periods = monthly_roster_work_periods();
						          	 foreach($periods as $period){
						          	 	if($shift_info->work_period == $period){
						          	 		echo "<option value=".$period." selected>".$period."</option>";
						          	 	}else{
						          	 		echo "<option value=".$period.">".$period."</option>";
						          	 	}
						         	}
						          	?>
						          </select>
						    </div>
						</div><br />

				        <div class="text-center">
				          <button type="submit" class="btn btn-primary">Update</button>
				          <button class="btn btn-danger" type="reset">Cancel</button>
				        </div>
				    </form>
	        	</div>
	        </div>
	    </section>
	</div>	
</main>	
