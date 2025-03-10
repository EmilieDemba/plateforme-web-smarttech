<?php  
session_start();
include 'connexion.php'; 

// Vérifier si l'utilisateur est connecté
$logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SmartTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            body {
                 background-color: #f5f9fc; 
                font-family: 'Arial', sans-serif;
                background-image: url('https://cdn.pixabay.com/photo/2016/11/29/03/54/abstract-1869266_960_720.jpg'); /* Image de technologie */
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                background-attachment: fixed; 
}

            height: 100%; 
            margin: 0; 
            background-color:rgb(246, 242, 245); 
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            background: linear-gradient(to right,rgb(6, 74, 125),rgb(49, 92, 108)); /* Bleu clair et léger */
            color: white;
            text-align: center;
            padding: 120px 0; 
            position: relative;
        }

        .hero-section h1 {
            font-size: 5rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

     
        .btn-connexion {
            background-color:rgb(76, 202, 146); /* Bleu vif */
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        .btn-connexion:hover {
            background-color: #0056b3; 
        }

  
        footer {
            background-color:rgb(240, 240, 240);
            color: #333;
            text-align: center;
            padding: 1px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

   
        .alert-connexion {
            color: red; 
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if ($logged_in): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link btn-connexion" href="login.php">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section de fond avec "SmartTech" -->
    <div class="hero-section">
        <h1>SmartTech</h1>
    </div>
    
        <div class="container mt-5">
            <div class="alert-connexion">
                Vous devez vous connecter pour accéder au tableau de bord.
            </div>
        </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 SmartTech. Tous droits réservés.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
