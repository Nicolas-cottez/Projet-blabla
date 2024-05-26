<?php include '../backend.php'; ?>
<?php


if (isset($_POST['ajouter'])) {
    $nom_campus = htmlspecialchars($_POST['nom_campus']);
    $adresse = htmlspecialchars($_POST['adresse']);

    $query = "INSERT INTO campus (nom_campus, adresse) VALUES (:nom_campus, :adresse)";
    $stmt = $db->prepare($query);
    
    $stmt->execute([
        ':nom_campus' => $nom_campus,
        ':adresse' => $adresse
    ]);

}

if(isset($_POST['supprimer'])) {
    $nom_campus = htmlspecialchars($_POST['nom_campus']);
    
    $query = "DELETE FROM campus WHERE nom_campus = :nom_campus";
    $stmt = $db->prepare($query);
    
    $stmt->execute([
        ':nom_campus' => $nom_campus
    ]);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des campus</title>
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
    </style>
</head>
<a href="administrateur.php"><button>Retour au menu</button></a>
<body>
    
    <table>
        <tr>
            <th>Nom du campus</th>
            <th>Adresse</th>
        </tr>

        <h1>Ajouter un campus :</h1>
        <form method="POST" action="">
        <input type="number" id="nom_campus" name="nom_campus" placeholder="Nom du campus" required>
        <input type="text" id="adresse" name="adresse" placeholder="Adresse du campus" required>
        <input type="submit" value="Ajouter" name="ajouter">
        <br>
        </form>

        <h1>Supprimer un campus :</h1>
        <form method="POST" action="">
        <input type="number" id="nom_campus" name="nom_campus" placeholder="Nom du campus" required>
        <input type="submit" value="Supprimer" name="supprimer">
        </form>

        <h1>Liste des diffÃ©rents campus :</h1>
        </body>
        </html>

        <?php
        $query = "SELECT nom_campus, adresse FROM campus";
        $stmt = $db->query($query);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nom_campus']) . "</td>";
            echo "<td>" . htmlspecialchars($row['adresse']) . "</td>";
            echo "</tr>";
        }

        ?>