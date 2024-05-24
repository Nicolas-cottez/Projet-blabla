<?php include 'backend.php';
?>

<?php
if (isset($_POST['ok'])) {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $Prenom = htmlspecialchars($_POST['Prenom']);
    $Num_Tel = htmlspecialchars($_POST['Num_Tel']);
    $mail = htmlspecialchars($_POST['mail']);
    $MDP = password_hash($_POST['MDP'], PASSWORD_DEFAULT);

    // Gestion de l'upload de la photo
    $target_dir = "uploads/";
    $photo = basename($_FILES["Photo"]["name"]);
    $target_file = $target_dir . $photo;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifiez si le fichier image est une image réelle ou une fausse image
    $check = getimagesize($_FILES["Photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }

    // Vérifiez si le fichier existe déjà
    if (file_exists($target_file)) {
        echo "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }

    // Limite les formats de fichier
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifiez si $uploadOk est à 0 à cause d'une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    } else {
        if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file)) {
            echo "Le fichier " . htmlspecialchars(basename($_FILES["Photo"]["name"])) . " a été téléchargé.";
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }

    $allowed_domains = ["omnesintervenant.com", "ece.fr", "edu.ece.fr"];
    $email_domain = substr(strrchr($mail, "@"), 1);

    if (!in_array($email_domain, $allowed_domains)) {
        echo "L'adresse e-mail doit appartenir aux domaines suivants : omnesintervenant.com, ece.fr ou edu.ece.fr";
        header("location: matt.php");
        exit();
    }

    $query = "SELECT * FROM client WHERE mail = :mail";
    $stmt = $db->prepare($query);
    $stmt->execute([':mail' => $mail]);
    $user = $stmt->fetch();
    if ($user) {
        // L'adresse e-mail existe déjà, affichez un message d'erreur
        echo "L'adresse e-mail est déjà utilisée.";
    } else {
        // Préparation de la requête SQL
        $query = "INSERT INTO client (nom, Prenom, mail, MDP, Num_Tel, Photo, cagnotte) VALUES (:nom, :Prenom, :mail, :MDP, :Num_Tel, :photo, 0) ";
        $stmt = $db->prepare($query);

        // Exécution de la requête avec les paramètres
        $stmt->execute([
            ':nom' => $nom,
            ':Prenom' => $Prenom,
            ':mail' => $mail,
            ':MDP' => $MDP,
            ':Num_Tel' => $Num_Tel,
            ':photo' => $photo
        ]);


        // Gestion des cookies pour maintenir l'utilisateur connecté
        $token = bin2hex(random_bytes(16));

        // Mise à jour du token dans la base de données
        $updateStmt = $db->prepare("UPDATE client SET token = :token WHERE mail = :mail");
        $updateStmt->execute(['token' => $token, 'mail' => $mail]);

        // Définir les cookies
        setcookie("token", $token, time() + 10800, "/", "", false, true);
        setcookie("mail", $mail, time() + 10800, "/", "", false, true);

        // Redirection après l'inscription
        exit();

    }


}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Blabla Omnes</title>
</head>

<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Votre nom</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom..." required>
        <br />
        <label>Votre prénom</label>
        <input type="text" id="Prenom" name="Prenom" placeholder="Entrez votre prénom..." required>
        <br />
        <label>Votre photo</label>
        <input type="file" id="Photo" name="Photo" required>
        <br />
        <label>Votre numéro de tél</label>
        <input type="text" id="Num_Tel" name="Num_Tel" placeholder="Entrez votre numéro..." required>
        <br />
        <label>Votre email</label>
        <input type="email" id="mail" name="mail" placeholder="Entrez votre email..." required>
        <br />
        <label>Votre mot de passe</label>
        <input type="password" id="MDP" name="MDP" placeholder="Entrez votre mot de passe..." required>
        <br />
        <input type="submit" value="M'inscrire" name="ok">
        <label><a href="SeConnecterTest.php">Se connecter</a></label>
    </form>
</body>

</html>