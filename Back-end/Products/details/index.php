<?php



require "../../libs/cors.php";
cors();

require "../../libs/connexiondb.php";



header('Content-Type: application/json');

//
$response = [
    "error"         => true,
    "error_message" => "Uknown Error",
    "products"          => NULL
];
 if(!isset($_REQUEST['id_product']))
{ 
    $response["error_message"] = "id_product parametre demandé";
    echo json_encode($response);
    die();
}
 if(empty($_REQUEST['id_product']))
{ 
    $response["error_message"] = "id_product parametre est vide !";
    echo json_encode($response);
    die();
}
    $id_products = $_REQUEST['id_product'];  

    $sql = "SELECT `id_products`,name,`quantity`,`price` FROM products WHERE id_products= :id_products";
    //$sql = "SELECT `nom`,`age` FROM noms WHERE id_nom=11";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(":id_products",$id_products,PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result && $stmt->rowCount() > 0)
    {
        $data = $stmt->fetch();
        
            $json["id_product"]= $data["id_products"];
            $json["name"]= $data["name"];
            $json["quantity"]= $data["quantity"];
            $json["price"]= $data["price"];
       
          
        $response["product"] = $json ;
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
