<?php
/*session start*/


/**
 * Front controller
 *
 * -Application.php initialisation
 * -Class autoload
 * - find controller for a client request
 */

include_once('./_config.php');
/* initialisation des fichiers TWIG */
/*require_once 'vendor/twig/twig/lib/Twig/autoloader.php';*/
require_once 'vendor/autoload.php';
/** Autoload */
MyAutoload::start();

$request = $_GET['r'];

$requestVisitor = "home.html";
$requestAdmin = "admin.html";

if ($request == "")  {
    $request = "home.html";
}else {
    $request = $_GET['r'] ;

}
// Routeur
$routeur = new Routeur($request);
$routeur ->findController();
