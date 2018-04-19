<?php
/**
 * Class FrontOfficeHome
 *
 * used to show the Post.php on home page
 */
class PostsController
{
    private $userLevel;

    public function showPost()
    {
        /**
         * Todo
         *  get one post and goto to view
         */

        if(isset($_GET['idPost'])) {
            $idPost = $_GET['idPost'];
            $manager = new PostCommentManager();
            $chapter= $manager->findPost($idPost);
            $comments = $manager->findComs($idPost);

            $myView = new View('post');
            $myView->build( array('chapters'=> $chapter ,'comments'=>$comments,'HOST'=>HOST, 'adminLevel' => $_SESSION['adminlevel']));

        }else{
            echo 'Cet Article m\'existe pas encore';

        }

    }

    public function createComment()
    {
        if (isset($_GET['postId'])){
            $Author = $_POST['author'];
            $Comment = $_POST['comment'];
            $values= array( 'Author'=> $Author, 'Comment'=> $Comment , 'PostId' => $_GET['postId'] );

            $manager = new PostCommentManager('blogecrivain' , 'root' ,'');
            $manager->addComment($values);

            $myView= new View();
            $myView->redirect('post.html?idPost='.$_GET['postId']);

        }else{

            echo 'Probleme avec l\'id du post';
        }
    }


    public function removeComment()
    {

        if (isset($_GET['comId']) AND isset($_GET['postId']) ){

            $manager = new PostCommentManager();
            $manager->remove($_GET['comId']);

            $myView= new View('post');
            $myView->redirect('post.html?idPost='.$_GET['postId']);

        }else{

            echo 'Erreur  de suppression : Ce commentaire est introuvable ';
        }
    }

    public function showPosts()
    {
            if (isset($_SESSION['adminLevel)'])) {

                $admin = $_SESSION['adminLevel)'];
                echo $_SESSION['adminLevel)'];
            }else {$admin = 0;}

            $admin = 1; // TO DO a supp c pour le debug
            $manager = new PostManager();
            $chapters= $manager->findAll();

            $myView = new View('home');
            $myView->build( array('chapters'=> $chapters ,'comments'=>null,'HOST'=>HOST ,'adminLevel'=>$admin));
    }



    public function identification()
    {
        // TO DO => test de dession yes no o
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
                        $_SESSION['adminL'] = 1;

                        // $manager = new PostManager();
                        //$chapters= $manager->findAll();

                        // $myView = new View('home');
                        //$myView->build( array('chapters'=> $chapters ,'comments'=>null,'HOST'=>HOST ,'adminLevel'=>0));
                        $url= HOST . "home.html";


                        die('<meta http-equiv="refresh" content="0;URL='. $url .'">');


                    } else {
                        echo 'Mauvais identifiant ou mot de passe !';
                        $myView = new View('home');
                        $myView->redirect('home.html');
                    }
                } else {
                    echo ' Ce membre existe dans la Base de donnée mais n a pas de droit admin  !';
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

    public function updatePost()
    {
        // TODO


    }



    public function createPost()
    {
        // TODO

            $myView = new View('addpost');
            $myView->build(array('chapters'=> null ,'comments'=>null,'HOST'=>HOST ,'adminLevel'=>true));

    }
        public function addPost()
    {
        // TODO
        if ((isset($_POST['newTitle'])) AND (isset($_POST['newPost']) ) ) {

            $newPost = new Post();
            $newPost->setTitle($_POST['newTitle']);
            $newPost->setContent($_POST['newPost']);

            $manager = new PostManager('blogecrivain' , 'root' ,'');
            $manager->addPost($newPost);

        }else {echo 'Impossible d\'ajouter cet article . Le titre ou l\'article n\'existe pas';}
        /**

*/

    }

    public function removePost()
    {
        // TODO
        if (isset($_GET['idPost']) ){

            $manager = new PostManager();
            $manager->removePost($_GET['idPost']);
/**
            $myView= new View('post');
            $myView->redirect('post.html?idPost='.$_GET['postId']);
*/
        }else{

            echo 'Erreur  de suppression : Ce commentaire est introuvable ';
        }

    }







}