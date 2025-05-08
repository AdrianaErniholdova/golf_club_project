<?php
namespace reservations;

use database\Database;
use PDO;
use Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/golf_club_project/templatemo_587_tiya_golf_club/classes/Database.php';

class Reservations extends Database
{
    protected $connection;

    public function __construct()
    {
        parent::__construct();
        $this->connection = $this->getConnection();
    }

    public function vytvorenieRezervacie($data)
    {
        try {
            $sql = "INSERT INTO reservations (full_name, email, reservation_type, date, number_of_people, price, comment, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $data['full_name'],
                $data['email'],
                $data['reservation_type'],
                $data['date'],
                $data['number_of_people'],
                $data['price'],
                $data['comment'],
                $data['status'] ?? 'pending'
            ]);
        } catch (Exception $e) {
            throw new Exception("Chyba pri vytváraní rezervácie: " . $e->getMessage());
        }
    }

    public function getAllReservations()
    {
        $sql = "SELECT * FROM reservations ORDER BY date DESC";
        return $this->connection->query($sql)->fetchAll();
    }

    public function getReservationById($id)
    {
        $sql = "SELECT * FROM reservations WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function editovanieRezervacie($id, $data)
    {
        $sql = "UPDATE reservations SET date = ?, number_of_people = ?, reservation_type = ?, comment = ?, status = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            $data['date'],
            $data['number_of_people'],
            $data['reservation_type'],
            $data['comment'],
            $data['status'],
            $id
        ]);
    }

    public function vymazanieRezervacie($id)
    {
        $sql = "DELETE FROM reservations WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getReservationsByUser($email)
    {
        $sql = "SELECT * FROM reservations WHERE email = ? ORDER BY date DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll();
    }

}
