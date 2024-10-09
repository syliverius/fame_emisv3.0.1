<?php $this->load->helper('dashboard_helper'); ?>
<div class="card-body">
  <h5 class="card-title">The employees expected to be present at work <?= $day; ?> as per the roster</span></h5>
    <table class="table table-borderless datatable text-center">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Department Name</th>
          <th scope="col"># of Employees</th>
          <th scope="col">Department %</th>
          <th scope="col">View</th>
        </tr>
      </thead>
      <?php $departments = $this->hr->getDepartments(); ?>
      <tbody >
        <?php 
          $count = 1;
          foreach($departments as $department){ ?>
          <tr>
            <th scope="row"><?= $count; ?></th>
            <td><?= $department->department_name; ?></td>
            <?php 
              $shifts = $this->dashboard->return_present_employee($department->department_id,$date); 
              echo check_returned_shifts($shifts,$department->department_id);
            ?>
            <td><button type="button" class="btn btn-secondary" onclick="showPresentEmployee(<?php echo htmlspecialchars(json_encode($shifts)); ?>, <?= $department->department_id; ?>)"><i class="bi bi-eye"></i></button>
            </td>
          </tr>
        <?php $count++; } ?>
      </tbody>
    </table>
</div>