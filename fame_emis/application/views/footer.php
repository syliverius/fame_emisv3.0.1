 <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <script src="<?= base_url() ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/chart.js/chart.min.js"></script><!-- maybe conseder deleting this and start using the below chart -->
  <script src="<?= base_url() ?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/quill/quill.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url() ?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>


  <!-- Template Main JS File -->
  <script src="<?php echo base_url() ?>assets/js/main.js"></script>


<script type="text/javascript">

function disable_back(){
  window.history.pushState(null, "", window.location.href);        
      window.onpopstate = function() {
          window.history.pushState(null, "", window.location.href);
      };
}

function edit_modal_data(){
        $(".roaster_edit_btn").click(function () {
        var data = 'ids=' + $(this).attr('data-id');
        $('#roaster_edit_modal').modal('show');

        $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>create_roaster/roster_update",
            data: data,
            beforSend: function()
            {
               $('#edit_modal_data').html();
            },
            success: function(response){
               $('#edit_modal_data').html(response);
                 
            },
            error: function ()
            {

            }
        });
    });
        
}


function more_details_modal(){

        $(".more_details_btn").click(function () {
        var data = 'ids=' + $(this).attr('data-id');
        $('#more_details_modal').modal('show');

        $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>leave_approval_dept_head/more_details",
            data: data,
            beforSend: function()
            {
               $('#more_details_data').html();
            },
            success: function(response){
               $('#more_details_data').html(response);
                 
            },
            error: function ()
            {

            }
        });
    });
        
}

function hr_more_details_modal(){

        $(".more_details_hr_btn").click(function () {
        var data = 'ids=' + $(this).attr('data-id');
        $('#hr_more_details_modal').modal('show');

        $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>hr_dashboard/more_details",
            data: data,
            beforSend: function()
            {
               $('#hr_more_details_data').html();
            },
            success: function(response){
               $('#hr_more_details_data').html(response);
                 
            },
            error: function ()
            {

            }
        });
    });
        
}

function accoutant_more_details_modal(){

        $(".more_details_accoutant_btn").click(function () {
        var data = 'ids=' + $(this).attr('data-id');
        $('#accoutant_more_details_modal').modal('show');

        $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>accoutant_dashboard/more_details",
            data: data,
            beforSend: function()
            {
               $('#accoutant_more_details_data').html();
            },
            success: function(response){
               $('#accoutant_more_details_data').html(response);
                 
            },
            error: function ()
            {

            }
        });
    });     
}

function hr_department_summary(){
    var data = $("#hr_department_summary_form").serialize(); 
    $.ajax({
            url: "<?php echo base_url() . 'hr_dashboard/hr_roaster_summary'; ?>",
            type: "POST",
            data: data,
            success: function (response) {
            $('#hr_summary_table_data').html(response);
            },
            error: function () {
                alert('Error Occured');
            }
        });
    } 

 
// **************************** START OF DEPT HEAD LEAVE APPROVAL *************************************** //

