<?php 
 // here we will calculate sum of three last field of the second form
 $sum1 = $info['performance_info']->mahusiano_kazini_1_mtumishi+$info['performance_info']->mahusiano_kazini_2_mtumishi+$info['performance_info']->mahusiano_kazini_3_mtumishi+$info['performance_info']->mawasiliano_na_usikivu_1_mtumishi+$info['performance_info']->mawasiliano_na_usikivu_2_mtumishi+$info['performance_info']->mawasiliano_na_usikivu_3_mtumishi+$info['performance_info']->mawasiliano_na_usikivu_4_mtumishi+$info['performance_info']->uongozi_na_usimamizi_1_mtumishi+$info['performance_info']->uongozi_na_usimamizi_2_mtumishi+$info['performance_info']->uongozi_na_usimamizi_3_mtumishi+$info['performance_info']->ubora_na_utendaji_1_mtumishi+$info['performance_info']->ubora_na_utendaji_2_mtumishi+$info['performance_info']->utendaji_wa_wingi_wa_matokeo_1_mtumishi+$info['performance_info']->utendaji_wa_wingi_wa_matokeo_2_mtumishi+$info['performance_info']->uajibikaji_utoaji_maamuzi_1_mtumishi+$info['performance_info']->uajibikaji_utoaji_maamuzi_2_mtumishi+$info['performance_info']->kuthamini_wateja_1_mtumishi+$info['performance_info']->uaminifu_1_mtumishi+$info['performance_info']->uaminifu_2_mtumishi+$info['performance_info']->uaminifu_3_mtumishi+$info['performance_info']->uadilifu_1_mtumishi+$info['performance_info']->uadilifu_2_mtumishi+$info['performance_info']->uadilifu_3_mtumishi;

 $sum2 = $info['performance_info']->mahusiano_kazini_1_msimamizi+$info['performance_info']->mahusiano_kazini_2_msimamizi+$info['performance_info']->mahusiano_kazini_3_msimamizi+$info['performance_info']->mawasiliano_na_usikivu_1_msimamizi+$info['performance_info']->mawasiliano_na_usikivu_2_msimamizi+$info['performance_info']->mawasiliano_na_usikivu_3_msimamizi+$info['performance_info']->mawasiliano_na_usikivu_4_msimaizi+$info['performance_info']->uongozi_na_usimamizi_1_msimamizi+$info['performance_info']->uongozi_na_usimamizi__2_msimamizi+$info['performance_info']->uongozi_na_usimamizi_3_msimamizi+$info['performance_info']->ubora_na_utendaji_1_msimamizi+$info['performance_info']->ubora_na_utendaji_2_msimamizi+$info['performance_info']->utendaji_wa_wingi_wa_matokeo_1_msimamizi+$info['performance_info']->utendaji_wa_wingi_wa_matokeo_2_msimamizi+$info['performance_info']->uajibikaji_utoaji_maamuzi_1_msimamizi+$info['performance_info']->uajibikaji_utoaji_maamuzi_2_msimamizi+$info['performance_info']->kuthamini_wateja_1_msimamizi+$info['performance_info']->uaminifu_1_msimamizi+$info['performance_info']->uaminifu_2_msimamizi+$info['performance_info']->uaminifu_3_msimamizi+$info['performance_info']->uadilifu_1_msimamizi+$info['performance_info']->uadilifu_2_msimamizi+$info['performance_info']->uadilifu_3_msimamizi;

 $sum3 = $info['performance_info']->mahusiano_kazini_1_maafikiano+$info['performance_info']->mahusiano_kazini_2_maafikiano+$info['performance_info']->mahusiano_kazini_3_maafikiano+$info['performance_info']->mawasiliano_na_usikivu_1_maafikiano+$info['performance_info']->mawasiliano_na_usikivu_2_maafikiano+$info['performance_info']->mawasiliano_na_usikivu_3_maafikiano+$info['performance_info']->mawasiliano_na_usikivu_4_maafikiano+$info['performance_info']->uongozi_na_usimamizi_1_maafikiano+$info['performance_info']->uongozi_na_usimamizi__2_maafikiano+$info['performance_info']->uongozi_na_usimamizi_3_maafikiano+$info['performance_info']->ubora_na_utendaji_1_maafikiano+$info['performance_info']->ubora_na_utendaji_2_maafikiano+$info['performance_info']->utendaji_wa_wingi_wa_matokeo_1_maafikiano+$info['performance_info']->utendaji_wa_wingi_wa_matokeo_2_maafikiano+$info['performance_info']->uajibikaji_utoaji_maamuzi_1_maafikiano+$info['performance_info']->uajibikaji_utoaji_maamuzi_2_maafikiano+$info['performance_info']->kuthamini_wateja_1_maafikiano+$info['performance_info']->uaminifu_1_maafikiano+$info['performance_info']->uaminifu_2_maafikiano+$info['performance_info']->uaminifu_3_maafikiano+$info['performance_info']->uadilifu_1_maafikiano+$info['performance_info']->uadilifu_2_maafikiano+$info['performance_info']->uadilifu_3_maafikiano;

