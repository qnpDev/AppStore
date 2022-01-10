<?php
    require_once '../config/head.php';

    if(!isset($_SESSION['user'])){
        require_once "../error/login.php";
    }else{
    $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHeRE username='$user'"));
    $pid = $data['id'];
    echo '<title>Nạp tiền</title>';
?>
    <div class="container m-auto">
        <div class="card shadow">
            <div class="card-header bg-white text-info text-center">
                <h1 class="font-weight-bold">Nạp tiền</h1>
            </div>
            <div class="card-body pb-1">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success"><i class="fa fa-key text-white" aria-hidden="true"></i></span>
                    </div>
                    <input id="naptien-mathe" name="text" type="text" class="form-control" placeholder="Nhập mã thẻ">
                </div>
                <div class="mt-3">
                    <div id="naptien-err" class="d-none alert">Error</div>
                    <button onclick="naptien(<?=$uid?>)" type="button" class="btn float-right login_btn bg-primary text-white">Nạp thẻ ngay</button>
                </div>

            </div>
            <div class="line-horizontal"></div>
            <div class="card-body pt-2">
                <h4 class="text-primary font-weight-bold">Lịch sử giao dịch</h4>
                <div class="mt-2">
                    <ul class="list-group">
                        <table class="table text-center">
                            <thead>
                                <th>STT</th>
                                <th>Mã thẻ</th>
                                <th>Mệnh giá</th>
                                <th>Date</th>
                            </thead>
                            <?php 
                                $stt = 0;
                                $query = mysqli_query($conn, "SELECT * FROM cardhistory WHERE uid=$uid ORDER BY date DESC");
                                while ($data = mysqli_fetch_assoc($query)){
                                    $stt++;
                            ?>
                                <tr>
                                    <td><?=$stt?></td>
                                    <td><?=$data['mathe']?></td>
                                    <td><?=$data['menhgia']?></td>
                                    <td><?=$data['date']?></td>
                                </tr>
                                <?php } ?>
                        </table>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
    }
    require_once '../config/end.php';
?>

