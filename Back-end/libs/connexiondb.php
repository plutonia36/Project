<?php

/*
    Créer une constate PHP de type boolean appelée DEBUG et permettant d'activer ou non les erreurs
    (voir error_reporting et getMessage)
    NB: en local (sur son pc) on mettra le paramètre à true pour afficher les erreurs.
    En production (sur ovh, ou un autre hébergeur...), on mettra le paramètre à false
    pour ne pas voir les erreurs.
*/

/*Informations de connexion*/
$host    = 'localhost';
$dbname  = 'projects';
$charset = 'utf8';
$dbuser  = 'root';
$dbpwd   = '';


define("DEBUG", false);

if(!DEBUG)
{
    /* Cacher les erreurs */
    error_reporting(0);
}

/*echo $aaaaaaaa;*/

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $dbuser, $dbpwd);
} catch (Exception $e) {
    if (DEBUG) 
    {
        die('Erreur : ' . $e->getMessage());
    }
    else 
    {
        die('Erreur avec la BD conatacter le support technique...');
    }
}