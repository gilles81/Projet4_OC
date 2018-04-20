<?php
/**
 * Class FrontOfficeHome
 *
 * used to show the Post.php on home page
 */
class PostsController extends lib
{
    private $userLevel;
    private $Admin;

    /**************************/
    /**
     *
     * Part of Comment's method
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
        if (isset($_GET['postId'])){
            $Author = $_POST['author'];
            $Comment = $_POST['comment'];
            $values= array( 'Author'=> $Author, 'Comment'=> $Comment , 'PostId' => $_GET['postId'] );

            $manager = new PostManager('blogecrivain' , 'root' ,'');
            $manager->addComment($values);

            $myView= new View();
            $myView->redirect('post.html?idPost='.$_GET['postId']);

        }else{

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

        if (isset($_GET['comId']) AND isset($_GET['postId']) ){

            $manager = new PostManager();
            $manager->remove($_GET['comId']);

            $myView= new View('post');
            $myView->redirect('post.html?idPost='.$_GET['postId']);

        }else{

            echo 'Erreur  de suppression : Ce commentaire est introuvable ';
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
     *
     */

    public function createPost()
    {
        // TODO

        $myView = new View('addpost');
        $myView->build(array('chapters'=> null ,'comments'=>null,'HOST'=>HOST ,'adminLevel'=>$_SESSION['adminLevel']));
    }

    /**
     *
     * public function addPost()
     *
     *
     */
    public function addPost()
    {
        // TODO
        if ((isset($_POST['newTitle'])) AND (isset($_POST['newPost']) ) ) {

            $newPost = new Post();
            $newPost->setTitle($_POST['newTitle']);
            $newPost->setContent($_POST['newPost']);

            $manager = new PostManager('blogecrivain' , 'root' ,'');
            $manager->addPost($newPost);

            $myView= new View('post');
            $myView->redirect('home.html');

        }else {
            echo 'Impossible d\'ajouter cet article . Le titre ou l\'article n\'existe pas';}



    }


    /**
     *  public function removePost()
     *
     *
     *
     */
    public function removePost()
    {
        // TODO
        if (isset($_GET['idPost']) ){

            $manager = new PostManager();
            $manager->removePost($_GET['idPost']);

            $myView= new View('post');
            $myView->redirect('home.html');

        }else{

            echo 'Erreur  de suppression : Ce commentaire est introuvable ';
        }

    }
    /**
     *
     * public function sendUpdatePost ()
     *
     *
     */

    public function sendUpdatePost () {

        //echo $_POST['newTitle'] . $_POST['newPost'] . $_GET['idPost'];

        if ((isset($_POST['newTitle'])) AND (isset($_POST['newPost'])) AND (isset($_GET['idPost'] ))) {

            // Get Bdd ident
            $newPost= new Post();
            $newPost->setTitle($_POST['newTitle']);
            $newPost->setContent($_POST['newPost']);
            $newPost->setPostId($_GET['idPost']);

            $manager = new PostManager();
            $manager->updatePost($newPost);

            $myView = new View('home');
            $myView->redirect('home.html');

        }
    }

    /**
     * public function updatePost()
     */

    public function updatePost()
    {
        // TODO

        if(isset($_GET['idPost'])) {

            $idPost = $_GET['idPost'];

            $manager = new PostManager();
            $chapter= $manager->findPost($idPost);
            //$comments = $manager->findComs($idPost);

            $myView = new View('updatePost');
            $myView->build( array('chapters'=> $chapter ,'comments'=>null,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));

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
        /**
         * Todo
         *  get one post and goto to view
         */

        if(isset($_GET['idPost'])) {


            $idPost = $_GET['idPost'];

            $manager = new PostManager();
            $chapter= $manager->findPost($idPost);
            $comments = $manager->findComs($idPost);

            $myView = new View('post');
            $myView->build( array('chapters'=> $chapter ,'comments'=>$comments,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminLevel']));

        }else{
            echo 'Cet Article m\'existe pas encore';

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
        $manager = new PostManager();
        $chapters= $manager->findAll();

        $myView = new View('home');
        $myView->build( array('chapters'=> $chapters ,'comments'=>null,'HOST'=>HOST ,'adminLevel'=> $_SESSION['adminLevel']));
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


