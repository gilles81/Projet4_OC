<?php
/**
 * Class PostsController
 *
 * used to show the Post  on home page
 */
class PostsController extends lib
{
    private $userLevel;
    private $Admin;

    /**************************/
    /**
     *
     * Part of Topic's method
     *
     */
    /**************************/


    /**
     *
     * public function createComment()
     *
     */

    public function createComment()
    {
        if (isset($_GET['postId'])) {
            $author = $_POST['author'];
            $topic = $_POST['com'];

            $values = array('Author' => $author, 'Topic' => $topic, 'PostId' => $_GET['postId']);

            $manager = new PostManager();
            $manager->addComment($values);



            $myView = new View();
            $myView->redirect('post.html?idPost=' . $_GET['postId']);

        } else {

            echo 'Probleme avec l\'id du post';
        }
    }

    /**
     *
     * public function removeComment()
     *
     *
     */
    public function removeComment()
    {
        if (isset($_GET['comId']) AND isset($_GET['postId'])) {
            $manager = new PostManager();
            $manager->remove($_GET['comId']);
            $myView = new View ();
            $myView->redirect('post.html?idPost='.$_GET['postId']);
        } else {
            echo 'Erreur  de suppression : Ce commentaire est introuvable- ';
        }
    }


    public function removeReply()
    {
        if (isset($_GET['comId']) AND isset($_GET['answId']) ) {
            $manager = new PostManager();
            $manager->remove($_GET['answId']);
            $myView = new View();
            $myView->redirect('reply.html?comId=' . $_GET['comId']);
        } else {

            echo 'Erreur  de suppression : Ce commentaire est introuvable- ';
        }
    }

    public function answer() //display
    {

        //if (isset($_GET['comId']) AND isset($_GET['postId'])) {
           if (isset($_GET['comId']) ) {

                $manager = new PostManager();
                $commentTopic = $manager->findCom($_GET['comId']); // object of Topic

                $answers = $manager->findAnswersTopic($_GET['comId']); //array of Object of answer from a topic

                $CommentsToDisplay = [$commentTopic , $answers];

                $myView = new View('answer');
                $myView->build(array('chapters' => null, 'comments' => $CommentsToDisplay,'warningList' => null, 'HOST' => HOST, 'adminLevel' => $_SESSION['adminLevel']));


            } else {


                //TODO : Revoie si var n'esiste pas
            }

    }


    /**
     * public function newAnswer()
     *
     * retrieve data from form to add in database
     *
     */


        public function newAnswer() //add a new asnwer
    {
        if ((isset($_GET['comId']))  AND (isset($_POST['author'])) AND (isset($_POST['answer'])) AND (isset($_GET['postId']))  )
        {
            $values = array( 'Answ' => $_POST['answer'], 'CommentId' => $_GET['comId']);
            $manager = new PostManager();
            $values = array('Author' => $_POST['author'], 'Topic' => '', 'PostId' =>$_GET['postId'], 'Answ'=>$_POST['answer'] , 'AnswerId'=>$_GET['comId'],  );
            $answer = $manager->addAnswer($values);
           $myView = new View();
           $myView->redirect('post.html?idPost=' . $_GET['postId']);

        }else
        {
            echo ' Pas de comm ';
        }

    }










        /*******************************************/
    /**
     *
     * Part of Post's method
     *
     */
    /*******************************************/


    /**
     *
     *  public function createPost()
     *
     *  This method call a view with a template of Post modification form
     */

    public function createPost()
    {
        // Call of view
        $myView = new View('addpost');
        $myView->build(array('chapters' => null, 'comments' => null, 'warningList' => null,'warningList' => null,'HOST' => HOST, 'adminLevel' => $_SESSION['adminLevel']));
    }



