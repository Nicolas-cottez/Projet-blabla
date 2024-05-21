<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $MDP = "";

    try {
        $bdd = new PDO("mysql:host=$servername;dbname=projet_blablacar2", $username, $MDP);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connexion BDD réussie !";
    } catch (PDOException $e) {
        echo "Erreur BDD : " . $e->getMessage();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $mail = $_POST['mail'];
        $MDP = $_POST['MDP'];
        if ($mail != '' && $MDP != '') {
            $req = $bdd->query("SELECT * FROM client WHERE mail = '$mail' AND MDP = '$MDP'");
            $rep = $req->fetch();
            if ($rep && $rep['ID_client'] != false) {
                //setcookie("username", $mail, time() + 3600);
                //setcookie("password", $MDP, time() + 3600);
                header("location: clientconnecte.php");
                exit();
            } else {
                echo 'Email ou mot de passe incorrect';
            }
        }
    }
    ?>

    <form method="POST" action="">
        <label for="mail">mail</label>
        <input type="text" placeholder="Entrez votre e-mail..." id="mail" name="mail">
        <label for="MDP">Mot de passe</label>
        <input type="password" placeholder="Entrez votre MDP..." id="MDP" name="MDP">
        <input type="submit" value="Se connecter" name="ok">
    </form>
</body>

</html>