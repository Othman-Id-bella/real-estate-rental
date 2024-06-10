<?php
$servername = "localhost:3307";  
$username = "root@";    
$password = "";
$dbname ="immobilier";


try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}


if (isset($_GET['id'])) {
    $stmt = $conn->prepare('DELETE FROM immobilier WHERE id_immobilier = ?');
    $stmt->execute([$_GET['id']]);

    header('Location: listeC.php');
    exit();
} else {
    die('ID hôtel manquant');
}
?>
