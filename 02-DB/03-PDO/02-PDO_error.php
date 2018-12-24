<?php
$dbms = 'mysql';
$host = "localhost:3307";
$dbname = 'test';
$user = 'root';
$pwd = '123456';

$dsn = "$dbms:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $pwd);
    $sql = 'select * from studentffff';
    $res = $pdo->exec($sql);
    if ($res == false) {
        echo "<p>发生错误:";
        echo "<br>错误代号: " . $pdo->errorCode();
        echo "<br>错误信息: " . $pdo->errorInfo()[2] . "</p>";
    }
}catch(PDOException $e) {
    die('Error: ' . $e->getMessage());
}
//下面，让pdo对象“进入”异常模式，以处理出错信息：
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    $res = $pdo->query("delteeee from student");
}catch(PDOException $e) {
    echo "<p>发生错误：";
    echo "<br />错误代号：" . $e->GetCode();	//获取该错误的对象的错误代号
    echo "<br />错误信息：" . $e->GetMessage();	//获取该错误的对象的错误提示
}