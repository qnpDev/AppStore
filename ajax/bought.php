<?php

require_once '../config/conn.php';
if(isset($_REQUEST["page"])){
    $page = $_REQUEST["page"];
    $limit = 10;
    $start = ($page - 1) * $limit;
    $uid = $_REQUEST['uid'];

    $sql = mysqli_query($conn, "SELECT * FROM bought WHERE uid=$uid ORDER BY date DESC LIMIT $start,$limit");

    if(mysqli_num_rows($sql) > 0){
          
        while($rowsql = mysqli_fetch_assoc($sql)){
            $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = ".$rowsql['aid']));
            $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';
            
            echo "<tr>"
                . "<td><img class='rounded img-icon-list' src='$home/img/app/" . $imgIcon . "'/></td>"
                . "<td>" . $row['name'] . "</td>"
                . "<td>" . $row['price'] . "</td>"
                . "<td>" . $rowsql['date'] . "</td>"
                . "</tr>";
        }
    } else{
        echo "Không tìm thấy kết quả nào";
    }
    
}
