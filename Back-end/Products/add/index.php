<?php




require "../../libs/cors.php";
require "../../libs/connexiondb.php";
cors();

header('Content-Type: application/json');

$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "data"          => NULL
];

    $id_products=$_GET["id_products"];
    $name=$_GET["name"];
    $quantity=$_GET["quantity"];
    $price=$_GET["price"];


    $sql=("INSERT INTO products (id_products,name,quantity,price) VALUES (':id_products',':name',':quantity',':price');");
    $result = $bdd->query($sql);
    var_dump($result);
    if($result)
{
    $data = "ok";
    $response["data"] = $data;
    $response["error_message"] = "";
    $response["error"] = false;
}
else
{
    $response["error_message"] = "ERROR QUERY";
}


$reponse->closeCursor();
   

echo json_encode($response);

die();