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
        spl_autoload_register(array(__CLASS__,'autoload'));

        $root= $_SERVER['DOCUMENT_ROOT'];
        $host= $_SERVER['HTTP_HOST'];

        /**
         *
         */
        define('HOST','http//' . $host . '/Projet4/');
        define('ROOT',$root .'/Projet4/');
        /**
         * Constant for absolute link
         */
        define('CONTROLLER', ROOT.'controller/');
        define('VIEW',ROOT . 'view/');
        define('MODEL',ROOT . 'model/');
        define('LIB', ROOT .'lib/');

        define('ASSETS','http' . $host . 'assets/');




    }
    Public static function autoload($class)
    {

        echo LIB.$class.'.php';

        if (file_exists(MODEL.$class.'.php'))
        {  echo '1';
            include_once(MODEL.$class.'.php');
        } elseif (file_exists (CONTROLLER.$class.'.php'))
        {  echo '2';
            include_once(CONTROLLER.$class.'.php');
        } elseif (file_exists(LIB.$class.'.php'))
        {
            include_once(LIB.$class.'.php');

        };

    }
}





