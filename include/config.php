<?php

// Database connection details
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'sam';

try {
    $dbh = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8",
        $dbUser,
        $dbPass 
    );
    return $dbh;
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());  // Stop script on error
}

?>
