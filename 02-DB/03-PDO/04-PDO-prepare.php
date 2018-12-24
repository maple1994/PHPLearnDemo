<?php
$dbms = 'mysql';
$host = "localhost:3307";
$dbname = 'test';
$user = 'root';
$pwd = '123456';
$dsn = "$dbms:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $user, $pwd);

$sql = "select * from product where chandi=:v1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":v1", '美国');
$stmt->execute();
$arr = $stmt->fetch();
var_dump($arr);

echo "<hr>";
$sql1 = "select * from product";
$stmt1 = $pdo->query($sql1);
//$stmt1->execute();
$arr1 = $stmt1->fetch();
var_dump($arr1);