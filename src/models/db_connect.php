<?php

$host = "mysql";
$username = "messenger";
$password = "messenger";

try {
    $conn = new PDO("mysql:host=$host;dbname=messenger", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
    
    catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    }

?>