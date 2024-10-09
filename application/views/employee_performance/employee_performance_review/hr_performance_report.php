      <div class="card">
        <div class="card-body">
          <!-- start of table for displaying data -->
            <div class="col-lg-12">
              <?php 
                if($info['department'] == ""){?>
                  <h5 class="card-title">Performance Report of year <?= $info['year_selected']; ?></h5>
                <?php }else{?>
                  <h5 class="card-title">Performance Report of <?=$info['department'];?> year <?= $info['year_selected']; ?></h5>
                <?php } ?>
                <table class="table table-striped text-center">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col" class="col-sm-3">Jina Kamili</th>
                      <th scope="col">Elimu</th>
                      <th scope="col">Wastani wa utendaji</th>
                      <th scope="col">Department</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="table_data">
                    <!--we need to test the presence of rows, if not present return only sms, else display information-->
                    <?php 
                    $i = 1;
                    if($info['department'] == ""){
                      foreach($info['report']->result() as $row){?>
                        <tr>
                          <th scope="col"><?= $i; ?></th>
                          <td scope="col" class="col-sm-3"><?= $row->names; ?></td>
                          <td scope="col"><?= $row->elimu; ?></td>
                          <td scope="col"><?= $row->wastani_utendaji_wa_jumla; ?></td>
                          <td scope="col"><?= $row->department_name; ?></td>
                          <td scope="col"><button type="button" class="btn  btn-primary" onclick="view_more_report(<?= $row->employee_id ?>,<?= $info['year_selected']; ?>)">View More</button> </td>
                        </tr>

                    <?php  $i++;}
                    }else{ 
                        foreach($info['report']->result() as $row){?>
                          <tr>
                            <th scope="col"><?= $i; ?></th>
                            <td scope="col" class="col-sm-3"><?= $row->names; ?></td>
                            <td scope="col"><?= $row->elimu; ?></td>
                            <td scope="col"><?= $row->wastani_utendaji_wa_jumla; ?></td>
                            <td scope="col"><?= $info['department']; ?></td>
                            <td scope="col"><button type="button" class="btn  btn-primary" onclick="view_more_report(<?= $row->employee_id ?>,<?= $info['year_selected']; ?>)">View More</button> </td>
                          </tr>  
                        
                    <?php  $i++;}
                    }?>
                  </tbody>
                </table>
            </div>
           <!-- End of table roaster -->
          </div>
        </div>