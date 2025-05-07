<?php
require_once __DIR__ . '/../../classes/Events.php';

use events\Events;

$eventsHandler = new Events();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($eventsHandler->vymazanieEventu($id)) {
        header('Location: read_events.php'); // uprav podľa názvu tvojej stránky
        exit();
    } else {
        echo "Chyba pri mazaní eventu.";
    }
} else {
    echo "Neplatné ID.";
}
