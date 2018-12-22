<?php

/**
 * Created by PhpStorm.
 * User: maple
 * Date: 2018/12/21
 * Time: 下午3:38
 */
class ProductModel extends BaseModel {
    function getAllProduct() {
        $res = $this->_dao->getRows("select * from product");
        return $res;
    }

    function delProductById($id) {
        return $this->_dao->exec("delete from product where id=" . $id);
    }
}