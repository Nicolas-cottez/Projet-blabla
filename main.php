<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script><!--inclu tailwind-->
    <link rel="stylesheet" href="style.css"> <!-- inclu le css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /><!--inclu les fonts-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!--inclu jquery-->
    <script src="monscript.js" defer></script> <!--defer sert a charger a la fin du dom--> <!--inclu le js-->
    <title>BlaBLA Omnes</title>
</head>

<body>


    <?php include 'Header.php'; ?>

    <main role="main">
        <!-- <section class="p-4 text-center bg-transparent">
            <h2 class="text-3xl text-blue-700 font-semibold">Trouvez votre covoiturage!</h2>
            <p class="text-white mt-2 max-w-2xl mx-auto">
                Bienvenue sur Blabla Omnes, votre plateforme de covoiturage d'Omnes.
            </p>
        </section> -->

        <section class="p-4">
            <form id="searchForm" class="search-bar mt-4">
                <input type="text" id="departure" name="departure" placeholder="Départ" class="search-input">
                <input type="text" id="destination" name="destination" placeholder="Destination" class="search-input">
                <input type="date" id="date" name="date" class="search-input">
                <input type="number" id="passengers" name="passengers" placeholder="passager" class="search-input">
                <button type="submit" class="search-button">Rechercher</button>
            </form>
        </section>


        <!-- <section class="covoiturage-highlight">
            <h1>"Partagez plus qu'un trajet, partagez une expérience."</h1>
        </section>


        <section class="story-section">
            <div class="story-image">
                <img src="image\covoiturage.jpg" alt="personnage dans voiture">
            </div>
            <div class="story-content">
                <h2>Embarquez pour des anecdotes passionnantes.</h2>
                <p>Avec Blabla Omnes, les rencontres font partie des voyages.</p>
                <button>En route !</button>
            </div>
        </section> -->
    </main>


    <!-- <?php include 'footer.php'; ?> -->

</body>

</html>