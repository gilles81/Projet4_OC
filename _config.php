<?php

/**
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
        define('HOST','http://' . $host . '/Projet4/');
        define('ROOT',$root .'/Projet4/');


        /**
         * Constant for absolute link
         */
        define('CONTROLLER', ROOT.'controller/');
        define('VIEW',ROOT . 'view/');
        define('MODEL',ROOT . 'model/');
        define('LIB', ROOT .'lib/');
        define('ENTITIES', ROOT .'model/entities/');

        define('ASSETS', HOST . 'assets/');

        define('BLOGNAME','blogecrivain');
        define('BDDDIR','localhost');
        define('USERNAME','root');
        define('PSWDB','');
/**
        define('BLOGNAME','db736607164');
        define('BDDDIR','/db736607164.db.1and1.com');
        define('USERNAME','dbo736607164');
        define('PSWDB','JForteroche1234.');
      **/


    }
    Public static function autoload($class)
    {

        if (file_exists(MODEL.$class.'.php'))
        {
            include_once(MODEL.$class.'.php');
        } elseif (file_exists (ENTITIES.$class.'.php'))
        {
            include_once(ENTITIES.$class.'.php');
        } elseif (file_exists (CONTROLLER.$class.'.php'))
        {
            include_once(CONTROLLER.$class.'.php');
        } elseif (file_exists(LIB.$class.'.php'))
        {
            include_once(LIB.$class.'.php');
        };

    }
}





