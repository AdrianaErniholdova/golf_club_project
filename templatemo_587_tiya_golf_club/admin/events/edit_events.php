<?php
require_once __DIR__ . '/../../classes/Events.php';
include_once __DIR__ . '/../../config/functions.php';

use events\Events;

$events = new Events();
$id = $_GET['id'] ?? die('Missing event id.');
$currentEvent = $events->getEventById($id) ?: die('Event does not exist.');
$selectedNumber = $_POST['image_number'] ?? '01';
$imageFileName = 'event' . $selectedNumber . '.jpg';
$currentImageNumber = getImageNumber($currentEvent['image']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $id,
        'title' => $_POST['title'] ?? '',
        'date' => $_POST['date'] ?? '',
        'location' => $_POST['location'] ?? '',
        'price' => $_POST['price'] ?? '',
        'description' => $_POST['description'] ?? '',
        'image' => $imageFileName,
    ];
    $events->editovanieEventu($id, $data);
    header('Location: manage_events.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php  $file_path = "../../parts/head.php";
if(!include($file_path)) {
    echo"Failed to include $file_path";} ?>
<body>
<main>
    <section class="container mt-5">
        <h2 class="text-center mb-4">Edit Event #<?= htmlspecialchars($currentEvent['id']) ?></h2>
        <div class="card shadow rounded overflow-hidden border-0 mb-5">
            <div class="card-body p-4">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Event Title:</label>
                            <input type="text" class="form-control" name="title" id="title" required
                                   value="<?= htmlspecialchars($currentEvent['title']) ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="date" class="form-label">Event Date:</label>
                            <input type="datetime-local" class="form-control" name="date" id="date" required
                                   value="<?= date('Y-m-d\TH:i', strtotime($currentEvent['date'])) ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location:</label>
                            <input type="text" class="form-control" name="location" id="location" required
                                   value="<?= htmlspecialchars($currentEvent['location']) ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Ticket Price (€):</label>
                            <input type="number" class="form-control" name="price" id="price" required step="0.01"
                                   value="<?= htmlspecialchars($currentEvent['price']) ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description:</label>
                        <textarea class="form-control" name="description" id="description" rows="3" required><?= htmlspecialchars($currentEvent['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image_number" class="form-label">Image Number:</label>
                        <select name="image_number" id="image_number" class="form-select" required>
                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                                $formatted = sprintf('%02d', $i);
                                $selected = ($formatted === $currentImageNumber) ? 'selected' : '';
                                echo "<option value=\"$formatted\" $selected> $formatted </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary"
                                style="background-color: #913030; border-color: #913030; border-radius: 50px; padding: 10px 30px;">
                            Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>

</body>
</html>