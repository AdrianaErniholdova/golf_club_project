<?php
require_once __DIR__ . '/../../classes/Reservations.php';

use reservations\Reservations;

$eventsHandler = new Reservations();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($eventsHandler->vymazanieRezervacie($id)) {
        if (isset($_SESSION['rola']) && $_SESSION['rola'] === 'admin') {
            header('Location: ../admin/manage_reservations.php');
        } else {
            header('Location: ../../reservations.php');
        }
        exit();
    } else {
        echo "Failed to delete reservation.";
    }
} else {
    echo "Invalid ID.";
}
