<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <title>Gestion des gîtes</title>
</head>

<body class="formulaire">
    <header>
        <nav class="nav">
            <ol>
                <li><a href="form.php">Gestion gites</a></li>
                <li><a href="historique.php">Historique</a></li>
                <li><a href="#">Déconnexion</a></li>
            </ol>
        </nav>

        <h1>Gestion des gîtes</h1>
    </header>
    <?php
    require_once "connect.php";
    require_once "classes/class.booking.php";
    require_once "classes/BookingManager.php";
    require_once "classes/LodgeManager.php";
    require_once "classes/class.lodge.php";

    if (!empty($_GET['id'])) { // préremplir le formulaire avec edit
        $manager = new LodgeManager($db);
        $lodge = $manager->getListid($_GET['id']);
    }

    /* -------------------------------- ADD IMAGE ------------------------------- */
    if (isset($_POST['submit'])) {
        $nbfichiersEnvoyes = count($_FILES['image']['name']); //compte le nombre dimage uploadé
        $dossier = '.\media_serv\\'; //chemin de limage
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'jfif']; // extension de limage autorise

        for ($i = 0; $i < $nbfichiersEnvoyes; $i++) {
            $file_name = basename($_FILES['image']['name'][$i]); // basename pour recup que le nom
            $file_tmp = $_FILES['image']['tmp_name'][$i];
            $fichier_type = $_FILES['image']['type'][$i];
            $fichier_size = $_FILES['image']['size'][$i];
            $file_exploded = explode('.', $file_name);
            $file_ext = strtolower(end($file_exploded));
            $file = $dossier . $file_name;
            $return_name[] = $dossier . $file_name;
            move_uploaded_file($file_tmp, $file);
        }
    } else if (isset($_POST['submit'])) {
        echo "Echec de l'insertion, type de fichier autorisés 'jpg', 'jpeg', 'png', 'gif', 'jfif'";
    }
    /* ---------------------------------- UDATE --------------------------------- */
    if (isset($_POST['submit']) && !empty($_POST['hidden'])) {
        if (in_array($file_ext, $extensions)) {
            $manager = new LodgeManager($db);
            $lodge = new Lodge(array('idlodge' => $_POST['hidden'], 'lodgename' => $_POST['name'], 'bedroom' => $_POST['bedroom'], 'bathroom' => $_POST['bathroom'], 'price' => $_POST['price'], 'location' => $_POST['location'], 'category' => $_POST['category'], 'specificity' => implode(',', $_POST['box']), 'image' => serialize($return_name), 'description' => $_POST['description']));

            $lodge = $manager->update($lodge);
            echo "Edition réussie";
        }

        /* --------------------------------- INSERT --------------------------------- */
    } else if (isset($_POST['submit'])) {

        if (in_array($file_ext, $extensions)) {
            $manager = new LodgeManager($db);
            $lodge = new Lodge(array('lodgename' => $_POST['name'], 'bedroom' => $_POST['bedroom'], 'bathroom' => $_POST['bathroom'], 'price' => $_POST['price'], 'location' => $_POST['location'], 'category' => $_POST['category'], 'specificity' => implode(',', $_POST['box']), 'image' => serialize($return_name), 'description' => $_POST['description']));
            $manager->addLodge($lodge);
            echo "Insertion en base de donnée réussi";
        } else {
            echo "Echec de l'insertion, type de fichier autorisés 'jpg', 'jpeg', 'png', 'gif', 'jfif'";
        }
    }

    ?>
    <form action="form.php" method="POST" enctype="multipart/form-data">
        <div class="box">
            <div>
                <input type="hidden" name="hidden" required value="<?php if (isset($_GET['id'])) {
                                                                        echo $lodge->getIdlodge();
                                                                    } ?>">

                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" required value="<?php if (isset($_GET['id'])) {
                                                                                echo $lodge->getLodgename();
                                                                            } ?>">

                <label for="price">Prix :</label>
                <input required type="number" name="price" step=".01" id="price" value="<?php if (isset($_GET['id'])) {
                                                                                            echo $lodge->getPrice();
                                                                                        } ?>">
            </div>

            <div>
                <label for="location">Localisation :</label>
                <input required type="text" name="location" id="location" value="<?php if (isset($_GET['id'])) {
                                                                                        echo $lodge->getLocation();
                                                                                    } ?>">
            </div>

            <div>
                <label for="bedroom">Nombre de chambre :</label>
                <input required type="number" name="bedroom" id="bedroom" min="0" max="99" step="1" value="<?php if (isset($_GET['id'])) {
                                                                                                                echo $lodge->getBedroom();
                                                                                                            } ?>">

                <label for="bathroom">Nombre de salle de bain :</label>
                <input required type="number" name="bathroom" id="bathroom" min="0" max="99" step="1" value="<?php if (isset($_GET['id'])) {
                                                                                                                    echo $lodge->getBathroom();
                                                                                                                } ?>">
            </div>
            <div>
                <input required type="file" name="image[]" multiple>
                <div>
                    <?php
                    if (isset($_GET['id'])) {
                        $box = explode(',', ($lodge->getSpecificity()));
                    }
                    ?>
                    <label for="studio">Studio</label>
                    <input type="radio" name="box[]" value="Studio" <?php if (isset($_GET['id']) && in_array("Studio", $box)) {
                                                                        echo "checked='checked'";
                                                                    } ?>>

                    <label for="T2">T2</label>
                    <input type="radio" name="box[]" value="T2" <?php if (isset($_GET['id']) && in_array("T2", $box)) {
                                                                    echo "checked='checked'";
                                                                } ?>>

                    <label for="T3">T3</label>
                    <input type="radio" name="box[]" value="T3" <?php if (isset($_GET['id']) && in_array("T3", $box)) {
                                                                    echo "checked='checked'";
                                                                } ?>>

                    <label for="T4">T4</label>
                    <input type="radio" name="box[]" value="T4" <?php if (isset($_GET['id']) && in_array("T4", $box)) {
                                                                    echo "checked='checked'";
                                                                } ?>>

                    <label for="garden">Jardin</label>
                    <input type="checkbox" name="box[]" value="Jardin" <?php if (isset($_GET['id']) && in_array("Jardin", $box)) {
                                                                            echo "checked='checked'";
                                                                        } ?>>
                </div>

                <select required name="category" id="category">
                    <option value="Appartement" <?php if (isset($_GET['id'])) {
                                                    echo ($lodge->getCategory() == "Appartement") ? "selected" : "";
                                                } ?>>Appartement</option>
                    <option value="Maison" <?php if (isset($_GET['id'])) {
                                                echo ($lodge->getCategory() == "Maison") ? "selected" : "";
                                            } ?>>Maison</option>
                    <option value="Chambre" <?php if (isset($_GET['id'])) {
                                                echo ($lodge->getCategory() == "Chambre") ? "selected" : "";
                                            } ?>>Chambre</option>
                    <option value="Villa" <?php if (isset($_GET['id'])) {
                                                echo ($lodge->getCategory() == "Villa") ? "selected" : "";
                                            } ?>>Villa</option>
                </select>
            </div>

            <div class="text_area">
                <textarea required name="description" id="description"><?php if (isset($_GET['id'])) {
                                                                            echo $lodge->getDescription();
                                                                        } ?></textarea>
            </div>
            <input type="submit" name='submit' value="Enregistrer">
    </form>
    <footer>

    </footer>
</body>

</html>