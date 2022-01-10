<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        die ("<script>location.href='$home/';</script>");
    }
    if($permission !=2){
        die ("<script>location.href='$home/';</script>");
    }
    echo '<title>Admin | Card</title>';
    if ($permission==2){
?>

<div class="container">
    <div class="card m-auto">
        <div class="card-header text-center text-primary bg-white">
            <h1 class="font-weight-bold">CARD</h1>
        </div>
        <div class="card-body">

            <p class="text-center">
                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#themthecao" aria-expanded="false" aria-controls="themthecao">
                        Thêm thẻ nạp
                </button>
            </p>
            <div class="collapse" id="themthecao">
                <div class="card card-body">
                    <form method="POST">
                    <div class="input-group form-group">
                        <select name="menhgia" class="btn btn-light">
                            <option  selected disabled hidden>Mệnh giá</option>
                            <option value="10000">10,000</option>
                            <option value="20000">20,000</option>
                            <option value="50000">50,000</option>
                            <option value="100000">100,000</option>
                            <option value="200000">200,000</option>
                            <option value="500000">500,000</option>
                            <option value="1000000">1,000,000</option>
                            <option value="2000000">2,000,000</option>
                            <option value="5000000">5,000,000</option>
                            <option value="10000000">10,000,000</option>
                            <option value="50000000">50,000,000</option>
                        </select>
                        <input name="soluong" type="number" class="form-control" placeholder="Số lượng" min="1">
                    </div>
                    <div class="invalid-login text-warning text-center font-weight-bold">
                    </div>
                    <div class="form-group">
                        <div id="forgot-recovery-err" class="d-none alert alert-danger">Error</div>
                        <button name="themthecao" type="submit" class="btn float-right login_btn bg-primary text-white">Thêm</button>
                    </div>
                </form>
                </div>
           </div>
            
            <?php
                if (isset($_POST['themthecao'])){
                    $menhgia = $_POST['menhgia'];
                    $soluong = $_POST['soluong'];
                    
                    if($menhgia == "" || $menhgia == 0 || $soluong == "" || $soluong == 0){
                        ?><div class="alert alert-danger">Có lỗi!</div><?php
                    }else{
                        for ($i=0;$i<$soluong;$i++){
                            do{
                                $mathe = substr(md5(uniqid()), 0, 12);
                                $query = mysqli_query($conn, "SELECT * FROM card WHERE mathe='$mathe'");
                            }while(mysqli_num_rows($query)>0);
                            $query = mysqli_query($conn, "INSERT INTO card(mathe,menhgia) VALUES ('$mathe',$menhgia)");
                        }
                        ?><div class="alert alert-success">Thêm thành công!</div><?php
                    }
                }
            
            ?>
            
            
            <h4 class="text-info">Danh sách thẻ nạp</h4>
            <table class="table text-center">
                <thead>
                    <th>STT</th>
                    <th>Mã thẻ</th>
                    <th>Mệnh giá</th>
                    <th>Date</th>
                </thead>
                <?php 
                    $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM card"));
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
                    
                    $count = 0;
                    $query = mysqli_query($conn, "SELECT * FROM card ORDER BY date DESC LIMIT $start, $limit");
                    while ($data = mysqli_fetch_assoc($query)){
                        $count++;
                ?>
                <tbody>
                    <td><?=$count?></td>
                    <td><?=$data['mathe']?></td>
                    <td><?=$data['menhgia']?></td>
                    <td><?=$data['date']?></td>
                </tbody>
                <?php
                    }
                ?>
            </table>
            <div class="d-flex justify-content-end mt-2">
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
