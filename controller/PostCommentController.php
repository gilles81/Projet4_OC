<?php
/**
 * Class FrontOfficeHome
 *
 * used to show a post and its comments
 */
class PostCommentController
{
    public function showPost()
    {
    /**
     * Todo
     *  get one post and goto to view
     */
        if(isset($_GET['idPost'])) {
            $idPost = $_GET['idPost'];
            $manager = new PostCommentManager();
            $chapter= $manager->findPost($idPost);
            $comments = $manager->findComs($idPost);

            $myView = new View('post');
            $myView->build( array('chapter'=> $chapter, 'comments'=> $comments ));


        }else{
            echo 'Cet Article m\'existe pas encore';

        }

    }
}