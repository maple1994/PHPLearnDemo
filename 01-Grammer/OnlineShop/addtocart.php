<?php
session_start();
include 'include.php';
doDB();
if(isset($_POST['sel_item_id'])) {
    $safe_item_id = mysqli_real_escape_string($mysqli, $_POST['sel_item_id']);
    $safe_item_qty = mysqli_real_escape_string($mysqli, $_POST['sel_item_qty']);
    $safe_item_size = mysqli_real_escape_string($mysqli, $_POST['sel_item_size']);
    $safe_item_color = mysqli_real_escape_string($mysqli, $_POST['sel_item_color']);

    $sql = "select item_title from store_items where id=" . $safe_item_id;
    $res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    if(mysqli_num_rows($res) < 1) {
        header("Location: seestore.php");
    }else {
        while($info = mysqli_fetch_array($res)) {
            $item_title = $info["item_title"];
        }
        $session_id = $_COOKIE['PHPSESSID'];
        $add_cart_sql = "insert into store_shopperstrack(
        session_id, sel_item_id, sel_item_qty, sel_item_size, sel_item_color, date_added)
        values('". $session_id ."',
        $safe_item_id,
        $safe_item_qty,
        '". $safe_item_size ."',
        '". $safe_item_color ."', now())";
        $add_cart_res = mysqli_query($mysqli, $add_cart_sql) or die(mysqli_error($mysqli));
        header("Location:showcart.php");
    }
}else {
    header("Location: seestore.php");
}
?>