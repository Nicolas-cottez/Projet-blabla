<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script><!-- inclut tailwind -->
    <link rel="stylesheet" href="style.css">
    <title>Résultats des trajets</title>
</head>

<body>
    <?php include 'Header.php'; ?>

    <main class="p-4">
        <h2>Résultats de recherche</h2>
        <div id="results"></div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var urlParams = new URLSearchParams(window.location.search);
            var trajets = JSON.parse(urlParams.get('trajets'));

            var resultsDiv = document.getElementById('results');
            if (trajets.length > 0) {
                trajets.forEach(function(trajet) {
                    var trajetDiv = document.createElement('div');
                    trajetDiv.className = "p-4 border rounded shadow-md mb-4";

                    trajetDiv.innerHTML = `
                        <p><strong>Départ:</strong> ${trajet.Depart}</p>
                        <p><strong>Arrivée:</strong> ${trajet.Arrivee}</p>
                        <p><strong>Date:</strong> ${trajet.date}</p>
                        <p><strong>Passagers:</strong> ${trajet.passagers}</p>
                    `;
                    resultsDiv.appendChild(trajetDiv);
                });
            } else {
                resultsDiv.innerHTML = "<p>Aucun trajet trouvé.</p>";
            }
        });
    </script>
</body>

</html>