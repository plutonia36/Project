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
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(":id_product",$id_product,PDO::PARAM_INT);
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
    else{
     $response["products"] = 'VIDE';
     $response["error_message"] = "Erreur : parametre 'id_product' manquant";
     $response["error"] = TRUE;
}