<main id="main" class="main">

<div class="pagetitle">
  <h1>Hospital Menu Book</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="" href="<?php echo base_url('profile_management'); ?>">Home /
        <span>Menu Book</span>
      </a>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card-body">
  <div class="col-lg-12">
    <?php $this->load->view('menu/menu_book_specifics'); ?>
  <div id="menu_book"></div>
  </div>
</div>

<!-- menu information editing modal -->
<div class="modal fade" id="menu_editing_modal" tabindex="-1" data-bs-backdrop="false">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method='post' id="menu_editing_form">
        <div id="menu_retrieved_info">
          <!-- Here we will pass modal data from the database -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="menu_discharge()">Discharge</button>
          <button type="button" class="btn btn-primary" onclick="menu_update()">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<!-- right after discharge new pt clean form  -->
<div class="modal fade" id="menu_new_patient_modal" tabindex="-1" data-bs-backdrop="false">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method='post' id="new_patient_menu">
        <div id="new_patient_menu_div"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="Submit_new_Menu()">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div> 

</main><!-- End #main -->

<script type="text/javascript">

  function create_book(e){
    var location = document.getElementById('ward').value;
    var date = document.getElementById('date').value;
    if(!location || !date){
      alert("Please make sure you select correct date and location");
    }else{
      var data = $('#menu_specifics_form').serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/generate_book",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#menu_book').html(response);
          }
        });
      return false;
    }
  }

  function submit_new_book(e){
    e.preventDefault();
    var data = $('#new_book_form').serialize();
     $('button[name="submit_btn"]').prop('disabled', true);
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/submit_new_book",
        data : data,
        beforeSend: function(){ 
        },
        success : function(response){
            window.location.reload();
          }
        });
    return false;
  }

  function showPresentMenu(id){
     var data = { "menu_id" : id};
    $('#menu_editing_modal').modal('show');
    $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>menu/generate_menu_info",
            data: data,
            beforSend: function()
            {
               // $('#employee_annual_leave_details').html();
            },
            success: function(response){
               $('#menu_retrieved_info').html(response);
            },
            error: function ()
            {

            }
        });
    return false;
  }

  function menu_update(){
    var data = $("#menu_editing_form").serialize();
    $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/edit_menu_info",
        data : data,
        beforeSend: function(){ 
        },
        success : function(response){
          $('#menu_editing_modal').modal('hide');
          $('#menu_book').html(response);
          }
        });
    return false;
  }

  function menu_discharge(){
    if (confirm("are you sure you want to discharge this patient")) {
      var data = $("#menu_editing_form").serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/discharge_patient_menu",
        data : data,
        beforeSend: function(){ 
        },
        success : function(response){
          $('#menu_editing_modal').modal('hide');
          $('#menu_book').html(response); // new empty line for discharged patient 
          }
        });
    return false;
    }
  }

  function showNewMenu(data){
    $('#menu_new_patient_modal').modal('show');
    var info = {"data" : data};
    $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/new_patient_menu_info",
        data : info,
        beforeSend: function(){ 
        },
        success : function(response){
          // $('#menu_new_patient_modal').modal('show');
          $('#new_patient_menu_div').html(response);
          }
        });
    return false;
  }

  function Submit_new_Menu(){
    var data = $("#new_patient_menu").serialize();
    $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/new_patient_menu_insert",
        data : data,
        beforeSend: function(){ 
        },
        success : function(response){
          $('#menu_new_patient_modal').modal('hide');
          $('#menu_book').html(response); //with new inserted information 
          }
        });
    return false;
  }



</script>