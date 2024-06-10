<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titre = $_POST['titre'];
    $adresse = $_POST['adresse'];
    $prix_location = $_POST['prix_location'];
    $id_type = $_POST['id_type'];
    $disponible = $_POST['disponible'];
    
    $servername = "localhost:3307";  
    $username = "root@";    
    $password = "";
    $dbname ="immobilier";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    $query = $conn->prepare('INSERT INTO immobilier (titre, adresse, prix_location, id_type, disponible) VALUES (?, ?, ?, ?, ?)');
    $query->execute([$titre, $adresse, $prix_location, $id_type, $disponible]);

    header('Location: listeC.php');
    exit;
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ajouter un immobilier</title>
    <style>
        *{
            padding:10px;
        }
    </style>
</head>
<body>
    <h1>Ajouter un Immobilier</h1>
    <form action="ajouterC.php" method="post" class="form">
        <label for="titre" class="form-label">Titre :</label>
        <input type="text" name="titre" id="titre" class="form-control" required>
        <label for="adresse" class="form-label">Adresse :</label>
        <input type="text" name="adresse" id="adresse" class="form-control" required>
        <label for="prix_location"  class="form-label">Prix location :</label>
        <input type="number" name="prix_location" id="prix_location" class="form-control" required>
        <label for="id_type" class="form-label">Type :</label>
        <input type="number" name="id_type" id="id_type" class="form-control" required>
        <label for="disponible" class="form-label">Disponible :</label>
        <input type="text" name="disponible" id="disponible"  class="form-control"required>
        <input type="submit" value="Ajouter" class="btn btn-info">
    </form>
</body>
</html>
