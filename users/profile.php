<?php
    require_once '../config/head.php';
    if (isset($_GET['id'])){
        $pid = $_GET['id'];
        $query = mysqli_query($conn, "SELECT * FROM users WHeRE id='$pid'");
        if(mysqli_num_rows($query)>0){
            $data = mysqli_fetch_array($query);
        }else{
            require '../error/oops.php';
            require '../config/end.php';
            die;
        }
    }else{
        if(!isset($_SESSION['user'])){
            die;
        }
        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHeRE username='$user'"));
        $pid = $data['id'];
    }
    echo '<title>'.$data['username'].'</title>';
?>
<div class="container">
    <div class="card-box-profile">
        <div class="member-card pt-2 pb-2">
            <div class="row">
                <div class="col-sm-12 col-md-4 text-center">
                    <div class="m-auto">
                        <img src="<?= ($data['avatar'] >= 1) ? $home . '/img/avatar/' . $data['id'] .'-'.$data['avatar']. '.png' : $home . '/img/avatar-default-icon.png' ?>" class="rounded-circle img-thumbnail img-thumbnail-profile" alt="profile-image">
                        <h4><?= ($data['name'] != "") ? $data['name'] : $data['username'] ?></h4>
                        <?php echo $permission_title[$data['permission']];
                            if(isset($_SESSION['user'])){
                        ?>
                        <div class="price-item-home">
                            <i class="fa fa-money text-success font-weight-bold" aria-hidden="true"></i>
                            <span class="text-danger font-weight-bold"><?= $data['money'] ?></span>
                            <span class="currency"> đ</span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <ul class="list-group pt-3">
                        <li class="list-group-item"><b>ID:</b><span class="text-info"> <?= $data['id'] ?></span></li>
                        <li class="list-group-item"><b>Username:</b><span class="text-info"> <?= $data['username'] ?></span></li>
                        <li class="list-group-item"><b>Email:</b><span class="text-info"> <?= $data['email'] ?></span></li>
                    <li class="list-group-item"><b>SDT:</b><span class="text-info"> <?= $data['sdt'] ?></span></li>
                    <li class="list-group-item"><b>Address:</b><span class="text-info"> <?= $data['diachi'] ?></span></li>
                    </ul>
                    <?php 
                        if(isset($_SESSION['user'])){ 
                        if ($pid==$uid || $permission==2){
                    ?>
                    <div class="d-flex justify-content-end">
                        <?php if($data['permission'] < 1 && $permission!=2){ ?>
                        <a class="mr-1" href="upgrade">
                            <button class="btn btn-warning mt-3 btn-rounded waves-effect w-md waves-light text-white">Upgrade to Developer</button>
                        </a>
                        <?php } ?>
                        <a class="mr-1" href="change-pass">
                            <button class="btn btn-danger mt-3 btn-rounded waves-effect w-md waves-light">Change Pass</button>
                        </a>
                        <a href="profile-edit-<?=$pid?>">
                            <button type="submit" class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light">Edit Profile</button>
                        </a>
                    </div>
                        <?php } } ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
    require_once '../config/end.php';
?>