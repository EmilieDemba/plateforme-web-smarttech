<?php
include('C:\xampp\htdocs\smarttech\connexion.php');

// Vérifier si l'ID du fichier est passé en paramètre
if (isset($_GET['id'])) {
    $id_fichier = $_GET['id'];

    // Récupérer le chemin du fichier pour pouvoir le supprimer du serveur
    $sql = "SELECT chemin_fichier FROM fichiers WHERE id = '$id_fichier'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $chemin_fichier = $row['chemin_fichier'];

        // Supprimer le fichier du serveur
        if (file_exists($chemin_fichier)) {
            unlink($chemin_fichier); // Supprime le fichier
        }

        // Supprimer le fichier de la base de données
        $delete_sql = "DELETE FROM fichiers WHERE id = '$id_fichier'";
        if (mysqli_query($conn, $delete_sql)) {
            echo "Fichier supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du fichier dans la base de données.";
        }
    } else {
        echo "Fichier non trouvé dans la base de données.";
    }
} else {
    echo "Aucun fichier sélectionné pour la suppression.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de Fichier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Suppression de Fichier</h1>
        <a href="lister_fichiers.php" class="btn btn-primary">Retour à la liste des fichiers</a>
    </div>
</body>
</html>
