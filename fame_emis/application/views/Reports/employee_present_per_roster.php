<div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" onclick="display_roster('yesterday')">Yesterday</a></li>
                    <li><a class="dropdown-item" onclick="display_roster('today')">Today</a></li>
                    <li><a class="dropdown-item" onclick="display_roster('tommorow')">Tommorow</a></li>
                  </ul>
                </div>
                <div id="roster_members_body">
                  <div class="card-body">
                    <h5 class="card-title">The employees expected to be present at work today as per the roster</span></h5>
                    <table class="table table-borderless datatable">
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
                      <tbody>
                        <?php 
                         $count = 1;
                          foreach($departments as $department){ ?>
                          <tr>
                            <th scope="row"><?= $count; ?></th>
                            <td><?= $department->department_name; ?></td>
                            <?php 
                            $shifts = $this->dashboard->return_present_employee($department->department_id,date('Y-m-d')); 
                             echo check_returned_shifts($shifts,$department->department_id);
                            ?>
                            <td><button type="button" class="btn btn-secondary" onclick="showPresentEmployee(<?php echo htmlspecialchars(json_encode($shifts)); ?>, <?= $department->department_id; ?>)"><i class="bi bi-eye"></i></button>
                            </td>
                          </tr>
                          <?php $count++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>