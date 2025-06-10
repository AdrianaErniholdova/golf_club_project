<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/classes/Users.php');

use users\Users;

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($username) || empty($email) || empty($password)) {
    $_SESSION['error'] = 'All fields are required.';
    header('Location: ../index.php#register');
    exit;
}

try {
    $user = new Users();
    $success = $user->register($username, $email, $password);

    if (!$success) {
        $_SESSION['register_error'] = 'User with that name or email already exists.';
    } else {
        $_SESSION['register_success'] = 'Registration successful. You can now log in.';
    }
    header('Location: ../index.php#register');
    exit;
} catch (Exception $e) {
    $_SESSION['register_error'] = 'An error occurred during registration.';
    header('Location: ../index.php#register');
    exit;
}



