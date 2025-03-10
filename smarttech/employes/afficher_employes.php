<?php
include('C:\xampp\htdocs\smarttech\connexion.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Liste des Employés</h2>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Poste</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM employes";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['prenom']) . "</td>
                            <td>" . htmlspecialchars($row['nom']) . "</td>
                            <td>" . htmlspecialchars($row['adresse']) . "</td>
                            <td>" . htmlspecialchars($row['poste']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>
                                <a href='modifier_employe.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Modifier</a>
                                <a href='supprimer_employe.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Voulez-vous vraiment supprimer cet employé ?\")'>Supprimer</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center text-danger'>Aucun employé trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="ajouter_employe.php" class="btn btn-primary">Ajouter un Employé</a>
    <a href="\smarttech\dashboard.php" class="btn btn-secondary">Retour au Dashboard</a>
</div>

</body>
</html>
