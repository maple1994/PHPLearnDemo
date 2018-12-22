<?php

/**
 * Created by PhpStorm.
 * User: maple
 * Date: 2018/12/21
 * Time: 下午3:41
 */
class UserController extends BaseController
{
    function indexAction() {
        $obj_user = ModelFactory::M('UserModel');
        $data1 = $obj_user->getAllUser();
        include  VIEW_PATH . 'showAllUser.html';
    }

    function showFormAction() {
        include VIEW_PATH . 'form_view.html';
    }

    function addUserAction() {
        $name = $_POST['username'];
        $age = $_POST['age'];
        $xueli = $_POST['xueli'];
        $obj_user = ModelFactory::M('UserModel');
        $obj_user->insertUser($name, $age, $xueli);
        $this->gotoUrl('添加成功!', '?c=User', 1);
    }

    function editAction() {
        $id = $_GET['id'];
        $obj_user = ModelFactory::M('UserModel');
        $data = $obj_user->getUserInfoById($id);
        include VIEW_PATH . 'user_form_view.html';
    }

    function delUserAction() {
        $id = $_GET['id'];
        $obj_user = ModelFactory::M('UserModel');
        $obj_user->delUserById($id);
        $this->gotoUrl('删除成功!', '?c=User', 1);
    }

    function showUserInfoAction() {
        $id = $_GET['id'];
        $obj_user = ModelFactory::M('UserModel');
        $data = $obj_user->getUserInfoById($id);
        include VIEW_PATH . 'userinfo.html';
    }

    function updateUserAction() {
        $name = $_POST['username'];
        $age = $_POST['age'];
        $xueli = $_POST['xueli'];
        $id = $_POST['id'];
        $obj_user = ModelFactory::M('UserModel');
        $obj_user->updateUser($name, $age, $xueli, $id);
        $this->gotoUrl('添加成功!', '?c=User', 1);
    }

}