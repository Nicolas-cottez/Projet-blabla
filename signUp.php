<?php
include 'backend.php';

if (isset($_POST['ok'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $Prenom = htmlspecialchars($_POST['Prenom']);
    $Num_Tel = htmlspecialchars($_POST['Num_Tel']);
    $mail = htmlspecialchars($_POST['mail']);
    $MDP = password_hash($_POST['MDP'], PASSWORD_DEFAULT); 

    if (isset($_FILES['Photo']) ) {
        $Photo = basename($_FILES["Photo"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $Photo;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["Photo"]["tmp_name"]);
        if ($check !== false) {
            if (file_exists($target_file)) {
                echo "Désolé, le fichier existe déjà.";
                $uploadOk = 0;
            }

            if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1 && move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file)) {
                echo "Le fichier " . htmlspecialchars($Photo) . " a été téléchargé.";
            } else {
                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
                $Photo = null; 
            }
        } else {
            echo "Le fichier n'est pas une image.";
            $Photo = null;
        }
    } else {
        echo "Aucun fichier 'Photo' fourni ou erreur lors de l'upload.";
        $Photo = null;
    }

    $allowed_domains = ["omnesintervenant.com", "ece.fr", "edu.ece.fr"];
    //pareil pour num a faire
    $email_domain = substr(strrchr($mail, "@"), 1);

    if (!in_array($email_domain, $allowed_domains)) {
        echo "L'adresse e-mail doit appartenir aux domaines suivants : omnesintervenant.com, ece.fr ou edu.ece.fr";
        header("location: signInUp.php");
        exit();
    }

    // Préparation de la requête SQL
    $query = "INSERT INTO client (nom, Prenom, mail, MDP, Num_Tel, Photo) VALUES (:nom, :Prenom, :mail, :MDP, :Num_Tel, :Photo)";
    $stmt = $db->prepare($query);

    // Exécution de la requête avec les paramètres
    $stmt->execute([
        ':nom' => $nom,
        ':Prenom' => $Prenom,
        ':mail' => $mail,
        ':MDP' => $MDP,
        ':Num_Tel' => $Num_Tel,
        ':Photo' => $Photo
    ]);

    // Gestion des cookies pour maintenir l'utilisateur connecté
    $token = bin2hex(random_bytes(16));

    // Mise à jour du token dans la base de données
    $updateStmt = $db->prepare("UPDATE client SET token = :token WHERE mail = :mail");
    $updateStmt->execute(['token' => $token, 'mail' => $mail]);

    // Définir les cookies
    setcookie("token", $token, time() + 3600, "/", "", false, true);
    setcookie("mail", $mail, time() + 3600, "/", "", false, true);

    // Redirection après l'inscription
    header("location: clientinscrit.php");
    exit();

}