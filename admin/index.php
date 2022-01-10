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
    <div class="row">
        <div class="col-12 col-lg-4 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="text-primary">Tổng quan</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Tổng users: 
                        <?php
                            $query = mysqli_query($conn, "SELECT id FROM users");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Thành viên:
                        <?php
                            $query = mysqli_query($conn, "SELECT id FROM users WHERE permission=0");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Nhà phát triển: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM users WHERE permission=1");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Tổng ứng dụng: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE status>0");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Published: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE status=2");
                            echo mysqli_num_rows($query);
                        ?>
                        </li>
                        <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Chờ duyệt: 
                            <?php
                            $query = mysqli_query($conn, "SELECT id FROM app WHERE status=1");
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
                    <h4 class="text-danger font-weight-bold">Tools</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <a class="text-decoration-none item-hover" href="<?=$home?>/admin/theloai">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Quản lí thể loại
                            </li>
                        </a>
                        <a class="text-decoration-none item-hover" href="<?=$home?>/admin/card">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Quản lí thẻ nạp
                            </li>
                        </a>
                        <a class="text-decoration-none item-hover" href="<?=$home?>/admin/app">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Quản lí ứng dụng
                            </li>
                        </a>
                        <a class="text-decoration-none item-hover" href="<?=$home?>/admin/duyetapp">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Duyệt ứng dụng
                            </li>
                        </a>
                        <a class="text-decoration-none item-hover" href="<?=$home?>/admin/users">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Quản lí thành viên
                            </li>
                        </a>
                        <a class="text-decoration-none item-hover" href="<?=$home?>/admin/developer">
                            <li class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i>
                                Quản lí developer
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-4 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="text-primary">Ứng dụng bán chạy nhất</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid IN (SELECT id FROM app WHERE price>0) GROUP BY aid ORDER BY count(*) DESC LIMIT 3");
                        while ($data = mysqli_fetch_array($query)) {
                            $dataaid = $data['aid'];
                            $dataapp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id=$dataaid"));
                            $luottai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bought WHERE aid = $dataaid"));
                        ?>
                            <a class="text-decoration-none" href="<?=$home?>/app-<?=$dataapp['id']?>">
                                <li class="list-group-item item-hover">
                                    <span><img class="home-item-img-top rounded-circle" src="<?=$home?>/img/app/<?=($dataapp['icon']!=null) ? $dataapp['icon'] : 'app-default.png'?>"/></span>
                                    <span><?= $dataapp['name'] ?></span>
                                    <span class="d-flex justify-content-end"><i class="fa fa-download" aria-hidden="true"> Lượt tải: <?=$luottai?></i></span>
                                </li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-12 col-lg-4 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="text-primary">Ứng dụng tải nhiều nhất</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        $query = mysqli_query($conn, "SELECT aid,count(*) FROM bought GROUP BY aid ORDER BY count(*) DESC LIMIT 3");
                        while ($data = mysqli_fetch_array($query)) {
                            $dataaid = $data['aid'];
                            $dataapp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app WHERE id=$dataaid"));
                            $luottai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bought WHERE aid = $dataaid"));
                        ?>
                            <a class="text-decoration-none" href="<?=$home?>/app-<?=$dataapp['id']?>">
                                <li class="list-group-item item-hover">
                                    <span><img class="home-item-img-top rounded-circle" src="<?=$home?>/img/app/<?=($dataapp['icon']!=null) ? $dataapp['icon'] : 'app-default.png'?>"/></span>
                                    <span><?= $dataapp['name'] ?></span>
                                    <span class="d-flex justify-content-end"><i class="fa fa-download" aria-hidden="true"> Lượt tải: <?=$luottai?></i></span>
                                </li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-4 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="text-primary">Thể loại nhiều ứng dụng</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 GROUP BY type ORDER BY date LIMIT 5");
                        while ($data = mysqli_fetch_array($query)) {
                            $type = $data['type'];
                            $datatype = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type WHERE name = '$type'"));
                        ?>
                            <a class="text-decoration-none" href="<?=$home?>/app/<?=$datatype['name']?>">
                                <li class="list-group-item item-hover">
                                    <?=$datatype['namedetail']?>
                                </li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-4 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="text-primary">Developer nhiều ứng dụng</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM app GROUP BY devid ORDER BY count(*) DESC LIMIT 5");
                        while ($data = mysqli_fetch_array($query)) {
                            $dataaid = $data['devid'];
                            $dataapp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM developer WHERE id=$dataaid"));
                            $luottai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE devid = $dataaid"));
                        ?>
                            <a class="text-decoration-none" href="<?=$home?>/dev/profile-<?=$dataapp['id']?>">
                                <li class="list-group-item item-hover">
                                    <div class="row">
                                        <div class="col-6">
                                            <?=$dataapp['name']?>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-end">
                                                <i class="fa fa-area-chart" aria-hidden="true"> Tổng app: <?=$luottai?></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php
    }
    require_once '../config/end.php';
?>