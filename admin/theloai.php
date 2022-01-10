<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        die ("<script>location.href='$home/';</script>");
    }
    if($permission !=2){
        die ("<script>location.href='$home/';</script>");
    }
    echo '<title>Admin | Portal</title>';
    if ($permission==2){
?>

<div class="container">
    <div class="card m-auto">
        <div class="card-header bg-white">
            <h1 class="text-center text-primary text-uppercase">Quản lí thể loại</h1>
        </div>
        <div class="card-body">
            <p class="text-center">
                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#themthecao" aria-expanded="false" aria-controls="themthecao">
                    Thêm thể loại
                </button>
            </p>
            <div class="collapse" id="themthecao">
                <div class="card card-body">
                    <form method="POST">
                        <div class="input-group form-group">
                            <input name="name" type="text" class="form-control" placeholder="Kí hiệu">
                            <input name="namedetail" type="text" class="form-control" placeholder="Tên thể loại">
                        </div>
                        <div class="invalid-login text-warning text-center font-weight-bold">
                        </div>
                        <div class="form-group">
                            <div id="forgot-recovery-err" class="d-none alert alert-danger">Error</div>
                            <button name="them" type="submit" class="btn float-right login_btn bg-primary text-white">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                if(isset($_POST['them'])){
                    $name = $_POST['name'];
                    $namedetail = $_POST['namedetail'];
                    if($name == "" || $namedetail == ""){
                        echo "<div class='alert alert-danger text-center'>Không được bỏ trống ô nào</div>";
                    }else{
                        $query = mysqli_query($conn, "INSERT INTO type(name,namedetail) VALUES ('$name','$namedetail')");
                        if($query){
                            echo "<div class='alert alert-success text-center'>Thêm thành công</div>";
                        }else{
                            echo "<div class='alert alert-danger text-center'>Lỗi</div>";
                        }
                    }
                }
            
            ?>


            <div class="text-center text-muted mt-5">
                <h5>Danh sách thể loại</h5>
            </div>
            <table class="table text-center">
                <thead>
                    <th>ID</th>
                    <th>Kí hiệu</th>
                    <th>Tên</th>
                    <th>Apps</th>
                    <th>Tools</th>
                </thead>
                <tbody>
                    
                    <?php
                        $query = mysqli_query($conn, "SELECT * FROM type");
                        $total_records = mysqli_num_rows($query);
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
                        $result = mysqli_query($conn, "SELECT * FROM type LIMIT $start, $limit");
                        while ($data = mysqli_fetch_assoc($result)){
                    ?>
                    <tr id='row<?=$data['id']?>'>
                        <td><?=$data['id']?></td>
                        <td><?=$data['name']?></td>
                        <td><?=$data['namedetail']?></td>
                        <td>
                            <?php 
                                $sql = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE type='".$data['name']."'"));
                                echo $sql;
                                ?>
                        </td>
                        <td>
                            <button onclick="window.location.replace('<?=$home?>/admin/theloai/edit-<?=$data['id']?>')" class='m-1 btn btn-primary'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button onclick='typeRemove(this,<?=$data['id']?>)' class='m-1 btn btn-danger'><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
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


