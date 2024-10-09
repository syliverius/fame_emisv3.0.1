<main id="main" class="main">

	<div class="pagetitle">
		<h1> Employee Performance Evaluation Form  </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Employee performance evaluation</li>
			</ol>
		</nav>
	</div> <!--End of page title -->

  <div id="performance_form">
  <?php
    $age ="";
    $count = 0;
    $names = $this->session->userdata('full_name');
    $result = $this->performance->get_employee_details($names,$this->session->userdata("department_id"));
    if($result->dob != NULL){
      $birthDate = new DateTime($result->dob);
      $currentDate = new DateTime();
      $age = $currentDate->diff($birthDate)->y;
    }
    for($i=1; $i<=6; $i++){
      $var = "dept".$i;
      if($result->$var != ""){
        $count++;
      }
    }
  ?>

  <div class="card">
    <div class="card-body">
        <div class="card-title text-center">
          FAME MEDICAL PERFORMANCE REVIEW<br />
           FOMU YA WAZI YA MAPITIO NA UPIMAJI UTENDAJI KAZI TOLEO LA KISWAHILI
        </div>
        <form id="performance_form1" method="post">
          <?php
              if($this->session->flashdata('sms') != NULL){
            echo $this->session->flashdata('sms');
          }
          ?>
          <div class="row input-group mb-3">
            <label for="kutoka" class="col-sm-2 col-form-label">Kutoka</label>
            <div class="col-sm-4">
              <input type="dates" class="form-control"  name="kutoka" value="<?= date('Y')-1; ?>" readonly>
            </div>
            <label for="hadi" class="col-sm-2 col-form-label">Hadi Juni</label>
            <div class="col-sm-4">
              <input type="dates" class="form-control"  name="hadi" value="<?= date('Y'); ?> " readonly>
            </div>
          </div>

          <input type="text" name="employee_id" id="employee_id" value="<?= $this->session->userdata('employee_id');?>" hidden>

          <div class="row input-group mb-3">
            <label for="names" class="col-sm-2 col-form-label">Majina kamili</label>
            <div class="col-sm-6">
              <input type="text" class="form-control"  name="names" id="names" value="<?= $this->session->userdata('full_name');?>" readonly>
            </div>
            <label for="sex" class="col-sm-1 col-form-label">Jinsia</label>
            <div class="col-sm-3">
              <input type="text" class="form-control"  name="sex" id="sex" value="<?= $this->session->userdata('gender');?>" readonly>
            </div>
          </div>

          <div class="row input-group mb-3">
            <label for="umri" class="col-sm-1 col-form-label">Umri</label>
            <div class="col-sm-2">
              <input type="number" class="form-control"  name="age" id="age" value="<?= $age; ?>">
            </div>
            <label for="uraia" class="col-sm-1 col-form-label">Uraia</label>
            <div class="col-sm-3">
              <select class="form-control" name="nationality">
                <option>Tanzanian</option>
                <option>Kenyan</option>
                <option>American</option>
                <option>British</option>
              </select>
            </div>
            <label for="marital_status" class="col-sm-2 col-form-label">Kama umeolea/oa</label>
            <div class="col-sm-3">
              <select class="form-control" name="marital_status">
                <option></option>
                <option>NDIO</option>
                <option>HAPANA</option>
              </select>
            </div>
          </div>

          <div class="row input-group mb-3">
              <label for="wategemezi" class="col-sm-2 col-form-label">Idadi ya wategemezi</label>
              <div class="col-sm-3">
                <input type="number" class="form-control"  name="wategemezi" id="wategemezi" value="<?= $count; ?>" readonly>
              </div>
              <label for="department" class="col-sm-2 col-form-label">Jina La Idara</label>
              <div class="col-sm-5">
                <input type="text" class="form-control"  name="department" value="<?= $this->session->userdata('department_name'); ?>" readonly>
              </div>
            </div>

            <div class="row input-group mb-3">
              <label for="elimu" class="col-sm-4 col-form-label">Kiwango cha elimu(Anza na cha juu kabisa)</label>
              <div class="col-sm-3">
                <select class="form-control" name="elimu">
                  <option></option>
                  <option>Hana elimu</option>
                  <option>Darasa la saba</option>
                  <option>Kidato cha nne</option>
                  <option>Certificate/Cheti</option>
                  <option>Diploma</option>
                  <option>Degree</option>
                  <option>Masters</option>
                  <option>Phd</option>
                </select>
              </div>
              <label for="cheo" class="col-sm-2 col-form-label">Cheo(Nafasi ya kazi)</label>
              <div class="col-sm-3">
                <input type="text" class="form-control"  name="cheo" id="cheo" value="<?= $result->professional_name; ?>" readonly>
              </div>
            </div>

            <div class="row input-group mb-3">
              <label for="elimu" class="col-sm-2 col-form-label">Masharti ya kazi </label>
              <div class="col-sm-4">
                <select name="masharti_ya_kazi" class="form-control">
                  <option></option>
                  <option>Mkataba</option>
                  <option>Kudumu</option>
                </select>
              </div>
              <label for="elimu" class="col-sm-2 col-form-label">Jina la msimamizi</label>
              <div class="col-sm-4">
                <input type="text" class="form-control"  name="dept_head_name" value="" readonly>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary" onclick="process_1st_form()">Next</button>
              <button class="btn btn-danger" type="reset">Cancel</button>
            </div>
        </form> 
    </div>
  </div>
</div>
</main>

<script type="text/javascript" language="javascript">
     function process_1st_form(){
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
        url  : "<?php echo base_url() ?>employee_performance/employee_performance_form/process_1st_form",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            if(response == "fail"){
              location.reload();
            }else{
              $('#performance_form').html(response);
            }
          }
        });
      return false;
    }
  }

     function process_2nd_form(){
      $("#performance_form2").validate({
    
      rules: {
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
      uajibikaji_utoaji_maamuzi_1_mtumishi: {
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
             uajibikaji_utoaji_maamuzi_1_mtumishi:{
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
        url  : "<?php echo base_url() ?>employee_performance/employee_performance_form/process_2nd_user_form",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#performance_form').html(response);
            }
        });
      return false;
    }
  }

  function process_third_form(){

      var data = $('#performance_form3').serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>employee_performance/employee_performance_form/process_3rd_user_form",
        data : data,
        beforeSend: function(){ 

        },
        success : function(response){
            location.reload();
          }
        });
      return false;
   }
</script>