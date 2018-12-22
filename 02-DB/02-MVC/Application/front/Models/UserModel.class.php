<?php

/**
 * Created by PhpStorm.
 * User: maple
 * Date: 2018/12/21
 * Time: 下午3:38
 */
class UserModel extends BaseModel
{
    function getAllUser() {
        $arr = $this->_dao->getRows("select * from student");
        return $arr;
    }

    function getUserCount() {
    }

    function getUserInfoById($id) {
        return $this->_dao->getOneRow("select * from student where id=$id");
    }

    function delUserById($id) {
        return $this->_dao->exec("delete from student where id=$id");
    }

    function insertUser($username, $age, $xueli) {
        $sql = "insert into student(user_name, age, edu, reg_time) values(";
        $sql .= "'$username', ";
        $sql .= "$age, ";
        $sql .= "'$xueli', ";
        $sql .= "now())";
        return $this->_dao->exec($sql);
    }

    function updateUser($username, $age, $xueli, $id) {
        $sql = "update student set user_name='" . $username . "', age=" .
        $age . ", edu='" . $xueli . "' where id=$id";
        return $this->_dao->exec($sql);
    }
}