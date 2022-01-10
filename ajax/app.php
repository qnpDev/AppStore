<?php
    include '../config/conn.php';
    if(!isset($_POST['type']))
        die("Error");
    
    session_start();
    if($_POST['type'] == 'buyAppAgain'){
        $aid = $_POST['aid'];
        $query = mysqli_query($conn, "SELECT * FROM app WHERE id = $aid");
        $dataa = mysqli_fetch_array($query);
        $token = $_POST['token'];
        $_SESSION['download_fie'][$token] = $dataa['file'];
        die($token);
            //die($dataa['file']);
           
    }
    
    
    if($_POST['type'] == 'buyAppFree'){
        $aid = $_POST['aid'];
        $uid = $_POST['uid'];

        $selectuid = "SELECT * FROM users WHERE id = $uid";
        $selectaid = "SELECT * FROM app WHERE id = $aid";
        $query = mysqli_query($conn, $selectuid);
        $datau = mysqli_fetch_array($query);
        $query = mysqli_query($conn, $selectaid);
        $dataa = mysqli_fetch_array($query);
        $query = mysqli_query($conn, "SELECT * FROM bought WHERE uid=$uid AND aid=$aid");
        
        $sql = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bought WHERE uid = $uid AND aid = $aid"));
        if ($sql > 0){
            $token = $_POST['token'];
            $_SESSION['download_fie'][$token] = $dataa['file'];
            die($token);
        }

        if($datau['money'] < $dataa['price']){
            die("0");
        }
        if($datau['money'] >= $dataa['price']){
            $query = mysqli_query($conn, "INSERT INTO bought(uid,aid) VALUES ($uid,$aid)");
            $token = $_POST['token'];
            $_SESSION['download_fie'][$token] = $dataa['file'];
            die($token);
            //die($dataa['file']);
           
        }
    }
    
    
    
    include "PHPMailer-master/src/PHPMailer.php";
    include "PHPMailer-master/src/Exception.php";
    include "PHPMailer-master/src/OAuth.php";
    include "PHPMailer-master/src/POP3.php";
    include "PHPMailer-master/src/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    if($_POST['type'] == 'buyApp'){
        $aid = $_POST['aid'];
        $uid = $_POST['uid'];
        $selectuid = "SELECT * FROM users WHERE id = $uid";
        $selectaid = "SELECT * FROM app WHERE id = $aid";
        $query = mysqli_query($conn, $selectuid);
        $datau = mysqli_fetch_array($query);
        $query = mysqli_query($conn, $selectaid);
        $dataa = mysqli_fetch_array($query);
        $query = mysqli_query($conn, "SELECT * FROM bought WHERE uid=$uid AND aid=$aid");

        $sql = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bought WHERE uid = $uid AND aid = $aid"));
        if ($sql > 0){
            $token = $_POST['token'];
            $_SESSION['download_fie'][$token] = $dataa['file'];
            die($token);
        }
        
        if($datau['money'] < $dataa['price']){
            die("0");
        }
        if($datau['money'] >= $dataa['price']){
            
            $to = $datau['email'];
            $name = ($datau['name']!="") ? $datau['name'] : $datau['username'];
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
                $mail->addAddress("$to", "$name");     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo('npq171@gmail.com', 'NPQ');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                
                $namea = $dataa['name'];
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Buy Successful';
                $mail->Body    = "<center>
                        <h1 style='color: red;'>Mua thành công $namea</h1>
                        <p>Please click button or link to $namea</p>
                        <a href='$home/app-$aid'>
                        <button type='submit'>Go to $namea</button>
                        </a>
                        </br>
                        <h4>Or</h4>
                        <p><a href='$home/app-$aid'>
                        <b>$home/app-$aid</b>
                        </a></p>
                        </center>";
                $mail->AltBody = "Bạn đã mua ".$dataa['name']." thành công: $home/app-$aid";

                $mail->send();
            } catch (Exception $e) {
            }
            
            mysqli_query($conn, "INSERT INTO bought(uid,aid) VALUES ($uid,$aid)");
            $tien = $dataa['price'];
            $devid = $dataa['devid'];
            mysqli_query($conn, "UPDATE users SET money = (money+$tien) WHERE id = $devid");
            mysqli_query($conn, "UPDATE users SET money = (money-$tien) WHERE id = $uid");
            
            $token = $_POST['token'];
            $_SESSION['download_fie'][$token] = $dataa['file'];
            die($token);
            
            //die($dataa['file']);
           
        }
    }