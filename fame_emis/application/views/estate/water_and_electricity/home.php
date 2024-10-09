<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2023-12-30
 * @description Data inserts forms for facility's water and electricity bills and units
 * @license     Open Source

-->

<main id="main" class="main">
  <div class="pagetitle">
    <h1>WATER && ELECTRICITY USAGES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management'); ?>">Home</a></li>
        <li class="breadcrumb-item">Welcome to facility Electricity && water fuel usages</li>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#electrIcity"> Electricity usage Form</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#water">Water Usages Form</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#add_attributes">Add More Electricity locations/Water Pumps</button>
              </li>
            </ul>
            <div class="tab-content pt-2">

              <!--    *** FUEL CONSUMPTION FORM ***   -->

              <div class="tab-pane show active" id="electrIcity">
                <div class="card">
                   <?php $this->load->view('estate/water_and_electricity/electricity_usage'); ?>
                </div>
                <div id="Monthly_electricity_usage"></div>
              </div> 

              <!--    *** END ***   -->


              <!--    *** AVAILABLE CARS FORM ***   -->

              <div class="tab-pane fade pt-3" id="water">
                  <?php //$this->load->view('hr/who_went_on_leave');?>
              </div>

              <!--    *** END ***   -->

              <!--    *** OTHER SUMMARIES ***   -->
              <div class="tab-pane fade pt-3" id="add_attributes">
                <div id="add_location_pane">
                 <?php $this->load->view('estate/water_and_electricity/add_electricity_location'); ?>
                </div>
              </div>

              <!--    *** END ***   --> 

            </div> <!-- End of Tab Body -->
          </div><!-- End Of Main Card Body -->
        </div> <!-- End Of Main Card -->
      </div> <!-- End Of Main Column Div -->
    </div> <!-- End Of Main Row Div -->
  </section>
  <!--ALL MODEL WILL BE IMPLEMENTED HERE-->
</main><!-- End #main -->

<script type="text/javascript">
  function formToggle(elementId) {
        var element = document.getElementById(elementId);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }

    function add_new_location(){
      var data = $("#addNewLocationForm").serialize();
        $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>estate/add_new_electricity_location",
            data : data,
            beforeSend: function(){ 
            },
            success : function(response){
              $('#add_location_pane').html(response);
              }
            });
        return false;
    }

    function create_usage_form(e){
      var data = $('#electricity_usage_form').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>estate/electricity_usage_form",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#Monthly_electricity_usage').html(response);
          }
        });
      return false;
    }

    function create_electricity_usage(){
      var data = $('#new_usage_form').serialize();
      $('button[name="create_electricity_btn"]').prop('disabled', true);
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>estate/create_new_usage",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#Monthly_electricity_usage').html(response);
          }
        });
      return false;
    }

function update_electricity_usage(){
  var data = $('#edit_usage_form').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>estate/Update_electricity_usage",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#Monthly_electricity_usage').html(response);
          }
        });
      return false;
}
</script>