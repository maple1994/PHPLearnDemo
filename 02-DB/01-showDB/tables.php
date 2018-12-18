<?php
if(!empty($_GET['db'])) {
    $db = $_GET['db'];
}else {
    echo "没有指定数据库";
    exit;
}
$mysqli = mysqli_connect("127.0.0.1:3307", "root", "123456", $db);
$sql = "show tables";
$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
while($info = mysqli_fetch_array($res)) {
    $tb = $info[0];
    $str = $tb;
    $str .= "\t\t<a href='table_struct.php?tb=$tb&db=$db'>查看结构</a>\t";
    $str .= "\t\t<a href='table_data.php?tb=$tb&db=$db'>查看数据</a>\t" . "<br>";
    echo $str;
}
?>