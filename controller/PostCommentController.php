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
            $myView->build( array('chapters'=> $chapter ,'comments'=>$comments,'HOST'=>HOST));

        }else{
            echo 'Cet Article m\'existe pas encore';

        }

    }

    public function createComment()
    {
        if (isset($_GET['postId'])){
            $Author = $_POST['author'];
            $Comment = $_POST['comment'];
            $values= array( 'Author'=> $Author, 'Comment'=> $Comment , 'PostId' => $_GET['postId'] );

            $manager = new PostCommentManager('blogecrivain' , 'root' ,'');
            $manager->addComment($values);

            $myView= new View();
           $myView->redirect('post.html?idPost='.$_GET['postId']);

        }else{

            echo 'Probleme avec l\'id du post';
        }
    }


    public function removeComment()
    {

        if (isset($_GET['comId']) AND isset($_GET['postId']) ){

            $manager = new PostCommentManager();
            $manager->remove($_GET['comId']);

            $myView= new View('post');
            $myView->redirect('post.html?idPost='.$_GET['postId']);

        }else{

            echo 'Erreur  de suppression : Ce commentaire est introuvable ';
        }
    }




protected function updateComment($id)
{
    if(isset($_GET['idPost'])) {

        $requete = $this->dao->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');

        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':contenu', $news->contenu());
        $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);
    }else{
        echo 'Cet Article m\'existe pas encore';

    }
    /*




    $requete->execute();
    */
}

}