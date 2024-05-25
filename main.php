<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'backend.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script><!--inclu tailwind-->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /><!--inclu les fonts-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>BlaBLA Omnes</title>
</head>

<body>
    <?php include 'Header.php'; ?>

    <article>
        <h2>Trouvez votre covoiturage!</h2>
    </article>

    <main class="p-4">
        <form id="searchForm" class="search-bar mt-4">
            <select id="departure" name="departure" class="destination-select search-input">
                <?php
                $reponse = $db->query('       SELECT Depart AS adresse FROM trajet
                UNION
                SELECT Arrivee AS adresse FROM trajet
                UNION
                SELECT adresse FROM campus
                WHERE nom_campus NOT IN (SELECT DISTINCT nom_campus FROM trajet)');
                while ($donnees = $reponse->fetch()) {
                ?>
                    <option value="<?php echo htmlspecialchars($donnees['adresse']); ?>">
                        <?php echo htmlspecialchars($donnees['adresse']); ?>
                    </option>
                <?php
                }
                $reponse->closeCursor();
                ?>
            </select>
        
            <select id="destination" name="destination" class="destination-select search-input">
                <?php
                $reponse = $db->query('   SELECT Depart AS adresse FROM trajet
                UNION
                SELECT Arrivee AS adresse FROM trajet
                UNION
                SELECT adresse FROM campus
                WHERE nom_campus NOT IN (SELECT DISTINCT nom_campus FROM trajet)');
                while ($donnees = $reponse->fetch()) {
                ?>
                    <option value="<?php echo htmlspecialchars($donnees['adresse']); ?>">
                        <?php echo htmlspecialchars($donnees['adresse']); ?>
                    </option>
                <?php
                }
                $reponse->closeCursor();
                ?>
            </select>
            <input type="date" id="date" name="date" class="search-input">
            <input type="number" id="passengers" name="passengers" placeholder="passager" class="search-input">
            <button type="submit" class="search-button">Rechercher</button>
        </form>
    </main>

    <section class="covoiturage-highlight">
        <h1>"Partagez plus qu'un trajet, partagez une expérience."</h1>
    </section>

    <content class="story-section">
        <div class="story-image">
            <img src="image\covoiturage.jpg" alt="personnage dans voiture">
        </div>
        <div class="story-content">
            <h2>Embarquez pour des anecdotes passionnantes.</h2>
            <p>Avec Blabla Omnes, les rencontres font partie des voyages.</p>
            <br>
            <button>En route !</button>
        </div>
    </content>
    
    <?php include 'footer.php'; ?>

    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(event) {
                event.preventDefault(); // Empêche le rechargement de la page
                var formData = $(this).serialize(); // Sérialise les données du formulaire

                console.log("Formulaire soumis"); // Vérifie que le formulaire est soumis
                console.log("Form data: " + formData); // Vérifie les données du formulaire

                $.ajax({
                    url: 'vava.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log("Réponse du serveur : " + response); // Vérifie la réponse du serveur
                        var data = JSON.parse(response);
                        if (data.status === 'error') {
                            alert(data.message); // Affiche le message d'erreur
                        } else {
                            alert('Recherche réussie !');
                            // Traitez la réponse réussie ici (par exemple, rediriger ou afficher les résultats)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur AJAX : " + status + " " + error);
                    }
                });
            });
        });
    </script>
</body>

</html>