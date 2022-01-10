<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: home");
    }
    require('config/head.php');
    echo '<title>Logout</title>';
    session_destroy();
?>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card card-login">
            <div class="card-header text-center">
                <h4>Đăng xuất thành công</h4>
            </div>
            <div class="card-body text-white">
                <p>Tài khoản của bạn đã được đăng xuất khỏi hệ thống.</p>
                <p>Nhấn vào nút bên dưới để trở về trang chủ, hoặc trang web sẽ tự động chuyển hướng sau <span id="time-countdown-logout" class="text-danger">3</span> giây nữa.</p>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <button onclick="location.href='home'" class="btn btn-success px-5">Home</button>
            </div>
        </div>
    </div>
</div>
<script>logout();</script>
<?php require('config/end.php'); ?>
