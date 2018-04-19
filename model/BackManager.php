<?php
/**
 * class commentManager
 *
 *  Get comment
 */

class BackManager
{
    private  $bdd;

    Public function bddAssign() {
        return $this->bdd = new PDO("mysql:host=localhost;dbname=blogEcrivain;charset=utf8","root","");
    }
}