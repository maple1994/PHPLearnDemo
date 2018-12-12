<?php
include 'include.php';
doDB();

$display_block = <<<END_OF_TEXT
<h1>My Store-Item Detail</h1>
<p><em>You rea viewing:</em></p>
END_OF_TEXT;

$item_id = mysqli_real_escape_string($mysqli, $_GET['item_id']);
$sql = "select c.id as cat_id, c.cat_title, s.item_title, s.item_price,
s.item_des, s.item_image from store_items as s left join store_categories as c
on s.cat_id=c.id where s.id=" . $item_id;
$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
if(mysqli_num_rows($res) < 1) {
    $display_block .= "<p>Invalid selected Item.</p>";
}else {
    while($info=mysqli_fetch_array($res)) {
        $cat_id = $info["cat_id"];
        $cat_title = $info["cat_title"];
        $item_title = $info["item_title"];
        $item_price = $info["item_price"];
        $item_desc = $info["item_des"];
        $item_images = $info["item_image"];
    }
    $display_block .= <<<END_OF_TEXT
<p>
    <a href="seestore.php?cat_id=$cat_id">$cat_title</a>>$item_title
</p>
<div style="float:left">
    <img src="$item_images" alt="" width="200px"  height="200px">
</div>
<div style="float:left">
    <p>
        <strong>Description:</strong><br>
        $item_desc
    </p>
    <p><strong>Prices:</strong>$$item_price</p>
END_OF_TEXT;
    $get_color_sql = "select item_color from store_item_color where item_id=". $item_id;
    $get_color_res = mysqli_query($mysqli, $get_color_sql) or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_color_res) > 0) {
        $display_block .= "<p><strong>Available Colors:</strong><br>";
        while($color_info = mysqli_fetch_array($get_color_res)) {
            $color = $color_info["item_color"];
            $display_block .= $color . "<br>";
        }
        $display_block .= "</p>";
    }

    $get_size_sql = "select item_size from store_size where item_id=". $item_id;
    $get_size_res = mysqli_query($mysqli, $get_size_sql) or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_size_res) > 0) {
        $display_block .= "<p><strong>Available Sizes:</strong><br>";
        while($size_info = mysqli_fetch_array($get_size_res)) {
            $size = $size_info["item_size"];
            $display_block .= $size . "<br>";
        }
        $display_block .= "</p>";
    }
    $display_block .= "</div>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Show Item Detail</title>
</head>
<body>
<?php
echo $display_block;
?>
<!--<h1>My Store-Item Detail</h1>-->
<!--<p><em>You rea viewing:</em></p>-->
<!--<p>-->
<!--    <a href="#">HATS</a>>BaseBall hat-->
<!--</p>-->
<!--<div style="float:left">-->
<!--    <img src="images/baseball.jpg" alt="" width="200px"  height="200px">-->
<!--</div>-->
<!--<div style="float:left">-->
<!--    <p>-->
<!--        <strong>Description:</strong><br>-->
<!--        Fancy, low_profile base hat-->
<!--    </p>-->
<!--    <p><strong>Prices:</strong>$12</p>-->
<!--    <p>-->
<!--        <strong>Available Colors:</strong><br>-->
<!--        black<br>-->
<!--        blue<br>-->
<!--        red<br>-->
<!--    </p>-->
<!--    <p>-->
<!--        <strong>Available Sizes:</strong><br>-->
<!--        One Size Fits All-->
<!--    </p>-->
<!--</div>-->
</body>
</html>
