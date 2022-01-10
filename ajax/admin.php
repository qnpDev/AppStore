<?php
    include '../config/conn.php';

    if(isset($_POST['type']) == "typeRemove"){
        $id = $_POST['id'];
        $dataType = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE id=$id"));
        $type = $dataType['name'];
        $query = mysqli_query($conn, "SELECT * FROM app WHERE type='$type'");
        if (mysqli_num_rows($query)>0){
            die('0');
        }else{
            $query2 = mysqli_query($conn, "DELETE FROM type WHERE id=$id");
            if($query2){
                die("1");
            }else{
                die("2");
            }
        }
        die("2");
    }
    
    if(isset($_REQUEST["page"])){
        $page = $_REQUEST["page"];
        $type = $_REQUEST["type"];
        $limit = 10;
        $start = ($page - 1) * $limit;

        if($type == "all"){
            $sql = mysqli_query($conn, "SELECT * FROM app ORDER BY date DESC LIMIT $start,$limit");
        }else{
            $sql = mysqli_query($conn, "SELECT * FROM app WHERE type='$type' ORDER BY date DESC LIMIT $start,$limit");
        }
        if(mysqli_num_rows($sql) > 0){

            // Tìm nạp các hàng kết quả dưới dạng mảng kết hợp
            while($row = mysqli_fetch_assoc($sql)){
                $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
                $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
                $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
                $accept = "";
                $refuse = "";
                if($row['status'] == 0){
                    $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
                }else if($row['status'] == 1){
                    $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
                    $accept = "<button onclick='appAdminAccept(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
                    $refuse = "<button onclick='appAdminRefuse(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
                }else if($row['status'] == 2){
                    $status = "<button class='btn btn-success p-1' disabled>Published</button>";
                    $refuse = "<button onclick='appAdminUnpublished(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
                }else if($row['status'] == 3){
                    $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
                    $refuse = "<button onclick='appAdminDelete(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
                }else if($row['status'] == 4){
                    $status = "<button class='btn btn-dark p-1' disabled>Refuse</button>";
                    $refuse = "<button onclick='appAdminDelete(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
                }
                echo "<tr>"
                    . "<td>" . $row['id'] . "</td>"
                    . "<td><img class='rounded img-icon-list' src='$home/img/app/" . $imgIcon . "'/></td>"
                    . "<td>" . $row['name'] . "</td>"
                    . "<td>" . $query['namedetail'] . "</td>"
                    . "<td>" . $status . "</td>"
                    . "<td>"
                        . "<a class='m-1' href='$home/app-".$row['id']."'><button class = 'btn btn-outline-success btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>"
                        . "<a class='m-1' href='$home/dev/edit-".$row['id']."'><button class = 'btn btn-outline-info btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>"
                        . $accept
                        . $refuse
                        . "</td>"
                    . "</tr>";
            }
        } else{
            echo "Không tìm thấy kết quả nào";
        }

    }
    
    if(isset($_REQUEST["accept"])){
        $id = $_REQUEST["accept"];
        mysqli_query($conn, "UPDATE app SET status=2 WHERE id = $id");
        $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $id"));
        $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
        $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
        $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
        $accept = "";
        $refuse = "";
        if($row['status'] == 0){
            $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
        }else if($row['status'] == 1){
            $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
            $accept = "<button onclick='appAdminAccept(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
            $refuse = "<button onclick='appAdminRefuse(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }else if($row['status'] == 2){
            $status = "<button class='btn btn-success p-1' disabled>Published</button>";
            $refuse = "<button onclick='appAdminUnpublished(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
        }else if($row['status'] == 3){
            $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
            $refuse = "<button onclick='appAdminDelete(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }else if($row['status'] == 4){
            $status = "<button class='btn btn-dark p-1' disabled>Refuse</button>";
            $refuse = "<button onclick='appAdminDelete(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }
        echo "<tr>"
            . "<td>" . $row['id'] . "</td>"
            . "<td><img class='rounded img-icon-list' src='$home/img/app/" . $imgIcon . "'/></td>"
            . "<td>" . $row['name'] . "</td>"
            . "<td>" . $query['namedetail'] . "</td>"
            . "<td>" . $status . "</td>"
            . "<td>"
                . "<a class='m-1' href='$home/app-".$row['id']."'><button class = 'btn btn-outline-success btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>"
                . "<a class='m-1' href='$home/dev/edit-".$row['id']."'><button class = 'btn btn-outline-info btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>"
                . $accept
                . $refuse
                . "</td>"
            . "</tr>";
    }
    
    if(isset($_REQUEST["refuse"])){
        $id = $_REQUEST["refuse"];
        mysqli_query($conn, "UPDATE app SET status=4 WHERE id = $id");
        $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $id"));
        $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
        $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
        $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
        $accept = "";
        $refuse = "";
        if($row['status'] == 0){
            $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
        }else if($row['status'] == 1){
            $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
            $accept = "<button onclick='appAdminAccept(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
            $refuse = "<button onclick='appAdminRefuse(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }else if($row['status'] == 2){
            $status = "<button class='btn btn-success p-1' disabled>Published</button>";
            $refuse = "<button onclick='appAdminUnpublished(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
        }else if($row['status'] == 3){
            $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
            $refuse = "<button onclick='appAdminDelete(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }else if($row['status'] == 4){
            $status = "<button class='btn btn-dark p-1' disabled>Refuse</button>";
            $refuse = "<button onclick='appAdminDelete(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }
        echo "<tr>"
            . "<td>" . $row['id'] . "</td>"
            . "<td><img class='rounded img-icon-list' src='$home/img/app/" . $imgIcon . "'/></td>"
            . "<td>" . $row['name'] . "</td>"
            . "<td>" . $query['namedetail'] . "</td>"
            . "<td>" . $status . "</td>"
            . "<td>"
                . "<a class='m-1' href='$home/app-".$row['id']."'><button class = 'btn btn-outline-success btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>"
                . "<a class='m-1' href='$home/dev/edit-".$row['id']."'><button class = 'btn btn-outline-info btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>"
                . $accept
                . $refuse
                . "</td>"
            . "</tr>";
    }
    
    if(isset($_REQUEST["unpublished"])){
        $id = $_REQUEST["unpublished"];
        mysqli_query($conn, "UPDATE app SET status=3 WHERE id = $id");
        $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $id"));
        $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
        $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
        $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
        $accept = "";
        $refuse = "";
        if($row['status'] == 0){
            $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
        }else if($row['status'] == 1){
            $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
            $accept = "<button onclick='appAdminAccept(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
            $refuse = "<button onclick='appAdminRefuse(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }else if($row['status'] == 2){
            $status = "<button class='btn btn-success p-1' disabled>Published</button>";
            $refuse = "<button onclick='appAdminUnpublished(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
        }else if($row['status'] == 3){
            $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
            $refuse = "<button onclick='appAdminDelete(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }else if($row['status'] == 4){
            $status = "<button class='btn btn-dark p-1' disabled>Refuse</button>";
            $refuse = "<button onclick='appAdminDelete(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }
        echo "<tr>"
            . "<td>" . $row['id'] . "</td>"
            . "<td><img class='rounded img-icon-list' src='$home/img/app/" . $imgIcon . "'/></td>"
            . "<td>" . $row['name'] . "</td>"
            . "<td>" . $query['namedetail'] . "</td>"
            . "<td>" . $status . "</td>"
            . "<td>"
                . "<a class='m-1' href='$home/app-".$row['id']."'><button class = 'btn btn-outline-success btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>"
                . "<a class='m-1' href='$home/dev/edit-".$row['id']."'><button class = 'btn btn-outline-info btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>"
                . $accept
                . $refuse
                . "</td>"
            . "</tr>";
    }
    
    
    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['delete'];
        mysqli_query($conn, "DELETE FROM app WHERE id = $id");
        $query = mysqli_query($conn, "SELECT * FROM imgapp WHERE appid=$id");
        if(mysqli_num_rows($query) > 0){
            while($data = mysqli_fetch_assoc($query)){
                unlink("../img/appdetail/"+$data['ten']);
            }
            mysqli_query($conn, "DELETE FROM imgapp WHERE appid = $id");
            mysqli_query($conn, "DELETE FROM bought WHERE aid = $aid");
        }
        echo '1';
    }
    
    
    
    if(isset($_REQUEST["pageDuyet"])){
        $page = $_REQUEST["pageDuyet"];
        $type = $_REQUEST["type"];
        $limit = 10;
        $start = ($page - 1) * $limit;

        if($type == "all"){
            $sql = mysqli_query($conn, "SELECT * FROM app WHERE status=1 ORDER BY date DESC LIMIT $start,$limit");
        }else{
            $sql = mysqli_query($conn, "SELECT * FROM app WHERE type='$type' AND status=1 ORDER BY date DESC LIMIT $start,$limit");
        }
        if(mysqli_num_rows($sql) > 0){

            // Tìm nạp các hàng kết quả dưới dạng mảng kết hợp
            while($row = mysqli_fetch_assoc($sql)){
                $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
                $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
                $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
                $accept = "<button onclick='appAdminAccept(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
                $refuse = "<button onclick='appAdminRefuse(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>";
                if($row['status'] == 0){
                    $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
                }else if($row['status'] == 1){
                    $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
                }else if($row['status'] == 2){
                    $status = "<button class='btn btn-success p-1' disabled>Published</button>";
                }else if($row['status'] == 3){
                    $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
                }else if($row['status'] == 4){
                    $status = "<button class='btn btn-dark p-1' disabled>Refuse</button>";
                }
                echo "<tr>"
                    . "<td>" . $row['id'] . "</td>"
                    . "<td><img class='rounded img-icon-list' src='$home/img/app/" . $imgIcon . "'/></td>"
                    . "<td>" . $row['name'] . "</td>"
                    . "<td>" . $query['namedetail'] . "</td>"
                    . "<td>" . $status . "</td>"
                    . "<td>"
                        . "<a class='m-1' href='$home/app-".$row['id']."'><button class = 'btn btn-outline-success btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>"
                        . "<a class='m-1' href='$home/dev/edit-".$row['id']."'><button class = 'btn btn-outline-info btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>"
                        . $accept
                        . $refuse
                        . "</td>"
                    . "</tr>";
            }
        } else{
            echo "Không tìm thấy kết quả nào";
        }

    }
    
    
    if(isset($_REQUEST["pageListUsers"])){
        $page = $_REQUEST["pageListUsers"];
        $limit = 10;
        $start = ($page - 1) * $limit;


        $sql = mysqli_query($conn, "SELECT * FROM users ORDER BY date DESC LIMIT $start,$limit");

        if(mysqli_num_rows($sql) > 0){

            // Tìm nạp các hàng kết quả dưới dạng mảng kết hợp
            while($row = mysqli_fetch_assoc($sql)){
                $imgAvatar = ($row['avatar'] >= 1) ? $home . '/img/avatar/' . $row['id'] .'-'.$row['avatar']. '.png' : $home . '/img/avatar-default-icon.png';
                $per = "";
                if ($row['permission'] == 0){
                    $per = "<button class='btn btn-secondary p-1' disabled>Member</button>";
                }else if ($row['permission'] == 1){
                    $per = "<button class='btn btn-primary p-1' disabled>Developer</button>";
                }else if($row['permission'] == 2){
                    $per = "<button class='btn btn-danger p-1' disabled>Admin</button>";
                }
                echo "<tr>"
                    . "<td>" . $row['id'] . "</td>"
                    . "<td><img class='rounded img-icon-list' src='" . $imgAvatar . "'/></td>"
                    . "<td>" . $row['username'] . "</td>"
                    . "<td>" . $per . "</td>"
                    . "<td>"
                        . "<a class='m-1' href='$home/profile-".$row['id']."'><button type='button' class = 'btn btn-outline-success btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>"
                        . "<a class='m-1' href='$home/profile-edit-".$row['id']."'><button type='button' class = 'btn btn-outline-info btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>"
                        . "<a class='m-1' href='$home/user-".$row['id']."/bought'><button type='button' class = 'btn btn-outline-warning btn-sm'><i class='fa fa-shopping-cart' aria-hidden='true'></i></button></a>"
                        . "</td>"
                    . "</tr>";
            }
        } else{
            echo "Không tìm thấy kết quả nào";
        }

    }
    
    if(isset($_REQUEST["pageListDev"])){
        $page = $_REQUEST["pageListDev"];
        $limit = 10;
        $start = ($page - 1) * $limit;


        $sql = mysqli_query($conn, "SELECT * FROM developer ORDER BY date DESC LIMIT $start,$limit");

        if(mysqli_num_rows($sql) > 0){

            // Tìm nạp các hàng kết quả dưới dạng mảng kết hợp
            while($row = mysqli_fetch_assoc($sql)){
                $imgAvatar = ($row['avatar'] != null) ? $home . $row['avatar'] : $home . '/img/avatar-default-icon.png';
                $dataU = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = ".$row['uid']));
                $uname = ($dataU['name'] != null) ? $dataU['name'] : $dataU['username'];
                echo "<tr>"
                    . "<td>" . $row['id'] . "</td>"
                    . "<td><img class='rounded img-icon-list' src='" . $imgAvatar . "'/></td>"
                    . "<td>" . $row['name'] . "</td>"
                    . "<td>" . $uname . "</td>"
                    . "<td>"
                        . "<a class='m-1' href='$home/dev/profile-".$row['id']."'><button type='button' class = 'btn btn-outline-success btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>"
                        . "<a class='m-1' href='$home/profile-".$row['uid']."'><button type='button' class = 'btn btn-outline-info btn-sm'><i class='fa fa-address-card-o' aria-hidden='true'></i></button></a>"
                        . "<a class='m-1' onclick='listDevRemove(this," . $row['id'] . ")'><button type='button' class = 'btn btn-outline-danger btn-sm'><i class='fa fa-trash-o' aria-hidden='true'></i></button></a>"
                    . "</td>"
                    . "</tr>";
            }
        } else{
            echo "Không tìm thấy kết quả nào";
        }

    }
    
    if(isset($_REQUEST["devRemove"])){
        $id = $_REQUEST["devRemove"];
        $sql1 = mysqli_query($conn, "DELETE FROM developer WHERE id = $id");
        $sql2 = mysqli_query($conn, "DELETE FROM app WHERE devid = $id");
        if ($sql && $sql2){
            die('1');
        }else{
            die('0');
        }
    }
    
    
?>