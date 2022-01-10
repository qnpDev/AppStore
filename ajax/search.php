<?php

include '../config/conn.php';

if(isset($_REQUEST["term"])){
    // Chuẩn bị câu lệnh SQL SELECT
    $sql = "SELECT * FROM app WHERE name LIKE ? AND status = 2";

    if($stmt = $conn->prepare($sql)){
        // Liên kết biến đến câu lệnh đã chuẩn bị như là tham số
        $stmt->bind_param("s", $param_term);
        
        // Thiết lập các tham số
        $param_term = '%' . $_REQUEST["term"] . '%';
        
        // Cố gắng thực thi câu lệnh đã chuẩn bị
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            // Kiểm tra số lượng row trong kết quả
            if($result->num_rows > 0){
                // Tìm nạp các hàng kết quả dưới dạng mảng kết hợp
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    $imgIcon = ($row['icon'] != null) ? $row['icon'] : 'app-default.png';

                    echo "<tr class='item-hover' onclick='search(" . $row['id'] .")'>"
                        . "<td class='text-center'><img class='rounded img-icon-list' src='$home/img/app/" . $imgIcon . "'/></td>"
                        . "<td>" . $row["name"] . "</td>"
                        . "<td class='text-center'>" . $row["price"] . " đ</td>"
                        . "</tr>";
                }
            } else{
                echo "<p>Không tìm thấy kết quả nào</p>";
            }
        } else{
            echo "ERROR: Không thể thực thi câu lệnh $sql. " . mysqli_error($link);
        }
    }
     
    // Đóng câu lệnh
    $stmt->close();
}