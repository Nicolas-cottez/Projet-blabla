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

    <h1>Ajouter ou modifier un client :</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Son ID :</label>
        <input type="number" id="ID_client" name="ID_client">
        <br>
        <label>Son nom :</label>
        <input type="text" id="nom" name="nom"><br>
        <label>Son prenom :</label>
        <input type="text" id="Prenom" name="Prenom"><br>
        <label>Son mail :</label>
        <input type="text" id="mail" name="mail"><br>
        <label>Son mdp :</label>
        <input type="text" id="MDP" name="MDP"><br>
        <label>Sa Photo :</label>
        <input type="file" id="Photo" name="Photo"><br>
        <label>Son numero :</label>
        <input type="number" id="Num_Tel" name="Num_Tel"><br>
        <label>Son état de conducteur :</label>
        <input type="checkbox" id="Etat_conducteur" name="Etat_conducteur" value="1"><br>
        <label>La Photo de son permis :</label>
        <input type="file" id="permis" name="permis"><br>
        <label>Son modele de voiture :</label>
        <input type="text" id="Modele" name="Modele"><br>
        <label>La Photo de sa voiture :</label>
        <input type="file" id="PhotoV" name="PhotoV"><br>
        <label>La plaque de sa voiture :</label>
        <input type="text" id="Plaque" name="Plaque"><br>
        <label>Ses préférences :</label>
        <input type="preferences" id="preferences" name="preferences"><br>
        <label>Sa cagnotte :</label>
        <input type="cagnotte" id="cagnotte" name="cagnotte"><br>
        <label>Admin :</label>
        <input type="checkbox" id="Admin" name="Admin" value="1"><br>
        <input type="submit" value="Ajouter" name="ajouter">
        <br>
    </form>

    <h1> Supprimer un client :</h1>
    <form method="POST" action="">

        <input type="number" id="ID_client" name="ID_client" placeholder="Id du client" required>
        <input type="submit" value="supprimer" name="supprimer">

    </form>

    <h1> Data base de tous les clients :</h1>
    <table>
        <tr>
            <th>ID du client</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>mail</th>
            <th>Photo</th>
            <th>Num tel</th>
            <th>Etat conducteur</th>
            <th>Photo du permis</th>
            <th>Modèle de la voiture</th>
            <th>Photo de la voiture</th>
            <th>Plaque de la voiture</th>
            <th>Préférences</th>
            <th>Cagnotte</th>
            <th>Admin</th>
        </tr>
        <?php

        if (isset($_POST['supprimer'])) {
            $ID_client = htmlspecialchars($_POST['ID_client']);

            $query = "DELETE  FROM client WHERE ID_client = :ID_client";
            $stmt = $db->prepare($query);

            $stmt->execute([
                ':ID_client' => $ID_client
            ]);
        }

        if (isset($_POST['ajouter'])) {

            $ID_client = htmlspecialchars($_POST['ID_client']);
            // Vérifiez si l'ID du client existe déjà
            $query = $db->prepare('SELECT * FROM client WHERE ID_client = :ID_client');
            $query->execute([':ID_client' => $ID_client]);
            $client = $query->fetch(PDO::FETCH_ASSOC);


            $nom = htmlspecialchars($_POST['nom']);
            $Prenom = htmlspecialchars($_POST['Prenom']);
            $Num_Tel = htmlspecialchars($_POST['Num_Tel']);
            $mail = htmlspecialchars($_POST['mail']);
            $MDP = password_hash($_POST['MDP'], PASSWORD_DEFAULT);
            $Etat_conducteur = isset($_POST['Etat_conducteur']) ? htmlspecialchars($_POST['Etat_conducteur']) : 0;
            $Modele = htmlspecialchars($_POST['Modele']);
            $Plaque = htmlspecialchars($_POST['Plaque']);
            $preferences = htmlspecialchars($_POST['preferences']);
            $cagnotte = htmlspecialchars($_POST['cagnotte']);
            $Admin = isset($_POST['Admin']) ? htmlspecialchars($_POST['Admin']) : 0;



            if ($client) {
                // Si l'ID du client existe déjà, mettez à jour les informations du client
                $query = 'UPDATE client SET ';
                $params = [':ID_client' => $ID_client];
                $fields = ['nom', 'Prenom', 'Num_Tel', 'mail', 'MDP', 'Etat_conducteur', 'Modele', 'Plaque', 'Photo', 'permis', 'PhotoV', 'Admin', 'preferences', 'cagnotte'];
                foreach ($fields as $field) {
                    if (!empty($_POST[$field])) {
                        $query .= "$field = :$field, ";
                        $params[":$field"] = $_POST[$field];
                    }
                }
                // Gestion des fichiers téléchargés
                $target_dir = "../uploads/";
                $PhotoV = isset($_FILES["PhotoV"]["name"]) ? basename($_FILES["PhotoV"]["name"]) : null;
                $permis = isset($_FILES["permis"]["name"]) ? basename($_FILES["permis"]["name"]) : null;
                $Photo = isset($_FILES["Photo"]["name"]) ? basename($_FILES["Photo"]["name"]) : null;
                $target_file1 = $target_dir . $PhotoV;
                $target_file2 = $target_dir . $permis;
                $target_file3 = $target_dir . $Photo;

                // Ajoutez votre code pour gérer le téléchargement des fichiers ici...
                // Par exemple, vous pouvez utiliser move_uploaded_file pour déplacer les fichiers téléchargés vers le répertoire cible
        
                // Ajoutez les noms des fichiers aux paramètres de la requête
                if ($PhotoV) {
                    if (move_uploaded_file($_FILES["PhotoV"]["tmp_name"], $target_file1)) {
                        echo "Le fichier " . htmlspecialchars(basename($_FILES["PhotoV"]["name"])) . " a été téléchargé.";
                    } else {
                        echo "Désolé, une erreur s'est produite lors du téléchargement de vos fichiers.";
                    }
                    $query .= "PhotoV = :PhotoV, ";
                    $params[":PhotoV"] = $PhotoV;
                }
                if ($permis) {
                    if (move_uploaded_file($_FILES["permis"]["tmp_name"], $target_file2)) {
                        echo "Le fichier " . htmlspecialchars(basename($_FILES["permis"]["name"])) . " a été téléchargé.";
                    } else {
                        echo "Désolé, une erreur s'est produite lors du téléchargement de vos fichiers.";
                    }
                    $query .= "permis = :permis, ";
                    $params[":permis"] = $permis;
                }
                if ($Photo) {
                    if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file3)) {
                        echo "Le fichier " . htmlspecialchars(basename($_FILES["Photo"]["name"])) . " a été téléchargé.";
                    } else {
                        echo "Désolé, une erreur s'est produite lors du téléchargement de vos fichiers.";
                    }
                    $query .= "Photo = :Photo, ";
                    $params[":Photo"] = $Photo;
                }

                $query = rtrim($query, ', ') . ' WHERE ID_client = :ID_client';
                $stmt = $db->prepare($query);
                $stmt->execute($params);
            } else {
                // Si l'ID du client n'existe pas, ajoutez un nouveau client
                // Votre code pour ajouter un nouveau client...
                // Préparation de la requête SQL
                $target_dir = "../uploads/";
                $PhotoV = isset($_FILES["PhotoV"]["name"]) ? basename($_FILES["PhotoV"]["name"]) : null;
                $permis = isset($_FILES["permis"]["name"]) ? basename($_FILES["permis"]["name"]) : null;
                $Photo = isset($_FILES["Photo"]["name"]) ? basename($_FILES["Photo"]["name"]) : null;
                $target_file1 = $target_dir . $PhotoV;
                $target_file2 = $target_dir . $permis;
                $target_file3 = $target_dir . $Photo;
                $uploadOk = 1;
                $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
                $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
                $imageFileType3 = strtolower(pathinfo($target_file3, PATHINFO_EXTENSION));

                $check1 = isset($_FILES["PhotoV"]["tmp_name"]) ? getimagesize($_FILES["PhotoV"]["tmp_name"]) : false;
                $check2 = isset($_FILES["permis"]["tmp_name"]) ? getimagesize($_FILES["permis"]["tmp_name"]) : false;
                $check3 = isset($_FILES["Photo"]["tmp_name"]) ? getimagesize($_FILES["Photo"]["tmp_name"]) : false;
                if ($check1 !== false && $check2 !== false && $check3 !== false) {
                    $uploadOk = 1;
                } else {
                    echo "Un des fichiers n'est pas une image.";
                    $uploadOk = 0;
                }

                // Limite les formats de fichier
                if (
                    ($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" && $imageFileType1 != "gif") ||
                    ($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" && $imageFileType2 != "gif") ||
                    ($imageFileType3 != "jpg" && $imageFileType3 != "png" && $imageFileType3 != "jpeg" && $imageFileType3 != "gif")
                ) {
                    echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                    $uploadOk = 0;
                }

                // Vérifiez si $uploadOk est à 0 à cause d'une erreur
                if ($uploadOk == 0) {
                    echo "Désolé, vos fichiers n'ont pas été téléchargés.";
                } else {
                    if (move_uploaded_file($_FILES["PhotoV"]["tmp_name"], $target_file1) && move_uploaded_file($_FILES["permis"]["tmp_name"], $target_file2) && move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file3)) {
                        echo "Le fichier " . htmlspecialchars(basename($_FILES["PhotoV"]["name"])) . " a été téléchargé.";
                        echo "Le fichier " . htmlspecialchars(basename($_FILES["permis"]["name"])) . " a été téléchargé.";
                        echo "Le fichier " . htmlspecialchars(basename($_FILES["Photo"]["name"])) . " a été téléchargé.";
                    } else {
                        echo "Désolé, une erreur s'est produite lors du téléchargement de vos fichiers.";
                    }
                }
                $query = "INSERT INTO client (ID_client, nom, Prenom, mail, MDP, Photo, Num_Tel, Etat_conducteur, permis, Modele, PhotoV, Plaque, Admin, preferences, cagnotte) VALUES (:ID_client, :nom, :Prenom, :mail, :MDP, :Photo, :Num_Tel, :Etat_conducteur, :permis, :Modele, :PhotoV, :Plaque, :Admin, :preferences, :cagnotte)";                $stmt = $db->prepare($query);

                // Exécution de la requête avec les paramètres
                $stmt->execute([
                    ':ID_client' => $ID_client,
                    ':nom' => $nom,
                    ':Prenom' => $Prenom,
                    ':mail' => $mail,
                    ':MDP' => $MDP,
                    ':Photo' => $Photo,
                    ':Num_Tel' => $Num_Tel,
                    ':Etat_conducteur' => $Etat_conducteur,
                    ':permis' => $permis,
                    ':Modele' => $Modele,
                    ':PhotoV' => $PhotoV,
                    ':Plaque' => $Plaque,
                    ':preferences' => $preferences,
                    ':cagnotte' => $cagnotte,
                    ':Admin' => $Admin
                ]);


            }
        }


        // Requête pour récupérer les clients en attente de validation du permis
        $query = "SELECT * FROM client";
        $stmt = $db->query($query);


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $Photo_path = '../uploads/' . htmlspecialchars($row['Photo']);
            $permis_path = '../uploads/' . htmlspecialchars($row['permis']);
            $voiture_path = '../uploads/' . htmlspecialchars($row['PhotoV']);

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ID_client']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Prenom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mail']) . "</td>";
            echo "<td><img src='" . $Photo_path . "' alt='Photo'></td>";
            echo "<td>" . htmlspecialchars($row['Num_Tel']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Etat_conducteur']) . "</td>";
            echo "<td><img src='" . $permis_path . "' alt='Photo du permis'></td>";
            echo "<td>" . htmlspecialchars($row['Modele']) . "</td>";
            echo "<td><img src='" . $voiture_path . "' alt='Photo de la voiture'></td>";
            echo "<td>" . htmlspecialchars($row['Plaque']) . "</td>";
            echo "<td>" . htmlspecialchars($row['preferences']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cagnotte']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Admin']) . "</td>";
            echo "</tr>";
        }
        ?>


    </table>
</body>

</html>