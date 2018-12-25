<?php
class Session
{
    /* 操作数据库的db对象 */
    private $_db = null;

    /**
     *  构造函数，连接数据库使用
     *
     *  @access public
     */
    public function __construct()
    {
//        echo '<br>construct<br>';
    }

    /**
     *  开始session机制时自动调用，即调用session_start()后马上回调该函数
     *
     *  @param string $sessionSavePath session文件的存储路径
     *  @param string $sessionName 默认为PHPSESSID
     *  @return boolan
     *  @access public
     */
    public function open($sessionSavePath, $sessionName)
    {
        /* 我们也可以在这里连接数据库 */
//        echo '<br>Begin<br>';
        $this->_db = new PDO('mysql:host=127.0.0.1:3307;dbname=test', 'root', '123456');
        return true;
    }

    /**
     *  在脚本执行完毕后，在write回调之后，进行调用
     *
     *  @access public
     *  @return boolean
     */
    public function close()
    {
//        echo '<br>Close<br>';
        $this->_db = null;
        return true;
    }

    /**
     *  开启session机制后自动调用，在open回调之后马上调用
     *
     *  @param string $sessionID
     *  @return String
     *  @access public
     */
    public function read($sessionID)
    {
//        echo '<br>READ<br>';
        $sql = "select sess_content from session where sess_id='$sessionID'";
        $res = $this->_db->query($sql);
        $row = $res->fetch();
        if ($row) {
            return $row['sess_content'];
        }else {
            return '';
        }
    }

    /**
     *  当脚本执行完毕后，回调该函数
     *
     *  @param $sessionID string
     *  @param string $sessionData 要保存的session数据
     *  @return mixed
     *  @access public
     */
    public function write($sessionID, $sessionData)
    {
//        echo '<br>WRITE<br>';
        $sql = "replace into session values ('$sessionID', '$sessionData', current_timestamp)";
        return $this->_db->query($sql);
    }

    /**
     *  当调用session_destory()函数的时候，对该函数进行回调
     *
     *  @param string $sessioinID
     *  @return boolean
     *  @access public
     */
    public function destory($sessionID)
    {
//        echo '<br>DELETE<br>';
        // 删除操作
        $sql = "delete from session where sess_id='$sess_id'";
        return $this->_db->query($sql);
    }

    /**
     *  session的垃圾回收机制，当session数据超过了静默时间，按照概率删除 默认概率：1/1000
     *
     *  @param $maxliefttime 静默时间，默认为1440秒
     *  @access public
     *  @return boolean
     */
    public function gc($maxlifetime)
    {
        echo '<br>GC<br>';
        // 最后写入时间 < 当前时间-最大有效期
        $sql = "delete from session where last_write < unix_timestamp()-$maxlifetime";
        return $this->_db->query($sql);
    }
}
$session = new Session();
session_set_save_handler(
    array($session, 'open'),
    array($session, 'close'),
    array($session, 'read'),
    array($session, 'write'),
    array($session, 'destory'),
    array($session, 'gc')
);
