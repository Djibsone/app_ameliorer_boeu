<?php

try {
    $pdo = new PDO('mysql: host=localhost;	dbname=gestion_boeu', 'djibril', 'tamou');
} catch (PDOException $e) {
    die('Connexion à la bd impossible!' . $e->getMessage());
}

?>
