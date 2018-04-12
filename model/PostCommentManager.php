<?php
/**
 * class commentManager
 *
 *  Get comment
 */

class PostCommentManager
{

    private  $bdd;

    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=localhost;dbname=blogEcrivain;charset=utf8","root","");
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

}