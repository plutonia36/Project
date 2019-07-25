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
 if(isset($_REQUEST['id_products']))
{  
    $id_products = $_REQUEST['id_products'];  

    $sql = "SELECT `id_products`,name,`quantity`,`price` FROM products WHERE id_products= :id_products";
    //$sql = "SELECT `nom`,`age` FROM noms WHERE id_nom=11";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(":id_products",$id_products,PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result)
    {
        $data = $stmt->fetch();
        
            $json["id_products"]= $data["id_products"];
            $json["name"]= $data["name"];
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
    

    

    
     
 }
  else{
    $response["products"] = 'VIDE';
    $response["error_message"] = "Erreur : parametre 'id_products' manquant";
    $response["error"] = TRUE;
}
echo json_encode($response);
 

die();