    /**
     *
     * public function addPost()
     *
     *
     *This method add new post in database and call a view to return at the post list.
     *
     *
     */
    public function addPost()
    {

        if (!(isset($_POST['AnnulAddPost']))) {

            if ((isset($_POST['newTitle'])) AND (isset($_POST['newPost']))) {
                // set of Post object

                $newPost = new Post();
                $newPost->setTitle($_POST['newTitle']);
                $newPost->setContent($_POST['newPost']);
                $newPost->setPosition($_POST['position']);
                // call of manager
                $manager = new PostManager();

                $manager->addPost($newPost);
            } else {
                echo 'Impossible d\'ajouter cet article . Le titre ou l\'article n\'existe pas';
            }
        }
        //cal of view
        $myView = new View();
        $myView->redirect('home.html');
    }




    /**
     *  public function removePost()
     *
     *
     *
     */
    public function deletePost()
    {
        // TODO
        if (isset($_GET['idPost']) ){


            $manager = new PostManager();
            $manager->removePost($_GET['idPost']);

            $myView= new View('home');
            $myView->redirect('home.html');
        }else{

            echo 'Erreur  de suppression : Ce commentaire est introuvable ';
        }

    }
    /**
     *
     * public function sendUpdatePost ()
     *
     * This Controller method  call  manager to add post modification in Bdd.
     *
     * Annulation is permitted by checcking Annulation variavle send by Post from View.
     * In case of annulation a return on view form is made.
     *
     *
     */

    public function sendUpdatePost ()
    {
        if ((!isset($_POST['Annulation']) )) {
            if ((isset($_POST['newTitle'])) AND (isset($_POST['newPost'])) AND (isset($_GET['idPost'] )) AND (isset($_POST['position'] ))         ) {
                // Get Bdd ident
                $newPost= new Post();
                $newPost->setTitle($_POST['newTitle']);
                $newPost->setContent($_POST['newPost']);
                $newPost->setPostId($_GET['idPost']);

                $newPost->setPosition($_POST['position']);

                // Manager Call
                $manager = new PostManager();
                $manager->updatePost($newPost);
                //View call
                $myView = new View('home');
                $myView->redirect('home.html');
            }

        }else{

            // call of view

            $myView = new View('home');
            $myView->redirect('home.html');




        }




    }

    /**
     * public function updatePost()
     */

    public function updatePost()
    {

        if(isset($_GET['idPost'])) {
            $manager = new PostManager();
            $chapter= $manager->findPost($_GET['idPost']);

            $myView = new View('updatePost');
            $myView->build( array('chapters'=> $chapter ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));

        }else{
            echo 'Cet Article n\'existe pas encore';

        }
    }




    /**
     * public function showPost()
     *
     *
     */
    public function showPost()
    {
        /*****
         * Todo
         *  get one post and go to to view
         */
        echo '---showpostavant' .$_GET['postId'] ;
        if(isset($_GET['postId'])) {
            $idPost = $_GET['postId'];
            echo '---showpost' .$_GET['postId'] ;

            $manager = new PostManager();
            $chapter= $manager->findPost($idPost);
            $Topics = $manager->findComs($idPost);

            $myView = new View('post');
            $myView->build( array('chapters'=> $chapter ,'comments'=>$Topics,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));

        }else{
            echo 'Cet Article m\'existe pas encoreffff';

        }

    }

    /**
     *
     * function verifyWarning()
     *
     * verify if a message is in status Warning (set by visitor)
     */








    /**
     *
     * public function showPosts()
     *
     */

    public function showPosts()
    {
        $this->sessionStatus();//determine status admin or not

        $manager = new PostManager();
        $chapters= $manager->findAll();

        $warningListManager = new PostManager();
        $warningList= $warningListManager->getWarnings();

        //$warningsList = $warningsListManager ->getCommentsWarning();

        if (empty($warningList)){


            $myView = new View('home');
            $myView->build( array('chapters'=> $chapters ,'comments'=>null,'warningList' => null ,'HOST'=>HOST ,'adminLevel'=> $_SESSION['adminLevel']));

        } else{
            //$chaptersSorted=$this->chaptersList($chapters);

            $myView = new View('home');
            $myView->build( array('chapters'=> $chapters ,'comments'=>null,'warningList' => $warningList,'HOST'=>HOST ,'adminLevel'=> $_SESSION['adminLevel']));

        }


    }


