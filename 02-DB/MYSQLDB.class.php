<?php
class MYSQLDB {
    private $link = null;
    //定义一些属性，以存储连接数据库的6项基本信息
    private $host;
    private $port;
    private $user;
    private $pass;
    private $charset;
    private $dbname;
    private static $instance = null;

    static function getInstance($config) {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    private function __clone() {}

    private function __construct($config) {
        $this->host = !(empty($config['host'])) ?
            $config['host'] : '127.0.0.1';
        $this->port = !(empty($config['port'])) ?
            $config['port'] : 3307;
        $this->user = !(empty($config['user'])) ?
            $config['user'] : 'root';
        $this->pass = !(empty($config['pass'])) ?
            $config['pass'] : '123456';
        $this->charset = !(empty($config['$charset'])) ?
            $config['$charset'] : 'utf8';
        $this->dbname = !(empty($config['dbname'])) ?
            $config['dbname'] : 'test';

        $this->link = mysqli_connect("{$this->host}:{$this->port}", $this->user,
            $this->pass);
        if(mysqli_connect_error()) {
            echo mysqli_connect_error();
            exit;
        }

        $this->setCharset($this->charset);
        $this->selectDB($this->dbname);

    }

    public function setCharset($set) {
        mysqli_query($this->link, "set names $set");
    }

    public function selectDB($dbname) {
        mysqli_query($this->link, "use $dbname");
    }

    public function closeDB() {
        mysqli_close($this->link);
    }

    /// 执行一条增删改语句，它可以返回真假结果
    function exec($sql) {
        $result = $this->query($sql);
        return true;
    }

    /// 返回一行数据
    function getOneRow($sql) {
        $result = $this->query($sql);
        $rec = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $rec;
    }

    /// 返回多行数据
    function getRows($sql) {
        $result = $this->query($sql);
        $arr = array();
        while($info = mysqli_fetch_array($result)) {
            array_push($arr, $info);
        }
        mysqli_free_result($result);
        return $arr;
    }

    /// 只获取一个值
    function getOneData($sql) {
        $result = $this->query($sql);
        $row = mysqli_fetch_row($result);
        $data = $row[0];
        mysqli_free_result($result);
        return $data;
    }

    private function query($sql) {
        $result = mysqli_query($this->link, $sql)
        or die(mysqli_error($this->link));
        return $result;
    }
}
?>