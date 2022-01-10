<?php
    include '../config/conn.php';
    if(!isset($_POST['type']))
        die("Error");
    
    // Login //
    if ($_POST['type']==1){
        
        //$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $query->bind_param('ss',$username,$password);
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $query->execute();
        $result = $query->get_result();
        
        if (mysqli_num_rows($result)){
            session_start();
            $_SESSION['user'] = $username;
            if($_POST["remember"]==true) 
                setcookie("user_login",$username,time()+ (10 * 365 * 24 * 60 * 60),"/");
            die('1');
        } else {
            die('0');
        }
        $query->close();
    }
    
    // regis //
    if ($_POST['type']==2){
        
        $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $query->bind_param('s',$_POST['username']);
        $query->execute();
        $result = $query->get_result();
        $query->close();
        if(mysqli_num_rows($result) > 0){
            die("0");
        }
        
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param('s',$_POST['email']);
        $query->execute();
        $result = $query->get_result();
        $query->close();
        if(mysqli_num_rows($result) > 0){
            die("1");
        }
        
        $insert = $conn->prepare("INSERT INTO users(id,username,password,email) VALUES (NULL, ?, ?, ?)");
        $insert->bind_param('sss',$user,$pass,$email);
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $email = $_POST['email'];
        $insert->execute();
        $insert->close();
        setcookie("user_login",$user,time()+10,"/");
            die('2');
        
    }
    
    // password change //
    if ($_POST['type']==4){
        $id = $_POST['uid'];
        $pold = md5($_POST['pold']);
        $pnew = md5($_POST['pnew']);
        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));
        if ($pold == $data['password']){
            $query = $conn->prepare("UPDATE users SET password = ? where id = $id");
            $query->bind_param('s',$pnew);
            $query->execute();
            $result = $query->get_result();
            $query->close();
            session_start();
            session_destroy();
            die('1'); // success
        }else{
            die('0'); //sai pass
        }
    }
    
    //recovery pass//
    if ($_POST['type']==5){
        $id = $_POST['uid'];
        $pass = md5($_POST['pass']);
        $query = $conn->prepare("UPDATE users SET password = ? where id = $id");
        $query->bind_param('s',$pass);
        $query->execute();
        $result = $query->get_result();
        $query->close();
        mysqli_query($conn, "DELETE FROM forgottoken WHERE uid = $id");
        die('1');
    }
    
    
    // nap tien //
    if ($_POST['type']=='naptien'){
        $id = $_POST['uid'];
        $mathe = $_POST['mathe'];
        
        $query = $conn->prepare("SELECT * FROM card WHERE mathe=?");
        $query->bind_param('s',$mathe);
        $query->execute();
        $result = $query->get_result();
        $query->close();
        
        if(mysqli_num_rows($result)>0){
            $datathe = mysqli_fetch_assoc($result);
            $menhgia = $datathe['menhgia'];
            mysqli_query($conn, "DELETE FROM card WHERE mathe = '$mathe'");
            mysqli_query($conn, "INSERT INTO cardhistory(mathe,uid,menhgia) VALUES ('$mathe',$id,$menhgia)");
            mysqli_query($conn, "UPDATE users SET money = (money+$menhgia) WHERE id=$id");
            die("1");
        }
        die('0');
        
    }
    
    // forgot //
    include "PHPMailer-master/src/PHPMailer.php";
    include "PHPMailer-master/src/Exception.php";
    include "PHPMailer-master/src/OAuth.php";
    include "PHPMailer-master/src/POP3.php";
    include "PHPMailer-master/src/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    // forgot //
    if ($_POST['type']==3){
        
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param('s',$_POST['email']);
        $query->execute();
        $result = $query->get_result();
        $query->close();
        $datau = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)>0){
            
            $uid = $datau['id'];
            $token = md5($uid.time());
            $timestamp = date('Y-m-d H:i:s');
            mysqli_query($conn, "INSERT INTO forgottoken(uid,token,date) VALUES ($uid,'$token','$timestamp')");
            $to = $_POST['email'];
            $uname = ($datau['name']!="") ? $datau['name'] : $datau['username'];
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'quinguyen1701@gmail.com';                 // SMTP username
                $mail->Password = '20051999';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('quinguyen1701@gmail.com', 'NPQ');
                $mail->addAddress("$to", "$uname");     // Add a recipient
                $mail->addReplyTo('npq171@gmail.com', 'NPQ');

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Rescovery Password';
                $mail->Body    = "<center>
                        <h1 style='color: red;'>Rescovery</h1>
                        <p>Please click button or link to rescovery</p>
                        <a href='$home/forgot/$token'>
                        <button type='submit'>Go to rescovery</button>
                        </a>
                        </br>
                        <h4>Or</h4>
                        <p><a href='$home/forgot/$token'>
                        <b>$home/forgot/$token</b>
                        </a></p>
                        </center>";
                $mail->AltBody = "Please click the link to rescovery: $home/forgot?recovery=$token";

                $mail->send();
                echo '1';
            } catch (Exception $e) {
                echo '0';
            }

        }else{
            die('2');
        }
    }
