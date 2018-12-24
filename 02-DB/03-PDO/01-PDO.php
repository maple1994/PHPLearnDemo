<?php
$dbms = 'mysql';
$host = "localhost:3307";
$dbname = 'test';
$user = 'root';
$pwd = '123456';

$dsn = "$dbms:host=$host;dbname=$dbname";

try {
    /*
    DSN = "mysql：host=服务器地址/名称；port=端口号；dbname=数据库名";
    Options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>’set names utf8’);
    $pdo = new pdo(DSN, "用户名", "密码", Options);
    */
    $pdo = new PDO($dsn, $user, $pwd);
    echo '连接成功' . '<br>';
    $sql = 'select * from student';
    $res = $pdo->query($sql);
    var_dump($res);
}catch(PDOException $e) {
    die('Error: ' . $e->getMessage());
}