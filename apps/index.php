<?php
    require('../config/head.php');
    echo '<title>Apps</title>';
    $limit = 10;
    
?>

<div class="row">
    <div class="col-12 col-lg-9">
        
       
        <!-- All app -->
        <?php 
            if (isset($_GET['type'])){
                $typeSelected = $_GET['type'];
                $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND type='$typeSelected'"));
            }else{
                $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE status=2")); 
            }
        ?>
        <div class="m-2 card shadow mt-4">
            <div class="card-header bg-white text-dark font-weight-bold">
                <div class="row">
                    <div class="col-6 text-uppercase text-info">
                        <h3>
                            <?php 
                                if(isset($_GET['type'])){
                                    $sql = mysqli_query($conn, "SELECT namedetail FROM type WHERE name='$typeSelected'");
                                    $name = mysqli_fetch_assoc($sql);
                                    echo $name['namedetail'];
                                }else{
                                    echo "All App";
                                }
                            ?>
                        </h3>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <?php 
                            if(isset($_GET['type'])){
                                echo "<select id='home-page-limit' onchange='appsPageType(1,$total,\"" . $typeSelected . "\")' class='form-select btn btn-light'>";
                            }else{
                                echo "<select id='home-page-limit' onchange='appsPage(1,$total)' class='form-select btn btn-light'>";
                            }
                        ?>
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
            

            <?php
                if (isset($_GET['type'])){
                    echo "<script>appsPageType(1,$total,'$typeSelected')</script>";
                }else{
                    echo "<script>appsPage(1,$total)</script>";
                }
            ?>
        </div>
        <!-- /All app -->
    </div>
    <div class="col-12 col-lg-3">
        <div class="m-2 card shadow">
            <div class="card-header bg-white text-dark font-weight-bold">
                Top mua nhiều
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid IN (SELECT id FROM app WHERE price>0 AND status = 2) GROUP BY aid ORDER BY count(*) DESC LIMIT 5");
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
                Top miễn phí
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid IN (SELECT id FROM app WHERE price=0 AND status = 2) GROUP BY aid ORDER BY count(*) DESC LIMIT 5");
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
                New apps
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 ORDER BY date DESC LIMIT 3");
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
 