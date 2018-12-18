<?php
$mysqli = mysqli_connect("127.0.0.1:3307", "root", "123456");
$sql = "show databases";
$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
while($info = mysqli_fetch_array($res)) {
    $database = $info[0];
    $str = $database;
    $str .= "\t\t<a href='tables.php?db=$database'>查看数据库</a>" . "<br>";
    echo $str;
}
?>