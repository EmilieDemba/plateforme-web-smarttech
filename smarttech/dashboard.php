<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SmartTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Assurer que la page prend toute la hauteur avec un fond doux */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa; /* Fond clair et doux */
        }

        /* Conteneur principal */
        .dashboard-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding-top: 20px;
        }

        h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }

        /* Style des cartes agrandies */
        .card {
            width: 100%;
            height: 250px; /* Agrandir la hauteur des cartes */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background: white;
        }

        .card-body {
            width: 100%;
        }

        .card i {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
        }

        .row {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        /* Footer fixé en bas */
        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #e9ecef; /* Gris clair */
            width: 100%;
            position: relative;
        }

        /* Espacement du bouton de déconnexion */
        .logout-btn {
            margin-top: 40px; /* Espacement supplémentaire */
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2 class="text-center">Bienvenue sur le Dashboard</h2>

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-users text-primary"></i>
                    <h5 class="card-title">Employés</h5>
                    <a href="employes/afficher_employes.php" class="btn btn-primary">Voir la liste</a>
                    <a href="employes/ajouter_employe.php" class="btn btn-secondary mt-2">Ajouter</a>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-file-alt text-danger"></i>
                    <h5 class="card-title">Fichiers</h5>
                    <a href="fichiers/upload_fichier.php" class="btn btn-danger">Uploader</a>
                    <a href="fichiers/lister_fichiers.php" class="btn btn-secondary mt-2">Voir les fichiers</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bouton de déconnexion avec plus d'espace -->
    <div class="text-center logout-btn">
        <a href="logout.php" class="btn btn-dark">Déconnexion</a>
    </div>
</div>

<!-- Footer fixé en bas -->
<footer class="footer">
    <p>&copy; 2025 SmartTech. Tous droits réservés.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
