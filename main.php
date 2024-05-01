<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script><!--inclu tailwind-->
    <link rel="stylesheet" href="style.css"> <!--inclu le css-->
    <link rel="stylesheet" href="footer.css"> <!--inclu le css du footer-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> <!--inclu les fonts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!--inclu jquery-->
    <script src="monscript.js" defer></script> <!--defer sert a charger a la fin du dom--> <!--inclu le js-->
    <title>BlaBLA Omnes</title>
</head>

<body>

    <?php include 'header.php'; ?>

    <main class="p-4">
        <section>
            <h2 class="text-blue-700 text-xl">Trouvez votre covoiturage!</h2>
            <p>Bienvenue sur Blabla Omnes, votre plateforme de covoiturage pour les étudiants et le personnel d'Omnes.</p>
            <form id="searchForm" class="mt-4">
                <label for="departure" class="block">Départ:</label>
                <input type="text" id="departure" name="departure" class="border rounded p-2 mb-2 w-full">

                <label for="destination" class="block">Destination:</label>
                <input type="text" id="destination" name="destination" class="border rounded p-2 mb-2 w-full">

                <label for="date" class="block">Date:</label>
                <input type="date" id="date" name="date" class="border rounded p-2 mb-2 w-full">

                <label for="passengers" class="block">Nombre de passagers:</label>
                <input type="number" id="passengers" name="passengers" class="border rounded p-2 mb-4 w-full">

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Chercher un trajet
                </button>
            </form>
        </section>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>