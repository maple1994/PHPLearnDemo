<?php

/**
 * Created by PhpStorm.
 * User: maple
 * Date: 2018/12/21
 * Time: 下午3:13
 */
class BaseController
{
    function __construct()
    {
        header("content-type:text/html; charset=utf-8");
    }

    function gotoUrl($msg, $url, $time=3) {
        echo "<p color=red>$msg</p>";
        echo "<br /><a href='$url'>返回</a>";
        echo "<br />页面将在{$time}秒之后自动跳转。";
        header("refresh: $time;  url=$url");	//自动定时跳转功能
    }
}