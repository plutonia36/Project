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
if(isset($_REQUEST['id_product']))
{ 
    $id_product = $_REQUEST['id_product'];

    $sql = "SELECT `id_product`,`quantity`,`price` FROM products WHERE id_product= :id_product";
    //$sql = "SELECT `nom`,`age` FROM noms WHERE id_nom=11";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(":id_product",$id_product,PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result)
    {
        $data = $stmt->fetch();
        
            $json["id_product"]= $data["id_product"];
            $json["quantity"]= $data["quantity"];
            $json["price"]= $data["price"];
       
          
        $response["products"] = $json ;
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
     
 }
 else{
    $response["products"] = 'VIDE';
    $response["error_message"] = "Erreur : parametre 'id_product' manquant";
    $response["error"] = TRUE;
}

