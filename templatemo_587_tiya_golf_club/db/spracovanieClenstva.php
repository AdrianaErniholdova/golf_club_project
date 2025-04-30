<?php

require_once('../classes/Database.php');

use database\Database;

$fullname = $_POST["full-name"];
$email2 = $_POST["email"];
$comment = $_POST["message"];

if (empty($fullname) || empty($email2) || empty($comment)) {
    die('Chyba: Všetky polia sú povinné!');
}

$db = (new Database())->getConnection();

$sql = "INSERT INTO clenstvo_formular (full_name, email, comment)  VALUES (:fullname, :email2, :comment)";
$stmt = $db->prepare($sql);

$ulozene = $stmt->execute([
    ':fullname' => $fullname,
    ':email2' => $email2,
    ':comment' => $comment
]);

if ($ulozene) {
    header('Location: ../index.php');
    exit;
} else {
    http_response_code(500);
    die('Chyba pri odosielaní správy do databázy!');
}
?>