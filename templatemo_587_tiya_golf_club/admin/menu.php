<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #fff;
        }

        .admin-container {
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .admin-button {
            display: block;
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            font-size: 16px;
            font-weight: 500;
            background-color: #3c405a;
            border: none;
            border-radius: 50px;
            color: #f7cd91;
            cursor: pointer;
            transition: background 0.3s ease;
            text-decoration: none;
        }

        .admin-button:hover {
            background-color: #e07b5e;
            color: white
        }
    </style>
</head>
<body>
<div class="admin-container">
    <h1>Admin Menu</h1>
    <a href="events/read_events.php" class="admin-button">Manage Events</a>
    <a href="manage-reservations.php" class="admin-button">Manage Reservations</a>
    <a href="../index.php" class="admin-button">Back to Homepage</a>
</div>
</body>
</html>
