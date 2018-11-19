<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "123456";
$db = "test";
$mysqli = mysqli_connect($servername, $username, $password, $db);
if(mysqli_connect_errno()) {
    printf("Connect failed: %s \n", mysqli_connect_errno());
}else {
    $sql = "CREATE TABLE mptestTable
            (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            testField VARCHAR(75))";
    $res = mysqli_query($mysqli, $sql);
    if ($res === TRUE) {
        echo "Table testTable successfully created.";
    }else {
        printf("could not create table: %s", mysqli_error($mysqli));
    }
    mysqli_close($mysqli);
}

?>