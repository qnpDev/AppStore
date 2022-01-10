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
    <div class="row">
        <div class="col-12 col-lg-4 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="text-primary">Tổng quan</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Tổng ứng dụng: 
                        <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE devid=$devid");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Có phí:
                        <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE devid=$devid AND price > 0 AND status=2");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Miễn phí: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE devid=$devid AND price = 0 AND status=2");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Nháp: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE devid=$devid AND status=0");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Chờ duyệt: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE devid=$devid AND status=1");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Được duyệt: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE devid=$devid AND status=2");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Đã gỡ: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE devid=$devid AND status=3");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="text-danger">Tools</h4>
                </div>
                <div class="card-body">
                    <a class="text-decoration-none item-hover" href="<?=$home?>/dev/profile">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Xem thông tin nhà phát triển
                            </li>
                        </a>
                    <a class="text-decoration-none item-hover" href="<?=$home?>/dev/create">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Thêm ứng dụng mới
                            </li>
                        </a>
                    <a class="text-decoration-none item-hover" href="<?=$home?>/dev/listapp">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Quản lí ứng dụng
                            </li>
                        </a>
                    <a class="text-decoration-none item-hover" href="<?=$home?>/dev/thongke">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Thống kê doanh thu
                            </li>
                        </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="text-primary">Nháp mới nhất</h4>
                </div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Ngày tạo</th>
                            <th>Edit</th>
                        </thead>
                        <tbody>
                            <?php
                                $query = mysqli_query($conn, "SELECT * FROM app WHERE devid=$devid AND status = 0 LIMIT 5");
                                while ($data = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <td><?=$data['id']?></td>
                                <td><?=$data['name']?></td>
                                <td><?=$data['date']?></td>
                                <td>
                                    <a href="<?=$home?>/dev/edit-<?=$data['id']?>">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </a>
                            </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
    }
    require_once '../config/end.php';
?>
