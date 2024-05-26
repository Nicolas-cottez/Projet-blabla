
    <?php
    include 'backend.php';

    // Vérifier si l'utilisateur est connecté et obtenir l'ID_client
    if (isset($_COOKIE['token']) && isset($_COOKIE['mail'])) {
        $token = $_COOKIE['token'];
        $mail = $_COOKIE['mail'];

        // Vérifier le token dans la base de données
        $query = "SELECT ID_client FROM client WHERE mail = :mail AND token = :token";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':mail' => $mail,
            ':token' => $token
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $ID_client = $result['ID_client'];
        } else {
            header("Location: SignInUp.php");
            exit();
        }
    } else {
        header("Location: SignInUp.php");
        exit();
    }
    include 'header.php';
    ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Trajet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Mes trajets - Blabla Omnes</title>
    <script>
        function toggleDetails(id, type) {
            var details = document.getElementById('details-' + type + '-' + id);
            if (details.style.display === 'none') {
                details.style.display = 'table-row';
            } else {
                details.style.display = 'none';
            }
        }
    </script>
</head>

<body class="fond">
    <h1 class="titre">Mes trajets :</h1>

    <div class="flex-container">
        <div class="flex-item">
            <h2>Trajets en cours (client) :</h2>
            
            
            <?php
            // Récupérer les trajets en cours en tant que client
            $requete = $db->prepare("
                SELECT trajet.*, client.Photo AS conducteurPhoto, client.preferences AS conducteurPreferences, client.Modele AS Modele, client.Num_Tel as Num_Tel
                FROM trajet
                JOIN client ON trajet.ID_conducteur = client.ID_client
                JOIN participe ON trajet.ID_trajet = participe.ID_trajet
                WHERE trajet.Date >= CURDATE() AND TIME(trajet.HeureDep) >= TIME(NOW()) AND participe.ID_client = :ID_client
                ORDER BY trajet.Date ASC, trajet.HeureDep ASC
            ");
            $requete->execute([':ID_client' => $ID_client]);
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            if ($resultat) {
                foreach ($resultat as $index => $trajet) {
                    echo '<div class="grid-container">';
                    echo '<div class="grid-item item1"><h3>' . htmlspecialchars($trajet['Depart'] ?? '') . '<span> ==> </span>' . htmlspecialchars($trajet['arrivee'] ?? '') . '</h3></div>';
                    echo '<div class="grid-item item2">Date: ' . htmlspecialchars($trajet['Date'] ?? '') . '</div>';
                    echo '<div class="grid-item item4">Distance: ' . htmlspecialchars($trajet['Distance'] ?? '') . ' km</div>';
                    echo '<div class="grid-item item5">Prix: ' . htmlspecialchars($trajet['prix'] ?? '') . ' €</div>';
                    echo '<div class="grid-item item6"><img src="uploads/' . htmlspecialchars($trajet['conducteurPhoto'] ?? '') . '" alt="Photo du conducteur" class="conducteur-photo -"></div>';
                    echo '<div class="grid-item item7">';
                    echo '<form method="post" action="annuler_trajet.php">';
                    echo '<input type="hidden" name="ID_trajet" value="' . htmlspecialchars($trajet['ID_trajet'] ?? '') . '">';
                    echo '<button type="submit" class="btn-supprimer">Annuler</button>';
                    echo '</form>';
                    echo '<button onclick="toggleDetails(\'' . $trajet['ID_trajet'] . '\', \'client\')" class="btn-details">Détails</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div id="details-client-' . $trajet['ID_trajet'] . '" class="details" style="display: none;">';
                    echo '<div class="grid-item item8">Modèle: ' . htmlspecialchars($trajet['Modele'] ?? '') . '</div>';
                    echo '<div class="grid-item item9">Préférences Conducteur: ' . htmlspecialchars($trajet['conducteurPreferences'] ?? '') . '</div>';
                    echo '<div class="grid-item item10">Numéro de tel: ' . htmlspecialchars($trajet['Num_Tel'] ?? '') . '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Aucun trajet en cours.</p>';
            }
            ?>

            <h2>Trajets en cours (conducteur) :</h2>
            <?php
            // Vérifier si l'utilisateur est un conducteur
            $query = $db->prepare('SELECT ID_client, Etat_conducteur FROM client WHERE token = :token');
            $query->execute([':token' => $token]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $ID_client = $user['ID_client'];
            $is_conducteur = $user['Etat_conducteur'];

            if ($is_conducteur == 1) {
                // Récupérer les trajets en cours en tant que conducteur
                $requete = $db->prepare("
                    SELECT trajet.*, client.Photo AS conducteurPhoto, client.preferences AS conducteurPreferences, client.Modele AS Modele, client.Num_Tel as Num_Tel, GROUP_CONCAT(reservant.Num_Tel) as ReservantNums
                    FROM trajet
                    JOIN client ON trajet.ID_conducteur = client.ID_client
                    LEFT JOIN participe ON trajet.ID_trajet = participe.ID_trajet
                    LEFT JOIN client as reservant ON participe.ID_client = reservant.ID_client
                    WHERE trajet.Date >= CURDATE() AND TIME(trajet.HeureDep) >= TIME(NOW()) AND trajet.ID_conducteur = :ID_client
                    GROUP BY trajet.ID_trajet
                    ORDER BY trajet.Date ASC, trajet.HeureDep ASC
                ");
                $requete->execute([':ID_client' => $ID_client]);
                $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

                if ($resultat) {
                    foreach ($resultat as $index => $trajet) {
                        echo '<div class="grid-container">';
                        echo '<div class="grid-item item1"><h3>' . htmlspecialchars($trajet['Depart'] ?? '') . '<span> ==> </span>' . htmlspecialchars($trajet['arrivee'] ?? '') . '</h3></div>';
                        echo '<div class="grid-item item2">Date: ' . htmlspecialchars($trajet['Date'] ?? '') . '</div>';
                        echo '<div class="grid-item item4">Distance: ' . htmlspecialchars($trajet['Distance'] ?? '') . ' km</div>';
                        echo '<div class="grid-item item5">Prix: ' . htmlspecialchars($trajet['prix'] ?? '') . ' €</div>';
                        echo '<div class="grid-item item6"><img src="uploads/' . htmlspecialchars($trajet['conducteurPhoto'] ?? '') . '" alt="Photo du conducteur" class="conducteur-photo UserPicture"></div>';
                        echo '<div class="grid-item item7">';
                        echo '<form method="post" action="annuler_trajet.php">';
                        echo '<input type="hidden" name="ID_trajet" value="' . htmlspecialchars($trajet['ID_trajet'] ?? '') . '">';
                        echo '<button type="submit" class="btn-supprimer">Annuler</button>';
                        echo '</form>';
                        echo '<button onclick="toggleDetails(\'' . $index . '\', \'conducteur\')" class="btn-details">Détails</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div id="details-conducteur-' . $index . '" class="details" style="display: none;">';
                        echo '<div class="grid-item item8">Modèle: ' . htmlspecialchars($trajet['Modele'] ?? '') . '</div>';
                        echo '<div class="grid-item item9">Préférences Conducteur: ' . htmlspecialchars($trajet['conducteurPreferences'] ?? '') . '</div>';
                        echo '<div class="grid-item item10">Numéro de tel: ' . htmlspecialchars($trajet['Num_Tel'] ?? '') . '</div>';
                        echo '<div class="grid-item">Numéros de téléphone des clients : ' . htmlspecialchars($trajet['ReservantNums'] ?? '') . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucun trajet en cours.</p>';
                }
            } else {
                echo "Vous n'êtes pas un conducteur.";
            }
            ?>
        </div>
        <a href="TrajetPasse.php"><button>Mes trajets passés</button></a>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>
