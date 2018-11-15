<?php
$guessNum = 44;
$num = $_GET["number"];
$tryNum = $_GET["num_tris"];
if (!isset($tryNum)) {
    $tryNum = 1;
}else {
    $tryNum++;
}
$msg = "";
if (!isset($num)) {
    $msg = "Welcome to the guessing machine!";
}else if (!is_numeric($num)) {
    $msg = "no number";
}else if($num == $guessNum) {
    // 重定向
    header("Location: congrats.html");
    exit;
}else if ($num > $guessNum) {
    $msg = "$num too big";
}else if($num < $guessNum) {
    $msg = "$num too small";
}else {
    $msg = "error";
}

?>

<!DOCTYPE html>
<html>
<head>
<title>A php number guessing script</title>
</head>
<body>
<h1><?php echo $msg?></h1>
<p>tryNum---<?php echo $tryNum?></p>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
    <p>Type you guess here:</p>
    <input type="text" id="number" name="number"><br>
    <!--隐藏字段,保存提交数-->
    <input type="hidden" name="num_tris" value="<?php echo $tryNum?>">
    <input type="submit">
</form>

</body>
</html>