<?php
require_once __DIR__ . '/../../classes/Events.php';

use events\Events;

$events = new Events();
$pdo = $events->getConnection();

$error = '';
$success = '';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('Chýbajúce ID eventu.');
}

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
    $imagePath = $currentEvent['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../images/';
        $fileName = basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $fileName;
        }
    }

    if ($title && $date && $location && $price && $description) {
        $update = $events->editovanieEventu($id, [
            'title' => $title,
            'date' => $date,
            'location' => $location,
            'price' => $price,
            'description' => $description,
            'image' => $imagePath
        ]);

        if ($update) {
            $success = 'Event bol úspešne upravený.';
            header('Location: manage_events.php');
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

        <form method="POST" action="" enctype="multipart/form-data">
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

            <div class="mb-3">
                <label for="image" class="form-label">Event Image</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </section>

</main>

</body>
</html>