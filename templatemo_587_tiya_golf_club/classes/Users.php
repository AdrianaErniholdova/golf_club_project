<?php
namespace users;
use database\Database;
require_once __DIR__ . '/Database.php';

class Users extends Database {
    private $rola;
    protected $connection;

    public function __construct() {
        $this->rola = "pouzivatel";
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function register($login, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            //overenie či sa používateľ nachádza v db
            $sql = "SELECT * FROM users WHERE login = ? OR email = ? LIMIT 1";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $login);
            $statement->bindParam(2, $email);
            $statement->execute();
            $existingUser = $statement->fetch();
            if ($existingUser) {
                throw new \Exception("User already exists");
            }

            $sql = "INSERT INTO users (login, email, heslo, rola) VALUES (?, ?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $login);
            $statement->bindParam(2, $email);
            $statement->bindParam(3, $hashedPassword);
            $statement->bindParam(4, $this->rola);
            $statement->execute();
        } catch (Exception $e) {
            echo "Error inserting into database: " . $e->getMessage();
        } finally {
            $this->connection = null;
        }
    }

    public function login($loginOrEmail, $password) {
        $sql = "SELECT * FROM users WHERE login = ? OR email = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $loginOrEmail);
        $statement->bindParam(2, $loginOrEmail);
        $statement->execute();
        $user = $statement->fetch();
        if (!$user) {
            throw new Exception("User does not exist.");
        }

        if (!password_verify($password, $user['heslo'])) {
            throw new Exception("Incorrect password.");
        }

        return $user;
    }

    /*public function isAdmin() {
        session_start();
        if (isset($_SESSION['rola']) && isset($_SESSION['user_id'])) {
            return $_SESSION['rola'] === 'admin';
        }
        return false;
    }*/
}
