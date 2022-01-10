<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        echo "<script>location.href='$home/';</script>";
    }
    if (isset($_GET['id'])){
        $pid = $_GET['id'];
        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHeRE id='$pid'"));
    }else{
        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHeRE username='$user'"));
        $pid = $data['id'];
    }
    if($pid != $uid && $permission !=2){
        echo "<script>location.href='$home/profile-$pid';</script>";
    }
    echo '<title>Edit '.$data['username'].'</title>';
    if ($pid==$uid || $permission==2){
?>
<div class="container">
    <div class="card-box-profile">
        <div class="member-card pt-2 pb-2">
            <div class="row">               
                <div class="col-sm-12 col-md-4 text-center">
                    <div class="thumb-lg member-thumb m-auto">
                        <img src="<?= ($data['avatar'] >= 1) ? $home . '/img/avatar/' . $data['id'] .'-'.$data['avatar']. '.png' : $home . '/img/avatar-default-icon.png' ?>" class="rounded-circle img-thumbnail img-thumbnail-profile" alt="profile-image">
                        
                        <form class="edit-profile-avatar" action="" method="post" enctype="multipart/form-data">
                            <div class="d-flex justify-content-center">
                            <input id="edit-profile-avatar" type="file" name="edit-avatar"/>
                            </div>
                            <div class="d-flex justify-content-center text-danger">
                            <?php
                            if (isset($_POST['change'])) {
                                if ($_FILES['edit-avatar']['name'] != NULL) {
                                    // Kiểm tra file up lên có phải là ảnh không
                                    if ($_FILES['edit-avatar']['type'] == "image/jpeg" || $_FILES['edit-avatar']['type'] == "image/png" || $_FILES['edit-avatar']['type'] == "image/gif") {

                                        // Nếu là ảnh tiến hành code upload
                                        $path = "../img/avatar/"; // Ảnh sẽ lưu vào thư mục images
                                        $tmp_name = $_FILES['edit-avatar']['tmp_name'];
                                        $name = $pid;
                                        // xoa anh ton tai neu co
                                        if(($stt=$data['avatar'])>=1){
                                            $status = unlink("../img/avatar/$pid-$stt.png");
                                        }
                                        // Upload ảnh vào thư mục images
                                        $sttn = $data['avatar']+1;
                                        move_uploaded_file($tmp_name, $path . $name.'-'.$sttn.'.png');
                                        $image_url = $path . $name;
                                        // update ảnh avatar csdl
                                        
                                        $sql = mysqli_query($conn,"UPDATE users SET avatar = '$sttn' WHERE id = '$pid'");
                                        if ($sql) {
                                            echo 'Đỏi avatar thành công';
                                        } else {
                                            echo 'Không thể đỏi được ảnh';
                                        }
                                    } else {
                                        // Không phải file ảnh
                                        echo "Kiểu file không phải là ảnh";
                                    }
                                } else {
                                    echo "Bạn chưa chọn ảnh upload";
                                }
                            }
                            ?>         
                            </div>
                            <button name="change" type="submit" class="btn btn-warning mt-3 btn-rounded waves-effect w-md waves-light">Change Avatar</button>
                        </form>
                        
                        <h4><?= ($data['name'] != "") ? $data['name'] : $data['username'] ?></h4>
                        <?= $per ?>
                        <div class="price-item-home">
                            <i class="fa fa-money text-success font-weight-bold" aria-hidden="true"></i>
                            <span class="text-danger font-weight-bold"><?= $umoney ?></span>
                            <span class="currency"> đ</span>
                        </div>
                    </div>
                    </div>

                    <div class="col-sm-12 col-md-8">
                        <form action="" method="post">      
                            <ul class="list-group pt-3">
                                <li class="list-group-item"><b>ID:</b><span class="text-info"> <?= $data['id'] ?></span></li>
                                <li class="list-group-item"><b>Username:</b><span class="text-info"> <?php if ($permission == 2){ ?>
                                        <input class="input-profile-edit" name="username" type="text" value="<?= $data['username'] ?>"/>
                                <?php }else { echo $data['username']; } ?>
                                    </span></li>
                                <?php if ($permission == 2) { ?>
                                    <li class="list-group-item"><b>Role:</b><span class="text-danger">
                                            <select class="input-profile-edit" name="permission">
                                                <option value="2" <?php if ($data['permission'] == 2) { ?>selected<?php } ?>>Administrator</option>
                                                <option value="1" <?php if ($data['permission'] == 1) { ?>selected<?php } ?>>Developer</option>
                                                <option value="0" <?php if ($data['permission'] == 0) { ?>selected<?php } ?>>Member</option>
                                            </select>
                                        </span></li>
                                    <li class="list-group-item"><b>Money:</b><span class="text-danger">
                                            <input class="input-profile-edit" name="money" type="text" value="<?= $data['money'] ?>"/>
                                        </span></li>
                                <?php } ?>
                                <li class="list-group-item"><b>Name:</b><span class="text-danger">
                                        <input class="input-profile-edit" name="name" type="text" value="<?= $data['name'] ?>"/>
                                    </span></li>
                                <li class="list-group-item"><b>Email:</b><span class="text-danger">
                                        <input class="input-profile-edit" name="email" type="email" value="<?= $data['email'] ?>"/>
                                    </span></li>
                                <li class="list-group-item"><b>SDT:</b><span class="text-danger"> 
                                        <input maxlength="15" class="input-profile-edit" name="sdt" type="text" value="<?= $data['sdt'] ?>"/>
                                    </span></li>
                                <li class="list-group-item"><b>Address:</b><span class="text-danger"> 
                                        <input class="input-profile-edit" name="address" type="text" value="<?=$data['diachi']?>"/>
                                    </span></li>
                            </ul>
                            <div class="d-flex justify-content-end">
                                <input type="hidden" name="clicked"/>
                                <button id="btn-edit-profile" type="submit" class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    }
    require_once '../config/end.php';
    
    if(isset($_POST['clicked'])){

        if($permission==2){
            $query = $conn->prepare("UPDATE users SET username = ?, permission= ?, money = ?, name = ?, email = ?, sdt = ?, diachi = ? WHERE id=$pid");
            $query->bind_param('siissss',$username,$per,$money,$name,$email,$sdt,$diachi);
            
            $username = (isset($_POST['username'])) ? $_POST['username'] : '';
            $name = (isset($_POST['name'])) ? $_POST['name'] : '';
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $sdt = (isset($_POST['sdt'])) ? $_POST['sdt'] : '';
            $diachi = (isset($_POST['address'])) ? $_POST['address'] : '';
            $per = (isset($_POST['permission'])) ? $_POST['permission'] : '';
            $money = (isset($_POST['money'])) ? $_POST['money'] : 0;
            
            if($pid == $uid){
                $_SESSION['user'] = $username;
            }
            
            $query->execute();
            $query->close();
        }else{
            $query = $conn->prepare("UPDATE users SET name = ?, email = ?, sdt = ?, diachi = ? WHERE id=$pid");
            $query->bind_param('ssss',$name,$email,$sdt,$diachi);
            
            $name = (isset($_POST['name'])) ? $_POST['name'] : '';
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $sdt = (isset($_POST['sdt'])) ? $_POST['sdt'] : '';
            $diachi = (isset($_POST['address'])) ? $_POST['address'] : '';
            
            $query->execute();
            $query->close();
        }
        echo "<script>location.href='$home/profile-$pid';</script>";
    }
    
    
?>