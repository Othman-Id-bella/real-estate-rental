<?php
if (isset($_GET['id'])) {
    $id_immobilier = $_GET['id'];

    $servername = "localhost:3307";  
    $username = "root@";    
    $password = "";
    $dbname ="immobilier";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre = $_POST['titre'];
        $adresse = $_POST['adresse'];
        $prix_location = $_POST['prix_location'];
        $id_type = $_POST['id_type'];
        $disponible = $_POST['disponible'];

        $sql = 'UPDATE immobilier SET titre = ?, adresse = ?, prix_location = ?, id_type = ?, disponible = ? WHERE id_immobilier = ? ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([ $titre,$adresse, $prix_location, $id_type, $disponible, $id_immobilier]);

        header('Location: listeC.php');
        exit;
    } else {
        $sql = 'SELECT * FROM immobilier WHERE id_immobilier = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([ $id_immobilier]);
        $immobilier = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Modifier immobilier</title>
</head>
<body>
    <h1>Modifier immobilier</h1>
    <form method="post">
        <label for="titre" class="form-label">Titre:</label>
        <input type="text" id="titre" name="titre" class="form-control" value="<?= htmlspecialchars($immobilier['titre']) ?>" required><br>
        <label for="adresse" class="form-label">Adresse:</label>
        <input type="text" id="adresse" name="adresse" class="form-control" value="<?= htmlspecialchars($immobilier['adresse']) ?>" required><br>
        <label for="prix_location" class="form-label">Prix par Nuit:</label>
        <input type="number" id="prix_location" name="prix_location" class="form-control" value="<?= htmlspecialchars($immobilier['prix_location']) ?>" required><br>
        <label for="id_type" class="form-label">Type d'immobilier:</label>
        <input type="number" id="id_type" name="id_type" class="form-control" value="<?= htmlspecialchars($immobilier['id_type']) ?>" required><br>
        <label for="disponible" class="form-label">Nombre de Places:</label>
        <input type="text" id="disponible" name="disponible" class="form-control" value="<?= htmlspecialchars($immobilier['disponible']) ?>" required><br>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</body>
</html>
