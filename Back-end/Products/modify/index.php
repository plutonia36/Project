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

<<<<<<< HEAD
if(!isset($_REQUEST["name"])||!isset($_REQUEST["quantity"]) || !isset($_REQUEST["price"])|| !isset($_REQUEST["id_product"]))
{
    $response ['error_message']="les parametres : name , quantity , price , id_product  n \'existes pas" ;
    echo json_encode($response);
    die();
}elseif(empty($_REQUEST["name"])||empty($_REQUEST["quantity"]) || empty($_REQUEST["price"])|| empty($_REQUEST["id_product"]))
{
    $response ['error_message']="les parametres : name , quantity , price , id_product sont vides" ;
    echo json_encode($response);
    die();
}elseif(!is_numeric($_REQUEST["quantity"])||!is_numeric($_REQUEST["price"])||!is_numeric($_REQUEST["id_product"]))
{
    $response ['error_message']="Erreur : type des parametres " ;
    echo json_encode($response);
    die();
}
  
=======
if(isset($_REQUEST["name"],$_REQUEST["quantity"],$_REQUEST["price"], $_REQUEST["id_products"]))
{     
>>>>>>> parent of 570ec57... update add file
    $name=$_REQUEST["name"];
    $quantity=$_REQUEST["quantity"];
    $price=$_REQUEST["price"];
    $id_products=$_REQUEST["id_products"];
    
    //$sql = "UPDATE products SET name =:name, quantity=$quantity, price=$price WHERE id_products=:id_products;";
<<<<<<< HEAD
    $sql = "UPDATE products SET name = :name, quantity= :quantity, price= :price WHERE id_product=:id_products;";

=======
    $sql = "UPDATE products SET name = :name, quantity= :quantity, price= :price WHERE id_products=:id_products;";
//
>>>>>>> parent of 570ec57... update add file
    $stmtnt = $bdd->prepare($sql);
    $stmtnt->bindValue(":name",$name,PDO::PARAM_STR);
    $stmtnt->bindValue(":quantity",$quantity,PDO::PARAM_INT);
    $stmtnt->bindValue(":price",$price,PDO::PARAM_INT);
    $stmtnt->bindValue(":id_products",$id_products,PDO::PARAM_INT);
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

