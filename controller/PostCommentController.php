<?php
/**
 * Class FrontOfficeHome
 *
 * used to show a post and its comments
 */
class PostCommentController
{
    /**
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


    $requete->execute();

}
*/
}