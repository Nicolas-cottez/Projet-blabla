<?php include 'backend.php'; ?>

<?php
if (isset($_POST['ok'])) {
    var_dump($_POST);
    
    // Récupération des données du formulaire
    $Depart = htmlspecialchars($_POST['Depart']);
    $arrivee = htmlspecialchars($_POST['arrivee']);
    $Distance = htmlspecialchars($_POST['Distance']);
    $Duree = htmlspecialchars($_POST['Duree']);
    $Date = htmlspecialchars($_POST['Date']);
    $prix = htmlspecialchars($_POST['prix']);
    $nom_campus = htmlspecialchars($_POST['nom_campus']);
    $Nb_personne = htmlspecialchars($_POST['Nb_personne']);
    $ID_conducteur = htmlspecialchars($_POST['ID_conducteur']);
    
    

    // Préparation de la requête SQL
    $query = "INSERT INTO trajet (Depart, arrivee, Distance, Duree, Date, prix, nom_campus, Nb_personne, ID_conducteur) VALUES (:Depart, :arrivee, :Distance, :Duree, :Date, :prix, :nom_campus, :Nb_personne, :ID_conducteur)";
    $stmt = $db->prepare($query);

    // Exécution de la requête avec les paramètres
    $stmt->execute([
        ':Depart' => $Depart,
        ':arrivee' => $arrivee,
        ':Distance' => $Distance,
        ':Duree' => $Duree,
        ':Date' => $Date,
        ':prix' => $prix,
        ':nom_campus' => $nom_campus,
        ':Nb_personne' => $Nb_personne,
        ':ID_conducteur' => $ID_conducteur
    ]);

    // Récupération et affichage des résultats
    $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($reponse);
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
                <input type="number" id="Duree" name="Duree" placeholder="Durée du trajet en min" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="Date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
                <input type="Date" id="Date" name="Date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
            <div class="mb-4">
                <label for="ID_conducteur" class="block text-gray-700 text-sm font-bold mb-2">Id du conducteur:</label>
                <input type="text" id="ID_conducteur" name="ID_conducteur" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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