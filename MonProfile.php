<?php
$servername = "localhost";
$username = "root";
$MDP = "";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=projet_blablacar", $username, $MDP);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur BDD : " . $e->getMessage();
    exit();
}

// Vérifiez si les cookies sont définis
if (isset($_COOKIE['token']) && isset($_COOKIE['mail'])) {
    $token = $_COOKIE['token'];
    $mail = $_COOKIE['mail'];

    // Requête pour récupérer les informations de l'utilisateur
    $stmt = $bdd->prepare("SELECT * FROM client WHERE mail = :mail AND token = :token");
    $stmt->execute(['mail' => $mail, 'token' => $token]);
    $user = $stmt->fetch();

    // Si l'utilisateur est trouvé
    if ($user) {
        $nom = htmlspecialchars($user['nom']);
        $Prenom = htmlspecialchars($user['Prenom']);
        $email = htmlspecialchars($user['mail']);
        $Num_Tel = htmlspecialchars($user['Num_Tel']);
        $MDP = htmlspecialchars($user['MDP']);
        $Photo = htmlspecialchars($user['Photo']);
        $cagnotte = htmlspecialchars($user['cagnotte']); // Nouveau champ photo
        $Etat_conducteur = $user['Etat_conducteur']; // Vérifier si l'utilisateur est un conducteur

        // Si la photo n'existe pas, utilisez une image par défaut
        $photoPath = !empty($Photo) ? "uploads/$Photo" : "image/default.jpg";
        if ($Etat_conducteur) {
            $Modele = htmlspecialchars($user['Modele']);
            $Plaque = htmlspecialchars($user['Plaque']);
            $PhotoV = htmlspecialchars($user['PhotoV']);
            $permis = htmlspecialchars($user['permis']);
            $preferences = htmlspecialchars($user['preferences']);

        }

        $photoPath1 = !empty($PhotoV) ? "uploads/$PhotoV" : "image/default.jpg";
        $photoPath2 = !empty($permis) ? "uploads/$permis" : "image/default.jpg";



    } else {
        header("Location: SignInUp.php");
        exit();
    }
} else {
    header("Location: SignInUp.php");
    exit();
}

