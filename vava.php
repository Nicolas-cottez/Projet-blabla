<?php
include 'backend.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
     $date = $_POST['date'];

    $query = $db->prepare('SELECT COUNT(*) FROM campus WHERE adresse = :adresse');

    // Check if departure exists
    $query->execute(['adresse' => $departure]);
    $departureExists = $query->fetchColumn() > 0;

    // Check if destination exists
    $query->execute(['adresse' => $destination]);
    $destinationExists = $query->fetchColumn() > 0;

    $errors = [];

    // If both departure and destination exist
    if ($departureExists && $destinationExists) {
        $errors[] = "Veuillez selectionner un seul campus";
    }

    // If departure or destination does not exist
    if (!$departureExists || !$destinationExists) {
        $errors[] = "L'adresse de départ ou de destination n'existe pas dans la base de données.";
    }


    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'message' => implode(" ", $errors)]);
    } else {
        echo json_encode(['status' => 'success']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Requête invalide.']);
}
?>