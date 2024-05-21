<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script><!-- Inclut TailwindCSS -->
  <link rel="stylesheet" href="SeConnecter.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <title>BlaBLA Omnes</title>
</head>
<body>
  <div class="section">
    <div class="mx-auto">
      <div class="full-height flex justify-center">
        <div class="text-center self-center">
          <div class="section pb-5 pt-5 pt-2 sm:pt-0 text-center">
            <h6 class="mb-0 pb-3"><span>Se Connecter</span><span>S'inscrire</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <form method="POST" action="SeConnecterTest.php">
                        <h4 class="mb-6 pb-4 font-medium text-3xl">Se Connecter</h4>
                        <div class="form-group">
                          <input id="mail" type="email" class="form-style" placeholder="Email" name="login_email" required>
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input id="MDP" type="password" class="form-style" placeholder="Mot De Passe" name="login_password" required>
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <input type="submit" class="btn mt-4" value="Se Connecter">
                      </form>
                      <p class="mb-0 mt-4 text-center"><a href="#" class="link">Mot de passe oublié?</a></p>
                    </div>
                  </div>
                </div>
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <form method="POST" action="Inscription.php" enctype="multipart/form-data">
                        <h4 class="mb-3 pb-3 font-medium text-3xl">S'inscrire</h4>
                        <div class="form-group">
                          <input id="nom" name="nom" type="text" class="form-style" placeholder="Nom" required>
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group">
                          <input id="Prenom" name="Prenom" type="text" class="form-style" placeholder="Prénom" required>
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input id="Num_Tel" name="Num_Tel" type="tel" class="form-style" placeholder="Numéro de Téléphone" required>
                          <i class="input-icon uil uil-phone"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input id="mail" name="mail" type="email" class="form-style" placeholder="Email" required>
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input id="MDP" name="MDP" type="password" class="form-style" placeholder="Mot De Passe" required>
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input id="Photo" name="Photo" type="file" class="form-style" placeholder="Photo" required>
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <input type="submit" class="btn mt-4" value="S'inscrire" name="ok">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
