<?php
require_once __DIR__ . '/../../classes/Reservations.php';

use reservations\Reservations;

$reservations = new Reservations();
$id = $_GET['id'] ?? die('Missing reservation id.');
$currentReservation = $reservations->getReservationById($id) ?: die('Reservation does not exist.');
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $id,
        'full_name' => $_POST['full_name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'date' => $_POST['date'] ?? '',
        'number_of_people' => $_POST['number_of_people'] ?? '',
        'reservation_type' => $_POST['reservation_type'] ?? '',
        'comment' => $_POST['comment'] ?? '',
        'status' => $_POST['status'] ?? 'pending',
    ];

    $reservations->editovanieRezervacie($id, $data);
    header('Location: manage_reservations.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php  $file_path = "../../parts/head.php";
if(!include($file_path)) {
    echo"Failed to include $file_path";} ?>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Reservation #<?= htmlspecialchars($currentReservation['id']) ?></h2>

    <div class="card shadow rounded overflow-hidden border-0 mb-5">
        <div class="card-body p-4">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name:</label>
                        <input type="text" class="form-control" name="full_name" required
                               value="<?= htmlspecialchars($currentReservation['full_name']) ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" required
                               value="<?= htmlspecialchars($currentReservation['email']) ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Date & Time:</label>
                        <input type="datetime-local" class="form-control" name="date" required
                               value="<?= htmlspecialchars($currentReservation['date']) ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Number of People:</label>
                        <input type="number" class="form-control" name="number_of_people" min="1" required
                               value="<?= htmlspecialchars($currentReservation['number_of_people']) ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Reservation Type:</label>
                        <select class="form-select" name="reservation_type" required>
                            <option value="Practice" <?= $currentReservation['reservation_type'] === 'Practice' ? 'selected' : '' ?>>Practice</option>
                            <option value="Lesson with a coach" <?= $currentReservation['reservation_type'] === 'Lesson with a coach' ? 'selected' : '' ?>>Lesson with a coach</option>
                            <option value="Course / equipment rental" <?= $currentReservation['reservation_type'] === 'Course / equipment rental' ? 'selected' : '' ?>>Course / equipment rental</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status:</label>
                        <select class="form-select" name="status" required>
                            <option value="pending" <?= $currentReservation['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="confirmed" <?= $currentReservation['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                            <option value="cancelled" <?= $currentReservation['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Comment:</label>
                    <textarea name="comment" class="form-control" rows="3"><?= htmlspecialchars($currentReservation['comment']) ?></textarea>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary"
                            style="background-color: #913030; border-color: #913030; border-radius: 50px; padding: 10px 30px;">
                        Update Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
