<?php
//$v1 = 1;
//$v2 = 'abc';
//$v3 = false;
//$v4 = array(41, 42, 43);

//$str1 = serialize($v1);
//$str2 = serialize($v2);
//$str3 = serialize($v3);
//$str4 = serialize($v4);

$str1 = file_get_contents('./file1.txt');
$str2 = file_get_contents('./file2.txt');
$str3 = file_get_contents('./file3.txt');
$str4 = file_get_contents('./file4.txt');

$v1 = unserialize($str1);
$v2 = unserialize($str2);
$v3 = unserialize($str3);
$v4 = unserialize($str4);
var_dump($v1);
var_dump($v2);
var_dump($v3);
var_dump($v4);
?>