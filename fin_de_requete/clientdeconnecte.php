<!DOCTYPE html>
<html lang="fr">

<?php include '../backend.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /><!--inclu les fonts-->
</head>

<body>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <article>
        <h2>Vous êtes déconnecté(e) !</h2>
    </article>
    <br>
    <a href="../main.php" class="yellow-button">Retour à la page principale</a>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <?php include '../footer.php'; ?>
</body>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 1)), url("../image/fondtest4.jpg") center / cover no-repeat;
    }

    article {
        padding: 20px;
        margin: 20px auto;
        text-align: center;
    }

    article h2 {
        font-size: 2.5rem;
        color: #f5d742a9;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        letter-spacing: 1.5px;
        font-weight: 600;
    }

    article p {
        font-size: 1.2rem;
        line-height: 1.6;
        color: #FFFFFF;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
    }

    .yellow-button {
        display: flex;
        justify-content: center;
        background-color: #f5d742a9;
        color: black;
        border: none;
        padding: 15px 30px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        margin: 10px 2px;
        cursor: pointer;
        border-radius: 8px;
    }

    .yellow-button:hover {
        background-color: gold;
    }
</style>

</html>