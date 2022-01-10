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
?>

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h1 class="text-center text-primary">Chỉnh sửa ứng dụng</h1>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <span class="input-group-text">Tên ứng dụng</span>
                    <input name="name" type="text" class="form-control" value="<?=$dataApp['name']?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Loại ứng dụng</span>
                    <select name="type" class="form-control">
                        <?php 
                            $query = mysqli_query($conn, "SELECT * FROM type");
                            while ($data = mysqli_fetch_assoc($query)){
                                if ($dataApp['type'] == $data['name']){
                                    echo "<option selected value='".$data['name']."'>".$data['namedetail']."</option>";
                                }else{
                                    echo "<option value='".$data['name']."'>".$data['namedetail']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <small class="text-muted d-flex justify-content-end">* Đơn vị VNĐ (không cần ghi). Nếu Miễn phí thì ghi là "0"</small>
                <div class="input-group mb-3">
                    <span class="input-group-text">Giá bán</span>
                    <input name="price" type="number" min="0" class="form-control" value="<?=$dataApp['price']?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Mô tả</span>
                    <textarea name="mota" class="form-control"><?=$dataApp['mota']?></textarea>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Phiên bản</span>
                    <input name="ver" type="text" class="form-control" value="<?=$dataApp['ver']?>">
                </div>
                <small class="text-muted d-flex justify-content-end">* File ứng dụng dịnh dạng .apk hoặc .zip với dung lượng dưới 200MB</small>
                
                <?php if($dataApp['file'] != null){ ?>
                <div class="input-group mb-3">
                    <span class="input-group-text">File</span>
                        <div class="form-control">
                            <?=(($dataApp['file']!=null) ? $dataApp['file'] : '')?>
                            
                        </div>
                    <div class="text-center">
                        <a href="<?=$home?>/dev/changeapp-<?=$aid?>-file">
                            <button type="button" class ="btn btn-warning ml-1">Thay đổi</button>
                        </a>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="input-group mb-3">
                    <span class="input-group-text">File</span>
                    <input class="form-control" type="file" name="file" id="fileupload">
                </div>
                <?php } ?>
                <small class="text-muted d-flex justify-content-end">* Biểu tượng ứng dụng với dung lượng dưới 5MB</small>
                <?php if($dataApp['icon'] != null){ ?>
                <div class="input-group mb-3">
                    <span class="input-group-text">Icon</span>
                    <div class="d-block">
                            <img class="img-thumbnail-profile rounded" src="<?=(($dataApp['icon']!=null) ? $home.'/img/app/'.$dataApp['icon'] : $home.'/img/app/app-default.png')?>"/>
                        
                        <div class="text-center">
                            <a href="<?=$home?>/dev/changeapp-<?=$aid?>-icon">
                                <button type="button" class ="btn btn-rounded btn-warning form-control">Thay đổi</button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="input-group mb-3">
                    <span class="input-group-text">Icon</span>
                    <input class="form-control" type="file" name="icon" id="fileupload">
                </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-info">Hình ảnh ứng dụng</h5>
                        <small class="text-dark d-flex justify-content-end">* Ít nhất 3 ảnh với mỗi ảnh dưới 5MB</small>
                    </div>
                    <div class="card-body">
                        <div id="create-add-img">
                            <?php
                                $count = 0;
                                $sql = mysqli_query($conn, "SELECT * FROM imgapp WHERE appid = $aid");
                                while ($data = mysqli_fetch_assoc($sql)){
                                    $count ++;
                            ?>
                            <div id="image" class="input-group mb-3">
                                <span class="input-group-text">Hình</span>
                                <div class="d-block">
                                <img class="img-thumbnail-profile rounded" src="<?=$home.'/img/appdetail/'.$data['ten']?>"/>
                                <div class="text-center">
                                    <button type="button" onclick="editDeleteImg(this,<?=$data['id']?>)" class ="btn btn-rounded btn-danger form-control">Xóa</button>
                                </div>
                                </div>
                            </div>
                            <?php
                                } 
                                if ($count<3)
                                    for ($i=$count;$i<3;$i++){
                            ?>
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text">Hình</span>
                                <input class="form-control" type="file" name="img<?=$i?>">
                            </div>
                                    <?php } ?>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-rounded btn-secondary form-control" onclick="createAppAddImg()">Thêm ảnh</button>
                        </div>
                    </div>
                </div>
                
                <?php
                    if(isset($_POST['save'])){

                        
                        $name = $_POST['name'];
                        $type = (isset($_POST['type'])) ? $_POST['type'] : "";
                        $price = $_POST['price'];
                        $ver = $_POST['ver'];
                        $mota = $_POST['mota'];
                        //print_r($_FILES);
                        print_r($_POST);
                        //die;
                        
                            if($name == ""){
                                echo 'ít nhất phải có tên ứng dụng chứ!';
                            }else{
                                $linkIcon = "";
                                if (isset($_FILES['icon']) && ($_FILES['icon']['name'] != null)){
                                    $value = $_FILES['icon'];
                                    
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
                                            unset($_FILES['icon']);


                                        } else {
                                            echo "Có lỗi xảy ra khi upload file.";
                                        }
                                    } else {
                                        echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                                    }
                                }
                                
                                $linkFile = "";
                                $appSize = 0;
                                if (isset($_FILES['file']) && ($_FILES['file']['name'] != null)){
                                    $value = $_FILES['file'];
                                    
                                    //Thư mục bạn sẽ lưu file upload
                                    $target_dir = "../apps/files/";
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
                                            unset($_FILES['file']);

                                        } else {
                                            echo "Có lỗi xảy ra khi upload file.";
                                        }
                                    } else {
                                        echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                                    }
                                }
                                
                                
                                
                                $listImg = array();
                                foreach($_FILES as $key=>$value){
                                    if($value['name'] != null){
                                        //Thư mục bạn sẽ lưu file upload
                                        $target_dir = "../img/appdetail/";
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

                                                array_push($listImg, $value['name']);


                                            } else {
                                                echo "Có lỗi xảy ra khi upload file.";
                                            }
                                        } else {
                                            echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                                        }
                                    }
                                }
                                
                                if (isset($_FILES['icon']) && ($_FILES['icon']['name'] != null) && isset($_FILES['file']) && ($_FILES['file']['name'] != null)){
                                    $query = $conn->prepare("UPDATE app SET name=?,type='$type',file='$linkFile',price='$price',ver=?,mota=?,size=$appSize,icon='$linkIcon' WHERE id = $aid");
                                    $query->bind_param('sss',$name,$ver,$mota);
                                    $query->execute();
                                }
                                if (isset($_FILES['icon']) && ($_FILES['icon']['name'] != null) && !isset($_FILES['file'])){
                                    $query = $conn->prepare("UPDATE app SET name=?,type='$type',price='$price',ver=?,mota=?,size=$appSize,icon='$linkIcon' WHERE id = $aid");
                                    $query->bind_param('sss',$name,$ver,$mota);
                                    $query->execute();
                                }
                                if (!isset($_FILES['icon']) && isset($_FILES['file']) && ($_FILES['file']['name'] != null)){
                                    $query = $conn->prepare("UPDATE app SET name=?,type='$type',file='$linkFile',price='$price',ver=?,mota=?,size=$appSize WHERE id = $aid");
                                    $query->bind_param('sss',$name,$ver,$mota);
                                    $query->execute();
                                }
                                if (!isset($_FILES['icon']) && !isset($_FILES['file'])){
                                    $query = $conn->prepare("UPDATE app SET name=?,type='$type',price='$price',ver=?,mota=?,size=$appSize WHERE id = $aid");
                                    $query->bind_param('sss',$name,$ver,$mota);
                                    $query->execute();
                                }
                                
                                $timestamp = date('Y-m-d H:i:s');
                                mysqli_query($conn, "UPDATE app SET dateupdate = '".$timestamp."' WHERE id = $aid");
                                
                                for ($i=0;$i<count($listImg);$i++){
                                    $temp = $listImg[$i];
                                    mysqli_query($conn, "INSERT INTO imgapp(ten,appid) VALUES ('$temp',$aid)");
                                }

                                echo "<script>window.location.replace('$home/dev/edit-$aid');</script>";
                                
                                
                                
                                
                            }
                        
                    }
                ?>
                
                
                <div class="row mt-3">
                    <a class="d-flex justify-content-start col-6 text-decoration-none" href="<?=$home?>/dev/listapp">
                        <button type="button" class="btn btn-rounded btn-secondary mr-2">Back to Manager</button>
                    </a>
                    <div class="d-flex justify-content-end col-6">
                        <button type="submit" name="save" class="btn btn-rounded btn-success mr-2">Lưu nháp</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    }
    require_once '../config/end.php';
?>
