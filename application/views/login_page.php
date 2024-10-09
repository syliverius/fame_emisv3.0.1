<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--meta name="color-scheme" content="dark"  //not working recommend for dark mode from twitter-//figured out that it needs css and javascript to work perfectly--> 
	<title>EMIS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/boostrap/css/bootstrap.min.css'); ?>">
  <!--inject css code -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/header.png'); ?>">
</head>

<body>
 <!--here is our login form -->
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
              <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                  <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                      <div class="brand-logo">
                        <img src="<?php echo base_url('assets/images/index.png'); ?>" alt="logo">
                      </div>
                      <h4>Hello! let's get started</h4>
                      <h6 class="font-weight-light">Sign in to continue.</h6>
                      <form class="pt-3" method="post" action="<?php echo base_url('auth/user_Login'); ?>">
          
                      <hr />
                       <?php echo $this->session->flashdata('message'); ?>
                        <div class="form-group">
                          <label for="username">User Name</label>
                          <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" autofocus>
                          <span class="text-danger"> <?php echo form_error('username'); ?></span>
                        </div>

                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" >
                          <span class="text-danger"> <?php echo form_error('password'); ?></span>
                        </div>

                        <div class="mt-3">
                          <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="login_btn" name="login_btn">  SIGN IN </button>
                        </div>
                        <div class="my-2 d-flex justify-content-between align-items-center">
                          <div class="form-check">
                            <label class="form-check-label text-muted">
                              <input type="checkbox" class="form-check-input">
                              Keep me signed in
                            </label>
                          </div>
                          <a href="#" class="auth-link text-black">Forgot password?</a>
                        </div>
                        <div class="text-center mt-4 font-weight-light">
                          Don't have an account? <a href="<?php echo base_url('auth/registration'); ?>" class="text-primary">Create</a>
                        </div>
                        <!-- declaration of session to output error incase username/password is incorrect --> 
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
          </div>
  <!-- Remember jquery must preside boostrap for boostrap depend on jquery -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/boostrap/js/bootstrap.min.js'); ?>"></script>
</body>
</html>