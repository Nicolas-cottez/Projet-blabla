<?php

$source = "mysql:host=localhost;dbname=utilisateur";
$login = "root";
$mdp = "";

try {
    $db = new PDO($source, $login, $mdp);
    echo "Vous êtes connecté !";
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    exit();
}

if (isset($_POST['ok'])) {
    var_dump($_POST);
    
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $Prenom = $_POST['Prenom'];
    $Num_Tel = $_POST['Num_Tel'];
    $mail = $_POST['mail'];
    $MDP = $_POST['MDP'];

    // Préparation de la requête SQL
    $query = "INSERT INTO users (mail, MDP, nom, Num_Tel, Prenom) VALUES (:mail, :MDP, :nom, :Num_Tel, :Prenom)";
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
