<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header("Location: home");
    }
    require('config/head.php');
    echo '<title>Forgot</title>';
    if(isset($_GET['recovery'])){
        $token = $_GET['recovery'];
?>

<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card card-login">
            <div class="card-header text-center">
                <h1>Recovery</h1>
            </div>
            <div class="card-body">
                
                <?php 
                echo '</br>';
                    $query = mysqli_query($conn, "SELECT * FROM forgottoken WHERE token='$token'");
                    if(mysqli_num_rows($query)>0){
                        $datatoken = mysqli_fetch_assoc($query);
                        $timetoken = strtotime($datatoken['date']);
                        $currenttime = time()-(60*5);
                        if($currenttime <= $timetoken){
                            ?>
                
                <form>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                        </div>
                        <input id="forgot-recovery" name="password" type="password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="invalid-login text-warning text-center font-weight-bold">
                    </div>
                    <div class="form-group">
                        <div id="forgot-recovery-err" class="d-none alert alert-danger">Error</div>
                        <button onclick="recovery(<?=$datatoken['uid']?>)" type="button" class="btn float-right login_btn">Save</button>
                    </div>
                    
                </form>
                
                            <?php
                        }else{
                            ?>
                <div class="alert alert-danger">Token hết thời gian. Vui lòng thử lại!</div>
                            <?php
                        }
                        
                    }else{
                        echo "<div class='alert alert-danger text-center'>Không tồn tại token. Vui lòng kiểm tra lại</div>";
                    }
                        
                ?>
                
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    You remember an account?<a href="login">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php }else{ ?>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card card-login">
            <div class="card-header text-center">
                <h1>Forgot Password</h1>
            </div>
            <div class="card-body">
                <form>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                        </div>
                        <input id="email-forgot" name="username" type="text" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="invalid-login text-warning text-center font-weight-bold">
                    </div>
                    <div class="form-group">
                        <input id="btn-forgot" type="button" value="Send an email" class="btn float-right login_btn">
                        <span id="forgot-loading" class="d-none mr-4 spinner-border text-info float-right" role="status"></span>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    You remember an account?<a href="login">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>



    <?php } require('config/end.php'); ?>


<!-- Modal -->
<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="forgotModalLabel"><span class="spinner-border text-info" role="status"></span> Send Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Please check your email to rescovery.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="recoveryModal" tabindex="-1" role="dialog" aria-labelledby="recoveryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="recoveryModalLabel"><span class="spinner-border text-info" role="status"></span> Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Please login again with new password!
      </div>
      <div class="modal-footer">
          <form action="<?=$home?>/login">
              <button type="submit" class="btn btn-success">Login</button>
          </form>
        
      </div>
    </div>
  </div>
</div>

