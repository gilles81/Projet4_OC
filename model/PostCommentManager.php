<?php
/**
 * class commentManager
 *
 *  Get comment
 */

class PostCommentManager extends BackManager
{
   private  $bdd;

    public function __construct()
    {
        $this->bdd = parent ::bddAssign();
    }

    public function findComs($id)
    {
        $bdd = $this->bdd;

        $query = "SELECT * FROM comments WHERE PostId =:id";

        $req = $bdd->prepare($query);
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();

        while ($row = $req-> fetch(PDO::FETCH_ASSOC)){
            $com = new Comment();
            $com->setCommentId($row['CommentId']);
            $com->setPostId($row['PostId']);
            $com->setAuthor($row['Author']);
            $com->setCreationDate($row['CreationDate']);
            $com->setModerationDate($row['ModificationDate']);
            $com->setCommentContent($row['CommentContent']);

            $coms[] = $com;
        };
        return $coms;
    }

    public function findPost($id)
    {
        /**
         * model access
         * */


        //$bdd = $this->bdd;
        $bdd = $this->bdd;
        $query = "SELECT * FROM Posts WHERE PostId =:id";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $id , PDO::PARAM_INT);
        $req->execute();
        $row= $req->fetch(PDO::FETCH_ASSOC);

        $post = new Post();
        $post->setPostId($row['PostId']);
        $post->setAuthor($row['Author']);
        $post->setCreationDate($row['CreationDate']);
        $post->setModificationDate($row['ModificationDate']);
        $post->setTitle($row['Title']);
        $post->setContent($row['PostContent']);

        return $post;

    }


    public function addComment($values)
    {
        $bdd = $this->bdd;
        $query = "INSERT INTO comments (CommentId , Postid , Author,CreationDate,ModificationDate,CommentContent) VALUES (NULL , :Postid ,:Author, NOW(), NOW(),:CommentContent);";
        $req = $bdd->prepare($query);

        $req->bindValue(':Postid',$values['PostId'],PDO::PARAM_INT);
        $req->bindValue(':Author',$values['Author'],PDO::PARAM_STR);
        $req->bindValue(':CommentContent',$values['Comment'],PDO::PARAM_STR);

        $req -> execute();
    }


    public function remove($ComId)
    {
        $bdd = $this->bdd;
        $req = $bdd->exec("DELETE FROM `comments` WHERE `CommentId` = $ComId");

        if (!$req) {
            echo 'Erreur a la suppression du commentaire';
        }
    }



}