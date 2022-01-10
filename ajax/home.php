<?php
    include '../config/conn.php';
    if(isset($_REQUEST["pageHome"])){
        $page = $_REQUEST["pageHome"];
        $limit = $_REQUEST["limit"];
        $start = ($page - 1) * $limit;
        $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 ORDER BY dateupdate DESC LIMIT $start,$limit");
        
        if(mysqli_num_rows($query) > 0){
            while($data = mysqli_fetch_assoc($query)){
                ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 home-item">
                    <div class="card card-item-home btn">
                        <a class="link-item-home" href="<?=$home?>/app-<?=$data['id']?>">
                            <img class="card-img-top rounded" src="<?=$home?>/img/app/<?=($data['icon']!=null) ? $data['icon'] : 'app-default.png'?>" alt="App">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold"><?=$data['name']?></h5>
                                <p class="card-text index-mota"><?=substr($data['mota'],0,100)."..."?></p>
                            </div>
                            <div class="card-footer">
                                <div class="star-item-home">
                                    <i class="fa fa-star font-weight-bold text-warning" aria-hidden="true"></i>
                                    <span class="text-primary font-weight-bold">
                                            <?php
                                            $query2 = mysqli_query($conn, "SELECT * FROM rate WHERE appid=" . $data['id']);
                                            $atotalrate = 0;
                                            $arate = 0;
                                            while ($result = mysqli_fetch_assoc($query2)) {
                                                $atotalrate += 1;
                                                $arate += $result['rate'];
                                            }
                                            $rating = ($atotalrate > 0) ? number_format($arate / $atotalrate, 1) : 0;
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
                <?php
            }
        }else{
            echo "Không tìm thấy kết quả nào";
        }
        
    }


    if(isset($_REQUEST["pageType"])){
        $page = $_REQUEST["pageType"];
        $limit = $_REQUEST["limit"];
        $type = $_REQUEST["typeSelected"];
        $start = ($page - 1) * $limit;
        $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND type = '$type' ORDER BY dateupdate DESC LIMIT $start,$limit");
        
        if(mysqli_num_rows($query) > 0){
            while($data = mysqli_fetch_assoc($query)){
                ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 home-item">
                    <div class="card card-item-home btn">
                        <a class="link-item-home" href="<?=$home?>/app-<?=$data['id']?>">
                            <img class="card-img-top rounded" src="<?=$home?>/img/app/<?=($data['icon']!=null) ? $data['icon'] : 'app-default.png'?>" alt="App">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold"><?=$data['name']?></h5>
                                <p class="card-text index-mota"><?=substr($data['mota'],0,100)."..."?></p>
                            </div>
                            <div class="card-footer">
                                <div class="star-item-home">
                                    <i class="fa fa-star font-weight-bold text-warning" aria-hidden="true"></i>
                                    <span class="text-primary font-weight-bold">
                                            <?php
                                            $query2 = mysqli_query($conn, "SELECT * FROM rate WHERE appid=" . $data['id']);
                                            $atotalrate = 0;
                                            $arate = 0;
                                            while ($result = mysqli_fetch_assoc($query2)) {
                                                $atotalrate += 1;
                                                $arate += $result['rate'];
                                            }
                                            $rating = ($atotalrate > 0) ? number_format($arate / $atotalrate, 1) : 0;
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
                <?php
            }
        }else{
            echo "Không tìm thấy kết quả nào";
        }
        
    }

    if(isset($_REQUEST["pageDev"])){
        $page = $_REQUEST["pageDev"];
        $limit = 4;
        $id = $_REQUEST["id"];
        $start = ($page - 1) * $limit;
        $query = mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND devid = $id ORDER BY dateupdate DESC LIMIT $start,$limit");
        
        if(mysqli_num_rows($query) > 0){
            while($data = mysqli_fetch_assoc($query)){
                ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 home-item">
                    <div class="card card-item-home btn">
                        <a class="link-item-home" href="<?=$home?>/app-<?=$data['id']?>">
                            <img class="card-img-top rounded" src="<?=$home?>/img/app/<?=($data['icon']!=null) ? $data['icon'] : 'app-default.png'?>" alt="App">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold"><?=$data['name']?></h5>
                                <p class="card-text index-mota"><?=substr($data['mota'],0,100)."..."?></p>
                            </div>
                            <div class="card-footer">
                                <div class="star-item-home">
                                    <i class="fa fa-star font-weight-bold text-warning" aria-hidden="true"></i>
                                    <span class="text-primary font-weight-bold">
                                            <?php
                                            $query2 = mysqli_query($conn, "SELECT * FROM rate WHERE appid=" . $data['id']);
                                            $atotalrate = 0;
                                            $arate = 0;
                                            while ($result = mysqli_fetch_assoc($query2)) {
                                                $atotalrate += 1;
                                                $arate += $result['rate'];
                                            }
                                            $rating = ($atotalrate > 0) ? number_format($arate / $atotalrate, 1) : 0;
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
                <?php
            }
        }else{
            echo "Không tìm thấy kết quả nào";
        }
        
    }
    
    if(!isset($_POST['type']))
        die;
    
    if($_POST['type'] == "typeChange"){
        $typeChange = $_POST['typeChange'];
        
        $sql = mysqli_query($conn, "SELECT * FROM app WHERE status=2 AND type='$typeChange' ORDER BY dateupdate DESC LIMIT 4");
        $array = array();
        while ($data = mysqli_fetch_array($sql)) {
            $query = mysqli_query($conn, "SELECT * FROM rate WHERE appid=" . $data['id']);
            $atotalrate = 0;
            $arate = 0;
            while ($result = mysqli_fetch_assoc($query)) {
                $atotalrate += 1;
                $arate += $result['rate'];
            }
            $rating = ($atotalrate > 0) ? number_format($arate / $atotalrate, 1) : 0;
            array_push($array, (object) [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'mota' => substr($data['mota'], 0, 100) . "...",
                        'rate' => $rating,
                        'price' => number_format($data['price']),
                        'icon' => ($data['icon'] != null) ? $data['icon'] : 'app-default.png'
            ]);
        }

        echo json_encode($array);
        
    }