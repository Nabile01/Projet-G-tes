<?php
require_once "C:\wamp64\www\Exercices\P. GITES/connect.php";
require_once "C:\wamp64\www\Exercices\P. GITES\classes/class.booking.php";
require_once "C:\wamp64\www\Exercices\P. GITES\classes/class.lodge.php";

//🍺🍺🍺 JSON
$test = json_decode(file_get_contents("php://input"), true);


foreach ($test as $data => $key) {
    if (!empty($data)) {

        $content = '';
        $k = '';

        $nb = count($key);
        $i = 0;
        

        foreach ($key as $value) {
            if ($i < $nb) {
                $k .= "'" . implode ( "','", $key ) . "'";
                echo $k;
            } else {
                $k .= "'" . $value . "'";
            }
            $i++;
        }

        $lodgeWhere = [];

        try {
            $req = $db->prepare("SELECT * FROM `lodge` WHERE `category` IN ($k)");
            // $req->bindValue(':user', $k);
            $req->execute();
        } catch (Exception $e) {
            echo 'Echec de requete' . $e->getMessage();
        }


        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $lodgeWhere[] = new Lodge($donnees);

            $content .= '<div class="entry">';
            $content .= '<h3>' . $donnees['lodgename'] . '<h3>';
            $content .= '<p>' . $donnees['category'] . '<p>';
            $content .= '<p>' . $donnees['specificity'] . '<p>';
            $content .= '<p>' . $donnees['bathroom'] . '<p>';
            $content .= '<p>' . $donnees['bedroom'] . '<p>';
            $content .= '</div>';
        }
        echo $content;
    }
}

// $test = json_decode(file_get_contents("php://input"));

// var_dump($test);
// {
//     $lodge = [];
//     $req = $db->query('SELECT * FROM `lodge` WHERE `category` OR `specificity` OR `bedroom` OR `bathroom` IN (Maison, Appartement , Chambre)');
//     while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
//         $lodge[] = new Lodge($donnees);
//     }
//     return $lodge;
// }                                                                                                                                                   



// foreach ($test as $data => $key) {
//     if (!empty($data[0])) {

//         $content = '';
        
//         $lodgeWhere = [];
//         $req = $db->prepare('SELECT * FROM `lodge` WHERE `category` IN (Maison)');
//         $req->bindValue(':user', implode(',',$key));
//         $req->execute();
//         while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
//             $lodgeWhere[] = new Lodge($donnees);

//             $content .= '<div class="entry">';
//             $content .= '<h3>'.$donnees['lodgename'].'<h3>';
//             $content .= '<p>' .$donnees['category'].'<p>';
//             $content .= '<p>' .$donnees['specificity'].'<p>';
//             $content .= '<p>' .$donnees['bathroom'].'<p>';
//             $content .= '<p>' .$donnees['bedroom'].'<p>';
//             $content .= '</div>';
            
//         }
      
//         var_dump($lodgeWhere);
//         var_dump($donnees);
//         echo $content;
//     }
// }






// foreach ($test as $data => $key) {
//     if (!empty($data[0])) {

//         $content = '';
//         $k = '';
//         foreach ($key as $value) {
//             $k .= "" . $value . "";
//         }
//         echo $k;
       
//         $lodgeWhere = [];
//         $req = $db->prepare("SELECT * FROM `lodge` WHERE `category` IN (:user)");
//         $req->bindValue(':user', $k);
//         $req->execute();

//         while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
//             $lodgeWhere[] = new Lodge($donnees);

//             $content .= '<div class="entry">';
//             $content .= '<h3>' . $donnees['lodgename'] . '<h3>';
//             $content .= '<p>' . $donnees['category'] . '<p>';
//             $content .= '<p>' . $donnees['specificity'] . '<p>';
//             $content .= '<p>' . $donnees['bathroom'] . '<p>';
//             $content .= '<p>' . $donnees['bedroom'] . '<p>';
//             $content .= '</div>';
//         }
//         echo $content;
//     }
// }
