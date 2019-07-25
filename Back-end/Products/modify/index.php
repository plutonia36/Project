<?php

require "../../libs/cors.php";
cors();
require "../../libs/connexiondb.php";

header('Content-Type: application/json');

$response = [
    "error"         => true, 
    "error_message" => "Uknown error", 
    "data"          => "" 
];

if(isset($_GET["name"],$_GET["quantity"],$_GET["price"], $_GET["id_product"]))
{
    $name=$_GET["name"];
    $quantity=$_GET["quantity"];
    $price=$_GET["price"];
    $id_product=$_GET["id_product"];
    
    $sql = "UPDATE products SET name =$name, quantity=$quantity, price=$price 
    WHERE name=:name AND quantity=:quantity AND price=:price AND id_product=:id_product;";
    $stmtnt = $bdd->prepare($sql);
    $stmtnt->bindValue("name",$name,PDO::PARAM_STR);
    $stmtnt->bindValue("quantity",$quantity,PDO::PARAM_INT);
    $stmtnt->bindValue("price",$price,PDO::PARAM_INT);
    $stmtnt->bindValue("id_product",$id_product,PDO::PARAM_INT);
    $stmtnt->execute();
    if($stmtnt){
      
        $response["error"]=false;
        $response["data"]="ajouter";
    }
    else{
        $response["errormessage"]="données incomplets";
    }
    
}
echo json_encode($response);
die();

