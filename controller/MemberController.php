<?php
/**
 * Class FrontOfficeHome
 *
 * used to show the Post.php on home page
 */
class MemberController
{
    /**
     *
     * Loggin : Call loggin view
     */
    public function loginSession()
    {
        //session_destroy();

        $_SESSION['adminL'] = 0;
        echo 'session is state  ->  ' . $_SESSION['adminL']  ;

        $myView = new View('UserCnxForm');
         $myView->build( array('chapters'=> null ,'comments'=>null,'HOST'=>HOST,'adminLevel'=> $_SESSION['adminL']));
    }


    /**
     *
     * identification() : Get Menber in db and verifi password
     */
    /**

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
                        echo 'Meta';

                        echo "<META http-equiv='Location' content='0;URL=".HOST."TOTO.html'>";


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
*/

    public function deconnexion()

    {
        session_destroy();

        $myView = new View('home');
        $myView->redirect('home.html');

    }


}