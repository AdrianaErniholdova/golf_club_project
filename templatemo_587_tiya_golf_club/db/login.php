<?php
session_start();
require_once('../classes/Users.php');

use users\Users;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginOrEmail = $_POST['member-login-number'];
    $password = $_POST['member-login-password'];
    $redirectUrl = '../index.php';

    try {
        $userObj = new Users();
        $user = $userObj->login($loginOrEmail, $password);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['rola'] = $user['rola'];

        if ($_SESSION['rola'] === 'admin') {
            header('Location: ../admin/menu.php');
        } else {
            header('Location: ' . $redirectUrl);
        }
        exit;
    } catch (Exception $e) {
        header('Location: ' . $redirectUrl . '?error=1');
        exit;
    }
}
