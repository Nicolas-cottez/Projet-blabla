<?php

$servername = "localhost";
$username = "root";
$MDP = "";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=projet_blablacar2", $username, $MDP);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur BDD : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail = htmlspecialchars($_POST['mail']);
    $MDP = sha1($_POST['MDP']);
    if (!empty($mail) && !empty($MDP)) {

        $token = bin2hex(random_bytes(16));

        $stmt = $bdd->prepare("SELECT * FROM client WHERE mail = :mail AND MDP = :MDP");
        $stmt->execute(['mail' => $mail, 'MDP' => $MDP]);
        $rep = $stmt->fetch();

        if ($rep && $rep['ID_client']) {
            $updateStmt = $bdd->prepare("UPDATE client SET token = :token WHERE mail = :mail AND MDP = :MDP");
            $updateStmt->execute(['token' => $token, 'mail' => $mail, 'MDP' => $MDP]);

            setcookie("token", $token, time() + 3600, "/", "", false, true);
            setcookie("mail", $mail, time() + 3600, "/", "", false, true);
            header("Location: main.php");
            exit();
        } else {
            echo 'Email ou mot de passe incorrect';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
<form method="POST" action="">
        <label for="mail">mail</label>
        <input type="text" placeholder="Entrez votre e-mail..." id="mail" name="mail">
        <label for="MDP">Mot de passe</label>
        <input type="password" placeholder="Entrez votre MDP..." id="MDP" name="MDP">
        <input type="submit" value="Se connecter" name="ok">
    </form>
</body>
</html>