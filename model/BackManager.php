<?php
/**
 * class BackManager
 *
 *  define common function for other manager
 *
 *
 */

class BackManager extends lib
{
    private  $bdd;


    /**
     *
     * Public function bddAssign() {
     *
     * Connection to BDD
     *
     * @return PDO
     *
     */

    Public function bddAssign() {
        try {
            return $this->bdd = new PDO("mysql:host=".BDDDIR.";dbname=".BLOGNAME.";charset=utf8", USERNAME, PSWDB);
        }catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }
}