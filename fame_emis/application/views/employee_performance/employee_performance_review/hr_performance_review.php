<main id="main" class="main">

  <div class="pagetitle">
    <h1>HR Employee Performance Review</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
        <li class="breadcrumb-item">Hr EMployee Performance Review </a></li>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#leave_request">Employee Performance Forms to Review</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history">Employee Performance History</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#summary">Summary</button>
              </li>
            </ul>


            <div class="tab-content pt-2">

<!--*********************LIST OF PERFORMANCE FORMS****************************-->
            <div class="tab-pane show active" id="leave_request">     
              <?php $this->load->view('employee_performance/employee_performance_review/list_of_performance_review');?>
            </div>
<!--**********************************END OF PERFORMANCE FORMS   *********************************************-->

  
<!--**********************************START OF PERFORMANCE REPORT*********************************************--> 

                <div class="tab-pane pt-3" id="history">
                      <?php $this->load->view('employee_performance/employee_performance_review/performance_history_hr'); ?>
                      <div id="performance_report"></div>
                </div> 
<!--**********************************END  OF PERFORMANCE REPORT *********************************************-->  
                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
    </section> 

    <!-- all modal goes here -->
    <div class="modal fade" id="view_more_modal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center"> <b>FAME MEDICAL PERFORMANCE REVIEW<br />
                FOMU YA WAZI YA MAPITIO NA UPIMAJI UTENDAJI KAZI TOLEO LA KISWAHILI </b></h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <form method="post" action="<?= base_url(); ?>employee_performance/hr_performance_review/update_hr_form">
              <div id="more_details_details">
                <!-- in here we will insert edit data from the database using javascrip/ajax -->
              </div>
              <div class="modal-footer">
                <div class="col-md-12 text-center">
                  <button type="submit" class='btn btn-primary'>Submit</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!--modal for hr report view more-->
      <div class="modal fade" id="view_more_report_modal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center"> <b>FAME MEDICAL PERFORMANCE REVIEW<br />
                FOMU YA WAZI YA MAPITIO NA UPIMAJI UTENDAJI KAZI TOLEO LA KISWAHILI </b></h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <div id="more_details_report">
                <!-- in here we will insert edit data from the database using javascrip/ajax -->
              </div>
              <div class="modal-footer">
                <div class="col-md-12 text-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
          </div>
        </div>
      </div>
</main>

<script type="text/javascript">
    function view_more(employee_id){
    var data = {"employee_id" : employee_id};
    $('#view_more_modal').modal('show');
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>employee_performance/Hr_Performance_Review/view_more_edit",
        data: data,
        beforSend:function(){
          // $("#end_date").fadeOut();
        },
        success:function(response){
          $('#more_details_details').html(response);
        }
    });
    return false;
   }

   function create_performance_report(e){
    e.preventDefault();
    var data = $('#performance_history').serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>employee_performance/report/department_report_hr",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#performance_report').html(response);
          }
        });
      return false;
   }

   function view_more_report(employee_id,year){
    var data = {"employee_id" : employee_id,
                "selected_year" : year
                };
    $('#view_more_report_modal').modal('show');
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>employee_performance/Hr_Performance_Review/view_more_report",
        data: data,
        beforSend:function(){
          // $("#end_date").fadeOut();
        },
        success:function(response){
          $('#more_details_report').html(response);
        }
    });
    return false;
   }

   
</script>