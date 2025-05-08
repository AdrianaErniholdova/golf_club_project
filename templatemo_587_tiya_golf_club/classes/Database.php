<?php

namespace database;
use PDO;
use PDOException;
use Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/golf_club_project/templatemo_587_tiya_golf_club/config/db.php';

class Database
{
    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        $config = DATABASE;

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $dsn = 'mysql:host=' . $config['HOST'] .
                ';dbname=' . $config['DBNAME'] .
                ';port=' . $config['PORT'];

            $this->connection = new PDO(
                $dsn,
                $config['USER_NAME'],
                $config['PASSWORD'],
                $options
            );
        } catch (PDOException $e) {

            throw new Exception('Connection failed: ' . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
?>