<?php
include 'backend.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trajetId = $_POST['trajetId'];

    // Récupérer le nombre de places actuelles
    $query = $db->prepare('SELECT Nb_personne FROM trajet WHERE ID_trajet = :id');
    $query->execute(['id' => $trajetId]);
    $trajet = $query->fetch(PDO::FETCH_ASSOC);

    if ($trajet && $trajet['Nb_personne'] > 0) {
        // Diminuer le nombre de places de 1
        $query = $db->prepare('UPDATE trajet SET Nb_personne = Nb_personne - 1 WHERE ID_trajet = :id');
        $query->execute(['id' => $trajetId]);

        // Envoyer une réponse indiquant que la réservation a réussi
        echo 'Réservation réussie ! Nouveau nombre de places : ' . ($trajet['Nb_personne'] - 1);
    } else {
        // Envoyer une réponse indiquant que la réservation a échoué
        echo 'Échec de la réservation : aucune place disponible';
    }
} else {
    // Envoyer une réponse indiquant une requête invalide
    echo 'Requête invalide';
}
?>