<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once('../classes/Database.php');

use database\Database;

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

if (empty($name) || empty($email) || empty($message)) {
    $_SESSION['contact_error'] = 'All fields are required!';
    header('Location: ../index.php#contact');
    exit;
}

try {
    $db = (new Database())->getConnection();

    $sql = "INSERT INTO kontaktny_formular (name, email, message) VALUES (:name, :email, :message)";
    $stmt = $db->prepare($sql);

    $ulozene = $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':message' => $message
    ]);

    if ($ulozene) {
        $_SESSION['contact_success'] = 'Your message has been successfully sent.';
        header('Location: ../index.php#contact');
        exit;
    } else {
        $_SESSION['contact_error'] = 'Error sending message to database.';
        header('Location: ../index.php#contact');
        exit;
    }
} catch (Exception $e) {
    $_SESSION['contact_error'] = 'An error occurred while sending your message.';
    header('Location: ../index.php#contact');
    exit;
}
?>