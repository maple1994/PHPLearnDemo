<?php
$path = "/Users/maple/Desktop/data.db";
// 1.file_exists检查文件的存在性
if (file_exists($path)) {
    echo "exists" . "<br>";
}else {
    echo "don't exists" . "<br>";
}

// 2.文件还是目录
if (is_file($path)) {
    echo "is File" . "<br>";
}
if (!is_dir($path)) {
    echo "not dir" . "<br>";
}

// 3.检查文件状态
if (is_readable($path)) {
    echo "readable" . "<br>";
}
if (is_writeable($path)) {
    echo "writeable" . "<br>";
}
if (is_executable($path)) {
    echo "executable" . "<br>";
}

// 4.filesize()确定文件的大小
echo "filesize: " . filesize($path) . "<br>";

// 5.fileatime()获取文件的修改日期
$atime = fileatime($path);
echo date("D d M Y g:i A", $atime) . "<br>";

// 6.创建并删除文件
//touch ('/Users/maple/Desktop/123.txt');
//unlink('/Users/maple/Desktop/123.txt');

// 7.打开一个文件写入,读取,添加
// 写
//fopen("/Users/maple/Desktop/123.txt", "w");
// 读
//fopen("/Users/maple/Desktop/123.txt", "r");
// 文本末位添加
//fopen("/Users/maple/Desktop/123.txt", "a");

// 8 .fgets()和feof()从一个文件读取行, fgetc()读取一个字符
$file = "/Users/maple/Desktop/123.txt";
$fp = fopen($file, "r") or die("couldn't open $file");
while(!feof($fp)) {
    $line = fgets($fp);
//    $line = fgetc($fp);
    echo $line . "<br>";
}

// 9.fread()指定读取量, fseek()移动文件
$fp1 = fopen($file, "r") or die("couldn't open $file");
$fsize = filesize($file);
$halfway = (int)($fsize / 2);
echo "halfway point: " . $halfway . "<br>";
fseek($fp1, $halfway);
$chunk = fread($fp1, ($fsize - $halfway));
echo $chunk . "<br>";

// 10.file_get_contents(filename, use_include_path, context, offset, maxlen) 读取文本内容
// use_include_path 布尔值,标明函数是否应该搜索文件名的完整include_path
// context stream_context_create()的上下文资源
// offset 读取从哪里开始
// maxlen 去读数据的最大长度,以字节为单位
$content = file_get_contents($file);
echo $content . "<br>";

// 11.fwrite()或fputs()写入文件
$fp2 = fopen($file, "a") or die("couldn't open $file");
fwrite($fp2, "hello world1\n");
fputs($fp2, "hello world2\n");
fclose($fp2);

// 12.file_put_contens(),直接模拟调用了fopen,fwrite,fclose写入文件
// 13.flock锁定文件
// 整数参数:
// LOCK_SH 共享
// LOCK_EX 独占
// LOCK_UN 释放
$fp2 = fopen($file, "a") or die("couldn't open $file");
flock($fp2, LOCK_EX);
flock($fp2, LOCK_UN);

// 14.目录操作
// mkdir()创建目录
// rmdir()删除目录
// opendir()打开目录以供读取
// readdir()从一个目录读取内容
?>















