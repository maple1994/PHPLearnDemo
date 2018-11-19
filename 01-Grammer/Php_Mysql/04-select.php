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
    mysqli_query($mysqli, $sql);
    $sql = "select * from mptestTable";
    $res = mysqli_query($mysqli, $sql);
    if ($res) {
        while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $id = $newArray['id'];
            $testField = $newArray['testField'];
            echo "$id -- $testField" . "<br>";
        }
    }else {
        printf("error: %s", mysqli_error($mysqli));
    }
    mysqli_free_result($res);
    mysqli_close($mysqli);
}

?>