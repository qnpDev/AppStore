<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        die ("<script>location.href='$home/';</script>");
    }
    if($permission !=2){
        die ("<script>location.href='$home/';</script>");
    }
    echo '<title>Admin | Dev Manager</title>';
    if ($permission==2){
?>

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h1 class="text-center text-primary">Developer Manager</h1>
        </div>
        <div class="card-body">
            <div class="col-8">
                <h4 class="text-dark">Danh sách Developer</h4>
            </div>

            <table class="table mt-2 text-center">
                <thead>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>User</th>
                    <th>Action</th>
                </thead>
                <tbody id="listapp-list"></tbody>
            </table>
            <ul class='pagination d-flex justify-content-end' id="page"></ul>
            <script>pageAdminListDev(1);</script>
        </div>
    </div>
</div>

<?php
    }
    require_once '../config/end.php';
?>
