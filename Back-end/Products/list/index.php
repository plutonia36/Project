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
if($result)
{
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    $response["products"] = $data;
    $response["error_message"] = "";
    $response["error"] = false;
}
else
{
    $response["error_message"] = "ERROR QUERY";
}


$sth->closeCursor();
   

echo json_encode($response);

die();