<?php
    session_start();
    if (!isset($_SESSION['user'])){
        die("Bạn phải đăng nhập trước");
    }else if(empty($_GET['file'])){
        die("Error");
    }else if(empty($_SESSION['download_fie'][$_GET['file']])){
        die("Error Token");
    }else{
        $name = $_SESSION['download_fie'][$_GET['file']];
        $fileDir = __DIR__ . '/files/';
        $filePath = $fileDir . $name;
        
        if (!file_exists($filePath)){
            die("File không tồn tại");
        }else{
            header("Content-Description: File Transfer");
            header("Content-TYPE: application/octet-stream");
            header('Content-Disposition: attachment; filename="'. basename($filePath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length ' . filesize($filePath));
            flush();
            readfile($filePath);
            die;
        }
    }

