<?php
require_once "C:\wamp64\www\Exercices\P. GITES/connect.php";

$test = json_decode(file_get_contents("php://input"));



foreach ($test as $data) {
    var_dump($data);
    $req = $db->prepare('SELECT * FROM `lodge` WHERE `specificity` OR `category` LIKE ');
    $req->execute();
}


