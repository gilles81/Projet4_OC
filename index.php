<?php
/**
 * Front controller
 *
 * -Application initialisation
 * -Class autoload
 * - find controller for a client request
 */
include_once('_config.php');
MyAutoload::start();

$request = $_GET['r'];

if ($request == "home")
{
    include_once(CONTROLLER .'FrontOfficeHome.php');
}else{
    echo 'Erreur 404';
}

$routeur = new Routeur($request);
$routeur ->findController();