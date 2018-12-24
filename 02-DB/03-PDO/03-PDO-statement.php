<?php
$dbms = 'mysql';
$host = "localhost:3307";
$dbname = 'test';
$user = 'root';
$pwd = '123456';

$dsn = "$dbms:host=$host;dbname=$dbname";

$pdo = new PDO($dsn, $user, $pwd);
$sql = "select * from product";
$res = $pdo->query($sql);
var_dump($res);
echo "<br>";
foreach($res as $row) {
    echo "<br>";
    print $row['pro_name'] . '  ';
    print $row['chandi'] . '  ';
    print $row['pinpai'] . '  ';
}