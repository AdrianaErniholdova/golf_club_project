<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/classes/Reservations.php';

use reservations\Reservations;

$reservations = new Reservations();
$userReservations = [];

if (isset($_SESSION['user_id'])) {
    $userReservations = $reservations->getReservationsByUserId($_SESSION['user_id']);
}

$success = null;
if (isset($_SESSION['success_message'])) {
    $success = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'full_name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'reservation_type' => $_POST['reservation_type'],
        'date' => $_POST['date'],
        'number_of_people' => $_POST['number_of_people'],
        'comment' => $_POST['comment'] ?? '',
        'status' => 'pending',
        'user_id' => $_SESSION['user_id']
    ];

    try {
        $reservations->vytvorenieRezervacie($data);
        $_SESSION['success_message'] = "Reservation was successfully created.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">
<!--head-->
<?php  $file_path = "parts/head.php";
if(!include($file_path)) {
    echo"Failed to include $file_path";} ?>

<body>

<main>

    <!--nav-->
    <?php  $file_path = "parts/nav.php";
    if(!include($file_path)) {
        echo"Failed to include $file_path";} ?>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#3D405B" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
    </div>


    <section class="hero-section hero-50 d-flex justify-content-center align-items-center" id="section_1">

        <div class="section-overlay"></div>

        <svg viewBox="0 0 1962 178" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="#3D405B" d="M 0 114 C 118.5 114 118.5 167 237 167 L 237 167 L 237 0 L 0 0 Z" stroke-width="0"></path> <path fill="#3D405B" d="M 236 167 C 373 167 373 128 510 128 L 510 128 L 510 0 L 236 0 Z" stroke-width="0"></path> <path fill="#3D405B" d="M 509 128 C 607 128 607 153 705 153 L 705 153 L 705 0 L 509 0 Z" stroke-width="0"></path><path fill="#3D405B" d="M 704 153 C 812 153 812 113 920 113 L 920 113 L 920 0 L 704 0 Z" stroke-width="0"></path><path fill="#3D405B" d="M 919 113 C 1048.5 113 1048.5 148 1178 148 L 1178 148 L 1178 0 L 919 0 Z" stroke-width="0"></path><path fill="#3D405B" d="M 1177 148 C 1359.5 148 1359.5 129 1542 129 L 1542 129 L 1542 0 L 1177 0 Z" stroke-width="0"></path><path fill="#3D405B" d="M 1541 129 C 1751.5 129 1751.5 138 1962 138 L 1962 138 L 1962 0 L 1541 0 Z" stroke-width="0"></path></svg>

        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">

                    <h1 class="text-white mb-4 pb-2">Reservations</h1>

                </div>

            </div>
        </div>

        <svg viewBox="0 0 1962 178" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="#ffffff" d="M 0 114 C 118.5 114 118.5 167 237 167 L 237 167 L 237 0 L 0 0 Z" stroke-width="0"></path> <path fill="#ffffff" d="M 236 167 C 373 167 373 128 510 128 L 510 128 L 510 0 L 236 0 Z" stroke-width="0"></path> <path fill="#ffffff" d="M 509 128 C 607 128 607 153 705 153 L 705 153 L 705 0 L 509 0 Z" stroke-width="0"></path><path fill="#ffffff" d="M 704 153 C 812 153 812 113 920 113 L 920 113 L 920 0 L 704 0 Z" stroke-width="0"></path><path fill="#ffffff" d="M 919 113 C 1048.5 113 1048.5 148 1178 148 L 1178 148 L 1178 0 L 919 0 Z" stroke-width="0"></path><path fill="#ffffff" d="M 1177 148 C 1359.5 148 1359.5 129 1542 129 L 1542 129 L 1542 0 L 1177 0 Z" stroke-width="0"></path><path fill="#ffffff" d="M 1541 129 C 1751.5 129 1751.5 138 1962 138 L 1962 138 L 1962 0 L 1541 0 Z" stroke-width="0"></path></svg>
    </section>

    <section class="events-section section-padding" id="section_2">
        <div class="container mt-5">

            <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($userReservations)): ?>
                <div class="mb-5">
                    <h3>Your Reservations</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>People</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($userReservations as $reservation): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($reservation['date']); ?></td>
                                <td><?php echo htmlspecialchars($reservation['reservation_type']); ?></td>
                                <td><?php echo htmlspecialchars($reservation['number_of_people']); ?></td>
                                <td><?php echo htmlspecialchars($reservation['price']); ?> €</td>
                                <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                                <td>
                                    <?php if ($reservation['status'] != 'cancelled'): ?>
                                        <a href="config/cancel_reservation.php?id=<?php echo $reservation['id']; ?>"
                                           style="color: #e07b5e;"
                                           onclick="return confirm('Are you sure you want to cancel this reservation?');">
                                            Cancel Reservation
                                        </a>
                                    <?php else: ?>
                                        <span></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <h2 class="mb-4 text-center">Make a Reservation</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card shadow rounded overflow-hidden border-0 mb-5">
                <div class="card-body p-4">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="full_name" class="form-label">Full Name:</label>
                                <input type="text" class="form-control" name="full_name" id="full_name" required
                                       value="<?php echo isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : ''; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="date" class="form-label">Date and Time:</label>
                                <input type="datetime-local" class="form-control" name="date" id="date" required
                                       value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" required
                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="reservation_type" class="form-label">Type:</label>
                                <select class="form-select" name="reservation_type" id="reservation_type" required>
                                    <option value="" disabled <?php echo !isset($_POST['reservation_type']) ? 'selected' : ''; ?>>Choose reservation type</option>
                                    <option value="Practice" <?php echo (isset($_POST['reservation_type']) && $_POST['reservation_type'] === 'Practice') ? 'selected' : ''; ?>>Practice</option>
                                    <option value="Lesson with a coach" <?php echo (isset($_POST['reservation_type']) && $_POST['reservation_type'] === 'Lesson with a coach') ? 'selected' : ''; ?>>Lesson with a coach</option>
                                    <option value="Course / equipment rental" <?php echo (isset($_POST['reservation_type']) && $_POST['reservation_type'] === 'Course / equipment rental') ? 'selected' : ''; ?>>Course / equipment rental</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="number_of_people" class="form-label">Number of People:</label>
                                <input type="number" class="form-control" name="number_of_people" id="number_of_people" min="1" required
                                       value="<?php echo isset($_POST['number_of_people']) ? htmlspecialchars($_POST['number_of_people']) : ''; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="comment" class="form-label">Comment:</label>
                                <textarea class="form-control" name="comment" id="comment" rows="1"><?php echo isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <?php
                            $isUserLoggedIn = isset($_SESSION['rola']) && $_SESSION['rola'] === 'pouzivatel';
                            ?>
                            <?php if ($isUserLoggedIn): ?>
                                <button type="submit" class="btn btn-primary"
                                        style="background-color: #3c405a; border-color: #3c405a; border-radius: 50px; padding: 10px 30px;">
                                    Submit reservation
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn btn-primary"
                                        onclick="alert('You must be logged in to proceed.');"
                                        style="background-color: #913030FF; border-color: #913030FF; border-radius: 50px; padding: 10px 30px;">
                                    Submit reservation
                                </button>
                            <?php endif; ?>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>

</main>

<!--footer-->
<?php  $file_path = "parts/footer.php";
if(!include($file_path)) {
    echo"Failed to include $file_path";} ?>


<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
