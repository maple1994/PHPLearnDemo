<?php
include 'include.php';
doDB();
$sql = "select * from store_categories";
$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

$display_block = <<<END_OF_TEXT
<h1>My Categories</h1>
<p>select a category to see its items.</p>
END_OF_TEXT;

while($info = mysqli_fetch_array($res)) {
    $title = $info["cat_title"];
    $des = $info["cat_des"];
    $cat_id = $info["id"];
    $display_block .= <<<END_OF_TEXT
<p>
    <strong>
        <a href="$_SERVER[PHP_SELF]?cat_id=$cat_id">$title</a>
    </strong>
    <br>
    $des
</p>
END_OF_TEXT;
    if (isset($_GET['cat_id']) && $_GET['cat_id'] == $cat_id) {
        $sql2 = "select * from store_items where cat_id=" . $cat_id;
        $res2 = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
        if(mysqli_num_rows($res2) < 1) {
            $display_block .= "<p>no items in this category</p>";
        }else {
            $display_block .= "<ul>";
            while($info2 = mysqli_fetch_array($res2)) {
                $item_title = $info2["item_title"];
                $item_price = $info2["item_price"];
                $item_id = $info2["id"];
                $display_block .= "<li><a href='showitem.php?item_id=$item_id'>$item_title</a>(\$$item_price)</li>";
            }
            $display_block .= "</ul>";
        }
    }
}
mysqli_close($mysqli);
mysqli_free_result($res);

?>
<!DOCTYPE html>
<html>
<head>
    <title>See Store</title>
</head>
<body>
<?php echo $display_block;?>
<!--<h1>My Categories</h1>-->
<!--<p>select a category to see its items.</p>-->

<!--<p>-->
<!--    <strong>-->
<!--        <a href="#">Books</a>-->
<!--    </strong>-->
<!--    <br>-->
<!--    Paperback, hardback, books for school or paly.-->
<!--</p>-->
</body>
</html>
