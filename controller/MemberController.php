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

       $this->sessionStatus();//determine status admin or not
        $myView = new View('UserCnxForm');
        $myView->build( array('chapters'=> null ,'comments'=>null,'HOST'=>HOST,'adminLevel'=>  $_SESSION['adminLevel']));


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