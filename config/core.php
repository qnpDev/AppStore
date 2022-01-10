<?php
    require_once 'conn.php';
    
    $permission_title = [
            2 => "<div class='text-danger font-weight-bold'><i class='fa fa-rocket' aria-hidden='true'></i> Administrator</div>",
            1 => "<div class='text-primary'><i class='font-weight-bold fa fa-code' aria-hidden='true'></i> Developer</div>",
            0 => "<div class='text-secondary'><i class='fa fa-angle-double-right font-weight-bold' aria-hidden='true'></i> Member</div>"
        ];
    
    if(isset($_SESSION['user'])){ 
        $user = $_SESSION['user'];
        $dataUser = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHeRE username='$user'"));

        // permission //
        $permission = $dataUser['permission'];

        $per = $permission_title[$permission];
    }
    
    

?>
    