?>


<div class="card">
<div class="card-body">
  <br />
<div class="row input-group mb-3">
  <label for="kutoka" class="col-sm-2 col-form-label">Kutoka</label>
    <div class="col-sm-4">
      <input type="dates" class="form-control"  value="<?= date('Y',strtotime($info['performance_info']->date))-1; ?>" readonly>
    </div>
  <label for="hadi" class="col-sm-2 col-form-label">Hadi Juni</label>
    <div class="col-sm-4">
      <input type="dates" class="form-control" value="<?= date('Y',strtotime($info['performance_info']->date)); ?>" readonly>
    </div>
</div>

<!-- <?= $info['employee_info']->employee_id;?> -->
<input type="text" name="employee_id" value="<?= $info['employee_info']->employee_id; ?>" hidden>
<div class="row input-group mb-3">
  <label for="names" class="col-sm-2 col-form-label">Majina kamili</label>
  <div class="col-sm-6">
    <input type="text" class="form-control typeahead" value="<?= $info['employee_info']->names; ?>" readonly>
  </div>
  <label for="sex" class="col-sm-1 col-form-label">Jinsia</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" value="<?= $info['employee_info']->gender; ?>" readonly>
  </div>
</div>

<div class="row input-group mb-3">
  <label for="umri" class="col-sm-1 col-form-label">Umri</label>
  <div class="col-sm-2">
    <input type="number" class="form-control" value="<?= $info['performance_info']->age; ?>" readonly>
  </div>
  <label for="uraia" class="col-sm-1 col-form-label">Uraia</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" value="<?= $info['performance_info']->nationality; ?>" readonly>
  </div>
  <label for="marital_status" class="col-sm-2 col-form-label">Kama umeolea/oa</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" value="<?= $info['performance_info']->marital_status; ?>" readonly>
  </div>
</div>

<div class="row input-group mb-3">
  <label for="wategemezi" class="col-sm-2 col-form-label">Idadi ya wategemezi</label>
  <div class="col-sm-3">
    <input type="number" class="form-control" value="<?= $info['performance_info']->wategemezi; ?>" readonly>
  </div>
  <label for="department" class="col-sm-2 col-form-label">Jina La Idara</label>
  <div class="col-sm-5">
    <input type="text" class="form-control" value="<?= $info['employee_info']->department_name; ?>" readonly>
  </div>
</div>

<div class="row input-group mb-3">
  <label for="elimu" class="col-sm-4 col-form-label">Kiwango cha elimu(Anza na cha juu kabisa)</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" value="<?= $info['performance_info']->elimu; ?>"  readonly>
  </div>
  <label for="cheo" class="col-sm-2 col-form-label">Cheo(Nafasi ya kazi)</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" value="<?= $info['employee_info']->professional_name; ?>" readonly>
  </div>
</div>

<div class="row input-group mb-3">
  <label for="elimu" class="col-sm-2 col-form-label">Masharti ya kazi </label>
  <div class="col-sm-4">
    <input type="text" class="form-control" value="<?= $info['performance_info']->masharti_ya_kazi; ?>" readonly>
  </div>
  <label for="elimu" class="col-sm-2 col-form-label">Jina la msimamizi</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" value="<?= $info['performance_info']->jina_la_msimamizi; ?>" readonly>
  </div>
</div>

<!-- start of second form -->
<div class="card-title text-center">
  SEHEMU YA 1 : SIFA ZA UTENDAJI BORA<br/>
  <i>Imejazwa na mtumishi anayepimwa na msimamizi wa kazi</i>
