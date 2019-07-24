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
    if(isset($_GET["name"], $_GET["quantity"], $_GET["price"])){

        $name=$_GET["name"];
        $quantity=$_GET["quantity"];
        $price=$_GET["price"];


        $sql="INSERT INTO products (name,quantity,price) VALUES (:name,:quantity,:price);";
        $stmtnt = $bdd->prepare($sql);
        $stmtnt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmtnt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $stmtnt->bindValue(":price", $price, PDO::PARAM_INT);
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
        $response["error_message"] = "ERROR QUERY";
    }
       
    
    echo json_encode($response);
    
    die();

    }


