<?php
/**
 *
 *Class PostManager
 *
 * define Manager for  chapters and comments
 *
 *
 */

class PostManager extends BackManager
{
    private  $bdd;

    /**
     * PostManager constructor.
     *
     * call static function in backmanager Liraby for connection to BDD
     *
     */
    public function __construct()
    {
        $this->bdd = parent ::bddAssign();
    }

    /**
     *
     *   findAll()
     *
     * Get all Posts (chapters) in database in an array ordoned ready to display
     *
     *

     * @return array
     */

    public function findAll()
    {
        $bdd = $this->bdd;
        /**
         * model access
         * */
        $query = "SELECT * FROM posts ORDER BY Position";
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
        }
        return $Posts;
    }


    /**
     *  findComTopic
     *
     *  Get a Com from database thank to id .
     * This function return  an object with data from Topic Com and answer of this topic
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
        $com->setModeration($row['Warning']);
        //$com->setAnswers($row['Answ']);
        //$com->setAnswersID($row['AnswerId']);

        return $com;
    }



    /**
     *
     * findComs
     *
     * find all comments in database thank to an $id
     * return an associative array of commentaries  object and id  fields
     *
     * @param $id
     * @return array
     */


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
                $com->setAnswerId($row['AnswerId']);
                $com->setModeration($row['Warning']);

                $coms[] = $com;
            }
        }
        $comsAndPostId=array('id'=>$id,'coms'=>$coms);

        return $comsAndPostId;
    }

    /**
     *  findAnswersTopic
     *
     *  Get comments and replies from database
     *
     *   return an array of com's reply

     * @param $idTopic
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
            $answ->setId($row['CommentId']);
            $answ->setAuthor($row['Author']);
            $answ->setCreationDate($row['CreationDate']);
            $answ->setAnswer($row['Answ']);
            $answ->setAnswerId($row['AnswerId']);
            $answ->setModeration($row['Warning']);

            $answs[] = $answ;
        }
   return $answs;
    }

    /**
     *  findPost
     *
     * Get a post from database
     * return an objetc representavive of a post
     *
     * @param $id
     * @return Post
     */

    public function findPost($id)
    {
        /**
         * model access
         * */
        $bdd = $this->bdd;
        $query = "SELECT * FROM posts WHERE PostId =:id";

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
     *  addComment
     *
     * Add a comment in database thank to an associative array in parameters .
     * array in parameters define value for database imputs columns
     *
     * @param $values
     *
     */
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

    /**
     *  addAnswer
     *
     * add a reply to a comment thank to an associative array in parameters .
     * array in parameters define value for database imputs columns.
     *
     * @param $values
     */
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

    /**
     *
     *  remove
     *
     * delete a comment into database .
     *
     * In database comments and reply 's comments and chapters are define with an delette Cascade function.
     *
     *
     * @param $ComId
     */
    public function remove($ComId)
    {
        $bdd = $this->bdd;
        $req = $bdd->exec("DELETE FROM `comments` WHERE `CommentId` = $ComId");

        if (!$req) {
            echo 'Erreur a la suppression du commentaire';
        }
    }

    /**
     * addPost
     *
     * @param Post $post
     *
     * add a post (chapters) in database.
     *
     *
     */
    public function addPost(Post $post)
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

    /**
     *  removePost
     *
     * remove a post (chapters) in database.
     *
     * when a post is deleted , all children information are deleted (coms and com reply) . It's due to a delete cascade
     * configuration in database.
     *
     * @param $PostId
     */
    public function removePost($PostId)
    {
        $bdd = $this->bdd;
        $req = $bdd->exec("DELETE FROM `posts` WHERE `PostId` = $PostId");

        if (!$req) {
            echo 'Erreur a la suppression du chapitre';
        }
    }

    /**
     * updatePost
     *
     * update a post thank to $post parametrs in database .
     *
     * @param Post $post
     */
    public function updatePost(Post $post)
    {
        $bdd = $this->bdd;

        $req = $bdd->prepare('UPDATE posts SET PostContent = :Content, Title = :Title , modificationDate=NOW(),Position= :PostPosition WHERE PostId = :PostId');

        $req->bindValue(':PostId',$post->getPostId(),PDO::PARAM_INT);
        $req->bindValue(':Content',$post->getContent() ,PDO::PARAM_STR);
        $req->bindValue(':Title',$post->getTitle(),PDO::PARAM_STR);
        $req->bindValue(':PostPosition',$post->getPosition(),PDO::PARAM_INT);

        $req->execute();
    }


    /**
     * Warning
     *
     * set warning at $value  in database for id comment.
     *
     * $id is the id to update and $value is st to 1 for warning and 0 in other case.
     *
     * @param $id
     * @param $value
     */

    public function Warning($id , $value)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare('UPDATE comments SET Warning = :Warning  WHERE CommentId = :CommentId');
        $req->bindValue(':Warning',$value,PDO::PARAM_INT);
        $req->bindValue(':CommentId',$id,PDO::PARAM_INT);

        $req->execute();
    }

    /**
     * getWarnings()
     *
     * get a list of warning in an array.
     * this content are object (instanciate from Warning object)
     *
     * @return array
     */

 public function getWarnings()
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare($query = "SELECT * FROM comments WHERE Warning =:warning");
        $req->bindValue(':warning','1',PDO::PARAM_INT);
        $req->execute();

        //$req->fetch(PDO::FETCH_ASSOC);

        $warnings = array();

        while ($row = $req-> fetch(PDO::FETCH_ASSOC)){
            $warning = new Warning();
            $warning->setPostId($row['PostId']);
            $warning->setCommentId($row['CommentId']);
            $warning->setAnswerId($row['AnswerId']);
            $warning->setAnswer($row['Answ']);
            $warning->setTopic($row['CommentContent']);
            $warning->setAuthor($row['Author']);

            $warnings[] = $warning;

        }

        return $warnings;


    }

    
}