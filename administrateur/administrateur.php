<?php include '../backend.php';

if (isset($_POST['deco'])) {
    $stmt = $bdd->prepare("UPDATE client SET token = NULL WHERE mail = :mail AND token = :token");
    $stmt->execute(['mail' => $_COOKIE['mail'], 'token' => $_COOKIE['token']]);

    header("Location: clientdeconnecte.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="../SeConnecterTest.php"><button type="submit" name="deco">Se déconnecter</button></a>
    <h1> Que voulais vous faire ?</h1>
    <br>
    <a href="modifcampus.php"><button> Modifier un campus</button></a>
    <br>
    <br>
    <a href="validationpermis.php"> <button> Vérifier un permis </button></a>
    <br>
    <br>
    <a href="dataclients.php"> <button> Modification des clients</button></a>
    <br>
    <br>
    <a href="datatrajet.php"> <button> Visualiser des trajets</button></a>

</body>