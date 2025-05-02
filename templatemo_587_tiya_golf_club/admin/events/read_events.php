<?php
require_once __DIR__ . '/../../classes/Database.php';
require_once __DIR__ . '/../../classes/Events.php';

use database\Database;
use events\Events;

$database = new Database();
$pdo = $database->getConnection();

$stmt = $pdo->query("SELECT * FROM events ORDER BY date DESC");
$events = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<body>

<main>

    <div class="container mt-5">
        <h2 class="mb-4">Events</h2>
        <a href="add_events.php" class="btn btn-primary mb-4">+ Add Event</a>

        <div class="row">
            <?php foreach ($events as $event): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow rounded overflow-hidden border-0">
                        <div class="position-relative">
                            <img src="images/event-default.jpg" class="card-img-top" alt="Event Image" style="height: 300px; object-fit: cover;">
                            <div class="position-absolute bottom-0 start-0 bg-success text-white px-3 py-2">
                                <?= htmlspecialchars($event['date']) ?>
                            </div>
                            <div class="position-absolute bottom-0 end-0 bg-warning text-white px-3 py-2 fw-bold">
                                Buy Ticket
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($event['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($event['description']) ?></p>
                            <hr>
                            <p class="mb-1"><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
                            <p><strong>Ticket:</strong> <?= number_format($event['price'], 2) ?> €</p>

                            <a href="edit_events.php?id=<?= $event['id'] ?>" class="btn btn-sm btn-warning">Upraviť</a>
                            <a href="delete.php?id=<?= $event['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Naozaj chcete zmazať?');">Zmazať</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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

    .btn-warning, .btn-danger {
        border: none;
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-right: 6px;
        transition: background 0.3s ease;
    }

    .btn-warning {
        background-color: #f0ad4e;
        color: white;
    }

    .btn-warning:hover {
        background-color: #ec971f;
    }

    .btn-danger {
        background-color: #d9534f;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c9302c;
    }

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

    .col-md-4 {
        flex: 0 0 calc(33.333% - 20px);
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 100%;
        }
    }
</style>
