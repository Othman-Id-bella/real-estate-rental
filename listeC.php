<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        *{
            padding: 10px;
        }
    </style>
</head>
<body>
<?php
$servername = "localhost:3307";  
$username = "root@";    
$password = "";
$dbname ="immobilier";


$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$query = $conn->query("SELECT * FROM immobilier");
$immobiliers = $query->fetchAll(PDO::FETCH_ASSOC);

?>
    <h1>Liste des immobiliers</h1>
    <table class="table table-striped">
        <tr>
            <th>ID immobilier</th>
            <th>titre</th>
            <th>adresse</th>
            <th>prix location</th>
            <th>id_type</th>
            <th>disponible</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($immobiliers as $immobilier): ?>
            <tr>
                <td><?php echo $immobilier['id_immobilier']; ?></td>
                <td><?php echo $immobilier['titre']; ?></td>
                <td><?php echo $immobilier['adresse']; ?></td>
                <td><?php echo $immobilier['prix_location']; ?> DH</td>
                <td><?php echo $immobilier['id_type']; ?></td>
                <td><?php echo $immobilier['disponible']; ?></td>
                <td>
                    <a href="modifierC.php?id=<?php echo $immobilier ['id_immobilier'] ?>" type="button" class="btn btn-success">Modifie</a>
                    <a href="supprimerC.php?id=<?php echo $immobilier ['id_immobilier'] ?>"  type="button" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="ajouterC.php" type="button" class="btn btn-dark">Ajouter un immobilier</a>
</body>
</html>

