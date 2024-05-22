<?php
$servername = "localhost";
$username = "root";
$MDP = "";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=projet_blablacar2", $username, $MDP);
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
        $prenom = htmlspecialchars($user['Prenom']);
        $email = htmlspecialchars($user['mail']);
        $phone = htmlspecialchars($user['Num_Tel']);
        $MDP = htmlspecialchars($user['MDP']);
        $photo = htmlspecialchars($user['Photo']); // Nouveau champ photo

        // Si la photo n'existe pas, utilisez une image par défaut
        $photoPath = !empty($photo) ? "uploads/$photo" : "image/default.jpg";
    } else {
        echo "Utilisateur non trouvé ou token invalide.";
        exit();
    }
} else {
    header("Location: SeConnecterTest.php");
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
        <input type="text" name="username" placeholder="User Name" value="<?php echo $prenom . ' ' . $nom; ?>" readonly>
        <input type="email" name="email" placeholder="Email ID" value="<?php echo $email; ?>" readonly>
        <input type="text" name="phone" placeholder="Phone Number" value="<?php echo $phone; ?>" readonly>
        <input type="text" name="password" placeholder="Password" value="<?php echo $MDP; ?>" readonly>
        <button onclick="window.location.href='logout.php'">CANCEL</button>
        <button><a href="main.php">MENU</a></button>
    </div>
</body>
</html>