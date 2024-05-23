<?php include '../backend.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des permis</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    
<h1> Liste des clients en attente de validation du permis :</h1>
<table>
<tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Photo</th>
        <th>Photo du permis</th>
        <th>Modèle de la voiture</th>
        <th>Plaque de la voiture</th>
    </tr>
    <?php 
    // Requête pour récupérer les clients en attente de validation du permis
    $query = "SELECT nom, Prenom, Photo, permis, Modele, Plaque FROM client WHERE Etat_conducteur = 1";
    $stmt = $db->query($query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Prenom']) . "</td>";
        echo "<td><img src='path/to/photo/directory/" . htmlspecialchars($row['Photo']) . "' alt='Photo'></td>";
        echo "<td><img src='path/to/permis/directory/" . htmlspecialchars($row['permis']) . "' alt='Photo du permis'></td>";
        echo "<td>" . htmlspecialchars($row['Modele']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Plaque']) . "</td>";
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>
