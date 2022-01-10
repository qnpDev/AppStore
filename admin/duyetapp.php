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
    <div class="card shadow">
        <div class="card-header bg-white">
            <h1 class="text-center text-primary">App Manager</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="text-dark">Danh sách ứng dụng</h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-end">
                        <a href="<?=$home?>/dev/create">
                            <button type="button" class="btn btn-success">Thêm mới</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <h4 class="text-muted d-flex justify-content-end">Thể loại:</h4>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <select id="change-type" class="btn btn-light" onchange="changeAdminDuyetType()">
                            <option selected value="all">Tất cả</option>
                            <?php 
                                $query = mysqli_query($conn, "SELECT * FROM type");
                                while($data = mysqli_fetch_assoc($query)){
                            ?>
                            <option value="<?=$data['name']?>"><?=$data['namedetail']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <table class="table mt-2 text-center">
                <thead>
                    <th>ID</th>
                    <th>Icon</th>
                    <th>Tên</th>
                    <th>Thể loại</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody id="listapp-list"></tbody>
            </table>
            <ul class='pagination d-flex justify-content-end' id="page"></ul>
            <script>pageAdminDuyetListApp(1,'all');</script>
        </div>
    </div>
</div>


<?php
    }
    require_once '../config/end.php';
?>
