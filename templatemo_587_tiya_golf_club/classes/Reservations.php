<?php
namespace reservations;

use database\Database;
use PDO;
use PDOException;

require_once __DIR__ . '/Database.php';

class Reservations extends Database {
    protected $connection;

    public function __construct() {
        parent::__construct();
        $this->connection = $this->getConnection();
    }

    public function vytvorenieRezervacie(array $data): void
    {
        try {
            $sql = "INSERT INTO reservations (full_name, email, reservation_type, date, number_of_people, price, comment, status, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);

            $price = $this->vypocitajCenu($data['reservation_type'], $data['number_of_people']);
            $status = $data['status'] ?? 'pending';

            $stmt->bindParam(1, $data['full_name']);
            $stmt->bindParam(2, $data['email']);
            $stmt->bindParam(3, $data['reservation_type']);
            $stmt->bindParam(4, $data['date']);
            $stmt->bindParam(5, $data['number_of_people']);
            $stmt->bindParam(6, $price);
            $stmt->bindParam(7, $data['comment']);
            $stmt->bindParam(8, $status);
            $stmt->bindParam(9,$data['user_id']);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new \Exception("Error creating reservation");
        }
    }

    public function getReservationById($id): ?array
    {
        try {
            $sql = "SELECT * FROM reservations WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new \Exception("Error loading reservation");
        }
    }

    public function editovanieRezervacie($id, array $data): bool
    {
        try {
            $sql = "UPDATE reservations SET full_name = ?, email = ?, date = ?, number_of_people = ?, reservation_type = ?, comment = ?, status = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1,$data['full_name']);
            $stmt->bindParam(2,$data['email']);
            $stmt->bindParam(3,$data['date']);
            $stmt->bindParam(4,$data['number_of_people']);
            $stmt->bindParam(5,$data['reservation_type']);
            $stmt->bindParam(6,$data['comment']);
            $stmt->bindParam(7,$data['status']);
            $stmt->bindParam(8, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new \Exception("Error editing reservation");
        }
    }

    public function vymazanieRezervacie($id): bool
    {
        try {
            $sql = "DELETE FROM reservations WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new \Exception("Error deleting reservation");
        }
    }

    public function getAllReservations(): array
    {
        try {
            $sql = "SELECT * FROM reservations ORDER BY date DESC";
            $stmt = $this->connection->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new \Exception("Error loading reservations");
        }
    }

    public function getReservationsByUserId(int $userId): array {
        try {
            $sql = "SELECT * FROM reservations WHERE user_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$userId]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new \Exception("Error loading reservations");
        }
    }

    public function vypocitajCenu(string $typ, int $pocetOsob): float
    {
        $zakladneCeny = [
            'Practice' => 10.0,
            'Lesson with a coach' => 25.0,
            'Course / equipment rental' => 15.0,
        ];

        $cenaZaOsobu = $zakladneCeny[$typ] ?? 0;
        return $cenaZaOsobu * $pocetOsob;
    }

    public function cancelReservation($id): bool
    {
        try {
            $sql = "UPDATE reservations SET status = 'cancelled' WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([$id]);
        } catch (\PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new \Exception("Error cancelling reservation");
        }
    }

}
