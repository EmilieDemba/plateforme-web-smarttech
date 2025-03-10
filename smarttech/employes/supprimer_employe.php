<?php
include('../connexion.php'); 

if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$message = "";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Vérifier si l'ID existe
    $sql_check = "SELECT * FROM employes WHERE id = $id";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        
        if (isset($_POST['delete'])) {
            $sql = "DELETE FROM employes WHERE id = $id";
            
            if (mysqli_query($conn, $sql)) {
                // Rediriger vers la liste des employés après suppression
                header("Location: afficher_employes.php");
                exit;
            } else {
                $message = "<div class='alert alert-danger text-center'>Erreur : " . mysqli_error($conn) . "</div>";
            }
        }
    } else {
        $message = "<div class='alert alert-warning text-center'>Employé non trouvé.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Confirmer la Suppression de l'Employé</h2>

    <?= $message; ?>

    <?php if (isset($id) && mysqli_num_rows($result_check) > 0): ?>
        <div class="alert alert-warning text-center">
            Êtes-vous sûr de vouloir supprimer cet employé ?
        </div>
        
        <div class="d-flex justify-content-center">
            <form method="POST">
                <button type="submit" name="delete" class="btn btn-danger">Oui, supprimer</button>
                <a href="afficher_employes.php" class="btn btn-secondary ms-3">Annuler</a>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Aucun employé sélectionné pour suppression.</div>
    <?php endif; ?>

</div>

</body>
</html>
