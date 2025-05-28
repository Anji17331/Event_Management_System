<?php

// Database credentials (Docker container config)
$host = 'mysql';             // Docker service name for MySQL
$db   = 'chronosrevel';      // Database name
$user = 'v.je';              // Database username
$pass = 'v.je';              // Database password
$charset = 'utf8mb4';        // Character encoding

// Data Source Name (DSN) for PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for secure and efficient DB interaction
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Enable exceptions for errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false                    // Use native prepared statements
];

// Establish and validate the database connection
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
