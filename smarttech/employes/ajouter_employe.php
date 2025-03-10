<?php
include('C:\xampp\htdocs\smarttech\connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
    $poste = $_POST['poste'];
    $email = $_POST['email'];
    $matricule = $_POST['matricule'];


    // Hacher le mot de passe avant de l'enregistrer
    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);


    // Vérifier si le champ email est vide
    if (empty($email)) {
        echo "L'email ne peut pas être vide.";
    } else {
        // Vérifier si l'email existe déjà dans la base de données
        $sql_check = "SELECT * FROM employes WHERE email = '$email'";
        $result = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result) > 0) {
            echo "Cet email est déjà utilisé.";
        } else {
            // Préparer la requête d'insertion
            $sql = "INSERT INTO employes (prenom, nom, adresse, mot_de_passe, poste, email, matricule) 
                    VALUES ('$prenom', '$nom', '$adresse', '$mot_de_passe', '$poste', '$email', '$matricule')";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['mot_de_passe'])) {
                    $mot_de_passe = $_POST['mot_de_passe'];
                } else {
                    echo "Mot de passe non défini.";
                }
            }
            

            if (mysqli_query($conn, $sql)) {
                header("Location: afficher_employes.php");
                exit();
            } else {
                echo "Erreur : " . mysqli_error($conn);
            }
            
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Ajouter un Employé</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                <div class="mb-3">
                        <label class="form-label">Matricule</label>
                        <input type="text" name="matricule" class="form-control" required>
                    </div>
                <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" name="adresse" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="mot_de_passe" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="poste">Poste</label>
                        <select name="poste" id="poste" class="form-control" required>
                            <option value="Développeur(se) Backend">Développeur(se) Backend</option>
                            <option value="Développeur(se) Frontend">Développeur(se) Frontend</option>
                            <option value="Ingénieur(e) DevOps">Ingénieur(e) DevOps</option>
                            <option value="Administrateur(trice) Systèmes & Réseaux">Administrateur(trice) Systèmes & Réseaux</option>
                            <option value="Data Analyst">Data Analyst</option>
                            <option value="Responsable Cybersécurité">Responsable Cybersécurité</option>
                            <option value="Chef(fe) de Projet IT">Chef(fe) de Projet IT</option>
                            <option value="Support Technique">Support Technique</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
