<?php
require_once __DIR__ . '/../../classes/Events.php';

use events\Events;

$events = new Events();
$pdo = $events->getConnection();

$error = '';
$success = '';

// Získanie ID eventu z URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die('Chýbajúce ID eventu.');
}

// Načítanie existujúceho eventu pre zobrazenie vo formulári
$currentEvent = $events->getEventById($id);
if (!$currentEvent) {
    die('Event neexistuje.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $location = $_POST['location'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';

    if ($title && $date && $location && $price && $description) {
        $update = $events->editovanieEventu($id, [
            'title' => $title,
            'date' => $date,
            'location' => $location,
            'price' => $price,
            'description' => $description
        ]);

        if ($update) {
            $success = 'Event bol úspešne upravený.';
            // Môžeš aj redirect: header("Location: read_events.php");
        } else {
            $error = 'Nepodarilo sa upraviť event.';
        }
    } else {
        $error = 'Všetky polia sú povinné.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<body>
<main>

    <section class="container mt-5">
        <h2>Add New Event</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="title" class="form-label">Event Title</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Event Date</label>
                <input type="date" class="form-control" name="date" id="date" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" name="location" id="location" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Ticket Price</label>
                <input type="number" class="form-control" name="price" id="price" required step="0.01">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Event Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </section>

</main>

</body>
</html>