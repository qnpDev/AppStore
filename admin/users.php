<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        die ("<script>location.href='$home/';</script>");
    }
    if($permission !=2){
        die ("<script>location.href='$home/';</script>");
    }
    echo '<title>Admin | User Manager</title>';
    if ($permission==2){
?>

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h1 class="text-center text-primary">User Manager</h1>
        </div>
        <div class="card-body">
            <div class="col-8">
                <h4 class="text-dark">Danh sách thành viên</h4>
            </div>

            <table class="table mt-2 text-center">
                <thead>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Permission</th>
                    <th>Action</th>
                </thead>
                <tbody id="listapp-list"></tbody>
            </table>
            <ul class='pagination d-flex justify-content-end' id="page"></ul>
            <script>pageAdminListUsers(1);</script>
        </div>
    </div>
</div>

<?php
    }
    require_once '../config/end.php';
?>
