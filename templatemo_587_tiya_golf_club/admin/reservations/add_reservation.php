<?php
require_once __DIR__ . '/../../classes/Reservations.php';

use reservations\Reservations;

$reservationHandler = new Reservations();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'full_name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'reservation_type' => $_POST['reservation_type'],
        'date' => $_POST['date'],
        'number_of_people' => $_POST['number_of_people'],
        'price' => $_POST['price'],
        'comment' => $_POST['comment'] ?? '',
        'status' => 'pending'
    ];

    try {
        $reservationHandler->vytvorenieRezervacie($data);
        header("Location: manage_reservations.php"); 
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Reservation</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation Type</label>
            <select class="form-select" name="reservation_type" required>
                <option value="Practice">Practice</option>
                <option value="Lesson with a coach">Lesson with a coach</option>
                <option value="Course / equipment rental">Course / equipment rental</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date & Time</label>
            <input type="datetime-local" class="form-control" name="date" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Number of People</label>
            <input type="number" class="form-control" name="number_of_people" required min="1">
        </div>

        <div class="mb-3">
            <label class="form-label">Price (€)</label>
            <input type="number" class="form-control" name="price" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Comment (optional)</label>
            <textarea name="comment" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Reservation</button>
    </form>
</div>
</body>
</html>
