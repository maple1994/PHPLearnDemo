<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "123456";
$db = "test";
$mysqli = mysqli_connect($servername, $username, $password, $db);
if(mysqli_connect_errno()) {
    printf("Connect failed: %s \n", mysqli_connect_errno());
}else {
    printf("Host information: %s\n", mysqli_get_host_info($mysqli));
}

//$servername = "127.0.0.1:3307";
//$username = "root";
//$password = "123456";
//$db = "test";
//
//try {
//    $conn = new PDO("mysql:host=$servername;", $username, $password);
//    echo "连接成功";
//}catch (PDOException $e) {
//    echo $e->getMessage();
//}
?>