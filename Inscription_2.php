<?php include 'backend.php'; ?>
<?php
if (isset($_POST['ok'])) {
    var_dump($_POST);
    
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $Prenom = $_POST['Prenom'];
    $Num_Tel = $_POST['Num_Tel'];
    $mail = $_POST['mail'];
    $MDP = $_POST['MDP'];

    $allowed_domains = ["omnesintervenant.com", "ece.fr", "edu.ece.fr"];
    $email_domain = substr(strrchr($mail, "@"), 1);

    if (!in_array($email_domain, $allowed_domains)) {
        echo "L'adresse e-mail doit appartenir aux domaines suivants : omnesintervenant.com, ece.fr ou edu.ece.fr";
        exit;
    }
    
    // Préparation de la requête SQL
    $query = "INSERT INTO client (mail, MDP, nom, Num_Tel, Prenom) VALUES ( :mail, :MDP, :nom, :Num_Tel, :Prenom)";
    $stmt = $db->prepare($query);
    
    // Exécution de la requête avec les paramètres
    $stmt->execute([
        ':mail' => $mail,
        ':MDP' => $MDP,
        ':nom' => $nom,
        ':Num_Tel' => $Num_Tel,
        ':Prenom' => $Prenom
    ]);


    // Récupération et affichage des résultats
    $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($reponse);
}
?>