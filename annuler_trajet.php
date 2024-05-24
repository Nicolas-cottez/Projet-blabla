<?php
include 'backend.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['ID_trajet'] ?? null;

    // Vérifiez que l'ID est valide
    if (!empty($id) && is_numeric($id)) {
        try {
            $requete = $db->prepare("DELETE FROM trajet WHERE ID_trajet = :id");
            $requete->bindParam(':id', $id, PDO::PARAM_INT);
            $requete->execute();

            // Redirige vers la page des trajets après la suppression
            header("Location: MesTrajet.php");
            exit();
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
