<?php
/**
 * Class FrontOfficeHome
 *
 * used to show the Post.php on home page
 */
class PostsController
{
    public function showPosts()
    {
            /*get all posts in database*/
            $manager = new PostManager();
            $chapters= $manager->findAll();
            $comments=null;
            $myView = new View('home');
            $myView->build( array('chapters'=> $chapters ,'comments'=>null,'HOST'=>HOST));
    }

}