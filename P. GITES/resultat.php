<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Resultat</title>
</head>

<body class="resultat">
    <header>
        <section class="research">
            <form action="resultat.php" method="post">
                <div class="researchForm">
                    <input type="search" id="place" name="place" placeholder="Destination" value="<?= $_POST['place'] ?>">
                    <label class="case" for="arrive">Arrivée:</label>
                    <input type="date" id="start" name="start" value="<?= $_POST['start'] ?>" min="<?= date('Y-m-d') ?>">
                    <label class="case" for="departure">Départ:</label>
                    <input type="date" id="leave" name="leave" value="<?= $_POST['leave'] ?>" min="<?= date('Y-m-d') ?>">
                    <div class="button">
                        <button>Rechercher</button>
                    </div>
                </div>
            </form>
        </section>

        <div class="filter-box">
            <div>
                <h3>Prix</h3>
                <select id="SelectFilter">
                    <option name="selectPrice">--</option>
                    <option name="selectPrice" value="croissant">Ordre croissant</option>
                    <option name="selectPrice" value="decroissant">Ordre décroissant</option>
                </select>
            </div>

            <div>
                <h3>Catégorie</h3>
                <label for="">Chambre</label>
                <input type="checkbox" name="boxCategory[]" value="Chambre">

                <label for="">Appartement</label>
                <input type="checkbox" name="boxCategory[]" value="Appartement">

                <label for="">Maison</label>
                <input type="checkbox" name="boxCategory[]" value="Maison">

                <label for="">Villa</label>
                <input type="checkbox" name="boxCategory[]" value="Villa">
            </div>

            <div>
                <h3>Nombre de Salle de bain</h3>

                <label for="">1</label>
                <input type="checkbox" name="boxBathroom[]" value="1">

                <label for="">2</label>
                <input type="checkbox" name="boxBathroom[]" value="2">

                <label for="">3</label>
                <input type="checkbox" name="boxBathroom[]" value="3">

                <label for="">4</label>
                <input type="checkbox" name="boxBathroom[]" value="4">

                <label for="">5</label>
                <input type="checkbox" name="boxBathroom[]" value="5+">
            </div>

            <div>
                <h3>Nombre de chambre</h3>

                <label for="">1</label>
                <input type="checkbox" name="boxBedroom[]" value="1">

                <label for="">2</label>
                <input type="checkbox" name="boxBedroom[]" value="2">

                <label for="">3</label>
                <input type="checkbox" name="boxBedroom[]" value="3">

                <label for="">4</label>
                <input type="checkbox" name="boxBedroom[]" value="4">

                <label for="">5</label>
                <input type="checkbox" name="boxBedroom[]" value="5+">
            </div>

            <div>
                <h3>Spécificités</h3>
                <label for="">Studio</label>
                <input type="checkbox" name="boxSpecificity[]" value="Studio">

                <label for="">T2</label>
                <input type="checkbox" name="boxSpecificity[]" value="T2">

                <label for="">T3</label>
                <input type="checkbox" name="boxSpecificity[]" value="T3">

                <label for="">T4</label>
                <input type="checkbox" name="boxSpecificity[]" value="T4">

                <label for="">Jardin</label>
                <input type="checkbox" name="boxSpecificity[]" value="Jardin">
            </div>
        </div>
    </header>

    <main>
        <section class="result" id="result">
            <?php
            require "connect.php";
            require_once "classes/LodgeManager.php";
            require_once "classes/class.booking.php";
            require_once "classes/BookingManager.php";
            require_once "classes/class.lodge.php";
            require "selectsearch.php";
            $location = $_POST['place'];

            if (empty($_POST['start'])) {
                $arrival = date('Y-m-d');
            } else {
                $arrival = $_POST['start'];
                var_dump($arrival);
            }
            if (empty($_POST['leave'])) {
                $departure = date('Y-m-d');
            } else {
                $departure = $_POST['leave'];
            }

            $manager = new LodgeManager($db);
            if (!empty($_POST['place'])) {
                $lodge = new Lodge(array('location' => $location, 'arrival' => $arrival, 'departure' => $departure));
                $lodgeWhere = $manager->getSearch($lodge);
            } else {
                $lodgeWhere = $manager->getListLodge();
            }

            foreach ($lodgeWhere as $data) {
                $array = unserialize($data->getImage()); ?>
                <a id="lodge_click" class="presengite" href="presentation.php?id=<?= $data->getIdlodge(); ?>">
                    <div class="photogite">
                        <div><img src="<?= $array[0] ?>" width="100%" height="300px" alt=""></div>
                    </div>
                    <div class="descrigite">
                        <div class="vignette">
                            <img src="<?= $array[1] ?>" width="100%" height="130px" alt="">
                            <img src="<?= $array[2] ?>" width="100%" height="130px" alt="">
                        </div>

                        <h2><?= $data->getLodgename(); ?></h2>
                        <div class="descritext1">
                            <p>Categorie: <?= $data->getCategory(); ?></p><br>
                            <p>Nombre de chambre: <?= $data->getBedroom(); ?></p><br>
                            <p>Nombre de salle de bain: <?= $data->getBathroom(); ?></p>
                        </div>
                        <div class="descritext2">
                            <p>Prix: <?php echo $data->getPrice() . '€/ jours'; ?></p><br>
                            <p>Localisation: <?= $data->getLocation(); ?></p><br>
                        </div>

                    </div>
                </a>
            <?php } ?>
        </section>
        <script src="ajax.js"></script>
    </main>
    </body.resultat>

</html>