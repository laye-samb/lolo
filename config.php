<?php
// Informations de connexion à la base de données
$dsn = "mysql:host=localhost;dbname=laye;charset=utf8mb4";
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL

// Créer une connexion PDO
try {
    $pdo = new PDO($dsn, $username, $password);
    // Définir le mode d'erreur PDO sur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à la base de données réussie.";
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>