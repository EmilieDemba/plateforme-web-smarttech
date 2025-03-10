<?php
session_start();
include 'connexion.php';

$error_message = ""; // Initialisation du message d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier que les champs sont bien remplis
    if (!isset($_POST["email"]) || !isset($_POST["password"])) {
        $error_message = "Veuillez remplir tous les champs.";
    } else {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Vérification de la connexion à la base
        if (!$conn) {
            die("Erreur de connexion à la base de données: " . mysqli_connect_error());
        }

        // Requête sécurisée avec préparation pour éviter les injections SQL
        $sql = "SELECT * FROM employes WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Vérifier si le mot de passe est haché
            if (password_verify($password, $user['mot_de_passe'])) {
                // Authentification réussie
                $_SESSION['user'] = $user['email'];
                header("Location: dashboard.php");
                exit;
            } else {
                $error_message = "Identifiants incorrects (mot de passe erroné).";
            }
        } else {
            $error_message = "Identifiants incorrects (email non trouvé).";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SmartTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8fb;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 10px;
        }
        .btn {
            width: 100%;
            padding: 10px;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Connexion à SmartTech</h2>

    <?php if (!empty($error_message)): ?>
        <div class="error-message">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="email" name="email" class="form-control" placeholder="Email" required><br>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required><br>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
