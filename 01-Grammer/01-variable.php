<?php
/*
超全局变量
$_GET 包含了GET方法提供给一个脚本的任何变量
$_POST 包含了POST方法提供给一个脚本的任何变量
$_COOKIE 包含了通过cookie提供给一个脚本的任何变量
$_FILES 包含了通过文件上传提供给一个脚本的任何变量
$_SERVER 包含了像标头、文件路径和脚本位置等信息
$_ENV 包含了作为服务器环境的一部分提交给一个脚本的人变量
$_REQUEST 包含了通过GET、POST或COOKIE输入机制提供给一个脚本的任何变量
$_SESSION 包含了在一个会话中当前注册的任何变量
*/
/*
测试一个变量的类型
is_null()
is_int()
is_xx()
*/
/*
改变变量类型
1、settype(变量, 要转换的类型, 'string, boolean')
2、(类型)变量
*/
define("THE_YEAR", 2018);
echo THE_YEAR;

define("THE_YEAR_1", 2018, true);
echo the_Year_1;
?>