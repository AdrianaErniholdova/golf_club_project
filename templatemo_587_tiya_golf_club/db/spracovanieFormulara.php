<?php

// PDO databázové pripojenie
$host = "localhost";
$dbname = "kontaktny_formular";
$port = 3306;
$username = "root";
$password = "";

// Možnosti
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

// Pripojenie PDO
try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.";port=".$port, $username,
        $password, $options);
} catch (PDOException $e) {
    die("Chyba pripojenia: " . $e->getMessage());
}

// Získanie údajov z formulára
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
// SQL príkaz INSERT
$sql = "INSERT INTO udaje (name, email, message) 
    VALUE ('".$name."', '".$email."', '".$message."')";
$statement = $conn->prepare($sql);
try {
    $insert = $statement->execute();
    header("Location: http://localhost/golf_club_project/templatemo_587_tiya_golf_club/index.php");
    return $insert;
} catch (\Exception $exception) {
    return false;
}
// Zatvorenie pripojenia
$conn = null;
