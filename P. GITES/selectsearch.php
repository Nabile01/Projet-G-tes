<?php
require_once "connect.php";
require_once "classes/class.booking.php";
require_once "classes/class.lodge.php";


//🍺🍺🍺 JSON
$test = json_decode(file_get_contents("php://input"), true);
$j = 0;
$q = '';

foreach ((array)$test as $data => $key) {
    if (!empty($data)) {

        $k = '';
        $nb = count($key);
        $i = 1;

        foreach ($key as $value) {
            if (is_array($value) > 1) {
                $k .= "'" . implode(',', $value) . "'";
            } else if ($i < $nb) {
                $k .= "'" . $value . "',";
            } else {
                $k .= "'" . $value . "'";
            }
            $i++;
        }

        if (strlen($k)) {
            switch ($data) {
                case "boxCategory":
                    if (strlen($q) > 1) {
                        $q .= "AND `category` IN ($k) ";
                    } else {
                        $q .= "`category` IN ($k) ";
                    }
                    break;
                case "boxSpecificity":
                    if (strlen($q) > 1) {
                        $q .= "AND `specificity` IN ($k) ";
                    } else {
                        $q .= "`specificity` IN ($k) ";
                    }
                    break;
                case "boxBedroom":
                    if (strlen($q) > 1) {
                        $q .= "AND `bedroom` IN ($k) ";
                    } else {
                        $q .= "`bedroom` IN ($k) ";
                    }
                    break;
                case "boxBathroom":
                    if (strlen($q) > 1) {
                        $q .= "AND `bathroom` IN ($k) ";
                    } else {
                        $q .= "`bathroom` IN ($k) ";
                    }
                    break;
                default:
                    break;
            }
        }
    }
}

$lodgeWhere = [];
try {
    $req = $db->prepare("SELECT * FROM `lodge` WHERE $q");
    $req->execute();
    $content = '';
    while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
        $lodgeWhere[] = new Lodge($donnees);
        foreach ($lodgeWhere as $data) {
            $array = unserialize($data->getImage());
        }
        $content .= '<a class="presengite" href="presentation.php?id= ' . $donnees['idlodge'] . '">';
        $content .= '<div class="photogite">';
        $content .= '<div>';
        $content .= '<img src="' . $array[0] . '" width="100%" height="300px" alt="">';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="descrigite">';
        $content .= '<div class="vignette">';
        $content .= '<img src="' . $array[1] . '" width="100%" height="130px" alt="">';
        $content .= '<img src="' . $array[2] . '" width="100%" height="130px" alt="">';
        $content .= '</div>';
        $content .= '<h2>' . $donnees['lodgename'] . '</h2>';
        $content .= '<div class="descritext1">';
        $content .= '<p>Categorie:' . $donnees['category'] . '</p><br>';
        $content .= '<p>Nombre de chambre:' . $donnees['bedroom'] . '</p><br>';
        $content .= '<p>Nombre de salle de bain:' . $donnees['bathroom'] . '</p>';
        $content .= '</div>';
        $content .= '<div class="descritext2">';
        $content .= '<p>Prix:' . $donnees['price'] . '€/ jours </p><br>';
        $content .= '<p>Localisation:' . $donnees['location'] . '</p><br>';
        $content .= '</div>';
        $content .= '</div>';
    }
    echo $content;
} catch (Exception $e) {
    echo 'Echec de requete' . $e->getMessage();
}

