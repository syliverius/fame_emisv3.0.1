
<!--**********************************  LEAVE REQUEST FORM  *********************************************-->
   
<div id="performance_form">          
  <div class="card">
    <div class="card-body">
        <div class="card-title text-center">
          SEHEMU YA 2 : UTENDAJI WA JUMLA<br />
        </div>
        <form id="performance_form3" method="post">
          <input type="text" name="employee_id" value="<?= $from_form_2['employee_id'];?>" hidden>
          <div class="row input-group mb-3">
            <label for="wastani" class="col-sm-2 col-form-label">WASTANI</label>
            <div class="col-sm-5">
              <input type="text" class="form-control"  name="wastani" value="<?= number_format($from_form_2_performance['total_performance'],1);?>" readonly>
            </div>
          </div>

          <div class="row input-group mb-3">
            <label for="names" class="col-sm-4 col-form-label">MAONI YA MTUMISHI ANAYEPIMWA (kama yapo):</label>
            <div class="col-sm-8">
              <textarea class="form-control" cols="2" name="mtumishi_maoni"></textarea>
            </div>
          </div>
          <br />
          <p class="text-center"><b>SEHEMU YA 3: TUZO/HATUA ZA KUBORESHA UTENDAJI/HATUA ZA KINIDHAMU</b></p>
          Msimamizi wa mtumishi atapendekeza aina ya tuzo au hatua za kuboresha utendaji wa mtumishi ama hatua za kinidhamu kulingana na kiwango cha utekelezaji wa malengo yaliyokubalika.
          <div class="row input-group mb-3">
            <div class="col-sm-12">
              <textarea class="form-control" cols="2" name="tuzo"></textarea>
            </div>
          </div>

          <div class="row input-group mb-3">
            <label for="hd_maoni" class="col-sm-4 col-form-label">3.1.  MAONI YA MSIMAMIZI (kama yapo):</label>
            <div class="col-sm-8">
              <textarea class="form-control" cols="2" name="hd_maoni"></textarea>
            </div>
          </div>

          <div class="row input-group mb-3">
            <label for="hd_names" class="col-sm-2 col-form-label">Jina la Msimamizi</label>
            <div class="col-sm-5">
              <input type="text" class="form-control"  name="hd_names" value="<?= $this->session->userdata("full_name"); ?>" readonly>
            </div>
            <label for="tarehe" class="col-sm-2 col-form-label">Tarehe</label>
            <div class="col-sm-3">
              <input type="date" class="form-control"  name="tarehe" value="<?= date('Y-m-d');?>" readonly>
            </div>
          </div>
          <br />

           <p class="text-center"><b>3.2.  MAONI NA MAPENDEKEZO YA MENEJA RASILIMALI WATU</b></p>
          <div class="row input-group mb-3">
            <div class="col-sm-12">
              <textarea class="form-control" cols="2" name="hr_maoni" readonly></textarea>
            </div>
          </div>
          <div class="row input-group mb-3">
            <label for="hd_names" class="col-sm-2 col-form-label">Jina La MENEJA</label>
            <div class="col-sm-5">
              <input type="text" class="form-control"  name="hr_names" readonly>
            </div>
            <label for="tarehe" class="col-sm-2 col-form-label">Tarehe</label>
            <div class="col-sm-3">
              <input type="date" class="form-control"  name="tarehe" readonly>
            </div>
          </div>

            <div class="text-center">
              <button type="button" class="btn btn-primary" onclick="hd_process_third_form()">Submit</button>
              <button class="btn btn-danger" type="reset">Cancel</button>
            </div>
        </form> 
    </div>
  </div>
</div> 
<!--**********************************END LEAVE REQUEST FORM   *********************************************-->