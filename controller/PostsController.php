<?php
/**
 * Class PostsController
 *
 * used to show the Post  on home page
 */
class PostsController extends lib
{

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
    public function createComment() {
        if (isset($_GET['postId']) AND  (isset($_GET['postId']) >= (int) 0) ) {
            if (isset($_POST['author']) AND isset($_POST['com']) AND (!empty($_POST['com'])) AND (!empty($_POST['author']))) {
                $author = $_POST['author'];
                $topic = $_POST['com'];

                $values = array('Author' => $author, 'Topic' => $topic, 'PostId' => $_GET['postId']);

                $manager = new PostManager();
                $manager->addComment($values);

                $myView = new View('');
                $myView->redirect('post.html?postId=' . $_GET['postId']);

            } else {

                $myView = new View('');
                $myView->redirect('post.html?postId=' . $_GET['postId']);

            }
        }else {

            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));



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
        if (isset($_GET['comId']) AND isset($_GET['postId'])AND (($_GET['comId']) >= (int) 0  )  AND (($_GET['postId']) >= (int) 0 )) {
            $manager = new PostManager();
            $manager->remove($_GET['comId']);
            $myView = new View ('');
            $myView->redirect('post.html?postId='.$_GET['postId']);
        } else {
            //$myView = new View(' ');
           // $myView->redirect('home.html');
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));


        }
    }


    public function removeReply() {


        if (isset($_GET['comId']) AND isset($_GET['answId']) AND (($_GET['comId']) >= (int) 0  )  AND (($_GET['answId']) >= (int) 0 )) {
            $manager = new PostManager();
            $manager->remove($_GET['answId']);
            $myView = new View('');
            $myView->redirect('reply.html?comId=' . $_GET['comId']);
        } else {
            //echo 'Erreur  de suppression : Ce commentaire est introuvable- ';
            //$myView = new View(' ');
            //$myView->redirect('home.html');
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }
    }

    public function answer() //display
    {
           if (isset($_GET['comId'])  )  {
                if ( !empty((isset($_GET['comId'])) AND ($_GET['comId'] >= (int) 0)) ) {
                    $manager = new PostManager();
                    $commentTopic = $manager->findCom($_GET['comId']); // object of Topic

                    $answers = $manager->findAnswersTopic($_GET['comId']); //array of Object of answer from a topic

                    $CommentsToDisplay = [$commentTopic , $answers];

                    $myView = new View('answer');
                    $myView->build(array('chapters' => null, 'comments' => $CommentsToDisplay,'warningList' => null, 'HOST' => HOST, 'adminLevel' => $_SESSION['adminLevel']));

                }else {
                    if (  (isset($_GET['postId'])) AND ($_GET['postId'] >= (int) 0)) {
                        $myView = new View('');
                        $myView->redirect('post.html?postId=' . $_GET['postId']);
                    }else {
                        $myView = new View('error');
                        $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
                    }
                }
            } else {
               $myView = new View('error');
               $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
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
        if ( (isset($_GET['postId'])) AND (isset($_GET['postId']) >= (int) 0)){
            if ( (isset($_GET['comId'])) AND (isset($_GET['comId'])>= (int) 0) AND (isset($_POST['author'])) AND (isset($_POST['answer']))  ){
                if ( (!(empty($_POST['author'])  )) AND ((!empty($_POST['answer']))) ) {
                    $manager = new PostManager();
                    $values = array('Author' => $_POST['author'], 'Topic' => '', 'PostId' =>$_GET['postId'], 'Answ'=>$_POST['answer'] , 'AnswerId'=>$_GET['comId'],  );
                    //manager call to add answer in db
                    $manager->addAnswer($values);
                    //redirection to current post
                    $myView = new View('');
                    $myView->redirect('reply.html?comId='.$_GET['comId']);

                }else {
                    $myView = new View('');
                    $myView->redirect('reply.html?comId='.$_GET['comId']);
                }
            }else{
                $myView = new View('');
                $myView->redirect('post.html?postId=' . $_GET['postId']);
            }
        }else {
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
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
        $myView->build(array('chapters' => null, 'comments' => null, 'warningList' => null,'HOST' => HOST, 'adminLevel' => $_SESSION['adminLevel']));
    }



    /**
     *
     * public function addPost()
     *
     *
     *This method add new (chapter) post in database and call a view to return at the post list.
     *
     *
     */
    public function addPost()
    {
        if (!(isset($_POST['AnnulAddPost']))) {
            if ( (isset($_POST['newTitle'])) AND (!empty(isset($_POST['newTitle']))) AND (isset($_POST['newPost'])) AND (!empty(isset($_POST['newPost']))) ) {
                // set of Post object
                $newPost = new Post();
                $newPost->setTitle($_POST['newTitle']);
                $newPost->setContent($_POST['newPost']);
                $newPost->setPosition($_POST['position']);
                // call of manager
                $manager = new PostManager();
                $manager->addPost($newPost);
                // Call of view
                $myView = new View('');
                $myView->redirect('home.html');
            }else {
                $myView = new View('error');
                $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
            }
        } else{
            $myView = new View('');
            $myView->redirect('home.html');
        }
    }




    /**
     *  public function removePost()
     *
     * call manager to delete a chapter (post) in db
     *
     */
    public function deletePost()
    {
        if (isset($_GET['postId']) AND ($_GET['postId'] >=(int) 0) ){
            $manager = new PostManager();
            $manager->removePost($_GET['postId']);


          // Redirect to Home
            $myView = new View('');
            $myView->redirect('home.html');

        }else {
            // call of error view
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
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
            if ((isset($_POST['newTitle'])) AND (isset($_POST['newPost'])) AND (isset($_GET['postId'] ))  AND ($_GET['postId'] >=(int) 0) AND (isset($_POST['position'] )) ) {
                // Get Bdd ident
                $newPost= new Post();
                $newPost->setTitle($_POST['newTitle']);
                $newPost->setContent($_POST['newPost']);
                $newPost->setPostId($_GET['postId']);

                $newPost->setPosition($_POST['position']);

                // Manager Call
                $manager = new PostManager();
                $manager->updatePost($newPost);
                //View call
                $myView = new View(' ');
                $myView->redirect('home.html');
            }else {
                $myView = new View('error');
                $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
            }
        }else{
            // call of view
             $myView = new View(' ');
            $myView->redirect('home.html');
        }
    }

    /**
     * public function updatePost()
     */

    public function updatePost() {
        if(isset($_GET['postId']) AND ($_GET['postId']>=(int) 0) ) {
            //call of manager
            $manager = new PostManager();
            $chapter= $manager->findPost($_GET['postId']);
            //cal of view
            $myView = new View('updatePost');
            $myView->build( array('chapters'=> $chapter ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }else{
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
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
         *
         *  get one post and go to to view
         */
        if(isset($_GET['postId'])  AND ($_GET['postId'] >= (int) 0)) {
            // call of manager to retrieve Post and coms (topics)
            $manager = new PostManager();
            $chapter= $manager->findPost( $_GET['postId']);
            $Topics = $manager->findComs( $_GET['postId']);
            // call of view
            $myView = new View('post');
            $myView->build( array('chapters'=> $chapter ,'comments'=>$Topics,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }else{
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }
    }

    /**
     *
     * public function showPosts()
     *
     */

    public function showPosts()
    {
        $this->sessionStatus();//determine status admin or not
        // Call of manager to get all Chapters in DB
        $manager = new PostManager();
        $chapters= $manager->findAll();
        // call of manager to get all warningList ( items and reply comment signaled by user)
        $warningListManager = new PostManager();
        $warningList= $warningListManager->getWarnings();

        if (empty($warningList)){
            // call of view in case of no warnings on comments and topic
            $myView = new View('home');
            $myView->build( array('chapters'=> $chapters ,'comments'=>null,'warningList' => null ,'HOST'=>HOST ,'adminLevel'=> $_SESSION['adminLevel']));

        } else{
            // call of view in case of warnings on comments and topic
            $myView = new View('home');
            $myView->build( array('chapters'=> $chapters ,'comments'=>null,'warningList' => $warningList,'HOST'=>HOST ,'adminLevel'=> $_SESSION['adminLevel']));
        }
    }


    public function nextChapter()
    {
        if(isset($_GET['postId']) AND ($_GET['postId'] >= (int) 0) ) {
            // call of manager to retrieve Post and coms (topics)
            $manager = new PostManager();
            $chapters= $manager->findAll(); // all chapters
            $currentChapter= $manager->findPost($_GET['postId']);//chapter corresponding to postId received by get

            $nextPostId=$this->findNextChapter($currentChapter,$chapters);

            $manager = new PostManager();
            $chapter= $manager->findPost( $nextPostId);
            $Topics = $manager->findComs( $nextPostId);

            $myView = new View('post');
            $myView->build( array('chapters'=> $chapter ,'comments'=>$Topics,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));

        } else {
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }
    }


    public function prevChapter()
    {
        if(isset($_GET['postId']) AND ($_GET['postId'] >= (int) 0)) {
            // call of manager to retrieve Post and coms (topics)
            $manager = new PostManager();
            $chapters= $manager->findAll(); // all chapters
            $currentChapter= $manager->findPost($_GET['postId']);//chapter corresponding to postId received by get

            $prevPostId=$this->findPrevChapter($currentChapter,$chapters);

            $manager = new PostManager();
            $chapter= $manager->findPost( $prevPostId);
            $Topics = $manager->findComs( $prevPostId);

            $myView = new View('post');
            $myView->build( array('chapters'=> $chapter ,'comments'=>$Topics,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }else {
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }
    }
    /**
     *  This function add in database a warning on comment
     */

    public function setTopicWarning()
    {
        if (isset($_GET['comId']) AND isset($_GET['postId']) AND ($_GET['postId'] >= (int) 0)  AND ($_GET['comId'] >= (int) 0)) {
            $manager = new PostManager();
            $manager->Warning($_GET['comId'], "1");

            $myView = new View('');
            $myView->redirect('post.html?postId='.$_GET['postId']);
        } else {
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }
    }


        public function setAnswerWarning()
    {

        if (isset($_GET['comId']) AND isset($_GET['postId']) AND ($_GET['postId'] >= (int) 0)  AND ($_GET['comId'] >= (int) 0)   ) {
            $manager = new PostManager();
            $manager->Warning($_GET['comId'] , "1");

            $myView = new View('');
            $myView->redirect('reply.html?comId='.$_GET['postId']);
        } else {

            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
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

            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
        }


    }

    public function unsetTopicWarning()
    {
        if (isset($_GET['comId']) AND isset($_GET['postId']) AND ($_GET['postId'] >= (int) 0)  AND ($_GET['comId'] >= (int) 0) ) {
            $manager = new PostManager();
            $manager->Warning($_GET['comId'] , "0");
            $myView = new View('');
            $myView->redirect('post.html?postId='.$_GET['postId']);
        } else {
            $myView = new View('error');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));
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
                        $myView = new View(' ');
                        $myView->redirect('home.html');
                    } else {
                        echo 'Mauvais identifiant ou mot de passe !';
                        /** Redirection to home Page with all Posts**/
                        $myView = new View(' ');
                        $myView->redirect('home.html');
                    }
                } else {

                    /** Redirection to PWD Page **/
                    $_SESSION['adminLevel']=0;
                    $myView = new View('userCnxForm');
                    $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST,'adminLevel'=>  $_SESSION['adminLevel']) );

                }
            }
        }else{
            echo ' Probleme d\'identification  !';

            $myView = new View('userCnxForm');
            $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST,'adminLevel'=>  $_SESSION['adminLevel']  ));

        }
    }
}


