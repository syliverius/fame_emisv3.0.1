<main id="main" class="main">

<div class="pagetitle">
  <h1>Employee Performance</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="" href="<?php echo base_url('profile_management'); ?>">Home /
        <span>Employee Performance</span>
      </a>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card-body">
  <div class="col-lg-12">
        <!--here we implement the retrieval of monthly report -->
        <?php $this->load->view('employee_performance/employee_performance_review/performance_history_hr'); ?>
        <div id="performance_report"></div>

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
      
</main><!-- End #main -->

<script type="text/javascript">
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