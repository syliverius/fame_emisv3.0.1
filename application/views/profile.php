<?php $this->load->helper('wategemezi_option_helper'); ?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="" href="<?php echo base_url('profile_management') ?>">
        <span>Home</span>
      </a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <img src="<?php echo base_url() ?>assets/images/profile.png" alt="Profile" class="rounded-circle">
          <h2><?php echo $this->session->userdata('full_name');?></h2>
          <h3><?php echo $this->session->userdata('profession');?></h3>
        </div>
      </div>
    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li>

          </ul>

          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              
              <h5 class="card-title">Profile Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-3 label ">Full Names</div>
                <div class="col-lg-9 col-md-9"><?= $profile_info->names;?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-3 label">Department</div>
                <div class="col-lg-4 col-md-4"><?= $profile_info->department_name;?></div>
                <div class="col-lg-2 col-md-2 label">Phone</div>
                <div class="col-lg-3 col-md-3"><?= $profile_info->phone_number; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-3 label">Professional</div>
                <div class="col-lg-5 col-md-5"><?= $profile_info->professional_name;?></div>
                <div class="col-lg-2 col-md-2 label">Position</div>
                <div class="col-lg-2 col-md-2"><?= $profile_info->position;?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-3 label">Hiring Date</div>
                <div class="col-lg-4 col-md-4"><?= $profile_info->hiring_date; ?></div>
                <div class="col-lg-2 col-md-2 label">DOB</div>
                <div class="col-lg-3 col-md-3"><?= $profile_info->dob; ?></div>
              </div>

              <div class="row">
                <b><i>DEPENDENTS</i></b>
              </div>

              <table class="table table-bordered border-primary text-center">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Dependent Names</th>
                      <th>Relation</th>
                      <th>Age</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                     if($profile_info->hr_dept_update == NULL || $profile_info->hr_dept_update != "0000-00-00"){
                    for ($i = 1; $i <= 6; $i++) { ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <?php
                        $dept_relation = $profile_info->{'dept' . $i . '_relation'};
                        $dept_dob = $profile_info->{'dept' . $i . '_dob'};
                        $dept_name = $profile_info->{'dept' . $i};
                        
                        if ($dept_relation == 'Mtoto') {
                          $years = calculate_year($dept_dob);
                          if ($years >= 21) { ?>
                            <td style="color: red;"><?= $dept_name; ?></td>
                            <td style="color: red;"><?= $dept_relation; ?></td>
                            <td style="color: red;"><?= $years; ?></td>
                          <?php } else { ?>
                            <td><?= $dept_name; ?></td>
                            <td><?= $dept_relation; ?></td>
                            <td><?= $years; ?></td>
                          <?php }
                        } else { ?>
                          <td><?= $dept_name; ?></td>
                          <td><?= $dept_relation; ?></td>
                          <td><?= calculate_year($dept_dob); ?></td>
                        <?php } ?>
                      </tr>
                    <?php } }else{
                      for($i = 1; $i <= 6; $i++){ ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                     <?php } } ?>
                  </tbody>
              </table>
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
              <div id="profile_editing"></div>
              <form method="post" id="profile_edit_form">
                  <input type="text" name="employee_id" value="<?= $profile_info->employee_id; ?>" hidden>
                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="fullName" type="text" class="form-control"  value="<?= $profile_info->names;?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Department</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="Department" type="text" class="form-control" id="Department" value="<?= $profile_info->department_name;?>" readonly>
                  </div> 
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Position</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="Position" type="text" class="form-control" id="Position" value="<?= $profile_info->position;?>" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Professional</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-control" name="professional">
                      <?php 
                        foreach ($professional as $rows) {
                          if($rows->professional_name == $profile_info->professional_name){
                            echo "<option selected>$rows->professional_name</option>";
                          }else{
                            echo "<option>$rows->professional_name</option>";
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phone" type="text" class="form-control" id="Phone" placeholder="input new phone number" value="<?= $profile_info->phone_number; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="gender" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-control" name="gender">
                      <?php 
                        if($profile_info->gender == "Female"){
                          echo "<option>Male</option>";
                          echo "<option selected>Female</option>";
                        }else{
                          echo "<option selected>Male</option>";
                          echo "<option>Female</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="dob" class="col-md-4 col-lg-3 col-form-label">Dob</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="dob" type="date" class="form-control" id="dob" placeholder="Date Of Birth" value="<?= $profile_info->dob; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="hiring_date" class="col-md-4 col-lg-3 col-form-label">Hired Date</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="date" class="form-control" name="hired_date"  value="<?= $profile_info->hiring_date;?>">
                  </div>
                </div>

                <div class="text-center">
                  <button class="btn btn-primary" type="button" onclick="profile_edit()">Save Changes</button>
                </div>
              </form>
            </div>


            <div class="tab-pane fade pt-3" id="profile-change-password">
              <div id="password_changing"></div>
              <form id="change_password_form">
                <input type="text" name="employee_id" value="<?= $profile_info->employee_id;?>" hidden>
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="currentPassword" type="password" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control">
                  </div>
                </div>

                <div class="text-center">
                  <button type="button" class="btn btn-primary" onclick="change_password()">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->
            </div>

          </div><!-- End Bordered Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

<script type="text/javascript">
  
  function profile_edit(){
    var data = $("#profile_edit_form").serialize(); 

       $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>profile_management/edit_profile_information",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#profile_editing').html(response);
            }
        });

      return false;
  }

  function change_password(){
    var data = $("#change_password_form").serialize(); 

       $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>profile_management/change_user_password",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#password_changing').html(response);
            }
        });

      return false;
  }

</script>