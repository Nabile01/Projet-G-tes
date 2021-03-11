<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
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
                <label for="">Ordre croissant</label>
                <input type="checkbox">

                <label for="">Ordre Décroissant</label>
                <input type="checkbox">
            </div>

            <div>
                <h3>Catégorie</h3>
                <label for="">Chambre</label>
                <input type="checkbox" name="box[]" value="Chambre">

                <label for="">Appartement</label>
                <input type="checkbox" name="box[]" value="Appartement">

                <label for="">Maison</label>
                <input type="checkbox" name="box[]" value="Maison">

                <label for="">Villa</label>
                <input type="checkbox" name="box[]" value="Villa">
            </div>

            <div>
                <h3>Nombre de Salle de bain</h3>

                <label for="">1</label>
                <input type="checkbox" name="box[]" value="1">
                
                <label for="">2</label>
                <input type="checkbox" name="box[]" value="2">

                <label for="">3</label>
                <input type="checkbox" name="box[]" value="3">

                <label for="">4</label>
                <input type="checkbox" name="box[]" value="4">
                
                <label for="">5+</label>
                <input type="checkbox" name="box[]" value="5+">
            </div>

            <div>
                <h3>Nombre de chambre</h3>

                <label for="">1</label>
                <input type="checkbox" name="box[]" value="1">

                <label for="">2</label>
                <input type="checkbox" name="box[]" value="2">

                <label for="">3</label>
                <input type="checkbox" name="box[]" value="3">

                <label for="">4</label>
                <input type="checkbox" name="box[]" value="4">
                
                <label for="">5+</label>
                <input type="checkbox" name="box[]" value="5+">
            </div>

            <div>
                <h3>Spécificités</h3>
                <label for="">Studio</label>
                <input type="checkbox" name="box[]" value="Studio">

                <label for="">T2</label>
                <input type="checkbox" name="box[]" value="T2">

                <label for="">T3</label>
                <input type="checkbox" name="box[]" value="T3">

                <label for="">T4</label>
                <input type="checkbox" name="box[]" value="T4">

                <label for="">Jardin</label>
                <input type="checkbox" name="box[]" value="Jardin">
            </div>
        </div>
    </header>

    <main>
        <section class="resultat">
            <div class="lodgeList">
                <?php
                require "connect.php";
                require_once "classes/class.booking.php";
                require_once "classes/LodgeManager.php";
                require_once "classes/class.lodge.php";
                require "ajax/selectsearch.php";
                $place = $_POST['place'];
                $arrival = $_POST['start'];
                $leave = $_POST['leave'];

                $manager = new LodgeManager($db);
                if (!empty ($_POST['place'])){
                    $lodge = new Lodge(array('location' => $place, 'arrival' => $arrival, 'departure' => $leave));
                    $lodgeWhere = $manager->getSearch($lodge);
                } else {
                    $lodgeWhere= $manager->getListLodge();
                }
                    foreach ($lodgeWhere as $data) :
                    foreach (unserialize($data->getImage()) as $image) {
                        echo '<div>';
                        echo '<img src="' . $image . '" alt="" width="50px" height="35">';
                        echo '</div>';
                    }
                ?>
                    <a href="presentation.php?id= <?= $data->getIdLodge() ?> ">
                        <div class="lodge">
                            <h3>Nom du gîte:<?= $data->getlodgename(); ?></h3>
                            <p>Categorie:<?= $data->getCategory(); ?></p>
                            <p>Surface:<?= $data->getSpecificity(); ?></p>
                            <p>Nombre de salle de bain:<?= $data->getBathroom(); ?></p>
                            <p>Nombre de couchage:<?= $data->getBedroom(); ?></p>
                        </div>
                    </a>
            </div>
        <?php endforeach;?>
        </section>
        <script src="ajax/ajax.js"></script>
    </main>
    </body.resultat>

</html>