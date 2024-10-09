<main id="main" class="main">

  <div class="pagetitle">
    <h1>Employee performance Review Page</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
        <li class="breadcrumb-item">Employee Performance </a></li>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#leave_request">Review employee evaluation Form</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history">Employee Performance History</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#summary">Create Employee Performance Evaluation Form</button>
              </li>
            </ul>


            <div class="tab-content pt-2">

<!--**********************************  PERFORMANCE FORM *********************************************-->
            <div class="tab-pane show active" id="leave_request">     
            <div id="performance_form">          
              <?php $this->load->view('employee_performance/employee_performance_review/list_of_hd_performance_review');?>
            </div> 
          </div>
<!--**********************************END OF PERFORMANCE REPORT   *********************************************-->

  
<!--**********************************START OF PERFORMANCE REPORT*********************************************--> 

                <div class="tab-pane pt-3" id="history">
                      <?php $this->load->view('employee_performance/performance_history'); ?>
                      <div id="performance_report"></div>
                </div> 

                <!--*** END *** --> 

  <!--    *** Department head, create evaluation for non-pc employee *** -->
                <div class="tab-pane pt-3" id="summary">
                  <div id="hd_performance_form">
                    <?php $this->load->view('employee_performance/hd_1st_form'); ?>
                  </div>
                </div> 

                <!-- *** END *** -->


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
              <form  method="post" action="<?= base_url(); ?>employee_performance/employee_performance_form/hd_evaluation_update">
                <div id="more_details_details">
                  <!-- in here we will insert edit data from the database using javascrip/ajax -->
                </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
