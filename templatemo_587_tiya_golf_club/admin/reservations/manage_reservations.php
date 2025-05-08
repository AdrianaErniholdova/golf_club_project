<?php
require_once __DIR__ . '/../../classes/Reservations.php';

use reservations\Reservations;

$reservationsHandler = new Reservations();
$reservations = $reservationsHandler->getAllReservations();
?>
<!doctype html>
<html lang="en">
<body>

<main>

    <div class="container mt-5">
        <h2 class="mb-4">Reservations</h2>
        <a href="add_reservation.php" class="btn btn-primary mb-4" style="display: block; width: 200px; margin: 0 auto; text-align: center;">+ Add Reservation</a><br>

        <div class="row">
            <?php if (!empty($reservations)): ?>
                <?php foreach ($reservations as $res): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow rounded overflow-hidden border-0">

                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($res['full_name']) ?></h5>
                                <p class="card-text mb-1"><strong>Email:</strong> <?= htmlspecialchars($res['email']) ?></p>
                                <p class="card-text mb-1"><strong>Date and Time:</strong> <?= htmlspecialchars($res['date']) ?></p>
                                <p class="card-text mb-1"><strong>Type:</strong> <?= htmlspecialchars($res['reservation_type']) ?></p>
                                <p class="card-text mb-1"><strong>Number of People:</strong> <?= htmlspecialchars($res['number_of_people']) ?></p>
                                <p class="card-text mb-1"><strong>Price:</strong> <?= number_format($res['price'], 2) ?> €</p>
                                <p class="card-text mb-1"><strong>Status:</strong> <?= htmlspecialchars($res['status']) ?></p>
                                <p class="card-text"><strong>Comment:</strong><br> <?= nl2br(htmlspecialchars($res['comment'])) ?></p>

                                <div style="margin-top: 15px; display: flex; gap: 10px;">
                                    <a href="edit_reservation.php?id=<?= $res['id'] ?>" style="background-color: #3c405a; color: #e07b5e; border: none; border-radius: 50px; padding: 8px 16px; font-size: 0.85rem; font-weight: 500; text-decoration: none; display: inline-block; text-align: center;">Edit</a>
                                    <a href="delete_reservation.php?id=<?= $res['id'] ?>" style="background-color: #3c405a; color: #e07b5e; border: none; border-radius: 50px; padding: 8px 16px; font-size: 0.85rem; font-weight: 500; text-decoration: none; display: inline-block; text-align: center;" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No reservations found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>


</main>
</body>
</html>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 2rem;
    }

    h2 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 2rem;
        text-align: center;
        color: #3c405a;
    }

    .btn-primary {
        background-color: #3c405a;
        color: #f7cd91;
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #e07b5e;
        color: white;
    }

    .card {
        border: 1px solid #eee;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2b2d42;
        margin-bottom: 0.5rem;
    }

    .card-text {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 0.4rem;
    }

    /* Button styling removed since we're using inline styles */

    .container {
        max-width: 1200px;
        margin: auto;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .col-md-6 {
        flex: 0 0 calc(50% - 20px);
        max-width: calc(50% - 20px);
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>