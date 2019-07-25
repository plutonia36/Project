<?php




require "../../libs/cors.php";
require "../../libs/connexiondb.php";
cors();

header('Content-Type: application/json');

$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "products"          => NULL
];

if(!isset($_REQUEST["id_products"]) || empty($_REQUEST["id_products"]) || !is_numeric($_REQUEST["id_products"]))
{
    $response["error_message"] = "Erreur paramètre";
    echo json_encode($response);
    die();
}

$id_product = $_REQUEST["id_products"];

$sth = $bdd->prepare('DELETE FROM products WHERE id_products = :id_products');
$sth->bindValue(":id_products", $id_product, PDO::PARAM_INT);
$result = $sth->execute();
if($result)
{
    //$data = "ok";
   //$response["products"] = $data;
    $response["error_message"] = "";
    $response["error"] = false;
    $response["status"] = 'ok';
}
else
{
    $response["error_message"] = "erreur parametre: fonction 'id_products' manquante";
}


$sth->closeCursor();
   

echo json_encode($response);

die();