<?php
require_once "C:\wamp64\www\Exercices\P. GITES/connect.php";

$test = json_decode(file_get_contents("php://input"));

var_dump($test);
foreach ((array)$test as $data => $key) {
    if (!empty($data[0])) {
        
        $lodgeWhere = [];
        $req = $db->prepare('SELECT * FROM `lodge` WHERE `category` IN (:user)');
        $req->bindValue(':user', implode(',',$key));
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $lodgeWhere[] = new Lodge($donnees);
        }
        return $lodgeWhere;
        var_dump($lodgeWhere);
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
