<main id="main" class="main">

  <div class="pagetitle">
    <h1>Create Monthly Roaster</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
        <li class="breadcrumb-item">Create Roaster</a></li>
      </ol>
    </nav>
  </div> <!--End of page title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs d-flex">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#roaster_create">Monthly Roaster creation</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#roaster_summary">Monthly Roaster Summary</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#attributes">Add New Attributes </button>
              </li>
            </ul>


          <div class="tab-content pt-2">

<!--**********************************  Monthly roaster form*********************************************-->
          <div class="tab-pane show active" id="roaster_create">            
              <?php $this->load->view('Monthly_Roaster/roaster_specifics_form'); ?>
              <div id="monthly_roaster"></div>
          </div>
<!--**********************************END OF monthly roaster form   *********************************************-->

  
<!--**********************************START OF monthly roaster summary********************************************--> 

          <div class="tab-pane pt-3" id="roaster_summary">
            <?php $this->load->view('Monthly_Roaster/roster_summary_specifics'); ?>
            <div id="monthly_summary"></div>
          </div> 
<!--**********************************END of monthly roaster summary *********************************************-->  

<!--********************************* START of creating new shift tyep *********************************************-->
          <div class="tab-pane pt-3" id="attributes">
            <div id="new_shift"></div>
            <!-- this role moved to admin dashboard -->
          </div>
<!--********************************* END of creating new shift tyep *********************************************-->  

                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
    </section> 

    <!-- all modal goes here -->
</main>

<script type="text/javascript">

  function generate_roaster(e){
    var data = $('#department_roaster').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/present_roaster",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#monthly_roaster').html(response);
          }
        });
      return false;
  }
  
  function publish_roaster(event){
    const parentElement = document.querySelector('#monthly_roaster');
    const form = parentElement.querySelector('#roaster');
    
    //select all the form text input
      const textInputs = form.querySelectorAll('input[type="text"][id="days"]');
      const textInputs2 = form.querySelectorAll('input[type="text"][id="shifts"]');
      for (let i = 0; i < textInputs.length; i++) {
        if(checkShiftAbbr(textInputs[i].value.trim(),textInputs2)){
          alert('Unknown letter filled, please use the abbreviated letter on top of the table');
          event.preventDefault();
          return;
      }else{
        //
      }
    }

    var data = $('#roaster').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/publish_roaster",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#monthly_roaster').html(response);
          }
        });
      return false; 
  }


  function update(event){
    const parentElement = document.querySelector('#monthly_roaster');
    const form = parentElement.querySelector('#roaster_update');
    
    //select all the form text input
      const textInputs = form.querySelectorAll('input[type="text"][id="days"]');
      const textInputs2 = form.querySelectorAll('input[type="text"][id="shifts"]');
      for (let i = 0; i < textInputs.length; i++) {
      if(checkShiftAbbr(textInputs[i].value.trim(),textInputs2)){
          alert('Unknown letter filled, please use the abbreviated letter on top of the table');
          event.preventDefault();
          return;
      }else{
      }
    }

    var data = $('#roaster_update').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/update_monthly_roaster",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#monthly_roaster').html(response);
          }
        });
      return false; 
  }

  function mid_month_update(){
    const parentElement = document.querySelector('#monthly_roaster');
    const form = parentElement.querySelector('#mid_roaster_update');
    const comment =  form.querySelector('textarea[id="update_reason"]').value.trim();
    
    //select all the form text input
      const textInputs = form.querySelectorAll('input[type="text"][id="days"]');
      const textInputs2 = form.querySelectorAll('input[type="text"][id="shifts"]');
      for (let i = 0; i < textInputs.length; i++) {
      if(checkShiftAbbr(textInputs[i].value.trim(),textInputs2)){
          alert('Unknown letter filled, please use the abbreviated letter on top of the table');
          event.preventDefault();
          return;
      }else if(comment == ""){
        alert('Please you must state the reasons for the changes you have made');
          event.preventDefault();
          return;
      }else{
      }
    }

    var data = $('#mid_roaster_update').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/mid_month_update",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#monthly_roaster').html(response);
          }
        });
      return false; 
  }

  function checkShiftAbbr(input,shifts){
    var result = true;
    for(i = 0; i < shifts.length; i++){
      if (input == shifts[i].value.trim() || input == ''){
        result = false;
      }
    }
    return result;
  }

  function generate_hd_roaster_summary(event){
    var data = $('#dept_roster_summary').serialize();

        $.ajax({               
          type : 'POST',
          url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/hd_roaster_summary",
          data : data,
          beforeSend: function(){ 
            // $("#response_message").fadeOut();
          },
          success : function(response){
              $('#monthly_summary').html(response);
            }
          });
        return false;
  }

  function Create_new_shift(event){
    const textInput1 = document.querySelector("#attr_name").value;
    const textInput2 = document.querySelector("#attr_abbr").value;
    

    if(textInput1 =="" || textInput2==""){
        alert('Please fill in all the required fields');
        event.preventDefault();
        return;
    }else{
      //after validation we insert data into the database
      var data = $('#new_attribute').serialize();

    $.ajax({               
          type : 'POST',
          url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/Create_new_shift",
          data : data,
          beforeSend: function(){ 
            // $("#response_message").fadeOut();
          },
          success : function(response){
              $('#new_shift').html(response);
            }
          });
        return false;
      }
    }

</script>