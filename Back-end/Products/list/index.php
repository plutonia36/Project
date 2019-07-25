<?php



require "../../libs/cors.php";
cors();

require "../../libs/connexiondb.php";



header('Content-Type: application/json');


$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "products"          => NULL
];



$sth = $bdd->prepare('SELECT * FROM products;');
$result = $sth->execute();
if($result && $sth->rowCount() > 0)
{
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    $response["products"] = $data;
    $response["error_message"] = "";
    $response["error"] = false;
}
else
{
    $response["error_message"] = "erreur parametre: fonction 'products' manquante";
}


$sth->closeCursor();
   

echo json_encode($response);

die();