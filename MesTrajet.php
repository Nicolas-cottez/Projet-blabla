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
        function toggleDetails(id) {
            var details = document.getElementById('details-' + id);
            if (details.style.display === 'none') {
                details.style.display = 'table-row';
            } else {
                details.style.display = 'none';
            }
        }
    </script>
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
                // Requête pour sélectionner les trajets et les informations du conducteur
                $requete = $db->query("
                    SELECT trajet.*, client.Photo AS conducteurPhoto, client.preferences AS conducteurPreferences, client.Modele AS Modele, client.Num_Tel as Num_Tel
                    FROM trajet
                    JOIN client ON trajet.ID_conducteur = client.ID_client
                    WHERE trajet.Date >= CURDATE()
                    ORDER BY trajet.Date ASC
                ");
                $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

                if ($resultat) {
                    foreach ($resultat as $index => $trajet) {
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
                        echo '<button onclick="toggleDetails(\'' . $index . '\')" class="btn-details">Détails</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div id="details-' . $index . '" class="details" style="display: none;">';
                        echo '<div class="grid-item item6">Modèle: ' . htmlspecialchars($trajet['Modele'] ?? '') . '</div>';
                        echo '<div class="grid-item item7">Préférences Conducteur: ' . htmlspecialchars($trajet['conducteurPreferences'] ?? '') . '</div>';
                        echo '<div class="grid-item item7">Numero de tel: ' . htmlspecialchars($trajet['Num_Tel'] ?? '') . '</div>';
                        echo '<div class="grid-item item8"><img src="uploads/' . htmlspecialchars($trajet['conducteurPhoto'] ?? '') . '" alt="Photo du conducteur" class="conducteur-photo"></div>';
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
