<main id="main" class="main">

    <div class="pagetitle">
      <h1>Patient Registration</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">malnutrition/Home</a></li>
          <li class="breadcrumb-item">Patient Registration</li>
          <!-- <li class="breadcrumb-item active">Profile</li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
       

        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs d-flex">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#patient_registration">New Patient Registration</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#patient_visit">Create/View Patient Visit</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#next_visit">Upcoming appointment/f-up</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active patient_registration" id="patient_registration">
                  
                  <!--register new patient -->
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Patient Registration</h4>
                        <form class="row g-3" id="Registration" method="post">
                          <!--form success/error sms --> 
                          <div id="response_message"></div>     
                          <div class="col-md-6">
                            <label for="names">Patient Name</label>
                            <input type="text" class="form-control" name="names">
                          </div>
                          <div class="col-md-6">
                            <label for="file_number">File Number</label>
                            <input type="text" class="form-control" name="file_number">
                          </div>
                          <div class="col-md-6">
                            <label for="address">Adress</label>
                            <input type="text" class="form-control" name="address">
                          </div>
                          <div class="col-md-6">
                            <label for="best_contact">Best Contact Person</label>
                            <select class="form-control" id="best_contact" name="best_contact">
                                <option>Mother</option>
                                <option>Father</option>
                                <option>Auncle</option>
                                <option>Aunt</option>
                                <option>Sister</option>
                                <option>Brother</option>
                                <option>Grand Mother</option>
                                <option>Other Relatives</option>
                              </select>
                          </div>
                          <div class="col-md-6">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number">
                          </div>
                          <div class="col-md-6">
                            <label for="phone_number_two">Alternative Phone Number</label>
                            <input type="text" class="form-control" name="phone_number_two">
                          </div>
                          <div class="col-md-6">
                            <label for="sex">Sex</label>
                            <select class="form-control" name="sex" id="sex">
                              <option>Male</option>
                              <option>Female</option>
                            </select> 
                          </div>
                          <div class="col-md-6">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" id="dob">
                          </div>
                          <div class="col-md-6">
                            <label for="dob">Other Comments If Any</label>
                            <textarea class="form-control" id="comments" name="comments" rows="2" id="comments"></textarea>
                          </div>

                          <div class="text-center">
                              <button type="submit" class="btn btn-primary" id="Registration" name="registration">Submit</button>
                              <button class="btn btn-danger" type="reset">Cancel</button>
                          </div>
                        </form>
                       <!--end of create roaster form-->
                    </div>
                  </div>
                </div>
                  
                <div class="tab-pane fade next_visit pt-3" id="next_visit">
                  <!-- next visit appointment -->
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">Patient Informations  Regarding their upcoming visit</div>
                      <table class="table table-stripped">
                        <thead>
                          <tr>
                            <th scope="col" class="col-sm-2">Full Name</th>
                            <th scope="col">File#</th>
                            <th scope="col">Address</th>
                            <th scope="col">Best Contact Person</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Age</th>
                            <th scope="col">Remaining days before next visit</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          <!-- append retrieved data from the database -->
                          <?php 
                            foreach ($values as $row){
                              $dob = new DateTime($row['dob']);
                              $date2 = new DateTime();
                              $age_diff = date_diff($dob, $date2);
                              $years = $age_diff->y;
                              $months = $age_diff->m;
                              $today_year = date('Y');
                              $today_month = date('m');
                              $today_day = date('d');
                              $next_visit_year = date('Y', strtotime($row['next_vist']));
                              $next_visit_month = date('m', strtotime($row['next_vist']));
                              $next_visit_day = date('d', strtotime($row['next_vist']));

                              if($row['next_vist'] != "0000-00-00" && $today_day<=$next_visit_day && $next_visit_month>=$today_month || $next_visit_year>$today_year){
                                $date1 = date_create("".$row['next_vist']."");
                                $diff = date_diff($date2, $date1);
                                $days_left = $diff->days;
                              ?>
                              <tr>
                                <td><?= $row['names']; ?></td>
                                <td><?= $row['file_number']; ?></td>
                                <td><?= $row['address']; ?></td>
                                <td><?= $row['best_contact']; ?></td>
                                <td><?= $row['phone']; ?></td>
                                <td><?= $row['gender']; ?></td>
                                <td><?= $years; ?>yrs,<?= $months; ?>months</td>
                                <?php
                                    if ($days_left <=10) {
                                      echo "<td><center><span class='badge bg-warning text-dark'><i class='bi bi-exclamation-triangle me-1'></i> $days_left</span></center></td>";
                                    }else{
                                      echo "<td><center>$days_left</center></td>";
                                    }
                                ?>  
                              </tr>
                            <?php
                          }else{
                            //we'll display nothing in here
                            } }?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th scope="col" class="col-sm-2">Full Name</th>
                            <th scope="col">File#</th>
                            <th scope="col">Address</th>
                            <th scope="col">Best Contact Person</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Age</th>
                            <th scope="col">Remaining days before next visit</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <!-- End create patient visit -->
                </div>

                <div class="tab-pane fade patient_visit pt-3" id="patient_visit">
                  <!-- patient_visit -->
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">Create/View Patient Visit</div>
                        <form class="row g-3" id="visit_form" name="visit_form" method="post">
                          <!--form success/error sms --> 
                          <div id="visit_response_message"></div>
                          <div class="col-md-6">
                            <input type="text" class="typeahead form-control" name="patient_names" placeholder="search patient name"autofocus>
                          </div>
                          <div class="col-md-3">
                           <button type="submit" class="btn btn-primary" id="search_patient" name="search_patient">Seach </button>
                          </div>
                        </form>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">Patient Informations</div>
                      <table class="table table-stripped">
                        <thead>
                          <tr>
                            <th scope="col" class="col-sm-2">Full Name</th>
                            <th scope="col">File#</th>
                            <th scope="col">Address</th>
                            <th scope="col">Best Contact Person</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Dob</th>
                            <th scope="col">Age</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Visit</th>
                          </tr>
                        </thead>
                        <tbody id="patient_information" class="tbody">
                          <!-- append retrieved data from the database -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- End create patient visit -->
                </div>

                </div>
              </div><!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>

      <!--create visit modal-->
      <div class="modal fade" id="create_visit_modal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create patient Visit</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <form class="form-sample" method="post" action="malnutrition/home/create_patient_visit">
              <div class="modal-body" id="create_visit_body">
                <!-- modal data will be presented here from ajax -->
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--end of create visit model -->

      <!-- start of previous visit model previous_visit_modal-->
      <div class="modal fade" id="previous_visit_modal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div id="previous_visit_data">
                <!-- modal data will be presented here from ajax -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!--ajax codes for auto suggestion -->
  <script type="text/javascript">

    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get('<?php echo base_url('malnutrition/home/patient_Names_AutoSuggestion'); ?>', { query: query }, function (response) {
                console.log(response);
                response  = $.parseJSON(response);
                return process(response);
            });
        }
    });
</script>
<!--End of auto-suggestion code -->