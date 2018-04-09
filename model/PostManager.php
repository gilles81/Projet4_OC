<?php
/**
 *
 *Class CommentManager
 *
 *
 */

class PostManager
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=localhost;dbname=blogEcrivain;charset=utf8","root","");
    }

    public function findAll()
    {
        $query = "SELECT * FROM Posts";
        $bdd = new PDO();
        $req = $bdd->prepare($query);
        $req->execute();
        while ($row = $req-> fetch(PDO::FETCH_ASSOC)){

            $post = new Post;
            $post->setPostId($row['postId']);
            $post->setPostId($row['Author']);
            $post->setPostId($row['CreationDate']);
            $post->setPostId($row['ModificationDate']);
            $post->setPostId($row['Title']);
            $post->setPostId($row['PostContent']);

            $posts[] = $post;
        };
    return $posts;
    }
}