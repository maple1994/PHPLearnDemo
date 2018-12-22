<?php

$p = !empty($_GET['p']) ? $_GET['p'] : "front";
define('PLAT', $p);
// DIRECTORY_SEPARATOR表示“目录分隔符”， unix / win \
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);
define('APP', ROOT . 'Application' . DS);
define('FRAMEWORK', ROOT . 'Framework' . DS);
define('PLAT_PATH', APP . PLAT . DS);
define('CTRL_PATH', PLAT_PATH . 'Controllers' . DS);
define('MODEL_PATH', PLAT_PATH . 'Models' . DS);
define('VIEW_PATH', PLAT_PATH . 'Views' . DS);


//require FRAMEWORK . 'MYSQLDB.class.php';
//require FRAMEWORK . 'BaseModel.class.php';
//require FRAMEWORK . 'ModelFactory.class.php';
//require FRAMEWORK . 'BaseController.class.php';
//require CTRL_PATH . 'UserController.class.php';
//require CTRL_PATH . 'ProductController.class.php';
//require MODEL_PATH . 'UserModel.class.php';
//require MODEL_PATH . 'ProductModel.class.php';

function __autoload($class) {
    $base_class = array('MYSQLDB', 'BaseModel', 'ModelFactory', 'BaseController');
    if (in_array($class, $base_class)) {
        require FRAMEWORK . $class . '.class.php';
    }else if (substr($class, -5) == 'Model') {
        require MODEL_PATH . $class . '.class.php';
    }else if (substr($class, -10) == 'Controller') {
        require CTRL_PATH . $class . '.class.php';
    }
}



$c = !empty($_GET['c']) ? $_GET['c'] : "User";
$a = !empty($_GET['a']) ? $_GET['a'] : "index";

$controller_name = $c . "Controller";
$vc = new $controller_name();
$action = $a . "Action";
$vc->$action();

?>