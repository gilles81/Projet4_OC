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
     /*get all posts in database*/
    $manager = new PostManager();
    $Posts = $manager->findAll();

    $myView = new View('home.php');
    $myView->build();
    }

    public function showPost()
    {
/*
 * Todo
 *  get one post and goto to view
 */

    }

}