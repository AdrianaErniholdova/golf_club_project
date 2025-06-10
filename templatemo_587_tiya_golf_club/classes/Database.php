<?php

namespace database;
use PDO;
use PDOException;
use Exception;

class Database
{
    private const DATABASE_CONFIG = [
        'HOST' => 'localhost',
        'DBNAME' => 'golf_club_project',
        'PORT' => 3306,
        'USER_NAME' => 'root',
        'PASSWORD' => ''
    ];

    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        $config = self::DATABASE_CONFIG;
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