<?php
    require_once '../config/head.php';
    if (isset($_GET['id'])){
        $pid = $_GET['id'];
        $query = mysqli_query($conn, "SELECT * FROM developer WHeRE id='$pid'");
        if(mysqli_num_rows($query)>0){
            $data = mysqli_fetch_array($query);
        }else{
            require '../error/oops.php';
            require '../config/end.php';
            die;
        }
    }else{
        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM developer WHeRE uid='$uid'"));
        $pid = $data['id'];
    }
    echo '<title>'.$data['name'].'</title>';
?>

<div class="container">
    <div class="card m-auto shadow">
        <div class="card-header bg-white">
            <h1 class="text-center text-primary"><?= $data['name'] ?></h1>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <img src="<?= ($data['avatar'] != null) ? $home . $data['avatar'] : $home . '/img/avatar-default-icon.png' ?>" class="rounded-circle img-thumbnail img-thumbnail-profile" alt="DEv-image">
            </div>
            
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Tên nhà phát triển: </div>
                <div class="font-weight-bold col-6 d-flex justify-content-start"><?=$data['name']?></div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Chủ sở hữu: </div>
                <?php $queryuser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=".$data['uid'])); ?>
                <div class="font-weight-bold col-6 d-flex justify-content-start">
                    <a href="<?=$home?>/profile-<?=$queryuser['id']?>" class="text-decoration-none text-dark"><?= ($queryuser['name'] != "") ? $queryuser['name'] : $queryuser['username'] ?></a>
                </div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Số điện thoại: </div>
                <div class="font-weight-bold col-6 d-flex justify-content-start"><?=$data['sdt']?></div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Địa chỉ: </div>
                <div class="font-weight-bold col-6 d-flex justify-content-start"><?=$data['diachi']?></div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Tổng số ứng dụng: </div>
                <?php $totalApp = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE devid=".$pid." AND (status=2 OR status=1)")); ?>
                <div class="font-weight-bold col-6 d-flex justify-content-start">
                    <?=$totalApp?>
                </div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Ứng dụng chờ duyệt: </div>
                <?php $totalApp = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE devid=".$pid." AND status=1")); ?>
                <div class="font-weight-bold col-6 d-flex justify-content-start">
                    <?=$totalApp?>
                </div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Ứng dụng published: </div>
                <?php $totalApp = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE devid=".$pid." AND status=2")); ?>
                <div class="font-weight-bold col-6 d-flex justify-content-start">
                    <?=$totalApp?>
                </div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Ngày tham gia: </div>
                <div class="font-weight-bold col-6 d-flex justify-content-start"><?=$data['date']?></div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">Mô tả: </div>
                <div class="col-6 d-flex justify-content-start">
                    <?php if(strlen($data['mota']) < 200){ echo $data['mota']; }else{ ?>
                    <div class="">
                        <p><?= nl2br(substr($data['mota'], 0, 200)) ?><span id="detail-dots">...</span><span id="detail-more"><?= nl2br(substr($data['mota'], 500)) ?></span></p>
                        <p class="d-flex justify-content-center">    
                            <button onclick="detailSeemoreBtn()" id="detail-seemore-btn" class="btn btn-light font-weight-bold">..Read more..</button>
                        </p>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (isset($_SESSION['user'])){
                if ($permission == 2 || $data['uid'] == $uid){
                    ?>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">CCCD mặt trước: </div>
                <div class="font-weight-bold col-6 d-flex justify-content-start">
                <img src="<?= ($data['cccdfront'] != null) ? $home . $data['cccdfront'] : $home . '/img/avatar-default-icon.png' ?>" class="img-thumbnail img-thumbnail-profile" alt="DEv-image">
                </div>
            </div>
            <div class="text-center mt-3 row">
                <div class="font-italic col-6 d-flex justify-content-end">CCCD mặt sau: </div>
                <div class="font-weight-bold col-6 d-flex justify-content-start">
                <img src="<?= ($data['cccdback'] != null) ? $home . $data['cccdback'] : $home . '/img/avatar-default-icon.png' ?>" class="img-thumbnail img-thumbnail-profile" alt="DEv-image">
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    

    <!-- All app -->
        <?php 
        $limit = 10;
        $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND devid=$pid")); 
        ?>
        <div class="card shadow mt-3">
            <div class="card-header bg-white text-dark font-weight-bold">
                <h4>Ứng dụng của <?=$data['name']?></h4>
            </div>
            <div class="row d-inline-flex card-body" id="home-item">
                
            </div>
            <div class="card-footer bg-light d-flex justify-content-end">
                <ul class="pagination" id="home-page"></ul>
                
            </div>
            <script>appsDevPage(1,<?=$total?>,<?=$pid?>)</script>
        </div>
        <!-- /All app -->
</div>

<?php
    require_once '../config/end.php';
?>