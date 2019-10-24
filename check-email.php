<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

$email = $_POST['email'];
$userModel = new Users();
$result = $userModel->findEMail($email);
echo count($result);