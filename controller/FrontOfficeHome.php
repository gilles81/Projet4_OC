<?php
/**
 * Class Post
 *
 * used to show the Post on home page
 */
class FrontOfficeHome
{
    public function showPosts()
    {
/*
 * Todo
 * recuperation de données via un manager
 *
 */

    $myView = new View('home.php');
    $myView->build();

    }

    public function showPost()
    {
/*
 * Todo
 */
    }

}