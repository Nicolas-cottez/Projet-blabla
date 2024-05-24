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
<a href="administrateur.php"><button>Retour au menu</button></a>
    
<h1> Voulez vous valider le permis d'un client ?</h1>
<form method="POST" action="">
        <input type="number" id="ID_client" name="ID_client" placeholder="ID du client à valider..." required>
        <input type="submit" value="Valider" name="valider">
        <br>
        </form>

<h1> Liste des clients en attente de validation du permis :</h1>
<table>
<tr>
        <th>ID du client</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Photo</th>
        <th>Photo du permis</th>
        <th>Modèle de la voiture</th>
        <th>Plaque de la voiture</th>
    </tr>
    <?php 
    if(isset($_POST['valider'])) {
        $ID_client = htmlspecialchars($_POST['ID_client']);
        
        $query = "UPDATE client SET Etat_conducteur = 1 WHERE ID_client = :ID_client";
        $stmt = $db->prepare($query);
        
        $stmt->execute([
            ':ID_client' => $ID_client
        ]);
    }
    
    // Requête pour récupérer les clients en attente de validation du permis
    $query = "SELECT ID_client, nom, Prenom, Photo, permis, Modele, Plaque FROM client WHERE Etat_conducteur = 0";
    $stmt = $db->query($query);


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $photo_path = '../uploads/' . htmlspecialchars($row['Photo']);
        $permis_path = '../uploads/' . htmlspecialchars($row['permis']);

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['ID_client']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Prenom']) . "</td>";
        echo "<td><img src='" . $photo_path . "' alt='Photo'></td>";
        echo "<td><img src='" . $permis_path . "' alt='Photo du permis'></td>";
        echo "<td>" . htmlspecialchars($row['Modele']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Plaque']) . "</td>";
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>
