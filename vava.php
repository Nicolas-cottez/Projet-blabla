<?php
// Inclure le fichier de connexion à la base de données
include 'backend.php';

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];

    // Préparer la requête SQL pour vérifier les adresses dans la base de données
    $query = $db->prepare('SELECT COUNT(*) FROM campus WHERE adresse = :adresse');
    
    // Vérifier si l'adresse de départ existe dans la base de données
    $query->execute(['adresse' => $departure]);
    $departureExists = $query->fetchColumn() > 0;

    // Vérifier si l'adresse de destination existe dans la base de données
    $query->execute(['adresse' => $destination]);
    $destinationExists = $query->fetchColumn() > 0;

    // Initialiser un tableau pour stocker les messages d'erreur
    $errors = [];

    // Vérifier les conditions et ajouter les messages d'erreur si nécessaire
    if ($departureExists && $destinationExists) {
        $errors[] = "Vous devez avoir un seul campus dans vos destination";
    }

    if (!$departureExists || !$destinationExists) {
        $errors[] = "L'adresse de départ ou de destination n'existe pas dans la base de données.";
    }

    // Si des erreurs existent, les afficher
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // Sinon, continuer avec le traitement normal (par exemple, afficher les résultats de la recherche)
        echo "<p style='color:green;'>Recherche réussie !</p>";
        // Vous pouvez ajouter ici le code pour afficher les résultats de la recherche
    }
}
?>