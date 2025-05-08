<?php

require_once('../classes/Database.php');

use database\Database;

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

if (empty($name) || empty($email) || empty($message)) {
    die('All fields are required!');
}

$db = (new Database())->getConnection();

$sql = "INSERT INTO kontaktny_formular (name, email, message) VALUES (:name, :email, :message)";
$stmt = $db->prepare($sql);

$ulozene = $stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':message' => $message
]);

if ($ulozene) {
    header('Location: ../index.php');
    exit;
} else {
    http_response_code(500);
    die('Error sending message to database!');
}
?>