<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-14
 * @description Here we display all estates reports
 * @license     Rwazi.co.tz

-->
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Estates Reports</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management'); ?>">Home</a></li>
        <li class="breadcrumb-item">Welcome to estate reports</li>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#cars">CARS UTILIZATION</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#machines">GENERATORS & MACHINES</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#electricity">ELECTRICITY USAGES</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#water">WATER CONSUMPTION</button>
              </li>
            </ul>
            <div class="tab-content pt-2">

              <!--    *** CARS REPORTS ***   -->

              <div class="tab-pane show active" id="cars">
                  <div class="card">
                    <div class="card-body">
                      <?php $this->load->view('estate/reports/cars_drawing_specification'); ?>
                    </div>
                    <div id="car_graphs"></div>
                  </div>
              </div> 

              <!--    *** END ***   -->


              <!--    *** GENERATORS AND MACHINES ***   -->

              <div class="tab-pane fade pt-3" id="machines">
                <div class="card">
                  <div class="card-body">
                    <?php $this->load->view('estate/reports/Machine_report_home'); ?>
                  </div>
                  <div id="machines_report"></div>
                </div>
              </div>

              <!--    *** END ***   -->

              <!--    *** ELECTRICITY ***   -->
              <div class="tab-pane fade pt-3" id="electricity">
                 <div class="card">
                   <div class="card-body">
                     <?php $this->load->view('estate/reports/electricity_drawing_specifications'); ?>
                   </div>
                   <div id="electricity_graph"></div>
                 </div>
              </div>

              <!--    *** END ***   --> 

              <!--    *** WATER ***   -->
              <div class="tab-pane fade pt-3" id="water">
                 
              </div>
              <!--    *** END ***     -->

            </div> <!-- End of Tab Body -->
          </div><!-- End Of Main Card Body -->
        </div> <!-- End Of Main Card -->
      </div> <!-- End Of Main Column Div -->
    </div> <!-- End Of Main Row Div -->
  </section>
  <!--ALL MODEL WILL BE IMPLEMENTED HERE-->
</main><!-- End #main -->

<script type="text/javascript">

  function create_car_graphs(e){
    var data = $('#car').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>estate/cars_fuel_usage_report",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#car_graphs').html(response);
          }
        });
      return false;
  }

  function machine_reports(e){
    var data = $('#machines_form').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>estate/machines_reports",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#machines_report').html(response);
          }
        });
      return false;
  }

  function create_electricity_graph(e){
    var data = $('#electricity_drawing_form').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>estate/electricity_usage_graphs",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#electricity_graph').html(response);
          }
        });
      return false;
  }
</script>