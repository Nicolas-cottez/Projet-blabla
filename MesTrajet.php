<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Trajet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Mes trajets - Blabla Omnes</title>
</head>

<body class="fond">
    <?php include 'header.php'; ?>
    <?php include 'backend.php'; ?>

    <h1 class="titre">Mes trajets :</h1>

    <div class="flex-container">
        <div class="flex-item">
            <h2>Trajets en cours :</h2>
            <?php
            try {
                $requete = $db->query("SELECT * FROM trajet WHERE Date >= CURDATE() ORDER BY `Date` ASC");
                $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
                if ($resultat) {
                    foreach ($resultat as $trajet) {
                        echo '<div class="grid-container">';
                        echo '<div class="grid-item item1"><h3>' . htmlspecialchars($trajet['Depart'] ?? '') . '<span> ==> </span>' . htmlspecialchars($trajet['arrivee'] ?? '') . '</h3></div>';
                        echo '<div class="grid-item item2">Date: ' . htmlspecialchars($trajet['Date'] ?? '') . '</div>';
                        echo '<div class="grid-item item3">Distance: ' . htmlspecialchars($trajet['Distance'] ?? '') . ' km</div>';
                        echo '<div class="grid-item item4">Prix: ' . htmlspecialchars($trajet['prix'] ?? '') . ' €</div>';
                        echo '<div class="grid-item item5">';
                        echo '<form method="post" action="annuler_trajet.php">';
                        echo '<input type="hidden" name="ID_trajet" value="' . htmlspecialchars($trajet['ID_trajet'] ?? '') . '">';
                        echo '<button type="submit" class="btn-supprimer">Annuler</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucun trajet en cours.</p>';
                }
            } catch (PDOException $e) {
                echo '<p>Erreur : ' . htmlspecialchars($e->getMessage()) . '</p>';
            }
            ?>
        </div>
    </div>
    <div class="bouton_centre">
        <button class="button button1" onclick="window.location.href='TrajetPasse.php'">Trajets passés</button>
        <button class="button button2" onclick="window.location.href='main.php'">Retour menu</button>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>
