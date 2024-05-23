<?php
include 'backend.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];

    // Vérification dans la table "campus"
    $query_campus = $db->prepare('SELECT COUNT(*) FROM campus WHERE adresse = :adresse');
    $query_campus->execute(['adresse' => $departure]);
    $departureExists_campus = $query_campus->fetchColumn() > 0;

    $query_campus->execute(['adresse' => $destination]);
    $destinationExists_campus = $query_campus->fetchColumn() > 0;

    if ($departureExists_campus && $destinationExists_campus) {
        $errors[] = "Veuillez selectionner un seul campus";
    }

    if (!$departureExists_campus && !$destinationExists_campus) {
        $errors[] = "Veuillez selectionner un campus minimum";
    }
    // Vérification dans la table "trajet"

    $query_trajet = $db->prepare('SELECT COUNT(*) FROM trajet WHERE Depart = :departure AND arrivee = :destination');
    $query_trajet->execute(['departure' => $departure, 'destination' => $destination]);
    $journeyExists_trajet = $query_trajet->fetchColumn() > 0;

    $errors = [];

    // If both departure and destination exist in either "campus" or "trajet"
    if ($journeyExists_trajet) {
        echo json_encode(['status' => 'success']);
    } else {
        $errors[] = "Le trajet spécifié n'existe pas dans la base de données campus ou trajet.";
        echo json_encode(['status' => 'error', 'message' => implode(" ", $errors)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Requête invalide.']);
}
?>