<?php

$servername = "localhost";
$username = "root";
$MDP = "";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=projet_blablacar", $username, $MDP);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur BDD : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail = htmlspecialchars($_POST['mail']);
    $MDP = $_POST['MDP']; // Pas besoin de hasher ici

    if (!empty($mail) && !empty($MDP)) {
        $stmt = $bdd->prepare("SELECT * FROM client WHERE mail = :mail");
        $stmt->execute(['mail' => $mail]);
        $user = $stmt->fetch();

        if ($user && password_verify($MDP, $user['MDP'])) {
            $token = bin2hex(random_bytes(16));
            $updateStmt = $bdd->prepare("UPDATE client SET token = :token WHERE mail = :mail");
            $updateStmt->execute(['token' => $token, 'mail' => $mail]);

            setcookie("token", $token, time() + 3600, "/", "", false, true);
            setcookie("mail", $mail, time() + 3600, "/", "", false, true);
            header("Location: fin_de_requete/clientconnecte.php");
            exit();
        } else {
            echo 'Email ou mot de passe incorrect';
        }
    }
}
?>