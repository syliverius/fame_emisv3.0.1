<div class="card">
  <div class="card-body">
    <div class="col-lg-12">
      <h3 class="card-title"><b>List employee on emergency leave</b></h3>
      <table class="table table-striped datatable">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col" class="col-sm-3">Full Name</th>
            <th scope="col">Days</th>
            <th scope="col">Department</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Reasons</th>
            <th scope="col">Comments</th>
          </tr>
        </thead>
        <tbody>
          <?php 

          $list = $this->hr->get_employee_on_leave();
            $i=1;
            foreach ($list as $row){
              $employee_info = $this->hr->check_Department_Id_get_Name($row->employee_id);
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?= $employee_info->names; ?></td>
              <td><?= $row->emergency_days; ?></td>
              <td><?= $this->hr->get_Department_Details($employee_info->department_id)->department_name; ?></td>
              <td><?= $row->start_date; ?></td>
              <td><?= $row->end_date; ?></td>
              <td><?= $row->sababu; ?></td>
              <td><?= $row->comments; ?></td>
              <?php $i++; ?>
            </tr>
            <?php
            } ?>
                            		
        </tbody>
        <tfoot>
          <th scope="col">No.</th>
          <th scope="col" class="col-sm-3">Full Name</th>
          <th scope="col">Days</th>
          <th scope="col">Department</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Reason</th>
          <th scope="col">Comments</th>
        </tfoot>
    </table>
    </div>
  <!-- End of displaying data table -->
  </div>
</div>