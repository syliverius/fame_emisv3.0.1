<main id="main" class="main">

<div class="pagetitle">
  <h1>Monthly Roster</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="" href="<?php echo base_url('profile_management'); ?>">Home /
        <span>Monthly Roster</span>
      </a>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card-body">
  <div class="col-lg-12">
    <?php $this->load->view('Monthly_Roaster/department_monthly_roaster_specifics'); ?>
  <div id="monthly_roster_summary"></div>
  </div>
</div>

</main><!-- End #main -->

