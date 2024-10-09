<main id="main" class="main">

	<div class="pagetitle">
		<h1> Wategemezi Form  </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Wategemezi</li>
			</ol>
		</nav>
	</div> <!--End of page title -->


  <div class="card">
    <div class="card-body">
      <div class="card-title text-center">
        FAME MEDICAL WATEGEMEZI FORM <br />
        FOMU YA MAPITIO YA MAJINA YA WATEGEMEZI WA MTUMISHI.
      </div>
      <p><?= $this->session->flashdata('wategemezi_save_sms'); ?></p>
      <table class="table table-striped datatable text-center">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Majina Ya Mtumishi</th>
            <th>Idara</th>
            <th>Jumla ya wategemezi</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $count = 1;
            foreach($data as $row){ ?>
              <tr>
                <td><?= $count; ?></td>
                <td><?= $row['names']; ?></td>
                <td><?= $row['dept_name']; ?></td>
                <td><?= $row['wategemezi']; ?></td>
                <td>
                  <a href="<?php echo base_url() . "wategemezi/hr_wategemezi_review/view_more_page/" . $row['employee_id']; ?>" title="view & edit wategemezi"><span class="bi bi-edit"></span>Edit</a> || 
                  <a href="<?php echo base_url()."wategemezi/hr_wategemezi_review/save_wategemezi/".$row['employee_id']; ?>" title="Save Wategemezi"><span class="bi bi-save"></span></a>
                </td>
              </tr>
            <?php $count++; }
          ?>
        </tbody>
      </table>                             
                                    
    </div>
  </div>
</main>

<script type="text/javascript">
  
  function Edit_wategemezi(employee_id){
     $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>",
          data:{
                "employee_id" : employee_id
              },
          beforSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            
          }
      });
  }
</script>