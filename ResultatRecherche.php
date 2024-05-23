<?php
// Connexion à la base de données
include 'backend.php';

// Requête pour sélectionner les trajets et les informations du conducteur
$query = $db->query('
    SELECT trajet.*, client.Photo AS conducteurPhoto, client.preferences AS conducteurPreferences 
    FROM trajet 
    JOIN client ON trajet.ID_conducteur = client.ID_client
');
$trajets = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des trajets</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Liste des trajets</h1>
        <table class="min-w-full bg-white border">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/6 px-4 py-2">Distance</th>
                    <th class="w-1/6 px-4 py-2">Départ</th>
                    <th class="w-1/6 px-4 py-2">Arrivée</th>
                    <th class="w-1/6 px-4 py-2">Date</th>
                    <th class="w-1/6 px-4 py-2">Prix</th>
                    <th class="w-1/6 px-4 py-2">Nombre de places</th>
                    <th class="w-1/6 px-4 py-2">Photo Conducteur</th>
                    <th class="w-1/6 px-4 py-2">Préférences Conducteur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trajets as $trajet): ?>
                <tr class="border-t">
                    <td class="px-4 py-2"><?php echo htmlspecialchars($trajet['Distance']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($trajet['Depart']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($trajet['arrivee']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($trajet['Date']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($trajet['prix']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($trajet['Nb_personne']); ?></td>
                    <td class="px-4 py-2">
                        <img src="<?php echo 'uploads/' . htmlspecialchars($trajet['conducteurPhoto']); ?>" alt="Photo du conducteur" class="w-16 h-16 object-cover">
                    </td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($trajet['conducteurPreferences']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
