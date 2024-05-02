<style>
    footer {
        background: #24262b;
        /*couleur*/
        padding: 50px 0;
        /*distance haut et bas*/
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0; /* bas de page */
    }

    .footer-contenu {
        max-width: 1170px;
        margin: auto;
    }

    footer ul {
        list-style: none;
        /*pas de point pour liste*/
        margin: 0;
        /* Supprime le remplissage par défaut */
        padding: 0;
        /* Supprime la marge par défaut */
    }

    .row {
        /*aligner par colone*/
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .footer-colone {
        width: 25%;
        padding: 0 30px;
    }

    .footer-colone h4 {
        font-size: 18px;
        color: white;
        text-transform: capitalize;
        /*premiere lettre en maj*/
        margin-bottom: 35px;
        /*distance entre h4 et liste*/
        font-weight: 500;
        /*epaiseur gras*/
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
        background-color: #e91e63;
        height: 2px;
        /*hauteur de la bar*/
        width: 50px;
        /*largeur de la bar*/
        box-sizing: border-box;
    }

    .footer-colone ul li:not(:last-child) {
        /*tout sauf le dernier element*/
        margin-bottom: 10px;
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

    .footer-colone .social-links a {
        display: inline-block;
        height: 40px;
        width: 40px;
        background-color: rgba(255, 255, 255, 0.2);
        margin: 0 10px 10px 0;
        text-align: center;
        /*aligner les logo sur horizontal*/
        line-height: 40px;
        /*aligne les logos sur verticale*/
        border-radius: 50%;
        /*fait contour arrondit*/
        color: white;
        /*couleur logo*/
        transform: all 0.5s ease;

    }

    .footer-colone .social-links a:hover {
        color: #24262b;
        background-color: white;

    }
</style>;

<footer class="footer">
    <div class="footer-contenu">
        <div class="row">

            <div class="footer-colone">
                <h4>company</h4>
                <ul>
                    <li><a href="#">about us</a></li>
                    <li><a href="#">our services</a></li>
                    <li><a href="#">privacy policy</a></li>
                    <li><a href="#">affiliate program</a></li>
                </ul>
            </div>

            <div class="footer-colone">
                <h4>get help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">payment options</a></li>
                </ul>
            </div>

            <div class="footer-colone">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

        </div>
    </div>
</footer>