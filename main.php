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
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <title>BlaBLA Omnes</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 1)), url("image/fondtest4.jpg") center / cover no-repeat;
            background-repeat: no-repeat;
            background-color: black;
            font-family: "Roboto Slab", serif;
        }

        button {
            border-radius: 50px;
            cursor: pointer;
            border: 0;
            box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            transition: all 0.5s ease;
        }

        button:hover {
            letter-spacing: 3px;
            background-image: linear-gradient(to right, #FFA500, #FFD700, #FF8C00);
            box-shadow: #F5D742 0px 7px 29px 0px;
        }

        button:active {
            letter-spacing: 3px;
            background-color: #F5D742;
            box-shadow: #F5D742 0px 0px 0px 0px;
            transform: translateY(10px);
            transition: 100ms;
        }

        /*--------------------------titre et haut----------------------*/
        article {
            padding: 20px;
            margin: 400px 0 300px 0;
        }

        article h1 {
            font-size: 25px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            letter-spacing: 2px;
            line-height: 1.8;
            font-weight: bold;
            text-align: left;
        }

        /*---------------- text effet -------------------*/
        section {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            margin: 100px 0 200px 0;
        }

        .textH1,
        .textP {
            max-width: 80%;
            overflow: hidden;
            margin: 20px 0;
            color: white;
        }

        .textH1 {
            font-size: 1.5rem;
            line-height: 1.5em;
            font-weight: 400;
            ;
        }

        .textH1 span,
        .textP span {
            display: inline-flex;
            color: transparent;
            transition: all 0.5s ease-out;
            opacity: 0;
            transform: translateY(500px) rotate(360deg) scale(0.9);
        }

        .textH1 span.reveal {
            color: white;
            opacity: 1;
            transform: translateY(0px) rotate(0deg) scale(1);
        }

        .textH1 span.revealjaune {
            color: rgb(226, 230, 81);
            opacity: 1;
            transform: translateY(0px) rotate(0deg) scale(1);
        }


        .textP span.reveal {
            color: #bfbfbf;
            opacity: 1;
            transform: translateY(0px) rotate(0deg) scale(1);
        }


        /*---------------- Bar de Recherche -------------------*/
        .search-bar {
            background-color: black;
            width: 90%;
            margin: 20px auto 300px auto;
            box-shadow: none;
        }

        .search-input {
            background-color: black;
            color: #bfbfbf;
            border: none;
            border-bottom: 3px solid rgb(226, 230, 81);
            padding: 12px 15px;
            margin-bottom: 40px;
            outline: none;
            transition: all 0.3s ease;
            width: 100%;
            -webkit-appearance: none;
            appearance: none;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 20 20"><polygon points="0,0 10,10 20,0" style="fill:rgb(226, 230, 81);"/></svg>') no-repeat right 10px center;
            background-size: 10px;
            font-size: 1.3rem;
        }

        .search-input::-ms-expand {
            display: none;
            /* Remove default arrow in Internet Explorer */
        }

        .search-input:focus {
            border-bottom: 2px solid #ffcc00;
            box-shadow: none;
        }

        .search-button {
            padding: 12px 15px;
            border-radius: 20px;
            margin: 15px 0;
            outline: none;
            width: 100%;
            background-image: linear-gradient(to right, #ffcc00, #e1e651, #ffcc00);
            color: white;
        }

        /*---------------- Story Section -------------------*/
        .story-section {
            display: flex;
            flex-direction: column;
            text-align: left;
            align-items: center;
            justify-content: center;
            margin-bottom: 150px;
            background-color: black;
            gap: 20px;
            font-size: 1.8rem;
        }

        .story-image img {
            width: 100%;
            height: auto;
            max-width: 600px;
            margin-bottom: 10px;
            border: none;
        }

        .story-content {
            padding: 20px;
            color: #bfbfbf;
            font-size: 16px;
            line-height: 1.6;
        }

        .story-content button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-image: linear-gradient(to right, #ffcc00, #e1e651, #ffcc00);
            color: white;
        }
    </style>
</head>

<body>

    <?php include 'Header.php'; ?>

    <article>
        <h1>Partagez la route<br>
            <em>rejoignez</em> l'aventure!
        </h1>
    </article>

    <section>
        <h1 class="textH1">Relier les trajets, créer des parcours. Découvrez le covoiturage comme jamais auparavant.</h1>

        <p class="textP">Rejoignez-nous sur la route de la durabilité et des économies à chaque voyage que vous effectuez. BlaBla Omnes s'engage à rendre votre expérience de covoiturage fluide et agréable. Des trajets quotidiens aux aventures à travers le pays, notre plateforme garantit que chaque voyage non seulement réduit vos coûts de déplacement mais aide également l'environnement. Que vous soyez conducteur ou passager, votre prochaine grande histoire de voyage commence avec nous — parcourons ensemble cette route et faisons la différence</p>
    </section>


    <main>
        <form id="searchForm" class="search-bar">
            <select id="departure" name="departure" class="destination-select search-input">
                <?php
                $reponse = $db->query('       SELECT Depart AS adresse FROM trajet
                UNION
                SELECT Arrivee AS adresse FROM trajet
                UNION
                SELECT adresse FROM campus
                WHERE nom_campus NOT IN (SELECT DISTINCT nom_campus FROM trajet)');
                while ($donnees = $reponse->fetch()) {
                ?>
                    <option value="<?php echo htmlspecialchars($donnees['adresse']); ?>">
                        <?php echo htmlspecialchars($donnees['adresse']); ?>
                    </option>
                <?php
                }
                $reponse->closeCursor();
                ?>
            </select>

            <select id="destination" name="destination" class="destination-select search-input">
                <?php
                $reponse = $db->query('   SELECT Depart AS adresse FROM trajet
                UNION
                SELECT Arrivee AS adresse FROM trajet
                UNION
                SELECT adresse FROM campus
                WHERE nom_campus NOT IN (SELECT DISTINCT nom_campus FROM trajet)');
                while ($donnees = $reponse->fetch()) {
                ?>
                    <option value="<?php echo htmlspecialchars($donnees['adresse']); ?>">
                        <?php echo htmlspecialchars($donnees['adresse']); ?>
                    </option>
                <?php
                }
                $reponse->closeCursor();
                ?>
            </select>
            <input type="date" id="date" name="date" class="search-input">
            <input type="number" id="passengers" name="passengers" placeholder="passager" class="search-input">
            <button type="submit" class="search-button">Rechercher</button>
        </form>
    </main>


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

    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(event) {
                event.preventDefault(); // Empêche le rechargement de la page
                var formData = $(this).serialize(); // Sérialise les données du formulaire

                console.log("Formulaire soumis"); // Vérifie que le formulaire est soumis
                console.log("Form data: " + formData); // Vérifie les données du formulaire

                $.ajax({
                    url: 'vava.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log("Réponse du serveur : " + response); // Vérifie la réponse du serveur
                        var data = JSON.parse(response);
                        if (data.status === 'error') {
                            alert(data.message); // Affiche le message d'erreur
                        } else {
                            alert('Recherche réussie !');
                            // Traitez la réponse réussie ici (par exemple, rediriger ou afficher les résultats)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur AJAX : " + status + " " + error);
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const paragraphH1 = document.querySelector('.textH1');
            const wordsH1 = paragraphH1.textContent.trim().split(' ').map(
                word => `<span>${word}&nbsp;</span>`
            );
            paragraphH1.innerHTML = wordsH1.join('');

            const paragraphP = document.querySelector('.textP');
            const wordsP = paragraphP.textContent.trim().split(' ').map(
                word => `<span>${word}&nbsp;</span>`
            );
            paragraphP.innerHTML = wordsP.join('');

            let lastKnownScrollPosition = 0;
            let ticking = false;
            let numjaune = 0;

            function handleScroll() {
                const scrollPosition = window.scrollY;

                if (!ticking) {
                    window.requestAnimationFrame(() => {
                        document.querySelectorAll('.textH1 span, .textP span').forEach((span) => {
                            const spanTop = span.getBoundingClientRect().top + scrollPosition - 350;
                            const spanOffset = span.offsetHeight + 20;

                            const spanVisible = (spanTop - window.innerHeight < scrollPosition);
                            numjaune += 1;
                            if (spanVisible & numjaune != 4 & numjaune != 5 & numjaune != 6) {
                                span.classList.add('reveal');
                            } else if (spanVisible) {
                                span.classList.add('revealjaune');
                            }
                        });
                        ticking = false;
                    });

                    ticking = true;
                }
            }

            // Add scroll event listener
            window.addEventListener('scroll', handleScroll);
        });
    </script>
</body>

</html>