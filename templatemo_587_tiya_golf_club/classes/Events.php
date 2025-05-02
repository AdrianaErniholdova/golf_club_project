<?php
namespace events;

use database\Database;
use PDO;
use PDOException;

require_once __DIR__ . '/Database.php';

class Events extends Database {
    protected $connection;

    // V Events.php
    public function __construct() {
        parent::__construct(); // ak treba
        $this->connect(); // zavolá protected connect()
        $this->connection = $this->getConnection(); // predpokladá, že getConnection() je public
    }


    public function vytvorenieEventu(array $data)
    {
        try {
            $sql = "INSERT INTO events (title, description, location, date, price) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $data['title']);
            $stmt->bindParam(2, $data['description']);
            $stmt->bindParam(3, $data['location']);
            $stmt->bindParam(4, $data['date']);
            $stmt->bindParam(5, $data['price']);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Chyba pri vkladaní dát do databázy: " . $e->getMessage();
        }
    }

    public function getEventById($id)
    {
        try {
            $sql = "SELECT * FROM events WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Chyba pri načítaní eventu: " . $e->getMessage();
            return null;
        }
    }

    public function editovanieEventu($id, array $data)
    {
        try {
            $sql = "UPDATE events SET title = ?, description = ?, location = ?, date = ?, price = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $data['title']);
            $stmt->bindParam(2, $data['description']);
            $stmt->bindParam(3, $data['location']);
            $stmt->bindParam(4, $data['date']);
            $stmt->bindParam(5, $data['price']);
            $stmt->bindParam(6, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Chyba pri upravovaní eventu: " . $e->getMessage();
            return false;
        }
    }

}
