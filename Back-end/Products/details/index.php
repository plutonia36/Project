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


$sql = "SELECT `id_products`,`quantity`,`price` FROM products;";
$stmt = $bdd->prepare($sql);
$result = $stmt->execute();

if($result)
{
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response["products"] = $data;
    $response["error_message"] = "";
    $response["error"] = false;
}
else
{
    $response["error_message"] = "ERROR QUERY";
}


$stmt->closeCursor();
   

echo json_encode($response);

die();