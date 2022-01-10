<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header("Location: home");
    }
    require('config/head.php');
    echo '<title>Login</title>';
?>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card card-login">
            <div class="card-header text-center">
                <h1>Sign In</h1>
            </div>
            <div class="card-body">
                <form>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                        </div>
                        <input id="usernamelogin" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                        </div>
                        <input id="passwordlogin" name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="row align-items-center remember">
                        <input checked id="rememberlogin" type="checkbox">
                        <label for="rememberlogin">Remember Me</label>
                    </div>
                    <div class="invalid-login text-warning text-center font-weight-bold">
                    </div>
                    <div class="form-group">
                        <input id="btnlogin" type="button" value="Login" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Don't have an account?<a href="regis.php">Sign Up</a>
                </div>
                <div class="d-flex justify-content-center links">
                    <a href="forgot.php">Forgot your password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('config/end.php'); ?>
<!--modal -->
<div class="modal fade login-success" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center text-success">Login Success</h4>
      </div>
      <div class="modal-body text-center">
        You are directed to home.
      </div>
    </div>
  </div>
</div>
