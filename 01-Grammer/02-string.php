<?php
$str = "Hello world!";
// 1.strlen获取长度
echo strlen($str) . "<br>";

// 2.strstr获取子串,
// 查找 "world" 在 "Hello world!" 中是否存在，如果是，返回该字符串及后面剩余部分：
echo strstr($str, "world") . "<br>";

// 3.strpos找到子字符串的位置
echo strpos($str, "world") . "<br>";

// 4.substr(字符串,开始的位置,长度)提取一个字符串的一部分
echo substr($str, 3) . "<br>";
echo substr($str, -6) . "<br>";
echo substr($str, 3, 2) . "<br>";

// 5.strtok分解一个字符串
$test = "http://www.google.com/search?";
$test .= "hl=en&ie=utf-8&q=php+development+books&btnG=Google+search";
$delims = "?&";
$word = strtok($test, $delims);
while(is_string($word)) {
    if ($word) {
        echo $word . "<br>";
    }
    // 这里不再传$test参数
    $word = strtok($delims);
}

// 6.trim去除字符串首尾的空格, ltrim去掉首的空格
$txt = "\t\tlots of room to breathe        ";
echo "<pre>$txt</pre>";
$txt = ltrim($txt);
echo "<pre>$txt</pre>";

// 7.strip_tags(文本,保留的HTML标本集合)删除标记,不带HTML格式的显示字符串
$str1 = "<p>\"I <em>simply</em> will not have it, \" <br>said Mr Dean.</p><p><strong>The end.</strong></p>";
echo $str1;
echo strip_tags($str1, "<br><p>");

// 8.substr_replace(要修改的字符串, 需要添加给它的文本, 开始索引, 替换的长度)替换一个字符串的一部分
echo substr_replace($str, "111", 7, 3) . "<br>";

// 9.str_replace(查找的字符, 替换的字符, 主字符串)替换子字符串
$str2 = "the 2010 guide to 2010 <br>";
echo str_replace("2010", "2012", $str2);

// 10.转换大小写strtoupper(), strtolower()
echo strtoupper("abcd<br>");
echo strtolower("ABCD<br>");

// 11.所有单词的首字母大写ucwords()
echo ucwords("my name is abc<br>");

// 12.首字母大写ucfirst()
echo ucfirst("my name is abc<br>");

// 13.nl2br(), \n -> <br>
$str3 = "one line\n";
$str3 .= "two line\n";
$str3 .= "three line\n";
echo nl2br($str3);

// 14.wordwrap()
$str4 = "Given a long line, wrodwarp() is useful as a means of ";
$str4 .= "breaking it into a column and thereby making it easier to read ";
$str4 .= "breaking it into a column and thereby making it easier to read ";
$str4 .= "breaking it into a column and thereby making it easier to read";
//echo wordwrap($str4);
echo wordwrap($str4, 24, "\n<br>");

// 15.explode(分割符, 字符串)分解字符串
$date = "2018-09-10";
$dateArr = explode("-", $date);
var_dump($dateArr);
?>
















