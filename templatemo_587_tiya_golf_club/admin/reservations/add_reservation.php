<?php
session_start();
require_once __DIR__ . '/../../classes/Reservations.php';

use reservations\Reservations;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservations = new Reservations();
    $data = [
        'full_name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'reservation_type' => $_POST['reservation_type'],
        'date' => $_POST['date'],
        'number_of_people' => $_POST['number_of_people'],
        'price' => $_POST['price'],
        'comment' => $_POST['comment'] ?? '',
        'status' => 'pending',
        'user_id' => $_SESSION['user_id']
    ];
    $reservations->vytvorenieRezervacie($data);
    header("Location: manage_reservations.php");
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
    <h2 class="text-center mb-4">Add New Reservation</h2>

    <div class="card shadow rounded overflow-hidden border-0 mb-5">
        <div class="card-body p-4">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name:</label>
                        <input type="text" class="form-control" name="full_name" required/>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Reservation Type:</label>
                        <select class="form-select" name="reservation_type" required>
                            <option value="" disabled>Choose reservation type</option>
                            <option value="Practice" >Practice</option>
                            <option value="Lesson with a coach" >Lesson with a coach</option>
                            <option value="Course / equipment rental">Course / equipment rental</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date & Time:</label>
                        <input type="datetime-local" class="form-control" name="date" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Number of People:</label>
                        <input type="number" class="form-control" name="number_of_people" min="1" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Price (€):</label>
                        <input type="number" class="form-control" name="price" step="5.00" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Comment (optional):</label>
                    <textarea name="comment" class="form-control" rows="3"></textarea>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary"
                            style="background-color: #913030FF; border-color: #913030FF; border-radius: 50px; padding: 10px 30px;">
                        Create Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
