<?php

require "../../libs/cors.php";
cors();
require "../../libs/connexiondb.php";


header('Content-Type: application/json');

$response = [
    "error"             => true,
    "error_message"     => "Erreur parametres",
    //"products"          => NULL,
    "status"            => "non"
];
    if(isset($_REQUEST["name"], $_REQUEST["quantity"], $_REQUEST["price"]))
    {

        $name=$_REQUEST["name"];
        $quantity=$_REQUEST["quantity"];
        $price=$_REQUEST["price"];


        $sql="INSERT INTO products (name,quantity,price) VALUES (:name,:quantity,:price);";

        $stmtnt = $bdd->prepare($sql);
        $stmtnt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmtnt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $stmtnt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmtnt->execute();

        if($stmtnt)
        {   
        
            //$data = "ok";
            $response["error"] = false;
            $response["error_message"] = "";
            $response["status"] = "ok";
         }else
         {
            $response["error"] = true;
            $response["error_message"] = "erreur requete sql";
            $response["status"] = "non";
         }
         echo json_encode($response);
}else
{
            $response["error"] = true;
            $response["error_message"] = "pas de parametre";
            $response["status"] = "no";
            echo json_encode($response); 
}