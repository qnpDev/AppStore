<?php
    require_once '../config/head.php';
    if (isset($_GET['id'])){
        $aid = $_GET['id'];
        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM app WHERE id='$aid'"));
        $dataapp = $data;
        $query = mysqli_query($conn, "SELECT * FROM rate WHERE appid=$aid");
        $atotalrate = 0;
        $arate = 0;
        while ($result = mysqli_fetch_assoc($query)) {
            $atotalrate += 1;
            $arate += $result['rate'];
        }
        $rating = ($atotalrate > 0) ? $arate / $atotalrate : 0;
        if(isset($_SESSION['user'])){
            if ($permission == 0 && ($data['status'] != 2)){
                require_once '../error/permission.php';
                require '../config/end.php';
                die;
            }
        }else{
            if ($data['status'] != 2){
                require_once '../error/permission.php';
                require '../config/end.php';
                die;
            }
        }
    }else{
        die;
    }
    echo '<title>'.$data['name'].'</title>';
?>
<div class="row">
    <div class="col-12 col-lg-9">
        <div class="detail-app shadow">
            <div class="row">
                <div class="col-12 col-sm-3 detail-icon text-center">

                    <img class="detail-icon rounded" src="img/app/<?= ($data['icon'] != null) ? $data['icon'] : 'app-default.png' ?>"/>

                </div>
                <div class="col-12 col-sm-9">
                    <h1><?= $data['name'] ?></h1>
                    <div class="row">
                        <div class="text-success col-6">
                            <span class="text-dark">Thể loại: </span>
                            <?php
                            $atype = $data['type'];
                            $sql = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM type WHERE name='$atype'"));
                            echo "<a href='$home/app/$atype' class='text-decoration-none'>".$sql['namedetail']."</a>";
                            ?>
                        </div> 
                        <div class="col-6 d-flex justify-content-end">
                            <?php
                            $wholeStars = floor($rating);
                            $halfStar = $rating - $wholeStars;
                            $HTML = "";
                            for ($i = 0; $i < $wholeStars; $i++) {
                                $HTML .= " <i class='fa fa-star font-weight-bold text-warning' aria-hidden='true'></i>";
                            }
                            if ($halfStar>= 0.5) {
                                $HTML .= " <i class='fa fa-star-half-o font-weight-bold text-warning' aria-hidden='true'></i>";
                                $wholeStars +=1;
                            }
                            for ($i = 0; $i < 5 - $wholeStars; $i++) {
                                $HTML .= " <i class='fa fa-star-o font-weight-bold text-warning' aria-hidden='true'></i>";
                            }
                            echo $HTML;
                            echo "<i class='ml-2 fa fa-user text-muted' aria-hidden='true'><span class='ml-1 text-muted'>" . number_format($atotalrate) . "</span></i>";
                            ?>

                        </div>
                    </div>
                    <div class="text-muted text-decoration-none font-weight-bold">
                        <i class="fa fa-id-badge text-dark font-weight-normal" aria-hidden="true"></i> Developer: 
                        <?php
                        $devid = $data['devid'];
                        $query = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM developer WHERE id='$devid'"));
                        echo "<a class='text-decoration-none' href='$home/dev/profile-$devid'>".$query['name']."</a>";
                        ?>
                    </div>
                    <div class="text-muted text-decoration-none">
                        <i class="fa fa-cloud-download" aria-hidden="true"> </i>
                        <?php 
                            $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid = $aid");
                            $datadown = mysqli_num_rows($query);
                            echo $datadown;
                        ?>
                        Lượt tải
                    </div>

                </div>
            </div>

            <?php
                if (isset($uid)){
                    $tokendown = uniqid();
                $query = mysqli_query($conn, "SELECT * FROM bought WHERE uid=$uid AND aid=$aid");
                if(mysqli_num_rows($query)>0){
            ?>
            <div class="d-flex justify-content-end" id="btn-download">
                <button onclick='buyAppAgain(<?=$aid?>,"<?=$tokendown?>")' class="btn btn-success" type="button">
                    <i class="fa fa-download" aria-hidden="true"></i> Download
                </button>
            </div>
            
                <?php }else if($data['price'] > 0){ ?>
            <div class="d-flex justify-content-end" id="btn-download">
                <span id="detail-paid-loading" class="spinner-border text-success d-none" role="status"></span>
                <button id="detail-paid" class="btn btn-success" type="button" data-toggle="modal" data-target="#buyModal">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <?=number_format($data['price'])?>đ
                </button>
            </div>
            
                <?php }else if($data['price'] == 0){ ?>
            <div class="d-flex justify-content-end" id="btn-download">
                <button onclick="buyAppFree(<?=$aid?>,<?=$uid?>,'<?=$tokendown?>')" class="btn btn-success" type="button">
                    <i class="fa fa-download" aria-hidden="true"></i> Miễn phí
                </button>
            </div>
                <?php } }else{ ?>
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-info">
                    <i class="fa fa-bullhorn font-weight-bold" aria-hidden="true"> </i>
                    Vui lòng <a class="text-decoration-none font-weight-bold" href="<?=$home?>/login">Đăng nhập</a> để tải về ứng dụng
                </div>
            </div>
                <?php } ?>
            
            <div id="detail-no-money" class="d-none">
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-danger">
                        <span class="text-danger font-weight-bold"><i class="fa fa-times" aria-hidden="true"></i></span>
                        <span>Bạn không đủ tiền trong tài khoản để mua ứng dụng này. </span>
                        <span>Vui lòng nạp thêm tiền vào tài khoản </span>
                        <span class="font-weight-bold"><a class="text-decoration-none" href="<?=$home?>/naptien">Tại đây</a></span>
                        <span>để thực hiện.</span>
                    </div>
                </div>
            </div>
            <div class="line-horizontal"></div>

            <div  id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
                <div class="carousel-inner row w-100 mx-auto" role="listbox">


                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM imgapp where appid=$aid");
                    ?>
                    <!--Các slide bên trong carousel-inner-->
                    <?php
                    while ($img = mysqli_fetch_assoc($sql)) {
                        ?>

                        <div class="detail-item-photo carousel-item">
                            <img class="img-fluid mx-auto d-block" src="img/appdetail/<?= $img['ten'] ?>">
                        </div>
                    <?php } ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                    <i class="fa fa-chevron-left fa-lg text-muted"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
                    <i class="fa fa-chevron-right fa-lg text-muted"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>


            <div class="detail-mota mt-4">
                <p><?= nl2br(substr($data['mota'], 0, 500)) ?><span id="detail-dots">...</span><span id="detail-more"><?= nl2br(substr($data['mota'], 500)) ?></span></p>
                <p class="d-flex justify-content-center">    
                    <button onclick="detailSeemoreBtn()" id="detail-seemore-btn" class="btn btn-light font-weight-bold">..Read more..</button>
                </p>
            </div>

            <div class="line-horizontal"></div>
            <div class="font-weight-bold text-uppercase">
                <h5>Đánh giá</h5>
            </div>
            
            <div class="row mt-3">
                <div class="col-5">
                    <div class="text-center">
                        <h1 class="font-weight-normal">
                            <?= number_format($rating,1)?>
                        </h1>
                        <div class="p-2">
                            <?php
                            $wholeStars = floor($rating);
                            $halfStar = $rating - $wholeStars;
                            $HTML = "";
                            for ($i = 0; $i < $wholeStars; $i++) {
                                $HTML .= " <i class='fa fa-star font-weight-bold text-muted' aria-hidden='true'></i>";
                            }
                            if ($halfStar>= 0.5) {
                                $HTML .= " <i class='fa fa-star-half-o font-weight-bold text-muted' aria-hidden='true'></i>";
                                $wholeStars +=1;
                            }
                            for ($i = 0; $i < 5 - $wholeStars; $i++) {
                                $HTML .= " <i class='fa fa-star-o font-weight-bold text-muted' aria-hidden='true'></i>";
                            }
                            echo $HTML;
                            echo "<div class='mt-2'><i class='ml-2 fa fa-user text-muted' aria-hidden='true'><span class='ml-1 text-muted'>Tổng " . number_format($atotalrate) . "</span></i></div>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-7 text-center">
                    <?php for ($i=5;$i>=1;$i--){ ?>
                    <div class="">
                        <span class="text-muted">Được cho <?=$i?> sao: </span>
                        <?php
                            $j = $i+1;
                            $query = mysqli_query($conn, "SELECT count(*) FROM rate WHERE appid=$aid AND rate >= $i AND rate < $j");
                            $result = mysqli_fetch_row($query)[0];
                        ?>
                        <span class="text-success font-weight-bold"><?=$result?><i class='ml-2 fa fa-user text-success' aria-hidden='true'></i></span>
                    </div>
                    <?php } ?>
                </div>
            </div>
            
            <?php
                if (isset($uid)){
                    $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid=$aid AND uid=$uid");
                    if(mysqli_num_rows($query)){
                $query = mysqli_query($conn, "SELECT * FROM rate WHERE appid=$aid and userid=$uid");
                if (mysqli_num_rows($query) == 0){
            ?>
            
            <div class="mt-3 detail-comment">
                <form action="" method="POST">
                    <div class="form-group text-center text-info">
                        <h5>Đánh giá ứng dụng</h5>
                    </div>
                    <div class="line-horizontal"></div>
                    <div class="form-group text-center">
                        Bạn cho ứng dụng này bao nhiêu sao:
                        <select name="star" class="form-select btn btn-light">
                            <option value="1">1 sao</option>
                            <option value="2">2 sao</option>
                            <option value="3">3 sao</option>
                            <option value="4">4 sao</option>
                            <option value="5" selected>5 sao</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" placeholder="Nhập đánh giá của bạn"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button name="sendrate" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            
            <?php
                }
                $query = mysqli_query($conn, "SELECT * FROM rate WHERE appid=$aid and userid=$uid");
                if (mysqli_num_rows($query) > 0){
                    $yourrate = mysqli_fetch_assoc($query);
            ?>
                <div class="text-center mt-3">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#your-rate" aria-expanded="false" aria-controls="collapseExample">
                        Đánh giá của bạn!
                    </button>
                </div>
                <div class="collapse" id="your-rate">
                    <div class="mt-3 detail-comment">
                        <form action="" method="POST">
                            <div class="form-group text-center text-info">
                                <h5>Đánh giá ứng dụng</h5>
                            </div>
                            <div class="line-horizontal"></div>
                            <div class="form-group text-center">
                                Bạn cho ứng dụng này bao nhiêu sao:
                                <select name="star" class="form-select btn btn-light">
                                    <option value="1" <?=($yourrate['rate'] == 1) ? "selected" : ""?>>1 sao</option>
                                    <option value="2" <?=($yourrate['rate'] == 2) ? "selected" : ""?>>2 sao</option>
                                    <option value="3" <?=($yourrate['rate'] == 3) ? "selected" : ""?>>3 sao</option>
                                    <option value="4" <?=($yourrate['rate'] == 4) ? "selected" : ""?>>4 sao</option>
                                    <option value="5" <?=($yourrate['rate'] == 5) ? "selected" : ""?>>5 sao</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="content" class="form-control" placeholder="Nhập đánh giá của bạn"><?=$yourrate['binhluan']?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start">
                                    <button name="deleterate" type="submit" class="btn btn-danger">Delete</button>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <button name="editrate" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
                }
            if (isset($_POST['deleterate'])){
                mysqli_query($conn, "DELETE FROM rate WHERE userid=$uid AND appid=$aid");
                echo "<script>window.location.replace('$home/app-$aid');</script>";
            }
                
            if (isset($_POST['editrate'])){
                $editrate = $_POST['star'];
                $query = $conn->prepare("UPDATE rate SET rate=$editrate,binhluan=? WHERE userid=$uid AND appid=$aid");
                $query->bind_param('s',$editbinhluan);

                $editbinhluan = $_POST['content'];
                $query->execute();
                echo "<script>window.location.replace('$home/app-$aid');</script>";
            ?>
            <div class="mt-3 alert alert-success text-center">
                Chỉnh sửa đánh giá thành công!
            </div>
            <?php
            }
                
            if (isset($_POST['sendrate'])) {
                $query = $conn->prepare("INSERT INTO rate(userid,appid,rate,binhluan) VALUES (?,?,?,?)");
                $query->bind_param('iids',$senduserid,$sendappid,$sendrate,$sendbinhluan);

                $senduserid = $uid;
                $sendappid = $aid;
                $sendrate = $_POST['star'];
                $sendbinhluan = $_POST['content'];
                $query->execute();
                echo "<script>window.location.replace('$home/app-$aid');</script>";
                
            ?>
            <div class="mt-3 alert alert-success text-center">
                Đánh giá thành công!
            </div>
                <?php } } } ?>
            
            <div class="mt-3">
                <ul class="list-group">
                    <?php
                        $query = mysqli_query($conn, "SELECT * FROM rate WHERE appid=$aid ORDER BY date DESC LIMIT 3");
                        while($comment = mysqli_fetch_assoc($query)){
                            $cuid = $comment['userid'];
                            $query2 = mysqli_query($conn, "SELECT * FROM users WHERE id=$cuid");
                            $datau = mysqli_fetch_array($query2);
                    ?>
                        <li class="list-group-item ">
                            <div class="row">
                                <div class="col-2 text-center">
                                    <div class="mb-1">
                                        <img src="<?= ($datau['avatar'] >= 1) ? $home . '/img/avatar/' . $datau['id'] .'-'.$datau['avatar']. '.png' : $home . '/img/avatar-default-icon.png' ?>" class="rounded-circle home-item-img-top" alt="profile-image">
                                    </div>
                                    <small class="text-dark"><?= ($datau['name'] != "") ? $datau['name'] : $datau['username'] ?></small>
                                </div>
                                <div class="col-10">
                                    <div class="mb-2">
                                        <?php
                                            $wholeStars = floor($comment['rate']);
                                            $halfStar = $comment['rate'] - $wholeStars;
                                            $HTML = "";
                                            for ($i = 0; $i < $wholeStars; $i++) {
                                                $HTML .= " <i class='fa fa-star font-weight-bold text-muted' aria-hidden='true'></i>";
                                            }
                                            if ($halfStar>= 0.5) {
                                                $HTML .= " <i class='fa fa-star-half-o font-weight-bold text-muted' aria-hidden='true'></i>";
                                                $wholeStars +=1;
                                            }
                                            for ($i = 0; $i < 5 - $wholeStars; $i++) {
                                                $HTML .= " <i class='fa fa-star-o font-weight-bold text-muted' aria-hidden='true'></i>";
                                            }
                                            echo $HTML;
                                        ?>
                                        <br/><small class="text-muted"><?=$comment['date']?></small>
                                    </div>
                                    
                                    <div class="detail-content-comment">
                                        <?=nl2br($comment['binhluan'])?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php }?>
                </ul>
                <?php
                    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rate WHERE appid=$aid"))>3){
                ?>
                <div class="text-center mt-2">
                    <form action="<?=$home?>/app-<?=$aid?>/review">
                        <button type="submit" class="btn btn-rounded btn-info">Xem thêm</button>
                    </form>
                </div>
                    <?php } ?>
                            
            </div>
            <div class="line-horizontal"></div>
            <div class="font-weight-bold text-uppercase">
                <h5>Thông tin bổ sung</h5>
            </div>
            <div class="mt-3">
                <div class="row">
                    <div class="col-6">
                        <div class="font-weight-bold">Đã cập nhật</div>
                        <div class="text-muted"><?=date('d-m-Y',strtotime($dataapp['dateupdate']))?></div>
                        <div class="font-weight-bold mt-5">Phiên bản hiện tại</div>
                        <div class="text-muted"><?=$dataapp['ver']?></div>
                    </div>
                    <div class="col-6">
                        <div class="font-weight-bold">Kích thước</div>
                        <div class="text-muted"><?=$dataapp['size']?> kB</div>
                        <div class="font-weight-bold mt-5">Lượt tải</div>
                        <div class="text-muted"><?php
                            $sql = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bought WHERE aid = ".$dataapp['id']));
                            echo $sql;
                        ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-3">
        <div class="mt-2 card shadow">
            <div class="card-header text-info bg-white font-weight-bold">
                Ứng dụng khác của
                <?php
                    $query = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM developer WHERE id='$devid'"));
                    echo $query['name'];
                ?>
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND devid=$devid ORDER BY date DESC LIMIT 5");
                while ($data = mysqli_fetch_array($query)) {
                    if($data['id'] != $aid){
                ?>
                    <a class="text-decoration-none" href="<?=$home?>/app-<?=$data['id']?>">
                        <li class="list-group-item home-item-top">
                            <span><img class="home-item-img-top rounded-circle" src="img/app/<?=($data['icon']!=null) ? $data['icon'] : 'app-default.png'?>"/></span>
                            <span><?= $data['name'] ?></span>
                                <?php
                                ?>
                        </li>
                    </a>
                <?php }} ?>
            </ul>
        </div>
        <div class="mt-2 card shadow">
            <div class="card-header text-info bg-white font-weight-bold">
                <div class="row">
                    <div class="col-6 d-flex justify-content-start">Tương tự</div>
                    <div class="col-6 d-flex justify-content-end">
                        <?php
                            echo "<a href='$home/app/$atype' class='btn btn-success'>Xem thêm</a>";
                        ?>
                    </div>
                </div>
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND type='$atype' ORDER BY date DESC LIMIT 5");
                while ($data = mysqli_fetch_array($query)) {
                    if($data['id'] != $aid){
                ?>
                    <a class="text-decoration-none" href="<?=$home?>/app-<?=$data['id']?>">
                        <li class="list-group-item home-item-top">
                            <span><img class="home-item-img-top rounded-circle" src="img/app/<?=($data['icon']!=null) ? $data['icon'] : 'app-default.png'?>"/></span>
                            <span><?= $data['name'] ?></span>
                        </li>
                    </a>
                <?php }} ?>
            </ul>
        </div>
    </div>
</div>

<?php
    require_once '../config/end.php';
?>

<!-- Modal -->
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buyModalLabel"><span class="spinner-border text-info" role="status"></span> Xác nhận</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Bạn chắc chắn muốn mua <span class="text-info font-weight-bold"><?=$dataapp['name']?></span> với giá <span class="text-danger font-weight-bold"><?= number_format($dataapp['price'])?></span> đ ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button onclick="buyApp(<?=$aid?>,<?=$uid?>,'<?=$tokendown?>')" type="button" class="btn btn-primary">Đồng ý</button>
      </div>
    </div>
  </div>
</div>


<script>addActiveSlideDetail();</script>
