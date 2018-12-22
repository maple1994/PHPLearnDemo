<?php
class BaseModel {
    // 存储数据库工具类的实例对象
    protected $_dao = null;

    function __construct() {
        $config = array(
            'host' => "127.0.0.1",
            'port' => 3307,
            'user' => "root",
            'pass' => "123456",
            'charset' => "utf8",
            'dbname' => "test"
        );
        $this->_dao = MYSQLDB::getInstance($config);
    }
}