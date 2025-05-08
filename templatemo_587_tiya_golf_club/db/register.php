<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/classes/Users.php');

use users\Users;

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Overenie údajov
if (empty($username) || empty($email) || empty($password)) {
    die('All fields are required!');
}

// Uloženie správy do databázy
try {
    $user = new Users();
    $user->register($username, $email, $password);
    return header('Location: ../index.php');
} catch (Exception $e) {
    die($e->getMessage());
}


