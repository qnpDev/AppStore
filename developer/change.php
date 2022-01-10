<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        die ("<script>location.href='$home/';</script>");
    }
    if($permission < 1){
        die ("<script>location.href='$home/';</script>");
    }
    if(!isset($_GET['id'])){
        die ("<script>location.href='$home/dev';</script>");
    }
    if(!isset($_GET['type'])){
        die ("<script>location.href='$home/dev';</script>");
    }
    echo '<title>DEV | Edit App</title>';
    if ($permission>=1){
        $aid = $_GET['id'];
        $dataApp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $aid"));
        $dataDev = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM developer WHERE uid = $uid"));
        if($permission == 1){
            if($dataDev['id'] != $dataApp['devid']){
                require '../error/permission.php';
                require '../config/end.php';
                die;
            }
        }
        $atype = $_GET['type'];
?>
<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            <h1 class="text-primary text-center text-uppercase">Change <?=$_GET['type']?></h1>
        </div>
        <div class="card-body">
            <h5>Chọn file:</h5>
            <form action="" method="POST" enctype="multipart/form-data">
                <input name ="file" type="file"/>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="mt-3 btn btn-rounded btn-info">Save</button>
                </div>
            </form>
            <?php
            
                if(isset($_FILES['file'])){
                    if ($_FILES["file"]['error'] != 0) {
                        echo "<div class='alert alert-danger text-center'>Bạn chưa chọn file</div>";
                    }else{
                        
                        if ($atype == "file"){
                            
                            if ($dataApp[$atype] != null){
                                unlink("../apps/files/".$dataApp['file']);
                            }
                            $value = $_FILES['file'];
                            //Thư mục bạn sẽ lưu file upload
                            $target_dir = "../apps/file/";
                            //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                            $target_file = $target_dir . basename($value["name"]);

                            $allowUpload = true;

                            //Lấy phần mở rộng của file (jpg, png, ...)
                            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                            // Cỡ lớn nhất được upload (bytes)
                            $maxfilesize = 209715200;

                            ////Những loại file được phép upload
                            $allowtypes = array('apk', 'zip', 'rar');


                            // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
                            if (file_exists($target_file)) {
                                //echo "Tên file đã tồn tại trên server, không được ghi đè";
                                $target_file = $target_dir . basename(time()."-".$value["name"]);
                                $value['name'] = time()."-".$value["name"];
                                //$allowUpload = false;
                            }
                            // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
                            if ($value["size"] > $maxfilesize) {
                                echo "Không được upload lớn hơn $maxfilesize (bytes).";
                                $allowUpload = false;
                            }else


                            // Kiểm tra kiểu file
                            if (!in_array($imageFileType, $allowtypes)) {
                                echo "Chỉ được upload các định dạng apk, zip, rar";
                                $allowUpload = false;
                            }else


                            if ($allowUpload) {
                                // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
                                if (move_uploaded_file($value["tmp_name"], $target_file)) {
                                    //echo "File " . basename($value["name"]) .
                                    //" Đã upload thành công.";

                                    //echo "File lưu tại " . $target_file;

                                    $linkFile = $value['name'];
                                    $appSize = $value['size'];
                                    mysqli_query($conn, "UPDATE app SET file='$linkFile',size=$appSize WHERE id=$aid");
                                    echo "<script>location.href='$home/dev/edit-$aid';</script>";


                                } else {
                                    echo "Có lỗi xảy ra khi upload file.";
                                }
                            } else {
                                echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                            }
                        
                        }else if($atype == "icon"){
                            if ($dataApp[$atype] != null){
                                unlink("../img/app/".$dataApp['icon']);
                            }
                            $value = $_FILES['file'];

                            //Thư mục bạn sẽ lưu file upload
                            $target_dir = "../img/app/";
                            //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                            $target_file = $target_dir . basename($value["name"]);

                            $allowUpload = true;

                            //Lấy phần mở rộng của file (jpg, png, ...)
                            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                            // Cỡ lớn nhất được upload (bytes)
                            $maxfilesize = 5242880;

                            ////Những loại file được phép upload
                            $allowtypes = array('jpg', 'png', 'jpeg', 'gif');


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

                                    $linkIcon = $value['name'];
                                    mysqli_query($conn, "UPDATE app SET icon='$linkIcon' WHERE id=$aid");
                                    echo "<script>location.href='$home/dev/edit-$aid';</script>";


                                } else {
                                    echo "Có lỗi xảy ra khi upload file.";
                                }
                            } else {
                                echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                            }
                        }
                    }
                }
            
            ?>
        </div>
    </div>
</div>



<?php
    }
    require_once '../config/end.php';
?>
