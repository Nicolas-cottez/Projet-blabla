<?php
include 'backend.php'; // Inclure le fichier backend.php qui contient probablement des fonctions et des configurations de base de données

// Vérifier si le formulaire a été soumis
if (isset($_POST['ok'])) {
    // Récupérer et nettoyer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $Prenom = htmlspecialchars($_POST['Prenom']);
    $Num_Tel = htmlspecialchars($_POST['Num_Tel']);
    $mail = htmlspecialchars($_POST['mail']);
    $MDP = password_hash($_POST['MDP'], PASSWORD_DEFAULT); // Hacher le mot de passe pour des raisons de sécurité

    // Vérifier si une photo a été téléchargée
    if (isset($_FILES['Photo'])) {
        // Traiter le fichier téléchargé
        $Photo = basename($_FILES["Photo"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $Photo;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérifier si le fichier est une image
        $check = getimagesize($_FILES["Photo"]["tmp_name"]);
        if ($check !== false) {
            // Vérifier si le fichier existe déjà
            if (file_exists($target_file)) {
                echo "Désolé, le fichier existe déjà.";
                $uploadOk = 0;
            }

            // Vérifier le type de fichier
            if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                $uploadOk = 0;
            }

            // Déplacer le fichier téléchargé vers le répertoire cible
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

    // Vérifier le domaine de l'adresse e-mail
    $allowed_domains = ["omnesintervenant.com", "ece.fr", "edu.ece.fr"];
    $email_domain = substr(strrchr($mail, "@"), 1);
    if (!in_array($email_domain, $allowed_domains)) {
        echo "L'adresse e-mail doit appartenir aux domaines suivants : omnesintervenant.com, ece.fr ou edu.ece.fr";
        header("location: signInUp.php");
        exit();
    }

    // Préparer la requête SQL pour insérer les données dans la base de données
    $query = "INSERT INTO client (nom, Prenom, mail, MDP, Num_Tel, Photo) VALUES (:nom, :Prenom, :mail, :MDP, :Num_Tel, :Photo)";
    $stmt = $db->prepare($query);

    // Exécuter la requête avec les paramètres
    $stmt->execute([
        ':nom' => $nom,
        ':Prenom' => $Prenom,
        ':mail' => $mail,
        ':MDP' => $MDP,
        ':Num_Tel' => $Num_Tel,
        ':Photo' => $Photo
    ]);

    // Gérer les cookies pour maintenir l'utilisateur connecté
    $token = bin2hex(random_bytes(16));

    // Mettre à jour le token dans la base de données
    $updateStmt = $db->prepare("UPDATE client SET token = :token WHERE mail = :mail");
    $updateStmt->execute(['token' => $token, 'mail' => $mail]);

    // Définir les cookies
    setcookie("token", $token, time() + 3600, "/", "", false, true);
    setcookie("mail", $mail, time() + 3600, "/", "", false, true);

    // Rediriger l'utilisateur après l'inscription
    header("location: fin_de_requete/clientinscrit.php");
    exit();
}