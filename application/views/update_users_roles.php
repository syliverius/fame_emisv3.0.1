<div class="box box-default">
    <div class="box-header">
	<h4 class="modal-title">Edit User Informations </h4>
       <a href="" class="pull-right" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
        <!--<h4>Update Employee</h4>-->
    </div>
    <div class="card">
        <div class="card-body pt-3">
			<ul class="nav nav-tabs d-flex">

                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#bd">Change Group Type</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#perms">Permissions</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#pasw">Password</a>
                </li>
              </ul>
            <div class="tab-content" style="overflow-y: hidden">
                <div class="tab-pane active" id="bd">
                    <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Choose Group Type</h4>
                      <form method="post" id="group_change_form" class="row g-3">
                        <div id="group_change_response"></div>
                          <div class="row mb-3">
                            <label for="input_file" class="col-sm-2 col-form-label">Groups</label>
                            <input type="text" name="employee_id" value="<?= $user_id; ?>" hidden >
                             <div class="col-sm-6">

                                <!-- we can select the current group -->

                               <select class="form-control"  name="selected_group">
                                <?php 
                                    foreach($groups as $group){
                                        if($group->user_group_id == $priv_id){ ?>
                                            <option selected><?= $group->group_name; ?></option>
                                        <?php }else{ ?>
                                            <option><?= $group->group_name; ?></option>
                                <?php } } ?>
                              </select>
                             </div>
                              <div class="col-sm-2">
                                <button type="button" class="btn btn-primary" onclick="group_change_function()">Change</button>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
				
                <div class="tab-pane" id="perms">
				<div class="row">
                    <div class="col-md-6">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <i class="fa fa-plus"></i>
                                <h4 class="box-title">Unussigned Modules</h4>
                            </div>
                            <div class="box-body" style="max-height: 450px;overflow-x: hidden" id="unPermssn"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <i class="fa fa-minus"></i>
                                <h4 class="box-title">Special Modules assigned</h4>
                            </div>
                            <div class="box-body" style="max-height: 450px;overflow-x: hidden" id="speclPermssn">

                            </div>
                        </div>
                    <hr style="color:blue;border-bottom:1px solid blue;">
                        <div class="box box-danger" style="border-top:3px solid red;">
                             <div class="box-header with-border" style="border-bottom:1px solid lightblue;border-top:1px solid lightblue;">
                                <i class="fa fa-minus"></i>
                                <h4 class="box-title">Modules assigned</h4>
                            </div>
                            <div class="box-body" style="max-height: 450px;overflow-x: hidden">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Module name</th>
                                        <th>Descriptions</th>
                                    </tr>
                                    <?php
                                    $m = 0;
                                    foreach ($setting as $prev):
                                        $m++;
										
                                        ?>
                                        <tr class="trow" style="height: 25px">
                                            <td><center><?php echo $m; ?></center></td>
                                        <td><?php echo $prev->label; ?></td>
                                        <td><?php echo $prev->description; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
				
				
                </div>
                <div class="tab-pane" id="pasw">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User Password Reset</h4>
                            <div id="error_message"></div>
                            <form method="post" id="password_change_form" class="row g-3">
                                <input type="text" name="employee_id" value="<?= $user_id; ?>" hidden >

                                <label for="username" class="col-sm-3 col-form-label">User Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" id="username" value="<?= $this->admin->getUsername($user_id)->user_name; ?>" class="form-control">  
                                </div>

                                <label for="password" class="col-sm-3 col-form-label">New password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>

                                <label for="re_password" class="col-sm-3 col-form-label">Re-type password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password2" id="password2" class="form-control">
                                </div>

                                <center>
                                  <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary" onclick="password_change()">Change</button>
                                  </div>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>

    loadSpecialPermission();

    function loadSpecialPermission() {
        $('#unPermssn').load('<?php echo base_url() . 'admin_dashboard/unassgnd_permissions/' . $user_id . '/' . $priv_id; ?>');
        $('#speclPermssn').load('<?php echo base_url() . 'admin_dashboard/load_special_permissions/' . $user_id; ?>');
    }

    function AssgnSpecialModule(modId) {
        var perdata = "modl=" + modId + "&user=<?php echo $user_id; ?>";
        $.ajax({
            data: perdata,
            url: '<?php echo base_url() . 'admin_dashboard/add_special_permissions'; ?>',
            type: 'POST',
            success: function (rs) {
                loadSpecialPermission();
            },
            error: function () {
                alert('Sorry! Something went wrong');
            }
        });
    }

    function UnassgnSpecialModule(modId) {
        var perdata = "modl=" + modId + "&user=<?php echo $user_id; ?>";
        $.ajax({
            data: perdata,
            url: '<?php echo base_url() . 'admin_dashboard/remove_special_permissions'; ?>',
            type: 'POST',
            success: function (rs) {
                loadSpecialPermission();
            },
            error: function () {
                alert('Sorry! Something went wrong');
            }
        });
    }


//here is the function to change user group 
    function group_change_function(){

        var data = $('#group_change_form').serialize(); 

        $.ajax({
        method : 'post',
        url : '<?= base_url() ?>admin_dashboard/change_user_group',
        data : data,
        dataType : 'html',
        success : function(response){
            if(window.confirm('The group changed successful now tell the user to re-login again for changes to take place')){
                window.location.href = '<?= base_url().'admin_dashboard'; ?>';
            }
        },
        error : function(){
            if (window.confirm('failed to change user group')) {
                window.location.href = '<?= base_url().'admin_dashboard'; ?>';
            }
        }
       });
    }

function password_change() {
    var data = $('#password_change_form').serialize(); 
    var password1 = document.getElementById('password').value;
    var password2 = document.getElementById('password2').value;
    var username = document.getElementById('username').value;

    if ( !username || !password1 || !password2 || password1 !== password2) {
        // Show an error message on the HTML page indicating password mismatch
        $('#error_message').html("<div class='alert alert-danger alert-dismissible fade show' role='alert'> Password did not match/empty username. Try again.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div><br />");
    } else {
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>admin_dashboard/change_user_password',
            data: data,
            dataType: 'html',
            success: function (response) {
                if (window.confirm('The password changed successfully. Please ask the user to re-login for changes to take effect.')) {
                    window.location.href = '<?= base_url().'admin_dashboard'; ?>';
                }
            },
            error: function () {
                if (window.confirm('Failed to change password')) {
                    window.location.href = '<?= base_url().'admin_dashboard'; ?>';
                }
            }
        });
    }
}



</script>
