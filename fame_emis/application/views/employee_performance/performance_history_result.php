      <div class="card">
        <div class="card-body">
          <!-- start of table for displaying data -->
            <div class="col-lg-12">
              <h5 class="card-title">Performance Report of year <?= $info['year_selected']; ?></h5>
                <table class="table table-striped text-center">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col" class="col-sm-3">Jina Kamili</th>
                      <th scope="col">Elimu</th>
                      <th scope="col">Wastani wa utendaji</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="table_data">
                    <!--we need to test the presence of rows, if not present return only sms, else display information-->
                    <?php 
                    $i = 1;
                    if($info['employee_info']->num_rows() <= 0){
                      ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert"> Samahani!!. Hakuna taarifa za evaluation za mwaka huu. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                      <?php
                    }else{
                      $rows = $info['employee_info']->result();
                      foreach($rows as $row){ ?>
                        <tr>
                        <th scope="col"><?= $i; ?></th>
                        <td scope="col" class="col-sm-3"><?= $row->names; ?></td>
                        <td scope="col"><?= $row->elimu; ?></td>
                        <td scope="col"><?= $row->wastani_utendaji_wa_jumla; ?></td>
                        <td scope="col"><button type="button" class="btn  btn-primary" onclick="view_more(<?= $row->employee_id ?>,<?= $info['year_selected']; ?>)">View More</button> </td>
                      </tr>
                      <?php $i++; }
                    }?>
                  </tbody>
                </table>
            </div>
           <!-- End of table roaster -->
          </div>
        </div>