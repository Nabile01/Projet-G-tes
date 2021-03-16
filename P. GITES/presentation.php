<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/Blason73-Savoie.svg/164px-Blason73-Savoie.svg.png">
    <title>Projet gîte</title>
</head>

<body class="presentation">
    <header>
        <section class="content">
            <form action="#" method="POST">
                <div class="formReach">

                    <label class="case" for="place">Destination:</label>
                    <input type="text" id="place" name="place">
                    <label class="case" for="arrive">Arrivée:</label>
                    <input type="date" id="start" name="start" placeholder="Arrivée">
                    <label class="case" for="departure">Départ:</label>
                    <input type="date" id="leave" name="leave">
                    <button type="submit" id="buttonResearch">Rechercher</button>
                </div>
            </form>
        </section>
    </header>
    <main>
        <?php
        require_once "connect.php";
        require_once "classes/LodgeManager.php";
        require_once "classes/class.booking.php";
        require_once "classes/class.lodge.php";
        require_once "classes/BookingManager.php";

        /* ---------------------- RECUPERATION LISTE DONNEE BDD --------------------- */
        $manager = new LodgeManager($db);
        $lodge = $manager->getListid($_GET['id']); //a recuperer plus tard en get
        ?>
        <section class="produit">
            <h3><?= $lodge->getLodgename(); ?></h3>
            <div class="affiche">
                <div class="central">
                    <?php
                    //BOUCLE SLIDER
                    foreach (unserialize($lodge->getImage()) as $image) {
                        echo '<div><img class="mySlides" src="' . $image . '" alt="" width="600px" height="450px"></div>';
                    } ?>
                    <?php
                    //ADD DATE
                    if (isset($_POST['bookingBtn'])) {
                        $managerBooking = new BookingManager($db);
                        $addBooking = new Booking(array('idbooking' => 0, 'idlodge' => $_GET['id'], 'arrival' => $_POST['arrival'], 'departure' => $_POST['departure']));
                        $managerBooking->addBooking($addBooking);
                    }
                    ?>
                </div>
            </div>
            <div class="reservationBox">
                <p class="price">Prix:<?php
                                        $calculprice = $lodge->getPrice() * 7;
                                        echo $lodge->getPrice() . '€/ jours'; ?></p>
                <p class="priceWeek"><?php echo $calculprice . '€/ semaine'; ?></p>
                <div class="form-reservation">
                    <form action="" method="post">
                        <div>
                            <label class="case-rese" for="arrival">Arrivée:</label>
                            <input type="date" name="arrival" id="start" min="<?= date("Y-m-d"); ?>">
                        </div>
                        <div>
                            <label class="case-rese" for="departure">Départ:</label>
                            <input type="date" name="departure" id="leave" min="<?= date("Y-m-d"); ?>">
                        </div>
                        <div>
                            <label class="case-rese" for="firstname">Prénom:</label>
                            <input type="text" name="firstname" id="prenom">
                        </div>
                        <div>
                            <label class="case-rese" for="lastname">Nom:</label>
                            <input type="text" name="lastname" id="nom">
                        </div>
                        <div class="resEmail">
                            <label class="case-rese" for="email">E-Mail:</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="button">
                            <button id="bookingBtn" name="bookingBtn" type="submit">Réserver</button>
                        </div>
                </div>
            </div>
            </div>
            <div class="w3-center">
                <div class="w3-section">
                    <!-- <button class="w3-button w3-light-grey" onclick="plusDivs(-1)">❮ Prev</button> -->
                    <div><a class="w3-button demo" onclick="currentDiv(1)"></a></div>
                    <div><a class="w3-button demo" onclick="currentDiv(2)"></a></div>
                    <div><a class="w3-button demo" onclick="currentDiv(3)"></a></div>
                    <div><a class="w3-button demo" onclick="currentDiv(4)"></a></div>
                    <!-- <button class="w3-button w3-light-grey" onclick="plusDivs(1)">Next ❯</button> -->
                </div>
                <div class="reservation">

                </div>
                <?php
                if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email'])) {

                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $finaleprice = 'nbrjour reserver * prix journalier';
                    $nomdugite = '<?= $lodge->getLodgename(); ?>';
                    $send = "Bonjour $firstname $lastname vous vous appretez à reserver le gite $nomdugite pour un prix de $finaleprice";

                    $dest = $email;
                    $sujet = "Reservation Gite !";
                    $message = $send;
                    $header = "From: $dest";
                    mail($dest, $sujet, $message, $header);
                }
                ?>
                </form>
            </div>
            </div>
        </section>

        <section class="description">
            <div class="listDescri">
                <h2><?= $lodge->getLodgename(); ?></h2>
                <div class="Speci1">
               
                    <p><i><img class="Icon" src="media/douche.png" alt=""></i>Localisation: <?= $lodge->getLocation(); ?></p>
                    <p><i><img class="Icon" src="media/lit-d'hotel.png" alt=""></i>Nombre de couchage: <?= $lodge->getBedroom(); ?></p>
                    <p>Spécificité: <?= $lodge->getSpecificity(); ?></p>
                </div>
                <div class="Speci1">
                    <p> Catégorie: <?= $lodge->getCategory(); ?></li>
                    <p><i><img class="Icon" src="media/douche.png" alt=""></i>Nombre de salle de bain: <?= $lodge->getBathroom(); ?></p>
                    <p> Prix: <?= $lodge->getPrice(); ?> Euros</li>
                </div>
                <p class="lodgeDescription"><?= $lodge->getDescription(); ?></p>
            </div>
            <script>
                var slideIndex = 1;
                showDivs(slideIndex);

                function plusDivs(n) {
                    showDivs(slideIndex += n);
                }

                function currentDiv(n) {
                    showDivs(slideIndex = n);
                }

                function showDivs(n) {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("demo");
                    if (n > x.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = x.length
                    }
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" w3-red", "");
                    }
                    x[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " w3-red";
                }
                var myIndex = 0;
                carousel();

                function carousel() {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    myIndex++;
                    if (myIndex > x.length) {
                        myIndex = 1
                    }
                    x[myIndex - 1].style.display = "block";
                    setTimeout(carousel, 6000);
                }
            </script>

        </section>
    </main>
    <footer>
        <div>Réseaux</div>
        <div>Copyright</div>
        <div>Contact</div>
    </footer>
</body>

</html>