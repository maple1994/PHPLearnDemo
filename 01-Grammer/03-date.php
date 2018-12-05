<?php


echo "true"+100 . "<br>";
echo $a . "<br>";
//将以下数据转成布尔型
//“abc”   “true”  200  NULL
//“”    “0”    0     -90
//计算以下式子
//“100px”+”100”
//“.109”+100
//“true”+100


// 1.time() 获取时间戳
echo time() . "<br>";

// 2.getdate()转换时间戳
$dateArr = getdate();
foreach ($dateArr as $key=>$value) {
    echo "$key => $value<br>";
}

// 3.date()转换一个时间戳
$time = time();
echo date("m/d/y G:i:s e", $time) . "<br>";
echo "today is" . date("jS \of F Y, \a\\t g:ia \i\n e", $time) . "<br>";

// 4.使用mktime()创建时间戳
$ts = mktime(25, 34, 0, 1, 1, 2018);
echo date("m/d/t G:i:s e", $ts) . "<br>";
echo "today is" . date("jS \of F Y, \a\\t g:ia \i\n e", $ts) . "<br>";

// 5.checkdate()测试日期
echo checkdate(4, 5, 1066) . "<br>";
?>