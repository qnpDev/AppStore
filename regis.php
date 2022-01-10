<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header("Location: home");
    }
    require('config/head.php');
    echo '<title>Registration</title>';
?>
<!--modal -->
<div class="modal regis-success" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center text-success">Regis Success</h4>
      </div>
      <div class="modal-body text-center">
          Hi <span class="regis-user text-primary font-weight-bold">admin</span>,<br>
          Remember your Username and Password.
          You are directed to login page.
      </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card card-login">
            <div class="card-header text-center">
                <h1>Registration</h1>
            </div>
            <div class="card-body">
                <form>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                        </div>
                        <input id="usernameregis" name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        </div>
                        <input id="emailregis" name="password" type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                        </div>
                        <input id="passwordregis" name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="invalid-login text-warning text-center font-weight-bold">
                    </div>
                    <div class="form-group">
                        <input id="btnregis" type="button" value="Sign up" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Have an account?<a href="login">Sign In</a>
                </div>
                <div class="d-flex justify-content-center links">
                    <a href="forgot">Forgot your password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('config/end.php'); ?>