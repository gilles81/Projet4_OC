<?php

/*
 * configuration
 */
ini_set('display_errors', 'on');
error_reporting(E_ALL);

class MyAutoload
{
    public static function start()
    {
        spl_autoload(array(__CLASS,'autoload'));
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

    }

    Public static function autoload($class)
    {
        if(file_exists(MODEL.$class.'.php'))
        {
            include_once(MODEL.$class.'.php');
        }elseif (file_exists(CONTROLLER.$class.'.php'))
        {
            include_once(CONTROLLER.$class.'.php');
        }elseif (file_exists(LIB.$class.'.php'))
        {
            include_once(LIB.$class.'.php');
        };
    }
}





