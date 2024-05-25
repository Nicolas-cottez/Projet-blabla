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

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
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
    <a href="administrateur.php"><button>Retour au menu</button></a>

    <h1>modifier les data d'un trajet :</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Son ID :</label>
        <input type="number" id="ID_trajet" name="ID_trajet">
        <br>
        <label>Son départ :</label>
        <input type="text" id="Depart" name="Depart"><br>
        <label>Son arrivée :</label>
        <input type="text" id="arrivee" name="arrivee"><br>
        <label>Sa distance :</label>
        <input type="text" id="Distance" name="Distance"><br>
        <label>Sa durée:</label>
        <input type="time" id="Duree" name="Duree"><br>
        <label>Sa Date :</label>
        <input type="text" id="Duree" name="Duree"><br>
        <label>Son heure de départ :</label>
        <input type="file" id="Photo" name="Photo"><br>
        <label>Son prix :</label>
        <input type="number" id="Num_Tel" name="Num_Tel"><br>
        <label>Le nombre de passager :</label>
        <input type="checkbox" id="Etat_conducteur" name="Etat_conducteur" value="1"><br>
        <label>Le nom du campus :</label>
        <input type="file" id="permis" name="permis"><br>
        

        <input type="submit" value="Ajouter" name="ajouter">
        <br>
    </form>

    <h1> Data base de tous les trajet :</h1>
    <table>
        <tr>
            <th>ID du trajet</th>
            <th>Depart</th>
            <th>Arrivée</th>
            <th>Distance</th>
            <th>Durée</th>
            <th>Date</th>
            <th>Heure du départ</th>
            <th>Prix</th>
            <th>Nombre de passager</th>
            <th>Nom du campus</th>
            <th>ID du conducteur</th>
            <th>Passagers</th>
        </tr>
        <?php

        // Requête pour récupérer les clients en attente de validation du permis
        $query = "
        SELECT trajet.*, GROUP_CONCAT(client.ID_client SEPARATOR ', ') AS Passagers
        FROM trajet
        LEFT JOIN participe ON trajet.ID_trajet = participe.ID_trajet
        LEFT JOIN client ON participe.ID_client = client.ID_client
        GROUP BY trajet.ID_trajet
        ";
        $stmt = $db->query($query);


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ID_trajet']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Depart']) . "</td>";
            echo "<td>" . htmlspecialchars($row['arrivee']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Distance']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Duree']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['heuredep']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prix']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Nb_personne']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nom_campus']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ID_conducteur']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Passagers']) . "</td>";
            echo "</tr>";
        }

        ?>