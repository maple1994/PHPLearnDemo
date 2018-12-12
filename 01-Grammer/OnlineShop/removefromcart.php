<?php
session_start();
include 'include.php';
doDB();
if (isset($_GET['id'])) {
    $safe_id = mysqli_real_escape_string($mysqli, $_GET['id']);
    $sid = $_COOKIE['PHPSESSID'];
    $sql = "delete from store_shopperstrack where id=" . $safe_id .
        " and session_id='" . $sid ."'";
    $res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    header("Location: showcart.php");
}else {
    header("Location: seestore.php");
    exit;
}
?>