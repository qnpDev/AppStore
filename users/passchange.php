<?php
    session_start();
    if (!isset($_SESSION['user'])) {
       header("Location: ../home");
    }
    include('../config/head.php');
    echo '<title>Password Change</title>';
?>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card card-login">
            <div class="card-header text-center">
                <h1>Password Change</h1>
            </div>
            <div class="card-body">
                <form>
                    <div class="input-group form-group">
                        <input id="pass-change-old" type="password" class="form-control" placeholder="Old Password">
                    </div>
                    <div class="input-group form-group">
                        <input id="pass-change-new" type="password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="input-group form-group">
                        <input id="pass-change-new-again" type="password" class="form-control" placeholder="New Password again">
                    </div>
                    <div class="invalid-login text-warning text-center font-weight-bold">
                    </div>
                    <div class="form-group">
                        <button onclick="passChange(<?=$uid?>)" id="btn-pass-change" type="button" class="btn float-right login_btn">Change</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<?php require('../config/end.php'); ?>
<!--modal -->
<div class="modal login-success" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center text-success">Password Change Success</h4>
      </div>
      <div class="modal-body text-center">
        You are directed to login.
      </div>
    </div>
  </div>
</div>

    
    