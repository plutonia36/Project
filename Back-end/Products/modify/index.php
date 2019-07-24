<?php

require "../../libs/cors.php";
cors();
require "../../libs/connexiondb.php";

header('Content-Type: application/json');



$reponse = [
    "error"         => true, 
    "error_message" => "Uknown error", 
    "data"          => "" 
];


$sql = "SELECT * FROM students LIMIT 1;";
$stmtnt = $bdd->prepare($sql);
$stmtnt->execute();



if($stmtnt && $stmtnt->rowCount() == 1)
{
    $ligne = $stmtnt->fetch();
    $reponse["data"] = $ligne["first_name"]." ".$ligne["last_name"];
    $reponse["error"] = false;
    $reponse["error_message"] = "";
}
else
{
    $reponse["error_message"] = "Pas de données";
}


echo json_encode($reponse);

die();