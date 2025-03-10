<?php
include('..\connexion.php');

// Requête pour récupérer les fichiers et les informations associées à l'employé
$sql = "SELECT f.id, f.nom_fichier, f.chemin_fichier, f.type_fichier, f.taille_fichier, f.date_upload, 
               e.prenom, e.nom
        FROM fichiers f
        JOIN employes e ON f.id_employe = e.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Fichiers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
        <h2>Liste des Fichiers</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nom du Fichier</th>
                    <th>Employé</th>
                    <th>Type de Fichier</th>
                    <th>Taille (Ko)</th>
                    <th>Date d'Upload</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><a href="<?= $row['chemin_fichier']; ?>" target="_blank"><?= $row['nom_fichier']; ?></a></td>
                        <td><?= $row['prenom'] . ' ' . $row['nom']; ?></td>
                        <td><?= $row['type_fichier']; ?></td>
                        <td><?= round($row['taille_fichier'] / 1024, 2); ?> Ko</td> <!-- Conversion en Ko -->
                        <td><?= date('d-m-Y H:i:s', strtotime($row['date_upload'])); ?></td> <!-- Format de la date -->
                        <td><a href="supprimer_fichier.php?id=<?= $row['id']; ?>" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

                   