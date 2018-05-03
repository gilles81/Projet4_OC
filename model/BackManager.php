<?php
/**
 * class commentManager
 *
 *  Get comment
 */

class BackManager extends lib
{
    private  $bdd;
    Public function bddAssign() {
        try {
            return $this->bdd = new PDO("mysql:host=".BDDDIR.";dbname=".BLOGNAME.";charset=utf8", "root", "");
        }catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }
}