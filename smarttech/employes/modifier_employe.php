<?php
include('C:\xampp\htdocs\smarttech\connexion.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM employes WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $employe = mysqli_fetch_assoc($result);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer et sécuriser les données du formulaire
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $poste = mysqli_real_escape_string($conn, $_POST['poste']);
    
    // Si un nouveau mot de passe est saisi, le mettre à jour
    $mot_de_passe = !empty($_POST['mot_de_passe']) ? password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) : $employe['mot_de_passe'];

    // Requête de mise à jour
    $sql = "UPDATE employes SET prenom = '$prenom', nom = '$nom', adresse = '$adresse', mot_de_passe = '$mot_de_passe', poste = '$poste' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success text-center'>Employé modifié avec succès !</div>";
    } else {
        $message = "<div class='alert alert-danger text-center'>Erreur : " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Modifier un Employé</h2>

    <?= $message; ?>

    <form method="POST" class="p-4 border rounded shadow bg-light">
    <div class="mb-3">
            <label for="matricule" class="form-label">Matricule</label>
            <input type="text" id="matricule" name="matricule" class="form-control" value="<?= htmlspecialchars($employe['matricule']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" value="<?= htmlspecialchars($employe['prenom']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" value="<?= htmlspecialchars($employe['nom']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" id="adresse" name="adresse" class="form-control" value="<?= htmlspecialchars($employe['adresse']); ?>" required>
        </div>

        <div class="mb-3">
        <label for="poste">Poste</label>
        <select name="poste" id="poste" class="form-control" required>
            <option value="Développeur(se) Backend" <?php echo $employe['poste'] == 'Développeur(se) Backend' ? 'selected' : ''; ?>>Développeur(se) Backend</option>
            <option value="Développeur(se) Frontend" <?php echo $employe['poste'] == 'Développeur(se) Frontend' ? 'selected' : ''; ?>>Développeur(se) Frontend</option>
            <option value="Ingénieur(e) DevOps" <?php echo $employe['poste'] == 'Ingénieur(e) DevOps' ? 'selected' : ''; ?>>Ingénieur(e) DevOps</option>
            <option value="Administrateur(trice) Systèmes & Réseaux" <?php echo $employe['poste'] == 'Administrateur(trice) Systèmes & Réseaux' ? 'selected' : ''; ?>>Administrateur(trice) Systèmes & Réseaux</option>
            <option value="Data Analyst" <?php echo $employe['poste'] == 'Data Analyst' ? 'selected' : ''; ?>>Data Analyst</option>
            <option value="Responsable Cybersécurité" <?php echo $employe['poste'] == 'Responsable Cybersécurité' ? 'selected' : ''; ?>>Responsable Cybersécurité</option>
            <option value="Chef(fe) de Projet IT" <?php echo $employe['poste'] == 'Chef(fe) de Projet IT' ? 'selected' : ''; ?>>Chef(fe) de Projet IT</option>
            <option value="Support Technique" <?php echo $employe['poste'] == 'Support Technique' ? 'selected' : ''; ?>>Support Technique</option>
        </select>
    </div>

        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Nouveau Mot de Passe (laisser vide pour ne pas changer)</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="afficher_employes.php" class="btn btn-secondary">Retour</a>
        </div>
    </form>
</div>

</body>
</html>
