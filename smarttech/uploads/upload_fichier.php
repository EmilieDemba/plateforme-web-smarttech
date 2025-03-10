<?php
include('connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fichier']) && isset($_POST['id_employe'])) {
    $id_employe = $_POST['id_employe']; // Récupérer l'ID de l'employé depuis le formulaire
    
    // Vérification de l'existence de l'employé dans la base de données
    $sql_check = "SELECT id FROM employes WHERE id = '$id_employe'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // L'employé existe, procéder à l'upload et insertion du fichier
        
        $nom_fichier = $_FILES['fichier']['name'];
        $chemin_fichier = 'uploads/' . basename($nom_fichier);
        
        // Vérifier si le fichier a été téléchargé avec succès
        if (move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin_fichier)) {
            // Préparer la requête d'insertion dans la table fichiers
            $sql_insert = "INSERT INTO fichiers (nom_fichier, chemin_fichier, id_employe) 
                           VALUES ('$nom_fichier', '$chemin_fichier', '$id_employe')";
            if (mysqli_query($conn, $sql_insert)) {
                echo "Le fichier a été téléchargé et ajouté avec succès!";
            } else {
                echo "Erreur lors de l'ajout du fichier : " . mysqli_error($conn);
            }
        } else {
            echo "Erreur lors de l'upload du fichier.";
        }
    } else {
        // Si l'employé n'existe pas dans la base de données
        echo "Erreur : L'employé avec cet ID n'existe pas.";
    }
} else {
    echo "Erreur : Des informations manquantes (ID employé ou fichier).";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Fichier</title>
</head>
<body>
<h1>Upload de Fichier</h1>
    
    <form action="upload_fichier.php" method="POST" enctype="multipart/form-data">
        <label for="id_employe">ID Employé :</label>
        <input type="number" name="id_employe" required><br><br>
        
        <label for="fichier">Fichier à télécharger :</label>
        <input type="file" name="fichier" required><br><br>
        
        <input type="submit" value="Uploader">
    </form>
</body>
</html>
