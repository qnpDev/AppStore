<?php
    require_once '../config/head.php';
    if(!isset($_SESSION['user'])){
        die ("<script>location.href='$home/';</script>");
    }
    if($permission !=2){
        die ("<script>location.href='$home/';</script>");
    }
    if(!isset($_GET['id'])){
        die ("<script>location.href='$home/';</script>");
    }
    echo '<title>Admin | Portal</title>';
    if ($permission==2){
        $id = $_GET['id'];
?>

<div class="container">
    <div class="card m-auto shadow">
        <div class="card-header bg-white text-center">
            <h1 class="text-primary text-uppercase">Sửa thể loại</h1>
        </div>
        <div class="card-body">
            <?php
                $query = mysqli_query($conn, "SELECT * FROM type where id=$id");
                $data = mysqli_fetch_assoc($query);
                $type = $data['name'];
            ?>
            <form action="" method="POST">
                <small class="d-flex justify-content-end text-muted">* Thay đổi cả thể loại của các App hiện hữu</small>
                <div class="input-group mb-3">
                    <span class="input-group-text">Kí hiệu</span>
                    <input name="name" type="text" value="<?=$data['name']?>" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Tên thể loại</span>
                    <input name="namedetail" type="text" value="<?=$data['namedetail']?>" class="form-control">
                </div>
                
                <?php
                    if(isset($_POST['save'])){
                        $name = $_POST['name'];
                        $namedetail = $_POST['namedetail'];
                        if($name == "" || $namedetail == ""){
                            echo "<div class='alert alert-danger text-center'>Nhập đầy đủ xem nào!</div>";
                        }else{
                            $dataapp = mysqli_query($conn, "SELECT * FROM app WHERE type='$type'");
                            while ($row = mysqli_fetch_assoc($dataapp)){
                                mysqli_query($conn, "UPDATE app SET type='$name' WHERE type='$type'");
                            }
                            
                            $query = mysqli_query($conn, "UPDATE type SET name='$name', namedetail='$namedetail' WHERE id=$id");
                            if($query){
                                echo "<script>window.location.replace('$home/admin/theloai')</script>";
                            }else{
                                echo "<div class='alert alert-danger text-center'>Error!</div>";
                            }
                        }
                    }
                ?>
                <div class="row">
                    <div class="d-flex justify-content-start col-6">
                        <a href="<?=$home?>/admin/theloai" class="text-decoration-none">
                            <button name="save" type="button" class="btn btn-outline-secondary btn-rounded">Back</button>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end col-6">
                        <button name="save" type="submit" class="btn btn-success btn-rounded">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
    }
    require_once '../config/end.php';
?>

