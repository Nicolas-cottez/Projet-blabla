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
                <select name="departure" id="departure" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php
                    $reponse = $db->query('SELECT adresse FROM campus');
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
                    $reponse = $db->query('SELECT adresse FROM campus');
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
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>


   
