<?php

$host    = 'localhost';
$dbname  = 'project';
$charset = 'utf8';
$dbuser  = 'root';
$dbpwd   = '';


define("DEBUG", true);

if(!DEBUG)
{
    error_reporting(0);
}


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