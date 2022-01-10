<?php
    require('config/head.php');
    echo '<title>Appstore</title>';
?>

<div class="row">
    <div class="col-12 col-lg-9">
        
        <!-- category app -->
        <?php 
            $sql = mysqli_query($conn, "SELECT * FROM type");
            $listType = array();
            while($data = mysqli_fetch_assoc($sql)){
                array_push($listType, (array)[
                    'name' => $data['name'],
                    'namedetail' => $data['namedetail'],
                ]);
            }
            do{
                $typeRand = array_rand($listType);
                $typeRandName = $listType[$typeRand]['name'];
            }while(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app where status=2 and type='$typeRandName'")) <= 0);
            
            $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE status=2")); 
        ?>
        <div class="m-2 card shadow">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-6 text-dark">
                        <select id="home-page-type" onchange="homePageType()" class="form-select btn btn-light">
                            <?php
                            for ($i = 0; $i < count($listType); $i++) {
                                if ($listType[$i]['name'] === $typeRandName) {
                                    echo "<option value='" . $listType[$i]['name'] . "' selected>" . $listType[$i]['namedetail'] . "</option>";
                                } else {
                                    echo "<option value='" . $listType[$i]['name'] . "'>" . $listType[$i]['namedetail'] . "</option>";
                                }
                            }
                            ?>
                        </select> 
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a id="btn-home-seemore-type" href="<?=$home?>/app/<?=$typeRandName?>" class="btn btn-success">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="row d-inline-flex card-body" id="home-item-type">
                <?php 
                    $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 and type='$typeRandName' ORDER BY dateupdate LIMIT 4");
                    while($data = mysqli_fetch_array($query)){
                ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 home-item-type">
                    <div class="card card-item-home btn">
                        <a class="link-item-home" href="app-<?=$data['id']?>">
                            <img class="card-img-top rounded" src="img/app/<?=($data['icon']!=null) ? $data['icon'] : 'app-default.png'?>" alt="App">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold"><?=$data['name']?></h5>
                                 <p class="card-text index-mota"><?=substr($data['mota'],0,100)."..."?></p>
                            </div>
                            <div class="card-footer">
                                <div class="star-item-home">
                                    <i class="fa fa-star font-weight-bold text-warning" aria-hidden="true"></i>
                                    <span class="text-primary font-weight-bold">
                                        <?php
                                            $query2 = mysqli_query($conn, "SELECT * FROM rate WHERE appid=".$data['id']);
                                            $atotalrate = 0;
                                            $arate = 0;
                                            while ($result = mysqli_fetch_assoc($query2)) {
                                                $atotalrate += 1;
                                                $arate += $result['rate'];
                                            }
                                            $rating = ($atotalrate > 0) ? number_format($arate / $atotalrate,1) : 0;
                                            echo $rating;
                                            ?>
                                    </span>
                                </div>
                                <div class="price-item-home">
                                    <?php if ($data['price']==0){
                                        echo "<i class='fa fa-money text-success font-weight-bold' aria-hidden='true'></i><span class='text-danger font-weight-bold'> Free</span>";
                                    }else{
                                    ?>
                                    <i class="fa fa-money text-success font-weight-bold" aria-hidden="true"></i>
                                    <span class="text-danger font-weight-bold"><?= number_format($data['price'])?></span>
                                    <span class="currency"> đ</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
            
        </div>
        <!-- /category app -->

        <!-- All app -->
        <?php $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM app WHERE status=2")); ?>
        <div class="m-2 card shadow mt-4">
            <div class="card-header bg-white text-dark font-weight-bold">
                <div class="row">
                    <div class="col-6">
                        <h3><a href="app/all" class="text-decoration-none">All App</a></h3>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <select id="home-page-limit" onchange="pageHomeApp(1,<?=$total?>)" class="form-select btn btn-light">
                            <option value="4" selected>4</option>
                                <option value="8">8</option>
                                <option value="20">20</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row d-inline-flex card-body" id="home-item">
                
            </div>
            <div class="card-footer bg-light d-flex justify-content-end">
                <ul class="pagination" id="home-page"></ul>
                
            </div>
            <script>pageHomeApp(1,<?=$total?>)</script>
        </div>
        <!-- /All app -->
    </div>
    <div class="col-12 col-lg-3">
        <div class="m-2 card shadow">
            <div class="card-header bg-white text-dark font-weight-bold">
                <a href="<?=$home?>/app/paidapp" class="text-decoration-none">Top mua nhiều</a>
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid IN (SELECT id FROM app WHERE price>0 AND status = 2) GROUP BY aid ORDER BY count(*) DESC LIMIT 3");
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
                <a href="<?=$home?>/app/freeapp" class="text-decoration-none">Top miễn phí</a>
            </div>
            <ul class="list-group">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM bought WHERE aid IN (SELECT id FROM app WHERE price=0 AND status = 2) GROUP BY aid ORDER BY count(*) DESC LIMIT 3");
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
                            <span><img class="home-item-img-top rounded-circle" src="img/app/<?=($data['icon']!=null) ? $data['icon'] : 'app-default.png'?>"/></span>
                            <span><?= $data['name'] ?></span>
                        </li>
                    </a>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php 
    require('config/end.php');
?>
 