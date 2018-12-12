<?php
session_start();
include 'include.php';
doDB();

$session_id = $_COOKIE['PHPSESSID'];
$sql = "select si.item_title, si.item_price, st.id, st.sel_item_qty,
st.sel_item_size, st.sel_item_color from store_shopperstrack as st left join
store_items as si on si.id=st.sel_item_id where st.session_id='" . $session_id . "'";
$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
$display_block = "<h1>Youe shopping Cart</h1>";
if(mysqli_num_rows($res) < 1) {
    $display_block .= "<p>You have items in your cart.
Please <a href='seestore.php'>continue to shop</a></p>";
}else {
    $display_block .= <<<END_OF_TEXT
<table>
    <tr>
        <th>Title</th>
        <th>Size</th>
        <th>Color</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total Price</th>
        <th>Action</th>
    </tr>
END_OF_TEXT;
    while($info = mysqli_fetch_array($res)) {
        $title = $info["item_title"];
        $size = $info["sel_item_size"];
        $color = $info["sel_item_color"];
        $price = $info["item_price"];
        $qty = $info["sel_item_qty"];
        $st_id = $info["id"];
        $total_price = sprintf("%.2f", $price * $qty);
        $display_block .= <<<END_OF_TEXT
<tr>
        <td>$title</td>
        <td>$size</td>
        <td>$color</td>
        <td>$price</td>
        <td>$qty</td>
        <td>$total_price</td>
        <td><a href="removefromcart.php?id=$st_id">remove</a></td>
    </tr>
END_OF_TEXT;
    }
    $display_block .= "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Show Cart</title>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
            border: 1px solid black;
            border-collapse: collapse;
            padding:6px;
            background: #ccc;
            font-weight: bold;
            text-align: center;
        }
        td {
            border: 1px solid black;
            padding:6px;
            vertical-align: top;
            text-align: center;
        }
    </style>
</head>
<body>
<?php echo $display_block;?>
</body>
</html>