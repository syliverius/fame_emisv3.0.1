
<main id="main" class="main">

	<div class="pagetitle">
		<h1> Employee Details Form</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Employee Info</li>
			</ol>
		</nav>
	</div> <!--End of page title -->


  <div class="card">
    <div class="card-body">
      <div class="card-title text-center">m
        FAME MEDICAL EMPLOYEE DEPENDENT FORM <br />
        (FOMU YA MAJINA YA WATEGEMEZI WA MTUMISHI).
      </div>
      <form id="employee_info" method="post">
       <div id="employee_info_response"></div>

       <input type="text" name="employee_id" id="employee_id" hidden>

        <div class="row input-group mb-3">
          <div class="col-md-4">
            <label for="names">Employee Names</label>
            <input class="typeahead form-control" type="text"  name="names" id="names" onchange="get_employee_info()">
          </div>
                        
          <div class="col-md-4">
            <label for="department">Department</label>
            <input type="text" class="form-control" name="Department" id="department_name" readonly>
          </div>
          
          <div class="col-md-4">
            <label for="professional">Professional</label>
            <input type="text" class="form-control" name="professional" id="professional" readonly>
          </div>
        </div>

        <div class="row input-group mb-3">
          
          <div class="col-md-4">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" name="phone_number" id="phone_number" readonly>
          </div>

          <div class="col-md-4">
            <label for="dob">Date Of Birth</label>
            <input type="date" class="form-control" name="dob" id="dob" readonly>
          </div>

          <div class="col-md-4">
            <label for="hiring_date">Hiring Date</label>
            <input type="text" class="form-control" name="hiring_date" id="hiring_date" readonly>
          </div>
        </div>

        <!-- <div class="row input-group mb-3">
          
        </div> -->
      
        <p><b><i>Dependents<i></b></p>

          <table class="table table-bordered border-primary text-center">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Dependent Names</th>
                      <th>Relation</th>
                      <th>Age</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      for ($i=1; $i <=6; $i++) { ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td id="<?php echo 'dept'.$i; ?>"></td>
                        <td id="<?php echo 'dept'.$i.'_relation'; ?>"></td>
                        <td id="<?php echo 'dept'.$i.'_dob'; ?>"></td>
                      </tr>
                      <?php } ?>
                  </tbody>
              </table>                      
      </form> 
    </div>
  </div>
</main>

<script type="text/javascript">

  function get_employee_info(){
    var names = $('#names').val();
    $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>employee_information/get_employee_info",
          data:{
                "names" : names
              },
          beforSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            var data = jQuery.parseJSON(response);
            $('#employee_id').val(data.employee_id);
            $('#dob').val(data.dob);
            $('#phone_number').val(data.phone_number);
            $('#professional').val(data.professional);
            $('#department_name').val(data.department_name);
            $('#hiring_date').val(data.hiring_date);
            for (var i = 1; i <= 6; i++) {
              var deptId = '#dept' + i;
              var deptRelationId = '#dept' + i + '_relation';
              var deptDobId = '#dept' + i + '_dob';

              compareAndStyleDeptInfo(
                deptId, data['dept' + i],
                deptRelationId, data['dept' + i + '_relation'],
                deptDobId, data['dept' + i + '_dob']
              );
            }
          }
      });
  }

  function calculateAge(dateOfBirth) {
    if (!dateOfBirth || dateOfBirth === '0000-00-00') {
        return null; // 
    }
    var dob = new Date(dateOfBirth);
    if (isNaN(dob.getTime())) {
        return null; 
    }
    var currentDate = new Date();
    var timeDifference = currentDate - dob;
    var age = Math.floor(timeDifference / (365.25 * 24 * 60 * 60 * 1000));
    return age;
}

// Example usage:
var dob = '0000-00-00'; // Replace this with the actual date of birth
var age = calculateAge(dob);
console.log('Age:', age);


  function compareAndStyleDeptInfo(names_id, names, relation_id, relation, years_id, years) {
  var name_id = $(names_id);
  var name = names;
  var relation_id = $(relation_id);
  var relation = relation;
  var years_id = $(years_id);
  var years = calculateAge(years);

  // Reset color to default
  name_id.css('color', 'initial');
  relation_id.css('color', 'initial');
  years_id.css('color', 'initial');

  if (relation === "Mtoto") {
    if (years >= 21) {
      name_id.text(name);
      name_id.css('color', 'red');
      relation_id.text(relation);
      relation_id.css('color', 'red');
      years_id.text(years);
      years_id.css('color', 'red');
    } else {
      name_id.text(name);
      relation_id.text(relation);
      years_id.text(years);
    }
  } else {
    name_id.text(name);
    relation_id.text(relation);
    years_id.text(years);
  }
}



  function update_employee_info(e){
    e.preventDefault();
    var data = $('#employee_info').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>employee_information/update_wategemezi",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#employee_info_response').html(response);
          }
        });
      return false;
  } 

  $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get('<?php echo base_url('auth/user_AutoSuggestion_List'); ?>', { query: query }, function (response) {
                console.log(response);
                response  = $.parseJSON(response);
                return process(response);
            });
        }
    });

</script>


