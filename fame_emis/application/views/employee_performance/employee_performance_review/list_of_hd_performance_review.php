<div class="card">
  <div class="card-body">
    <!-- start of table for displaying data -->
    <div class="col-lg-12">
      <h3 class="card-title"><b>List employee who needs Department's Head  Employee Performance Evaluation Review</b></h3>
      <div> <?= $this->session->flashdata('message');?></div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col" class="col-sm-3">Names</th>
              <th scope="col">Jinsi</th>
              <th scope="col">Elimu</th>
              <th scope="col">profession</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if($info->num_rows() <= 0){ ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert"> <b>Amna taarifa za watumishi zinazoitaji mapitio mwaka huu</b> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
              <?php 
            }else{
               $i = 1;
                foreach($info->result() as $row){
                  ?>
                  <tr>
                    <td scope="col"><?= $i; ?></td>
                    <td scope="col" class="col-sm-3"><?= $row->names; ?></td>
                    <td scope="col"><?= $row->gender; ?></td>
                    <td scope="col"><?= $row->elimu; ?></td>
                    <td scope="col"><?= $row->professional_name; ?></td>
                    <td scope="col">
                      <button type="button" class="btn  btn-primary" onclick="view_more_details(<?= $row->employee_id ?>)">View More</button>
                    </td>
                  </tr>
                  <?php
                $i ++;}
              }
            ?>
          </tbody>
          <tfoot>
            <th scope="col">No.</th>
            <th scope="col" class="col-sm-3">Names</th>
            <th scope="col">Jinsi</th>
            <th scope="col">Elimu</th>
            <th scope="col">profession</th>
            <th scope="col">Action</th>
          </tfoot>
        </table>
      </div>
    <!-- End of displaying data table -->
  </div>
</div>