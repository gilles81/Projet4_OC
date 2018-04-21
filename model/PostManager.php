<?php
/**
 *
 *Class PostManager
 *
 *
 */

class PostManager extends BackManager
{
    private  $bdd;


    public function __construct()
    {
        $this->bdd = parent ::bddAssign();
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

        $Posts[]= null;

        while ($row = $req-> fetch(PDO::FETCH_ASSOC)){

            $post = new Post();
            $post->setPostId($row['PostId']);
            $post->setAuthor($row['Author']);
            $post->setCreationDate($row['CreationDate']);
            $post->setModificationDate($row['ModificationDate']);
            $post->setTitle($row['Title']);
            $post->setContent(( ($row['PostContent'])));

            $Posts[] = $post;
        };
        return $Posts;
    }

    public function findOne($id)
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

    public function findComs($id)
    {

        $bdd = $this->bdd;

        $query = "SELECT * FROM comments WHERE PostId =:id";

        $req = $bdd->prepare($query);
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
        $coms[]=null;


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
        $comsAndPostId=array('id'=>$id,'coms'=>$coms);
        return $comsAndPostId;
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

    public function addPost($post)
    {
        $bdd = $this->bdd;
        $query = "INSERT INTO posts (Postid , Author,CreationDate,ModificationDate,Title,PostContent) VALUES ( NULL ,:Author, NOW(), NOW(),:Title,:PostContent);";
        $req = $bdd->prepare($query);

        $req->bindValue(':Title',$post->getTitle(),PDO::PARAM_STR);
        $req->bindValue(':Author','Jean Forteroche',PDO::PARAM_STR);
        $req->bindValue(':PostContent',$post->getContent(),PDO::PARAM_STR);

        $req -> execute();



    }


    public function removePost($PostId)
    {
        $bdd = $this->bdd;
        $req = $bdd->exec("DELETE FROM `posts` WHERE `PostId` = $PostId");

        if (!$req) {
            echo 'Erreur a la suppression du chapitre';
        }
    }

    public function updatePost($post)
    {
        $bdd = $this->bdd;

        $req = $bdd->prepare('UPDATE posts SET PostContent = :Content, Title = :Title , modificationDate=NOW() WHERE PostId = :PostId');

        $req->bindValue(':PostId',$post->getPostId(),PDO::PARAM_INT);
        $req->bindValue(':Content',$post->getContent() ,PDO::PARAM_STR);
        $req->bindValue(':Title',$post->getTitle(),PDO::PARAM_STR);





        $req->execute();
    }



}