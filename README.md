# 记录PHP学习之路
## 一、变量
### 1.1、8种标准数据类型
* Boolean
* Integer
* Float或Double
* String
* Object 类的一个实例
* Array 键和值的一个有序集合
* Resource 对一个第三方资源(如数据库)的引用
* NULL 一个未初始化的变量

### 1.2、超全局变量
* $_GET 包含了GET方法提供给一个脚本的任何变量
* $_POST 包含了POST方法提供给一个脚本的任何变量
* $_COOKIE 包含了通过cookie提供给一个脚本的任何变量
* $_FILES 包含了通过文件上传提供给一个脚本的任何变量
* $_SERVER 包含了像标头、文件路径和脚本位置等信息
* $_ENV 包含了作为服务器环境的一部分提交给一个脚本的人变量
* $_REQUEST 包含了通过GET、POST或COOKIE输入机制提供给一个脚本的任何变量
* $_SESSION 包含了在一个会话中当前注册的任何变量

### 1.3、改变变量类型
* settype(变量, 要转换的类型, 'string, boolean')
* (类型)变量

```php
<?php
echo "hello world <br>";
$tmp = 3.14;
echo $tmp . " is Double " . is_double($tmp) . "<br>";
echo $tmp . " is Double " . is_double($tmp) . "<br>";
echo $tmp . " is String " . is_string((string)$tmp) . "<br>";
settype($tmp, 'string');
echo $tmp . " is String " . is_string($tmp) . "<br>";
?php>
```php

### 1.4、常量
定义常量的语法

```
define(变量名, 赋值, 是否区分大小写)
```

例子:

```
<?php
define("THE_YEAR", 2018);
echo THE_YEAR;

define("THE_YEAR_1", 2018, true);
echo the_year_1;
?php>
```