</main>
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

   function getEmployeeInfo(){
    var names = $('#names').val();
    $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>employee_performance/employee_performance_form/get_employee_info",
          data:{
                "names" : names
              },
          beforSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            var data = jQuery.parseJSON(response);
            $('#employee_id').val(data.employee_id);
            $('#sex').val(data.gender);
            $('#cheo').val(data.cheo);
            $('#age').val(data.age);
            $('#wategemezi').val(data.wategemezi);
          }
      });
   }

   function hd_process_1st_form(){
      $("#performance_form1").validate({
    
      rules: {
      names: {
                required: true,
            },
      sex: {
                required: true,
            },
      age: {
                required: true,
            },
      nationality: {
                required: true,
            },
      marital_status: {
                required: true,
            },
      wategemezi: {
                required: true,
            },
      department: {
                required: true,
            },
      elimu: {
                required: true,
            },
      cheo: {
                required: true,
            },
      masharti_ya_kazi: {
                required: true,
            },
        },
        messages: {
            names:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jina la mtumishi</span>"
             },
            sex:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jinsia ya mtumishi</span>"
             },
             nationality:{
              required: "<span style='color:#ce0000;'>Tafadhari andika uraia wa mtumishi</span>"
             },
             marital_status:{
              required: "<span style='color:#ce0000;'>Tafadhari jaza taarifa za mtumishi kama ameoa au kuolewa</span>"
             },
             wategemezi:{
              required: "<span style='color:#ce0000;'>Tafadhari jaza ididai ya wategemezi wa mtumishi</span>"
             },
             department:{
              required: "<span style='color:#ce0000;'>department anayotoka mtumish wetu</span>"
             },
            elimu:{
              required: "<span style='color:#ce0000;'>Tadhari chagua kiwango kikubwa cha elimu ya mtumishi!!</span>"
             },
             cheo:{
               required: "<span style='color:#ce0000;'>Tafadhari andika cheo cha mtumishi</span>"
             },
             masharti_ya_kazi:{
               required: "<span style='color:#ce0000;'>Tafadhari chagua mashart ya kazi ya mtumishi!!d!!</span>"
             },
              age:{
               required: "<span style='color:#ce0000;'>Tafadhari andika umri wa mtumishi wetu!!</span>"
             },
           },

        submitHandler: form_one   
    });   
      
    function form_one(){
      var data = $('#performance_form1').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>employee_performance/employee_performance_form/hd_process_1st_form",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            if(response == "fail"){
              location.reload();
            }else{
              $('#hd_performance_form').html(response);
            }
          }
        });
      return false;
    }

   }

   //script for second form 
   function hd_process_2nd_form(){
      $("#performance_form2").validate({
    
      rules: {
      mahusiano_kazini_1_msimamizi: {
                required: true,
            },
      mahusiano_kazini_1_maafikiano: {
                required: true,
            },
      mahusiano_kazini_2_msimamizi: {
                required: true,
            },
      mahusiano_kazini_2_maafikiano: {
                required: true,
            },
      mahusiano_kazini_3_msimamizi: {
                required: true,
            },
      mahusiano_kazini_3_maafikiano: {
                required: true,
            },
      mawasiliano_na_usikivu_1_msimamizi: {
                required: true,
            },
      mawasiliano_na_usikivu_1_maafikiano: {
                required: true,
            },
      mawasiliano_na_usikivu_2_msimamizi: {
                required: true,
            },
      mawasiliano_na_usikivu_2_maafikiano: {
                required: true,
            },
      mawasiliano_na_usikivu_3_msimamizi: {
                required: true,
            }, 
      mawasiliano_na_usikivu_3_maafikiano: {
                required: true,
            },
      mawasiliano_na_usikivu_4_msimaizi: {
                required: true,
            },
      mawasiliano_na_usikivu_4_maafikiano: {
                required: true,
            },
      uongozi_na_usimamizi_1_msimamizi: {
                required: true,
            },
      uongozi_na_usimamizi_1_maafikiano: {
                required: true,
            },
      uongozi_na_usimamizi__2_msimamizi: {
                required: true,
            },
      uongozi_na_usimamizi__2_maafikiano: {
                required: true,
            },
      uongozi_na_usimamizi_3_msimamizi: {
                required: true,
            },
      uongozi_na_usimamizi_3_maafikiano: {
                required: true,
            },
      ubora_na_utendaji_1_msimamizi: {
                required: true,
            },
      ubora_na_utendaji_1_maafikiano: {
                required: true,
            }, 
      ubora_na_utendaji_2_msimamizi: {
                required: true,
            },
      ubora_na_utendaji_2_maafikiano: {
                required: true,
            },
      utendaji_wa_wingi_wa_matokeo_1_msimamizi: {
                required: true,
            },
      utendaji_wa_wingi_wa_matokeo_1_maafikiano: {
                required: true,
            },
      utendaji_wa_wingi_wa_matokeo_2_msimamizi: {
                required: true,
            },
      utendaji_wa_wingi_wa_matokeo_2_maafikiano: {
                required: true,
            },
      uajibikaji_utoaji_maamuzi_1_mtumishi: {
                required: true,
            },
      uajibikaji_utoaji_maamuzi_1_maafikiano: {
                required: true,
            },
      uajibikaji_utoaji_maamuzi_2_msimamizi: {
                required: true,
            },
      uajibikaji_utoaji_maamuzi_2_maafikiano: {
                required: true,
            },
      kuthamini_wateja_1_msimamizi: {
                required: true,
            }, 
      kuthamini_wateja_1_maafikiano: {
                required: true,
            },
      uaminifu_1_msimamizi: {
                required: true,
            },
      uaminifu_1_maafikiano: {
                required: true,
            },
      uaminifu_2_msimamizi: {
                required: true,
            },
      uaminifu_2_maafikiano: {
                required: true,
            },
      uaminifu_3_msimamizi: {
                required: true,
            },
      uaminifu_3_maafikiano: {
                required: true,
            },
      uadilifu_1_msimamizi: {
                required: true,
            },
      uadilifu_1_maafikiano: {
                required: true,
            },
      uadilifu_2_msimamizi: {
                required: true,
            },
      uadilifu_2_maafikiano: {
                required: true,
            }, 
      uadilifu_3_msimamizi: {
                required: true,
            },
      uadilifu_3_maafikiano: {
                required: true,
            },
      mahusiano_kazini_1_mtumishi: {
                required: true,
            },
      mahusiano_kazini_2_mtumishi: {
                required: true,
            },
      mahusiano_kazini_3_mtumishi: {
                required: true,
            },
      mawasiliano_na_usikivu_1_mtumishi: {
                required: true,
            },
      mawasiliano_na_usikivu_2_mtumishi: {
                required: true,
            },
      mawasiliano_na_usikivu_3_mtumishi: {
                required: true,
            },
      mawasiliano_na_usikivu_4_mtumishi: {
                required: true,
            },
      uongozi_na_usimamizi_1_mtumishi: {
                required: true,
            },
      uongozi_na_usimamizi_2_mtumishi: {
                required: true,
            }, 
      uongozi_na_usimamizi_3_mtumishi: {
                required: true,
            },
      ubora_na_utendaji_1_mtumishi: {
                required: true,
            },
      ubora_na_utendaji_2_mtumishi: {
                required: true,
            },
      utendaji_wa_wingi_wa_matokeo_1_mtumishi: {
                required: true,
            },
      utendaji_wa_wingi_wa_matokeo_2_mtumishi: {
                required: true,
            },
      uajibikaji_utoaji_maamuzi_1_msimamizi: {
                required: true,
            },
      uajibikaji_utoaji_maamuzi_2_mtumishi: {
                required: true,
            },
      kuthamini_wateja_1_mtumishi: {
                required: true,
            },
      uaminifu_1_mtumishi: {
                required: true,
            },
      uaminifu_2_mtumishi: {
                required: true,
            },
      uaminifu_3_mtumishi: {
                required: true,
            },
      uadilifu_1_mtumishi: {
                required: true,
            },
      uadilifu_2_mtumishi: {
                required: true,
            },
      uadilifu_3_mtumishi: {
                required: true,
            },
        },
        messages: {
            mahusiano_kazini_1_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jina la mtumishi</span>"
             },
            mahusiano_kazini_1_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jinsia ya mtumishi</span>"
             },
             mahusiano_kazini_2_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi </span>"
             },
             mahusiano_kazini_2_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mahusiano_kazini_3_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mahusiano_kazini_3_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            mawasiliano_na_usikivu_1_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mawasiliano_na_usikivu_1_maafikiano:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mawasiliano_na_usikivu_2_msimamizi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mawasiliano_na_usikivu_2_maafikiano:{
                required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>",
              },
              mawasiliano_na_usikivu_3_msimamizi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            mawasiliano_na_usikivu_3_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jina la mtumishi</span>"
             },
            mawasiliano_na_usikivu_4_msimaizi:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jinsia ya mtumishi</span>"
             },
             mawasiliano_na_usikivu_4_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi </span>"
             },
             uongozi_na_usimamizi_1_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uongozi_na_usimamizi_1_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uongozi_na_usimamizi__2_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            uongozi_na_usimamizi__2_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uongozi_na_usimamizi_3_msimamizi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uongozi_na_usimamizi_3_maafikiano:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             ubora_na_utendaji_1_msimamizi:{
                required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>",
              },
              ubora_na_utendaji_1_maafikiano:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            ubora_na_utendaji_2_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jina la mtumishi</span>"
             },
            ubora_na_utendaji_2_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jinsia ya mtumishi</span>"
             },
             utendaji_wa_wingi_wa_matokeo_1_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi </span>"
             },
             utendaji_wa_wingi_wa_matokeo_1_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             utendaji_wa_wingi_wa_matokeo_2_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             utendaji_wa_wingi_wa_matokeo_2_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            uajibikaji_utoaji_maamuzi_1_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uajibikaji_utoaji_maamuzi_1_maafikiano:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uajibikaji_utoaji_maamuzi_2_msimamizi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uajibikaji_utoaji_maamuzi_2_maafikiano:{
                required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>",
              },
              kuthamini_wateja_1_msimamizi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            kuthamini_wateja_1_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jina la mtumishi</span>"
             },
            uaminifu_1_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jinsia ya mtumishi</span>"
             },
             uaminifu_1_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi </span>"
             },
             uaminifu_2_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uaminifu_2_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uaminifu_3_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            uaminifu_3_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uadilifu_1_msimamizi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uadilifu_1_maafikiano:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uadilifu_2_msimamizi:{
                required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>",
              },
              uadilifu_2_maafikiano:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            uadilifu_3_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jina la mtumishi</span>"
             },
            uadilifu_3_maafikiano:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jinsia ya mtumishi</span>"
             },
             mahusiano_kazini_1_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi </span>"
             },
             mahusiano_kazini_2_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mahusiano_kazini_3_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mawasiliano_na_usikivu_1_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            mawasiliano_na_usikivu_2_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mawasiliano_na_usikivu_3_mtumishi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             mawasiliano_na_usikivu_4_mtumishi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uongozi_na_usimamizi_1_mtumishi:{
                required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>",
              },
              uongozi_na_usimamizi_2_mtumishi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            uongozi_na_usimamizi_3_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jina la mtumishi</span>"
             },
            ubora_na_utendaji_1_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari andika jinsia ya mtumishi</span>"
             },
             ubora_na_utendaji_2_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi </span>"
             },
             utendaji_wa_wingi_wa_matokeo_1_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             utendaji_wa_wingi_wa_matokeo_2_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uajibikaji_utoaji_maamuzi_1_msimamizi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            uajibikaji_utoaji_maamuzi_2_mtumishi:{
              required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             kuthamini_wateja_1_mtumishi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uaminifu_1_mtumishi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uaminifu_2_mtumishi:{
                required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>",
              },
              uaminifu_3_mtumishi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
            uadilifu_1_mtumishi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
             uadilifu_2_mtumishi:{
                required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>",
              },
              uadilifu_3_mtumishi:{
               required: "<span style='color:#ce0000;'>Tafadhari!! hiki kibox uwezi kukiacha wazi</span>"
             },
        },

        submitHandler: form_two 
    });   
      
    function form_two(){
      var data = $('#performance_form2').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>employee_performance/employee_performance_form/hd_process_2nd_form",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#hd_performance_form').html(response);
            }
        });
      return false;
    }

   }

   function hd_process_third_form(){

      var data = $('#performance_form3').serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>employee_performance/employee_performance_form/hd_process_3rd_form",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            location.reload();
          }
        });
      return false;
   }

   function create_performance_report(e){
    e.preventDefault();
    var data = $('#performance_history').serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>employee_performance/report/department_report",
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

   function view_more_details(employee_id){
    var data = {"employee_id" : employee_id};
    $('#view_more_modal').modal('show');
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>employee_performance/employee_performance_form/hd_view_more_edit",
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

   function view_more(employee_id,selected_year){
    var data = {"employee_id" : employee_id,
                "selected_year" : selected_year
                };
    $('#view_more_modal').modal('show');
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>employee_performance/report/view_more",
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

</script>
