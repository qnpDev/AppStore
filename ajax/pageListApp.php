<?php

require '../config/conn.php';

if(isset($_REQUEST["page"])){
    $page = $_REQUEST["page"];
    $type = $_REQUEST["type"];
    $limit = 10;
    $start = ($page - 1) * $limit;
    $uid = $_REQUEST['uid'];

    if($type == "all"){
        $sql = mysqli_query($conn, "SELECT * FROM app WHERE devid=$uid ORDER BY date DESC LIMIT $start,$limit");
    }else{
        $sql = mysqli_query($conn, "SELECT * FROM app WHERE type='$type' AND devid=$uid ORDER BY date DESC LIMIT $start,$limit");
    }
    if(mysqli_num_rows($sql) > 0){
        
        
        while($row = mysqli_fetch_assoc($sql)){
            $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
            $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
            $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
            $public = "<button onclick='appPublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
            if($row['status'] == 0){
                $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
            }else if($row['status'] == 1){
                $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
                $public = "<button onclick='appBin(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-sign-out' aria-hidden='true'></i></button>";
            }else if($row['status'] == 2){
                $status = "<button class='btn btn-success p-1' disabled>Published</button>";
                $public = "<button onclick='appCancel(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
            }else if($row['status'] == 3){
                $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
                $public = "<button onclick='appRePublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-recycle' aria-hidden='true'></i></button>";
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
                    . $public
                    . "<button onclick='appRemove(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>"
                    . "</td>"
                . "</tr>";
        }
    } else{
        echo "Không tìm thấy kết quả nào";
    }
    
}

if(isset($_POST['type']) && ($_POST['type'] == "appRemove")){
    $id = $_POST['id'];
    $sql = mysqli_query($conn, "DELETE FROM app WHERE id = $id");
    $query = mysqli_query($conn, "SELECT * FROM imgapp WHERE appid=$id");
    if(mysqli_num_rows($query) > 0){
        while($data = mysqli_fetch_assoc($query)){
            unlink("../img/appdetail/"+$data['ten']);
        }
        mysqli_query($conn, "DELETE FROM imgapp WHERE appid = $id");
        mysqli_query($conn, "DELETE FROM bought WHERE aid = $aid");
    }
    if ($sql){
        die("1");
    }else{
        die("0");
    }
}

if(isset($_REQUEST["public"])){
    $id = $_REQUEST['public'];
    $dataApp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $id"));
    $dataImgApp = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM imgapp WHERE appid = $id"));
    
    if ($dataApp['icon'] == null || $dataApp['icon'] == ""){
        die('0');
    }
    if ($dataApp['file'] == null || $dataApp['file'] == ""){
        die('0');
    }
    if ($dataImgApp < 3){
        die('0');
    }
    if ($dataApp['type'] == null || $dataApp['type'] == ""){
        die('0');
    }
    if ($dataApp['mota'] == null || $dataApp['mota'] == ""){
        die('0');
    }
    
    mysqli_query($conn, "UPDATE app SET status=1 WHERE id = $id");
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $id"));
    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
    $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
    $public = "<button onclick='appPublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
    if($row['status'] == 0){
        $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
    }else if($row['status'] == 1){
        $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
        $public = "<button onclick='appBin(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-sign-out' aria-hidden='true'></i></button>";
    }else if($row['status'] == 2){
        $status = "<button class='btn btn-success p-1' disabled>Published</button>";
        $public = "<button onclick='appCancel(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
    }else if($row['status'] == 3){
        $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
        $public = "<button onclick='appRePublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-recycle' aria-hidden='true'></i></button>";
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
            . $public
            . "<button onclick='appRemove(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>"
            . "</td>"
        . "</tr>";
}

if(isset($_REQUEST["cancel"])){
    $id = $_REQUEST['cancel'];
    mysqli_query($conn, "UPDATE app SET status=3 WHERE id = $id");
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $id"));
    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
    $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
    $public = "<button onclick='appPublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
    if($row['status'] == 0){
        $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
    }else if($row['status'] == 1){
        $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
        $public = "<button onclick='appBin(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-sign-out' aria-hidden='true'></i></button>";
    }else if($row['status'] == 2){
        $status = "<button class='btn btn-success p-1' disabled>Published</button>";
        $public = "<button onclick='appCancel(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
    }else if($row['status'] == 3){
        $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
        $public = "<button onclick='appRePublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-recycle' aria-hidden='true'></i></button>";
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
            . $public
            . "<button onclick='appRemove(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>"
            . "</td>"
        . "</tr>";
}

if(isset($_REQUEST["bin"])){
    $id = $_REQUEST['bin'];
    mysqli_query($conn, "UPDATE app SET status=0 WHERE id = $id");
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $id"));
    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
    $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
    $public = "<button onclick='appPublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
    if($row['status'] == 0){
        $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
    }else if($row['status'] == 1){
        $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
        $public = "<button onclick='appBin(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-sign-out' aria-hidden='true'></i></button>";
    }else if($row['status'] == 2){
        $status = "<button class='btn btn-success p-1' disabled>Published</button>";
        $public = "<button onclick='appCancel(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
    }else if($row['status'] == 3){
        $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
        $public = "<button onclick='appRePublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-recycle' aria-hidden='true'></i></button>";
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
            . $public
            . "<button onclick='appRemove(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>"
            . "</td>"
        . "</tr>";
}

if(isset($_REQUEST["republic"])){
    $id = $_REQUEST['republic'];
    mysqli_query($conn, "UPDATE app SET status=2 WHERE id = $id");
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = $id"));
    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
    $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name='".$row['type']."'"));
    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
    $public = "<button onclick='appPublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-check' aria-hidden='true'></i></button>";
    if($row['status'] == 0){
        $status = "<button class='btn btn-secondary p-1' disabled>Draff</button>";
    }else if($row['status'] == 1){
        $status = "<button class='btn btn-danger p-1' disabled>Pending</button>";
        $public = "<button onclick='appBin(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-sign-out' aria-hidden='true'></i></button>";
    }else if($row['status'] == 2){
        $status = "<button class='btn btn-success p-1' disabled>Published</button>";
        $public = "<button onclick='appCancel(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-ban' aria-hidden='true'></i></button>";
    }else if($row['status'] == 3){
        $status = "<button class='btn btn-warning p-1' disabled>Unpublished</button>";
        $public = "<button onclick='appRePublic(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-warning btn-sm'><i class='fa fa-recycle' aria-hidden='true'></i></button>";
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
            . $public
            . "<button onclick='appRemove(this," . $row['id'] . ")' class = 'm-1 btn btn-outline-danger btn-sm'><i class='fa fa-times' aria-hidden='true'></i></button>"
            . "</td>"
        . "</tr>";
}

if(isset($_REQUEST["deleteImg"])){
    $id = $_REQUEST['deleteImg'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM imgapp WHERE id = $id"));
    unlink("../img/appdetail/".$data['ten']);
    mysqli_query($conn, "DELETE FROM imgapp WHERE id = $id");
    echo 'done';
}


?>
