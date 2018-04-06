<?php

/*
 * configuration
 */
ini_set('display_errors', 'on');
error_reporting(E_ALL);


$root= $_SERVER['DOCUMENT_ROOT'];
$host= $_SERVER['HTTP_HOST'];

/*
 *
 */
define('HOST','http//' . $host . '/P4_Test/');
define('ROOT',$root . 'P4_Test/');
/*
 * Constant for absolute link
 */
define('CONTROLLER', ROOT .'controller/');
define('VIEW',ROOT . 'view/');
define('MODEL','http'ROOT . 'model/');
define('LIB', ROOT .'lib/')

define('ASSETS','http' . $host . 'assets/');


