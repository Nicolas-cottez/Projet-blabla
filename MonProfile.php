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
        $Photo = htmlspecialchars($user['Photo']); // Nouveau champ photo
        $Etat_conducteur = $user['Etat_conducteur']; // Vérifier si l'utilisateur est un conducteur

        // Si la photo n'existe pas, utilisez une image par défaut
        $photoPath = !empty($Photo) ? "uploads/$Photo" : "image/default.jpg";
        if ($Etat_conducteur) {
            $Modele = htmlspecialchars($user['Modele']);
            $Plaque = htmlspecialchars($user['Plaque']);
            $PhotoV = htmlspecialchars($user['PhotoV']);
            $permis = htmlspecialchars($user['permis']);
        }

        $photoPath1 = !empty($PhotoV) ? "uploads/$PhotoV" : "image/default.jpg";
        $photoPath2 = !empty($permis) ? "uploads/$permis" : "image/default.jpg";

        
        
    } else {
        header("Location: SeConnecterTest.php");
        exit();
    }
} else {
    header("Location: SeConnecterTest.php");
    exit();
}

if (isset($_POST['deco'])) {
    $stmt = $bdd->prepare("UPDATE client SET token = NULL WHERE mail = :mail AND token = :token");
    $stmt->execute(['mail' => $_COOKIE['mail'], 'token' => $_COOKIE['token']]);

    header("Location: clientdeconnecte.php");
    exit();
}

if (isset($_POST['suppr'])) {
    $stmt = $bdd->prepare("DELETE FROM client WHERE mail = :mail AND token = :token");
    $stmt->execute(['mail' => $_COOKIE['mail'], 'token' => $_COOKIE['token']]);

    header("Location: clientdeconnecte.php");
    exit();
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
        body, html {
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
            <div class="UserPicture">
                <img src="<?php echo $photoPath; ?>" alt="user">
            </div>
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" placeholder="User Name" value="<?php echo $Prenom . ' ' . $nom; ?>" readonly>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email ID" value="<?php echo $email; ?>" readonly>

            <label for="phone">Numéro de téléphone</label>
            <input type="text" name="phone" id="phone" placeholder="Phone Number" value="<?php echo $Num_Tel; ?>" readonly>

            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="password" placeholder="Password" value="<?php echo $MDP; ?>" readonly>

            <?php if ($Etat_conducteur): ?>
                <label for="modele">Modèle de voiture</label>
                <input type="text" name="modele" id="modele" placeholder="Modèle de voiture" value="<?php echo $Modele; ?>" readonly>

                <label for="plaque">Plaque du véhicule</label>
                <input type="text" name="plaque" id="plaque" placeholder="Plaque du véhicule" value="<?php echo $Plaque; ?>" readonly>

                <label for="new_profile_pic">Photo de véhicule</label>
                <div class="Carte">
                    <img src="<?php echo $photoPath1; ?>" alt="photo du véhicule">
                </div>
                <label for="permis">Permis de conduire</label>
                <div class="Carte">
                    <img src="<?php echo $photoPath2; ?>" alt="photo du permis">
                </div>
            <?php endif; ?>
            <button><a href="main.php">MENU</a></button>
            <form method="POST" action="">
                <button type="submit" name="deco">Se déconnecter</button>
                <button type="submit" name="suppr">Supprimer</button>
            </form>
        </div>
    </div>
</body>
</html>