function head_of_dept_approval(){
    
     $(".dept_head_approve_btn").click(function () {
        var benefitId = $(this).data('id');
        var name = $(this).data('name');
        var data = 'ids=' + benefitId + '&names=' + encodeURIComponent(name);
        $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>leave_approval_dept_head/approval",
            data: data,
            beforSend: function()
            {
               $(".dept_head_approve_btn").attr("disabled", true);
            },
            success: function(response){
                if(response == "approved"){
                    window.location.reload();
                }else{
                   $("#dept_head_approval_response_message").fadeIn(1000, function(){                        
                        $("#dept_head_approval_response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry there was a problem approving the leave. please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }); 
                }
            },
            error: function ()
            {
                $("#dept_head_approval_response_message").fadeIn(1000, function(){                        
                        $("#dept_head_approval_response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry there was a problem approving the leave. please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }); 
            }
        });
    });
}

// ****************************  END OF DEPT HEAD LEAVE APPROVAL *************************************** //

// ****************************** START OF HR LEAVE APPROVAL AJAX ************************************//

function hr_leave_approval(){
    
     $(".hr_approve_btn").click(function () {
        var benefitId = $(this).attr('data-id');
        var names = $(this).attr('data-name');

        var data = 'ids=' + benefitId +'&names=' + encodeURIComponent(names);
        $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>Hr_Dashboard/hr_leave_approval",
            data: data,
            beforSend: function()
            {
               // $("#<?php ?>").attr("disabled", true);   
            },
            success: function(response){
                if(response == "approved"){
                    window.location.reload();
                }else if(response == "unapproved"){
                   $("#hr_approval_response_message").fadeIn(1000, function(){                        
                        $("#hr_approval_response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry we have database problems. please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }); 
                }
                else{
                    $("#hr_approval_response_message").fadeIn(1000, function(){                        
                        $("#hr_approval_response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry There was a problem approving the leave. please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }); 
                }
            },
            error: function ()
            {
                $("#hr_approval_response_message").fadeIn(1000, function(){                        
                        $("#hr_approval_response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry there was a problem approving the leave. please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }); 
            }
        });
    });
}

// ********************************** END OF HR LEAVE APPROVAL AJAX ********************** //

// *********************************** ACCOUTANT LEAVE APPROVAL AJAX ********************** //
function accoutant_leave_approval(){
    
     $(".accoutant_approve_btn").click(function () {

        var benefitId = $(this).attr('data-id');
        var names = $(this).attr('data-name');
        var data = 'ids=' + benefitId + '&names=' + encodeURIComponent(names);
        $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>accoutant_dashboard/accoutant_leave_approval",
            data: data,
            success: function(response){
                if(response == "approved"){
                    window.location.reload();
                }else if(response == "unapproved"){
                   $("#accoutant_approval_response_message").fadeIn(1000, function(){                        
                        $("#accoutant_approval_response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry we have database problems. please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }); 
                }
                else{
                    $("#accoutant_approval_response_message").fadeIn(1000, function(){                        
                        $("#accoutant_approval_response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry There was a problem approving the leave. please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }); 
                }
            },
            error: function ()
            {
                $("#accoutant_approval_response_message").fadeIn(1000, function(){                        
                        $("#hr_approval_response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry there was a problem approving the leave. please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }); 
            }
        });
    });
}

// ******************************END OF ACCOUTANT LEAVE APPROVAL ************************************************//
// **************** HERE IS THE FUNCTION TO HANDLE MONTHLY ROSTER ******//
 function generate_dept_roster(event){
      event.preventDefault();
      var data = $('#dept_roster_summary').serialize();

        $.ajax({               
          type : 'POST',
          url  : "<?php echo base_url() ?>Monthly_Roaster/Monthly_Roaster_Hd/hd_roaster_summary",
          data : data,
          beforeSend: function(){ 
            // $("#response_message").fadeOut();
          },
          success : function(response){
              $('#monthly_roster_summary').html(response);
            }
          });
        return false;
    } 
// *******************  END *************************//

function roaster_create() {
  $("#roster_create_form").validate({
    
        rules: {
            names: {
                required: true,
            },
      startDate: {
                required: true,
            },
      endDate: {
                required: true,
            },
      selectLeaveReason: {
                required: true,
            },  
        },
        messages: {
            names:{
              required: "<span style='color:#ce0000;'>by entering the first letter of name please select the name!!</span>"
             },
      startDate:{
        required: "<span style='color:#ce0000;'>select the starting date!!</span>"
       },
       endDate:{
         required: "<span style='color:#ce0000;'>select the end date!!</span>"
       },
       selectLeaveReason:"<span style='color:#ce0000;'>select the reason for leave!!</span>",
        },
        submitHandler: submitForm   
    });    

    /* Handling login functionality */
    function submitForm() {     
        var data = $("#roster_create_form").serialize();                
         $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>create_roaster/create_roaster_function",
            data : data,
            beforeSend: function(){ 
                $("#response_message").fadeOut();
            },
        success : function(response){  
                window.location.reload(); 
                clear();
            }
        });
        return false;
    }   
}

function clear(){
    $("input[type=text]").val('')
    document.getElementById("startDate").valueAsDate = null
    document.getElementById("endDate").valueAsDate = null
    $('#selectLeaveReason').val('');
    $('#comments').val('');
}

function department_roaster_report(){
    $('#dept_report_btn').click(function(e){

        e.preventDefault();      // e.stopImmediatePropagation(); when prevent default is not working this can be useful
       var data = $('#department_roaster_report').serialize();
       $.ajax({
        method : "post",
        url : "<?php echo base_url() ?>create_roaster/department_roaster_report",
        data : data,
        dataType : "html",
        beforeSend : function(){ 
            },
        success : function(response){
           $('#returned_result').html(response); 
        }
       });
    })
}


//function to create book2 report 
function book2_report(){
    $('#create_book2_btn').click(function(e){
        e.preventDefault();

        var data = $("#book2_form").serialize(); 

        $.ajax({
        method : "post",
        url : "<?php echo base_url() ?>reports/reports/create_book2_report",
        data : data,
        dataType : "html",
        beforeSend : function(){ 
                $("#book2_response_message").fadeOut();
            },
        success : function(response){
            $('#book2_table_data').html(response);
             $("#book2_response_message").fadeIn(1000, function(){                        
                    $("#book2_response_message").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check2-circle me-1"></i><strong>Congratulation!.</strong> Book2 report created successfully!, scroll down to review your report . <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    });
        }
       });
    })
}


//function to upload excel 
 function export_roaster_excel(){
    $('#upload_roaster_btn').click(function(e){
        e.preventDefault();
        var inputFile = $('input[name=excel_roaster]');
        var fileToUpload = inputFile[0].files[0];
        
        //makes sure there is file to upload
        if(fileToUpload != 'undefined'){
           var formData = new FormData(); 
           formData.append('file',fileToUpload);
            $.ajax({
                url : '<?php echo base_url() ?>create_roaster/upload_excel_file',
                dataType: 'text',
                cache : false,
                contentType : false,
                processData : false,
                data : formData,
                type : 'post',
                beforeSend : function(){
                    $("#upload_response_message").fadeOut();
                },
                success : function(response){
                    if (response == "ok") {
                       $("#upload_response_message").fadeIn(1000, function(){               
                        $("#upload_response_message").html('<tr><td colspan="5"><div class="alert alert-success alert-dismissible fade show" role="alert">Congratulation! File uploaded successful. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
                    }); 
                    }else if(response == "database_error"){
                      $("#upload_response_message").fadeIn(1000, function(){               
                        $("#upload_response_message").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert">we have some database problems please contact our awesome administrator <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
                    });  
                    }else if(response == "failed"){
                        $("#upload_response_message").fadeIn(1000, function(){               
                        $("#upload_response_message").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert">Failed to upload please check your file type if it is in excel/pdf/docs format <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
                    });
                    }else{
                        $("#upload_response_message").fadeIn(1000, function(){               
                        $("#upload_response_message").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert">Unknown error occured please contact our awesome administrator <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
                    });
                }
            }
         });
        }else{
            
        }
    })
}

function employee_leave_history(){
        $("#leave_history_form").validate({
        rules: {
            names: {
                required: true,
            },
        },
        messages: {
            names:{
              required: "<span style='color:#ce0000;'>by entering the first letter of name please select the name!!</span>"
             },
         },
        submitHandler: getEmployeeLeaveHistory   
    }); 

    function getEmployeeLeaveHistory(){
        var data = $("#leave_history_form").serialize();                
         $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>hr_dashboard/getEmployeeLeaveHistory",
            data : data,
            beforeSend: function(){ 
                $("#response_message").fadeOut();
            },
        success : function(response){   
                $('#leave_history_response').empty().append(response); 
            }
        });
        return false;
    } 
} 

/*************************** HERE COMES MALNUTRITION FUNCTIONS IMPORTED *************************************************/

// function disable_back(){
//     window.history.pushState(null,"",window.location.href);
//     window.onpopstate = function(){
//         window.history.pushState(null,"",window.location.href);
//     };
// }

function Registration() {
  $("#Registration").validate({
    
        rules: {
            names: {
                required: true,
            },
      file_number: {
                required: true,
            },
      address: {
                required: true,
            },
      best_contact: {
                required: true,
            }, 
       phone_number: {
                required: true,
            }, 
       dob: {
                required: true,
            },
        },
        messages: {
            names:{
              required: "<span style='color:#ce0000;'>please insert patient names !!</span>"
             },
      file_number:{
        required: "<span style='color:#ce0000;'>File number field cannot be left empty!!</span>"
       },
       address:{
         required: "<span style='color:#ce0000;'>This field cannot be left empty!!</span>"
       },
       phone_number:{
        required:"<span style='color:#ce0000;'>Please enter the best contact phone number!!</span>",
        },
        dob:"<span style='color:#ce0000;'>Please enter the best contact phone number !!</span>"
        },
        submitHandler: submitForm   
    });    

    /* Handling login functionality */
    function submitForm() {     
        var data = $("#Registration").serialize();                
         $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>malnutrition/home/register_new_patient",
            data : data,
            beforeSend: function(){ 
                $("#response_message").fadeOut();
            },
        success : function(response){   
                if (response == "database_error"){
                    $("#error").fadeIn(1000, function(){                        
                        $("#response_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Patient information failed to be inserted in our current database . Please contact our awesome administrator for more information <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    });
                
                }else{                           
                    $("#response_message").fadeIn(1000, function(){                        
                        $("#response_message").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Waooooh!.</strong> Patient information stored successful . <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    });
                } 
                clear();
            }
        });
        return false;
    }   
}

function create_patient_visit(){
    $('#search_patient').click(function(e){

        e.preventDefault();      // e.stopImmediatePropagation(); when prevent default is not working this can be useful
       var data = $('#visit_form').serialize();
       $.ajax({
        type : "post",
        url : "<?php echo base_url() ?>malnutrition/home/present_patient",
        data : data,
        beforeSend : function(){ 
                $("#visit_response_message").fadeOut();

            },
        success : function(response){
            if(response == "database_error"){
                $("#patient_information").fadeIn(1000, function(){                       
                        $("#patient_information").html('<tr><td colspan="5"><div class="alert alert-danger alert-dismissible fade show" role="alert">Sorry!! Try to search again, may be you typed incorrectly patient name <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>');
                    });
            }else{
                $('#patient_information').html(response);
            }
        } 
       });
    })
}

function view_previous_visit(){
    $(".table tbody").on('click','.view_visit', function (e){
       e.preventDefault();   
        var data = 'ids=' + $(this).attr('data-id');
        $('#previous_visit_modal').modal('show');

        $.ajax({
            type: "post",
             url: "<?= base_url(); ?>malnutrition/home/previous_visit",
            data: data,
            beforSend: function()
            {
               $('#previous_visit_data').html();
            },
            success: function(response){
               $('#previous_visit_data').html(response);     
            },
            error: function ()
            {
                return false;
            }
        });
    });
}

function create_visit_modal(){
    $(".table tbody").on('click','.create_visit_btn', function (e){
       e.preventDefault();   
        var data = 'ids=' + $(this).attr('data-id');
        $('#create_visit_modal').modal('show');

        $.ajax({
            type: "post",
             url: "<?= base_url(); ?>malnutrition/home/get_patient_info",
            data: data,
            beforSend: function()
            {
               $('#create_visit_body').html();
            },
            success: function(response){
               $('#create_visit_body').html(response);     
            },
            error: function ()
            {
               // return false;
            }
        });
    });
}

var idleTime = 0;
function logout_session() {
    var idleInterval = setInterval(CheckIdleTime, 1000);

    // Bind events to the document (you can change document to a specific element if needed)
    $(document).mousemove(function (e) {
        idleTime = 0;
    });

    $(document).keypress(function (e) {
        idleTime = 0;
    });
}

function CheckIdleTime() {
    idleTime = idleTime + 1;
    if (idleTime > 1800) {  // 1800 seconds = 30 minutes
        // Redirect to the logout URL
        window.location.replace('<?php echo base_url("auth/logout"); ?>');
    }
}



/***************************  AND MARKS THE END OF MALNUTRION FUNCTIONS IMPORTED ******************************************/

// here we call all ajax functions
$('document').ready(function() { 
     disable_back();
     
     roaster_create();

     department_roaster_report();

     book2_report();

     export_roaster_excel();

     edit_modal_data();

     more_details_modal();

     head_of_dept_approval();

     hr_more_details_modal();

     hr_leave_approval();

     employee_leave_history();

     accoutant_more_details_modal();

     accoutant_leave_approval();

     // activate malnutrition functions here

     Registration();

     create_patient_visit();

     create_visit_modal();

     view_previous_visit();

     logout_session();

});
</script>

    
<script src="<?= base_url() ?>assets/js/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  </script>
  <script src="<?= base_url() ?>assets/vendor/table/jquery.table2excel.min.js"></script>
</body>
</html>