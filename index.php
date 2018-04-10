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

if ($request == "home.html")
{
    include_once(CONTROLLER.'PostController.php');
}else{
    echo 'Erreur 404 - La page ' . $request . ' est inaccessible';

}

$routeur = new Routeur($request);
$routeur ->findController();