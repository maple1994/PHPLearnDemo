<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "123456";
$db = "test";
$mysqli = mysqli_connect($servername, $username, $password, $db);
if(mysqli_connect_errno()) {
    printf("Connect failed: %s \n", mysqli_connect_errno());
}else {
    $sql = "INSERT INTO mptestTable (testField) VALUES('some value')";
    $res = mysqli_query($mysqli, $sql);
    if ($res === TRUE) {
        echo "successfully inserted.";
    }else {
        printf("error: %s", mysqli_error($mysqli));
    }
    mysqli_close($mysqli);
}

?>