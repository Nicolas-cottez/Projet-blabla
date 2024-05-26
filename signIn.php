<?php

// Définition des paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$MDP = "";

// Tentative de connexion à la base de données
try {
    $bdd = new PDO("mysql:host=$servername;dbname=projet_blablacar", $username, $MDP);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, affichez l'erreur
    echo "Erreur BDD : " . $e->getMessage();
}

// Vérifiez si la méthode de la requête est POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Récupérez les données du formulaire
    $mail = htmlspecialchars($_POST['mail']);
    $MDP = $_POST['MDP']; // Pas besoin de hasher ici

    // Vérifiez si les champs ne sont pas vides
    if (!empty($mail) && !empty($MDP)) {
        // Récupérez l'utilisateur correspondant au mail
        $stmt = $bdd->prepare("SELECT * FROM client WHERE mail = :mail");
        $stmt->execute(['mail' => $mail]);
        $user = $stmt->fetch();

        // Vérifiez si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($MDP, $user['MDP'])) {
            // Générez un nouveau token pour l'utilisateur
            $token = bin2hex(random_bytes(16));
            // Mettez à jour le token de l'utilisateur dans la base de données
            $updateStmt = $bdd->prepare("UPDATE client SET token = :token WHERE mail = :mail");
            $updateStmt->execute(['token' => $token, 'mail' => $mail]);

            // Définissez les cookies pour le token et le mail
            setcookie("token", $token, time() + 3600, "/", "", false, true);
            setcookie("mail", $mail, time() + 3600, "/", "", false, true);

            // Vérifiez si l'utilisateur est administrateur
            if ($user['Admin'] == 1) {
                // Si oui, redirigez vers la page administrateur
                header("Location: ./administrateur/administrateur.php");
            } else {
                // Sinon, redirigez vers la page principale
                header("Location: main.php");
            }

            exit();
        } else {
            // Si l'email ou le mot de passe est incorrect, affichez un message d'erreur
            echo 'Email ou mot de passe incorrect';
            // Et redirigez vers la page de connexion
            header("Location: SignInUp.php");
        }
    }
}
// Si la méthode de la requête n'est pas POST, redirigez vers la page de connexion
header("Location: SignInUp.php");
?>