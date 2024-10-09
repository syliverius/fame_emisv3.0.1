<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add/Edit Inventory Items</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Welcome to Inventory Items</li>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#dashboard">Inventory Dashboard</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#summary">Inventory Reports</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

<!--********************************** INVENTORY DASHBOARD *********************************************-->
                <div class="tab-pane show active" id="dashboard">
                  
                  <!-- here we will be creating inventory dashoard -->
                  <div class="card text-center">
                    <div class="card-body">
                      <!-- start of table for displaying data -->
                      <div class="col-lg-12">
                        <h3 class="card-title"><b>WELCOME TO INVENTORY DASHBOARD </b></h3>
                          <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col" class="col-sm-3">Item Name</th>
                              <th scope="col" class="col-sm-3">Counts</th>
                              <th scope="col" class="col-sm-3">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            foreach ($item_count as $row){
                              ?>
                              <tr>
                                <td><?= $row['item_name']; ?></td>
                                <td><?= $row['total']; ?></td>
                                <td><button class="btn  btn-primary" onclick="ViewMore(<?= $row['item_id']; ?>)">View</button></td>
                              </tr>
                            <?php
                            } ?>
                          </tbody>
                        </table>
                        </div>
                      <!-- End of displaying data table -->
                    </div>
                  </div>
                </div>
<!--**********************************END OF INVENTORY DASHBOARD *********************************************-->

<!--**********************************ITEMS SUMMARY DEPARTMENT-WISE TAB*********************************************-->  

                <div class="tab-pane fade pt-3" id="summary">

                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">OOOOOPS!!!!</h4>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert"> <b>Sorry!!!</b><i>  This Tab is under construction </i><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                    </div>
                  </div>

                  <!-- start to display department's items -->
                  <div id="department_items"></div>
                </div>
<!--**********************************END OF ITEMS SUMMARY*********************************************-->
  
                  </div> 
                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
    </section>

    <!--ALL MODEL WILL BE IMPLEMENTED HERE-->
      <!-- ITEM SUMMARY VIEW -->
    <div class="modal fade" id="item_summary_department" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div id="item_summary_dept"></div>
          
        </div>
      </div>
    </div> 
</main><!-- End #main -->

<script type="text/javascript">

  function ViewMore(item_id){
    $('#item_summary_department').modal('show');

    $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>inventory/inventory_dashboard/item_allocation",
            data: {
              "inventory_id" : item_id
            },
            beforSend: function()
            {
               $('#item_summary_dept').html();
            },
            success: function(response){
               $('#item_summary_dept').html(response);
            },
            error: function ()
            {
              //write something in here
            },
        });
  }

</script>