<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/classes/Events.php';

use events\Events;

$event = new Events();
$events = $event->getAllEvents();
$userTickets = [];

if (isset($_SESSION['user_id'])) {
    $userTickets = $event->getUserTickets($_SESSION['user_id']);
}

$success = null;
if (isset($_SESSION['success_message'])) {
    $success = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    try {
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        for ($i = 0; $i < $quantity; $i++) {
            $event->buyTicket($_SESSION['user_id'], (int)$_POST['event_id']);
        }
        $_SESSION['success_message'] = "Successfully purchased $quantity tickets.";
        header("Location: events.php");
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

                            <h1 class="text-white mb-4 pb-2">Event Listing</h1>

                        </div>

                    </div>
                </div>

                <svg viewBox="0 0 1962 178" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="#ffffff" d="M 0 114 C 118.5 114 118.5 167 237 167 L 237 167 L 237 0 L 0 0 Z" stroke-width="0"></path> <path fill="#ffffff" d="M 236 167 C 373 167 373 128 510 128 L 510 128 L 510 0 L 236 0 Z" stroke-width="0"></path> <path fill="#ffffff" d="M 509 128 C 607 128 607 153 705 153 L 705 153 L 705 0 L 509 0 Z" stroke-width="0"></path><path fill="#ffffff" d="M 704 153 C 812 153 812 113 920 113 L 920 113 L 920 0 L 704 0 Z" stroke-width="0"></path><path fill="#ffffff" d="M 919 113 C 1048.5 113 1048.5 148 1178 148 L 1178 148 L 1178 0 L 919 0 Z" stroke-width="0"></path><path fill="#ffffff" d="M 1177 148 C 1359.5 148 1359.5 129 1542 129 L 1542 129 L 1542 0 L 1177 0 Z" stroke-width="0"></path><path fill="#ffffff" d="M 1541 129 C 1751.5 129 1751.5 138 1962 138 L 1962 138 L 1962 0 L 1541 0 Z" stroke-width="0"></path></svg>
            </section>

            <section class="events-section section-padding" id="section_2">
                <div class="container">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success">
                            <?php echo htmlspecialchars($success); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">

                        <?php if (!empty($userTickets)): ?>
                            <div class="col-lg-12 col-12">
                                <h3 class="mb-3">Your Tickets</h3>
                                <ul class="list-group mb-5">
                                    <?php foreach ($userTickets as $ticket): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong><?= htmlspecialchars($ticket['title']) ?></strong><br>
                                                Date: <?= htmlspecialchars($ticket['date']) ?><br>
                                                Location: <?= htmlspecialchars($ticket['location']) ?>
                                            </div>
                                            <div>
                                                Quantity: <?= htmlspecialchars($ticket['quantity']) ?></div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="col-lg-12 col-12">
                            <h2 class="mb-lg-5 mb-4">Upcoming events</h2>
                        </div>
                        <?php foreach ($events as $event): ?>
                        <div class="col-lg-6 col-12 mb-5 mb-lg-0"> <br> <br>
                            <div class="custom-block-image-wrap">
                                <img src="images/<?= htmlspecialchars($event['image']) ?>" class="custom-block-image img-fluid" alt="Event Image">

                                <div class="custom-block-date-wrap">
                                    <strong class="text-white"><?= $event['date'] ?></strong>
                                </div>

                                <div class="custom-btn-wrap">
                                    <?php if (isset($_SESSION['rola']) && $_SESSION['rola'] === 'pouzivatel'): ?>
                                        <form action="events.php" method="POST" class="d-flex align-items-center w-100">
                                            <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                                            <button type="submit" class="btn custom-btn" style="margin: 0">Buy Ticket(s)</button>
                                            <div class="d-flex align-items-center gap-1" style="background:#E07B5EFF; border-radius: 5px; padding: 15px;">
                                                <label for="quantity_<?= $event['id'] ?>" class="form-label mb-0 text-white">Qty:</label>
                                                <input type="number" name="quantity" id="quantity_<?= $event['id'] ?>"
                                                       min="1" max="10" value="1" class="form-control form-control-sm" style="width: 70px;">
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <a href="#" class="btn custom-btn" onclick="alert('Must be logged in to proceed'); return false;">
                                            Buy Ticket
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="custom-block-info">
                                <a href="" class="events-title mb-2"><?= htmlspecialchars($event['title']) ?></a>

                                <p class="mb-0"><?= htmlspecialchars($event['description']) ?></p>


                                <div class="border-top mt-4 pt-3">
                                    <div class="d-flex flex-wrap align-items-center mb-1">
                                        <span class="custom-block-span">Location:</span>

                                        <p class="mb-0"><?= $event['location'] ?></p>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="custom-block-span">Ticket Price:</span>

                                        <p class="mb-0">$<?= $event['price'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

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
