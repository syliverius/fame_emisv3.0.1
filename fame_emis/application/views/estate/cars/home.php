<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2023-12-30
 * @description Data insert for facility's cars usages 
 * @license     Open Source

-->

<main id="main" class="main">
  <div class="pagetitle">
    <h1>FACILITY CARS UTILIZATION</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management'); ?>">Home</a></li>
        <li class="breadcrumb-item">Welcome to facility cars expenses</li>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#fuel_consumption">Fuel Consumption Forms</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cars_types">Available Cars</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#summary">Summaries</button>
              </li>
            </ul>
            <div class="tab-content pt-2">

              <!--    *** FUEL CONSUMPTION FORM ***   -->

              <div class="tab-pane show active" id="fuel_consumption">
                <div id="fuel_consumption_pane">
                  <div class="card">
                   <?php $this->load->view('estate/cars/cars_fuel_consumption'); ?>
                  </div>
                    <?php $this->load->view('estate/cars/this_year_car_summary'); ?>
                </div>
              </div> 

              <!--    *** END ***   -->


              <!--    *** AVAILABLE CARS FORM ***   -->

              <div class="tab-pane fade pt-3" id="cars_types">
                <div class="card">
                  <div class="card-body">
                    <div id="cars_pane">
                      <?php $this->load->view('estate/cars/available_cars');?>
                    </div>
                  </div>
                </div>
              </div>

              <!--    *** END ***   -->

              <!--    *** OTHER SUMMARIES ***   -->
              <div class="tab-pane fade pt-3" id="summary">
                 <div class="card">
                   <?php $this->load->view('estate/cars/car_fuel_utilization_summary'); ?>
                 </div>
                 <div id="car_annual_report"></div>
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


    function Add_new_car(){
        var data = $("#addNewCarForm").serialize();
        $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>estate/Add_new_car",
            data : data,
            beforeSend: function(){ 
            },
            success : function(response){
              $('#cars_pane').html(response);
              }
            });
        return false;
    }

    function create_cars_record(){
      var car_name = document.getElementById('car_id').value;
      var month = document.getElementById('month').value;
      if(!car_name || !month){
        alert("Please select valid car name and month");
      }else{
        var data = $("#fuel_consumption_form").serialize();
          $.ajax({               
              type : 'POST',
              url  : "<?php echo base_url() ?>estate/add_cars_consumption_record",
              data : data,
              beforeSend: function(){ 
              },
              success : function(response){
                $('#fuel_consumption_pane').html(response);
                }
              });
          return false;
      }
    }

    function create_car_report(e){
        var data = $("#car_annual_report_form").serialize();
          $.ajax({               
              type : 'POST',
              url  : "<?php echo base_url() ?>estate/create_car_annual_report",
              data : data,
              beforeSend: function(){ 
              },
              success : function(response){
                $('#car_annual_report').html(response);
                }
              });
          return false;
    }
</script>