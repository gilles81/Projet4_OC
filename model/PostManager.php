<?php
/**
 *
 *Class CommentManager
 *
 *
 */

class PostManager
{
    private  $bdd;

    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=localhost;dbname=blogEcrivain;charset=utf8","root","");
    }

    public function findAll()
    {
        $bdd = $this->bdd;
        /**
         * model access
         * */
        $query = "SELECT * FROM Posts";

        $req = $bdd->prepare($query);
        $req->execute();

        while ($row = $req-> fetch(PDO::FETCH_ASSOC)){

            $post = new Post();
            $post->setPostId($row['PostId']);
            $post->setAuthor($row['Author']);
            $post->setCreationDate($row['CreationDate']);
            $post->setModificationDate($row['ModificationDate']);
            $post->setTitle($row['Title']);
            $post->setContent($row['PostContent']);

            $Posts[] = $post;
        };
        return $Posts;
    }
}