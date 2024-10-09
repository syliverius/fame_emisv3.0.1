<div class="card">
    <div class="card-body">
    <!-- start of table for displaying data -->
    <div class="col-lg-12">
    <?= $this->session->flashdata('emergency_leave_sms'); ?>
    
    <h3 class="card-title"><b>List employee who needs emergency leave approval</b></h3>
    <div id="dept_head_approval_response_message"></div>
    <table class="table table-striped">
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
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $i=1;
          foreach ($emergency as $row){
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?= $row->names; ?></td>
            <td><?= $row->emergency_days; ?></td>
            <td><?= $row->department_name; ?></td>
            <td><?= $row->start_date; ?></td>
            <td><?= $row->end_date; ?></td>
            <td><?= $row->sababu; ?></td>
            <td><?= $row->comments; ?></td>
            <td>
              <button type="button" class="btn  btn-primary"  onclick="view_emergency_leave(<?= $row->emergency_id; ?>)">View</button>
              <button type="button" class="btn btn-success" onclick="approve_emergency_leave(<?= $row->emergency_id; ?> , '<?= $row->names; ?>')">Approve</button>   
            </td>

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
        <th scope="col">Action</th>
      </tfoot>
    </table>
  </div>
  <!-- End of displaying data table -->
  </div>
</div>