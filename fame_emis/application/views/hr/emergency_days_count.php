<div class="card">
  <div class="card-body">
    <div class="col-lg-12">
      <h3 class="card-title"><b>List of employee and their emergency leave days count for this year(<?= date('Y'); ?>) </b></h3>
      <table class="table table-striped datatable">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col" class="col-sm-3">Full Name</th>
            <th scope="col">Total days spent</th>
            <th scope="col">Department</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 

          $employee_list = $this->hr->getAllEmployee();
            $i=1;
            foreach ($employee_list as $employee){
              $count = $this->hr->count_emergency_days($employee->employee_id);
              $total;
              if(empty($count)){
                $total = 0;
              }else{
                foreach($count as $count){
                  $total += $count->emergency_days; 
                }
              }
              $department = $this->hr->get_Department_Details($employee->department_id);
              if(isset($department->department_name)){
                $department = $department->department_name;
              }else{
                $department = "Unknown";
              }
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td ><?= $employee->names; ?></td>
              <td><?= $total; ?></td>
              <td><?= $department; ?></td>
              <td>
                <button type="button" class='btn btn-primary' onclick="View_more_history(<?= $employee->employee_id; ?>)">View more</button>
              </td>
              <?php $i++; ?>
            </tr>
            <?php
            } ?>
                            		
        </tbody>
    </table>
    </div>
  <!-- End of displaying data table -->
  </div>
</div>