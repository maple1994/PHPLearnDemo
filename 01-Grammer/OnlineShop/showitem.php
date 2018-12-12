<?php
session_start();
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
    <form action="addtocart.php" method="post">
END_OF_TEXT;
    $get_color_sql = "select item_color from store_item_color where item_id=". $item_id;
    $get_color_res = mysqli_query($mysqli, $get_color_sql) or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_color_res) > 0) {
        $display_block .= "<p><label for='sel_item_color'>Available Colors:</label><br>";
        $display_block .= "<select id='sel_item_color' name='sel_item_color'>";
        while($color_info = mysqli_fetch_array($get_color_res)) {
            $color = $color_info["item_color"];
            $display_block .= "<option value='$color'>$color</option>";
        }
        $display_block .= "</select></p>";
    }

    $get_size_sql = "select item_size from store_size where item_id=". $item_id;
    $get_size_res = mysqli_query($mysqli, $get_size_sql) or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_size_res) > 0) {
        $display_block .= "<p><label for='sel_item_size'>Available Sizes:</label><br>";
        $display_block .= "<select id='sel_item_size' name='sel_item_size'>";
        while($size_info = mysqli_fetch_array($get_size_res)) {
            $size = $size_info["item_size"];
            $display_block .= "<option value='$size'>$size</option>";
        }
        $display_block .= "</select></p>";
    }
    $display_block .= "<p><label for='sel_item_qty'>Select Quantity:</label><br>";
    $display_block .= "<select id='sel_item_qty' name='sel_item_qty'>";
    for($i = 1; $i < 11; $i++) {
        $display_block .= "<option value='$i'>$i</option>";
    }
    $display_block .= "</select></p>";
    $display_block .= "<input type='hidden' name='sel_item_id' value='$item_id'>";
    $display_block .= "<button type='submit'>Add to Cart</button>";
    $display_block .= "</form></div>";
    mysqli_close($mysqli);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Show Item Detail</title>
    <style>
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
echo $display_block;
?>
</body>
</html>
