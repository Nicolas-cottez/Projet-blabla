<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'backend.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script><!--inclu tailwind-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" /><!--inclu les fonts-->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <<link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <title>BlaBLA Omnes</title>
    
</head>

<body>

    <?php include 'Header.php'; ?>

    <article>
        <h1>Partagez la route<br>
            <em>rejoignez</em> l'aventure!
        </h1>
    </article>

    <a href="SignInUp.php" class="yellow-button">S'inscrire / Se connecter</a>

    <section>
        <h1 class="textH1">Relier les trajets, créer des parcours. Découvrez le covoiturage comme jamais auparavant.</h1>

        <p class="textP">Rejoignez-nous sur la route de la durabilité et des économies à chaque voyage que vous effectuez. BlaBla Omnes s'engage à rendre votre expérience de covoiturage fluide et agréable. Des trajets quotidiens aux aventures à travers le pays, notre plateforme garantit que chaque voyage non seulement réduit vos coûts de déplacement mais aide également l'environnement. Que vous soyez conducteur ou passager, votre prochaine grande histoire de voyage commence avec nous — parcourons ensemble cette route et faisons la différence</p>
    </section>


    <content class="story-section">
        <div class="story-image">
            <img src="image\photoCovoiturage.jpg" alt="personnage dans voiture">
        </div>
        <div class="story-content">
            <p>Avec Blabla Omnes, le covoiturage devient une expérience enrichissante et conviviale. Non seulement vous réduisez vos frais de déplacement, mais vous contribuez également à diminuer votre empreinte carbone. Partager un trajet, c'est aussi l'occasion de rencontrer des personnes intéressantes, d'échanger des idées, de créer des souvenirs et de rendre chaque voyage unique. Que ce soit pour un trajet quotidien ou une escapade ponctuelle, chaque kilomètre partagé est une nouvelle aventure. Embarquez avec nous et découvrez une manière plus humaine et écologique de voyager.</p>
            <button>En route !</button>
        </div>
    </content>

    <?php include 'footer.php'; ?>
    <script src="main.js"></script>
</body>

</html>