<?php
/*

ex_3 : 

*/

/* On authorise les requêtes provenant de n'importe quel origine  */
require "../../libs/cors.php";
require "../../libs/connexiondb.php";
cors();

/* On spécifie que le document généré doit être au format json */
header('Content-Type: application/json');

/* Réponse par défaut*/
$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "data"          => NULL
];


/* Requête : on récupère le premier résultat dans studebts*/
$sth = $bdd->prepare('SELECT * FROM products;');
$result = $sth->execute();
if($result)
{
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    $response["data"] = $data;
    $response["error_message"] = "";
    $response["error"] = false;
}
else
{
    $response["error_message"] = "ERROR QUERY";
}


$sth->closeCursor();
   

/* On affiche le tableau après l'avoir encodé au format json */
/* Par définition, JSON est un format d'échange de données 
(data interchange format).*/
echo json_encode($response);

/* on termine l'execution du script */
die();