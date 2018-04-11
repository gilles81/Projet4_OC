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
            $myView->build(array( 'chapters'=> $chapters));


    }

    public function showPost()
    {
/**
 * Todo
 *  get one post and goto to view
 */



        if(isset($_GET['idPost'])) {
            $idPost = $_GET['idPost'];
            $manager = new PostManager();
            $chapter= $manager->findOne($idPost);

            $myView = new View('post');
            $myView->build( array('chapter'=> $chapter));
           
        }else{
            echo 'Cet Article m\'existe pas encore';

        }

    }

    public function showAbout()
    {
        /**
         * Todo
         *
         */


        $myView = new View('about');
        $myView->build(array ());

    }

    public function showContact()
    {
        /**
         * Todo
         *
         */

        $myView = new View('contact');
        $myView->build(array ());

    }

}