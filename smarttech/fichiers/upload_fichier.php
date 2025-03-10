<?php
include('..\connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fichier']) && isset($_POST['matricule'])) {
    // Récupérer les informations sur le fichier et le matricule de l'employé
    $matricule = mysqli_real_escape_string($conn, $_POST['matricule']);
    $nom_fichier = $_FILES['fichier']['name'];
    $tmp_fichier = $_FILES['fichier']['tmp_name'];
    $type_fichier = $_FILES['fichier']['type'];
    $taille_fichier = $_FILES['fichier']['size'];
    
    // Vérifier si le fichier est valide 
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword'];
    $max_size = 5 * 1024 * 1024;  // Limite à 5 Mo

    // Vérifier si le matricule existe dans la base de données
    $sql_employe = "SELECT * FROM employes WHERE matricule = '$matricule'";
    $result_employe = mysqli_query($conn, $sql_employe);

    if (mysqli_num_rows($result_employe) > 0) {
        // Récupérer l'ID de l'employé
        $employe = mysqli_fetch_assoc($result_employe);
        $id_employe = $employe['id'];

        if (in_array($type_fichier, $allowed_types) && $taille_fichier <= $max_size) {
            // Déplacer le fichier vers le répertoire de destination
            $chemin_fichier = 'uploads/' . basename($nom_fichier);
            
            if (move_uploaded_file($tmp_fichier, $chemin_fichier)) {
                // Insérer les informations dans la base de données
                $sql = "INSERT INTO fichiers (nom_fichier, chemin_fichier, type_fichier, taille_fichier, id_employe) 
                        VALUES ('$nom_fichier', '$chemin_fichier', '$type_fichier', '$taille_fichier', '$id_employe')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "Fichier téléchargé avec succès!";
                        header("Location: lister_fichiers.php");
                        exit;
                } else {
                    echo "Erreur : " . mysqli_error($conn);
                }
            } else {
                echo "Erreur lors de l'upload du fichier.";
            }
        } else {
            echo "Fichier non valide ou trop lourd.";
        }
    } else {
        echo "Matricule de l'employé non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Fichier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Upload de Fichier</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="matricule" class="form-label">Matricule de l'Employé</label>
                <input type="text" id="matricule" name="matricule" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fichier" class="form-label">Sélectionner un fichier</label>
                <input type="file" id="fichier" name="fichier" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Télécharger</button>
        </form>
    </div>
</body>
</html>
