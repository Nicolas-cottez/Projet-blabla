<?php
$servername = "localhost";
$username = "root";
$MDP = "";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=projet_blablacar", $username, $MDP);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur BDD : " . $e->getMessage();
    exit();
}

// Vérifiez si les cookies sont définis
if (isset($_COOKIE['token']) && isset($_COOKIE['mail'])) {
    $token = $_COOKIE['token'];
    $mail = $_COOKIE['mail'];

    // Requête pour récupérer les informations de l'utilisateur
    $stmt = $bdd->prepare("SELECT * FROM client WHERE mail = :mail AND token = :token");
    $stmt->execute(['mail' => $mail, 'token' => $token]);
    $user = $stmt->fetch();

    // Si l'utilisateur est trouvé
    if (!$user) {
        header("Location: SeConnecterTest.php");
        exit();
    }
} else {
    header("Location: SeConnecterTest.php");
    exit();
}

// Maintenant, vous pouvez inclure votre code de recherche de trajet ici



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Depart = $_POST['depart'];
    $arrivee = $_POST['arrivee'];
    $date = $_POST['date'];
    $heuredep = $_POST['heuredep'];

    $requete = $bdd->prepare("
        SELECT * FROM trajet
        WHERE Depart = :Depart AND arrivee = :arrivee AND Date = :date AND heuredep = :heuredep
    ");
    $requete->execute([
        ':Depart' => $Depart,
        ':arrivee' => $arrivee,
        ':date' => $date,
        ':heuredep' => $heuredep,
    ]);
    $trajets = $requete->fetchAll(PDO::FETCH_ASSOC);

    if ($trajets) {
        foreach ($trajets as $trajet) {
            // Affichez les détails du trajet ici
        }
    } else {
        echo '<p>Aucun trajet trouvé.</p>';
    }
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
    <link rel="stylesheet" href="Trajet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Recherche de trajet - Blabla Omnes</title>
</head>

<body class="fond">
    <?php include 'header.php'; ?>
    <?php include 'backend.php'; ?>

    <h1 class="titre">Recherche de trajet :</h1>

    <div class="flex-container">
        <div class="flex-item">
            <form method="post" action="">
                <label for="depart">Départ :</label>
                <input type="text" id="depart" name="depart" required>

                <label for="arrivee">Arrivée :</label>
                <input type="text" id="arrivee" name="arrivee" required>

                <label for="date">Date :</label>
                <input type="date" id="date" name="date" required>

                <label for="heuredep">Heure de départ :</label>
                <input type="time" id="heuredep" name="heuredep" required>

                <label for="nom_campus">ID Campus :</label>
                <input type="text" id="nom_campus" name="nom_campus" required>

                <input type="submit" value="Rechercher">
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $Depart = $_POST['depart'];
                $arrivee = $_POST['arrivee'];
                $date = $_POST['date'];
                $heuredep = $_POST['heuredep'];
            
                $query = $bdd->prepare("
                    SELECT * FROM trajet
                    WHERE Depart = :Depart AND arrivee = :arrivee AND Date = :date AND heuredep = :heuredep
                ");
                $query->execute([
                    ':Depart' => $Depart,
                    ':arrivee' => $arrivee,
                    ':date' => $date,
                    ':heuredep' => $heuredep,
                ]);
                $trajets = $query->fetchAll(PDO::FETCH_ASSOC);
            
                if ($trajets) {
                    foreach ($trajets as $trajet) {
                        // Affichez les détails du trajet ici
                    }
                } else {
                    echo '<p>Aucun trajet trouvé.</p>';
                }
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>

   