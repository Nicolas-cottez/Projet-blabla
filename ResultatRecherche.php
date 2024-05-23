<?php
// Connexion à la base de données
include 'backend.php';

// Requête pour sélectionner toutes les entrées de la table "trajet"
$query = $db->query('SELECT * FROM trajet');
$trajets = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des trajets</title>
</head>
<body>
    <h1>Liste des trajets</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Distance</th>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Date</th>
                <!-- Ajoutez d'autres colonnes selon votre structure de données -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trajets as $trajet): ?>
            <tr>
                <td><?php echo $trajet['Distance']; ?></td>
                <td><?php echo $trajet['Depart']; ?></td>
                <td><?php echo $trajet['arrivee']; ?></td>
                <td><?php echo $trajet['Date']; ?></td>
                <!-- Ajoutez d'autres cellules selon votre structure de données -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>