<?php

//importer les fichiers importants
//une function qu'il permet à faciliter la connection entre front et back
require "../../libs/cors.php";
//executer cettre function
cors();
//connection entre PHP et MYSQL
require "../../libs/connexiondb.php";
//Afficher cette fichier au form json
header('Content-Type: application/json');
//Json par defaut 
$response = [
    "error"             => true,
    "error_message"     => "Erreur parametres",
    //"products"          => NULL,
    "status"            => "non"
];

//verifier si les params n'exist pas
if(!isset($_REQUEST["name"]) ||!isset($_REQUEST["quantity"]) ||!isset($_REQUEST["price"]))
{
    $response["error_message"] = "pas de parametre : name , quantity ,price  ";
    echo json_encode($response);
    die();
}
//verifier si les params ne sont pas definie
elseif(empty($_REQUEST["name"])||empty($_REQUEST["quantity"]) ||  empty($_REQUEST["price"]))
{
    $response["error_message"] = "Empty valeurs: name , quantity ,price";
    echo json_encode($response);
    die();
}
//verifier si les params ont des valeurs correct
elseif(!is_numeric($_REQUEST["quantity"]) || !is_numeric($_REQUEST["price"]))
{
    $response["error_message"] = "Wrong type of values :  quantity ,price";
    echo json_encode($response);
    die();
}
//on utilise $_REQUEST parce qu'il accept les deux POST et GET
//recuperer les parametre de front-end

        
        $name=$_REQUEST["name"];
        $quantity=$_REQUEST["quantity"];
        $price=$_REQUEST["price"];
        //on fait une requete sql pour afficher les valeurs dans noter base de donnee qui 
        //correspend à ces parametres
        $sql="SELECT * FROM products  WHERE name=:name AND quantity=:quantity AND price=:price;";
        $stmtnt = $bdd->prepare($sql);
        $stmtnt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmtnt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $stmtnt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmtnt->execute();
        //echo $stmtnt->rowCount();
        //si la requete est correct ET s'il y a de resultat de notre base de donnees
        if($stmtnt && $stmtnt->rowCount() > 0)
        {   
            //- on affiche une erreur parce que les params sont deja existes
            $response["error"] = true;
            $response["error_message"] = "Les valeurs sont deja existes";
            $response["status"] = "non";
            
         }else
         {
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
           
         }

echo json_encode($response); 
//echo $_SERVER["QUERY_STRING"];