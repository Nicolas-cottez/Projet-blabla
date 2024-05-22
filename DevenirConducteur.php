<?php include 'backend.php'; ?>

<?php
if (isset($_POST['ok'])) {
    // Récupération des données du formulaire
    $Modele = htmlspecialchars($_POST['Modele']);
    $Plaque = htmlspecialchars($_POST['Plaque']);

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

    // Vérifiez si le fichier existe déjà
    if (file_exists($target_file1) || file_exists($target_file2)) {
        echo "Désolé, un des fichiers existe déjà.";
        $uploadOk = 0;
    }

    // Limite les formats de fichier
    if (($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" && $imageFileType1 != "gif") || 
        ($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" && $imageFileType2 != "gif")) {
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

    // Préparation de la requête SQL
    $query1 = "INSERT INTO conducteur (Cagnotte, Permis) VALUES (:Cagnotte, :Permis)";
    $query2 = "INSERT INTO vehicule (Modele, Plaque, PhotoV) VALUES (:Modele, :Plaque, :PhotoV)";
    
    $stmt1 = $db->prepare($query1);
    $stmt2 = $db->prepare($query2);

    // Exécution des requêtes avec les paramètres
    $stmt1->execute([
        ':Cagnotte' => 0,  // ou une autre valeur par défaut pour la cagnotte
        ':Permis' => $Permis
    ]);

    $stmt2->execute([
        ':Modele' => $Modele,
        ':Plaque' => $Plaque,
        ':PhotoV' => $PhotoV
    ]);

    header("location: clientinscrit.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devenir Conducteur</title>
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Votre permis</label>
        <input type="file" id="Permis" name="Permis" required>
        <br />
        <label>Votre Modèle de voiture</label>
        <input type="text" id="Modele" name="Modele" placeholder="Entrez le modèle..." required>
        <br />
        <label>Photo de la voiture</label>
        <input type="file" id="PhotoV" name="PhotoV" placeholder="Photo voiture" required>
        <br />
        <label>Plaque du véhicule</label>
        <input type="text" id="Plaque" name="Plaque" placeholder="Entrez votre plaque..." required>
        <br />
        <input type="submit" value="M'inscrire" name="ok">
    </form>
</body>
</html>
