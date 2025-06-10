<?php
namespace events;

use database\Database;
use PDO;
use PDOException;
use Exception;

require_once __DIR__ . '/Database.php';

class Events extends Database {
    protected $connection;

    public function __construct() {
        parent::__construct();
        $this->connection = $this->getConnection();
    }

    public function vytvorenieEventu(array $data): void
    {
        try {
            $sql = "INSERT INTO events (title, description, location, date, price, image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $data['title']);
            $stmt->bindParam(2, $data['description']);
            $stmt->bindParam(3, $data['location']);
            $stmt->bindParam(4, $data['date']);
            $stmt->bindParam(5, $data['price']);
            $stmt->bindParam(6, $data['image']);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error: ".$e->getMessage());
            throw new Exception( "Error inserting data into database");
        }
    }

    public function getEventById($id): ?array
    {
        try {
            $sql = "SELECT * FROM events WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log("Error: ".$e->getMessage());
            throw new Exception("Error loading event:");
        }
    }

    public function editovanieEventu($id, array $data): bool
    {
        try {
            $sql = "UPDATE events SET title = ?, description = ?, location = ?, date = ?, price = ?, image = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $data['title']);
            $stmt->bindParam(2, $data['description']);
            $stmt->bindParam(3, $data['location']);
            $stmt->bindParam(4, $data['date']);
            $stmt->bindParam(5, $data['price']);
            $stmt->bindParam(6, $data['image']);
            $stmt->bindParam(7, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error: ".$e->getMessage());
            throw new Exception("Error editing event:");
        }
    }

    public function vymazanieEventu(int $id): bool
    {
        try {
            $sql = "DELETE FROM events WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([$id]);
        } catch (\PDOException $e) {
            error_log("Error: ".$e->getMessage());
            throw new Exception("Error deleting event:");
        }
    }

    public function getAllEvents(): array
    {
        try {
            $sql = "SELECT * FROM events ORDER BY date DESC";
            $stmt = $this->connection->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error: ".$e->getMessage());
            throw new Exception("Error loading events:");
        }
    }

    public function getUserTickets(int $userId): array {
        try {
            $sql = "SELECT e.title, e.date, e.location, et.quantity
                FROM event_tickets et
                JOIN events e ON et.event_id = e.id
                WHERE et.user_id = ?
                GROUP BY e.id, e.title, e.date, e.location
                ORDER BY e.date DESC";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$userId]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Error loading user tickets:");
        }
    }

    public function buyTicket(int $userId, int $eventId, int $quantity = 1): void {
        try {
            $checkStmt = $this->connection->prepare("SELECT quantity FROM event_tickets WHERE user_id = ? AND event_id = ?");
            $checkStmt->execute([$userId, $eventId]);
            $existingTickets = $checkStmt->fetchColumn();
            if ($existingTickets) {
                $stmt = $this->connection->prepare("UPDATE event_tickets SET quantity = quantity + ? WHERE user_id = ? AND event_id = ?");
                $stmt->execute([$quantity, $userId, $eventId]);
            } else {
                $stmt = $this->connection->prepare("INSERT INTO event_tickets (user_id, event_id, quantity) VALUES (?, ?, ?)");
                $stmt->execute([$userId, $eventId, $quantity]);
            }
        } catch (\PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Error buying ticket:");
        }
    }
}
