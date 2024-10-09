<div class="card-body" id="unapproved_leave">
  <?php 
    $data = $this->admin->getUnapprovedAnnualLeaves();
  ?>
  <div class="col-lg-12">
    <div id="response_message"><?php if (isset($sms)) {
      echo $sms;
    } ?></div>
      <table class="table datatable">
        <thead>
            <th scope="col">No.</th>
            <th scope="col" class="col-sm-3">Full Name</th>
            <th scope="col">Department</th>
            <th scope="col">Department signature</th>
            <th scope="col">Hr signature</th>
            <th scope="col">Acoutant signature</th>
            <th scope="col">Move to</th>
            <th scope="col">Action</th>
        </thead>
        <tbody>
        <?php
          $count = 1;
          foreach($data as $row){ ?>
            <tr>
              <td><?= $count; ?></td>
              <td><?= $row->names; ?></td>
              <td><?= $row->department_name; ?></td>
              <td><?= $row->dept_head_sign ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-warning">Pending...</span>' ?></td>
              <td><?= $row->hr_sign ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-warning">Pending...</span>' ?></td>
              <td><?= $row->accoutant_sign ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-warning">Pending...</span>' ?></td>
              <td>
                <select class="form-control" id="<?= $row->benefit_id.'_id'; ?>" name="move_to" onchange="moveAnnualLeaveTo(<?= $row->benefit_id; ?>)" >
                  <?php 
                  //We have some problem below, maybe will be solved in future
                    if(!$row->dept_head_sign){ ?>
                      <option >choose where to move</option>
                      <option>Human Resource</option>
                      <option>Accountant</option>
                      <option>Complete</option>
                    <?php }else if($row->$hr_sign == false){ ?>
                      <option >choose where to move</option>
                      <option>Accountant</option>
                      <option>Complete</option>
                    <?php }else{ ?>
                      <option >choose where to move</option>
                      <option>Complete</option>
                    <?php } ?>
                </select>
              </td>
              <td>
                <a href="javascript:void(0);" title="View more & edit" onclick="view_more_employee_leave(<?= $row->benefit_id; ?>)"><span class="bi bi-eye"></span></a> || 
                  <a href="javascript:void(0);" title="delete employee leave " onclick="delete_employee_leave(<?= $row->benefit_id; ?>)"><span class="bi bi-trash"></span></a>
              </td>
            </tr>
        <?php $count++; } ?>
        </tbody>
        </table>
      </div>
    <!-- End of displaying data table -->
  </div>