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

    /**
     *
     *  public function findAll()
     *
     * Get all Posts in database in an array ordored ready to display
     *
     * @return array
     */
    public function findAll()
    {
        $bdd = $this->bdd;
        /**
         * model access
         * */
        $query = "SELECT * FROM Posts ORDER BY Position";
        $req = $bdd->prepare($query);
        $req->execute();
        $Posts=  array();

        while ($row = $req-> fetch(PDO::FETCH_ASSOC))
        {
            $post = new Post();
            $post->setPostId($row['PostId']);
            $post->setAuthor($row['Author']);
            $post->setCreationDate($row['CreationDate']);
            $post->setModificationDate($row['ModificationDate']);
            $post->setTitle($row['Title']);
            $post->setContent(( ($row['PostContent'])));
            $post->setPosition(( ($row['Position'])));
            $Posts[] = $post;
        };
        return $Posts;
    }

    /**
     *
     *   public function findOne($id)
     *
     * Get a Post thanks to  Post id  from database  .
     *
     *
     * @param $id
     * @return Post
     */
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
        $post->setPosition(( ($row['Position'])));

        return $post;
    }

    /**
     *
     *  public function findComTopic($id)
     *
     *  Get a Com from database thank to id .
     *This function return  an object with data from Topic Com and answer of this topic
     *
     * @param $id
     * @return Topic
     */
    public function findCom($id)
    {
        $bdd = $this->bdd;
        $query = "SELECT * FROM comments WHERE CommentId =:id";

        $req = $bdd->prepare($query);
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
        $row= $req->fetch(PDO::FETCH_ASSOC);

        $com = new Topic();
        $com->setCommentId($row['CommentId']);
        $com->setPostId($row['PostId']);
        $com->setAuthor($row['Author']);
        $com->setCreationDate($row['CreationDate']);
        $com->setModerationDate($row['ModificationDate']);
        $com->setCommentContent($row['CommentContent']);
        //$com->setAnswers($row['Answ']);
        //$com->setAnswersID($row['AnswerId']);

        return $com;
    }




//* test ajout des reponses


    public function findComs($id) //topics
    {

        $bdd = $this->bdd;

        $query = "SELECT * FROM comments WHERE PostId =:id";

        $req = $bdd->prepare($query);
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();

        $coms[]=array();
        while ($row = $req-> fetch(PDO::FETCH_ASSOC)){
            if (is_null(($row['AnswerId']))){
                $com = new Topic();
                $com->setCommentId($row['CommentId']);
                $com->setPostId($row['PostId']);
                $com->setAuthor($row['Author']);
                $com->setCreationDate($row['CreationDate']);
                $com->setModerationDate($row['ModificationDate']);
                $com->setCommentContent($row['CommentContent']);
                //$com->setAnswers($row['Answ']);
                $com->setAnswerId($row['AnswerId']);

                $coms[] = $com;
            }

        }


        $comsAndPostId=array('id'=>$id,'coms'=>$coms);

        return $comsAndPostId;
    }

    /**
     *
     *  public function findAnswers($id, $comment)
     *
     * Get answer  tha
     *
     * @param $id
     * @param $comment
     * @return array
     */
    public function findAnswersTopic($idTopic)
    {
        $bdd = $this->bdd;

        $query = "SELECT * FROM comments WHERE AnswerId =$idTopic";

        $req = $bdd->prepare($query);
        $req->bindValue('id', $idTopic, PDO::PARAM_INT);
        $req->execute();

        $answs =  array();

        while ($row = $req-> fetch(PDO::FETCH_ASSOC)){

            $answ = new Reply();
            //$answ->setCommentId($row['CommentId']);
            //$answ->setPostId($row['PostId']);
            //$answ->setAuthor($commentTopic->getAuthor());
            $answ->setAuthor($row['Author']);
            //$answ->setModerationDate($row['ModificationDate']);
           // $answ->setCreationDate($row['CreationDate']);
            //$answ->setCommentContent('NULL');
            $answ->setAnswer($row['Answ']);
            $answ->setAnswerId($row['AnswerId']);

            $answs[] = $answ;
        }
   return $answs;
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
        $post->setPosition(( ($row['Position'])));

        return $post;
    }


    public function addComment($values)
    {
            $bdd = $this->bdd;
            $query = "INSERT INTO comments (CommentId , PostId , Author,CreationDate,ModificationDate,CommentContent,Answ) VALUES (NULL, :Postid ,:Author, NOW(), NOW(),:CommentContent,'');";
            $req = $bdd->prepare($query);


            $req->bindValue(':Postid', $values['PostId'], PDO::PARAM_INT);
            $req->bindValue(':Author', $values['Author'], PDO::PARAM_STR);
            $req->bindValue(':CommentContent', $values['Topic'], PDO::PARAM_STR);

            $req->execute();

    }


    public function addAnswer($values)
    {
        $bdd = $this->bdd;
        $query = "INSERT INTO comments (CommentId , PostId , Author,CreationDate,ModificationDate,CommentContent,Answ,AnswerId) VALUES (NULL, :Postid ,:Author, NOW(), NOW(),:CommentContent,:Answ,:AnswerId);";
        $req = $bdd->prepare($query);

        //
        $req->bindValue(':Postid',  $values['PostId'], PDO::PARAM_INT);
        //
        $req->bindValue(':CommentContent', 'NA', PDO::PARAM_STR);
        //
        $req->bindValue(':Author', $values['Author'], PDO::PARAM_STR);
        $req->bindValue(':AnswerId', $values['AnswerId'], PDO::PARAM_INT);
        $req->bindValue(':Answ', $values['Answ'], PDO::PARAM_STR);

        $req->execute();
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
        $query = "INSERT INTO posts (Postid , Author,CreationDate,ModificationDate,Title,PostContent,Position) VALUES ( NULL ,:Author, NOW(), NOW(),:Title,:PostContent,:PostPosition);";
        $req = $bdd->prepare($query);

        $req->bindValue(':Title',$post->getTitle(),PDO::PARAM_STR);
        $req->bindValue(':Author','Jean Forteroche',PDO::PARAM_STR);
        $req->bindValue(':PostContent',$post->getContent(),PDO::PARAM_STR);
        $req->bindValue(':PostPosition',$post->getPosition(),PDO::PARAM_INT);
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

        $req = $bdd->prepare('UPDATE posts SET PostContent = :Content, Title = :Title , modificationDate=NOW(),Position= :PostPosition WHERE PostId = :PostId');

        $req->bindValue(':PostId',$post->getPostId(),PDO::PARAM_INT);
        $req->bindValue(':Content',$post->getContent() ,PDO::PARAM_STR);
        $req->bindValue(':Title',$post->getTitle(),PDO::PARAM_STR);
        $req->bindValue(':PostPosition',$post->getPosition(),PDO::PARAM_INT);

        $req->execute();
    }
}