if (isset($_FILES['new_profile_pic'])) {
    $target_dir = "../uploads/";
    $Photonew = isset($_FILES["new_profile_pic"]["name"]) ? basename($_FILES["new_profile_pic"]["name"]) : null;
    $target_file1 = $target_dir . $Photonew;
    $uploadOk = 1;
    $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

    $check1 = isset($_FILES["new_profile_pic"]["tmp_name"]) ? getimagesize($_FILES["new_profile_pic"]["tmp_name"]) : false;
    if ($check1 !== false ) {
        $uploadOk = 1;
    } else {
        echo "Un des fichiers n'est pas une image.";
        $uploadOk = 0;
    }

    // Limite les formats de fichier
    if (
        ($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" && $imageFileType1 != "gif")
    ) {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifiez si $uploadOk est à 0 à cause d'une erreur
    if ($uploadOk == 0) {
        echo "Désolé, vos fichiers n'ont pas été téléchargés.";
    } else {
        if (move_uploaded_file($_FILES["new_profile_pic"]["tmp_name"], $target_file1) ) {
            echo "Le fichier " . htmlspecialchars(basename($_FILES["new_profile_pic"]["name"])) . " a été téléchargé.";
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de vos fichiers.";
        }
    }
    // Mettez à jour le chemin de l'image dans la base de données
    $stmt = $bdd->prepare("UPDATE client SET Photo = :photo WHERE token = :token");
    $stmt->execute([':photo' => $newFileName]);
}

if (isset($_POST['deco'])) {
    $stmt = $bdd->prepare("UPDATE client SET token = NULL WHERE mail = :mail AND token = :token");
    $stmt->execute(['mail' => $_COOKIE['mail'], 'token' => $_COOKIE['token']]);

    header("Location: fin_de_requete/clientdeconnecte.php");
    exit();
}

if (isset($_POST['suppr'])) {
    $stmt = $bdd->prepare("DELETE FROM client WHERE mail = :mail AND token = :token");
    $stmt->execute(['mail' => $_COOKIE['mail'], 'token' => $_COOKIE['token']]);

    header("Location: fin_de_requete/clientdeconnecte.php");
    exit();
}


if (isset($_POST['modif'])) {
    // Récupérez les nouvelles informations de l'utilisateur à partir du formulaire

    $nom = $_POST['nom'];
    $Prenom = $_POST['Prenom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $modele = isset($_POST['modele']) ? $_POST['modele'] : null;
    $plaque = isset($_POST['plaque']) ? $_POST['plaque'] : null;
    $preferences = $_POST['preferences'];

    // Préparez la requête SQL pour mettre à jour les informations de l'utilisateur
    $query = "UPDATE client SET Prenom = :Prenom, nom = :nom, mail = :email, Num_Tel = :phone, MDP = :password, Modele = :modele, Plaque = :plaque, preferences = :preferences WHERE token = :token";
    $stmt = $bdd->prepare($query);

    // Exécutez la requête avec les nouvelles informations de l'utilisateur
    $stmt->execute([
        ':Prenom' => $Prenom,
        ':nom' => $nom,
        ':email' => $email,
        ':phone' => $phone,
        ':password' => $password,
        ':modele' => $modele,
        ':plaque' => $plaque,
        ':preferences' => $preferences,
        ':token' => $token // Assurez-vous que $token contient le token de l'utilisateur actuel
    ]);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MonProfile.css">
    <title>Mon profil</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: auto;
        }

        .container {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .box {
            width: 300px;
            margin-top: 20px;
        }

        .UserPicture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .box div {
            margin-bottom: 10px;
        }

        .box label {
            font-size: 10px;
            display: block;
            margin-bottom: 2px;
        }

        .box input[type="text"],
        .box input[type="email"],
        .box input[type="file"] {
            width: 100%;
            padding: 5px;
        }

        .box button {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <form method="POST" action="">
                <div class="UserPicture">
                    <img src="<?php echo $photoPath; ?>" alt="user">
                    <label for="new_profile_pic">Changer la photo de profil</label>
                    <input type="file" name="new_profile_pic" id="new_profile_pic">
                </div>
                <label for="Prenom">Nom d'utilisateur</label>
                <input type="text" name="Prenom" id="Prenom" placeholder="Prenom" value="<?php echo $Prenom; ?>"
                    autocomplete="off">
                <input type="text" name="nom" id="nom" placeholder="nom" value="<?php echo $nom; ?>">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email ID" autocomplete="off"
                    value="<?php echo $email; ?> ">

                <label for="phone">Numéro de téléphone</label>
                <input type="text" name="phone" id="phone" placeholder="Phone Number" autocomplete="off"
                    value="<?php echo $Num_Tel; ?>">

                <label for="password">Mot de passe</label>
                <input type="text" name="password" id="password" placeholder="Password" autocomplete="off" value="">

                <?php if ($Etat_conducteur): ?>
                    <label for="modele">Modèle de voiture</label>
                    <input type="text" name="modele" id="modele" autocomplete="off" placeholder="Modèle de voiture"
                        value="<?php echo $Modele; ?>">

                    <label for="plaque">Plaque du véhicule</label>
                    <input type="text" name="plaque" id="plaque" autocomplete="off" placeholder="Plaque du véhicule"
                        value="<?php echo $Plaque; ?>">

                    <label for="new_profile_pic">Photo de véhicule</label>
                    <div class="Carte">
                        <img src="<?php echo $photoPath1; ?>" alt="photo du véhicule">
                    </div>
                    <label for="permis">Permis de conduire</label>
                    <div class="Carte">
                        <img src="<?php echo $photoPath2; ?>" alt="photo du permis">
                    </div>
                    <label for="permis">Préférences</label>
                    <input type="text" name="preferences" id="preferences" autocomplete="off" placeholder="preferences"
                        value="<?php echo $preferences; ?>">
                    <label for="modele">Cagnotte</label>
                    <input type="text" name="" id="" autocomplete="off" placeholder="Cagnotte"
                        value="<?php echo $cagnotte; ?> €" readonly>
                <?php endif; ?>
                <button><a href="main.php">MENU</a></button>

                <button type="submit" name="deco">Se déconnecter</button>
                <button type="submit" name="suppr">Supprimer</button>
                <button type="submit" name="modif">Modifier</button>
            </form>
        </div>
    </div>
</body>

</html>