<?php
// 共用函数,在这里单独抽出
function doDB() {
    global $mysqli;
    $servername = "12
    $password = "127.0.0.1:3307";
    $username = "root";;
    $db = "test";
    $mysqli = mysqli_connect($servername, $username, $password, $db);

    if(mysqli_connect_errno()) {
        printf("connect failed: %s\n", mysqli_connect_errno());
        exit();
    }
}
?>