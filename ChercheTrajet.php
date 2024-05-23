<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'backend.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chercher un trajet - Blabla Omnes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body class="bg-gray-400">
    <?php include 'Header.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Chercher un trajet</h1>
        <form id="searchForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <!-- Departure Select -->
            <div class="mb-4">
                <label for="departure" class="block text-gray-700 text-sm font-bold mb-2">Départ:</label>
                <select name="departure" id="departure" class="destination-select shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
            </div>
            <!-- Destination Select -->
            <div class="mb-4">
                <label for="destination" class="block text-gray-700 text-sm font-bold mb-2">Destination:</label>
                <select id="destination" name="destination" class="destination-select shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <?php
                $reponse = $db->query('SELECT Depart AS adresse FROM trajet UNION SELECT Arrivee AS adresse FROM trajet
                UNION SELECT adresse FROM campus
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
            <!-- Other form elements -->
            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
                <input type="date" id="date" name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Rechercher
                </button>
            </div>
        </form>
        <div id="results" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <!-- Les résultats de la recherche seront affichés ici -->
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('.destination-select').select2({
            placeholder: "Tapez ou sélectionnez une option",
            allowClear: true
        });
    });
    $(document).ready(function() {
            $('#searchForm').on('submit', function(event) {
                event.preventDefault(); // Empêche le rechargement de la page
                var formData = $(this).serialize(); // Sérialise les données du formulaire

                console.log("Formulaire soumis"); // Vérifie que le formulaire est soumis
                console.log("Form data: " + formData); // Vérifie les données du formulaire

                $.ajax({
                    url: 'test.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log("Réponse du serveur : " + response); // Vérifie la réponse du serveur
                        var data = JSON.parse(response);
                        if (data.status === 'error') {
                            alert(data.message); // Affiche le message d'erreur
                        } else {
                    // Rediriger vers une nouvelle page PHP si la recherche est réussie
                    window.location.href = 'ResultatRecherche.php';
                
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur AJAX : " + status + " " + error);
                    }
                });
            });
        });
    </script>
    <?php include 'footer.php'; ?>

    <<style>
    .select2-container--default .select2-selection--single {
        background-color: #fff; /* bg-white */
        border: 1px solid #d1d5db; /* border-gray-300 */
        border-radius: 0.375rem; /* rounded-md */
        height: 2.875rem; /* hauteur totale pour aligner le texte verticalement */
        padding-top: 0.5rem; /* py-2 */
        padding-bottom: 0.5rem; /* py-2 */
        padding-left: 1rem; /* pl-4 */
        padding-right: 1rem; /* pr-4 */
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #4b5563; /* text-gray-700 */
        line-height: 1.75rem; /* leading-tight */
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 50%;
        right: 1rem; /* pr-4 */
        transform: translateY(-50%);
    }
    .select2-container .select2-dropdown {
        border-color: #d1d5db; /* border-gray-300 */
        border-radius: 0.375rem; /* rounded-md */
    }
    .select2-container .select2-search--dropdown .select2-search__field {
        border-radius: 0.375rem; /* rounded-md */
    }
</style>
</body>
</html>

   