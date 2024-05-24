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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier si des modifications sont soumises
            if (isset($_POST['save_changes'])) {
                // Mettre à jour les informations du profil dans la base de données
                $new_username = htmlspecialchars($_POST['new_username']);
                $new_email = htmlspecialchars($_POST['new_email']);
                $new_phone = htmlspecialchars($_POST['new_phone']);
                $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT); // Assurez-vous de hacher le nouveau mot de passe
                // Ajoutez les autres champs que vous souhaitez mettre à jour de la même manière

                $updateStmt = $bdd->prepare("UPDATE client SET nom = :new_username, mail = :new_email, Num_Tel = :new_phone, MDP = :new_password WHERE mail = :mail AND token = :token");
                $updateStmt->execute([
                    'new_username' => $new_username,
                    'new_email' => $new_email,
                    'new_phone' => $new_phone,
                    'new_password' => $new_password,
                    'mail' => $mail,
                    'token' => $token
                ]);
                if ($Etat_conducteur) {
                    $new_modele = htmlspecialchars($user['Modele']);
                    $new_plaque = htmlspecialchars($user['Plaque']);
                    $updateStmt = $bdd->prepare("UPDATE client SET Modele = :new_modele, Plaque = :new_plaque WHERE mail = :mail AND token = :token");
                    $updateStmt->execute([
                        'new_modele' => $new_modele,
                        'new_plaque' => $new_plaque
                    ]);

                }


                // Rediriger après la mise à jour
                header("Location: MonProfile.php");
                exit();
            } else {
                header("Location: SeConnecterTest.php");
                exit();
            }
        }else {
            header("Location: SeConnecterTest.php");
            exit();
        }
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
        <input type="file" name="new_profile_pic" id="file" accept="image/*">
        <label for="file">EDIT PIC</label>
        <form method="POST" action="">
            <input type="text" name="new_username" placeholder="User Name" value="<?php echo $Prenom . ' ' . $nom; ?>">
            <input type="email" name="new_email" placeholder="Email ID" value="<?php echo $email; ?>">
            <input type="text" name="new_phone" placeholder="Phone Number" value="<?php echo $Num_Tel; ?>">
            <input type="text" name="new_password" placeholder="Password" value="<?php echo $MDP; ?>">
            <?php if ($Etat_conducteur): ?>
                <div class="Carte">
                    <img src="<?php echo $photoPath1; ?>" alt="user">
                </div>
                <input type="file" name="new_profile_pic" id="file" accept="image/*">
                <div class="Carte">
                    <img src="<?php echo $photoPath; ?>" alt="user">
                </div>
                <input type="file" name="new_profile_pic" id="file" accept="image/*">
                <input type="text" name="new_modele" placeholder="Modèle de voiture" value="<?php echo $Modele; ?>">
                <input type="text" name="new_plaque" placeholder="Plaque du véhicule" value="<?php echo $Plaque; ?>">
            <?php endif; ?>
            <button type="submit" name="save_changes">Save Changes</button>
        </form>
        <form method="POST" action="">
            <button type="submit" name="deco">Se déconnecter</button>
            <button type="submit" name="suppr">Supprimer</button>
        </form>
        <button><a href="main.php">MENU</a></button>
    </div>
</body>

</html>