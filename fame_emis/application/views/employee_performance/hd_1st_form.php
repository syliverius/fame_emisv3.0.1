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

        <input type="text" name="employee_id" id="employee_id" hidden>

        <div class="row input-group mb-3">
          <label for="names" class="col-sm-2 col-form-label">Majina kamili</label>
          <div class="col-sm-6">
            <input type="text" class="form-control typeahead"  name="names" id="names" onchange="getEmployeeInfo()">
          </div>
          <label for="sex" class="col-sm-1 col-form-label">Jinsia</label>
          <div class="col-sm-3">
            <input type="text" class="form-control"  name="sex" id="sex" readonly>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="umri" class="col-sm-1 col-form-label">Umri</label>
          <div class="col-sm-2">
            <input type="number" class="form-control"  name="age" id="age">
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
              <input type="number" class="form-control"  name="wategemezi" id="wategemezi" readonly>
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
              <input type="text" class="form-control"  name="cheo" id="cheo" readonly>
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
            <div class="col-sm-4"><!-- we'll print hd name but not insert into db -->
              <input type="text" class="form-control"  name="dept_head_name" value="<?= $this->session->userdata("full_name"); ?>" readonly>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary" onclick="hd_process_1st_form()">Next</button>
            <button class="btn btn-danger" type="reset">Cancel</button>
          </div>
      </form> 
  </div>
</div>