<?php
include 'backend.php';

if (isset($_POST['ok'])) {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $Prenom = $_POST['Prenom'];
    $Num_Tel = $_POST['Num_Tel'];
    $mail = $_POST['mail'];
    $MDP = $_POST['MDP'];
    $Photo = $_FILES['Photo']['name'];
    $destination = 'image/' . $Photo;
    $imagePath = pathinfo($destination, PATHINFO_EXTENSION);
    $valid_extension = array("jpg", "png", "gif");
    
    if (!in_array(strtolower($imagePath), $valid_extension)) {
        echo "Extension de fichier non valide.";
        exit;
    }

    if (!move_uploaded_file($_FILES['Photo']['tmp_name'], $destination)) {
        echo "Erreur lors du téléchargement de la photo.";
        exit;
    }

    $allowed_domains = ["omnesintervenant.com", "ece.fr", "edu.ece.fr"];
    $email_domain = substr(strrchr($mail, "@"), 1);

    if (!in_array($email_domain, $allowed_domains)) {
        echo "L'adresse e-mail doit appartenir aux domaines suivants : omnesintervenant.com, ece.fr ou edu.ece.fr";
        exit;
    }

    // Gestion du téléchargement de la photo
    if ($_FILES['Photo']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['Photo']['tmp_name'];
        $name = basename($_FILES['Photo']['name']);
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $photo_path = $upload_dir . $name;
        move_uploaded_file($tmp_name, $photo_path);
    } else {
        echo "Erreur lors du téléchargement de la photo.";
        exit;
    }

    // Préparation de la requête SQL
    $query = "INSERT INTO client (nom, Prenom, mail, MDP, Photo, Num_Tel) VALUES (:nom, :Prenom, :mail, :MDP, :Photo, :Num_Tel)";
    $stmt = $db->prepare($query);

    // Exécution de la requête avec les paramètres
    $stmt->execute([
        ':nom' => $nom,
        ':Prenom' => $Prenom,
        ':mail' => $mail,
        ':MDP' => $MDP,
        ':Photo' => $photo_path,
        ':Num_Tel' => $Num_Tel
    ]);

    // Récupération et affichage des résultats
    $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($reponse);
}
?>
