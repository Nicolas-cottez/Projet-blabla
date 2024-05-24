<?php
// Connexion à la base de données
include 'backend.php';

// Requête pour sélectionner les trajets et les informations du conducteur
$query = $db->query('
    SELECT trajet.*, client.Photo AS conducteurPhoto, client.preferences AS conducteurPreferences, client.Modele AS Modele
    FROM trajet 
    JOIN client ON trajet.ID_conducteur = client.ID_client
');
$trajets = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['reserve'])) {
    $ID_trajet = htmlspecialchars($_POST['ID_trajet']);
    $ID_conducteur = htmlspecialchars($_POST['ID_conducteur']);
    $prix = htmlspecialchars($_POST['prix']);
    $token = $_COOKIE['token'];

    // Récupérer la cagnotte actuelle du conducteur
    $query = $db->prepare('SELECT cagnotte FROM client WHERE ID_client = :ID_conducteur');
    $query->execute([':ID_conducteur' => $ID_conducteur]);
    $conducteur = $query->fetch(PDO::FETCH_ASSOC);

    // Ajouter le prix du trajet à la cagnotte du conducteur
    $nouvelle_cagnotte = $conducteur['cagnotte'] + $prix;

    // Mettre à jour la cagnotte du conducteur dans la base de données
    $query = $db->prepare('UPDATE client SET cagnotte = :nouvelle_cagnotte WHERE ID_client = :ID_conducteur');
    $query->execute([':nouvelle_cagnotte' => $nouvelle_cagnotte, ':ID_conducteur' => $ID_conducteur]);

    // Récupérer la cagnotte actuelle de l'utilisateur
    $query = $db->prepare('SELECT cagnotte FROM client WHERE token = :token');
    $query->execute([':token' => $token]);
    $utilisateur = $query->fetch(PDO::FETCH_ASSOC);

    // Soustraire le prix du trajet de la cagnotte de l'utilisateur
    $nouvelle_cagnotte = $utilisateur['cagnotte'] - $prix;

    // Mettre à jour la cagnotte de l'utilisateur dans la base de données
    $query = $db->prepare('UPDATE client SET cagnotte = :nouvelle_cagnotte WHERE token = :token');
    $query->execute([':nouvelle_cagnotte' => $nouvelle_cagnotte, ':token' => $token]);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des trajets</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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

<body>
    <?php include 'Header.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Liste des trajets</h1>
        <table class="min-w-full bg-white border">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Distance</th>
                    <th class="px-4 py-2">Départ</th>
                    <th class="px-4 py-2">Arrivée</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Prix</th>
                    <th class="px-4 py-2">Nombre de places</th>
                    <th class="px-4 py-2">Photo Conducteur</th>
                    <th class="px-4 py-2">Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trajets as $index => $trajet): ?>
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
                    <td class="px-4 py-2">
                        <button onclick="toggleDetails('<?php echo $index; ?>')" class="bg-blue-500 text-white px-4 py-2 rounded">Plus de détails</button>
                        <button onclick="reserver(<?php echo $trajet['ID_trajet']; ?>)" class="bg-green-500 text-white px-4 py-2 rounded">Réserver</button>
                    </td>
                </tr>
                <tr id="details-<?php echo $index; ?>" style="display: none;">
                    <td colspan="9" class="px-4 py-2">
                        Modèle: <?php echo htmlspecialchars($trajet['Modele']); ?><br>
                        Préférences Conducteur: <?php echo htmlspecialchars($trajet['conducteurPreferences']); ?>
                    </td>
                </tr>
                <tr id="details-<?php echo $trajet; ?>" style="display: none;">
                    <td colspan="9" class="px-4 py-2">
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="search.js"></script>
    <?php include 'footer.php'; ?>
</body>

</html>