</div>
  <table class="table table-bordered border-primary text-center">
    <tr>  
      <th rowspan="2">Namba</th>
      <th rowspan="2">Vigezo Muhimu</th>
      <th rowspan="2">Ubora Wa Sifa</th>
      <th colspan="3">Alama Iliyotolewa</th>
    </tr>
    <tr>
      <th>Mtumishi</th>
      <th>Msimamizi</th>
      <th>Alama zilizoafikiwa</th>
    </tr>
    <tbody>
      <tr>
        <td rowspan="3">1</td>
        <td rowspan="3">MAHUSIANO KAZINI</td>
        <td>Uwezo wa kufanya kazi na wenzi</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_1_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_1_maafikiano; ?>" readonly></td>                          
      </tr>
      <tr>
        <td>Uwezo wa kushirikiana na wenzi</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_2_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_2_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_2_maafikiano; ?>" readonly></td>                          
      </tr>
      <tr>
        <td>Uwezo wa kustahiliwa na wenzi</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_3_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_3_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mahusiano_kazini_3_maafikiano; ?>" readonly></td>                       
      </tr>

      <tr>
        <td rowspan="4">2</td>
        <td rowspan="4">MAWASILIANO NA USIKIVU</td>
        <td>Uwezo wa kushirikiana na wenzi</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_1_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_1_maafikiano; ?>" readonly></td>                         
      </tr>
      <tr>
        <td>Uwezo wa kujieleza kwa kunena</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_2_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_2_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_2_maafikiano; ?>" readonly></td>                           
      </tr>
      <tr>
        <td>Uwezo wa usikivu na ufahamu</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_3_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_3_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_3_maafikiano; ?>" readonly></td>                           
      </tr>
      <tr>
        <td>Uwezo wa kufunza na kuendeleza</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_4_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_4_msimaizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->mawasiliano_na_usikivu_4_maafikiano; ?>" readonly></td>                           
      </tr>

      <tr>
        <td rowspan="3">3</td>
        <td rowspan="3">UONGOZI NA USIMAMIZI</td>
        <td>Uwezo wa kupanga na kusimamia</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi_1_msimamizi; ?>" readonly></td>
                          <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi_1_maafikiano; ?>" readonly></td>                          
      </tr>
      <tr>
        <td>Uwezo wa kuongoza, kuhamasisha na kutatua migongano</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi_2_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi__2_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi__2_maafikiano; ?>" readonly></td>                         
      </tr>
      <tr>
        <td>Uwezo wa ubunifu na uanzishaji</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi_3_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi_3_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uongozi_na_usimamizi_3_maafikiano; ?>" readonly></td>                          
      </tr>

      <tr>
        <td rowspan="2">4</td>
        <td rowspan="2">UBORA WA UTENDAJI</td>
        <td>Uwezo wa kutoa matokeo sahihi kwa wakati</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->ubora_na_utendaji_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->ubora_na_utendaji_1_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->ubora_na_utendaji_1_maafikiano; ?>" readonly></td>                          
      </tr>
      <tr>
        <td>Uwezo wa kuhimili utekelezaji na kuendelea kwa muda mrefu</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->ubora_na_utendaji_2_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->ubora_na_utendaji_2_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->ubora_na_utendaji_2_maafikiano; ?>" readonly></td>                          
      </tr>

      <tr>
        <td rowspan="2">5</td>
        <td rowspan="2">UTENDAJI UNAOZINGATIA WINGI WA MATOKEO</td>
        <td>Uwezo wa kufikia malengo</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->utendaji_wa_wingi_wa_matokeo_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->utendaji_wa_wingi_wa_matokeo_1_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->utendaji_wa_wingi_wa_matokeo_1_maafikiano; ?>" readonly></td>                        
      </tr>
      <tr>
        <td>Uwezo wa kumudu majukumu ya ziada</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->utendaji_wa_wingi_wa_matokeo_2_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->utendaji_wa_wingi_wa_matokeo_2_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->utendaji_wa_wingi_wa_matokeo_2_maafikiano; ?>" readonly></td>                          
      </tr>

      <tr>
        <td rowspan="2">6</td>
        <td rowspan="2">UWAJIBIKAJI NA UTOAJI WA MAAMUZI</td>
        <td>Uwezo wa uwajibikaji katika kutekeleza majukumu</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uajibikaji_utoaji_maamuzi_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uajibikaji_utoaji_maamuzi_1_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uajibikaji_utoaji_maamuzi_1_maafikiano; ?>" readonly></td>                          
      </tr>
      <tr>
        <td>Uwezo wa kufanya maamuzi sahihi kwa wakati muafaka</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uajibikaji_utoaji_maamuzi_2_mtumishi; ?>" readonly></td>
         <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uajibikaji_utoaji_maamuzi_2_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uajibikaji_utoaji_maamuzi_2_maafikiano; ?>" readonly></td>                          
      </tr>

      <tr>
        <td >7</td>
        <td >KUTHAMINI WATEJA</td>
        <td>Uwezo wa kuhudumia wateja</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->kuthamini_wateja_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->kuthamini_wateja_1_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->kuthamini_wateja_1_maafikiano; ?>" readonly></td>                         
      </tr>
                        
      <tr>
        <td rowspan="3">8</td>
        <td rowspan="3">UAMINIFU</td>
        <td>Uwezo wa kuonyesha stadi za uongozi</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_1_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_1_maafikiano; ?>" readonly></td>                         
      </tr>
      <tr>
        <td>Uwezo wa kumsaidia Kiongozi kutekeleza majukumu yake</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_2_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_2_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_2_maafikiano; ?>" readonly></td>                        
      </tr>
      <tr>
        <td>Uwezo wa kupokea na kutekeleza maelekezo</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_3_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_3_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uaminifu_3_maafikiano; ?>" readonly></td>                         
      </tr>

      <tr>
        <td rowspan="3">9</td>
        <td rowspan="3">UADILIFU</td>
        <td>Uwezo wa kutekeleza majukumu kikamilifu kwa muda uliopangwa</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_1_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_1_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_1_maafikiano; ?>" readonly></td>                          
      </tr>
      <tr>
        <td>Hutoa huduma bora bila vishawishi</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_2_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_2_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_2_maafikiano; ?>" readonly></td>                          
      </tr>
      <tr>
        <td>Uwezo wa kutumia taaluma kwa manufaa ya umma</td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_3_mtumishi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_3_msimamizi; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" name="" value="<?= $info['performance_info']->uadilifu_3_maafikiano; ?>" readonly></td>                          
      </tr>
      <tr>
        <td colspan="3">Jumuisho la kiwango cha alama za utendaji</td>
        <td><input type="text" class="col-md-8 text-center" value="<?= $sum1; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" value="<?= $sum2; ?>" readonly></td>
        <td><input type="text" class="col-md-8 text-center" value="<?= $sum3; ?>" readonly></td>                         
      </tr>
    </tbody>
 </table>

  <!--the beginning of the third form -->
  <div class="card-title text-center">
    SEHEMU YA 2 : UTENDAJI WA JUMLA<br />
  </div>
  <div class="row input-group mb-3">
    <label for="wastani" class="col-sm-2 col-form-label">WASTANI</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" value="<?= $info['performance_info']->wastani_utendaji_wa_jumla; ?>" readonly>
      </div>
  </div>

  <div class="row input-group mb-3">
    <label for="names" class="col-sm-4 col-form-label">MAONI YA MTUMISHI ANAYEPIMWA (kama yapo):</label>
      <div class="col-sm-8">
        <textarea class="form-control" cols="2" name="mtumishi_maoni" readonly><?= $info['performance_info']->maoni_ya_mtumishi; ?></textarea>
      </div>
  </div>
    <br />
    <p class="text-center"><b>SEHEMU YA 3: TUZO/HATUA ZA KUBORESHA UTENDAJI/HATUA ZA KINIDHAMU</b></p>
      Msimamizi wa mtumishi atapendekeza aina ya tuzo au hatua za kuboresha utendaji wa mtumishi ama hatua za kinidhamu kulingana na kiwango cha utekelezaji wa malengo yaliyokubalika.

  <div class="row input-group mb-3">
    <div class="col-sm-12">
      <textarea class="form-control" cols="2" name="tuzo" readonly><?= $info['performance_info']->tuzo_au_hatua; ?></textarea>
    </div>
  </div>

  <div class="row input-group mb-3">
    <label for="hd_maoni" class="col-sm-4 col-form-label">3.1.  MAONI YA MSIMAMIZI (kama yapo):</label>
      <div class="col-sm-8">
        <textarea class="form-control" cols="2" name="hd_maoni" readonly><?= $info['performance_info']->maoni_ya_msimamizi; ?></textarea>
      </div>
  </div>

  <div class="row input-group mb-3">
    <label for="hd_names" class="col-sm-2 col-form-label">Jina la Msimamizi</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" value="<?= $info['performance_info']->jina_la_msimamizi; ?>" readonly>
      </div>
    <label for="tarehe" class="col-sm-2 col-form-label">Tarehe</label>
      <div class="col-sm-3">
        <input type="date" class="form-control" value="<?= $info['performance_info']->date; ?>" readonly>
      </div>
  </div>
  <br />

  <p class="text-center"><b>3.2.  MAONI NA MAPENDEKEZO YA MENEJA RASILIMALI WATU</b></p>
  <div class="row input-group mb-3">
    <div class="col-sm-12">
      <textarea class="form-control" cols="2" name="hr_maoni"></textarea>
    </div>
  </div>

  <div class="row input-group mb-3">
    <label for="hd_names" class="col-sm-2 col-form-label">Jina La MENEJA</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="hr_name" value="<?= $this->session->userdata('full_name'); ?>" readonly>
      </div>
    <label for="tarehe" class="col-sm-2 col-form-label">Tarehe</label>
      <div class="col-sm-3">
        <input type="date" class="form-control" name="tarehe" value="<?= date('Y-m-d'); ?>" readonly>
      </div>
    </div>

  </div>
</div>