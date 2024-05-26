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
        <input type="number" id="Distance" name="Distance"><br>
        <label>Sa durée:</label>
        <input type="time" id="Duree" name="Duree"><br>
        <label>Sa Date :</label>
        <input type="date" id="Date" name="Date"><br>
        <label>Son heure de départ :</label>
        <input type="time" id="heuredep" name="heuredep"><br>
        <label>Son prix :</label>
        <input type="number" id="prix" name="prix"><br>
        <label>Le nombre de passager :</label>
        <input type="number" id="Nb_personne" name="Nb_personne"><br>
        <label>Le nom du campus :</label>
        <input type="number" id="nom_campus" name="nom_campus"><br>
        <label>L'ID du conducteur :</label>
        <input type="number" id="ID_conducteur" name="ID_conducteur"><br>

        <input type="submit" value="Ajouter/Modifier" name="ajouter">
        <br>
    </form>
    
    <h1> Supprimer un trajet :</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>L'ID du trajet :</label>
        <input type="number" id="ID_trajet" name="ID_trajet">
        <br>
        <input type="submit" value="Supprimer" name="supprimer_trajet">
        <br>
    </form>

    <h1> Ajouter un passager :</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>L'ID du trajet :</label>
        <input type="number" id="ID_trajet" name="ID_trajet">
        <br>
        <label>L'ID du passager :</label>
        <input type="number" id="ID_client" name="ID_client"><br>
        <input type="submit" value="Ajouter" name="ajouter_passager">
        <br>
    </form>
    <h1> Supprimer un passager :</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>L'ID du trajet :</label>
        <input type="number" id="ID_trajet" name="ID_trajet">
        <br>
        <label>L'ID du passager :</label>
        <input type="number" id="ID_client" name="ID_client"><br>
        <input type="submit" value="Supprimer" name="supprimer_passager">
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

        if (isset($_POST['supprimer_passager'])) {
            $ID_trajet = htmlspecialchars($_POST['ID_trajet']);
            $ID_client = htmlspecialchars($_POST['ID_client']);

            // Vérifiez si le trajet et le client existent
            $query = $db->prepare('SELECT * FROM trajet WHERE ID_trajet = :ID_trajet');
            $query->execute([':ID_trajet' => $ID_trajet]);
            $trajet = $query->fetch(PDO::FETCH_ASSOC);

            $query = $db->prepare('SELECT * FROM client WHERE ID_client = :ID_client');
            $query->execute([':ID_client' => $ID_client]);
            $client = $query->fetch(PDO::FETCH_ASSOC);

            if ($trajet && $client) {
                // Si le trajet et le client existent, supprimez le client du trajet
                $query = $db->prepare('DELETE FROM participe WHERE ID_trajet = :ID_trajet AND ID_client = :ID_client');
                $query->execute([':ID_trajet' => $ID_trajet, ':ID_client' => $ID_client]);
                echo "Le client a été supprimé du trajet.";
            } else {
                echo "Erreur : Le trajet ou le client n'existe pas.";
            }

        }

        if (isset($_POST['supprimer_trajet'])) {
            $ID_trajet = htmlspecialchars($_POST['ID_trajet']);
        
            // Vérifiez si le trajet existe
            $query = $db->prepare('SELECT * FROM trajet WHERE ID_trajet = :ID_trajet');
            $query->execute([':ID_trajet' => $ID_trajet]);
            $trajet = $query->fetch(PDO::FETCH_ASSOC);
        
            if ($trajet) {
                // Si le trajet existe, supprimez tous les passagers du trajet
                $query = $db->prepare('DELETE FROM participe WHERE ID_trajet = :ID_trajet');
                $query->execute([':ID_trajet' => $ID_trajet]);
        
                // Ensuite, supprimez le trajet lui-même
                $query = $db->prepare('DELETE FROM trajet WHERE ID_trajet = :ID_trajet');
                $query->execute([':ID_trajet' => $ID_trajet]);
        
                echo "Le trajet et tous les passagers ont été supprimés.";
            } else {
                echo "Erreur : Le trajet n'existe pas.";
            }
        }

        if (isset($_POST['ajouter_passager'])) {
            $ID_trajet = htmlspecialchars($_POST['ID_trajet']);
            $ID_client = htmlspecialchars($_POST['ID_client']);

            // Vérifiez si le trajet et le client existent
            $query = $db->prepare('SELECT * FROM trajet WHERE ID_trajet = :ID_trajet');
            $query->execute([':ID_trajet' => $ID_trajet]);
            $trajet = $query->fetch(PDO::FETCH_ASSOC);

            $query = $db->prepare('SELECT * FROM client WHERE ID_client = :ID_client');
            $query->execute([':ID_client' => $ID_client]);
            $client = $query->fetch(PDO::FETCH_ASSOC);

            if ($trajet && $client) {
                // Si le trajet et le client existent, ajoutez le client au trajet
                $query = $db->prepare('INSERT INTO participe (ID_trajet, ID_client) VALUES (:ID_trajet, :ID_client)');
                $query->execute([':ID_trajet' => $ID_trajet, ':ID_client' => $ID_client]);
                echo "Le client a été ajouté au trajet.";
            } else {
                echo "Erreur : Le trajet ou le client n'existe pas.";
            }
        }

        if (isset($_POST['ajouter'])) {


            $ID_trajet = htmlspecialchars($_POST['ID_trajet']);
            $query = $db->prepare('SELECT * FROM trajet WHERE ID_trajet = :ID_trajet');
            $query->execute([':ID_trajet' => $ID_trajet]);
            $client = $query->fetch(PDO::FETCH_ASSOC);

            $ID_trajet = htmlspecialchars($_POST['ID_trajet']);
            $Depart = htmlspecialchars($_POST['Depart']);
            $arrivee = htmlspecialchars($_POST['arrivee']);
            $Distance = htmlspecialchars($_POST['Distance']);
            $Duree = htmlspecialchars($_POST['Duree']);
            $Date = htmlspecialchars($_POST['Date']);
            $heuredep = htmlspecialchars($_POST['heuredep']);
            $prix = htmlspecialchars($_POST['prix']);
            $Nb_personne = htmlspecialchars($_POST['Nb_personne']);
            $nom_campus = htmlspecialchars($_POST['nom_campus']);
            $ID_conducteur = htmlspecialchars($_POST['ID_conducteur']);

            if ($client) {
                // Si l'ID du client existe déjà, mettez à jour les informations du client
                $query = 'UPDATE trajet SET ';
                $params = [':ID_trajet' => $ID_trajet];
                $fields = ['Depart', 'arrivee', 'Distance', 'Duree', 'Date', 'heuredep', 'prix', 'Nb_personne', 'nom_campus', 'ID_conducteur'];
                foreach ($fields as $field) {
                    if (!empty($_POST[$field])) {
                        $query .= "$field = :$field, ";
                        $params[":$field"] = $_POST[$field];
                    }
                }
                $query = rtrim($query, ', ') . ' WHERE ID_trajet = :ID_trajet';
                $stmt = $db->prepare($query);
                $stmt->execute($params);
            } else {
                // Si l'ID du client n'existe pas, ajoutez un nouveau client
                // Votre code pour ajouter un nouveau client...
                // Préparation de la requête SQL
                $fields = ['ID_trajet', 'Depart', 'arrivee', 'Distance', 'Duree', 'Date', 'heuredep', 'prix', 'Nb_personne', 'nom_campus', 'ID_conducteur'];
                $values = [];
                foreach ($fields as $field) {
                    if (empty($_POST[$field])) {
                        echo "Erreur : Le champ $field n'est pas rempli.<br>";
                        return;
                    }
                    $values[":$field"] = htmlspecialchars($_POST[$field]);
                }
                $query = "INSERT INTO trajet (ID_trajet, Depart, arrivee, Distance, Duree, Date, heuredep, prix, Nb_personne, nom_campus, ID_conducteur) VALUES (:ID_trajet, :Depart, :arrivee, :Distance, :Duree, :Date, :heuredep, :prix, :Nb_personne, :nom_campus, :ID_conducteur)";
                $stmt = $db->prepare($query);

                $stmt->execute([
                    ':ID_trajet' => $ID_trajet,
                    ':Depart' => $Depart,
                    ':arrivee' => $arrivee,
                    ':Distance' => $Distance,
                    ':Duree' => $Duree,
                    ':Date' => $Date,
                    ':heuredep' => $heuredep,
                    ':prix' => $prix,
                    ':Nb_personne' => $Nb_personne,
                    ':nom_campus' => $nom_campus,
                    ':ID_conducteur' => $ID_conducteur
                ]);
            }

        }

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
