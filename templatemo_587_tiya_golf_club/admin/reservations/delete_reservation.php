<?php
require_once __DIR__ . '/../../classes/Reservations.php';

use reservations\Reservations;

$eventsHandler = new Reservations();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($eventsHandler->vymazanieRezervacie($id)) {
        header('Location: manage_reservations.php');
        exit();
    } else {
        echo "Chyba pri mazaní eventu.";
    }
} else {
    echo "Neplatné ID.";
}
