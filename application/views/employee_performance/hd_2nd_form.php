
<!--**********************************  EMPLOYEE PERFORMANCE 2ND FORM  *********************************************-->
<div class="card">
  <div class="card-body">
      <div class="card-title text-center">
        SEHEMU YA 1 : SIFA ZA UTENDAJI BORA<br/>
        <i>ijazwe na mtumishi anayepimwa na msimamizi wa kazi</i>
      </div>
        <b>Alama</b>:<br />
        1 = Utekelezaji usioridhisha na usiozingatia malengo &nbsp;&nbsp;&nbsp;2 = Utekelezaji usioridhisha ambao ni chini ya wastani bila sababu za kutosha<br />
        3 = Utekelezaji wa wastani kwa malengo yote &nbsp;&nbsp;&nbsp; 4 = Utekelezaji wa malengo yote kwa ufanisi<br />
        5 = Utekelezaji wa malengo yote na ya ziada kwa ufanisi
        <form method="post" id="performance_form2">
        <input type="text" name="employee_id" value="<?= $from_form_1['employee_id']; ?>" hidden>
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
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_1_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_1_maafikiano" min="1" max="5"></td>                          
          </tr>
          <tr>
            <td>Uwezo wa kushirikiana na wenzi</td>
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_2_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_2_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_2_maafikiano" min="1" max="5"></td>                          
          </tr>
          <tr>
            <td>Uwezo wa kustahiliwa na wenzi</td>
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_3_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_3_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mahusiano_kazini_3_maafikiano" min="1" max="5"></td>                       
          </tr>

          <tr>
            <td rowspan="4">2</td>
            <td rowspan="4">MAWASILIANO NA USIKIVU</td>
            <td>Uwezo wa kushirikiana na wenzi</td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_1_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_1_maafikiano" min="1" max="5"></td>                         
          </tr>
          <tr>
            <td>Uwezo wa kujieleza kwa kunena</td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_2_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_2_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_2_maafikiano" min="1" max="5"></td>                           
          </tr>
          <tr>
            <td>Uwezo wa usikivu na ufahamu</td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_3_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_3_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_3_maafikiano" min="1" max="5"></td>                           
          </tr>
          <tr>
            <td>Uwezo wa kufunza na kuendeleza</td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_4_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_4_msimaizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="mawasiliano_na_usikivu_4_maafikiano" min="1" max="5"></td>                           
          </tr>

          <tr>
            <td rowspan="3">3</td>
            <td rowspan="3">UONGOZI NA USIMAMIZI</td>
            <td>Uwezo wa kupanga na kusimamia</td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi_1_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi_1_maafikiano" min="1" max="5"></td>                          
          </tr>
          <tr>
            <td>Uwezo wa kuongoza, kuhamasisha na kutatua migongano</td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi_2_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi__2_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi__2_maafikiano" min="1" max="5"></td>                         
          </tr>
          <tr>
            <td>Uwezo wa ubunifu na uanzishaji</td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi_3_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi_3_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uongozi_na_usimamizi_3_maafikiano" min="1" max="5"></td>                          
          </tr>

          <tr>
            <td rowspan="2">4</td>
            <td rowspan="2">UBORA WA UTENDAJI</td>
            <td>Uwezo wa kutoa matokeo sahihi kwa wakati</td>
            <td><input type="text" class="col-md-8 text-center" name="ubora_na_utendaji_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="ubora_na_utendaji_1_msimamizi" ></td>
            <td><input type="text" class="col-md-8 text-center" name="ubora_na_utendaji_1_maafikiano" ></td>                          
          </tr>
          <tr>
            <td>Uwezo wa kuhimili utekelezaji na kuendelea kwa muda mrefu</td>
             <td><input type="text" class="col-md-8 text-center" name="ubora_na_utendaji_2_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="ubora_na_utendaji_2_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="ubora_na_utendaji_2_maafikiano" min="1" max="5"></td>                          
          </tr>

          <tr>
            <td rowspan="2">5</td>
            <td rowspan="2">UTENDAJI UNAOZINGATIA WINGI WA MATOKEO</td>
            <td>Uwezo wa kufikia malengo</td>
             <td><input type="text" class="col-md-8 text-center" name="utendaji_wa_wingi_wa_matokeo_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="utendaji_wa_wingi_wa_matokeo_1_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="utendaji_wa_wingi_wa_matokeo_1_maafikiano" min="1" max="5"></td>                        
          </tr>
          <tr>
            <td>Uwezo wa kumudu majukumu ya ziada</td>
            <td><input type="text" class="col-md-8 text-center" name="utendaji_wa_wingi_wa_matokeo_2_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="utendaji_wa_wingi_wa_matokeo_2_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="utendaji_wa_wingi_wa_matokeo_2_maafikiano" min="1" max="5"></td>                          
          </tr>

          <tr>
            <td rowspan="2">6</td>
            <td rowspan="2">UWAJIBIKAJI NA UTOAJI WA MAAMUZI</td>
            <td>Uwezo wa uwajibikaji katika kutekeleza majukumu</td>
            <td><input type="text" class="col-md-8 text-center" name="uajibikaji_utoaji_maamuzi_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uajibikaji_utoaji_maamuzi_1_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uajibikaji_utoaji_maamuzi_1_maafikiano" min="1" max="5"></td>                          
          </tr>
          <tr>
            <td>Uwezo wa kufanya maamuzi sahihi kwa wakati muafaka</td>
            <td><input type="text" class="col-md-8 text-center" name="uajibikaji_utoaji_maamuzi_2_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uajibikaji_utoaji_maamuzi_2_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uajibikaji_utoaji_maamuzi_2_maafikiano" min="1" max="5"></td>                          
          </tr>

          <tr>
            <td >7</td>
            <td >KUTHAMINI WATEJA</td>
            <td>Uwezo wa kuhudumia wateja</td>
            <td><input type="text" class="col-md-8 text-center" name="kuthamini_wateja_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="kuthamini_wateja_1_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="kuthamini_wateja_1_maafikiano" min="1" max="5"></td>                         
          </tr>
          
          <tr>
            <td rowspan="3">8</td>
            <td rowspan="3">UAMINIFU</td>
            <td>Uwezo wa kuonyesha stadi za uongozi</td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_1_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_1_maafikiano" min="1" max="5"></td>                         
          </tr>
          <tr>
            <td>Uwezo wa kumsaidia Kiongozi kutekeleza majukumu yake</td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_2_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_2_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_2_maafikiano" min="1" max="5"></td>                        
          </tr>
          <tr>
            <td>Uwezo wa kupokea na kutekeleza maelekezo</td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_3_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_3_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uaminifu_3_maafikiano" min="1" max="5"></td>                         
          </tr>

          <tr>
            <td rowspan="3">9</td>
            <td rowspan="3">UADILIFU</td>
            <td>Uwezo wa kutekeleza majukumu kikamilifu kwa muda uliopangwa</td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_1_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_1_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_1_maafikiano" min="1" max="5"></td>                          
          </tr>
          <tr>
            <td>Hutoa huduma bora bila vishawishi</td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_2_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_2_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_2_maafikiano" min="1" max="5"></td>                          
          </tr>
          <tr>
            <td>Uwezo wa kutumia taaluma kwa manufaa ya umma</td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_3_mtumishi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_3_msimamizi" min="1" max="5"></td>
            <td><input type="text" class="col-md-8 text-center" name="uadilifu_3_maafikiano" min="1" max="5"></td>                          
          </tr>
          <tr>
            <td colspan="3">Jumuisho la kiwango cha alama za utendaji</td>
            <td><input type="text" class="col-md-8 text-center" readonly></td>
            <td><input type="text" class="col-md-8 text-center" readonly></td>
            <td><input type="text" class="col-md-8 text-center" readonly></td>                         
          </tr>
        </tbody>
      </table>
      <div class="text-center">
        <button type="submit" class="btn btn-primary" onclick="hd_process_2nd_form()">Next</button>
        <button class="btn btn-danger" type="reset">Cancel</button>
      </div>  
    </form>   
  </div>
</div>
<!--********************************** END EMPLOYEE PERFORMANCE 2ND FORM   ********************************************-->
