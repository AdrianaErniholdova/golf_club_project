<?php
require_once '../classes/Reservations.php';

use reservations\Reservations;

if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];
    $reservations = new Reservations();

    if ($reservations->cancelReservation($reservation_id)) {
        header("Location: ../reservations.php");
    } else {
        echo "Failed to cancel reservation.";
    }
} else {
    echo "Invalid request.";
}
?>