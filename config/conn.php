<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "qnp";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db)
        or die("Connect failed");
$conn->query("SET NAMES 'utf8'");

$sql = mysqli_query($conn, "SELECT * FROM config");
while($data = mysqli_fetch_array($sql)){
    if ($data['id']=='home')
        $home = $data['value'];
    if ($data['id']=='name')
        $namepage = $data['value'];
    if ($data['id']=='icon')
        $homeicon = $data['value'];
    if ($data['id']=='faviicon')
        $homefavi = $data['value'];
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