    public function nextPost($currentPost)
    {
       //TODO : Dev next Post button
        // manager
        // recuperer le chapitre suivant basée sur l'ordre..

/**
        if (   (isset($_GET['directionRight']))     )
        {
            if ( (isset($_GET['Direction'])==1))
            {

                // Prend la pos actuelle
                // tu enleves 1
            }

            if ( (isset($_GET['Direction'])==1))
            {

            }
        }
 * */
    }

    /**
     *  This function add in database a warning on comment
     */

    public function setTopicWarning()
    {
        if (isset($_GET['comId']) AND isset($_GET['postId'])) {
            $manager = new PostManager();
            $manager->Warning($_GET['comId'], "1");

            $myView = new View();
            $myView->redirect('post.html?postId='.$_GET['postId']);
        } else {

            echo ' Ce commentaire est introuvable ';
        }
    }


        public function setAnswerWarning()
    {

        if (isset($_GET['comId']) AND isset($_GET['postId'])    ) {
            $manager = new PostManager();
            $manager->Warning($_GET['comId'] , "1");

            $myView = new View();
            $myView->redirect('reply.html?comId='.$_GET['postId']);
        } else {

            echo ' Ce commentaire est introuvable ';
        }


    }
    public function unsetAnswerWarning()
    {
        if (isset($_GET['comId']) AND isset($_GET['postId'])AND isset($_GET['comIdWarning']) ) {
            $manager = new PostManager();
            $manager->Warning($_GET['comIdWarning'] , "0");

            $myView = new View('');
            $myView->redirect('reply.html?comId=' . $_GET['comId'].'&amp;postId='.$_GET['postId']);
        } else {

            echo ' Ce commentaire est introuvable ';
        }


    }

    public function unsetTopicWarning()
    {
        if (isset($_GET['comId']) AND isset($_GET['postId'])  ) {
            $manager = new PostManager();
            $manager->Warning($_GET['comId'] , "0");

            echo  ($_GET['comId'].'----'. $_GET['postId']) ;


            $myView = new View();
            $myView->redirect('post.html?postId='.$_GET['postId']);
        } else {

            echo ' Ce commentaire est introuvable ';
        }


    }







    /*******************************************/
    /**
     *
     * Part of Post Session supervisor
     *
     */
    /*******************************************/



    /**
     *
     *   public function identification()
     *
     */
    public function identification()
    {

        if (isset($_POST['pass']) AND isset($_POST['login'])) {
            // Get Bdd ident
            $manager = new MemberManager();
            $member = $manager->getMember($_POST['login']); //object from data base definition corresponding to login request


            if (!$member) {
                echo 'Ce pseudo n\'est pas enregistré dans la base de donnée des membres !';
            } else {

                if (($member->getRight() == '1')) // Vréifiction of Bdd right on Bdd member registration
                {
                    $isPasswordCorrect = password_verify($_POST['pass'], $member->getPass());
                    if ($isPasswordCorrect) {
                        $_SESSION['id'] = $member->getId();
                        $_SESSION['pseudo'] = $member->getPseudo();
                        $_SESSION['adminLevel'] = 1;
                        /** Redirection to home Page with all Posts**/
                        $myView = new View('home');
                        $myView->redirect('home.html');
                    } else {
                        echo 'Mauvais identifiant ou mot de passe !';
                        /** Redirection to home Page with all Posts**/
                        $myView = new View('home');
                        $myView->redirect('home.html');
                    }
                } else {
                    echo ' Ce membre existe dans la Base de donnée mais n a pas de droit admin  !';
                    /** Redirection to PWD Page **/
                    $myView = new View('UserCnx');
                    $myView->redirect('admin.html');
                }
            }
        }else{
            echo ' Probleme d\'identification  !';
            $myView = new View('UserCnx');
            $myView->redirect('admin.html');
        }
    }
}


