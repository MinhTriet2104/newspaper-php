<?php
session_start();
require_once './config/Database.php';
require_once './config/config.php';
// require_once './app/models/Users.php';
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['email'] = $email;

// Them library
require 'vendor/autoload.php';
use Mailgun\Mailgun;

// Tao 6 so ngau nhien
$validation = mt_rand(100000, 999999);
$_SESSION['validation'] = $validation;

# First, instantiate the SDK with your API credentials
$mg = Mailgun::create('d0dba86922bb65987542b2231511c31e-2dfb0afe-f77c1cee');

if($mg->messages()->send('sandboxda45f9b4c9094acd84355fe1b989be96.mailgun.org', [
  'from'    => 'callie@sandboxda45f9b4c9094acd84355fe1b989be96.mailgun.org',
  'to'      => "$email",
  'subject' => 'Email validation',
  'html'    => "<h1>Hi $username,</h1><p>Your Validation code: <b>$validation<b></p>"
])) {
  header("location:validation.php");
}