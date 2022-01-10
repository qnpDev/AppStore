<?php
    require_once '../config/head.php';
    if (!isset($_SESSION['user'])){
        require_once '../error/permission.php';
        require '../config/end.php';
        die;
    }
    if (isset($_GET['id'])){
        $pid = $_GET['id'];
        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHeRE id='$pid'"));
    }else{
        if(!isset($_SESSION['user'])){
            die;
        }
        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHeRE username='$user'"));
        $pid = $data['id'];
    }
    echo '<title>App Bought of '.$data['username'].'</title>';
?>

<div class="container">
    <div class="card">
        <div class="card-header bg-white text-info">
            <h4>Bought</h4>
        </div>

        <div class="card-body">
            <table class="table text-center">
                <thead>
                    <th>Icon</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Date</th>
                </thead>
                <tbody id="list">
                    <tr></tr>
                </tbody>
                
            </table>
            <div class="text-center" id="page"></div>
        </div>
        <?php
            $sql = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bought WHERE uid = $pid"));
        ?>
        <script>pageListBought(1,<?=$pid?>,<?=$sql?>)</script>
    </div>
</div>

<?php
    require_once '../config/end.php';
?>