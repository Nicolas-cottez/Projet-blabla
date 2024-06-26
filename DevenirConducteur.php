<?php include 'backend.php'; ?>

<?php
if (isset($_COOKIE['token']) && isset($_COOKIE['mail'])) {
    $token = $_COOKIE['token'];
    $mail = $_COOKIE['mail'];

    // Vérifier le token dans la base de données
    $query = "SELECT ID_client FROM client WHERE mail = :mail AND token = :token";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':mail' => $mail,
        ':token' => $token
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $ID_client = $result['ID_client'];
        // Vérifier l'état du conducteur
        $query = "SELECT Etat_conducteur FROM client WHERE ID_client = :ID_client";
        $stmt = $db->prepare($query);
        $stmt->execute([':ID_client' => $ID_client]);
        $conducteur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($conducteur && $conducteur['Etat_conducteur'] === 1) {
            header("Location: main.php");
            exit;
        }
        if (isset($_POST['ok'])) {
            // Récupération des données du formulaire
            $Modele = htmlspecialchars($_POST['Modele']);
            $Plaque = htmlspecialchars($_POST['Plaque']);
            $preferences = htmlspecialchars($_POST['preferences']);

            // Gestion de l'upload de la photo
            $target_dir = "uploads/";
            $PhotoV = basename($_FILES["PhotoV"]["name"]);
            $Permis = basename($_FILES["Permis"]["name"]);
            $target_file1 = $target_dir . $PhotoV;
            $target_file2 = $target_dir . $Permis;
            $uploadOk = 1;
            $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
            $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

            // Vérifiez si les fichiers image sont réels ou faux
            $check1 = getimagesize($_FILES["PhotoV"]["tmp_name"]);
            $check2 = getimagesize($_FILES["Permis"]["tmp_name"]);
            if ($check1 !== false && $check2 !== false) {
                $uploadOk = 1;
            } else {
                echo "Un des fichiers n'est pas une image.";
                $uploadOk = 0;
            }

            // Limite les formats de fichier
            if (($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" && $imageFileType1 != "gif") ||
                ($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" && $imageFileType2 != "gif")
            ) {
                echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                $uploadOk = 0;
            }

            // Vérifiez si $uploadOk est à 0 à cause d'une erreur
            if ($uploadOk == 0) {
                echo "Désolé, vos fichiers n'ont pas été téléchargés.";
            } else {
                if (move_uploaded_file($_FILES["PhotoV"]["tmp_name"], $target_file1) && move_uploaded_file($_FILES["Permis"]["tmp_name"], $target_file2)) {
                    echo "Le fichier " . htmlspecialchars(basename($_FILES["PhotoV"]["name"])) . " a été téléchargé.";
                    echo "Le fichier " . htmlspecialchars(basename($_FILES["Permis"]["name"])) . " a été téléchargé.";
                } else {
                    echo "Désolé, une erreur s'est produite lors du téléchargement de vos fichiers.";
                }
            }

            // Préparation de la requête SQL pour mettre à jour le conducteur avec son ID client
            $query = "UPDATE client SET permis = :Permis, Modele = :Modele, PhotoV = :PhotoV, Plaque = :Plaque, preferences = :preferences WHERE ID_client = :ID_client";
            $stmt = $db->prepare($query);

            // Exécution de la requête avec les paramètres
            $stmt->execute([
                ':Permis' => $Permis,
                ':Modele' => $Modele,
                ':PhotoV' => $PhotoV,
                ':Plaque' => $Plaque,
                ':ID_client' => $ID_client,
                ':preferences' => $preferences

            ]);

            header("location: fin_de_requete/clientinscrit.php");
            exit();
        }
    } else {
        header("Location: SignInUp.php");
        exit();
    }
} else {
    header("Location: SignInUp.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DevenirConducteur.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" /><!--inclu les fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Devenir Conducteur</title>
</head>

<body>
        <?php include 'Header.php'; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Votre permis</label>
        <input type="file" class="formInput" id="Permis" name="Permis" required>

        <label>Votre Modèle de voiture</label>
        <input type="text" class="formInput" id="Modele" name="Modele" placeholder="Entrez le modèle..." required>

        <label>Photo de la voiture</label>
        <input type="file" class="formInput" id="PhotoV" name="PhotoV" placeholder="Photo voiture" required>

        <label>Plaque du véhicule</label>
        <input type="text" class="formInput" id="Plaque" name="Plaque" placeholder="Entrez votre plaque..." required>

        <label>Preferences</label>
        <input type="text" class="formInput" id="preferences" name="preferences" placeholder="Entrez vos preferences..." required>

        <input type="submit" value="M'inscrire" name="ok">
        <a href="main.php"><button type="button">Menu</button></a>
    </form>
</body>

</html>
