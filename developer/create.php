<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        die ("<script>location.href='$home/';</script>");
    }
    if($permission < 1){
        die ("<script>location.href='$home/';</script>");
    }
    echo '<title>DEV | Add App</title>';
    if ($permission>=1){
        $datadev = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM developer WHERE uid=$uid"));
        $devid = $datadev['id'];
?>

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h1 class="text-center text-primary">Thêm ứng dụng</h1>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <span class="input-group-text">Tên ứng dụng</span>
                    <input name="name" type="text" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Loại ứng dụng</span>
                    <select name="type" class="form-control">
                        <option  selected disabled hidden>Chọn thể loại</option>
                        <?php 
                            $query = mysqli_query($conn, "SELECT * FROM type");
                            while ($data = mysqli_fetch_assoc($query)){
                                echo "<option value='".$data['name']."'>".$data['namedetail']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <small class="text-muted d-flex justify-content-end">* Đơn vị VNĐ. Nếu Miễn phí thì ghi là "0"</small>
                <div class="input-group mb-3">
                    <span class="input-group-text">Giá bán</span>
                    <input name="price" type="number" min="0" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Mô tả</span>
                    <textarea name="mota" class="form-control"></textarea>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Phiên bản</span>
                    <input name="ver" type="text" class="form-control">
                </div>
                <small class="text-muted d-flex justify-content-end">* File ứng dụng dịnh dạng .apk hoặc .zip với dung lượng dưới 200MB</small>
                <div class="input-group mb-3">
                    <span class="input-group-text">File</span>
                    <input class="form-control" type="file" name="file" id="fileupload">
                </div>
                <small class="text-muted d-flex justify-content-end">* Biểu tượng ứng dụng với dung lượng dưới 5MB</small>
                <div class="input-group mb-3">
                    <span class="input-group-text">Icon</span>
                    <input class="form-control" type="file" name="icon" id="fileupload">
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-info">Hình ảnh ứng dụng</h5>
                        <small class="text-dark d-flex justify-content-end">* Ít nhất 3 ảnh với mỗi ảnh dưới 5MB</small>
                    </div>
                    <div class="card-body">
                        <div id="create-add-img">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Hình 1</span>
                                <input class="form-control" type="file" name="img1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Hình 2</span>
                                <input class="form-control" type="file" name="img2">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Hình 3</span>
                                <input class="form-control" type="file" name="img3">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-rounded btn-secondary" onclick="createAppAddImg()">Thêm ảnh</button>
                        </div>
                    </div>
                </div>
                
                <?php
                    if(isset($_POST['nhap']) || isset($_POST['duyet'])){
                        echo "<div class='alert alert-danger text-center mt-3'>";
                        
                        $name = $_POST['name'];
                        $type = (isset($_POST['type'])) ? $_POST['type'] : "";
                        $price = $_POST['price'];
                        $ver = $_POST['ver'];
                        $mota = $_POST['mota'];
                        //print_r($_FILES);
                        
                        
                        if(isset($_POST['nhap'])){
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
                                            


                                        } else {
                                            echo "Có lỗi xảy ra khi upload file.";
                                        }
                                    } else {
                                        echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                                    }
                                }
                                unset($_FILES['icon']);
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


                                        } else {
                                            echo "Có lỗi xảy ra khi upload file.";
                                        }
                                    } else {
                                        echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                                    }
                                }
                                unset($_FILES['file']);
                                
                                
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
                                
                                $query = $conn->prepare("INSERT INTO app(name,devid,type,file,price,ver,mota,size,icon) VALUES (?,$devid,'$type','$linkFile','$price',?,?,$appSize,'$linkIcon')");
                                $query->bind_param('sss',$name,$ver,$mota);
                                $query->execute();
                                
                                $query = $conn->prepare("SELECT * FROM app WHERE name=? AND type='$type' AND price='$price' AND devid=$devid");
                                $query->bind_param('s',$name);
                                $query->execute();
                                $result = $query->get_result();
                                $dataapp = mysqli_fetch_assoc($result);
                                $appid = $dataapp['id'];
                                for ($i=0;$i<count($listImg);$i++){
                                    $temp = $listImg[$i];
                                    mysqli_query($conn, "INSERT INTO imgapp(ten,appid) VALUES ('$temp',$appid)");
                                }
                                
                                echo "<script>window.location.replace('$home/dev/listapp');</script>";
                                
                                
                                
                                
                            }
                        }
                        echo "</div>";
                    }
                ?>
                
                
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" name="nhap" class="btn btn-rounded btn-success mr-2">Lưu nháp</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    }
    require_once '../config/end.php';
?>
