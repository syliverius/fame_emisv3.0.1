<div class="col-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <h5 class="card-title">This section provides a comprehensive summary for both emergency and annual leave</span></h5>
      <table class="table table-bordered border-primary">
        <!-- <thead> -->
        <tr class="text-center"> 
          <th colspan="2"># of employees on annual leave</th>
          <th colspan="2"># of employee expected to go on annual leave(in next 7days)</th>
          <th colspan="2"># of employee expected to be coming from annual leave(in next 7days)</th>
          <th colspan="2"># of employees on emergency leave</th>
        </tr>
        <!-- end of thead -->

        <tr class="text-center"> 
          <?php 

             $annual_leave = $this->dashboard->get_employee_on_annual_leave();
             $expected_annual_leave = $this->dashboard->get_expected_annual_leave(get_7_day_date());
             $expected_coming_annual_leave = $this->dashboard->get_coming_annual_leave(get_7_day_date());
             $emergency_leaves = $this->dashboard->get_employee_on_emergency_leave(); 
          ?>
          <td colspan="2"><h4><i class="bi bi-people"></i> <span class="badge rounded-pill bg-info text-dark">  <?= count($annual_leave); ?></span>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary" onclick="show_annual_leave_members(<?php  echo htmlspecialchars(json_encode($annual_leave)); ?>)"><i class="bi bi-eye"></i></button></h4>
          </td>

          <td colspan="2"><h4><i class="bi bi-people"></i> <span class="badge rounded-pill bg-info text-dark">  <?= count($expected_annual_leave); ?></span>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary" onclick="get_expected_annual_leave(<?php echo htmlspecialchars(json_encode($expected_annual_leave)); ?>)"><i class="bi bi-eye"></i></button></h4></td>

          <td colspan="2"><h4><i class="bi bi-people"></i> <span class="badge rounded-pill bg-info text-dark">  <?= count($expected_coming_annual_leave); ?></span>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary" onclick="get_returning_from_annual_leave(<?php echo htmlspecialchars(json_encode($expected_coming_annual_leave)); ?>)"><i class="bi bi-eye"></i></button></h4>
          </td>

          <td colspan="2"><h4><i class="bi bi-people"></i> <span class="badge rounded-pill bg-info text-dark">  <?= count($emergency_leaves); ?></span>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary" onclick="get_employees_on_emergency_leave(<?php echo htmlspecialchars(json_encode($emergency_leaves)); ?>)"><i class="bi bi-eye"></i></button></h4></td>
        </tr>
      </table>
    </div>
  </div>
</div>

<!-- on employees on annual leave we'll return #,names,departments,return_date(order by return date)-->



