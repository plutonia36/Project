<?php
/**
 * username
 * password
 * date_of_sign_up
 * email
 * gender
 */
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
if(!isset($_REQUEST["username"]) ||!isset($_REQUEST["password"]) )
{
    $response["error_message"] = "pas de parametre";
    echo json_encode($response);
    die();
}
//verifier si les params ne sont pas definie
elseif( empty($_REQUEST["username"]) || empty($_REQUEST["password"]))
)
{
    $response["error_message"] = "Empty valeurs";
    echo json_encode($response);
    die();
}

//on utilise $_REQUEST parce qu'il accept les deux POST et GET
//recuperer les parametre de front-end

        
        $username=$_REQUEST["username"];
        $password=$_REQUEST["password"];
        //$date_of_sign_up=$_REQUEST["date_of_sign_up"];
        //$price=$_REQUEST["gender"];
        //$price=$_REQUEST["email"];

        //on fait une requete sql pour afficher les valeurs dans noter base de donnee qui 
        //correspend à ces parametres
        $sql="SELECT * FROM utilisateurs  WHERE username=:username AND password=:password ;";
        $stmtnt = $bdd->prepare($sql);
        $stmtnt->bindValue(":username", $name, PDO::PARAM_STR);
        $stmtnt->bindValue(":password", $quantity, PDO::PARAM_INT);

        $stmtnt->execute();
        //echo $stmtnt->rowCount();
        //si la requete est correct ET s'il y a de resultat de notre base de donnees
        if(!$stmtnt) 
        {   

            //- on affiche une erreur parce que les params sont deja existes
            $response["error"] = true;
            $response["error_message"] = "Erreur requete";
            $response["status"] = "non";
            
         }elseif( $stmtnt->rowCount() == 0)
         {
            $response["error"] = true;
            $response["error_message"] = "l'utilisateur n'exist pas";
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