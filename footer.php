<style>
    footer {
        background: #24262b;
        padding: 50px 0;
        width: 100%;
        bottom: 0;
        box-sizing: border-box;
        /**/
    }

    .footer-contenu {
        width: 360px;
        /**/
        margin: auto;
        padding: 0 20px;
        /* Ajout de padding sur les côtés */
    }

    footer ul {
        list-style: none;

        margin: 0;

        padding: 0;

    }

    .row {

        display: block;
        /*aligner par vertical*/
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .footer-colone {
        width: 100%;
        padding: 0 0 20px;

    }

    .footer-colone h4 {
        font-size: 16px;
        color: white;
        text-transform: capitalize;

        margin-bottom: 35px;
        /*distance entre h4 et liste*/
        font-weight: 500;

        position: relative;
    }

    .footer-colone h4::before {
        /*mettre bar en dessous de h4*/
        content: '';
        position: absolute;
        left: 0;
        /*a gauche */
        bottom: -10px;
        /*-10px en dessous du parent*/
        background-color: #F5C242 ;
        /*or*/
        height: 2px;
        /*hauteur de la bar*/
        width: 50px;
        /*largeur de la bar*/

    }

    .footer-colone ul li:not(:last-child) {
        margin-bottom: 10px;
        /* Réduction de l'espace entre les éléments */
    }

    .footer-colone ul li a {
        font-size: 16px;
        /*taille police*/
        text-transform: capitalize;
        /*premiere lettre en maj*/
        text-decoration: none;
        /*enleve les deco*/
        font-weight: 300;
        /*epaiseur police*/
        color: #bbbbbb;
        /*texte couleur*/
        display: block;
        /*def comme block donc prend tt la largeur*/
        transition: all 0.3s ease;
        /*decale plus lentement que instantaner*/
    }

    .footer-colone ul li a:hover {
        /*quand on passe dessus ca declale*/
        color: white;
        padding-left: 10px;
        /*declale de 10 px*/
    }

    .social-links {
    display: flex;
    justify-content: space-around; /* Espacement entre les icônes */
}
    .social-links a {
        display: inline-block;
        height: 40px;
        width: 40px;
        background-color: #f0f9fe;
        border: 3px solid #f0f9fe;
        text-align: center;
        line-height: 40px;
        border-radius: 50%;
        color: #F5C242 ;
        overflow: hidden;
        position: relative;
        z-index: 1;
        transition: background-color 0.8s ease, transform 0.8s ease;
    }

    .social-links a:hover {
        color: #24262b;
        transform: rotateY(360deg);
    }

    .icon {
        font-size: 1.5rem;  /* Ajustez selon vos besoins pour la visibilité */
        color: #F5C242 ;  /* Couleur initiale des icônes */
        z-index: 3;  /* S'assurer que les icônes restent au-dessus du fond */
        position: relative;
        transition: color 0.5s ease;
    }
    .social-links a:hover .icon {
        color: white;  /* Couleur des icônes au survol pour contraste */
    }
    .social-links a::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: var(--bg-color);
        top: 0;
        left: 0;
        z-index: 0;
        transition: opacity 0.3s ease;
        opacity: 0;
    }

    .social-links a:hover::before {
        opacity: 1;
    }

    /* Customizing Colors */
    .social-links a:nth-child(1) {
        --bg-color: #0077b5; /* Facebook */
    }

    .social-links a:nth-child(2) {
        --bg-color: black; /* Twitter */
    }

    .social-links a:nth-child(3) {
        --bg-color: linear-gradient(to right, #e077b5, #ff8c00); /* Instagram */
    }

    .social-links a:nth-child(4) {
        --bg-color: #0077b5; /* Linklin */
    }


</style>;

<footer class="footer">
    <div class="footer-contenu">
        <div class="row">

            <div class="footer-colone">
                <h4>BlaBlaOmnes</h4>
                <ul>
                    <li><a href="#">A propos de nous</a></li>
                    <li><a href="#">Nos services</a></li>
                    <li><a href="#">Politique De Confidentialité</a></li>
                </ul>
            </div>

            <div class="footer-colone">
                <h4>Aide</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">options de payment</a></li>
                </ul>
            </div>

            <div class="footer-colone">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="icon fab fa-facebook-f"></i></a>
                    <a href="#"><i class="icon fab fa-x-twitter"></i></a>
                    <a href="#"><i class="icon fab fa-instagram"></i></a>
                    <a href="#"><i class="icon fab fa-linkedin-in"></i></a>
                </div>
            </div>

        </div>
    </div>
</footer>