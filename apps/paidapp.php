<?php
    require('../config/head.php');
    echo '<title>Apps</title>';
    $limit = 10;
?>

<div class="row">
    <div class="col-12 col-lg-9">
        
       

        <?php 
            
            $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND price>0")); 

        ?>
        <div class="m-2 card shadow mt-4">
            <div class="card-header bg-white text-dark font-weight-bold">
                <div class="row">
                    <div class="col-6 text-uppercase text-info">
                        <h3>List Paid
                        </h3>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <select id='home-page-limit' onchange='appsPaidPage(1,<?=$total?>)' class='form-select btn btn-light'>
                            <option value="10" selected=>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row d-inline-flex card-body" id="home-item">
                
            </div>
            <div class="card-footer bg-light d-flex justify-content-end">
                <ul class="pagination" id="home-page"></ul>
                
            </div>
            <script>appsPaidPage(1,<?=$total?>)</script>
        </div>
        <!-- /All app -->
    </div>
    <div class="col-12 col-lg-3">
        <div class="m-2 card shadow">
            <div class="card-header bg-white text-dark font-weight-bold">
                Top có phí
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid IN (SELECT id FROM app WHERE price>0) GROUP BY aid ORDER BY count(*) DESC LIMIT 5");
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
        <div class="m-2 card shadow">
            <div class="card-header bg-white text-dark font-weight-bold">
                New paid app 
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND price>0 ORDER BY date DESC LIMIT 3");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <a class="text-decoration-none" href="<?=$home?>/app-<?=$data['id']?>">
                        <li class="list-group-item home-item-top">
                            <span><img class="home-item-img-top rounded-circle" src="<?=$home?>/img/app/<?=($data['icon']!=null) ? $data['icon'] : 'app-default.png'?>"/></span>
                            <span><?= $data['name'] ?></span>
                        </li>
                    </a>
                <?php } ?>
            </ul>
        </div>

    </div>
</div>



<?php 
    require('../config/end.php');
?>
