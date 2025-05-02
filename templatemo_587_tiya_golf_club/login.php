<?php
session_start();
require_once('classes/Users.php');

use users\Users;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginOrEmail = $_POST['member-login-number'];
    $password = $_POST['member-login-password'];
    $redirectUrl = $_POST['redirect'] ?? 'index.php';

    try {
        $user = new Users();
        $user->login($loginOrEmail, $password);

        if ($_SESSION['rola'] === 'admin') {
            header('Location: admin/menu.php');
        } else {
            header('Location: ' . $redirectUrl);
        }
        exit;
    } catch (Exception $e) {
        echo 'Chyba pri prihlasovaní: ' . $e->getMessage();
    }
}
