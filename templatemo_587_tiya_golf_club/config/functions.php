<?php

require_once __DIR__ . '/../classes/Database.php';

use database\Database;

function getMenuItems(string $type = 'navbar'): array {
    try {
        $db = new Database();
        $pdo = $db->getConnection();

        $stmt = $pdo->prepare("SELECT text, href FROM menu WHERE type = ?");
        $stmt->execute([$type]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Error loading menu: " . $e->getMessage());
        return [];
    }
}

function printNavbarItems(): void {
    $menuItems = getMenuItems('navbar');
    foreach ($menuItems as $item) {
        echo '<li class="nav-item">';
        echo '<a class="nav-link click-scroll" href="' . htmlspecialchars($item['href']) . '">' . htmlspecialchars($item['text']) . '</a>';
        echo '</li>';
    }
}
