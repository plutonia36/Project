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
    //
    /* 
    $id_products='';
    $name='kola';
    $quantity=22;
    $price=11; 
    */

    $sql=("INSERT INTO products (id_products,name,quantity,price) VALUES (':id_products',':name',':quantity',':price');");
    //permier erreur : $sql="INSERT INTO `products` (`id_products`,`name`,`quantity`,`price`) VALUES (NULL,:name,:quantity,:price);";
    $result = $bdd->query($sql);
    //parce qu'il a des entree d'utilisateur on prepare notre requete sql ;
   /*  
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(":name",$name,PDO::PARAM_STR);
    $stmt->bindValue(":quantity",$age,PDO::PARAM_INT);
    $stmt->bindValue(":price",$age,PDO::PARAM_INT);
    $stmt->execute(); 
    */
    var_dump($result);
    //if($un autre variable)
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

//   un autre variable->closeCursor();
$reponse->closeCursor();
   

echo json_encode($response);

die();
