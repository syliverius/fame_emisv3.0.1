<main id="main" class="main">

	<div class="pagetitle">
		<h1> Wategemezi Form  </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Wategemezi</li>
			</ol>
		</nav>
	</div> <!--End of page title -->


  <div class="card">
    <div class="card-body">
      <div class="card-title text-center">
        FAME MEDICAL EMPLOYEE DEPENDANT FORM <br />
        (FOMU YA MAJINA YA WATEGEMEZI WA MTUMISHI).
      </div>
      <form id="wategemezi_form" method="post">
       <div id="wategemezi_response"></div>
        <div class="row input-group mb-3">
          <div class="col-md-6">
            <label for="names">Employee Names</label>
            <input type="text" class="form-control" name="names" value="<?= $this->session->userdata('full_name');?>" readonly>
          </div>
                        
          <div class="col-md-6">
            <label for="department">Department</label>
            <input type="text" class="form-control" name="Department" value="<?= $this->session->userdata('department_name');?>" readonly>
          </div>
        </div>
        <p><b><i>DEPENDANTS<i></b></p>
        <div class="row input-group mb-3">
          <div class="col-md-4">
            <label for="mtegemezi_01">DEPENDANT:1</label>
            <input type="text" class="form-control" name="mtegemezi1" value="<?= $wategemezi->dept1;?>">
          </div>
          <div class="col-md-4">
            <label for="mtegemezi1_uhusiano">RELATION</label>
            <select class="form-control" name="mtegemezi1_uhusiano">
              <option></option>
              <?php 
                foreach($wategemezi_option as $options=>$display){
                  if ($display == $wategemezi->dept1_relation) {
                    echo "<option selected>".$display."</option>";
                  }else{
                    echo "<option>".$display."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="mtegemezi1_dob">DATE OF BIRTH(dob)</label>
            <input type="date" class="form-control" name="mtegemezi1_dob" value="<?= $wategemezi->dept1_dob;?>">
          </div>
        </div>

        <div class="row input-group mb-3">               
          <div class="col-md-4">
            <label for="mtegemezi_01">DEPENDANT:2</label>
            <input type="text" class="form-control" name="mtegemezi2" value="<?= $wategemezi->dept2;?>">
          </div>
          <div class="col-md-4">
            <label for="mtegemezi2_uhusiano">RELATION</label>
            <select class="form-control" name="mtegemezi2_uhusiano">
              <option></option>
              <?php 
                foreach($wategemezi_option as $options=>$display){
                  if ($display == $wategemezi->dept2_relation) {
                    echo "<option selected>".$display."</option>";
                  }else{
                    echo "<option>".$display."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="mtegemezi2_dob">DATE OF BIRTH(dob)</label>
            <input type="date" class="form-control" name="mtegemezi2_dob" value="<?= $wategemezi->dept2_dob;?>">
          </div>
        </div>

        <div class="row input-group mb-3">                   
          <div class="col-md-4">
            <label for="mtegemezi_01">DEPENDANT:3</label>
            <input type="text" class="form-control" name="mtegemezi3" value="<?= $wategemezi->dept3;?>">
          </div> 
          <div class="col-md-4">
            <label for="mtegemezi3_uhusiano">RELATION</label>
            <select class="form-control" name="mtegemezi3_uhusiano">
              <option></option>
              <?php 
                foreach($wategemezi_option as $options=>$display){
                  if ($display == $wategemezi->dept3_relation) {
                    echo "<option selected>".$display."</option>";
                  }else{
                    echo "<option>".$display."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="mtegemezi3_dob">DATE OF BIRTH(dob)</label>
            <input type="date" class="form-control" name="mtegemezi3_dob" value="<?= $wategemezi->dept3_dob;?>">
          </div>
        </div>

        <div class="row input-group mb-3">
          <div class="col-md-4">
            <label for="mtegemezi_01">DEPENDANT:4</label>
            <input type="text" class="form-control" name="mtegemezi4" value="<?= $wategemezi->dept4;?>">
          </div>
          <div class="col-md-4">
            <label for="mtegemezi4_uhusiano">RELATION</label>
            <select class="form-control" name="mtegemezi4_uhusiano">
              <option></option>
              <?php 
                foreach($wategemezi_option as $options=>$display){
                  if ($display == $wategemezi->dept4_relation) {
                    echo "<option selected>".$display."</option>";
                  }else{
                    echo "<option>".$display."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="mtegemezi4_dob">DATE OF BIRTH(dob)</label>
            <input type="date" class="form-control" name="mtegemezi4_dob" value="<?= $wategemezi->dept4_dob;?>">
          </div>
        </div>

        <div class="row input-group mb-3">
          <div class="col-md-4">
            <label for="mtegemezi_01">DEPENDANT:5</label>
            <input type="text" class="form-control" name="mtegemezi5" value="<?= $wategemezi->dept5;?>">
          </div>
          <div class="col-md-4">
            <label for="mtegemezi5_uhusiano">RELATION</label>
            <select class="form-control" name="mtegemezi5_uhusiano">
              <option></option>
              <?php 
                foreach($wategemezi_option as $options=>$display){
                  if ($display == $wategemezi->dept5_relation) {
                    echo "<option selected>".$display."</option>";
                  }else{
                    echo "<option>".$display."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="mtegemezi5_dob">DATE OF BIRTH(dob)</label>
            <input type="date" class="form-control" name="mtegemezi5_dob" value="<?= $wategemezi->dept5_dob;?>">
          </div>
        </div>     

        <div class="row input-group mb-3">
          <div class="col-md-4">
            <label for="mtegemezi_6">DEPENDANT:6</label>
            <input type="text" class="form-control" name="mtegemezi6" value="<?= $wategemezi->dept6;?>">
          </div>
          <div class="col-md-4">
            <label for="mtegemezi6_uhusiano">RELATION</label>
            <select class="form-control" name="mtegemezi6_uhusiano">
              <option></option>
              <?php 
                foreach($wategemezi_option as $options=>$display){
                  if ($display == $wategemezi->dept6_relation) {
                    echo "<option selected>".$display."</option>";
                  }else{
                    echo "<option>".$display."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="mtegemezi5_dob">DATE OF BIRTH(dob)</label>
            <input type="date" class="form-control" name="mtegemezi6_dob" value="<?= $wategemezi->dept6_dob; ?>">
          </div>
        </div>               
                      
        <div class="text-center">
          <button type="submit" class="btn btn-primary" onclick="update_wategemezi(event)">Submit</button>
          <button class="btn btn-danger" type="reset">Cancel</button>
        </div>
      </form> 
    </div>
  </div>
</main>

<script type="text/javascript">
  
  function update_wategemezi(e){
    e.preventDefault();
    var data = $('#wategemezi_form').serialize();

      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>wategemezi/wategemezi/update_wategemezi",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#wategemezi_response').html(response);
          }
        });
      return false;
  }

</script>


