<?php
require_once __DIR__ . '/../../classes/Events.php';

use events\Events;

$events = new Events();
$pdo = $events->getConnection();
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php");
exit;
?>