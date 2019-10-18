<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

$username = $_POST['username'];
$userModel = new UserModel();
$result = $userModel->findUsername($username);
echo count($result);