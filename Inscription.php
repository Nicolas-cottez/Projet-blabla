<?php include 'backend.php'; ?>
<?php
if (isset($_POST['ok'])) {
    var_dump($_POST);
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $Prenom = htmlspecialchars($_POST['Prenom']);
    $Num_Tel = htmlspecialchars($_POST['Num_Tel']);
    $mail = htmlspecialchars($_POST['mail']);
    $MDP = sha1($_POST['MDP']);

    $allowed_domains = ["omnesintervenant.com", "ece.fr", "edu.ece.fr"];
    $email_domain = substr(strrchr($mail, "@"), 1);

    if (!in_array($email_domain, $allowed_domains)) {
        echo "L'adresse e-mail doit appartenir aux domaines suivants : omnesintervenant.com, ece.fr ou edu.ece.fr";
        exit;
    }

    // Préparation de la requête SQL
    $query = "INSERT INTO client (nom, Prenom, mail, MDP, Num_Tel) VALUES (:nom, :Prenom, :mail, :MDP, :Num_Tel)";
    $stmt = $db->prepare($query);

    // Exécution de la requête avec les paramètres
    $stmt->execute([
        ':nom' => $nom,
        ':Prenom' => $Prenom,
        ':mail' => $mail,
        ':MDP' => $MDP,
        ':Num_Tel' => $Num_Tel
    ]);


    // Récupération et affichage des résultats
    $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($reponse);

    header("location: SeConnecterTest.php");
    exit();
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

    <form method="POST" action="">
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
    </form>

</body>

</html>