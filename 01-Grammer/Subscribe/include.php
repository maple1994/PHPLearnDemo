<?php
// 共用函数,在这里单独抽出
function doDB() {
    global $mysqli;
    $servername = "127.0.0.1:3307";
    $username = "root";
    $password = "123456";
    $db = "test";
    $mysqli = mysqli_connect($servername, $username, $password, $db);

    if(mysqli_connect_errno()) {
        printf("connect failed: %s\n", mysqli_connect_errno());
        exit();
    }
}

function emailChecker($email) {
    global $mysqli, $safe_mail, $check_res;
    // 检测email不在列表中
    $safe_mail = mysqli_real_escape_string($mysqli, $email);
    $check_sql = "select id from subscribers where email='" . $safe_mail . "'";
    $check_res = mysqli_query($mysqli, $check_sql) or die(mysqli_error($mysqli));
}

?>