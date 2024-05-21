<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Blabla Omnes</title>
</head>

<body>

<form method="POST" action="Inscription_2.php" enctype="multipart/form-data">
    <label>Votre nom</label>
    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom..." required>
    <br />
    <label>Votre prénom</label>
    <input type="text" id="Prenom" name="Prenom" placeholder="Entrez votre prénom..." required>
    <br />
    <label>Votre photo</label>
    <input type="file" id="Photo" name="Photo" required>
    <br />
    <label>Votre numéro de tél</label>
    <input type="text" id="Num_Tel" name="Num_Tel" placeholder="Entrez votre numéro..." required>
    <br />
    <label>Votre email</label>
    <input type="email" id="mail" name="mail" placeholder="Entrez votre email..." required>
    <br />
    <label>Votre mot de passe</label>
    <input type="password" id="MDP" name="MDP" placeholder="Entrez votre mot de passe..." required>
    <br />
    <input type="submit" value="M'inscrire" name="ok">
</form>

</body>

</html>
