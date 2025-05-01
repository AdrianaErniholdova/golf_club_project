<?php
session_start();
require_once('classes/Users.php');

use users\Users;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginOrEmail = $_POST['member-login-number'];
    $password = $_POST['member-login-password'];

    try {
        $user = new Users();
        $user->login($loginOrEmail, $password);

        if ($_SESSION['rola'] === 'admin') {
            header('Location: admin/edits.php');
        } else {
            header('Location: index.php');
        }
        exit;
    } catch (Exception $e) {
        echo 'Chyba pri prihlasovaní: ' . $e->getMessage();
    }
}
