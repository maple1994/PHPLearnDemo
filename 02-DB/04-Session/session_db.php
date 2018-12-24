<?php

$pdo;
/**
 * 读操作需要的函数
 * @param string $sess_id 当前会话的session-ID
 * @return string 当前session数据区内容
 */
//PHPsession机制调用：sessRead('已经确定好的session-ID');
function sessRead($sess_id) {
    echo '<br>READ<br>';
    global $pdo;
    $sql = "select sess_content from session where sess_id='$sess_id'";
    $res = $pdo->query($sql);
    $row = $res->fetch();
    if ($row) {
        return $row['sess_content'];
    }else {
        return '';
    }

}

/**
 * 写操作用到的函数
 * @param string $sess_Id session_ID
 * @param string $sess_content 处理好（序列化）的session数据
 * @return bool，写入结果
 */
function sessWrite($sess_id, $sess_content) {
    echo '<br>WRITE<br>';
    global $pdo;
    $sql = "replace into session values ('$sess_id', '$sess_content', unix_timestamp())";
    return $pdo->query($sql);
}

/**
 * 删除对应的session数据，在用户强制执行了session_destory()时
 * @param  string $sess_id
 * @return bool          删除结果
 */
function sessDelete($sess_id) {
    echo '<br>DELETE<br>';
    global $pdo;
    // 删除操作
    $sql = "delete from session where sess_id='$sess_id'";
    return $pdo->query($sql);
}

/**
 * 垃圾回收，有几率执行！
 * @param int $maxlifetime 最大有效期
 * @return [type] [description]
 */
function sessGC($maxlifetime) {
    echo '<br>GC<br>';
    global $pdo;
    // 最后写入时间 < 当前时间-最大有效期
    $sql = "delete from session where last_write < unix_timestamp()-$maxlifetime";
    return $pdo->query($sql);
}

function sessBegin() {
    echo '<br>Begin<br>';
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=127.0.0.1:3307;dbname=test', 'root', '123456');
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo->query('set names utf8');
    $pdo->query('use test');
}

function sessEnd() {
    echo '<br>END<br>';
    return true;
}

//session_set_save_handler('sessBegin', 'sessEnd',
//    'sessRead', 'sessWrite', 'sessDelete', 'sessGC');
//ini_set('session.save_handler', 'user');

// 设置session存储处理器函数
session_set_save_handler(
    'sessBegin', 'sessEnd', 'sessRead', 'sessWrite', 'sessDelete', 'sessGC'
);
ini_set('session.save_handler', 'user');

?>