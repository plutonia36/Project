<?php

require "../../libs/cors.php";
cors();
require "../../libs/connexiondb.php";

header('Content-Type: application/json');

$response = [
    "error"         => true, 
    "error_message" => "Uknown error", 
    "status"          => "non" 
];

if(isset($_REQUEST["name"],$_REQUEST["quantity"],$_REQUEST["price"], $_REQUEST["id_product"]))
{
    $name=$_REQUEST["name"];
    $quantity=$_REQUEST["quantity"];
    $price=$_REQUEST["price"];
    $id_product=$_REQUEST["id_product"];
    
    //$sql = "UPDATE products SET name =:name, quantity=$quantity, price=$price WHERE id_product=:id_products;";
    $sql = "UPDATE products SET name = :name, quantity= :quantity, price= :price WHERE id_product=:id_product;";

    $stmtnt = $bdd->prepare($sql);
    $stmtnt->bindValue(":name",$name,PDO::PARAM_STR);
    $stmtnt->bindValue(":quantity",$quantity,PDO::PARAM_INT);
    $stmtnt->bindValue(":price",$price,PDO::PARAM_INT);
    $stmtnt->bindValue(":id_product", $id_product, PDO::PARAM_INT);
    $stmtnt->execute();

    if($stmtnt){
 
        $response["error"]   = false;
        $response["error_message"]   = '';
        $response["status"]   = 'ok';  
    }
    else{
        $response["errormessage"]="données incomplets";
    }
    
}
else
{
    $response["error"]   = true;
    $response["error_message"]   ='les parametres n \'existe pas'; 
    $response["status"]   ='non';   
}
echo json_encode($response);
die();

