<?php
    require_once 'config/head.php';
    echo '<title>Upgrade to Developer</title>';
    if (!isset($_SESSION['user'])){
        require_once 'error/login.php';
        require_once 'config/end.php';
        die;
    }
?>
<div class="container">
    <div class="card-box-profile">
        <div class="member-card pt-2 pb-2">
            <div class="card-header bg-white">
                <h1 class="text-center text-primary font-weight-bold">
                    Upgrade to Developer
                </h1>
            </div>
            <div class="text-center">
                <span>Hi </span>
                <span class="text-info font-weight-bold"><?=($dataUser['name']!=null) ? $dataUser['name'] : $dataUser['username']?></span>
                <span>,</span>
            </div>
            <?php if($dataUser['permission']>=1){ ?>
            <p class="text-muted mt-5">
                <span>	&rarr;  Bạn đã trở thành một</span>
                <span class="text-danger font-weight-bold">nhà phát triển</span>
                <span>của chúng tôi! Bấm vào nút bên dưới để đến trang quản lý.</span>
            
            </p>
            <div class="text-center mt-3">
                <a href="<?=$home?>/dev">
                    <button class="btn btn-success">Direct to Manage</button>
                </a>
            </div>
            <?php }else{ ?>
            <p class="text-muted mt-3">
                <span>	&rarr; Bạn muốn trở thành nhà phát triển cho chúng tôi. Hãy</span>
                <span class="text-danger font-weight-bold">Upgrade</span>
                <span>tài khoản ngay hôm nay chỉ với</span>
                <span class="text-success font-weight-bold">500.000</span>
                <span>VNĐ và cung cấp cho chúng tôi một số thông tin về bạn!</span>
            </p>
            
            <div class="mt-3 card card-body">
                <h4 class="text-info">Thông tin nhà phát triển</h4>
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text">Tên nhà phát triển</span>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Mô tả</span>
                        <textarea name="mota" class="form-control"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Phone</span>
                        <input name="sdt" type="text" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Email</span>
                        <input name="email" type="text" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Địa chỉ</span>
                        <textarea name="diachi" class="form-control"></textarea>
                    </div>
                    <small class="text-muted d-flex justify-content-end">* Dung lượng tải lên cho phép là 5MB</small>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Ảnh Avatar</span>
                        <input class="form-control" type="file" name="avatar" id="fileupload">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Ảnh CCCD mặt trước</span>
                        <input class="form-control" type="file" name="cccdfront" id="fileupload">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Ảnh CCCD mặt sau</span>
                        <input class="form-control" type="file" name="cccdback" id="fileupload">
                    </div>

                <?php
                if (isset($_POST['upgrade'])) {
                    
                    if ($dataUser['money'] < 500000) {
                        echo"<div class='text-center alert alert-danger'>Bạn không đủ tiền! Vui lòng nạp thêm tiền và thử lại.</div>";
                    }else{
                     
                        echo "<div class='alert alert-danger text-center'>";
                        $name = $_POST['name'];
                        $mota = $_POST['mota'];
                        $sdt = $_POST['sdt'];
                        $email = $_POST['email'];
                        $diachi = $_POST['diachi'];
                        $cccdfront = $_FILES['cccdfront'];
                        $cccdback = $_FILES['cccdback'];
                        $avatar = $_FILES['avatar'];
                        
                        if ($name == ""){
                            echo "Bạn chưa nhập tên";
                        }else if($mota == ""){
                            echo "Bạn chưa nhập mô tả";
                        }else if($sdt == ""){
                            echo "Bạn chưa nhập số điện thoại";
                        }else if($email == ""){
                            echo"Bạn chưa nhập email";
                        }else if($diachi == ""){
                            echo "Bạn chưa nhập địa chỉ";
                        }else if ($_FILES["avatar"]['error'] != 0) {
                            echo "Bạn chưa upload avatar";
                        }else if ($_FILES["cccdfront"]['error'] != 0) {
                            echo "Bạn chưa upload mặt trước Căn cước công dân";
                        } else if ($_FILES["cccdback"]['error'] != 0) {
                            echo "Bạn chưa upload mặt sau Căn cước công dân";
                        }else {
                            $listImg = array();
                            
                            foreach($_FILES as $key=>$value){
                                
                                //Thư mục bạn sẽ lưu file upload
                                $target_dir = "img/dev/";
                                //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                                $target_file = $target_dir . basename($value["name"]);

                                $allowUpload = true;

                                //Lấy phần mở rộng của file (jpg, png, ...)
                                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                                // Cỡ lớn nhất được upload (bytes)
                                $maxfilesize = 5242880;

                                ////Những loại file được phép upload
                                $allowtypes = array('jpg', 'png', 'jpeg', 'gif');


                                if (isset($_POST["submit"])) {
                                    //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
                                    $check = getimagesize($value["tmp_name"]);
                                    if ($check !== false) {
                                        echo "Đây là file ảnh - " . $check["mime"] . ".";
                                        $allowUpload = true;
                                    } else {
                                        echo "Không phải file ảnh.";
                                        $allowUpload = false;
                                    }
                                }

                                // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
                                if (file_exists($target_file)) {
                                    //echo "Tên file đã tồn tại trên server, không được ghi đè";
                                    $target_file = $target_dir . basename(time()."-".$value["name"]);
                                    $value['name'] = time()."-".$value["name"];
                                    //$allowUpload = false;
                                }
                                // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
                                if ($value["size"] > $maxfilesize) {
                                    echo "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
                                    $allowUpload = false;
                                }else


                                // Kiểm tra kiểu file
                                if (!in_array($imageFileType, $allowtypes)) {
                                    echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
                                    $allowUpload = false;
                                }else


                                if ($allowUpload) {
                                    // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
                                    if (move_uploaded_file($value["tmp_name"], $target_file)) {
                                        //echo "File " . basename($value["name"]) .
                                        //" Đã upload thành công.";

                                        //echo "File lưu tại " . $target_file;
                                        
                                        array_push($listImg, $value['name']);
                                        
                                        
                                    } else {
                                        echo "Có lỗi xảy ra khi upload file.";
                                    }
                                } else {
                                    echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                                }
                            }
                            
                            if(count($listImg) == 3){
                                $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $uid");
                                $datau = mysqli_fetch_assoc($query);
                                if($datau['permission'] < 1){
                                    mysqli_query($conn, "UPDATE users SET money=(money-500000), permission=1 WHERE id = $uid");
                                    
                                    $av = "/img/dev/".$listImg[0];
                                    $front = "/img/dev/".$listImg[1];
                                    $back = "/img/dev/".$listImg[2];
                                    $query = $conn->prepare("INSERT INTO developer(uid,name,mota,sdt,email,diachi,avatar,cccdfront,cccdback) VALUES ($uid,?,?,?,?,?,'$av','$front','$back')");
                                    $query->bind_param('sssss',$name,$mota,$sdt,$email,$diachi);
                                    $query->execute();
                                    $result = $query->get_result();
                                    $query->close();
                                    echo "<script>location.href='$home/dev';</script>";
                                    
                                }      
                            }
                            
                        }
                    }
                    echo '</div>';
                }
                ?>
                <div class="text-center">
                        <button type="submit" name="upgrade" class="btn btn-success">Upgrade</button>
                    </div>
                </form>
            </div>
                <?php
            }
            ?>

            
        </div>
    </div>
</div>

<?php
    require_once 'config/end.php';
?>