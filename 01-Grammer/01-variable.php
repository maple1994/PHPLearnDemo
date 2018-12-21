<?php



//function __autoload($class_name) {
//    require_once '../02-DB/' . $class_name . '.class.php';
//}

include '../02-DB/MYSQLDB.class.php';

spl_autoload_register('autoload1');

function autoload1($class_name) {
    echo "<br>准在在autoload1加载函数 $class_name<br>";
    $filename = '../02-DB/' . $class_name . '.class.php';
    if (file_exists($filename)) {
        require_once $filename;
        echo $filename . "<br>";
    }else {
        echo "文件不存在";
    }

}

$db = MYSQLDB::getInstance();
var_dump($db);
$db1 = clone $db;
var_dump($db1);
?>