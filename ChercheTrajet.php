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
    // En cas d'erreur de connexion, affichez l'erreur et terminez le script
    echo "Erreur BDD : " . $e->getMessage();
    exit();
}

// Vérifiez si les cookies 'token' et 'mail' sont définis
if (isset($_COOKIE['token']) && isset($_COOKIE['mail'])) {
    $token = $_COOKIE['token'];
    $mail = $_COOKIE['mail'];

    // Récupérez l'utilisateur correspondant au mail et au token
    $stmt = $bdd->prepare("SELECT * FROM client WHERE mail = :mail AND token = :token");
    $stmt->execute(['mail' => $mail, 'token' => $token]);
    $user = $stmt->fetch();

    // Si aucun utilisateur ne correspond, redirigez vers SignInUp.php
    if (!$user) {
        header("Location: SignInUp.php");
        exit();
    }
} else {
    // Si les cookies ne sont pas définis, redirigez vers SignInUp.php
    header("Location: SignInUp.php");
    exit();
}

// Si la méthode de la requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Depart = $_POST['depart'];
    $arrivee = $_POST['arrivee'];
    $date = $_POST['date'];
    $heuredep = $_POST['heuredep'];

    // Redirigez vers ResultatRecherche.php avec les paramètres de la requête
    header("Location: ResultatRecherche.php?depart=$Depart&arrivee=$arrivee&date=$date&heuredep=$heuredep");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="ChercheTrajet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Recherche de trajet - Blabla Omnes</title>
</head>

<body class="fond">
    <?php include 'header.php'; ?>
    <?php include 'backend.php'; ?>

    <h1 class="titre">Recherche de trajet :</h1>
    <div class="form-container">
        <form method="post" action="">
            <div class="form-item">
                <label for="depart">Départ :</label>
                <input type="text" id="depart" name="depart" required>
            </div>
            <div class="form-item">
                <label for="arrivee">Arrivée :</label>
                <input type="text" id="arrivee" name="arrivee" required>
            </div>
            <div class="form-item">
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-item">
                <label for="heuredep">Heure de départ :</label>
                <input type="time" id="heuredep" name="heuredep" required>
            </div>
            <div class="form-item">
                <input type="submit" value="Rechercher">
            </div>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>