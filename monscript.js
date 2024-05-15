document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const departure = document.getElementById('departure').value;
    const destination = document.getElementById('destination').value;
    const date = document.getElementById('date').value;
    const passengers = document.getElementById('passengers').value;

    console.log("Recherche de trajets de", departure, "à", destination, "le", date, "pour", passengers, "passagers.");
    
});
