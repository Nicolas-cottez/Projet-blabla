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
</head>
<body>
    <div class="box">
        <div class="UserPicture">
            <img src="<?php echo $photoPath; ?>" alt="user">
        </div>
        <input type="file" name="" id="file" accept="image/*">
        <label for="file">EDIT PIC</label>
        <input type="text" name="username" placeholder="User Name" value="<?php echo $Prenom . ' ' . $nom; ?>" readonly>
        <input type="email" name="email" placeholder="Email ID" value="<?php echo $email; ?>" readonly>
        <input type="text" name="phone" placeholder="Phone Number" value="<?php echo $Num_Tel; ?>" readonly>
        <input type="text" name="password" placeholder="Password" value="<?php echo $MDP; ?>" readonly>

        <?php if ($Etat_conducteur): ?>
            <input type="text" name="modele" placeholder="Modèle de voiture" value="<?php echo $Modele; ?>" readonly>
            <input type="text" name="plaque" placeholder="Plaque du véhicule" value="<?php echo $Plaque; ?>" readonly>
            <div class="Carte">
            <img src="<?php echo $photoPath1; ?>" alt="user">
        </div>
        <input type="file" name="new_profile_pic" id="file" accept="image/*">
        <div class="Carte">
            <img src="<?php echo $photoPath; ?>" alt="user">
        </div>
        <?php endif; ?>

        <button onclick="window.location.href='logout.php'">CANCEL</button>
        <button><a href="main.php">MENU</a></button>
        <form method="POST" action="">
            <button>
                <input type="submit" value="Se déconnecter" name="deco">
            </button>
            <button>
                <input type="submit" value="Supprimer" name="suppr">
            </button>
        </form>
    </div>
</body>
</html>