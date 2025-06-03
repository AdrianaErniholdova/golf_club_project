<?php
require_once __DIR__ . '/../../classes/Reservations.php';

use reservations\Reservations;

$reservationHandler = new Reservations();

if (!isset($_GET['id'])) {
    echo "Reservation ID is missing.";
    exit;
}

$id = $_GET['id'];
$reservation = $reservationHandler->getReservationById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'full_name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'date' => $_POST['date'],
        'number_of_people' => $_POST['number_of_people'],
        'reservation_type' => $_POST['reservation_type'],
        'comment' => $_POST['comment'],
        'status' => $_POST['status']
    ];

    $reservationHandler->editovanieRezervacie($id, $data);
    header("Location: manage_reservations.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Reservation <?= htmlspecialchars($reservation['id']) ?></h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" value="<?= htmlspecialchars($reservation['full_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($reservation['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="datetime-local" class="form-control" name="date" value="<?= htmlspecialchars($reservation['date']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Number of People</label>
            <input type="number" class="form-control" name="number_of_people" value="<?= htmlspecialchars($reservation['number_of_people']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation Type</label>
            <select class="form-select" name="reservation_type" required>
                <option value="Practice" <?= $reservation['reservation_type'] === 'Practice' ? 'selected' : '' ?>>Practice</option>
                <option value="Lesson with a coach" <?= $reservation['reservation_type'] === 'Lesson with a coach' ? 'selected' : '' ?>>Lesson with a coach</option>
                <option value="Course / equipment rental" <?= $reservation['reservation_type'] === 'Course / equipment rental' ? 'selected' : '' ?>>Course / equipment rental</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status" required>
                <option value="pending" <?= $reservation['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="confirmed" <?= $reservation['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                <option value="cancelled" <?= $reservation['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Comment</label>
            <textarea name="comment" class="form-control" rows="3"><?= htmlspecialchars($reservation['comment']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Reservation</button>
    </form>
</div>
</body>
</html>
