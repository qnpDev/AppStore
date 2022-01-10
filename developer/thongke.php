<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        die ("<script>location.href='$home/';</script>");
    }
    if($permission < 1){
        die ("<script>location.href='$home/';</script>");
    }
    echo '<title>DEV | Portal</title>';
    if ($permission>=1){
        $datadev = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM developer WHERE uid=$uid"));
        $devid = $datadev['id'];
?>

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h4 class="text-dark">Thống kê</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><i class="fa fa-superpowers" aria-hidden="true"></i> Đã bán: 
                    <?php
                    $query = mysqli_query($conn, "SELECT id FROM bought WHERE aid IN (SELECT id FROM app WHERE devid=$devid AND price > 0)");
                    echo mysqli_num_rows($query);
                    ?>
                </li>
                <li class="list-group-item"><i class="fa fa-superpowers" aria-hidden="true"></i> Lợi nhuận:
                    <?php
                    $query = mysqli_query($conn, "SELECT sum(price) FROM app WHERE id IN (SELECT aid FROM bought WHERE aid IN (SELECT id FROM app WHERE devid=$devid AND price > 0))");
                    echo number_format(mysqli_fetch_array($query)[0]) . " đ";
                    ?>
                </li>
                
            </ul>
        </div>
    </div>
    <div class="card shadow mt-3">
        <div class="card-header bg-white">
            <h4 class="text-dark">Lịch sử giao dịch</h4>
        </div>
        <div class="card-body">
            <table class="text-center table">
                <thead>
                    <th>Đơn hàng</th>
                    <th>Icon</th>
                    <th>Tên ứng dụng</th>
                    <th>Người mua</th>
                    <th>Số tiền</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    <?php
                        $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM bought WHERE aid IN (SELECT id FROM app WHERE devid=$devid AND price > 0)"));
                        
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $limit = 10;

                        $total_page = ceil($total_records / $limit);

                        if ($current_page > $total_page){
                            $current_page = $total_page;
                        }
                        else if ($current_page < 1){
                            $current_page = 1;
                        }

                        $start = ($current_page - 1) * $limit;
                        $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid IN (SELECT id FROM app WHERE devid=$devid AND price > 0) LIMIT $start, $limit");
                        while($data = mysqli_fetch_assoc($query)){
                            $dataapp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id = ".$data['aid']));
                            $datauser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = ".$data['uid']));
                    ?>
                    
                    <tr>
                        <td><?=$data['id']?></td>
                        <td><img class="rounded img-icon-list" src="<?=$home?>/img/app/<?= ($dataapp['icon'] != null) ? $dataapp['icon'] : 'app-default.png' ?>"/></td>
                        <td><?=$dataapp['name']?></td>
                        <td><?=($datauser['name'] != null) ? $datauser['name'] : $datauser['username']?></td>
                        <td><?= number_format($dataapp['price'])?></td>
                        <td><?=$data['date']?></td>
                    </tr>
                    
                        <?php } ?>
                </tbody>
            </table>
            
            <div class="d-flex justify-content-end">
            <?php
            // PHẦN HIỂN THỊ PHÂN TRANG
            echo "<ul class='pagination'>";
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="?page='.($current_page-1).'">Prev</a></li>';
            }

            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
                }
                else{
                    echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                }
            }

            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="?page='.($current_page+1).'">Next</a></li>';
            }
            echo '</ul>';
            ?>
            </div>
            
        </div>
    </div>
</div>

<?php
    }
    require_once '../config/end.php';
?>
