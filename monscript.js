document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Pour éviter le rechargement de la page
    const departure = document.getElementById('departure').value;
    const destination = document.getElementById('destination').value;
    const date = document.getElementById('date').value;
    const passengers = document.getElementById('passengers').value;

    console.log("Recherche de trajets de", departure, "à", destination, "le", date, "pour", passengers, "passagers.");
    // Ici, vous pourrez ajouter une fonction pour envoyer ces données à votre serveur et recevoir les résultats.
});
