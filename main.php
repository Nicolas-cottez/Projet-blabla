<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script><!--inclu tailwind-->
    <link rel="stylesheet" href="style.css"> <!--inclu le css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /><!--inclu les fonts-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!--inclu jquery-->
    <script src="monscript.js" defer></script> <!--defer sert a charger a la fin du dom--> <!--inclu le js-->
    <title>BlaBLA Omnes</title>
</head>

<body>

    <?php include 'Header.php'; ?>

    <main class="p-4">
    <section>
        <h2 class="text-blue-700 text-xl">Trouvez votre covoiturage!</h2>
        <p>Bienvenue sur Blabla Omnes, votre plateforme de covoiturage pour les étudiants et le personnel d'Omnes.</p>
        <form id="searchForm" class="search-bar mt-4">
            <input type="text" id="departure" name="departure" placeholder="Départ" class="search-input">
            <input type="text" id="destination" name="destination" placeholder="Destination" class="search-input">
            <input type="date" id="date" name="date" class="search-input date">
            <input type="number" id="passengers" name="passengers" placeholder="1 passager" class="search-input">
            <button type="submit" class="search-button">
                Rechercher
            </button>
        </form>
    </section>
</main>


    <?php include 'footer.php'; ?>

</body>

</html>