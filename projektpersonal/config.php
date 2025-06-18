<?php
// Konfigurimi i databazës
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'carshop_db');

// Krijo lidhjen me databazën
function getConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Gabim në lidhjen me databazën: " . $e->getMessage());
    }
}

// Fillo sesionin
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
