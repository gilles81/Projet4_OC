<?php
/**
 * Class FrontOfficeHome
 *
 * used to show the Post.php on home page
 */
class PostController
{
    public function showPosts()
        {
            /*get all posts in database*/
            $manager = new PostManager();
            $chapters= $manager->findAll();

            $myView = new View('home');
            $myView->build($chapters);
    }

    public function showPost()
    {
/**
 * Todo
 *  get one post and goto to view
 */

    }

}