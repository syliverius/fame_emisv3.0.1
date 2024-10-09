<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
  <title>Registration</title>

  <!--script and css for auto-suggestion and ajax-->
  <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"-->
  <script src="<?= base_url() ?>assets/js/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="<?= base_url() ?>assets/js/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 
  <!--End of ajax -->

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/favicon.png'); ?>">

</head>
<body>

  <!-- Registration form goes here -->
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text- ` py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?php echo base_url('assets/images/index.png'); ?>" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" method="post" action="<?php echo base_url('auth/creating_New_User_Account')?>">

                  <?php echo $this->session->flashdata('message'); ?>

                  <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="typeahead form-control form-control-lg text-monospace " name="full_name" placeholder="Employee full name " value="<?php echo set_value('full_name'); ?>" autofocus/>
                    <span class="text-danger"><?php echo form_error('full_name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="email">User Name</label>
                    <input type="text" class="form-control form-control-lg text-monospace" name="username" id="username" placeholder="Username" value="<?php echo set_value('username'); ?>" />
                    <span class="text-danger"><?php echo form_error('username'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="password" />
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="re_password">Confirm Password</label>
                    <input type="password" class="form-control form-control-lg" name="re_password" placeholder="Re-type your password" />
                    <span class="text-danger"><?php echo form_error('re_password'); ?></span>
                  </div>

                  <div class="mb-4">
                    <p class=""><u>By submitting it means you agree to all our Terms & Conditions</u></p>
                  </div>

                  <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="registerbtn"> SUBMIT </button>
                  </div>

                  <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="<?php echo base_url('auth/');?>" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!--The end of registration form -->

  <!--ajax codes for auto suggestion -->
  <script type="text/javascript">
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get('<?php echo base_url('auth/user_AutoSuggestion_List'); ?>', { query: query }, function (response) {
                console.log(response);
                response  = $.parseJSON(response);
                return process(response);
            });
        }
    });
</script>
<!--End of auto-suggestion code -->

</body>
</html>