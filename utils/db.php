<?php
// paramètres de la BD 
$server = "localhost";
$db = "projet-optical-center";
$user = "admin";
$passwd = "Tibodeuh49@";
// Fin de la déclaration des paramètres

// Cette partie est générique à l'ensemble de vos projets utilisant une base de données.
$dsn = "mysql:host=$server;dbname=$db";
$pdo = new PDO($dsn, $user, $passwd);
try {
    $conn = new PDO($dsn, $user, $passwd);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}