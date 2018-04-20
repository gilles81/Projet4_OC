<?php
/**
 * Class MemberController
 *
 * used to show the Post.php on home page
 */
class MemberController extends lib
{
    /**
     * loginSession() Method
     *
     * Loggin : Call loggin view for define Log an Pswd
     */
    public function loginSession()
    {
        // Todo : Verifier sessionStatus() et la fction suivante doublon surement session status est utilise sur une entrée par home
        //$this->sessionStatus();//determine status admin or not
        // Dectection if already in ADMIN Mode
        if (isset($_SESSION['adminLevel']) &&  ($_SESSION['adminLevel']== 0))
        {
            $myView = new View('UserCnxForm');
            $myView->build( array('chapters'=> null ,'comments'=>null,'HOST'=>HOST,'adminLevel'=>  $_SESSION['adminLevel']));

        }else{
            //$myView = new View('home');
        }
    }

    /**
     *  deconnexion() method
     *
     * Used to deconnect from admin mode .
     *
     * (session are managed by automatic creation : php.ini updated for that.
     */
    public function deconnexion()

    {
        session_destroy();
        $myView = new View('home');
        $myView->redirect('home.html');
    }


}