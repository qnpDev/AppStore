<?php
if(!isset($_SESSION)) session_start(); 
require_once 'core.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

echo'<?xml version="1.0" encoding="utf-8"?>'.
"\n" . '<meta http-equiv="content-language" content="vi">'.
"\n" . '<meta http-equiv="X-UA-Compatible" content="IE=edge"/>'.
"\n" . '<meta name="viewport" content="width=device-width, initial-scale=1.0">'.
"\n" . '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>'.
"\n" . '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>'.
"\n" . '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>'.
"\n" . '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>'.
"\n" . '<link rel="shortcut icon" href="'.$homefavi.'"/>'.
        
"\n" . '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>'.
"\n" . '<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"rel="stylesheet"/>'.
        
"\n" . '<link rel="stylesheet" href="'.$home.'/style.css" type="text/css" />'.
"\n" . '<script src="'.$home.'/main.js"></script>'.
"\n" . '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>';

if(isset($_SESSION['user'])){ 
    $user = $_SESSION['user'];
    $uid = $dataUser['id'];
    $umoney = number_format($dataUser['money']);
    $avatar = ($dataUser['avatar'] >= 1) ? $home . '/img/avatar/' . $dataUser['id'] .'-'.$dataUser['avatar']. '.png' : $home . '/img/avatar-default-icon.png';
    
    if(!isset($_SESSION['download_file'])){
        $_SESSION['download_file'] = array();
    }
}   
?>
<!--modal search-->
<div id="modal-search" class="modal fade search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" id="message-search" type="text" autocomplete="off" placeholder="Search.."/>
                    <table class="table mt-3" id="result-search"></table>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!--Top nav-->
<div class="top navbar-fixed-top">
    <div class="top-nav"> 
        <div class="row"> 
            <div class="col-6 col-sm-4 d-flex justify-content-start"> 
                <button id="sidebarCollapse" type="button">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
            </div>
            <div id="logo-head" class="col-sm-4 d-flex"> 
                <div  class="d-flex justify-content-center">
                    <a class="text-decoration-none m-auto" href="<?=$home?>">
                        <img class="nav-icon" src="<?=$homeicon?>"/>
                        <span class="nav-name font-weight-bold"> <?=$namepage?></span>
                    </a>
                </div>
            </div>
            <div class="btnsearch col-6 col-sm-4 d-flex justify-content-end"> 
                <button id="search" type="button"  data-toggle="modal" data-target="#modal-search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>      
            </div>
        </div>
    </div>
</div>
<!--End Top nav-->

    <!-- Left nav -->
    <div class="vertical-nav bg-white shadow" id="sidebar">
        <?php if(isset($user)){
            $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE username = '$user'"));
            ?>
            <div class="py-3 px-3 mb-4 bg-light">
                <div class="media d-flex align-items-center"><img src="<?=$avatar?>"
                    alt="avatar" width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                    <div class="media-body">
                        <h4 class="m-0"><?=($data['name']!="") ? $data['name'] : $data['username']?></h4>
                        <p class="font-weight-light text-muted mb-0"><?=$per?>
                            <i class="fa fa-money text-success font-weight-bold" aria-hidden="true"></i>
                            <span class="text-primary"><?= $umoney ?> </span>đ
                        </p>
                    </div>
                </div>
            </div>
            <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>
            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="<?=$home?>" class="nav-link text-dark font-italic">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/profile" class="nav-link text-dark font-italic">
                        <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/user/naptien" class="nav-link text-dark font-italic">
                        <i class="fa fa-credit-card mr-3 text-primary fa-fw"></i>
                        Nạp tiền
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/logout" class="nav-link text-dark font-italic">
                        <i class="fa fa-sign-out mr-3 text-primary fa-fw" aria-hidden="true"></i>
                        Sign Out
                    </a>
                </li>
            </ul>
            
            <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">MENU</p>
            <ul class="nav flex-column bg-white mb-5">
                <li class="nav-item">
                    <a href="<?=$home?>/user/bought" class="nav-link text-dark font-italic">
                        <i class="fa fa-cart-plus mr-3 text-primary fa-fw"></i>
                        Apps Bought
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/app/freeapp" class="nav-link text-dark font-italic">
                        <i class="fa fa-pagelines mr-3 text-primary fa-fw"></i>
                        Free App
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/app/paidapp" class="nav-link text-dark font-italic">
                        <i class="fa fa-money mr-3 text-primary fa-fw"></i>
                        Paid App
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/app/all" class="nav-link text-dark font-italic">
                        <i class="fa fa-rocket mr-3 text-primary fa-fw"></i>
                        All App
                    </a>
                </li>
                <?php if($permission == 2){ ?> 
                <li class="nav-item">
                    <a href="<?=$home?>/admin" class="nav-link text-danger font-italic font-weight-bold">
                        <i class="fa fa-cogs mr-3 text-primary fa-fw" aria-hidden="true"></i>
                        Admin Tools
                    </a>
                </li>
                <?php
                    }
                    if($permission > 0){
                ?>
                <li class="nav-item">
                    <a href="<?=$home?>/dev" class="nav-link text-dark font-italic">
                        <i class="fa fa-pie-chart mr-3 text-primary fa-fw"></i>
                        <span class="text-primary font-weight-bold">DEV Tools</span>
                    </a>
                </li>
                <?php } ?>
            </ul>

        <?php }else{ ?>
            <div class="py-4 px-3 mb-4 bg-light">
                <div class="media d-flex align-items-center"><img src="<?=$homeicon?>"
                    alt="avatar" width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                    <div class="media-body">
                        <h4 class="m-0">Hello,</h4>
                        <p class="font-weight-light text-muted mb-0">Your Welcome!</p>
                    </div>
                </div>
            </div>
            <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>
            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="<?=$home?>" class="nav-link text-dark font-italic">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/login" class="nav-link text-dark font-italic">
                        <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                        Sign In
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/regis" class="nav-link text-dark font-italic">
                        <i class="fa fa-plus-square mr-3 text-primary fa-fw"></i>
                        Sign Up
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/forgot" class="nav-link text-dark font-italic">
                        <i class="fa fa-key mr-3 text-primary fa-fw"></i>
                        Forgot Password
                    </a>
                </li>
            </ul>
            <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">MENU</p>
            <ul class="nav flex-column bg-white mb-5">
                <li class="nav-item">
                    <a href="<?=$home?>/app/freeapp" class="nav-link text-dark font-italic">
                        <i class="fa fa-pagelines mr-3 text-primary fa-fw"></i>
                        Free App
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/app/paidapp" class="nav-link text-dark font-italic">
                        <i class="fa fa-money mr-3 text-primary fa-fw"></i>
                        Paid App
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=$home?>/app/all" class="nav-link text-dark font-italic">
                        <i class="fa fa-cogs mr-3 text-primary fa-fw" aria-hidden="true"></i>
                        All App
                    </a>
                </li>
            </ul>
        <?php } ?>
            
    </div>
    
    <!-- End left nav -->
    <!-- Page content -->
<div class="page-content p-3 main mobile-content" id="main-content">
    <div class="container-fluid">