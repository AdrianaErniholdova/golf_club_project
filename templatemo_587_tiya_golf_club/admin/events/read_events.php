<?php
require_once __DIR__ . '/../../classes/Database.php';
require_once __DIR__ . '/../../classes/Events.php';

use database\Database;
use events\Events;

// Create Events instance which will handle database operations
$eventsHandler = new Events();
$database = new Database();
$pdo = $database->getConnection();

// Get all events using the database connection
$stmt = $pdo->query("SELECT * FROM events ORDER BY date DESC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<body>

<main>

    <div class="container mt-5">
        <h2 class="mb-4">Events</h2>
        <a href="add_events.php" class="btn btn-primary mb-4" style="display: block; width: 200px; margin: 0 auto; text-align: center;">+ Add Event</a><br>

        <div class="row">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow rounded overflow-hidden border-0">
                            <div class="position-relative">
                                <img src="../../images/<?= htmlspecialchars($event['image']) ?>" class="card-img-top" alt="Event Image" style="height: 300px; object-fit: cover;">
                                <div class="position-absolute bottom-0 start-0 bg-success text-white px-3 py-2">
                                    <?= isset($event['date']) ? htmlspecialchars($event['date']) : 'No date' ?>
                                </div>
                                <div class="position-absolute bottom-0 end-0 bg-warning text-white px-3 py-2 fw-bold">
                                    Buy Ticket
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?= isset($event['title']) ? htmlspecialchars($event['title']) : 'No title' ?></h5>
                                <p class="card-text"><?= isset($event['description']) ? htmlspecialchars($event['description']) : 'No description' ?></p>
                                <hr>
                                <p class="mb-1"><strong>Location:</strong> <?= isset($event['location']) ? htmlspecialchars($event['location']) : 'No location' ?></p>
                                <p><strong>Ticket:</strong> <?= isset($event['price']) ? number_format($event['price'], 2) : '0.00' ?> €</p>

                                <div style="margin-top: 15px; display: flex; gap: 10px;">
                                    <a href="edit_events.php?id=<?= isset($event['ID']) ? $event['ID'] : '' ?>" style="background-color: #3c405a; color: #e07b5e; border: none; border-radius: 50px; padding: 8px 16px; font-size: 0.85rem; font-weight: 500; text-decoration: none; display: inline-block; text-align: center;">Edit</a>
                                    <a href="delete_events.php?id=<?= isset($event['ID']) ? $event['ID'] : '' ?>" style="background-color: #3c405a; color: #e07b5e; border: none; border-radius: 50px; padding: 8px 16px; font-size: 0.85rem; font-weight: 500; text-decoration: none; display: inline-block; text-align: center;" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No events found.</p>
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