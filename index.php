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

$routeur = new Routeur($request);
$routeur ->findController();
