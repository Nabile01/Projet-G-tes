<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Historique</title>
</head>

<body class="histo">
    <?php

    require_once "connect.php";
    require_once "classes/class.booking.php";
    require_once "classes/BookingManager.php";
    require_once "classes/LodgeManager.php";
    require_once "classes/class.lodge.php";

    $manager = new LodgeManager($db);
    $lodge = $manager->getListLodge();
    /* --------------------------------- DELETE --------------------------------- */
    if (!empty($_GET['id'])) {
        $lodge = $manager->getListId($_GET['id']);
        $lodge=$manager->deleteLodge($lodge);
    }
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="historique.php">Historique</a></li>
                <li><a href="form.php">Gestion des gîtes</a></li>
                <li><a href="">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>HISTORIQUE</h1>
        <div>
            <table class="histoire">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Localisation</th>
                        <th scope="col">Caractéristique</th>
                        <th scope="col">Nb. Salle de Bain</th>
                        <th scope="col">Nb. Chambre</th>
                        <th scope="col">MODIFIER</th>
                        <th scope="col">SUPPRIMER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lodge as $data) : ?>
                        <tr>
                            <td><?= $data->getIdlodge(); ?></td>
                            <td><?= $data->getLodgename(); ?></td>
                            <td><?= $data->getLocation(); ?></td>
                            <td><?= $data->getSpecificity(); ?></td>
                            <td><?= $data->getBathroom(); ?></td>
                            <td><?= $data->getBedroom(); ?></td>
                            <td><button><a href="historique.php?id=<?= $data->getIdlodge(); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ?'));">Supprimer </a></button></td>
                            <td><button><a href="form.php?id=<?= $data->getIdlodge(); ?>">Modifier</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!--pagination
        <body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                
                <table class="table">
                    <thead>
                        <th scope="idlodge">ID</th>
                        <th scope="lodgename">Nom du gîte</th>
                        <th scope="bedroom">Nbr de chambre</th>
                        <th scope="bathroom">Nbr de salle d'eau</th>
                        <th scope="price">Prix</th>
                        <th scope="arrival">Date d'arrivée</th>
                        <th scope="departure">Date de départ</th>
                        <th scope="location">Lieux</th>
                        <th scope="category">Catégorie</th>
                        <th scope="specificity">Spécificité</th>
                        <th scope="image">Photo</th>
                        
                    </thead>
                    <tbody>
                    <?php
                        foreach($articles as $article){
                        ?>
                            <tr>
                                <td><?= $article['idlodge'] ?></td>
                                <td><?= $article['lodgename'] ?></td>
                                <td><?= $article['bedroom'] ?></td>
                                <td><?= $article['bathroom'] ?></td>
                                <td><?= $article['price'] ?></td>
                                <td><?= $article['arrival'] ?></td>
                                <td><?= $article['departure'] ?></td>
                                <td><?= $article['location'] ?></td>
                                <td><?= $article['category'] ?></td>
                                <td><?= $article['specificity'] ?></td>
                                <td><?= $article['image'] ?></td>
                                
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>-->
        
    </main>
</body>

</html>