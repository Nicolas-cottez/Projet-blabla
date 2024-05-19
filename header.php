<header>
  <div class="navigation_bar">
    <div class="logo"><a href="main.php">Blabla Omnes</a></div>
    <ul class="lien">
      <li><a href="main.php">Accueil</a></li>
      <li><a href="ChercheTrajet.php">Chercher un trajet</a></li>
      <li><a href="PublierTrajet.php">Publier un trajet</a></li>
      <li><a href="MesTrajet.php">Mes trajets</a></li>
      <li><a href="MonProfile.php">Mon profil</a></li>
    </ul>
    <a href="#" class="action_btn">Devenir conducteur</a>
    <div class="bar_btn">
      <i class="fa-solid fa-bars"></i>
    </div>
  </div>
  <div class="menu_deroulant">
    <li><a href="main.php">Accueil</a></li>
    <li><a href="ChercheTrajet.php">Chercher un trajet</a></li>
    <li><a href="PublierTrajet.php">Publier un trajet</a></li>
    <li><a href="MesTrajet.php">Mes trajets</a></li>
    <li><a href="MonProfile.php">Mon profil</a></li>
    <li><a href="DevenirConducteur.php">Devenir conducteur</a></li>
  </div>
</header>

<style>
  li {
    list-style: none;
  }

  a {
    text-decoration: none;
    color: white;
    font-size: 1rem;
  }

  a:hover {
    color: orange;
  }

  header {
    position: relative;
    padding: 0 2rem;
  }

  .navigation_bar {
    width: 100%;
    height: 60px;
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .navigation_bar .logo a {
    font-size: 1.5rem;
    font-weight: bold;
  }

  .navigation_bar .lien {
    display: flex;
    gap: 2rem;
  }

  .navigation_bar .bar_btn {
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    display: none;
  }

  .action_btn {
    background-color: Orange;
    color: #fff;
    padding: 0.5rem 1rem;
    border: none;
    outline: none;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
    cursor: pointer;
    transition: scale 0.2 ease;
  }

  .action_btn:hover {
    scale: 1.05;
    color: #fff;
  }

  .action_btn:active {
    scale: 0.95;
  }

  /* menu_deroulant */
  .menu_deroulant {
    position: absolute;
    display: none;
    right: 2rem;
    top: 60px;
    width: 300px;
    height: 0;
    background: rgba(240, 240, 240, 0.1);
    backdrop-filter: blur(15px);
    border-radius: 10px;
    overflow: hidden;
    transition: height 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }

  .menu_deroulant.open {
    height: 280px;
  }

  .menu_deroulant li {
    padding: 0.7rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .menu_deroulant .action_btn {
    width: 100%;
    display: flex;
    justify-content: center;
  }

  /* responsive design */
  @media (max-width: 992px) {

    .navigation_bar .lien,
    .navigation_bar .action_btn {
      display: none;
    }

    .navigation_bar .bar_btn {
      display: block;
    }

    .menu_deroulant {
      display: block;
    }
  }

  @media (max-width: 576px) {
    .menu_deroulant {
      left: 2rem;
      width: unset;
    }
  }
</style>

<script>
  const barBtn = document.querySelector('.bar_btn');
  const barBtnIcon = document.querySelector('.bar_btn i');
  const menuDeroulant = document.querySelector('.menu_deroulant');

  barBtn.onclick = function() {
    const isOpen = menuDeroulant.classList.toggle('open');
    barBtnIcon.classList = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
  }
</script>