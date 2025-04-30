<?php

require_once('../classes/Database.php');

use database\Database;

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

if (empty($name) || empty($email) || empty($message)) {
    die('Chyba: Všetky polia sú povinné!');
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
    die('Chyba pri odosielaní správy do databázy!');
}
?>