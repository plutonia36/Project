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
if(isset($_REQUEST['id_products']))
{
    $id_product = $_REQUEST['id_products'];
    
    $sql = "SELECT `id_products`,`quantity`,`price` FROM products WHERE id_products= :id_products";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(":id_products",$id_product,PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result)
    {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $response["products"] = $data;
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