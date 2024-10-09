<?php $this->load->helper('attendance_helper'); ?>
<div class="card">
  <div class="card-body">
    <?php 
    $week = $weekInfo['week'];
    $dates = getStartAndEndWeekDate($week); 
    ?>
    <div class="card-title"><?= $this->hr->get_Department_Details($weekInfo['department_id'])->department_name; ?> Attendance Report from Monday:<?= $dates['start_date']; ?> to Sunday:<?= $dates['end_date']; ?></div>
    <?php
      if($weekInfo['employeeAttendanceInfo']->num_rows()>0){ ?>
        <table class="table table-bordered border-primary">
          <thead class="text-center">
            <th colspan="3">Names</th>
            <th colspan="1">Day</th>
            <th colspan="1">Sign-in Time</th>
            <th colspan="1">Sign-out Time</th>
            <th colspan="1">Total hours</th>
            <th colspan="1">Reasons</th>
          </thead>
      <?php 
        $departmentMembers = $this->attendance->getDepartmentMembers($weekInfo['department_id']);
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        foreach($departmentMembers as $members){ 
          foreach ($days as $day){ ?>
            <tr>
              <?php 
                if ($day === 'Monday'){ ?>
                  <td colspan="3" rowspan='7'><?= $members->names; ?></td>
                <?php } ?>
                <?php $date = getDateOfDay($day,$week); ?>
                  <td><?= $day." ,".$date->format('d'); ?></td>
                  <!-- Then we add other tables attributes -->
                  <td class="text-center"><?= $signintime = convertsIntoMinutes(getSignInTime($day,$week,$members->employee_id)); ?></td>
                  <td class="text-center"><?= $signouttime = convertsIntoMinutes(getSignOutTime($day,$week,$members->employee_id,$signintime)); ?></td>
                  <td class="text-center"><?= timeDifference($signintime,$signouttime); ?></td>
                  <?php 
                    if($signintime == "" && $signouttime == ""){ ?>
                      <!-- put the function below here, state the reason below, also state the shift on else -->
                      <td class="text-center"><?= checkabsentreasons($members->employee_id,$date->format('Y-m-d')); ?></td>
                    <?php }else{ ?>
                      <td class="text-center"><?= get_shift_name($members->employee_id,$date->format('Y-m-d'))?></td>
                    <?php } ?>
                </tr>
              <?php } } ?>
      </table>
      <?php }else{ ?>
        <tr><td colspan="5"><div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Sorry!! </strong> The Attendance Report of from Monday:<?= $dates['start_date']; ?> to Sunday:<?= $dates['end_date']; ?> not available <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>
     <?php } ?>
        
  </div>
</div>