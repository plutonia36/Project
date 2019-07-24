<?php

require "../../libs/cors.php";
cors();
require "../../libs/connexiondb.php";

header('Content-Type: application/json');

$reponse = [
    "error"         => true, 
    "error_message" => "Uknown error", 
    "data"          => "" 
];

if(isset($_GET["name"],$_GET["quantity"],$_GET["price"]))
{
    $name=$_GET["name"];
    $quantity=$_GET["quantity"];
    $price=$_GET["price"];
    
    $sql = "UPDATE products SET name =$name, quantity=$quantity, price=$price WHERE name=:name AND quantity=:quantity AND price=:price;";
    $stmtnt = $bdd->prepare($sql);
    $stmtnt->bindValue("name",$name,PDO::PARAM_STR);
    $stmtnt->bindValue("quantity",$quantity,PDO::PARAM_INT);
    $stmtnt->bindValue("price",$price,PDO::PARAM_INT);
    $stmtnt->execute();
    if($stmtnt)
    {
        $data = "ok";
        $response["products"] = $data;
        $response["error_message"] = "";
        $response["error"] = false;
    }
    else
    {
        $response["error_message"] = "Erreur parametre: fonction 'name','quantity' et 'price' manquante ";
    }
    
    echo json_encode($reponse);
    
    die();
}


