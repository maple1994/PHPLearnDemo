<?php
include 'show_table_fuction.php';
if(!empty($_GET['db']) || !empty($_GET['tb'])) {
    $db = $_GET['db'];
    $tb = $_GET['tb'];
}else {
    echo "没有指定数据库";
    exit;
}
$db = mysqli_connect("127.0.0.1:3307", "root", "123456", $db);
$sql = "select * from $tb";
$res = mysqli_query($db, $sql) or die(mysqli_error($db));

showtable($res);
?>