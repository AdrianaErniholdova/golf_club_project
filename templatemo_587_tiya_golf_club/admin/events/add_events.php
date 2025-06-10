<?php
require_once __DIR__ . '/../../classes/Events.php';

use events\Events;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $events = new Events();
    $selectedNumber = $_POST['image_number'] ?? '01';
    $imageFileName = 'event' . $selectedNumber . '.jpg';

    $data = [
        'title' => $_POST['title'] ?? '',
        'date' => $_POST['date'] ?? '',
        'location' => $_POST['location'] ?? '',
        'price' => $_POST['price'] ?? '',
        'description' => $_POST['description'] ?? '',
        'image' => $imageFileName,
    ];
    $events->vytvorenieEventu($data);
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
        <h2 class="text-center mb-4">Add New Event</h2>

        <div class="card shadow rounded overflow-hidden border-0 mb-5">
            <div class="card-body p-4">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Event Title:</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>

                        <div class="col-md-6">
                            <label for="date" class="form-label">Event Date:</label>
                            <input type="datetime-local" class="form-control" name="date" id="date" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location:</label>
                            <input type="text" class="form-control" name="location" id="location" required>
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Ticket Price (€):</label>
                            <input type="number" class="form-control" name="price" id="price" required step="1.00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description:</label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image_number" class="form-label">Image Number:</label>
                        <select name="image_number" id="image_number" class="form-select" required>
                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                                $formatted = sprintf('%02d', $i);
                                echo "<option value=\"$formatted\"> $formatted </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary"
                                style="background-color: #913030; border-color: #913030; border-radius: 50px; padding: 10px 30px;">
                            Add Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>


</main>

</body>
</html>
