<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2023-12-30
 * @description Data insert for generator and machines forms
 * @license     Open Source

-->

<main id="main" class="main">
  <div class="pagetitle">
    <h1>GENERATORS && MACHINES FUEL USAGE AND PURCHASES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management'); ?>">Home</a></li>
        <li class="breadcrumb-item">Welcome to facility generators and machines fuel usages</li>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#fuel_puchases">Fuel Purchased Forms</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fuel_usage">Fuel Usages Form</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#add_attributes">Add More Shells/Machines</button>
              </li>
            </ul>
            <div class="tab-content pt-2">

              <!--    *** FUEL PURCHASE FORM ***   -->

              <div class="tab-pane show active" id="fuel_puchases">
                <div id="fuel_purchases_pane">
                  <div class="card">
                   <?php $this->load->view('estate/generator_and_machines/fuel_purchase'); ?>
                  </div>
                </div>
              </div> 

              <!--    *** END ***   -->


              <!--    *** FUEL USAGE FORM ***   -->

              <div class="tab-pane fade pt-3" id="fuel_usage">
                <div id="fuel_usage_pane">
                  <?php $this->load->view('estate/generator_and_machines/fuel_usage'); ?>
                </div>
              </div>
              <!--    *** END ***   -->

              <!--    *** ADD MORE MACHINES AND GENERATORS ***   -->
              <div class="tab-pane fade pt-3" id="add_attributes">
                <div id="add_attributes_pane">
                 <?php $this->load->view('estate/generator_and_machines/add_shell_and_machines'); ?>
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

    function create_new_machine(){ //use sms1 and sms2 
      var data = $("#addNewMachineForm").serialize();
        $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>estate/add_new_machine",
            data : data,
            beforeSend: function(){ 
            },
            success : function(response){
              $('#add_attributes_pane').html(response);
              }
            });
        return false;
    }

    function create_new_Shell(){
      var data = $("#addNewShellForm").serialize();
        $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>estate/add_new_fuel_station",
            data : data,
            beforeSend: function(){ 
            },
            success : function(response){
              $('#add_attributes_pane').html(response);
              }
            });
        return false;
    }

    function create_fuel_purchase(){
      var data = $("#fuel_puchases_form").serialize();
        $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>estate/fuel_purchases",
            data : data,
            beforeSend: function(){ 
            },
            success : function(response){
              $('#fuel_purchases_pane').html(response);
              }
            });
        return false;
    }

    function record_machines_fuel_usage(){
      var data = $("#fuel_usage_form").serialize();
        $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>estate/fuel_usage",
            data : data,
            beforeSend: function(){ 
            },
            success : function(response){
              $('#fuel_usage_pane').html(response);
              }
            });
        return false;
    }
</script>