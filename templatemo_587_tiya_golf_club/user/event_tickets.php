<?php
session_start();
require_once '../classes/Database.php';

use database\Database;

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $userId = $_SESSION['user_id'];
    $eventId = $_POST['event_id'];

    try {
        $db = new Database();
        $pdo = $db->getConnection();

        $checkStmt = $pdo->prepare("SELECT * FROM event_tickets WHERE user_id = ? AND event_id = ?");
        $checkStmt->execute([$userId, $eventId]);

        if ($checkStmt->rowCount() > 0) {
            echo "You already have a ticket.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO event_tickets (user_id, event_id) VALUES (?, ?)");
            $stmt->execute([$userId, $eventId]);

            header("Location: ../events.php");
            exit;
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
