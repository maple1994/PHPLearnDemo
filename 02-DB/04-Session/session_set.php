<?php
include 'session_override.php';

session_start();

$_SESSION['new_key'] = 'new_value';
$_SESSION['num'] = serialize(25);
$_SESSION['num2'] = 233;