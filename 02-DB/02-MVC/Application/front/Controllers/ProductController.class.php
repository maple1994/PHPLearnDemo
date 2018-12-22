<?php

/**
 * Created by PhpStorm.
 * User: maple
 * Date: 2018/12/21
 * Time: 下午3:41
 */
class ProductController extends BaseController
{
    function indexAction() {
        $obj = ModelFactory::M('ProductModel');
        $data = $obj->getAllProduct();
        include './Application/front/Views/product_list.html';
    }

    function delAction() {
        $id = $_GET['id'];
        $obj = ModelFactory::M('ProductModel');
        $res = $obj->delProductById($id);
        $this->gotoUrl('删除成功!', '?c=Product&a=index', 1);
    }
}