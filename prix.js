document.getElementById('calculatePrice').addEventListener('click', function() {
    var distance = document.getElementById('Distance').value;
    if (distance) {
        var price = distance * 0.15;
        document.getElementById('calculatedPrice').value = price.toFixed(2)+ ' €';
    } else {
        alert('Veuillez entrer une distance');
    }
});