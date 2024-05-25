<?php
include 'backend.php';

// Vérifier si l'utilisateur est connecté et obtenir l'ID_client
if (isset($_COOKIE['token']) && isset($_COOKIE['mail'])) {
    $token = $_COOKIE['token'];
    $mail = $_COOKIE['mail'];

    // Vérifier le token dans la base de données
    $query = "SELECT ID_client FROM client WHERE mail = :mail AND token = :token";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':mail' => $mail,
        ':token' => $token
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $ID_client = $result['ID_client'];
    } else {
        header("Location: SeConnecterTest.php");
            exit();
    }
} else {
    header("Location: SeConnecterTest.php");
            exit();
}

$query = "SELECT Etat_conducteur FROM client WHERE ID_client = :ID_client";
$stmt = $db->prepare($query);
$stmt->execute([':ID_client' => $ID_client]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $Etat_conducteur = $result['Etat_conducteur'];

    // Vérifier si l'état du conducteur est à 1
    if ($Etat_conducteur == 1) {
        if (isset($_POST['ok'])) {
            // Récupération des données du formulaire
            $Depart = htmlspecialchars($_POST['Depart']);
            $arrivee = htmlspecialchars($_POST['arrivee']);
            $Distance = htmlspecialchars($_POST['Distance']);
            $Duree = htmlspecialchars($_POST['Duree']);
            $Date = htmlspecialchars($_POST['Date']);
            $prix = htmlspecialchars($_POST['prix']);
            $nom_campus = htmlspecialchars($_POST['nom_campus']);
            $Nb_personne = htmlspecialchars($_POST['Nb_personne']);
            $heuredep = htmlspecialchars($_POST['heuredep']);

            // Préparation de la requête SQL pour insérer le trajet
            $query = "INSERT INTO trajet (ID_conducteur, Depart, arrivee, Distance, Duree, Date, prix, nom_campus, Nb_personne, heuredep) VALUES (:ID_conducteur, :Depart, :arrivee, :Distance, :Duree, :Date, :prix, :nom_campus, :Nb_personne, :heuredep)";
            $stmt = $db->prepare($query);

            // Exécution de la requête avec les paramètres
            $stmt->execute([
                ':ID_conducteur' => $ID_client,
                ':Depart' => $Depart,
                ':arrivee' => $arrivee,
                ':Distance' => $Distance,
                ':Duree' => $Duree,
                ':Date' => $Date,
                ':prix' => $prix,
                ':nom_campus' => $nom_campus,
                ':Nb_personne' => $Nb_personne,
                ':heuredep' => $heuredep
            ]);

            // Redirection après la publication du trajet
            header("Location: MesTrajet.php");
            exit();
        }
    } else {
        header("Location: DevenirConducteur.php");
        exit();
    }
} else {
    echo "Erreur lors de la récupération de l'état du conducteur.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un trajet - Blabla Omnes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script><!--inclu tailwind-->
</head>
<body class="bg-gray-400" >
    <?php include 'Header.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Publier un trajet</h1>
        <form id="searchForm" method="POST" action="" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label for="Depart" class="block text-gray-700 text-sm font-bold mb-2">Départ:</label>
                <input type="text" id="Depart" name="Depart" placeholder="Ville de départ" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="arrivee" class="block text-gray-700 text-sm font-bold mb-2">Arrivée:</label>
                <input type="text" id="arrivee" name="arrivee" placeholder="Ville d'arrivée" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="Distance" class="block text-gray-700 text-sm font-bold mb-2">Distance:</label>
                <input type="text" id="Distance" name="Distance" placeholder="Distance du trajet en km" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="Duree" class="block text-gray-700 text-sm font-bold mb-2">Durée:</label>
                <input type="Time" id="Duree" name="Duree" placeholder="Durée du trajet : HH:MM:SS" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="Date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
                <input type="Date" id="Date" name="Date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="heuredep" class="block text-gray-700 text-sm font-bold mb-2">Heure de départ:</label>
                <input type="Time" id="heuredep" name="heuredep" placeholder="Heure de départ : HH:MM:SS" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="prix" class="block text-gray-700 text-sm font-bold mb-2">Prix du trajet:</label>
                <input type="number" id="prix" name="prix" placeholder="Prix en €" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="Nb_personne" class="block text-gray-700 text-sm font-bold mb-2">Nombre de personne:</label>
                <input type="number" id="Nb_personne" name="Nb_personne" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="nom_campus" class="block text-gray-700 text-sm font-bold mb-2">Nom du campus:</label>
                <input type="text" id="nom_campus" name="nom_campus" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <input type="submit" value="Publier" name="ok" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </div>
        </form>
    </div>

    <script src="search.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>
