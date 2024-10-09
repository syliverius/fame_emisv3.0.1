<main id="main" class="main">

    <div class="pagetitle">
      <h1>Create Roaster</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management'); ?>">Home</a></li>
          <li class="breadcrumb-item">Create Roaster</li>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#create_roaster">Create Roaster</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#import_roaster">Import Excel Roaster</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#view_roaster">View Roaster</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active create_roaster" id="create_roaster">
                  
                  <!-- this part was transferred hd/create_annual_roster_form -->
                  <?php $this->load->view('hd/create_annual_roster_form'); ?>

                  <!-- this is for already created leaves -->
                  <div id="this_year_created_roster">
                    <?php $this->load->view('hd/created_leaves_this_year_summary'); ?>
                  </div>
                </div>
                  
                <div class="tab-pane fade import_roaster pt-3" id="import_roaster">

                  <!-- import excel roaster -->

                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">Importing roaster created in excel sheet </div>
                      <form method="post" id="upload_excel_form" enctype="multipart/form-data">
                        <!-- print error or success message -->
                        <div id="upload_response_message"></div>
                       <div class="row mb-3">
                          <label for="input_file" class="col-sm-2 col-form-label">Excel File Upload</label>
                        <div class="col-sm-6">
                          <input class="form-control" type="file" id="excel_roaster" name="excel_roaster">
                        </div>
                        <div class="col-sm-2">
                          <button type="submit" class="btn btn-primary" id="upload_roaster_btn" name="upload_roaster">Upload</button>
                        </div>
                        </div>
                      </form>
                    </div>
                  </div>

                  <!-- End import excel sheet -->

                </div>

                <div class="tab-pane fade pt-3" id="view_roaster">
                  <?php $this->load->view('hd/annual_roster_specifics'); ?>
                  
                  <!-- it is here where we'll insert data from the database -->

                </div>
                </div>
              </div><!-- End Bordered Tabs -->
            </div>
          </div>

        </div>
      </div>
    </section>

    <div class="modal fade" id="delete_roaster_model" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="forms-sample" method="post" action="<?= base_url(); ?>create_roaster/delete_roaster_data">
        <div class="modal-body" id="delete_modal_body">
          <!-- in here we will insert data retrieved by ajax query -->
        </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <!--here we create edit model -->
      <div class="modal fade" id="roaster_edit_modal" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <form class="forms-sample"  id="update_roster" method="post" action="create_roaster/update_roaster_data">
            <div class="modal-body" id="edit_modal_data">
              <!-- in here we will insert edit data from the database using javascrip/ajax -->
            </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!--End of edit model -->
  </main><!-- End #main -->
 <!--ajax codes for auto suggestion -->
 <script type="text/javascript">

  $('input.typeahead').typeahead({
      source:  function (query, process) {
      return $.get('<?php echo base_url('create_roaster/department_Members_AutoSuggestion'); ?>', { query: query }, function (response) {
              console.log(response);
              response  = $.parseJSON(response);
              return process(response);
          });
      }
  });

  /* 
      We must avoid all the script that goes to the server without the necessity
  */

  function create_end_date(){
    var startDate = $('#startDate').val();
    var annual_days = 27;
    var startDateObj = new Date(startDate);
    var endDateObj = new Date(startDateObj.getTime() + (annual_days * 24 * 60 * 60 * 1000));
    var endDateFormatted = endDateObj.toISOString().split('T')[0];
    document.getElementById("endDate").value = endDateFormatted;
  }



  function get_end_date(){
    var startDate = $('#startDate_update').val();
    var annual_days = 27;
    var startDateObj = new Date(startDate);
    var endDateObj = new Date(startDateObj.getTime() + (annual_days * 24 * 60 * 60 * 1000));
    var endDateFormatted = endDateObj.toISOString().split('T')[0];
    document.getElementById("endDate_update").value = endDateFormatted;
  }

  function delete_annual_roster_member(names,employee_id){
    $('#delete_roaster_model').modal('show');
    $('#delete_modal_body').html("Do you really want to delete <span><em><b>"+names+"</b></em></span> from current roaster <input type='text' name='employee_id' value='"+employee_id+"' hidden><input type='text'  name='names' value='"+names+"' hidden>"); 
  }
</script>
<!--End of auto-suggestion code -->