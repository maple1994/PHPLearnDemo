<?php
include 'session_override.php';

session_start();

echo $_SESSION['new_key'] . "<br>";
echo $_SESSION['num'] . "<br>";
echo unserialize($_SESSION['num'] ). "<br>";
echo $_SESSION['num2'] . "<br>";