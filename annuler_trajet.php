<?php
include 'backend.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['ID_trajet'] ?? null;

    if (!empty($id) && is_numeric($id)) {
        try {
            // Vérifiez si des réservations existent pour ce trajet
            $checkQuery = $db->prepare("SELECT * FROM participe WHERE ID_trajet = :id");
            $checkQuery->bindParam(':id', $id, PDO::PARAM_INT);
            $checkQuery->execute();
    
            if ($checkQuery->rowCount() > 0) {
                // Des réservations existent pour ce trajet, ne le supprimez pas
                // Redirige vers la page des trajets après la suppression
                header("Location: ./fin_de_requete/annulationimpossible.php");
            } else {
                // Aucune réservation pour ce trajet, procédez à la suppression
                $requete = $db->prepare("DELETE FROM trajet WHERE ID_trajet = :id");
                $requete->bindParam(':id', $id, PDO::PARAM_INT);
                $requete->execute();
    
                // Redirige vers la page des trajets après la suppression
                header("Location: MesTrajet.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "ID invalide.";
    }
} else {
    echo "Méthode de requête non autorisée.";
}
?>
